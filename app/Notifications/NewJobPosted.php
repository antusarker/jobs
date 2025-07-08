<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewJobPosted extends Notification
{
    use Queueable;

    protected $job;

    public function __construct($job)
    {
        $this->job = $job;
    }

    public function via($notifiable)
    {
        return ['database']; // Only in-app notifications
    }

    public function toDatabase($notifiable)
    {
        $locations = job_locations();
        // Format salary
        $salary = number_format($this->job->min_salary) . ' - ' . number_format($this->job->max_salary);
        return [
            'job_id' => $this->job->id,
            'title' => $this->job->title,
            'message' => "New job posted: {$this->job->title}",
            'employer' => $this->job->employer->name,
            'location' => $locations[$this->job->location] ?? 'Unknown',
            'salary' => $salary,
            'link' => route('job.details', $this->job)
        ];
    }
}