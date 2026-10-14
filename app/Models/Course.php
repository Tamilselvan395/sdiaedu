<?php

namespace App\Models;

use App\Enums\CourseAudience;
use App\Enums\CourseMode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'target_audience' => CourseAudience::class,
            'curriculum' => 'array',
            'learning_outcomes' => 'array',
            'who_is_for' => 'array',
            'why_choose' => 'array',
            'what_students_gain' => 'array',
            'has_teacher_training' => 'boolean',
            'teacher_training_highlights' => 'array',
            'institution_highlights' => 'array',
            'guarantee_checklist' => 'array',
            'certificate_available' => 'boolean',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
            'age_min' => 'integer',
            'age_max' => 'integer',
            'mode' => CourseMode::class,
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected static function booted(): void
    {
        static::saving(function (self $course) {
            if (empty($course->slug) && ! empty($course->title)) {
                $course->slug = Str::slug($course->title);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(CourseCategory::class, 'course_category_id');
    }

    public function modules()
    {
        return $this->hasMany(CourseModule::class)->orderBy('sort_order');
    }

    public function activeModules()
    {
        return $this->hasMany(CourseModule::class)->where('is_active', true)->orderBy('sort_order');
    }

    public function faqs()
    {
        return $this->hasMany(CourseFaq::class)->orderBy('sort_order');
    }

    public function activeFaqs()
    {
        return $this->hasMany(CourseFaq::class)->where('is_active', true)->orderBy('sort_order');
    }

    public function batches()
    {
        return $this->hasMany(Batch::class);
    }

    public function enquiries()
    {
        return $this->hasMany(Enquiry::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
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
        $aud = $this->target_audience instanceof CourseAudience ? $this->target_audience->value : (string) ($this->target_audience ?? 'student');

        return in_array($aud, ['student', 'both', '']);
    }

    public function isForTeachers(): bool
    {
        $aud = $this->target_audience instanceof CourseAudience ? $this->target_audience->value : (string) ($this->target_audience ?? '');

        return in_array($aud, ['teacher', 'both']);
    }

    public function getAgeRangeAttribute(): string
    {
        if ($this->age_min && $this->age_max) {
            return "{$this->age_min} - {$this->age_max} Years";
        } elseif ($this->age_min) {
            return "{$this->age_min}+ Years";
        }

        return 'All Age Groups';
    }

    public function getImageUrlAttribute(): string
    {
        if (! empty($this->thumbnail)) {
            return asset('storage/'.$this->thumbnail);
        }

        $extensions = ['png', 'jpg', 'jpeg', 'webp', 'svg'];
        foreach ($extensions as $ext) {
            $path = 'images/courses/'.$this->slug.'.'.$ext;
            if (file_exists(public_path($path))) {
                return asset($path);
            }
        }

        $aliasMap = [
            'abacus' => 'abacus.png',
            'robotics' => 'robotics.png',
            'chess' => 'chess.png',
            'yoga' => 'yoga.png',
            'gymnastics' => 'gymnastics.png',
            'vedic-maths' => 'vedic-maths.svg',
            'phonics' => 'phonics.svg',
            'spellbee' => 'spellbee.svg',
            'handwriting' => 'handwriting.svg',
            'calligraphy' => 'calligraphy.svg',
            'rubiks-cube' => 'rubiks-cube.svg',
            'rubiks' => 'rubiks-cube.svg',
            'drawing' => 'drawing.svg',
            'painting-and-colouring' => 'painting-and-colouring.svg',
            'painting' => 'painting-and-colouring.svg',
            'pencil-art' => 'pencil-art.svg',
            'art-and-craft' => 'art-and-craft.svg',
            'zumba' => 'zumba.svg',
            'm3-analytical' => 'm3-analytical.svg',
            'personality-development' => 'personality-development.svg',
            'spoken-english' => 'spoken-english.svg',
            'spoken-hindi' => 'spoken-hindi.svg',
            'web-designing' => 'web-designing.svg',
            'social-media-marketing' => 'social-media-marketing.svg',
            'western-and-folk-dance' => 'western-and-folk-dance.svg',
            'international-montessori' => 'international-montessori.svg',
            'beautician' => 'beautician.svg',
            'mba-plus-qsr' => 'mba-plus-qsr.svg',
        ];

        if (isset($aliasMap[$this->slug]) && file_exists(public_path('images/courses/'.$aliasMap[$this->slug]))) {
            return asset('images/courses/'.$aliasMap[$this->slug]);
        }

        // Check if slug contains key from aliasMap
        foreach ($aliasMap as $key => $file) {
            if (str_contains($this->slug, $key) && file_exists(public_path('images/courses/'.$file))) {
                return asset('images/courses/'.$file);
            }
        }

        if (file_exists(public_path('images/courses/default.svg'))) {
            return asset('images/courses/default.svg');
        }

        return $this->category?->image_url ?? asset('images/categories/default.jpg');
    }

    public function getIconClassAttribute(): string
    {
        $slug = $this->slug;

        return match (true) {
            str_contains($slug, 'abacus') => 'fa-solid fa-calculator',
            str_contains($slug, 'vedic') || str_contains($slug, 'math') => 'fa-solid fa-square-root-variable',
            str_contains($slug, 'mid-brain') => 'fa-solid fa-brain',
            str_contains($slug, 'quantum') || str_contains($slug, 'speed-reading') => 'fa-solid fa-bolt',
            str_contains($slug, 'robot') || str_contains($slug, 'ai') => 'fa-solid fa-robot',
            str_contains($slug, 'chess') => 'fa-solid fa-chess-knight',
            str_contains($slug, 'karate') => 'fa-solid fa-hand-fist',
            str_contains($slug, 'silambam') => 'fa-solid fa-shield-halved',
            str_contains($slug, 'carrom') => 'fa-solid fa-circle-dot',
            str_contains($slug, 'dart') => 'fa-solid fa-bullseye',
            str_contains($slug, 'keyboard') => 'fa-solid fa-keyboard',
            str_contains($slug, 'carnatic') => 'fa-solid fa-microphone-lines',
            str_contains($slug, 'classical-dance') => 'fa-solid fa-person-walking',
            str_contains($slug, 'yoga') => 'fa-solid fa-spa',
            str_contains($slug, 'gymnastic') || str_contains($slug, 'fitness') => 'fa-solid fa-person-running',
            str_contains($slug, 'phonics') || str_contains($slug, 'jolly') => 'fa-solid fa-spell-check',
            str_contains($slug, 'spell') => 'fa-solid fa-book-open-reader',
            str_contains($slug, 'handwriting') => 'fa-solid fa-pen-nib',
            str_contains($slug, 'calligraphy') => 'fa-solid fa-feather-pointed',
            str_contains($slug, 'rubik') || str_contains($slug, 'cube') => 'fa-solid fa-cube',
            str_contains($slug, 'draw') => 'fa-solid fa-palette',
            str_contains($slug, 'paint') => 'fa-solid fa-paintbrush',
            str_contains($slug, 'pencil') => 'fa-solid fa-pencil',
            str_contains($slug, 'craft') || str_contains($slug, 'art') => 'fa-solid fa-scissors',
            str_contains($slug, 'zumba') => 'fa-solid fa-heart-pulse',
            str_contains($slug, 'dance') => 'fa-solid fa-music',
            str_contains($slug, 'analytical') || str_contains($slug, 'm3') => 'fa-solid fa-brain',
            str_contains($slug, 'personality') || str_contains($slug, 'public-speaking') => 'fa-solid fa-bullhorn',
            str_contains($slug, 'english') => 'fa-solid fa-language',
            str_contains($slug, 'hindi') || str_contains($slug, 'saba') => 'fa-solid fa-comments',
            str_contains($slug, 'web') || str_contains($slug, 'code') || str_contains($slug, 'program') => 'fa-solid fa-laptop-code',
            str_contains($slug, 'marketing') || str_contains($slug, 'social') => 'fa-solid fa-chart-line',
            str_contains($slug, 'montessori') => 'fa-solid fa-shapes',
            str_contains($slug, 'beautician') || str_contains($slug, 'beauty') => 'fa-solid fa-wand-magic-sparkles',
            str_contains($slug, 'mba') || str_contains($slug, 'business') || str_contains($slug, 'qsr') => 'fa-solid fa-briefcase',
            default => 'fa-solid fa-graduation-cap',
        };
    }
}
