<?php

namespace App\Console\Commands;

use App\Services\EventCertificateCleanupService;
use Illuminate\Console\Command;

class CleanExpiredEventCertificates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'events:clean-expired-certificates 
                            {--days=30 : Number of days after event conclusion to expire certificates} 
                            {--dry-run : Preview certificates to be deleted without removing files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically delete participant certificate PDFs and records for completed events older than 30 days to free up disk storage';

    /**
     * Execute the console command.
     */
    public function handle(EventCertificateCleanupService $cleanupService): int
    {
        $days = (int) $this->option('days') ?: 30;
        $dryRun = (bool) $this->option('dry-run');

        $this->info("Scanning for participant certificates in completed events older than {$days} days...");

        if ($dryRun) {
            $this->warn('Running in DRY-RUN mode. No files or database records will be deleted.');
        }

        $result = $cleanupService->cleanExpired($days, $dryRun);

        if ($result['deleted_count'] === 0) {
            $this->info("No expired certificates found older than {$days} days. Server storage is clean!");

            return Command::SUCCESS;
        }

        if ($dryRun) {
            $this->warn("DRY RUN: Found {$result['deleted_count']} expired certificate(s) that would be deleted, freeing approx. {$result['freed_formatted']} of storage space.");
        } else {
            $this->info("SUCCESS: Permanently removed {$result['deleted_count']} expired certificate(s) and freed {$result['freed_formatted']} of disk storage.");
        }

        return Command::SUCCESS;
    }
}
