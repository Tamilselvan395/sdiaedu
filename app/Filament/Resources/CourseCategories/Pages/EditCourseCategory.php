<?php

namespace App\Filament\Resources\CourseCategories\Pages;

use App\Filament\Resources\CourseCategories\CourseCategoryResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Icons\Heroicon;

class EditCourseCategory extends EditRecord
{
    protected static string $resource = CourseCategoryResource::class;

    public function getSubheading(): ?string
    {
        return "Configure domain details, branding accents, hero showcase, and linked courses for {$this->record->name}.";
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('view_category')
                ->label('View Public Page')
                ->icon(Heroicon::OutlinedArrowTopRightOnSquare)
                ->color('gray')
                ->url(fn (): string => route('courses.category', $this->record->slug))
                ->openUrlInNewTab(),
            DeleteAction::make(),
        ];
    }
}
