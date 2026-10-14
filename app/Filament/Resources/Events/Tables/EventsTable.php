<?php

namespace App\Filament\Resources\Events\Tables;

use App\Models\Event;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class EventsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('banner_image')
                    ->label('Banner')
                    ->size(50)
                    ->rounded('lg'),

                TextColumn::make('title')
                    ->label('Event Title')
                    ->searchable()
                    ->sortable()
                    ->limit(40),

                TextColumn::make('mode')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'In-Person' => 'primary',
                        'Live Online' => 'success',
                        'Hybrid' => 'warning',
                        default => 'gray',
                    }),

                TextColumn::make('start_date')
                    ->label('Date & Time')
                    ->dateTime('M d, Y h:i A')
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->state(function (Event $record): string {
                        if ($record->is_completed) {
                            return 'Completed';
                        }
                        if ($record->start_date <= now() && (! $record->end_date || $record->end_date >= now())) {
                            return 'Live Now';
                        }

                        return 'Upcoming';
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'Live Now' => 'danger',
                        'Upcoming' => 'success',
                        'Completed' => 'gray',
                        default => 'gray',
                    }),

                IconColumn::make('show_popup')
                    ->label('Popup Enabled')
                    ->boolean()
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Published')
                    ->boolean()
                    ->sortable(),

                TextColumn::make('registration_fee')
                    ->label('Fee')
                    ->formatStateUsing(fn ($state) => $state > 0 ? '₹'.number_format($state) : 'Free')
                    ->sortable(),

                TextColumn::make('certificates_count')
                    ->counts('certificates')
                    ->badge()
                    ->color('info')
                    ->label('Certificates')
                    ->sortable(),
            ])
            ->defaultSort('start_date', 'asc')
            ->filters([
                SelectFilter::make('mode')
                    ->options([
                        'In-Person' => 'In-Person',
                        'Live Online' => 'Live Online',
                        'Hybrid' => 'Hybrid',
                    ]),

                Filter::make('upcoming')
                    ->label('Upcoming Events Only')
                    ->query(fn (Builder $query): Builder => $query->where('end_date', '>=', now())->orWhere(function ($q) {
                        $q->whereNull('end_date')->where('start_date', '>=', now());
                    })),

                Filter::make('completed')
                    ->label('Completed Events Only')
                    ->query(fn (Builder $query): Builder => $query->where('end_date', '<', now())),

                TernaryFilter::make('show_popup')
                    ->label('Popup Eligible'),

                TernaryFilter::make('is_active')
                    ->label('Active Status'),
            ])
            ->recordActions([
                Action::make('view_live')
                    ->label('View')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->url(fn (Event $record): string => route('events.show', $record->slug))
                    ->openUrlInNewTab(),
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
