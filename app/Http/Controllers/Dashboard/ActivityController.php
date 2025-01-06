<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\ActivityType;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ActivityController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('dashboard.activities.index', [
            'activities' => Activity::query()->paginate(10),
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('dashboard.activities.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique(Activity::class)],
            'description' => ['required', 'string', 'max:255'],
            'duration_minutes' => ['required', 'integer', 'min:1', 'max:1440'],
            'type' => ['required', 'string', Rule::in(ActivityType::cases())],
        ]);

        try {
            DB::transaction(function () use ($validatedData) {
                Activity::query()->create($validatedData);
            });
            return redirect()->route('dashboard.activities.index')->with('success', 'Activity created successfully!');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.activities.index')->with('error', 'Failed to create activity.');
        }
    }

    /**
     * @param Activity $activity
     * @return View
     */
    public function edit(Activity $activity): View
    {
        return view('dashboard.activities.edit', [
            'activity' => $activity,
        ]);
    }

    /**
     * @param Request $request
     * @param Activity $activity
     * @return RedirectResponse
     */
    public function update(Request $request, Activity $activity): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique(Activity::class)->ignore($activity->name, 'name')],
            'description' => ['required', 'string', 'max:255'],
            'duration_minutes' => ['required', 'int', 'min:1', 'max:1440'],
            'type' => ['required', 'string', Rule::in(ActivityType::cases())],
        ]);

        try {
            DB::transaction(function () use ($activity, $validatedData) {
                $activity->update($validatedData);
            });
            return redirect()->route('dashboard.activities.index')->with('success', 'Activity updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.activities.index')->with('error', 'Failed to update activity.');
        }
    }

    /**
     * @param Activity $activity
     * @return RedirectResponse
     */
    public function destroy(Activity $activity): RedirectResponse
    {
        try {
            DB::transaction(function () use ($activity) {
                $activity->delete();
            });
            return redirect()->route('dashboard.activities.index')->with('success', 'Activity deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.activities.index')->with('error', 'Failed to delete activity.');
        }
    }
}
