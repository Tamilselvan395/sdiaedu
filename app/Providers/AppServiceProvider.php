<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Event;
use App\Models\Setting;
use App\Services\ImageUploadService;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        FileUpload::macro('asWebp', function () {
            return ImageUploadService::configure($this);
        });

        ImageColumn::configureUsing(function (ImageColumn $column): void {
            $column->disk('public');
        });

        View::composer('*', function ($view) {
            try {
                $settings = Cache::remember('global_settings', 3600, function () {
                    return Setting::pluck('value', 'key')->all();
                });

                $navStudentCategories = Cache::remember('app_nav_student_categories_v3', 3600, function () {
                    return CourseCategory::where('is_active', true)
                        ->whereIn('target_audience', ['student', 'both'])
                        ->orderBy('sort_order')
                        ->with(['courses' => fn ($q) => $q->where('is_active', true)->whereIn('target_audience', ['student', 'both'])->orderBy('sort_order')->select('id', 'course_category_id', 'title', 'slug', 'mode', 'duration', 'sort_order')])
                        ->get(['id', 'name', 'slug', 'icon', 'color', 'target_audience'])
                        ->map(fn ($cat) => [
                            'id' => $cat->id,
                            'name' => $cat->name,
                            'slug' => $cat->slug,
                            'icon' => $cat->display_icon,
                            'color' => $cat->color,
                            'active_courses_count' => $cat->courses->count(),
                            'courses' => $cat->courses->map(fn ($c) => [
                                'id' => $c->id,
                                'title' => $c->title,
                                'slug' => $c->slug,
                                'icon_class' => $c->icon_class,
                            ])->toArray(),
                        ])
                        ->filter(fn ($cat) => count($cat['courses']) > 0)
                        ->values()
                        ->toArray();
                });

                $navTeacherCourses = Cache::remember('app_nav_teacher_courses_v3', 3600, function () {
                    return Course::where('is_active', true)
                        ->whereIn('target_audience', ['teacher', 'both'])
                        ->orderBy('sort_order')
                        ->with('category:id,name,slug,color')
                        ->get(['id', 'course_category_id', 'title', 'slug', 'short_description', 'duration', 'mode'])
                        ->map(fn ($c) => [
                            'id' => $c->id,
                            'title' => $c->title,
                            'slug' => $c->slug,
                            'icon_class' => $c->icon_class,
                            'image_url' => $c->image_url,
                            'duration' => $c->duration,
                            'short_description' => $c->short_description,
                            'category_name' => $c->category?->name,
                        ])
                        ->toArray();
                });

                $navTeacherCategories = Cache::remember('app_nav_teacher_categories_v3', 3600, function () {
                    return CourseCategory::where('is_active', true)
                        ->whereIn('target_audience', ['teacher', 'both'])
                        ->orderBy('sort_order')
                        ->with(['courses' => fn ($q) => $q->where('is_active', true)->whereIn('target_audience', ['teacher', 'both'])->orderBy('sort_order')->select('id', 'course_category_id', 'title', 'slug', 'mode', 'duration', 'sort_order')])
                        ->get(['id', 'name', 'slug', 'icon', 'color', 'target_audience'])
                        ->map(fn ($cat) => [
                            'id' => $cat->id,
                            'name' => $cat->name,
                            'slug' => $cat->slug,
                            'icon' => $cat->display_icon,
                            'color' => $cat->color,
                            'active_courses_count' => $cat->courses->count(),
                            'courses' => $cat->courses->map(fn ($c) => [
                                'id' => $c->id,
                                'title' => $c->title,
                                'slug' => $c->slug,
                                'icon_class' => $c->icon_class,
                            ])->toArray(),
                        ])
                        ->filter(fn ($cat) => count($cat['courses']) > 0)
                        ->values()
                        ->toArray();
                });

                if (! is_array($navStudentCategories)) {
                    $navStudentCategories = [];
                }

                if (! is_array($navTeacherCourses)) {
                    $navTeacherCourses = [];
                }

                if (! is_array($navTeacherCategories)) {
                    $navTeacherCategories = [];
                }

                $view->with([
                    'globalSettings' => $settings,
                    'navCategories' => $navStudentCategories,
                    'navStudentCategories' => $navStudentCategories,
                    'navTeacherCourses' => $navTeacherCourses,
                    'navTeacherCategories' => $navTeacherCategories,
                ]);
            } catch (\Throwable $e) {
                $view->with([
                    'globalSettings' => [],
                    'navCategories' => [],
                    'navStudentCategories' => [],
                    'navTeacherCourses' => [],
                    'navTeacherCategories' => [],
                ]);
            }
        });

        View::composer('components.layouts.app', function ($view) {
            try {
                $view->with('upcomingPopupEvent', Event::popupActive()->first());
            } catch (\Throwable $e) {
                $view->with('upcomingPopupEvent', null);
            }
        });
    }
}
