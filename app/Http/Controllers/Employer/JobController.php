<?php
namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\PostedJob as Job;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\NewJobPosted;
use App\Services\JobService;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use Validator;
use Session;

class JobController extends Controller
{
    protected $jobService;

    public function __construct(JobService $jobService)
    {
        $this->jobService = $jobService;
    }

    public function index(Request $request)
    {
        $user = auth()->user();
        $data = $this->jobService->getJobsWithFilters($user, $request);

        $data['search_title'] = $request->title;
        $data['search_location'] = $request->location;

        return view('employer.jobs.index', $data);
    }

    public function create()
    {
        return view('employer.jobs.create');
    }

    public function store(StoreJobRequest $request)
    {
        $this->jobService->createAndNotify($request->validated(), auth()->user());
        
        Session::flash('flash_message','Job posted successfully !');
        return redirect()->back()->with('status_color','success');
    }

    public function show(Job $job)
    {
        return view('employer.jobs.show', compact('job'));
    }

    public function jobWiseApplication(Job $job)
    {
        $applications = $this->jobService->getApplicationsByJob($job);
        return view('employer.jobs.totalApplication', compact('applications', 'job'));
    }

    public function edit(Job $job)
    {
        return view('employer.jobs.edit', compact('job'));
    }

    public function update(UpdateJobRequest $request, Job $job)
    {
        $this->jobService->updateAndNotify($request->validated(), $job);
        Session::flash('flash_message','Job updated successfully !');
        return redirect()->back()->with('status_color','success');
    }

    public function destroy(Job $job)
    {
        $this->jobService->deleteJob($job);
        Session::flash('flash_message','Job Deleted successfully !');
        return redirect()->back()->with('status_color','success');
    }
}