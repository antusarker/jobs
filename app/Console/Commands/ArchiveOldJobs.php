<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ArchiveOldJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:archive-old-jobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Archives posted_jobs older than 30 days by setting is_active to false';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $affected = DB::table('posted_jobs')
            ->where('is_active', 1)
            ->where('created_at', '<', now()->subDays(1))
            ->update(['is_active' => 0]);

        $this->info("Archived $affected job(s).");

        \Log::info('ArchiveOldJobs ran from CRON. Archived '.$affected.' job(s).');
    }
}
