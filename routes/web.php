<?php

use App\Http\Controllers\Dashboard\ActivityController as DashboardActivityController;
use App\Http\Controllers\Dashboard\CabinetController as DashboardCabinetController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\LessonEventController as DashboardLessonEventController;
use App\Http\Controllers\Dashboard\TimetableController as DashboardTimetableController;
use App\Http\Controllers\Dashboard\TutorController as DashboardTutorController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\TimetableController as FrontendTimetableController;
use App\Http\Controllers\Profile\ProfileController;
use Illuminate\Support\Facades\Route;

/**
 * Frontend
 */

Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index')
        ->name('frontend.frontend.index');
});

Route::controller(FrontendTimetableController::class)->group(function () {
    Route::get('/timetable', 'index')
        ->name('frontend.timetable.index');

    Route::get('/timetable/{date}', 'show')
        ->name('frontend.timetable.show');
});

Route::controller(ProfileController::class)->group(function () {
    Route::get('/profile', 'edit')
        ->middleware('auth')
        ->name('profile.edit');

    Route::patch('/profile', 'update')
        ->middleware('auth')
        ->name('profile.update');

    Route::delete('/profile', 'destroy')
        ->middleware('auth')
        ->name('profile.destroy');
});

/**
 * Dashboard
 */

Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'index')
        ->middleware(['auth', 'verified'])
        ->name('dashboard.dashboard.index');
});

Route::controller(DashboardTutorController::class)->group(function () {
    Route::get('/dashboard/tutors', 'index')
        ->middleware('auth')
        ->name('dashboard.tutors.index');

    Route::get('/dashboard/tutors/create', 'create')
        ->middleware('auth')
        ->name('dashboard.tutors.create');

    Route::post('/dashboard/tutors', 'store')
        ->middleware('auth')
        ->name('dashboard.tutors.store');

    Route::get('/dashboard/tutors/{tutor}/edit', 'edit')
        ->middleware('auth')
        ->name('dashboard.tutors.edit');

    Route::patch('/dashboard/tutors/{tutor}', 'update')
        ->middleware('auth')
        ->name('dashboard.tutors.update');

    Route::delete('/dashboard/tutors/{tutor}', 'destroy')
        ->middleware('auth')
        ->name('dashboard.tutors.destroy');
});

Route::controller(DashboardActivityController::class)->group(function () {
    Route::get('/dashboard/activities', 'index')
        ->middleware('auth')
        ->name('dashboard.activities.index');

    Route::get('/dashboard/activities/create', 'create')
        ->middleware('auth')
        ->name('dashboard.activities.create');

    Route::post('/dashboard/activities', 'store')
        ->middleware('auth')
        ->name('dashboard.activities.store');

    Route::get('/dashboard/activities/{activity}/edit', 'edit')
        ->middleware('auth')
        ->name('dashboard.activities.edit');

    Route::patch('/dashboard/activities/{activity}', 'update')
        ->middleware('auth')
        ->name('dashboard.activities.update');

    Route::delete('/dashboard/activities/{activity}', 'destroy')
        ->middleware('auth')
        ->name('dashboard.activities.destroy');
});

Route::controller(DashboardCabinetController::class)->group(function () {
    Route::get('/dashboard/cabinets', 'index')
        ->middleware('auth')
        ->name('dashboard.cabinets.index');

    Route::get('/dashboard/cabinets/create', 'create')
        ->middleware('auth')
        ->name('dashboard.cabinets.create');

    Route::post('/dashboard/cabinets', 'store')
        ->middleware('auth')
        ->name('dashboard.cabinets.store');

    Route::get('/dashboard/cabinets/{cabinet}/edit', 'edit')
        ->middleware('auth')
        ->name('dashboard.cabinets.edit');

    Route::patch('/dashboard/cabinets/{cabinet}', 'update')
        ->middleware('auth')
        ->name('dashboard.cabinets.update');

    Route::delete('/dashboard/cabinets/{cabinet}', 'destroy')
        ->middleware('auth')
        ->name('dashboard.cabinets.destroy');
});

Route::controller(DashboardTimetableController::class)->group(function () {
    Route::get('/dashboard/timetable', 'index')
        ->middleware('auth')
        ->name('dashboard.timetable.index');

    Route::get('/dashboard/timetable/{date}', 'show')
        ->middleware('auth')
        ->name('dashboard.timetable.show');
});

Route::controller(DashboardLessonEventController::class)->group(function () {
    Route::get('/dashboard/lesson-events/create', 'create')
        ->middleware('auth')
        ->name('dashboard.lesson-events.create');

    Route::post('/dashboard/lesson-events', 'store')
        ->middleware('auth')
        ->name('dashboard.lesson-events.store');

    Route::delete('/dashboard/lesson-events/{lesson_event}', 'destroy')
        ->middleware('auth')
        ->name('dashboard.lesson-events.destroy');
});

require __DIR__.'/auth.php';
