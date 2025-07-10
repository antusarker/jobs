<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Candidate\ApplicationController;
use App\Http\Controllers\Employer\EmployerController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Employer\JobController;
use App\Http\Controllers\Candidate\CandidateController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/candidate/list', [CandidateController::class, 'index'])->name('candidate.list');
    Route::get('/employer/list', [EmployerController::class, 'index'])->name('employer.list');
});

Route::middleware(['auth', 'role:admin,employer'])->group(function () {
    Route::get('/applications', [ApplicationController::class, 'index'])->name('application.all');
});

Route::middleware('auth')->group(function () {
    Route::get('/job/create', [JobController::class, 'create'])->name('job.create');
    Route::post('/job/store', [JobController::class, 'store'])->name('job.store');
    Route::get('/job/list', [JobController::class, 'index'])->name('job.list')->middleware('cache.redis:120'); // 30 minutes
    Route::get('/job/{job}/show', [JobController::class, 'show'])->name('job.details');
    Route::get('/job-wise-application/{job}/list', [JobController::class, 'jobWiseApplication'])->name('job.wise.application.list');

    Route::post('/application/store/{job}', [ApplicationController::class, 'store'])->name('application.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
