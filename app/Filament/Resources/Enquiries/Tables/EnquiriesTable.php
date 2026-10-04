<?php

namespace App\Filament\Resources\Enquiries\Tables;

use App\Enums\EnquiryStatus;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class EnquiriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('parent_name')
                    ->searchable()
                    ->sortable()
                    ->label('Parent'),

                TextColumn::make('student_name')
                    ->searchable()
                    ->label('Student'),

                TextColumn::make('phone')
                    ->copyable(),

                TextColumn::make('course.title')
                    ->label('Course')
                    ->limit(25),

                TextColumn::make('status')
                    ->badge(),

                TextColumn::make('source')
                    ->label('Lead Source')
                    ->badge()
                    ->color(fn (string $state): string => str_contains($state, 'Franchise') ? 'warning' : 'gray')
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->since()
                    ->sortable()
                    ->label('Received')
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(EnquiryStatus::class),

                SelectFilter::make('source')
                    ->label('Lead Source')
                    ->options([
                        'Franchise Enquiry Page' => 'Franchise Enquiry',
                        'Contact Page Form' => 'Contact Page Form',
                        'Quick Enquiry Modal' => 'Quick Enquiry Modal',
                        'Course Detail Page' => 'Course Detail Page',
                    ]),

                SelectFilter::make('course_id')
                    ->relationship('course', 'title')
                    ->label('Course'),

                SelectFilter::make('assigned_to')
                    ->relationship('assignedUser', 'name')
                    ->label('Assigned To'),
            ])
            ->defaultSort('created_at', 'desc')
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
