<?php

namespace App\Filament\Resources\Enquiries\Pages;

use App\Filament\Resources\Enquiries\EnquiryResource;
use App\Services\Tracking\GoogleAdsOfflineConversionService;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEnquiries extends ListRecords
{
    protected static string $resource = EnquiryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('exportGoogleAdsConversions')
                ->label('Google Ads Conversions CSV')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->action(function () {
                    $csv = GoogleAdsOfflineConversionService::generateCsv();

                    return response()->streamDownload(function () use ($csv) {
                        echo $csv;
                    }, 'google_ads_conversions_'.date('Y-m-d').'.csv', [
                        'Content-Type' => 'text/csv',
                    ]);
                }),
            CreateAction::make(),
        ];
    }
}
