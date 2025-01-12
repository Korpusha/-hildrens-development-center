<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\ActivityType;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityTutorSpecialization;
use App\Models\Cabinet;
use App\Models\LessonEvent;
use App\Models\LessonEventTutor;
use App\Models\Tutor;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LessonEventController extends Controller
{
    /**
     * @return View
     */
    public function create(): View
    {
        $availableCabinets = [];
        foreach (Cabinet::query()->get(['code']) as $cabinet) {
            $availableCabinets[$cabinet->code] = $cabinet->code;
        }

        $availableTutors = [];
        foreach (Tutor::with('user')->get() as $tutor) {
            $availableTutors[$tutor->user_id] = $tutor->user->first_name.' '.$tutor->user->middle_name.' '.$tutor->user->last_name;
        }

        $availableActivities = [];
        foreach (Activity::query()->get(['name']) as $activity) {
            $availableActivities[$activity->name] = $activity->name;
        }

        return view('dashboard.lesson-events.create', [
            'availableCabinets' => $availableCabinets,
            'availableTutors' => $availableTutors,
            'availableActivities' => $availableActivities,
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $lessonEventValidatedData = $request->validate([
            'date' => ['required', 'date'],
            'start_time' => ['required', 'date_format:H:i'],
            'cabinet_code' => ['required', 'exists:cabinets,code'],
            'activity_name' => ['required', 'exists:activities,name'],
            'tutor_ids' => ['nullable', 'array'],
            'tutor_ids.*' => ['exists:tutors,user_id'],
        ]);

        $activity = Activity::query()->where('name', '=', $lessonEventValidatedData['activity_name'])->first();
        $startTime = Carbon::parse($lessonEventValidatedData['start_time']);
        $endTime = $startTime->copy()->addMinutes($activity->duration_minutes);
        $lessonEventValidatedData['end_time'] = $endTime->format('H:i');

        $this->validateLessonEvent($lessonEventValidatedData);

        try {
            DB::transaction(function () use ($lessonEventValidatedData) {
                $lessonEvent = LessonEvent::query()->create([
                    'date' => $lessonEventValidatedData['date'],
                    'start_time' => $lessonEventValidatedData['start_time'],
                    'end_time' => $lessonEventValidatedData['end_time'],
                    'cabinet_code' => $lessonEventValidatedData['cabinet_code'],
                    'activity_name' => $lessonEventValidatedData['activity_name'],
                ]);

                $lessonEvent->lessonEventTutors()->delete();
                foreach ($lessonEventValidatedData['tutor_ids'] as $tutorId) {
                    LessonEventTutor::query()->create([
                        'lesson_event_id' => $lessonEvent->id,
                        'tutor_id' => $tutorId,
                    ]);
                }
            });
            return redirect()->route('dashboard.timetable.index')->with('success', 'Lesson event created successfully!');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.timetable.index')->with('error', 'Failed to create lesson event.');
        }
    }

    /**
     * @param LessonEvent $lessonEvent
     * @return RedirectResponse
     */
    public function destroy(LessonEvent $lessonEvent): RedirectResponse
    {
        try {
            DB::transaction(function () use ($lessonEvent) {
                $lessonEvent->delete();
            });
            return redirect()->route('dashboard.timetable.index')->with('success', 'Lesson event deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.timetable.index')->with('error', 'Failed to delete lesson event.');
        }
    }

    /**
     * @param array $requestData
     * @return void
     * @throws ValidationException
     */
    private function validateLessonEvent(array $requestData)
    {
        $date = $requestData['date'];
        $startTime = $requestData['start_time'];
        $endTime = $requestData['end_time'];
        $cabinetCode = $requestData['cabinet_code'];
        $activityName = $requestData['activity_name'];
        $tutorIds = $requestData['tutor_ids'];

        if (empty($tutorIds)) {
            throw ValidationException::withMessages([
                'tutor_ids' => 'One or more tutors is required.',
            ]);
        }

        if ($endTime > '23:59') {
            throw ValidationException::withMessages([
                'end_time' => 'End time must be within the bounds of the current day.',
            ]);
        }

        $lessonDuration = strtotime($endTime) - strtotime($startTime);
        if ($lessonDuration <= 0) {
            throw ValidationException::withMessages([
                'end_time' => 'End time must be greater than start time.',
            ]);
        }

        if ($lessonDuration < 15 * 60) {
            throw ValidationException::withMessages([
                'end_time' => 'The minimum duration for a lesson is 15 minutes.',
            ]);
        }

        if ($lessonDuration > 8 * 3600) {
            throw ValidationException::withMessages([
                'end_time' => 'The maximum duration for a lesson is 8 hours.',
            ]);
        }

        if ($startTime < '07:00' || $endTime > '20:00') {
            throw ValidationException::withMessages([
                'start_time' => 'Lessons must be scheduled between 08:00 and 20:00.',
            ]);
        }

        if (count($tutorIds) !== count(array_unique($tutorIds))) {
            throw ValidationException::withMessages([
                'tutor_ids' => 'Duplicate tutors cannot be assigned to the same lesson.',
            ]);
        }

        if (LessonEvent::query()
            ->where('date', '=', $date)
            ->where('start_time', '=', $startTime)
            ->where('cabinet_code', '=', $cabinetCode)
            ->exists()) {
            throw ValidationException::withMessages([
                'cabinet_code' => 'This cabinet is already booked at the specified date and start time.',
            ]);
        }

        $overlappingEvent = LessonEvent::query()
            ->where('date', '=', $date)
            ->where('cabinet_code', $cabinetCode)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                    ->orWhereBetween('end_time', [$startTime, $endTime])
                    ->orWhere(function ($query) use ($startTime, $endTime) {
                        $query->where('start_time', '<=', $startTime)
                            ->where('end_time', '>=', $endTime);
                    });
            })
            ->first();

        if ($overlappingEvent instanceof LessonEvent) {
            throw ValidationException::withMessages([
                'start_time' => "Time slot overlaps with cabinet {$overlappingEvent->cabinet_code} at {$overlappingEvent->start_time->format('H:i')} - {$overlappingEvent->end_time->format('H:i')}",
            ]);
        }

        $activity = Activity::query()->where('name', '=', $activityName)->first();
        if ($activity->type === ActivityType::Individual && count($tutorIds) > 1) {
            throw ValidationException::withMessages([
                'tutor_ids' => 'Only one tutor is allowed for individual activities.',
            ]);
        }

        foreach ($tutorIds as $tutorId) {
            $conflictingLesson = LessonEvent::query()
                ->where('date', '=', $date)
                ->whereHas('tutors', function ($query) use ($tutorId) {
                    $query->where('user_id', $tutorId);
                })
                ->where(function ($query) use ($startTime, $endTime) {
                    $query->whereBetween('start_time', [$startTime, $endTime])
                        ->orWhereBetween('end_time', [$startTime, $endTime])
                        ->orWhere(function ($query) use ($startTime, $endTime) {
                            $query->where('start_time', '<=', $startTime)
                                ->where('end_time', '>=', $endTime);
                        });
                })
                ->exists();

            if ($conflictingLesson) {
                throw ValidationException::withMessages([
                    'tutor_ids' => "Tutor with ID {$tutorId} is already booked for another lesson during this time slot.",
                ]);
            }
        }

        foreach ($tutorIds as $tutorId) {
            $hasSpecialization = ActivityTutorSpecialization::query()
                ->where('tutor_id', $tutorId)
                ->where('activity_name', $activityName)
                ->exists();

            if (!$hasSpecialization) {
                throw ValidationException::withMessages([
                    'tutor_ids' => "Tutor with ID {$tutorId} does not specialize in this activity.",
                ]);
            }
        }
    }
}
