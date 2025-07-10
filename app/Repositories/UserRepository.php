<?php 

namespace App\Repositories;
use App\Models\User;
use Illuminate\Http\Request;

class UserRepository
{
    public function getAllEmployers()
    {
        return User::where('role_id', 2)->get();
    }

    public function getAllCandidates()
    {
        return User::where('role_id', 3)->get(); // 3 = candidate
    }
}
