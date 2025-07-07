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
            'total_jobs'     => Job::count(),
            'active_jobs'    => Job::where('is_active', true)->count(),
            'total_users'    => User::count(),
            'employers'      => User::where('role_id', 2)->count(),  // Role ID 2 = Employer
            'candidates'     => User::where('role_id', 3)->count(),  // Role ID 3 = Candidate
            'applications'   => Application::count(),
        ];
        
        return view('dashboard', $metrics);
    }
}