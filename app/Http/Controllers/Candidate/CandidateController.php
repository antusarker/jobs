<?php
namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Services\UserService;

class CandidateController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $data['candidates'] = $this->userService->fetchAllCandidates();
        return view('candidate.index', $data);
    }
}