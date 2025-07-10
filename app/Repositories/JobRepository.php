<?php 

namespace App\Repositories;
use App\Models\User;
use App\Models\PostedJob as Job;
use Illuminate\Http\Request;

class JobRepository
{
    public function getEmployerJobs(User $user, Request $request)
    {
        $query = $user->jobs()->where('is_active', 1);

        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        return $query->latest()->get();
    }

    public function getPublicJobs(Request $request)
    {
        $query = Job::where('is_active', 1);

        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        return $query->latest()->get();
    }

    public function getRecentJobs($limit = 4)
    {
        return Job::where('is_active', 1)->latest()->limit($limit)->get();
    }

    public function createJobForUser(array $data, User $user): Job
    {
        return $user->jobs()->create($data);
    }

    public function getJobApplications(Job $job)
    {
        return $job->applications()->get();
    }

    public function updateJob(array $data, Job $job): Job
    {
        $job->update($data);
        return $job;
    }

    public function deleteJob(Job $job): bool
    {
        return $job->delete();
    }
}
