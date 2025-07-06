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
        'salary',
        'type',
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
        return $this->hasMany(Application::class);
    }
}