<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostedJob extends Model
{
    protected $table = 'posted_jobs';

    protected $fillable = [
        'title',
        'description',
        'location',
        'job_skill',
        'min_salary',
        'max_salary',
        'job_type',
        'experience_level',
        'expires_at',
        'is_active',
        'employer_id'
    ];

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'job_id');
    }
}