<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('student_code')
                    ->required(),
                TextInput::make('first_name')
                    ->required(),
                TextInput::make('last_name'),
                DatePicker::make('date_of_birth'),
                TextInput::make('gender'),
                TextInput::make('phone')
                    ->tel(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                Textarea::make('address')
                    ->columnSpanFull(),
                TextInput::make('city'),
                TextInput::make('state'),
                TextInput::make('country')
                    ->required()
                    ->default('India'),
                TextInput::make('profile_photo'),
                TextInput::make('status')
                    ->required()
                    ->default('Active'),
            ]);
    }
}
