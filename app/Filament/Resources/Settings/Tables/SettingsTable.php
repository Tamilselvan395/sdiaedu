<?php

namespace App\Filament\Resources\Settings\Tables;

use App\Models\Setting;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')
                    ->searchable()
                    ->sortable()
                    ->copyable(),

                TextColumn::make('group')
                    ->badge()
                    ->sortable(),

                TextColumn::make('value')
                    ->limit(60)
                    ->searchable()
                    ->label('Value'),

                TextColumn::make('description')
                    ->limit(60)
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('group')
                    ->options(fn () => Setting::query()
                        ->select('group')
                        ->whereNotNull('group')
                        ->distinct()
                        ->pluck('group', 'group')
                        ->toArray()
                    ),
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
