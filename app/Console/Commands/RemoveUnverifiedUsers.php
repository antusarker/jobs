<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class RemoveUnverifiedUsers extends Command
{
    protected $signature = 'app:remove-unverified-users';
    protected $description = 'Remove users who haven\'t verified their email within 7 days of registration';

    public function handle()
    {
        $cutoffDate = now()->subDays(7);

        $deleted = DB::table('users')
            ->whereNull('email_verified_at')
            ->where('created_at', '<', $cutoffDate)
            ->delete();

        $this->info("Removed $deleted unverified user(s).");
        Log::info("Removed $deleted unverified user(s) from cron job.");
    }
}