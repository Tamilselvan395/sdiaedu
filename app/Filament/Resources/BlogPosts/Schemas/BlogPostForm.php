<?php

namespace App\Filament\Resources\BlogPosts\Schemas;

use App\Enums\BlogPostStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BlogPostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make()->tabs([

                    Tab::make('Content')->schema([
                        Grid::make(2)->schema([
                            TextInput::make('title')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn (Set $set, ?string $state) => $set(
                                    'slug',
                                    Str::slug($state ?? ''),
                                )),

                            TextInput::make('slug')
                                ->required(),

                            Select::make('blog_category_id')
                                ->relationship('blogCategory', 'name')
                                ->required()
                                ->label('Category'),

                            Select::make('author_id')
                                ->relationship('author', 'name')
                                ->label('Author'),
                        ]),

                        RichEditor::make('content')
                            ->required()
                            ->columnSpanFull(),

                        Textarea::make('excerpt')
                            ->rows(3)
                            ->label('Excerpt / Summary')
                            ->columnSpanFull(),
                    ]),

                    Tab::make('Publishing')->schema([
                        Grid::make(2)->schema([
                            Select::make('status')
                                ->options(BlogPostStatus::class)
                                ->required()
                                ->default(BlogPostStatus::Draft->value),

                            DateTimePicker::make('published_at')
                                ->label('Publish Date'),
                        ]),
                    ]),

                    Tab::make('Media')->schema([
                        FileUpload::make('featured_image')
                            ->image()
                            ->directory('blog')
                            ->asWebp()
                            ->columnSpanFull(),
                    ]),

                    Tab::make('SEO')->schema([
                        TextInput::make('meta_title'),
                        Textarea::make('meta_description')->rows(3),
                        TextInput::make('meta_keywords'),
                    ]),

                ])->columnSpanFull(),
            ]);
    }
}
