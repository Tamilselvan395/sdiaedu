/**
 * Sri Deekshaa International Academy - Frontend Tracking & Analytics Suite
 * 
 * Includes:
 * - Call-click tracking (tel:)
 * - WhatsApp-click tracking (wa.me)
 * - Email-click tracking (mailto:)
 * - Form submission tracking (Lead generation)
 * - Course-level tracking (view_item / ViewContent)
 * - Core Web Vitals (LCP, INP, CLS) reporting
 */

(function () {
    'use strict';

    // Helper: Push safely to window.dataLayer
    function pushDataLayer(payload) {
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push(payload);
    }

    // Helper: Safely track via gtag
    function trackGtag(action, eventName, params) {
        if (typeof window.gtag === 'function') {
            window.gtag(action, eventName, params);
        }
    }

    // Helper: Safely track via Meta Pixel fbq
    function trackFbq(event, eventName, params, options) {
        if (typeof window.fbq === 'function') {
            if (options) {
                window.fbq(event, eventName, params, options);
            } else {
                window.fbq(event, eventName, params);
            }
        }
    }

    /* -------------------------------------------------------------
     * 1. Click Tracking (Call, WhatsApp, Email)
     * ----------------------------------------------------------- */
    document.addEventListener('click', function (e) {
        const link = e.target.closest('a');
        if (!link) return;

        const href = link.getAttribute('href') || '';

        // Call-click tracking
        if (href.startsWith('tel:')) {
            const phoneNumber = href.replace('tel:', '').trim();
            pushDataLayer({
                event: 'call_click',
                phone_number: phoneNumber,
                link_text: link.innerText.trim(),
                page_location: window.location.href
            });
            trackGtag('event', 'call_click', {
                phone_number: phoneNumber,
                event_category: 'Contact',
                event_label: phoneNumber
            });
            trackFbq('trackCustom', 'CallClick', { phone_number: phoneNumber });
        }

        // WhatsApp-click tracking
        else if (href.includes('wa.me') || href.includes('whatsapp.com')) {
            pushDataLayer({
                event: 'whatsapp_click',
                link_url: href,
                link_text: link.innerText.trim(),
                page_location: window.location.href
            });
            trackGtag('event', 'whatsapp_click', {
                event_category: 'Contact',
                event_label: 'WhatsApp Chat'
            });
            trackFbq('track', 'Contact', { content_name: 'WhatsApp Click' });
        }

        // Email-click tracking
        else if (href.startsWith('mailto:')) {
            const email = href.replace('mailto:', '').split('?')[0].trim();
            pushDataLayer({
                event: 'email_click',
                email_address: email,
                page_location: window.location.href
            });
            trackGtag('event', 'email_click', {
                email_address: email,
                event_category: 'Contact',
                event_label: email
            });
            trackFbq('trackCustom', 'EmailClick', { email: email });
        }
    }, true);

    /* -------------------------------------------------------------
     * 2. Course-level Tracking (view_item & ViewContent)
     * ----------------------------------------------------------- */
    document.addEventListener('DOMContentLoaded', function () {
        const courseElement = document.querySelector('[data-course-id]');
        if (courseElement) {
            const courseId = courseElement.getAttribute('data-course-id');
            const courseTitle = courseElement.getAttribute('data-course-title') || document.title;
            const courseCategory = courseElement.getAttribute('data-course-category') || 'All Courses';
            const coursePrice = courseElement.getAttribute('data-course-price') || 0;

            pushDataLayer({
                event: 'view_item',
                ecommerce: {
                    currency: 'INR',
                    value: parseFloat(coursePrice) || 0,
                    items: [{
                        item_id: courseId,
                        item_name: courseTitle,
                        item_category: courseCategory,
                        price: parseFloat(coursePrice) || 0,
                        quantity: 1
                    }]
                }
            });

            trackGtag('event', 'view_item', {
                currency: 'INR',
                value: parseFloat(coursePrice) || 0,
                items: [{
                    item_id: courseId,
                    item_name: courseTitle,
                    item_category: courseCategory
                }]
            });

            trackFbq('track', 'ViewContent', {
                content_name: courseTitle,
                content_category: courseCategory,
                content_ids: [courseId],
                content_type: 'product',
                currency: 'INR',
                value: parseFloat(coursePrice) || 0
            });
        }
    });

    /* -------------------------------------------------------------
     * 3. Form Submission & Lead Tracking (Enquiry / Quiz / Trial)
     * ----------------------------------------------------------- */
    window.addEventListener('lead_generated', function (e) {
        const detail = e.detail || {};
        const eventId = detail.event_id || ('lead_' + Date.now());

        pushDataLayer({
            event: 'generate_lead',
            event_id: eventId,
            lead_type: detail.type || 'General Enquiry',
            course_name: detail.course || 'All Courses',
            branch: detail.branch || 'Main'
        });

        // GA4 Lead Event
        trackGtag('event', 'generate_lead', {
            event_id: eventId,
            lead_type: detail.type || 'General Enquiry',
            course_name: detail.course || 'All Courses'
        });

        // Google Ads Conversion (if conversion ID & label defined on window)
        if (window.googleAdsConversionConfig && window.googleAdsConversionConfig.id && window.googleAdsConversionConfig.label) {
            trackGtag('event', 'conversion', {
                'send_to': window.googleAdsConversionConfig.id + '/' + window.googleAdsConversionConfig.label,
                'transaction_id': eventId
            });
        }

        // Meta Pixel Lead Event with Deduplication Event ID matching Meta CAPI
        trackFbq('track', 'Lead', {
            content_name: detail.course || 'Academy Course Enquiry',
            content_category: detail.type || 'Lead',
            currency: 'INR',
            value: 0
        }, { eventID: eventId });
    });

    /* -------------------------------------------------------------
     * 4. Core Web Vitals Monitoring (CLS, LCP, INP)
     * ----------------------------------------------------------- */
    try {
        if ('PerformanceObserver' in window) {
            // LCP (Largest Contentful Paint)
            new PerformanceObserver(function (entryList) {
                const entries = entryList.getEntries();
                if (entries.length > 0) {
                    const lastEntry = entries[entries.length - 1];
                    const lcpValue = Math.round(lastEntry.startTime);
                    pushDataLayer({
                        event: 'core_web_vitals',
                        cwv_metric: 'LCP',
                        cwv_value: lcpValue,
                        cwv_rating: lcpValue <= 2500 ? 'good' : (lcpValue <= 4000 ? 'needs-improvement' : 'poor')
                    });
                }
            }).observe({ type: 'largest-contentful-paint', buffered: true });

            // CLS (Cumulative Layout Shift)
            let clsValue = 0;
            new PerformanceObserver(function (entryList) {
                for (const entry of entryList.getEntries()) {
                    if (!entry.hadRecentInput) {
                        clsValue += entry.value;
                    }
                }
                pushDataLayer({
                    event: 'core_web_vitals',
                    cwv_metric: 'CLS',
                    cwv_value: Math.round(clsValue * 1000) / 1000,
                    cwv_rating: clsValue <= 0.1 ? 'good' : (clsValue <= 0.25 ? 'needs-improvement' : 'poor')
                });
            }).observe({ type: 'layout-shift', buffered: true });
        }
    } catch (err) {
        // Silently fail if browser does not support PerformanceObserver
    }

})();
