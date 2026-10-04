<?php

namespace App\Filament\Resources\CourseCategories\Schemas;

use App\Models\CourseCategory;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
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
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Str;

class CourseCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Course Category Details')->tabs([

                    // Tab 1: General Details & Publishing
                    Tab::make('Category Details')
                        ->icon(Heroicon::OutlinedInformationCircle)
                        ->schema([
                            Section::make('General Information')
                                ->description('Primary category title, public URL slug, and domain description.')
                                ->schema([
                                    Grid::make(2)->schema([
                                        TextInput::make('name')
                                            ->label('Category Name')
                                            ->required()
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set(
                                                'slug',
                                                Str::slug($state ?? ''),
                                            ))
                                            ->placeholder('e.g. Music & Dance'),

                                        TextInput::make('slug')
                                            ->label('URL Slug')
                                            ->required()
                                            ->maxLength(255)
                                            ->prefix('courses/category/')
                                            ->helperText('Determines the web address for this course domain.'),
                                    ]),

                                    Textarea::make('description')
                                        ->label('Domain Overview & Description')
                                        ->rows(4)
                                        ->placeholder('Describe the scope of this domain, its disciplines, and value to students...')
                                        ->helperText('Displayed at the top of the category landing page and within domain showcase cards.')
                                        ->columnSpanFull(),
                                ]),

                            Section::make('Publishing & Visibility')
                                ->description('Control visibility and ordering on the public website.')
                                ->schema([
                                    Grid::make(2)->schema([
                                        Toggle::make('is_active')
                                            ->label('Active / Published')
                                            ->default(true)
                                            ->helperText('Enable to display in website navigation, footer, and catalog filters.'),

                                        TextInput::make('sort_order')
                                            ->label('Display Order')
                                            ->numeric()
                                            ->default(0)
                                            ->helperText('Lower numbers appear first in the header menus and homepage tabs.'),
                                    ]),
                                ]),
                        ]),

                    // Tab 2: Media & Hero Showcase
                    Tab::make('Media & Banner')
                        ->icon(Heroicon::OutlinedPhoto)
                        ->schema([
                            Section::make('Category Media & Showcase Banner')
                                ->description('Card preview image and top hero banner displayed on the website.')
                                ->schema([
                                    FileUpload::make('hero_image')
                                        ->label('Card & Banner Image')
                                        ->image()
                                        ->directory('categories')
                                        ->asWebp()
                                        ->imageEditor()
                                        ->helperText('Recommended size: 1200 x 630 px. Formats: JPG, PNG, WebP. Automatically converted to optimized WebP.')
                                        ->columnSpanFull(),
                                ]),
                        ]),

                    // Tab 3: Branding & Appearance
                    Tab::make('Branding & Appearance')
                        ->icon(Heroicon::OutlinedSwatch)
                        ->schema([
                            Section::make('Visual Styling')
                                ->description('Theme accent colors and iconography used across cards and badges.')
                                ->schema([
                                    Grid::make(2)->schema([
                                        Select::make('color')
                                            ->label('Theme Accent Color')
                                            ->options([
                                                'amber' => 'Amber (Warm Gold / Orange)',
                                                'purple' => 'Purple (Deep Violet)',
                                                'pink' => 'Pink (Rose / Magenta)',
                                                'emerald' => 'Emerald (Vibrant Green)',
                                                'blue' => 'Blue (Classic Ocean)',
                                                'indigo' => 'Indigo (Royal Navy)',
                                                'teal' => 'Teal (Cyan / Mint)',
                                                'orange' => 'Orange (Warm Sunshine)',
                                                'red' => 'Red (Coral / Crimson)',
                                                'cyan' => 'Cyan (Sky Blue)',
                                            ])
                                            ->searchable()
                                            ->preload()
                                            ->helperText('Controls accent highlights, badges, and icon background gradients.'),

                                        TextInput::make('icon')
                                            ->label('Font Awesome Icon')
                                            ->placeholder('fa-solid fa-music')
                                            ->helperText('Icon class for cards and menus.')
                                            ->datalist([
                                                'fa-solid fa-music',
                                                'fa-solid fa-brain',
                                                'fa-solid fa-palette',
                                                'fa-solid fa-person-running',
                                                'fa-solid fa-language',
                                                'fa-solid fa-laptop-code',
                                                'fa-solid fa-shapes',
                                                'fa-solid fa-graduation-cap',
                                                'fa-solid fa-guitar',
                                                'fa-solid fa-calculator',
                                                'fa-solid fa-sparkles',
                                                'fa-solid fa-icons',
                                            ]),
                                    ]),
                                ]),

                            Section::make('Category Statistics')
                                ->schema([
                                    Grid::make(2)->schema([
                                        Placeholder::make('courses_count')
                                            ->label('Enrolled Courses')
                                            ->content(fn (?CourseCategory $record): string => $record ? "{$record->courses()->count()} course(s) linked" : '0'),

                                        Placeholder::make('updated_at')
                                            ->label('Last Updated')
                                            ->content(fn (?CourseCategory $record): string => $record?->updated_at ? $record->updated_at->diffForHumans() : '—'),
                                    ]),
                                ])
                                ->hidden(fn (?CourseCategory $record) => $record === null),
                        ]),

                    // Tab 4: SEO & Metadata
                    Tab::make('SEO & Metadata')
                        ->icon(Heroicon::OutlinedGlobeAlt)
                        ->schema([
                            Section::make('Search Engine Optimization (SEO)')
                                ->description('Optimize category title and description for Google search rankings and social share snippets.')
                                ->schema([
                                    TextInput::make('meta_title')
                                        ->label('SEO Meta Title')
                                        ->placeholder('e.g. Music & Dance Academy in Chennai | Sri Deekshaa International Academy')
                                        ->maxLength(255)
                                        ->helperText('Recommended: 50–60 characters. Appears as the headline title in search engine results.')
                                        ->columnSpanFull(),

                                    Textarea::make('meta_description')
                                        ->label('SEO Meta Description')
                                        ->rows(3)
                                        ->maxLength(500)
                                        ->placeholder('e.g. Explore accredited vocal music, electronic keyboard, and Bharatanatyam dance classes for kids & teens at Sri Deekshaa International Academy.')
                                        ->helperText('Recommended: 120–160 characters. Appears as the descriptive snippet below the title in search engines.')
                                        ->columnSpanFull(),
                                ]),
                        ]),

                ])->columnSpanFull(),
            ]);
    }
}
