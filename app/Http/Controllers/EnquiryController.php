<?php

namespace App\Http\Controllers;

use App\Enums\EnquiryStatus;
use App\Models\Enquiry;
use App\Services\Tracking\MetaConversionsApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'parent_name' => 'required|string|max:150',
            'student_name' => 'required|string|max:150',
            'phone' => 'required|string|max:25',
            'email' => 'nullable|email|max:150',
            'student_age' => 'nullable|integer|min:3|max:99',
            'course_id' => 'nullable|exists:courses,id',
            'mode_preference' => 'nullable|string|max:50',
            'notes' => 'nullable|string|max:2000',
            'source' => 'nullable|string|max:100',
        ]);

        $utmSource = $request->input('utm_source') ?: ($request->query('utm_source') ?: (session('attribution.utm_source') ?: $request->cookie('sdia_utm_source')));
        $utmMedium = $request->input('utm_medium') ?: ($request->query('utm_medium') ?: (session('attribution.utm_medium') ?: $request->cookie('sdia_utm_medium')));
        $utmCampaign = $request->input('utm_campaign') ?: ($request->query('utm_campaign') ?: (session('attribution.utm_campaign') ?: $request->cookie('sdia_utm_campaign')));
        $utmTerm = $request->input('utm_term') ?: ($request->query('utm_term') ?: (session('attribution.utm_term') ?: $request->cookie('sdia_utm_term')));
        $utmContent = $request->input('utm_content') ?: ($request->query('utm_content') ?: (session('attribution.utm_content') ?: $request->cookie('sdia_utm_content')));
        $gclid = $request->input('gclid') ?: ($request->query('gclid') ?: (session('attribution.gclid') ?: $request->cookie('sdia_gclid')));
        $fbclid = $request->input('fbclid') ?: ($request->query('fbclid') ?: (session('attribution.fbclid') ?: $request->cookie('sdia_fbclid')));
        $msclkid = $request->input('msclkid') ?: ($request->query('msclkid') ?: (session('attribution.msclkid') ?: $request->cookie('sdia_msclkid')));
        $landingPage = session('attribution.landing_page') ?: $request->fullUrl();
        $referrer = session('attribution.referrer') ?: $request->header('referer');
        $fbp = $request->cookie('_fbp') ?: session('attribution.fbp');
        $fbc = $request->cookie('_fbc') ?: session('attribution.fbc');

        $enquiry = Enquiry::create([
            'parent_name' => $validated['parent_name'],
            'student_name' => $validated['student_name'] ?? $validated['parent_name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'] ?? null,
            'student_age' => $validated['student_age'] ?? null,
            'course_id' => $validated['course_id'] ?? null,
            'mode_preference' => $validated['mode_preference'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'source' => $validated['source'] ?? ($utmSource ? "Ad: {$utmSource}" : 'Website Form'),
            'status' => EnquiryStatus::New,
            'utm_source' => $utmSource,
            'utm_medium' => $utmMedium,
            'utm_campaign' => $utmCampaign,
            'utm_term' => $utmTerm,
            'utm_content' => $utmContent,
            'gclid' => $gclid,
            'fbclid' => $fbclid,
            'msclkid' => $msclkid,
            'landing_page' => $landingPage ? substr($landingPage, 0, 255) : null,
            'referrer' => $referrer ? substr($referrer, 0, 255) : null,
            'fbp' => $fbp,
            'fbc' => $fbc,
            'ip_address' => $request->ip(),
            'user_agent' => substr((string) $request->userAgent(), 0, 500),
            'consent_given' => true,
        ]);

        // Meta CAPI Server-Side Lead Event Dispatch
        $eventId = 'enquiry_'.$enquiry->id.'_'.time();
        MetaConversionsApiService::sendLeadEvent($enquiry, $eventId);

        $successMessage = 'Thank you! Your enquiry has been received. Our academic counselor will reach out to you within 24 hours.';

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $successMessage,
                'data' => $enquiry,
                'tracking' => [
                    'event_id' => $eventId,
                    'course_name' => $enquiry->course?->title ?? 'General',
                    'email_hash' => $enquiry->email ? hash('sha256', strtolower(trim($enquiry->email))) : null,
                    'phone_hash' => hash('sha256', preg_replace('/[^0-9]/', '', $enquiry->phone)),
                ],
            ]);
        }

        return back()
            ->with('success', $successMessage)
            ->with('tracking_lead', [
                'event_id' => $eventId,
                'course' => $enquiry->course?->title ?? 'General Enquiry',
                'type' => $enquiry->type ?? 'General',
                'branch' => $enquiry->branch?->name ?? 'Main',
            ]);
    }
}
