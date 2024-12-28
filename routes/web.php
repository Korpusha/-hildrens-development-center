<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(ProfileController::class)->group(function () {
    Route::get('/profile', 'edit')->middleware('auth')->name('profile.edit');
    Route::patch('/profile', 'update')->middleware('auth')->name('profile.update');
    Route::delete('/profile', 'destroy')->middleware('auth')->name('profile.destroy');
});

require __DIR__.'/auth.php';
