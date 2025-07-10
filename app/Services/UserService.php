<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function fetchAllEmployers()
    {
        return $this->userRepo->getAllEmployers();
    }

    public function fetchAllCandidates()
    {
        return $this->userRepo->getAllCandidates();
    }
}
