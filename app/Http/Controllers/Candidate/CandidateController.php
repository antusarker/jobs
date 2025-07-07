<?php
namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function index()
    {
        $data['candidates'] = User::where('role_id','3')->get();
        return view('candidate.index', $data);
    }
}