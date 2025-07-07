<?php
namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    public function index()
    {
        $data['employers'] = User::where('role_id','2')->get();
        return view('employer.index', $data);
    }
}