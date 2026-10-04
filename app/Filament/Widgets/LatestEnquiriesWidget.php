<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Enquiries\EnquiryResource;
use App\Models\Enquiry;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestEnquiriesWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Enquiry::query()->latest()->limit(10)
            )
            ->columns([
                TextColumn::make('parent_name')
                    ->label('Parent')
                    ->searchable(),

                TextColumn::make('student_name')
                    ->label('Student'),

                TextColumn::make('phone')
                    ->copyable(),

                TextColumn::make('course.title')
                    ->label('Course')
                    ->limit(25),

                TextColumn::make('status')
                    ->badge(),

                TextColumn::make('created_at')
                    ->since()
                    ->label('Received'),
            ])
            ->heading('Latest Enquiries')
            ->recordUrl(
                fn (Enquiry $record): string => EnquiryResource::getUrl('edit', ['record' => $record])
            );
    }
}
