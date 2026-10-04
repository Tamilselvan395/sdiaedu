<?php

namespace App\Filament\Resources\BlogPosts\Tables;

use App\Enums\BlogPostStatus;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class BlogPostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')
                    ->square()
                    ->size(40),

                TextColumn::make('title')
                    ->searchable()
                    ->limit(40)
                    ->sortable(),

                TextColumn::make('blogCategory.name')
                    ->badge()
                    ->label('Category'),

                TextColumn::make('status')
                    ->badge(),

                TextColumn::make('author.name')
                    ->label('Author'),

                TextColumn::make('published_at')
                    ->date()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(BlogPostStatus::class),

                SelectFilter::make('blog_category_id')
                    ->relationship('blogCategory', 'name')
                    ->label('Category'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
