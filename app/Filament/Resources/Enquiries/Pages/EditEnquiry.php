<?php

namespace App\Filament\Resources\Enquiries\Pages;

use App\Enums\EnquiryStatus;
use App\Filament\Resources\Enquiries\EnquiryResource;
use App\Services\Tracking\GoogleMeasurementProtocolService;
use App\Services\Tracking\MetaConversionsApiService;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEnquiry extends EditRecord
{
    protected static string $resource = EnquiryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $record = $this->record;

        // CRM -> GA4 & Meta CAPI server-side event sync
        if ($record->status === EnquiryStatus::Admitted) {
            GoogleMeasurementProtocolService::sendConversionEvent($record, 'crm_student_enrolled', [
                'value' => 1000,
                'currency' => 'INR',
            ]);
            MetaConversionsApiService::sendPurchaseConversion($record, 1000, 'INR');

            $record->updateQuietly(['offline_conversion_synced_at' => now()]);
        } elseif (in_array($record->status, [EnquiryStatus::TrialCompleted, EnquiryStatus::Interested])) {
            GoogleMeasurementProtocolService::sendConversionEvent($record, 'crm_lead_qualified');
        }
    }
}
