<?php

namespace App\Providers;

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
                $navCategories = Cache::remember('app_nav_categories_v5', 3600, function () {
                    return CourseCategory::where('is_active', true)
                        ->orderBy('sort_order')
                        ->with(['activeCourses' => fn ($q) => $q->orderBy('sort_order')->select('id', 'course_category_id', 'title', 'slug', 'mode', 'duration', 'sort_order')])
                        ->withCount('activeCourses')
                        ->get(['id', 'name', 'slug', 'icon', 'color'])
                        ->map(fn ($cat) => [
                            'id' => $cat->id,
                            'name' => $cat->name,
                            'slug' => $cat->slug,
                            'icon' => $cat->display_icon,
                            'color' => $cat->color,
                            'active_courses_count' => (int) $cat->active_courses_count,
                            'courses' => $cat->activeCourses->map(fn ($c) => [
                                'id' => $c->id,
                                'title' => $c->title,
                                'slug' => $c->slug,
                                'icon_class' => $c->icon_class,
                            ])->toArray(),
                        ])
                        ->toArray();
                });

                if (! is_array($navCategories)) {
                    $navCategories = [];
                }

                $view->with([
                    'globalSettings' => $settings,
                    'navCategories' => $navCategories,
                ]);
            } catch (\Throwable $e) {
                $view->with([
                    'globalSettings' => [],
                    'navCategories' => [],
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
