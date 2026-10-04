<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make()->tabs([

                    Tab::make('Event Details')->schema([
                        Grid::make(2)->schema([
                            TextInput::make('title')
                                ->label('Event Title')
                                ->required()
                                ->maxLength(255)
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn (Set $set, ?string $state) => $set(
                                    'slug',
                                    Str::slug($state ?? ''),
                                )),

                            TextInput::make('slug')
                                ->label('SEO Slug')
                                ->required()
                                ->unique(ignoreRecord: true),

                            Select::make('mode')
                                ->label('Event Mode')
                                ->options([
                                    'In-Person' => 'In-Person (Campus)',
                                    'Live Online' => 'Live Online (Webcast)',
                                    'Hybrid' => 'Hybrid (Campus + Online)',
                                ])
                                ->default('In-Person')
                                ->required(),

                            TextInput::make('location_name')
                                ->label('Venue / Platform Name')
                                ->placeholder('e.g. Main Auditorium, Chennai or Zoom Webcast')
                                ->maxLength(255),

                            TextInput::make('location_address')
                                ->label('Physical Address (Optional)')
                                ->placeholder('Campus address or Google Maps details')
                                ->columnSpanFull(),
                        ]),

                        Textarea::make('short_description')
                            ->label('Summary / Short Description (Shown in Popup & Cards)')
                            ->rows(3)
                            ->required()
                            ->columnSpanFull(),

                        RichEditor::make('description')
                            ->label('Full Event Details & Agenda')
                            ->columnSpanFull(),
                    ]),

                    Tab::make('Schedule & Registration')->schema([
                        Grid::make(2)->schema([
                            DateTimePicker::make('start_date')
                                ->label('Event Start Date & Time')
                                ->required()
                                ->native(false),

                            DateTimePicker::make('end_date')
                                ->label('Event End Date & Time')
                                ->helperText('After this time, the entrance popup modal automatically stops appearing.')
                                ->native(false),

                            TextInput::make('registration_fee')
                                ->label('Registration Fee (₹)')
                                ->numeric()
                                ->prefix('₹')
                                ->default(0.00)
                                ->helperText('Set 0 for Free events'),

                            TextInput::make('cta_button_text')
                                ->label('Button Text')
                                ->default('Register Now')
                                ->maxLength(50),

                            TextInput::make('registration_url')
                                ->label('External Registration Link (Optional)')
                                ->placeholder('https://forms.gle/... or leave empty for on-page modal enquiry')
                                ->url()
                                ->columnSpanFull(),
                        ]),
                    ]),

                    Tab::make('Media & Popup Display')->schema([
                        Grid::make(2)->schema([
                            FileUpload::make('banner_image')
                                ->label('Banner Image')
                                ->image()
                                ->directory('events')
                                ->asWebp()
                                ->imageCropAspectRatio('16:9')
                                ->helperText('Recommended aspect ratio: 16:9 or 4:3')
                                ->columnSpanFull(),

                            Section::make('Display Settings')->schema([
                                Toggle::make('show_popup')
                                    ->label('Show as Website Entrance Popup')
                                    ->helperText('When enabled, visitors will see this event modal upon landing on the website until the event date/end time completes.')
                                    ->default(true),

                                Toggle::make('is_active')
                                    ->label('Event is Published / Active')
                                    ->default(true),

                                TextInput::make('sort_order')
                                    ->label('Display Priority Sort Order')
                                    ->numeric()
                                    ->default(0),
                            ])->columnSpanFull(),
                        ]),
                    ]),

                    Tab::make('SEO')->schema([
                        TextInput::make('meta_title')
                            ->label('SEO Meta Title')
                            ->maxLength(70),

                        Textarea::make('meta_description')
                            ->label('SEO Meta Description')
                            ->rows(3)
                            ->maxLength(160),
                    ]),

                ])->columnSpanFull(),
            ]);
    }
}
