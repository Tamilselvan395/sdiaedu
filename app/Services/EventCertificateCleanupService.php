<?php

namespace App\Services;

use App\Models\Event;
use App\Models\EventCertificate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EventCertificateCleanupService
{
    /**
     * Clean expired certificate records and physical files for completed events older than the given days.
     *
     * @return array{
     *     deleted_count: int,
     *     freed_bytes: int,
     *     freed_formatted: string,
     *     files: array<int, string>,
     *     is_dry_run: bool
     * }
     */
    public function cleanExpired(int $days = 30, bool $dryRun = false, ?Event $event = null): array
    {
        $query = $this->getExpiredQuery($days, $event);
        $certificates = $query->with('event')->get();

        $deletedCount = 0;
        $freedBytes = 0;
        $files = [];

        foreach ($certificates as $certificate) {
            $filePath = $certificate->certificate_file;
            $fileSize = 0;

            if (! empty($filePath) && ! str_starts_with($filePath, 'http://') && ! str_starts_with($filePath, 'https://')) {
                if (Storage::disk('public')->exists($filePath)) {
                    try {
                        $fileSize = (int) Storage::disk('public')->size($filePath);
                    } catch (\Throwable) {
                        $fileSize = 0;
                    }

                    if (! $dryRun) {
                        Storage::disk('public')->delete($filePath);
                    }
                } elseif (file_exists(public_path('storage/'.$filePath))) {
                    $fileSize = (int) @filesize(public_path('storage/'.$filePath));
                    if (! $dryRun) {
                        @unlink(public_path('storage/'.$filePath));
                    }
                }
            }

            $freedBytes += $fileSize;
            $files[] = (string) $filePath;
            $deletedCount++;

            if (! $dryRun) {
                $certificate->delete();
            }
        }

        $formatted = static::formatBytes($freedBytes);

        if (! $dryRun && $deletedCount > 0) {
            Log::info("Cleaned {$deletedCount} expired event certificate(s), freeing {$formatted} of storage space.", [
                'days' => $days,
                'event_id' => $event?->id,
            ]);
        }

        return [
            'deleted_count' => $deletedCount,
            'freed_bytes' => $freedBytes,
            'freed_formatted' => $formatted,
            'files' => $files,
            'is_dry_run' => $dryRun,
        ];
    }

    /**
     * Get Eloquent query for certificates eligible for deletion:
     * - Event must be completed (end_date or start_date <= now - $days)
     * - Certificate must be created at least $days ago
     */
    public function getExpiredQuery(int $days = 30, ?Event $event = null): Builder
    {
        $cutoff = now()->subDays($days);

        $query = EventCertificate::query()
            ->where('created_at', '<=', $cutoff);

        if ($event) {
            $query->where('event_id', $event->id)
                ->where(function (Builder $q) use ($cutoff) {
                    $q->where(function (Builder $sub) use ($cutoff) {
                        $sub->whereNotNull('end_date')
                            ->where('end_date', '<=', $cutoff);
                    })->orWhere(function (Builder $sub) use ($cutoff) {
                        $sub->whereNull('end_date')
                            ->whereNotNull('start_date')
                            ->where('start_date', '<=', $cutoff);
                    });
                });
        } else {
            $query->whereHas('event', function (Builder $q) use ($cutoff) {
                $q->where(function (Builder $sub) use ($cutoff) {
                    $sub->whereNotNull('end_date')
                        ->where('end_date', '<=', $cutoff);
                })->orWhere(function (Builder $sub) use ($cutoff) {
                    $sub->whereNull('end_date')
                        ->whereNotNull('start_date')
                        ->where('start_date', '<=', $cutoff);
                });
            });
        }

        return $query;
    }

    /**
     * Human-readable byte representation.
     */
    public static function formatBytes(int $bytes): string
    {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2).' GB';
        }
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2).' MB';
        }
        if ($bytes >= 1024) {
            return number_format($bytes / 1024, 2).' KB';
        }

        return $bytes.' B';
    }
}
