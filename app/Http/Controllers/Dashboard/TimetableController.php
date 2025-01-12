<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Date;
use App\Http\Controllers\Controller;
use App\Models\LessonEvent;
use App\Models\LessonEventTutor;
use App\Models\Tutor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class TimetableController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $year = (int) $request->input('year', now()->year);
        $month = (int) $request->input('month', now()->month);

        $startOfMonth = Carbon::create($year, $month);

        $calendarStart = $startOfMonth->copy()->startOfWeek();
        $calendarEnd = $startOfMonth->copy()->endOfMonth()->endOfWeek();

        $lessonEvents = LessonEvent::query()
            ->whereBetween('date', [$calendarStart, $calendarEnd])
            ->orderBy('date')
            ->orderBy('start_time')
            ->get()
            ->groupBy('date');

        return view('dashboard.timetable.index', [
            'lessonEvents' => $lessonEvents,
            'month' => $month,
            'year' => $year,
            'calendarStart' => $calendarStart,
            'calendarEnd' => $calendarEnd,
            'weekDays' => Date::getWeekDays(),
            'months' => Date::getMonths(),
            'years' => Date::getYears(now()->year - 5, now()->year + 5),
        ]);
    }

    /**
     * @param string $date
     * @return View
     */
    public function show(string $date): View
    {
        $lessonEvents = LessonEvent::query()
            ->with('tutors')
            ->where('date', '=', $date)
            ->orderBy('start_time')
            ->get();

        return view('dashboard.timetable.show', [
            'lessonEvents' => $lessonEvents,
            'date' => $date,
        ]);
    }
}
