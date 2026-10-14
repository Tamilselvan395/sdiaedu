<?php

namespace App\Filament\Resources\CourseCategories\Pages;

use App\Filament\Resources\CourseCategories\CourseCategoryResource;
use App\Models\CourseCategory;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListCourseCategories extends ListRecords
{
    protected static string $resource = CourseCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Categories')
                ->badge(fn () => CourseCategory::count()),

            'students' => Tab::make('Student Categories')
                ->badge(fn () => CourseCategory::where(function ($query) {
                    $query->whereIn('target_audience', ['student', 'both'])
                        ->orWhereHas('courses', fn ($q) => $q->forStudents());
                })->count())
                ->badgeColor('primary')
                ->modifyQueryUsing(fn (Builder $query) => $query->where(function ($q) {
                    $q->whereIn('target_audience', ['student', 'both'])
                        ->orWhereHas('courses', fn ($sub) => $sub->forStudents());
                })),

            'teachers' => Tab::make('Teacher Training (TTC)')
                ->badge(fn () => CourseCategory::where(function ($query) {
                    $query->whereIn('target_audience', ['teacher', 'both'])
                        ->orWhereHas('courses', fn ($q) => $q->forTeachers());
                })->count())
                ->badgeColor('success')
                ->modifyQueryUsing(fn (Builder $query) => $query->where(function ($q) {
                    $q->whereIn('target_audience', ['teacher', 'both'])
                        ->orWhereHas('courses', fn ($sub) => $sub->forTeachers());
                })),
        ];
    }
}
