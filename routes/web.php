<?php

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

    Route::get('/dashboard/tutors/{tutor}/edit', 'edit')
        ->middleware('auth')
        ->name('dashboard.tutors.edit');

    Route::post('/dashboard/tutors', 'store')
        ->middleware('auth')
        ->name('dashboard.tutors.store');

    Route::patch('/dashboard/tutors/{tutor}', 'update')
        ->middleware('auth')
        ->name('dashboard.tutors.update');

    Route::delete('/dashboard/tutors/{tutor}', 'destroy')
        ->middleware('auth')
        ->name('dashboard.tutors.destroy');
});

require __DIR__.'/auth.php';
