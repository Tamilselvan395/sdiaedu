<?php

namespace App\Filament\Resources\Locations\Schemas;

use App\Services\ImageUploadService;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Str;

class LocationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Franchise Center Details')->tabs([

                    // Tab 1: General Info
                    Tab::make('Center Information')
                        ->icon(Heroicon::OutlinedBuildingStorefront)
                        ->schema([
                            Section::make('Basic Details')
                                ->description('Name, public URL slug, city, and active publishing status.')
                                ->schema([
                                    Grid::make(2)->schema([
                                        TextInput::make('name')
                                            ->label('Franchise / Center Name')
                                            ->required()
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set(
                                                'slug',
                                                Str::slug($state ?? ''),
                                            ))
                                            ->placeholder('e.g. Chennai - Velachery Center'),

                                        TextInput::make('slug')
                                            ->label('URL Slug')
                                            ->required()
                                            ->maxLength(255)
                                            ->unique('locations', 'slug', ignoreRecord: true)
                                            ->placeholder('e.g. chennai-velachery-center'),
                                    ]),

                                    Grid::make(2)->schema([
                                        TextInput::make('franchise_id')
                                            ->label('Franchise Partner ID')
                                            ->maxLength(50)
                                            ->unique('locations', 'franchise_id', ignoreRecord: true)
                                            ->placeholder('e.g. SDIA-F-0013/2026')
                                            ->helperText('Official franchise identification code printed on the partner credential certificate.'),

                                        TextInput::make('partnership_year')
                                            ->label('Partnership Year')
                                            ->numeric()
                                            ->default(2026)
                                            ->helperText('Year when franchise partnership was established (e.g. 2026).'),
                                    ]),

                                    Grid::make(3)->schema([
                                        TextInput::make('city')
                                            ->label('City')
                                            ->required()
                                            ->maxLength(100)
                                            ->placeholder('e.g. Chennai'),

                                        TextInput::make('state')
                                            ->label('State')
                                            ->required()
                                            ->default('Tamil Nadu')
                                            ->maxLength(100),

                                        TextInput::make('sort_order')
                                            ->label('Display Order')
                                            ->numeric()
                                            ->default(0)
                                            ->helperText('Lower numbers appear first on the website.'),
                                    ]),

                                    Toggle::make('is_active')
                                        ->label('Active Center')
                                        ->helperText('Toggle whether this franchise center is publicly visible on the Franchise and Contact pages.')
                                        ->default(true),
                                ]),
                        ]),

                    // Tab 2: Contact & Address
                    Tab::make('Address & Contact')
                        ->icon(Heroicon::OutlinedMapPin)
                        ->schema([
                            Section::make('Location & Contact Details')
                                ->description('Full postal address and direct phone/email for parent and franchise enquiries.')
                                ->schema([
                                    Textarea::make('address')
                                        ->label('Complete Campus Address')
                                        ->rows(3)
                                        ->placeholder('e.g. Plot No. 15, 100 Feet Bypass Road, Velachery')
                                        ->columnSpanFull(),

                                    Grid::make(3)->schema([
                                        TextInput::make('pincode')
                                            ->label('Pincode / ZIP')
                                            ->maxLength(20)
                                            ->placeholder('e.g. 600042'),

                                        TextInput::make('phone')
                                            ->label('Phone / WhatsApp Desk')
                                            ->tel()
                                            ->maxLength(50)
                                            ->placeholder('e.g. +91 98765 43210'),

                                        TextInput::make('email')
                                            ->label('Center Contact Email')
                                            ->email()
                                            ->maxLength(150)
                                            ->placeholder('e.g. velachery@srideekshaa.com'),
                                    ]),
                                ]),
                        ]),

                    // Tab 3: Media & Maps
                    Tab::make('Media & Maps')
                        ->icon(Heroicon::OutlinedPhoto)
                        ->schema([
                            Section::make('Franchise Partner Certificate')
                                ->description('Upload official partner certificate image for public credential verification.')
                                ->schema([
                                    ImageUploadService::configure(
                                        FileUpload::make('certificate_image')
                                            ->label('Official Franchise Certificate Image')
                                            ->directory('franchises/certificates')
                                            ->image()
                                    )->helperText('Upload the scanned or digital certificate of acknowledgement (JPEG, PNG, WebP). When searched on /franchise, this certificate is displayed above the contact number and address.'),
                                ]),

                            Section::make('Campus Visuals & Map')
                                ->description('Upload center facade/classroom photo and configure Google Maps embed.')
                                ->schema([
                                    ImageUploadService::configure(
                                        FileUpload::make('image')
                                            ->label('Center Photo / Building Image')
                                            ->directory('franchises')
                                            ->image()
                                    )->helperText('Upload a high-quality photo of the center exterior or classroom. Automatically optimized and converted to WebP.'),

                                    Textarea::make('map_embed_url')
                                        ->label('Google Maps Embed URL (or Iframe src)')
                                        ->rows(3)
                                        ->placeholder('https://maps.google.com/maps?q=Velachery+Chennai&t=&z=14&ie=UTF8&iwloc=&output=embed')
                                        ->helperText('If left blank, the website automatically builds an interactive Google Maps location based on the center name, address, and city.')
                                        ->columnSpanFull(),
                                ]),
                        ]),

                    // Tab 4: Overview & SEO
                    Tab::make('Overview & SEO')
                        ->icon(Heroicon::OutlinedDocumentText)
                        ->schema([
                            Section::make('Facility Features & Description')
                                ->schema([
                                    Textarea::make('description')
                                        ->label('Center Description & Facility Highlights')
                                        ->rows(4)
                                        ->placeholder('Describe cognitive abacus labs, art studios, robotics benches, safety measures, certified mentors, or parking facilities...')
                                        ->columnSpanFull(),
                                ]),

                            Section::make('Search Engine Optimization')
                                ->schema([
                                    TextInput::make('meta_title')
                                        ->label('SEO Meta Title')
                                        ->maxLength(70)
                                        ->placeholder('e.g. Sri Deekshaa Academy Velachery Center | Abacus & Vedic Maths'),

                                    Textarea::make('meta_description')
                                        ->label('SEO Meta Description')
                                        ->rows(3)
                                        ->maxLength(160)
                                        ->placeholder('e.g. Visit Sri Deekshaa International Academy in Velachery, Chennai for cognitive skills, robotics, art, and certified student programs.'),
                                ]),
                        ]),

                ])->columnSpanFull(),
            ]);
    }
}
