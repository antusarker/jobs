<?php
namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Services\UserService;

class EmployerController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $data['employers'] = $this->userService->fetchAllEmployers();
        return view('employer.index', $data);
    }
}