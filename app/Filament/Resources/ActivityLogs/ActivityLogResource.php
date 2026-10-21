<?php

namespace App\Filament\Resources\ActivityLogs;

use App\Enums\UserRole;
use App\Filament\Resources\ActivityLogs\Pages\ManageActivityLogs;
use App\Models\ActivityLog;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use UnitEnum;

class ActivityLogResource extends Resource
{
    protected static ?string $model = ActivityLog::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    protected static string|UnitEnum|null $navigationGroup = 'Developer Only';

    protected static ?string $navigationLabel = 'User Activity Logs';

    protected static ?int $navigationSort = 1;

    public static function canAccess(): bool
    {
        return (bool) auth()->user()?->isDeveloper();
    }

    public static function canViewAny(): bool
    {
        return (bool) auth()->user()?->isDeveloper();
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return (bool) auth()->user()?->isDeveloper();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('created_at')
                    ->label('Timestamp')
                    ->formatStateUsing(function ($state): string {
                        if (blank($state)) {
                            return '';
                        }

                        if ($state instanceof \DateTimeInterface) {
                            return $state->format('d M Y, h:i:s A');
                        }

                        try {
                            return Carbon::parse((string) $state)->format('d M Y, h:i:s A');
                        } catch (\Throwable) {
                            return (string) $state;
                        }
                    }),

                TextInput::make('action')
                    ->label('Action'),

                TextInput::make('user_name')
                    ->label('User Name'),

                TextInput::make('user_email')
                    ->label('User Email'),

                TextInput::make('user_role')
                    ->label('User Role'),

                TextInput::make('ip_address')
                    ->label('IP Address'),

                TextInput::make('description')
                    ->label('Description')
                    ->columnSpanFull(),

                Textarea::make('user_agent')
                    ->label('User Agent')
                    ->columnSpanFull(),

                Textarea::make('properties')
                    ->label('Properties & Audit Changes (JSON)')
                    ->formatStateUsing(fn ($state) => is_array($state) ? json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : ($state ?? ''))
                    ->rows(6)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('created_at')
                    ->label('Date & Time')
                    ->dateTime('d M Y, h:i:s A')
                    ->description(fn (ActivityLog $record): ?string => $record->created_at?->diffForHumans())
                    ->sortable(),

                TextColumn::make('action')
                    ->label('Action')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'login' => 'success',
                        'logout' => 'gray',
                        'failed_login' => 'danger',
                        'created' => 'primary',
                        'updated' => 'warning',
                        'deleted' => 'danger',
                        default => 'info',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'login' => 'Logged In',
                        'logout' => 'Logged Out',
                        'failed_login' => 'Failed Login',
                        'created' => 'Created',
                        'updated' => 'Updated',
                        'deleted' => 'Deleted',
                        default => ucfirst($state),
                    })
                    ->sortable(),

                TextColumn::make('user_name')
                    ->label('User')
                    ->description(fn (ActivityLog $record): ?string => $record->user_email)
                    ->searchable()
                    ->sortable(),

                TextColumn::make('user_role')
                    ->label('Role')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'developer' => 'danger',
                        'super_admin' => 'primary',
                        'admin' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'developer' => 'Developer',
                        'super_admin' => 'Super Admin',
                        'admin' => 'Admin',
                        default => $state ?? 'Guest',
                    }),

                TextColumn::make('description')
                    ->label('Activity Description')
                    ->searchable()
                    ->wrap(),

                TextColumn::make('ip_address')
                    ->label('IP Address')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('action')
                    ->options([
                        'login' => 'Login',
                        'logout' => 'Logout',
                        'failed_login' => 'Failed Login',
                        'created' => 'Created',
                        'updated' => 'Updated',
                        'deleted' => 'Deleted',
                    ]),

                SelectFilter::make('user_role')
                    ->label('Role')
                    ->options([
                        UserRole::Developer->value => 'Developer',
                        UserRole::SuperAdmin->value => 'Super Admin',
                        UserRole::Admin->value => 'Admin',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageActivityLogs::route('/'),
        ];
    }
}
