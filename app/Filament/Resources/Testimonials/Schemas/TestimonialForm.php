<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)->schema([
                    TextInput::make('name')
                        ->required()
                        ->label('Student / Parent Name'),

                    TextInput::make('role')
                        ->placeholder('Student, Parent of...'),

                    TextInput::make('course')
                        ->label('Course Taken'),

                    TextInput::make('rating')
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(5)
                        ->default(5),
                ]),

                Textarea::make('content')
                    ->required()
                    ->rows(5)
                    ->label('Testimonial Text')
                    ->columnSpanFull(),

                FileUpload::make('photo')
                    ->image()
                    ->directory('testimonials')
                    ->asWebp()
                    ->label('Photo'),

                Grid::make(2)->schema([
                    Toggle::make('is_published')
                        ->label('Published'),

                    Toggle::make('is_featured')
                        ->label('Featured on Homepage'),
                ]),
            ]);
    }
}
