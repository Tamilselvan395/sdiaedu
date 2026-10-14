<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventCertificate extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'issue_date' => 'date',
            'is_published' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (self $certificate) {
            if (empty($certificate->certificate_number)) {
                $year = date('Y');
                $random = strtoupper(substr(uniqid(), -5));
                $certificate->certificate_number = "SDIA-EVT-{$year}-{$random}";
            }
        });
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function getFileUrlAttribute(): string
    {
        if (empty($this->certificate_file)) {
            return '';
        }

        if (str_starts_with($this->certificate_file, 'http://') || str_starts_with($this->certificate_file, 'https://')) {
            return $this->certificate_file;
        }

        return asset('storage/'.$this->certificate_file);
    }

    public function getDownloadUrlAttribute(): string
    {
        if ($this->event) {
            return route('events.certificates.download', [
                'event' => $this->event->slug,
                'certificate' => $this->id,
            ]);
        }

        return $this->file_url;
    }

    public function isPdf(): bool
    {
        return str_ends_with(strtolower($this->certificate_file ?? ''), '.pdf');
    }
}
