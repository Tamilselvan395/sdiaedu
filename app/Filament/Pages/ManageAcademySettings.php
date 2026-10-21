<?php

namespace App\Filament\Pages;

use App\Filament\Concerns\RequiresFullAccess;
use App\Models\Setting;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Cache;
use UnitEnum;

class ManageAcademySettings extends Page
{
    use RequiresFullAccess;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static string|UnitEnum|null $navigationGroup = 'Settings';

    protected static ?string $navigationLabel = 'General Settings';

    protected static ?string $title = 'Academy Settings';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pages.manage-academy-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = Setting::pluck('value', 'key')->all();

        $this->form->fill($settings);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Academy Settings')->tabs([

                    // Tab 1: Identity & Contact
                    Tab::make('Identity & Contact')
                        ->icon('heroicon-o-identification')
                        ->schema([
                            Section::make('Academy Basic Information')
                                ->schema([
                                    TextInput::make('academy_name')
                                        ->label('Academy Name')
                                        ->required()
                                        ->default('Sri Deekshaa International Academy'),

                                    TextInput::make('tagline')
                                        ->label('Academy Tagline / Motto')
                                        ->default('Learn Today. Grow Tomorrow.'),

                                    TextInput::make('email')
                                        ->label('Primary Email')
                                        ->email()
                                        ->default('info@srideekshaa.com'),

                                    TextInput::make('phone')
                                        ->label('Primary Phone / Reception Desk')
                                        ->placeholder('e.g. +91 98765 43210')
                                        ->default('+91 98765 43210'),

                                    TextInput::make('phone_secondary')
                                        ->label('Secondary Phone / Counseling Desk')
                                        ->placeholder('e.g. +91 93446 20346')
                                        ->helperText('Displayed alongside the primary phone in the website footer and contact page.')
                                        ->default('+91 93446 20346'),

                                    TextInput::make('whatsapp_number')
                                        ->label('WhatsApp Number (with country code)')
                                        ->placeholder('e.g. 919876543210')
                                        ->default('919876543210'),

                                    TextInput::make('whatsapp_default_message')
                                        ->label('Default WhatsApp Greeting')
                                        ->default('Hello Sri Deekshaa International Academy, I would like to know more about your courses.'),
                                ])->columns(2),

                            Section::make('Location & Working Hours')
                                ->schema([
                                    Textarea::make('address')
                                        ->label('Street Address')
                                        ->rows(2)
                                        ->columnSpanFull()
                                        ->default('Plot No. 42, 2nd Avenue, Sri Deekshaa Learning Campus'),

                                    TextInput::make('city')
                                        ->label('City')
                                        ->default('Chennai'),

                                    TextInput::make('state')
                                        ->label('State')
                                        ->default('Tamil Nadu'),

                                    TextInput::make('country')
                                        ->label('Country')
                                        ->default('India'),

                                    TextInput::make('pincode')
                                        ->label('Pincode / ZIP')
                                        ->default('600040'),

                                    TextInput::make('working_hours')
                                        ->label('Working Hours')
                                        ->placeholder('e.g. Mon - Sat: 9:00 AM - 7:30 PM')
                                        ->default('Monday - Saturday: 9:00 AM - 7:30 PM | Sunday: 9:00 AM - 1:30 PM')
                                        ->columnSpanFull(),

                                    Textarea::make('map_embed_url')
                                        ->label('Google Maps Embed URL')
                                        ->rows(2)
                                        ->columnSpanFull()
                                        ->placeholder('https://www.google.com/maps/embed?...'),
                                ])->columns(2),
                        ]),

                    // Tab 2: Announcements
                    Tab::make('Announcements')
                        ->icon('heroicon-o-megaphone')
                        ->schema([
                            Section::make('Top Announcement Bar')
                                ->description('Configure the site-wide announcement notice displayed at the very top of the website.')
                                ->schema([
                                    Textarea::make('announcement_bar')
                                        ->label('Top Bar Notice Message')
                                        ->rows(3)
                                        ->default('Admissions Open for New Term | Book a Free Counselling & Assessment Session')
                                        ->helperText('Keep it concise for optimal mobile display.')
                                        ->columnSpanFull(),
                                ]),
                        ]),

