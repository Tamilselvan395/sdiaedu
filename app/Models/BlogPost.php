<?php

namespace App\Models;

use App\Enums\BlogPostStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'status' => BlogPostStatus::class,
            'published_at' => 'datetime',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected static function booted(): void
    {
        static::saving(function (self $post) {
            if (empty($post->slug) && ! empty($post->title)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    /**
     * Alias for category() — matches the with('blogCategory') eager-load in controllers.
     */
    public function blogCategory()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', BlogPostStatus::Published)
            ->where(function ($q) {
                $q->whereNull('published_at')->orWhere('published_at', '<=', now());
            });
    }

    public function getImageUrlAttribute(): ?string
    {
        if (! empty($this->og_image)) {
            return str_starts_with($this->og_image, 'http://') || str_starts_with($this->og_image, 'https://')
                ? $this->og_image
                : asset('storage/'.$this->og_image);
        }

        if (! empty($this->featured_image)) {
            return str_starts_with($this->featured_image, 'http://') || str_starts_with($this->featured_image, 'https://')
                ? $this->featured_image
                : asset('storage/'.$this->featured_image);
        }

        return null;
    }
}
