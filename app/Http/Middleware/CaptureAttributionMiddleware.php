<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CaptureAttributionMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $attributionParams = [
            'utm_source',
            'utm_medium',
            'utm_campaign',
            'utm_term',
            'utm_content',
            'gclid',
            'fbclid',
            'msclkid',
        ];

        $hasAttribution = false;
        $attributionData = [];

        foreach ($attributionParams as $param) {
            if ($request->has($param)) {
                $value = substr(strip_tags((string) $request->query($param)), 0, 150);
                $attributionData[$param] = $value;
                session()->put("attribution.{$param}", $value);
                $hasAttribution = true;
            } elseif (! session()->has("attribution.{$param}") && $request->hasCookie("sdia_{$param}")) {
                session()->put("attribution.{$param}", $request->cookie("sdia_{$param}"));
            }
        }

        // Capture landing page if not already recorded in session
        if (! session()->has('attribution.landing_page')) {
            session()->put('attribution.landing_page', $request->fullUrl());
        }

        // Capture initial referrer if not already recorded
        if (! session()->has('attribution.referrer') && $request->header('referer')) {
            session()->put('attribution.referrer', substr($request->header('referer'), 0, 255));
        }

        // Meta Pixel Browser & Click IDs
        if ($request->hasCookie('_fbp')) {
            session()->put('attribution.fbp', $request->cookie('_fbp'));
        }
        if ($request->hasCookie('_fbc')) {
            session()->put('attribution.fbc', $request->cookie('_fbc'));
        } elseif ($request->has('fbclid')) {
            $fbc = 'fb.1.'.time().'.'.$request->query('fbclid');
            session()->put('attribution.fbc', $fbc);
        }

        $response = $next($request);

        // Queue first-party cookies for 30 days (43,200 minutes) to persist cross-session attribution
        if ($hasAttribution) {
            foreach ($attributionData as $param => $val) {
                if ($val) {
                    cookie()->queue("sdia_{$param}", $val, 43200);
                }
            }
        }

        return $response;
    }
}