                    // Tab 3: Branding
                    Tab::make('Branding')
                        ->icon('heroicon-o-paint-brush')
                        ->schema([
                            Grid::make(3)->schema([
                                FileUpload::make('logo_path')
                                    ->label('Custom Logo Image')
                                    ->image()
                                    ->directory('settings')
                                    ->asWebp()
                                    ->helperText('If not uploaded, the site uses the default sdia.png logo.'),

                                FileUpload::make('favicon_path')
                                    ->label('Custom Favicon')
                                    ->image()
                                    ->directory('settings')
                                    ->asWebp()
                                    ->helperText('Small square icon (32x32 or 64x64 px).'),

                                FileUpload::make('og_image_default')
                                    ->label('Default Social Share Image (OG / Twitter)')
                                    ->image()
                                    ->directory('settings')
                                    ->asWebp()
                                    ->helperText('Default preview banner (1200x630 px) for social media. Defaults to logo if empty.'),
                            ]),
                        ]),

                    // Tab 4: Statistics & Counters
                    Tab::make('Academy Stats')
                        ->icon('heroicon-o-chart-bar')
                        ->schema([
                            Section::make('Public Key Metrics')
                                ->description('Key numbers displayed across the homepage and footer counter badges.')
                                ->schema([
                                    TextInput::make('stat_students')
                                        ->label('Learners Enrolled')
                                        ->default('2,500+'),

                                    TextInput::make('stat_courses')
                                        ->label('Certified Courses Offered')
                                        ->default('23+'),

                                    TextInput::make('stat_faculty')
                                        ->label('Experienced Mentors')
                                        ->default('35+'),

                                    TextInput::make('stat_years')
                                        ->label('Years of Learning Excellence')
                                        ->default('8+'),
                                ])->columns(2),
                        ]),

                    // Tab 5: Social Media
                    Tab::make('Social Links')
                        ->icon('heroicon-o-share')
                        ->schema([
                            Grid::make(2)->schema([
                                TextInput::make('facebook_url')
                                    ->label('Facebook Page URL')
                                    ->url()
                                    ->placeholder('https://facebook.com/...'),

                                TextInput::make('instagram_url')
                                    ->label('Instagram URL')
                                    ->url()
                                    ->placeholder('https://instagram.com/...'),

                                TextInput::make('youtube_url')
                                    ->label('YouTube Channel URL')
                                    ->url()
                                    ->placeholder('https://youtube.com/...'),

                                TextInput::make('linkedin_url')
                                    ->label('LinkedIn Profile URL')
                                    ->url()
                                    ->placeholder('https://linkedin.com/...'),

                                TextInput::make('twitter_url')
                                    ->label('Twitter / X URL')
                                    ->url()
                                    ->placeholder('https://x.com/...'),
                            ]),
                        ]),

