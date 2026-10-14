<?php

namespace App\Filament\Resources\CourseCategories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class CourseCategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('slug')
                    ->searchable()
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('target_audience')
                    ->badge()
                    ->color(fn ($state): string => match ($state?->value ?? (string) $state) {
                        'teacher' => 'success',
                        'both' => 'info',
                        default => 'primary',
                    })
                    ->formatStateUsing(fn ($state): string => match ($state?->value ?? (string) $state) {
                        'teacher' => 'Teachers (TTC)',
                        'both' => 'Both (Student & Teacher)',
                        default => 'Students Only',
                    })
                    ->label('Target Track')
                    ->sortable(),

                TextColumn::make('student_courses_count')
                    ->counts(['courses as student_courses_count' => fn ($q) => $q->forStudents()])
                    ->badge()
                    ->color('primary')
                    ->label('Student Courses'),

                TextColumn::make('teacher_courses_count')
                    ->counts(['courses as teacher_courses_count' => fn ($q) => $q->forTeachers()])
                    ->badge()
                    ->color('success')
                    ->label('Teacher TTC'),

                TextColumn::make('courses_count')
                    ->counts('courses')
                    ->badge()
                    ->color('gray')
                    ->label('Total Courses')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('icon')
                    ->label('Icon')
                    ->toggleable(isToggledHiddenByDefault: true),

                IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),

                TextColumn::make('sort_order')
                    ->sortable()
                    ->label('Order'),

                TextColumn::make('created_at')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('target_audience')
                    ->options([
                        'student' => 'Students Only',
                        'teacher' => 'Teachers (TTC) Only',
                        'both' => 'Both (Students & Teachers)',
                    ])
                    ->label('Target Track'),

                TernaryFilter::make('is_active')
                    ->label('Active'),
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
