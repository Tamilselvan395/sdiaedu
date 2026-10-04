<?php

namespace App\Filament\Resources\Courses\Tables;

use App\Enums\CourseMode;
use App\Models\Course;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class CoursesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->disk('public')
                    ->square()
                    ->size(40)
                    ->defaultImageUrl(fn (Course $record): string => $record->image_url ?? asset('images/sdia.png')),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(40),

                TextColumn::make('short_code')
                    ->badge()
                    ->color('warning')
                    ->label('Cert Code')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('category.name')
                    ->badge()
                    ->label('Category'),

                TextColumn::make('mode')
                    ->badge(),

                TextColumn::make('duration')
                    ->sortable(),

                TextColumn::make('fee')
                    ->numeric()
                    ->prefix('₹')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),

                IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Featured'),

                TextColumn::make('created_at')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('course_category_id')
                    ->relationship('category', 'name')
                    ->label('Category'),

                SelectFilter::make('mode')
                    ->options(CourseMode::class),

                TernaryFilter::make('is_active')
                    ->label('Active'),

                TernaryFilter::make('is_featured')
                    ->label('Featured'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
