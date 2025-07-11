<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\PostedJob as Job;
use Illuminate\Http\Request;
use App\Services\ApplicationService;
use App\Http\Requests\StoreApplicationRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Session;

class ApplicationController extends Controller
{
    protected $applicationService;

    public function __construct(ApplicationService $applicationService)
    {
        $this->applicationService = $applicationService;
    }

    public function index()
    {
        $applications = $this->applicationService->fetchApplications();
        return view('admin.totalApplication', compact('applications'));
    }

    public function store(StoreApplicationRequest $request, Job $job)
    {
        $key = 'application-submit:' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            Session::flash('flash_message', "Too many application submissions. Please try again in {$seconds} seconds.");
            return redirect()->back()->with('status_color', 'warning');
        }

        RateLimiter::hit($key, 300);

        $this->applicationService->storeApplication($request, $job->id, auth()->id());
        Session::flash('flash_message','Application submitted successfully!');
        return redirect()->back()->with('status_color','success');
    }
}
