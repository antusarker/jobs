<?php

namespace App\Repositories;

use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class ApplicationRepository
{
    public function getAllWithJobs()
    {
        return Application::with('job')->get();
    }

    public function getEmployerApplications()
    {
        return Application::whereHas('job', function ($query) {
            $query->where('employer_id', Auth::id());
        })->with('job')->latest()->get();
    }

    public function create(array $data)
    {
        return Application::create($data);
    }
}
