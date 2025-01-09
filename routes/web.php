<?php

use App\Http\Controllers\Dashboard\ActivityController as DashboardActivityController;
use App\Http\Controllers\Dashboard\CabinetController as DashboardCabinetController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\TutorController as DashboardTutorController;
use App\Http\Controllers\Website\ProfileController;
use App\Http\Controllers\Website\TimetableController;
use Illuminate\Support\Facades\Route;

/**
 * Website
 */

Route::get('/', fn() => redirect()->route('timetable.index'))
    ->name('welcome');

Route::controller(TimetableController::class)->group(function () {
    Route::get('/timetable', 'index')
        ->name('timetable.index');
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
        ->name('dashboard');
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

require __DIR__.'/auth.php';
