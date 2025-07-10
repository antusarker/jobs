<?php
namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\PostedJob as Job;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\NewJobPosted;
use Illuminate\Support\Facades\Cache;
use Validator;
use Session;

class JobController extends Controller
{
    public function index(){
        $data['jobs'] = Job::where('is_active', 1)->latest()->get();
        $data['recent_jobs'] = Job::where('is_active', 1)->latest()->limit(4)->get();
        if(auth()->user()->role_id == 2){
            $data['jobs'] = auth()->user()->jobs()->where('is_active', 1)->latest()->get();
        }        
        return view('employer.jobs.index', $data);
    }

    public function create()
    {
        return view('employer.jobs.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|integer',
            'min_salary' => 'required|numeric|min:0',
            'max_salary' => 'required|numeric|gte:min_salary',
            'job_type' => 'required|integer',
            'experience_level' => 'required|integer',
            'expires_at' => 'nullable|date|after:today',
            'is_active' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorList = '<ul>';
            $errorList .= '<b>Note: All Star <span style="color:red">(*)</span> mark is Required !</b>';
            foreach ($errors->all() as $error) {
                $errorList .= '<li>' . $error . '</li>';
            }
            $errorList .= '</ul>';
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('flash_message', $errorList)
                ->with('status_color', 'warning');
        }

        $validated = $validator->validated();
        $job = auth()->user()->jobs()->create($validated);

        // Example: Notify candidates in the same location
        $candidates = User::where('role_id', 3) // candidate role
                    ->where('location', $job->location)
                    ->whereBetween('expected_salary', [$job->min_salary, $job->max_salary])
                    ->get();

        foreach ($candidates as $candidate) {
            $candidate->notify(new NewJobPosted($job));
            \Log::info("Notification sent");
        }

        Session::flash('flash_message','Job posted successfully !');
        return redirect()->back()->with('status_color','success');
    }

    public function show(Job $job)
    {
        //$applications = $job->applications()->with('candidate')->get();
        return view('employer.jobs.show', compact('job'));
    }

    public function jobWiseApplication(Job $job)
    {
        // dd($job->applications()->get());
        // $applications = $job->applications()->with('candidate')->get();
        $applications = $job->applications()->get();
        return view('employer.jobs.totalApplication', compact('applications', 'job'));
    }

    public function edit(Job $job)
    {
        $this->authorize('update', $job);
        return view('employer.jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        $this->authorize('update', $job);
        
        $validated = $request->validate([
            // same as store
        ]);

        $job->update($validated);

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job updated successfully');
    }

    public function destroy(Job $job)
    {
        $this->authorize('delete', $job);
        $job->delete();
        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job deleted successfully');
    }
}