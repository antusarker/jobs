<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PostedJob as Job;
use App\Models\User;
use App\Models\Application;

class DashboardController extends Controller
{
    public function index()
    {
        $metrics = [
            'total_jobs' => Job::count(),
            'active_jobs' => Job::where('is_active', true)->count(),
            'total_users' => User::count(),
            'employers' => User::whereHas('role', function($q) {
                $q->where('name', 'employer');
            })->count(),
            'candidates' => User::whereHas('role', function($q) {
                $q->where('name', 'candidate');
            })->count(),
            'applications' => Application::count(),
        ];

        return view('admin.dashboard', compact('metrics'));
    }
}