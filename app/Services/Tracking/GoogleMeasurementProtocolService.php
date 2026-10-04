<?php

namespace App\Services\Tracking;

use App\Models\Enquiry;
use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleMeasurementProtocolService
{
    /**
     * Send server-side lead status update event to GA4 via Measurement Protocol.
     */
    public static function sendCrmLeadEvent(Enquiry $enquiry, string $eventName = 'crm_lead_qualified', float $value = 0.00): bool
    {
        $settings = Setting::pluck('value', 'key')->all();
        $measurementId = $settings['google_analytics_id'] ?? null;
        $apiSecret = $settings['ga4_api_secret'] ?? null;

        if (empty($measurementId) || empty($apiSecret)) {
            return false;
        }

        $clientId = $enquiry->gclid ?: 'crm_lead_'.$enquiry->id;

        $params = [
            'lead_id' => $enquiry->id,
            'lead_status' => $enquiry->status->value ?? 'new',
            'course_name' => $enquiry->course?->title ?? 'General',
            'lead_source' => $enquiry->source ?? 'Website',
            'utm_source' => $enquiry->utm_source ?? '',
            'utm_medium' => $enquiry->utm_medium ?? '',
            'utm_campaign' => $enquiry->utm_campaign ?? '',
        ];

        if ($value > 0) {
            $params['value'] = $value;
            $params['currency'] = 'INR';
        }

        $payload = [
            'client_id' => $clientId,
            'events' => [
                [
                    'name' => $eventName,
                    'params' => $params,
                ],
            ],
        ];

        try {
            $response = Http::timeout(5)->post("https://www.google-analytics.com/mp/collect?measurement_id={$measurementId}&api_secret={$apiSecret}", $payload);

            return $response->successful();
        } catch (\Throwable $e) {
            Log::error('GA4 Measurement Protocol Exception: '.$e->getMessage());

            return false;
        }
    }
}
