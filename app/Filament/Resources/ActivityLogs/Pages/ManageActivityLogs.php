<?php

namespace App\Filament\Resources\ActivityLogs\Pages;

use App\Filament\Resources\ActivityLogs\ActivityLogResource;
use App\Models\ActivityLog;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Icons\Heroicon;

class ManageActivityLogs extends ManageRecords
{
    protected static string $resource = ActivityLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('clear_all_logs')
                ->label('Clear All Activity Logs')
                ->icon(Heroicon::OutlinedTrash)
                ->color('danger')
                ->requiresConfirmation()
                ->modalHeading('Clear All Activity Logs?')
                ->modalDescription('Are you sure you want to permanently delete all recorded user activity logs? This action cannot be undone.')
                ->modalSubmitActionLabel('Yes, delete all logs')
                ->action(function () {
                    ActivityLog::truncate();

                    Notification::make()
                        ->title('Activity logs cleared successfully.')
                        ->success()
                        ->send();
                }),
        ];
    }
}