                    // Tab 6: SEO & Tracking
                    Tab::make('SEO & Tracking')
                        ->icon('heroicon-o-globe-alt')
                        ->schema([
                            Section::make('Default Search Engine Optimization (SEO)')
                                ->schema([
                                    TextInput::make('meta_title_default')
                                        ->label('Default SEO Meta Title')
                                        ->default('Sri Deekshaa International Academy | Skill-Based Learning & Holistic Education')
                                        ->maxLength(70),

                                    Textarea::make('meta_description_default')
                                        ->label('Default SEO Meta Description')
                                        ->rows(3)
                                        ->default('Explore skill-based learning programs designed to build confidence, creativity, academic speed, communication, and future-ready capabilities for kids, students, and professionals.')
                                        ->maxLength(160),

                                    TextInput::make('meta_keywords')
                                        ->label('Default SEO Keywords')
                                        ->placeholder('abacus, vedic maths, robotics, coding, kids skills, chennai academy'),
                                ]),

                            Section::make('Analytics & Tracking Pixels')
                                ->schema([
                                    TextInput::make('google_analytics_id')
                                        ->label('Google Analytics (GA4) ID')
                                        ->placeholder('e.g. G-XXXXXXXXXX'),

                                    TextInput::make('ga4_api_secret')
                                        ->label('GA4 Measurement Protocol API Secret')
                                        ->password()
                                        ->placeholder('For CRM lead-quality server events'),

                                    TextInput::make('google_tag_manager_id')
                                        ->label('Google Tag Manager (GTM) ID')
                                        ->placeholder('e.g. GTM-XXXXXXX'),

                                    TextInput::make('google_ads_conversion_id')
                                        ->label('Google Ads ID')
                                        ->placeholder('e.g. AW-XXXXXXXXX'),

                                    TextInput::make('google_ads_conversion_label')
                                        ->label('Google Ads Conversion Label')
                                        ->placeholder('e.g. abcdEFGH1234'),

                                    TextInput::make('meta_pixel_id')
                                        ->label('Meta Pixel ID')
                                        ->placeholder('e.g. 123456789012345'),

                                    TextInput::make('meta_capi_access_token')
                                        ->label('Meta Conversions API (CAPI) Token')
                                        ->password()
                                        ->placeholder('System User Access Token'),

                                    TextInput::make('meta_capi_test_code')
                                        ->label('Meta CAPI Test Event Code')
                                        ->placeholder('TESTXXXXX (leave empty in production)'),

                                    TextInput::make('microsoft_clarity_id')
                                        ->label('Microsoft Clarity ID')
                                        ->placeholder('e.g. xxxxxxxxxx'),
                                ])->columns(3),

                            Section::make('Search Engine Verification & Local Business')
                                ->schema([
                                    TextInput::make('google_search_console_token')
                                        ->label('Google Search Console Verification Token / Content')
                                        ->placeholder('google-site-verification token or code'),

                                    TextInput::make('bing_webmaster_token')
                                        ->label('Bing Webmaster Verification Code')
                                        ->placeholder('msvalidate.01 token'),

                                    TextInput::make('google_business_profile_url')
                                        ->label('Google Business Profile / Maps URL')
                                        ->placeholder('https://maps.app.goo.gl/...'),

                                    TextInput::make('cross_domain_list')
                                        ->label('Cross-Domain Tracking Domains (comma-separated)')
                                        ->placeholder('srideekshaa.com, srideekshaa.in, srideekshaa.edu'),

                                    Toggle::make('enable_consent_mode')
                                        ->label('Enable Cookie Consent Banner & Google Consent Mode v2')
                                        ->helperText('Defaults to denied for ad_storage, analytics_storage, ad_user_data, and ad_personalization until visitor consents.')
                                        ->default(true),
                                ])->columns(2),

                            Section::make('Custom Scripts')
                                ->schema([
                                    Textarea::make('header_scripts')
                                        ->label('Header Scripts (Injected before </head>)')
                                        ->rows(4)
                                        ->placeholder('<!-- Google Tag Manager, Custom Analytics, etc. -->'),

                                    Textarea::make('footer_scripts')
                                        ->label('Footer Scripts (Injected before </body>)')
                                        ->rows(4)
                                        ->placeholder('<!-- Chat widgets, tracking scripts, etc. -->'),
                                ]),
                        ]),

                    // Tab 7: Franchise Page
                    Tab::make('Franchise Page')
                        ->icon('heroicon-o-building-storefront')
                        ->schema([
                            Section::make('Franchise Office & Desk Contact')
                                ->description('Configure specific contact details displayed on the public Franchise Opportunities page.')
                                ->schema([
                                    Grid::make(2)->schema([
                                        TextInput::make('franchise_phone')
                                            ->label('Franchise Helpdesk Phone')
                                            ->placeholder('+91 98765 43210')
                                            ->helperText('Optional. If empty, the primary academy phone is used.'),

                                        TextInput::make('franchise_email')
                                            ->label('Franchise Enquiries Email')
                                            ->email()
                                            ->placeholder('franchise@srideekshaa.com')
                                            ->helperText('Optional. If empty, the primary academy email is used.'),
                                    ]),

                                    Textarea::make('franchise_hero_subtitle')
                                        ->label('Franchise Banner Subtitle')
                                        ->rows(3)
                                        ->default("Bring Sri Deekshaa's ISO 9001 certified cognitive, academic, and creative programs to your city. Review our campus address, view our location on the map, or submit your franchise enquiry below.")
                                        ->columnSpanFull(),

                                    TextInput::make('franchise_brochure_url')
                                        ->label('Franchise Prospectus / Brochure Download Link')
                                        ->placeholder('https://... or /brochures/franchise-prospectus.pdf')
                                        ->helperText('Link to downloadable franchise presentation or curriculum prospectus.')
                                        ->columnSpanFull(),
                                ]),
                        ]),

                ])->columnSpanFull(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => is_array($value) ? json_encode($value) : $value]
            );
        }

        Cache::forget('global_settings');

        Notification::make()
            ->title('Settings saved successfully!')
            ->success()
            ->send();
    }
}
