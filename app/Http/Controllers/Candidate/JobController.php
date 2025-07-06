<?php
namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\PostedJob as Job;
use App\Models\Application;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::where('is_active', true)
            ->with('employer')
            ->latest();

        if ($request->has('keyword')) {
            $query->where('title', 'like', '%'.$request->keyword.'%')
                ->orWhere('description', 'like', '%'.$request->keyword.'%');
        }

        if ($request->has('location')) {
            $query->where('location', 'like', '%'.$request->location.'%');
        }

        $jobs = $query->paginate(10);

        return view('candidate.jobs.index', compact('jobs'));
    }

    public function show(Job $job)
    {
        return view('candidate.jobs.show', compact('job'));
    }
}