<?php

namespace App\Filament\Resources\Teachers\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TeacherForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->numeric(),
                TextInput::make('first_name')
                    ->required(),
                TextInput::make('last_name'),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                TextInput::make('phone')
                    ->tel(),
                Textarea::make('bio')
                    ->columnSpanFull(),
                TextInput::make('photo'),
                Textarea::make('specializations')
                    ->columnSpanFull(),
                TextInput::make('status')
                    ->required()
                    ->default('Active'),
            ]);
    }
}
