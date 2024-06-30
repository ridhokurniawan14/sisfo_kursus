<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Spatie\Activitylog\Models\Activity;

class DeleteOldActivityLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'activitylog:delete-old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete activity logs older than 30 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $date = Carbon::now()->subDays(30);
        $deletedRows = Activity::where('created_at', '<', $date)->delete();
        $this->info("$deletedRows old activity logs deleted.");
    }
}
