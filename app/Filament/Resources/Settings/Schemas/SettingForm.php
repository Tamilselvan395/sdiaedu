<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Setting')->schema([
                    TextInput::make('key')
                        ->required()
                        ->label('Setting Key')
                        ->placeholder('e.g. site_name'),

                    Textarea::make('value')
                        ->rows(3)
                        ->required()
                        ->label('Value'),

                    TextInput::make('group')
                        ->label('Group')
                        ->placeholder('general, contact, social, seo'),

                    Textarea::make('description')
                        ->rows(2)
                        ->label('Description / Help Text'),
                ]),
            ]);
    }
}
