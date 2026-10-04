<?php

namespace App\Filament\Resources\Faqs\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('question')
                    ->required()
                    ->columnSpanFull(),

                Textarea::make('answer')
                    ->required()
                    ->rows(5)
                    ->columnSpanFull(),

                Grid::make(2)->schema([
                    TextInput::make('sort_order')
                        ->numeric()
                        ->default(0),
                ]),

                Grid::make(2)->schema([
                    Toggle::make('is_active')
                        ->label('Active')
                        ->default(true),

                    Toggle::make('is_featured')
                        ->label('Show on Homepage'),
                ]),
            ]);
    }
}
