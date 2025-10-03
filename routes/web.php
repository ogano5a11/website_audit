<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Auditor\DashboardController as AuditorDashboardController;
use App\Http\Controllers\Auditee\DashboardController as AuditeeDashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/auditor/dashboard', [AuditorDashboardController::class, 'index'])->name('auditor.dashboard');
    Route::get('/auditee/dashboard', [AuditeeDashboardController::class, 'index'])->name('auditee.dashboard');
});

require __DIR__.'/auth.php';
