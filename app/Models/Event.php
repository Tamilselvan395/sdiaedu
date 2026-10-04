<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
            'registration_fee' => 'decimal:2',
            'is_active' => 'boolean',
            'show_popup' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected static function booted(): void
    {
        static::saving(function (self $event) {
            if (empty($event->slug) && ! empty($event->title)) {
                $event->slug = Str::slug($event->title);
            }

            // If end_date is null, default to 2 hours after start_date
            if (empty($event->end_date) && ! empty($event->start_date)) {
                $event->end_date = $event->start_date->copy()->addHours(2);
            }
        });
    }

    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('is_active', true)
            ->where(function (Builder $q) {
                $q->where('end_date', '>=', now())
                    ->orWhere(function (Builder $sub) {
                        $sub->whereNull('end_date')
                            ->where('start_date', '>=', now());
                    });
            })
            ->orderBy('start_date', 'asc');
    }

    public function scopePast(Builder $query): Builder
    {
        return $query->where('is_active', true)
            ->where(function (Builder $q) {
                $q->where('end_date', '<', now())
                    ->orWhere(function (Builder $sub) {
                        $sub->whereNull('end_date')
                            ->where('start_date', '<', now());
                    });
            })
            ->orderBy('start_date', 'desc');
    }

    public function scopePopupActive(Builder $query): Builder
    {
        return $query->where('is_active', true)
            ->where('show_popup', true)
            ->where(function (Builder $q) {
                $q->where('end_date', '>=', now())
                    ->orWhere(function (Builder $sub) {
                        $sub->whereNull('end_date')
                            ->where('start_date', '>=', now());
                    });
            })
            ->orderBy('start_date', 'asc');
    }

    public function getIsUpcomingAttribute(): bool
    {
        $compareDate = $this->end_date ?? $this->start_date;

        return $compareDate ? $compareDate->isFuture() : false;
    }

    public function getIsCompletedAttribute(): bool
    {
        $compareDate = $this->end_date ?? $this->start_date;

        return $compareDate ? $compareDate->isPast() : false;
    }

    public function getFormattedDateAttribute(): string
    {
        if (! $this->start_date) {
            return 'TBA';
        }

        if ($this->end_date && ! $this->start_date->isSameDay($this->end_date)) {
            return $this->start_date->format('M d').' - '.$this->end_date->format('M d, Y');
        }

        return $this->start_date->format('l, F d, Y');
    }

    public function getFormattedTimeAttribute(): string
    {
        if (! $this->start_date) {
            return 'Time TBA';
        }

        if ($this->end_date) {
            return $this->start_date->format('h:i A').' - '.$this->end_date->format('h:i A');
        }

        return $this->start_date->format('h:i A');
    }

    public function getBannerUrlAttribute(): string
    {
        if (! empty($this->banner_image)) {
            return asset('storage/'.$this->banner_image);
        }

        return 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=1200&q=80';
    }

    public function getImageUrlAttribute(): string
    {
        return $this->banner_url;
    }
}
