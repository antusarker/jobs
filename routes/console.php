<?php

use App\Console\Commands\ArchiveOldJobs;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('app:archive-old-jobs', function () {
    $this->call(ArchiveOldJobs::class);
})->purpose('Archives posted_jobs older than 30 days by setting is_active to false');