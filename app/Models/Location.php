<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Location extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getEffectiveMapUrlAttribute(): string
    {
        if (! empty($this->map_embed_url)) {
            return $this->map_embed_url;
        }

        $query = urlencode(trim($this->name.' '.($this->address ? $this->address.' ' : '').$this->city.' '.$this->state));

        return "https://maps.google.com/maps?q={$query}&t=&z=14&ie=UTF8&iwloc=&output=embed";
    }

    public function getDirectionsUrlAttribute(): string
    {
        $query = urlencode(trim($this->name.' '.($this->address ? $this->address.' ' : '').$this->city.' '.$this->state));

        return "https://maps.google.com/?q={$query}";
    }

    public function getImageUrlAttribute(): ?string
    {
        if (blank($this->image)) {
            return null;
        }

        return Storage::disk('public')->url($this->image);
    }

    public function getCertificateImageUrlAttribute(): ?string
    {
        if (! blank($this->certificate_image)) {
            return Storage::disk('public')->url($this->certificate_image);
        }

        if ($this->slug === 'jp-academy' || $this->franchise_id === 'SDIA-F-0013/2026') {
            return asset('images/franchise-partner-certificate.jpg');
        }

        return null;
    }
}
