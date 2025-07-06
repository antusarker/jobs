<?php
namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\PostedJob as Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = auth()->user()->jobs()->latest()->paginate(10);
        return view('employer.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('employer.jobs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'salary' => 'nullable|numeric',
            'type' => 'required|in:full-time,part-time,contract,freelance',
            'experience_level' => 'required|in:entry,mid,senior',
            'expires_at' => 'nullable|date',
        ]);

        auth()->user()->jobs()->create($validated);

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job posted successfully');
    }

    public function show(Job $job)
    {
        $this->authorize('view', $job);
        $applications = $job->applications()->with('candidate')->get();
        return view('employer.jobs.show', compact('job', 'applications'));
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