<?php

namespace App\Filament\Resources\CourseCategories\RelationManagers;

use App\Models\Course;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CoursesRelationManager extends RelationManager
{
    protected static string $relationship = 'courses';

    protected static ?string $title = 'Courses in this Category';

    protected static ?string $recordTitleAttribute = 'title';

    protected static bool $isLazy = false;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->defaultSort('sort_order', 'asc')
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->disk('public')
                    ->square()
                    ->size(38)
                    ->defaultImageUrl(fn (Course $record): string => $record->image_url ?? asset('images/sdia.png')),

                TextColumn::make('title')
                    ->label('Course Title')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold')
                    ->description(fn (Course $record): ?string => $record->short_description ? Str::limit($record->short_description, 60) : null),

                TextColumn::make('target_audience')
                    ->badge()
                    ->color(fn ($state): string => match ($state?->value ?? (string) $state) {
                        'teacher' => 'success',
                        'both' => 'info',
                        default => 'primary',
                    })
                    ->formatStateUsing(fn ($state): string => match ($state?->value ?? (string) $state) {
                        'teacher' => 'Teacher (TTC)',
                        'both' => 'Both Tracks',
                        default => 'Student Track',
                    })
                    ->label('Track')
                    ->sortable(),

                TextColumn::make('short_code')
                    ->badge()
                    ->color('warning')
                    ->label('Cert Code')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('mode')
                    ->badge()
                    ->label('Mode'),

                TextColumn::make('duration')
                    ->label('Duration')
                    ->sortable(),

                TextColumn::make('age_range')
                    ->label('Age Limit')
                    ->state(fn (Course $record): string => ($record->age_min || $record->age_max)
                        ? "{$record->age_min} to {$record->age_max} yrs"
                        : '—'
                    ),

                IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),

                TextColumn::make('sort_order')
                    ->numeric()
                    ->label('Order')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('target_audience')
                    ->options([
                        'student' => 'Student Track',
                        'teacher' => 'Teacher Training (TTC)',
                        'both' => 'Both Tracks',
                    ])
                    ->label('Track / Audience'),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Add Course')
                    ->url(fn (): string => route('filament.admin.resources.courses.create')),
                AssociateAction::make()
                    ->preloadRecordSelect(),
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Edit')
                    ->url(fn (Course $record): string => route('filament.admin.resources.courses.edit', ['record' => $record])),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
