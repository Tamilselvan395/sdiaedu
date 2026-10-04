<?php

namespace App\Filament\Resources\Enquiries\Schemas;

use App\Enums\CourseMode;
use App\Enums\EnquiryStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EnquiryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Lead Information')->schema([
                    Grid::make(2)->schema([
                        TextInput::make('parent_name')
                            ->required()
                            ->label('Parent / Guardian Name'),

                        TextInput::make('student_name')
                            ->required()
                            ->label('Student Name'),

                        TextInput::make('phone')
                            ->required()
                            ->tel(),

                        TextInput::make('email')
                            ->email(),

                        TextInput::make('student_age')
                            ->numeric()
                            ->label('Student Age'),

                        Select::make('course_id')
                            ->relationship('course', 'title')
                            ->searchable()
                            ->label('Interested Course'),

                        Select::make('mode_preference')
                            ->options(CourseMode::class)
                            ->label('Mode Preference'),

                        Select::make('status')
                            ->options(EnquiryStatus::class)
                            ->required()
                            ->default('new'),

                        Select::make('assigned_to')
                            ->relationship('assignedUser', 'name')
                            ->searchable()
                            ->label('Assigned To')
                            ->nullable(),

                        TextInput::make('source')
                            ->label('Lead Source')
                            ->placeholder('website, walk-in, referral'),
                    ]),

                    Textarea::make('notes')
                        ->rows(3)
                        ->columnSpanFull(),
                ]),

                Section::make('Campaign & Attribution Tracking')
                    ->collapsed()
                    ->schema([
                        Grid::make(3)->schema([
                            TextInput::make('utm_source')->label('UTM Source')->disabled(),
                            TextInput::make('utm_medium')->label('UTM Medium')->disabled(),
                            TextInput::make('utm_campaign')->label('UTM Campaign')->disabled(),
                            TextInput::make('utm_term')->label('UTM Term / Keyword')->disabled(),
                            TextInput::make('utm_content')->label('UTM Content')->disabled(),
                            TextInput::make('gclid')->label('Google Click ID (GCLID)')->disabled(),
                            TextInput::make('fbclid')->label('Meta Click ID (FBCLID)')->disabled(),
                            TextInput::make('msclkid')->label('Bing Click ID (MSCLKID)')->disabled(),
                        ]),
                        Grid::make(2)->schema([
                            TextInput::make('landing_page')->label('Landing Page URL')->disabled(),
                            TextInput::make('referrer')->label('Original Referrer')->disabled(),
                        ]),
                    ]),

                Section::make('Follow-ups')->schema([
                    Repeater::make('followUps')
                        ->relationship()
                        ->schema([
                            DateTimePicker::make('scheduled_at')
                                ->required()
                                ->label('Scheduled At'),

                            Select::make('type')
                                ->options([
                                    'call' => 'Call',
                                    'whatsapp' => 'WhatsApp',
                                    'email' => 'Email',
                                    'visit' => 'Visit',
                                ]),

                            Textarea::make('notes')
                                ->rows(2),

                            DateTimePicker::make('completed_at')
                                ->label('Completed At'),
                        ])
                        ->columns(2),
                ]),
            ]);
    }
}
