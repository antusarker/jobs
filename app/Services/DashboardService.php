<?php

namespace App\Services;

use App\Models\PostedJob as Job;
use App\Models\User;
use App\Models\Application;

class DashboardService
{
    public function getDashboardMetrics(): array
    {
        return [
            'total_jobs'   => Job::count(),
            'active_jobs'  => Job::where('is_active', true)->count(),
            'total_users'  => User::count(),
            'employers'    => User::where('role_id', 2)->count(),
            'candidates'   => User::where('role_id', 3)->count(),
            'applications' => Application::count(),
        ];
    }
}