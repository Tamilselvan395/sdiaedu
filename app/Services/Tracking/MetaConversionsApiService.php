<?php

namespace App\Services\Tracking;

use App\Models\Enquiry;
use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MetaConversionsApiService
{
    /**
     * Send server-side Lead event to Meta Conversions API.
     */
    public static function sendLeadEvent(Enquiry $enquiry, ?string $eventId = null): bool
    {
        $settings = Setting::pluck('value', 'key')->all();
        $pixelId = $settings['meta_pixel_id'] ?? null;
        $accessToken = $settings['meta_capi_access_token'] ?? null;
        $testCode = $settings['meta_capi_test_event_code'] ?? null;

        if (empty($pixelId) || empty($accessToken)) {
            return false;
        }

        $eventId = $eventId ?: 'enquiry_'.$enquiry->id.'_'.time();

        $userData = [
            'client_ip_address' => $enquiry->ip_address,
            'client_user_agent' => $enquiry->user_agent,
        ];

        // First-party hashed data according to Meta CAPI specification (SHA-256)
        if (! empty($enquiry->email)) {
            $userData['em'] = [hash('sha256', strtolower(trim($enquiry->email)))];
        }

        if (! empty($enquiry->phone)) {
            // Strip non-digits and normalize
            $cleanPhone = preg_replace('/[^0-9]/', '', $enquiry->phone);
            if (strlen($cleanPhone) === 10) {
                $cleanPhone = '91'.$cleanPhone; // default India code if 10 digits
            }
            $userData['ph'] = [hash('sha256', $cleanPhone)];
        }

        if (! empty($enquiry->parent_name)) {
            $nameParts = explode(' ', trim($enquiry->parent_name));
            $userData['fn'] = [hash('sha256', strtolower($nameParts[0]))];
            if (count($nameParts) > 1) {
                $userData['ln'] = [hash('sha256', strtolower(end($nameParts)))];
            }
        }

        if (! empty($enquiry->fbp)) {
            $userData['fbp'] = $enquiry->fbp;
        }

        if (! empty($enquiry->fbc)) {
            $userData['fbc'] = $enquiry->fbc;
        }

        $eventData = [
            'event_name' => 'Lead',
            'event_time' => time(),
            'event_id' => $eventId,
            'event_source_url' => $enquiry->landing_page ?: url('/'),
            'action_source' => 'website',
            'user_data' => $userData,
            'custom_data' => [
                'content_name' => $enquiry->course?->title ?? 'General Academic Enquiry',
                'content_category' => $enquiry->course?->category?->name ?? 'Skill Development',
                'currency' => 'INR',
                'value' => 0.00,
                'status' => 'new',
            ],
        ];

        $payload = [
            'data' => [$eventData],
        ];

        if (! empty($testCode)) {
            $payload['test_event_code'] = $testCode;
        }

        try {
            $response = Http::withToken($accessToken)
                ->timeout(5)
                ->post("https://graph.facebook.com/v19.0/{$pixelId}/events", $payload);

            if ($response->successful()) {
                Log::info('Meta CAPI Lead Event Sent', ['enquiry_id' => $enquiry->id, 'event_id' => $eventId]);

                return true;
            }

            Log::warning('Meta CAPI Lead Event Failed', [
                'status' => $response->status(),
                'response' => $response->json(),
            ]);

            return false;
        } catch (\Throwable $e) {
            Log::error('Meta CAPI Exception: '.$e->getMessage());

            return false;
        }
    }

    /**
     * Send server-side conversion event (e.g. Student Enrolled / Qualified).
     */
    public static function sendConversionEvent(Enquiry $enquiry, string $eventName = 'CompleteRegistration', float $value = 0.00): bool
    {
        $settings = Setting::pluck('value', 'key')->all();
        $pixelId = $settings['meta_pixel_id'] ?? null;
        $accessToken = $settings['meta_capi_access_token'] ?? null;

        if (empty($pixelId) || empty($accessToken)) {
            return false;
        }

        $userData = [
            'client_ip_address' => $enquiry->ip_address,
            'client_user_agent' => $enquiry->user_agent,
        ];

        if (! empty($enquiry->email)) {
            $userData['em'] = [hash('sha256', strtolower(trim($enquiry->email)))];
        }

        if (! empty($enquiry->phone)) {
            $cleanPhone = preg_replace('/[^0-9]/', '', $enquiry->phone);
            if (strlen($cleanPhone) === 10) {
                $cleanPhone = '91'.$cleanPhone;
            }
            $userData['ph'] = [hash('sha256', $cleanPhone)];
        }

        if (! empty($enquiry->fbp)) {
            $userData['fbp'] = $enquiry->fbp;
        }
        if (! empty($enquiry->fbc)) {
            $userData['fbc'] = $enquiry->fbc;
        }

        $payload = [
            'data' => [
                [
                    'event_name' => $eventName,
                    'event_time' => time(),
                    'event_id' => 'crm_conv_'.$enquiry->id.'_'.time(),
                    'action_source' => 'system_generated',
                    'user_data' => $userData,
                    'custom_data' => [
                        'currency' => 'INR',
                        'value' => $value,
                        'lead_id' => $enquiry->id,
                        'course' => $enquiry->course?->title ?? 'General Course',
                    ],
                ],
            ],
        ];

        try {
            $response = Http::withToken($accessToken)
                ->timeout(5)
                ->post("https://graph.facebook.com/v19.0/{$pixelId}/events", $payload);

            return $response->successful();
        } catch (\Throwable $e) {
            Log::error('Meta CAPI Conversion Exception: '.$e->getMessage());

            return false;
        }
    }
}
