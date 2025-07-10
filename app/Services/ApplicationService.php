<?php

namespace App\Services;

use App\Repositories\ApplicationRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ApplicationService
{
    protected $applicationRepo;

    public function __construct(ApplicationRepository $applicationRepo)
    {
        $this->applicationRepo = $applicationRepo;
    }

    public function fetchApplications()
    {
        if (Auth::user()->role_id == 2) {
            return $this->applicationRepo->getEmployerApplications();
        }

        return $this->applicationRepo->getAllWithJobs();
    }

    public function storeApplication(Request $request, $jobId, $userId)
    {
        $resumePath = $request->file('resume_path')->store('resumes', 'public');

        $data = [
            'job_id' => $jobId,
            'cover_letter' => $request->cover_letter,
            'resume_path' => $resumePath,
            'status' => 1,
            'candidate_id' => $userId,
        ];

        return $this->applicationRepo->create($data);
    }
}
