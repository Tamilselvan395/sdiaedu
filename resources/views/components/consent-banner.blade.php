@php
    $consentModeEnabled = ($globalSettings['enable_consent_mode'] ?? '1') !== '0';
@endphp

@if($consentModeEnabled)
<div
    x-data="{
        showBanner: false,
        showPreferences: false,
        preferences: {
            necessary: true,
            analytics: true,
            marketing: true
        },
        init() {
            try {
                const saved = localStorage.getItem('sdia_cookie_consent_v1');
                if (!saved) {
                    // Small delay so user perceives the page first
                    setTimeout(() => { this.showBanner = true; }, 1000);
                } else {
                    const parsed = JSON.parse(saved);
                    this.preferences = {
                        necessary: true,
                        analytics: parsed.analytics ?? false,
                        marketing: parsed.marketing ?? false
                    };
                }
            } catch(e) {
                this.showBanner = true;
            }
        },
        acceptAll() {
            this.preferences.analytics = true;
            this.preferences.marketing = true;
            this.saveConsent('all');
        },
        rejectNonEssential() {
            this.preferences.analytics = false;
            this.preferences.marketing = false;
            this.saveConsent('rejected');
        },
        saveCustom() {
            this.saveConsent('custom');
        },
        saveConsent(type) {
            const consentData = {
                version: 1,
                type: type,
                necessary: true,
                analytics: this.preferences.analytics,
                marketing: this.preferences.marketing,
                timestamp: new Date().toISOString()
            };

            try {
                localStorage.setItem('sdia_cookie_consent_v1', JSON.stringify(consentData));
                // Set cookie for 1 year so backend middleware / server knows consent state
                document.cookie = 'sdia_consent_given=1; path=/; max-age=31536000; SameSite=Lax';
            } catch(e) {}

            // Update Google Consent Mode v2 in real-time
            if (typeof gtag === 'function') {
                gtag('consent', 'update', {
                    'analytics_storage': this.preferences.analytics ? 'granted' : 'denied',
                    'ad_storage': this.preferences.marketing ? 'granted' : 'denied',
                    'ad_user_data': this.preferences.marketing ? 'granted' : 'denied',
                    'ad_personalization': this.preferences.marketing ? 'granted' : 'denied'
                });

                window.dataLayer = window.dataLayer || [];
                window.dataLayer.push({
                    event: 'cookie_consent_update',
                    consent_analytics: this.preferences.analytics,
                    consent_marketing: this.preferences.marketing
                });
            }

            this.showBanner = false;
            this.showPreferences = false;
        }
    }"
    x-cloak
    x-show="showBanner"
    x-transition:enter="transition ease-out duration-300 transform"
    x-transition:enter-start="translate-y-full opacity-0"
    x-transition:enter-end="translate-y-0 opacity-100"
    x-transition:leave="transition ease-in duration-200 transform"
    x-transition:leave-start="translate-y-0 opacity-100"
    x-transition:leave-end="translate-y-full opacity-0"
    class="fixed bottom-0 inset-x-0 z-50 p-3 sm:p-4 md:p-6"
    role="region"
    aria-label="Cookie and Privacy Consent"
>
    <div class="max-w-4xl mx-auto bg-slate-900/95 text-white backdrop-blur-md rounded-2xl shadow-2xl border border-slate-700/60 p-4 sm:p-6">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div class="space-y-1.5 flex-1 pr-2">
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-amber-500/20 text-amber-400">
                        <i class="fa-solid fa-cookie-bite text-sm"></i>
                    </span>
                    <h3 class="text-sm sm:text-base font-bold text-white tracking-tight">Your Privacy & Cookie Choices</h3>
                </div>
                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                    We use cookies and privacy-preserving analytics to improve your course browsing experience, measure learning engagement, and provide relevant updates. You can manage or accept your preferences below.
                </p>
            </div>

            <!-- Main CTA Buttons -->
            <div class="flex flex-wrap items-center gap-2 sm:gap-2.5 w-full md:w-auto shrink-0">
                <button
                    type="button"
                    @click="showPreferences = !showPreferences"
                    class="flex-1 sm:flex-none px-3.5 py-2 text-xs font-semibold rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700 transition"
                >
                    <span x-text="showPreferences ? 'Hide Options' : 'Preferences'"></span>
                </button>

                <button
                    type="button"
                    @click="rejectNonEssential()"
                    class="flex-1 sm:flex-none px-3.5 py-2 text-xs font-semibold rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 border border-slate-700 transition"
                >
                    Reject Non-Essential
                </button>

                <button
                    type="button"
                    @click="acceptAll()"
                    class="w-full sm:w-auto px-4 py-2 text-xs font-bold rounded-lg bg-amber-500 hover:bg-amber-400 text-slate-950 shadow-md shadow-amber-500/20 transition"
                >
                    Accept All
                </button>
            </div>
        </div>

        <!-- Preferences Drawer -->
        <div
            x-show="showPreferences"
            x-collapse
            class="mt-4 pt-4 border-t border-slate-800 grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs"
        >
            <div class="bg-slate-800/60 p-3 rounded-xl border border-slate-700/50 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between font-bold text-white mb-1">
                        <span>Strictly Necessary</span>
                        <span class="text-[10px] uppercase font-bold text-emerald-400 bg-emerald-500/10 px-1.5 py-0.5 rounded">Always On</span>
                    </div>
                    <p class="text-slate-400 text-[11px] leading-snug">
                        Essential for core navigation, authentication, and security token protection.
                    </p>
                </div>
            </div>

            <div class="bg-slate-800/60 p-3 rounded-xl border border-slate-700/50 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between font-bold text-white mb-1">
                        <span>Analytics (GA4)</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" x-model="preferences.analytics" class="sr-only peer">
                            <div class="w-8 h-4 bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-3 after:w-3 after:transition-all peer-checked:bg-amber-500"></div>
                        </label>
                    </div>
                    <p class="text-slate-400 text-[11px] leading-snug">
                        Helps us understand popular courses, page speed, and interactive quiz engagement.
                    </p>
                </div>
            </div>

            <div class="bg-slate-800/60 p-3 rounded-xl border border-slate-700/50 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between font-bold text-white mb-1">
                        <span>Marketing & Pixels</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" x-model="preferences.marketing" class="sr-only peer">
                            <div class="w-8 h-4 bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-3 after:w-3 after:transition-all peer-checked:bg-amber-500"></div>
                        </label>
                    </div>
                    <p class="text-slate-400 text-[11px] leading-snug">
                        Used to measure campaign conversions on Google Ads, Meta Ads, and educational webinars.
                    </p>
                </div>
            </div>

            <div class="sm:col-span-3 flex justify-end pt-2">
                <button
                    type="button"
                    @click="saveCustom()"
                    class="px-4 py-1.5 text-xs font-bold rounded-lg bg-emerald-500 hover:bg-emerald-400 text-slate-950 transition"
                >
                    Save Preferences
                </button>
            </div>
        </div>
    </div>
</div>
@endif
