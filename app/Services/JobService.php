<?php 

namespace App\Services;

use App\Models\PostedJob as Job;
use App\Repositories\JobRepository;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JobService
{
    protected $jobRepo;

    public function __construct(JobRepository $jobRepo)
    {
        $this->jobRepo = $jobRepo;
    }

    public function getJobsWithFilters(User $user, Request $request): array
    {
        $data = [];
        if ($user->role_id == 2) {
            $data['jobs'] = $this->jobRepo->getEmployerJobs($user, $request);
        } else {
            $data['jobs'] = $this->jobRepo->getPublicJobs($request);
            $data['recent_jobs'] = $this->jobRepo->getRecentJobs();
        }
        return $data;
    }

    public function createAndNotify(array $data, User $user): Job
    {
        $job = $this->jobRepo->createJobForUser($data, $user);
        
        $candidates = User::where('role_id', 3)
            ->where(function ($query) use ($job) {
                $query->where('location', $job->location)
                    ->orWhere(function ($q) use ($job) {
                        $q->where('job_skill', $job->job_skill)
                            ->whereBetween('expected_salary', [
                                $job->min_salary, 
                                $job->max_salary
                            ]);
                    });
            })
            ->get();

        foreach ($candidates as $candidate) {
            $candidate->notify(new \App\Notifications\NewJobPosted($job));
            Log::info("Notification sent to user: {$candidate->id}");
        }

        return $job;
    }

    public function getApplicationsByJob(Job $job)
    {
        return $this->jobRepo->getJobApplications($job);
    }

    public function updateAndNotify(array $data, Job $job): Job
    {
        $oldLocation = $job->location;

        $job = $this->jobRepo->updateJob($data, $job);

        if ($oldLocation != $job->location) {
            $candidates = User::where('role_id', 3)
            ->where(function ($query) use ($job) {
                $query->where('location', $job->location)
                    ->orWhere(function ($q) use ($job) {
                        $q->where('job_skill', $job->job_skill)
                            ->whereBetween('expected_salary', [
                                $job->min_salary, 
                                $job->max_salary
                            ]);
                    });
            })
            ->get();

            foreach ($candidates as $candidate) {
                $candidate->notify(new \App\Notifications\NewJobPosted($job));
                \Log::info("Notification sent to candidate ID: {$candidate->id}");
            }
        }

        return $job;
    }

    public function deleteJob(Job $job): bool
    {
        return $this->jobRepo->deleteJob($job);
    }
}
