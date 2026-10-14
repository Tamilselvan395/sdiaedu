<?php

namespace App\Models;

use App\Enums\CourseAudience;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CourseCategory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'target_audience' => CourseAudience::class,
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected static function booted(): void
    {
        static::saving(function (self $category) {
            if (empty($category->slug) && ! empty($category->name)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    public function courses()
    {
        return $this->hasMany(Course::class)->orderBy('sort_order');
    }

    public function activeCourses()
    {
        return $this->hasMany(Course::class)->where('is_active', true)->orderBy('sort_order');
    }

    public function studentCourses()
    {
        return $this->hasMany(Course::class)->where('is_active', true)->whereIn('target_audience', ['student', 'both'])->orderBy('sort_order');
    }

    public function teacherCourses()
    {
        return $this->hasMany(Course::class)->where('is_active', true)->whereIn('target_audience', ['teacher', 'both'])->orderBy('sort_order');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeForStudents($query)
    {
        return $query->whereIn('target_audience', ['student', 'both']);
    }

    public function scopeForTeachers($query)
    {
        return $query->whereIn('target_audience', ['teacher', 'both']);
    }

    public function isForStudents(): bool
    {
        $aud = $this->target_audience instanceof CourseAudience ? $this->target_audience->value : (string) ($this->target_audience ?? 'both');

        return in_array($aud, ['student', 'both', '']);
    }

    public function isForTeachers(): bool
    {
        $aud = $this->target_audience instanceof CourseAudience ? $this->target_audience->value : (string) ($this->target_audience ?? 'both');

        return in_array($aud, ['teacher', 'both']);
    }

    public function getImageUrlAttribute(): string
    {
        if (! empty($this->hero_image)) {
            if (str_starts_with($this->hero_image, 'http://') || str_starts_with($this->hero_image, 'https://')) {
                return $this->hero_image;
            }

            if (! file_exists(storage_path('app/public/'.$this->hero_image)) && file_exists(storage_path('app/private/'.$this->hero_image))) {
                $dest = storage_path('app/public/'.$this->hero_image);
                @mkdir(dirname($dest), 0755, true);
                @copy(storage_path('app/private/'.$this->hero_image), $dest);
            }

            return asset('storage/'.$this->hero_image);
        }

        $localPath = 'images/categories/'.$this->slug.'.jpg';
        if (file_exists(public_path($localPath))) {
            return asset($localPath);
        }

        return match ($this->slug) {
            'brain-and-academic-excellence', 'academic-enrichment' => 'https://images.unsplash.com/photo-1596495578065-6e0763fa1178?auto=format&fit=crop&w=800&q=80',
            'arts-and-creativity', 'creative-arts' => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?auto=format&fit=crop&w=800&q=80',
            'music-and-dance' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?auto=format&fit=crop&w=800&q=80',
            'sports-and-fitness', 'fitness-and-performing-arts' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&w=800&q=80',
            'language-development', 'language-and-communication' => 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?auto=format&fit=crop&w=800&q=80',
            'digital-and-professional' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?auto=format&fit=crop&w=800&q=80',
            'early-education' => 'https://images.unsplash.com/photo-1587654780291-39c9404d746b?auto=format&fit=crop&w=800&q=80',
            default => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=800&q=80',
        };
    }

    public function getDisplayIconAttribute(): string
    {
        if (! empty($this->icon) && (str_starts_with($this->icon, 'fa-') || str_starts_with($this->icon, 'fas ') || str_starts_with($this->icon, 'fa '))) {
            return $this->icon;
        }

        return match ($this->slug) {
            'brain-and-academic-excellence', 'academic-enrichment' => 'fa-solid fa-brain',
            'arts-and-creativity', 'creative-arts' => 'fa-solid fa-palette',
            'music-and-dance' => 'fa-solid fa-music',
            'sports-and-fitness', 'fitness-and-performing-arts' => 'fa-solid fa-person-running',
            'language-development', 'language-and-communication' => 'fa-solid fa-language',
            'digital-and-professional' => 'fa-solid fa-laptop-code',
            'early-education' => 'fa-solid fa-shapes',
            default => 'fa-solid fa-graduation-cap',
        };
    }
}
