{{-- Search Engine Verification Tokens --}}
@if(!empty($globalSettings['google_search_console_token']))
    <meta name="google-site-verification" content="{{ $globalSettings['google_search_console_token'] }}">
@endif
@if(!empty($globalSettings['bing_webmaster_token']))
    <meta name="msvalidate.01" content="{{ $globalSettings['bing_webmaster_token'] }}">
@endif

{{-- Google Consent Mode v2 Setup --}}
@php
    $consentModeEnabled = ($globalSettings['enable_consent_mode'] ?? '1') !== '0';
@endphp
@if($consentModeEnabled)
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}

    // Google Consent Mode v2 Defaults
    var sdiaConsentDefaults = {
        'ad_storage': 'denied',
        'analytics_storage': 'denied',
        'ad_user_data': 'denied',
        'ad_personalization': 'denied',
        'wait_for_update': 500
    };

    try {
        var sdiaStoredConsent = localStorage.getItem('sdia_cookie_consent_v1');
        if (sdiaStoredConsent) {
            var sdiaParsedConsent = JSON.parse(sdiaStoredConsent);
            if (sdiaParsedConsent.analytics) {
                sdiaConsentDefaults['analytics_storage'] = 'granted';
            }
            if (sdiaParsedConsent.marketing) {
                sdiaConsentDefaults['ad_storage'] = 'granted';
                sdiaConsentDefaults['ad_user_data'] = 'granted';
                sdiaConsentDefaults['ad_personalization'] = 'granted';
            }
        }
    } catch(e) {}

    gtag('consent', 'default', sdiaConsentDefaults);
</script>
@endif

{{-- Google Tag Manager (Head) --}}
@if(!empty($globalSettings['google_tag_manager_id']))
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','{{ $globalSettings['google_tag_manager_id'] }}');</script>
<!-- End Google Tag Manager -->
@endif

{{-- Google Analytics 4 & Google Ads Conversion Tracking (gtag.js) --}}
@php
    $ga4Id = $globalSettings['google_analytics_id'] ?? null;
    $gAdsId = $globalSettings['google_ads_conversion_id'] ?? null;
    $crossDomains = !empty($globalSettings['cross_domain_list']) 
        ? array_filter(array_map('trim', explode(',', $globalSettings['cross_domain_list']))) 
        : [];
@endphp
@if($ga4Id || $gAdsId)
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $ga4Id ?: $gAdsId }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        @if($ga4Id)
            gtag('config', '{{ $ga4Id }}', {
                'send_page_view': true,
                @if(!empty($crossDomains))
                'linker': {
                    'domains': {!! json_encode($crossDomains) !!}
                },
                @endif
                'cookie_flags': 'SameSite=None;Secure'
            });
        @endif

        @if($gAdsId)
            gtag('config', '{{ $gAdsId }}', {
                @if(!empty($crossDomains))
                'linker': {
                    'domains': {!! json_encode($crossDomains) !!}
                }
                @endif
            });
        @endif

        @if(!empty($globalSettings['google_ads_conversion_id']) && !empty($globalSettings['google_ads_conversion_label']))
            window.googleAdsConversionConfig = {
                id: '{{ $globalSettings['google_ads_conversion_id'] }}',
                label: '{{ $globalSettings['google_ads_conversion_label'] }}'
            };
        @endif
    </script>
@endif

{{-- Meta Pixel (Facebook & Instagram) with Advanced Matching --}}
@if(!empty($globalSettings['meta_pixel_id']))
<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '{{ $globalSettings['meta_pixel_id'] }}');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id={{ $globalSettings['meta_pixel_id'] }}&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->
@endif

{{-- Microsoft Clarity --}}
@if(!empty($globalSettings['microsoft_clarity_id']))
<!-- Microsoft Clarity -->
<script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "{{ $globalSettings['microsoft_clarity_id'] }}");
</script>
<!-- End Microsoft Clarity -->
@endif

{{-- Enhanced Global Organization & LocalBusiness JSON-LD Schema --}}
@php
    $sameAsLinks = array_filter([
        $globalSettings['facebook_url'] ?? null,
        $globalSettings['instagram_url'] ?? null,
        $globalSettings['youtube_url'] ?? null,
        $globalSettings['linkedin_url'] ?? null,
        $globalSettings['google_business_profile_url'] ?? null,
    ]);
@endphp
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@graph": [
    {
      "@@type": ["EducationalOrganization", "LocalBusiness"],
      "@@id": "{{ url('/') }}#organization",
      "name": "{{ $siteName }}",
      "description": "{{ $pageDescription }}",
      "url": "{{ url('/') }}",
      "telephone": "{{ $phone }}",
      "email": "{{ $email }}",
      "logo": {
        "@@type": "ImageObject",
        "url": "{{ $logoUrl }}"
      },
      "image": "{{ $logoUrl }}",
      "priceRange": "₹₹",
      "address": {
        "@@type": "PostalAddress",
        "streetAddress": "{{ $globalSettings['address'] ?? 'Plot No. 42, 2nd Avenue' }}",
        "addressLocality": "{{ $globalSettings['city'] ?? 'Chennai' }}",
        "addressRegion": "{{ $globalSettings['state'] ?? 'Tamil Nadu' }}",
        "postalCode": "{{ $globalSettings['pincode'] ?? '600040' }}",
        "addressCountry": "IN"
      },
      "geo": {
        "@@type": "GeoCoordinates",
        "latitude": 13.0827,
        "longitude": 80.2707
      },
      "openingHoursSpecification": [
        {
          "@@type": "OpeningHoursSpecification",
          "dayOfWeek": [
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday"
          ],
          "opens": "09:00",
          "closes": "18:30"
        }
      ]
      @if(!empty($sameAsLinks))
      ,
      "sameAs": {!! json_encode(array_values($sameAsLinks)) !!}
      @endif
      @if(!empty($globalSettings['google_business_profile_url']))
      ,
      "hasMap": "{{ $globalSettings['google_business_profile_url'] }}"
      @endif
    },
    {
      "@@type": "WebSite",
      "@@id": "{{ url('/') }}#website",
      "url": "{{ url('/') }}",
      "name": "{{ $siteName }}",
      "description": "{{ $pageDescription }}",
      "publisher": {
        "@@id": "{{ url('/') }}#organization"
      },
      "potentialAction": {
        "@@type": "SearchAction",
        "target": "{{ route('courses.index') }}?q={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }
  ]
}
</script>
