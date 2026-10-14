<?php

namespace App\Filament\Resources\Courses\Pages;

use App\Filament\Resources\Courses\CourseResource;
use App\Models\Course;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListCourses extends ListRecords
{
    protected static string $resource = CourseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Courses')
                ->badge(fn () => Course::count()),

            'students' => Tab::make('Student Courses')
                ->badge(fn () => Course::forStudents()->count())
                ->badgeColor('primary')
                ->modifyQueryUsing(fn (Builder $query) => $query->forStudents()),

            'teachers' => Tab::make('Teacher Training (TTC)')
                ->badge(fn () => Course::forTeachers()->count())
                ->badgeColor('success')
                ->modifyQueryUsing(fn (Builder $query) => $query->forTeachers()),
        ];
    }
}
