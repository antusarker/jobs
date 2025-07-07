<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'job_id', 'candidate_id', 'cover_letter', 'resume_path', 'status'
    ];

    public function job()
    {
        return $this->belongsTo(PostedJob::class);
    }

    public function candidate()
    {
        return $this->belongsTo(User::class, 'candidate_id');
    }
}