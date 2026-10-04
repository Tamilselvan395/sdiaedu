<?php

namespace App\Filament\Resources\Batches\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class BatchForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('course_id')
                    ->required()
                    ->numeric(),
                TextInput::make('teacher_id')
                    ->numeric(),
                TextInput::make('name')
                    ->required(),
                DatePicker::make('start_date'),
                DatePicker::make('end_date'),
                TimePicker::make('start_time'),
                TimePicker::make('end_time'),
                Textarea::make('days')
                    ->columnSpanFull(),
                TextInput::make('capacity')
                    ->required()
                    ->numeric()
                    ->default(20),
                TextInput::make('mode')
                    ->required()
                    ->default('In-Person'),
                TextInput::make('location'),
                TextInput::make('status')
                    ->required()
                    ->default('Upcoming'),
            ]);
    }
}
