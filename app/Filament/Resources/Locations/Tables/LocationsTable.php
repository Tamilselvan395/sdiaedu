<?php

namespace App\Filament\Resources\Locations\Tables;

use App\Models\Location;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class LocationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Photo')
                    ->disk('public')
                    ->circular()
                    ->defaultImageUrl(asset('images/sdia.png')),

                TextColumn::make('name')
                    ->label('Center Name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn (Location $record): ?string => $record->address ? Str::limit($record->address, 40) : null),

                TextColumn::make('franchise_id')
                    ->label('Franchise ID')
                    ->badge()
                    ->color('success')
                    ->copyable()
                    ->searchable()
                    ->sortable()
                    ->placeholder('Not Assigned'),

                TextColumn::make('city')
                    ->label('City')
                    ->badge()
                    ->color('amber')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('state')
                    ->label('State')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('phone')
                    ->label('Phone')
                    ->copyable()
                    ->searchable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->copyable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Active Status'),

                SelectFilter::make('city')
                    ->label('City')
                    ->options(fn () => Location::query()->pluck('city', 'city')->filter()->unique()->all()),
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
