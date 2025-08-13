<?php


// routes/web.php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CrossingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Schedule Controller Routes
    Route::prefix('schedules')->group(function () {
        Route::get('/', [ScheduleController::class, 'index'])->name('schedules.index');
        Route::get('/create', [ScheduleController::class, 'create'])->name('schedules.create');
        Route::post('/', [ScheduleController::class, 'store'])->name('schedules.store');
        Route::get('/{schedule}', [ScheduleController::class, 'show'])->name('schedules.show');
        Route::get('/{schedule}/edit', [ScheduleController::class, 'edit'])->name('schedules.edit');
        Route::put('/{schedule}', [ScheduleController::class, 'update'])->name('schedules.update');
        Route::delete('/{schedule}', [ScheduleController::class, 'destroy'])->name('schedules.destroy');
    });


    // Attandance Routesss
    Route::prefix('attendance')->group(function () {
        Route::get('/', [AttendanceController::class, 'index'])->name('attendance.index');
        Route::post('/check-in', [AttendanceController::class, 'checkIn'])->name('attendance.checkIn');
        Route::post('/check-out', [AttendanceController::class, 'checkOut'])->name('attendance.checkOut');
    });


    // Equipment Routes
    Route::prefix('equipment')->group(function () {
        Route::get('/check', [EquipmentController::class, 'check'])->name('equipment.check');
        Route::post('/verify', [EquipmentController::class, 'verify'])->name('equipment.verify');
    });


    // Crossing
    Route::resource('crossings', CrossingController::class);

    // Report Routes
    Route::resource('reports', ReportController::class)->middleware('auth');
    Route::get('reports/{report}/validate', [ReportController::class, 'showValidation'])->name('reports.validate');
    Route::post('reports/{report}/validate', [ReportController::class, 'validateReport'])->name('reports.validate');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Management Routes
    Route::resource('users', UserController::class)->except(['show']);
});

require __DIR__ . '/auth.php';