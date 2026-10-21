<?php

namespace App\Filament\Pages;

use App\Filament\Concerns\RequiresFullAccess;
use App\Models\Setting;
use BackedEnum;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
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

class ManagePageSeoSettings extends Page
{
    use RequiresFullAccess;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentMagnifyingGlass;

    protected static string|UnitEnum|null $navigationGroup = 'Settings';

    protected static ?string $navigationLabel = 'Page SEO Meta Tags';

    protected static ?string $title = 'Page-Specific SEO Meta Tags';

    protected static ?int $navigationSort = 2;

    protected string $view = 'filament.pages.manage-page-seo-settings';

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
                Tabs::make('Page SEO Meta Tags')->tabs([

                    // Tab 1: Core Institutional Pages
                    Tab::make('Core Pages')
                        ->icon(Heroicon::OutlinedHome)
                        ->schema([
                            Section::make('Home Page (/)')
                                ->description('Configure the primary landing page title and description shown in search results.')
                                ->schema([
                                    Grid::make(2)->schema([
                                        TextInput::make('seo_home_title')
                                            ->label('Home Meta Title')
                                            ->placeholder('Sri Deekshaa International Academy | Skill-Based Learning & Holistic Education')
                                            ->helperText('Recommended: 50-60 characters')
                                            ->maxLength(70),

                                        TextInput::make('seo_home_keywords')
                                            ->label('Home Meta Keywords')
                                            ->placeholder('abacus, vedic maths, robotics, coding, kids academy chennai'),
                                    ]),
                                    Textarea::make('seo_home_description')
                                        ->label('Home Meta Description')
                                        ->rows(2)
                                        ->placeholder('Premier international academy offering skill-based courses in Abacus, Vedic Maths, Robotics, Coding, Creative Arts, and Spoken English.')
                                        ->helperText('Recommended: 140-160 characters')
                                        ->maxLength(160)
                                        ->columnSpanFull(),
                                ]),

                            Section::make('About Us Page (/about)')
                                ->description('Institutional vision, pedagogic philosophy, and academy mentor profile page.')
                                ->schema([
                                    Grid::make(2)->schema([
                                        TextInput::make('seo_about_title')
                                            ->label('About Us Meta Title')
                                            ->placeholder('About Us | Sri Deekshaa International Academy')
                                            ->maxLength(70),

                                        TextInput::make('seo_about_keywords')
                                            ->label('About Us Keywords')
                                            ->placeholder('about sri deekshaa, academy founders, cognitive education methodology'),
                                    ]),
                                    Textarea::make('seo_about_description')
                                        ->label('About Us Meta Description')
                                        ->rows(2)
                                        ->placeholder('Learn about Sri Deekshaa International Academy, our founder vision, research-backed cognitive pedagogy, and certified mentors.')
                                        ->maxLength(160)
                                        ->columnSpanFull(),
                                ]),

                            Section::make('Contact & Campus Page (/contact)')
                                ->description('Main master campus and regional center locations, phone, and walk-in consultation desk.')
                                ->schema([
                                    Grid::make(2)->schema([
                                        TextInput::make('seo_contact_title')
                                            ->label('Contact Page Meta Title')
                                            ->placeholder('Contact Us & Campus Location | Sri Deekshaa International Academy')
                                            ->maxLength(70),

                                        TextInput::make('seo_contact_keywords')
                                            ->label('Contact Keywords')
                                            ->placeholder('contact sri deekshaa, chennai academy address, counseling phone'),
                                    ]),
                                    Textarea::make('seo_contact_description')
                                        ->label('Contact Page Meta Description')
                                        ->rows(2)
                                        ->placeholder('Get in touch with Sri Deekshaa International Academy. Visit our Chennai campus, call us, or book an academic counseling session.')
                                        ->maxLength(160)
                                        ->columnSpanFull(),
                                ]),

                            Section::make('Franchise Opportunities Page (/franchise)')
                                ->description('Accredited center partnership, regional expansion, and franchise investor enquiry portal.')
                                ->schema([
                                    Grid::make(2)->schema([
                                        TextInput::make('seo_franchise_title')
                                            ->label('Franchise Meta Title')
                                            ->placeholder('Franchise Enquiry & Center Locations | Sri Deekshaa International Academy')
                                            ->maxLength(70),

                                        TextInput::make('seo_franchise_keywords')
                                            ->label('Franchise Keywords')
                                            ->placeholder('education franchise, abacus franchise, robotics learning center franchise'),
                                    ]),
                                    Textarea::make('seo_franchise_description')
                                        ->label('Franchise Meta Description')
                                        ->rows(2)
                                        ->placeholder('Explore franchise opportunities with Sri Deekshaa International Academy. Launch an accredited learning center in your city.')
                                        ->maxLength(160)
                                        ->columnSpanFull(),
                                ]),
                        ]),

                    // Tab 2: Courses & Learning Tracks
                    Tab::make('Courses & Tracks')
                        ->icon(Heroicon::OutlinedAcademicCap)
                        ->schema([
                            Section::make('Courses Catalog Page (/courses)')
                                ->description('Full multi-category course catalog listing page with mode and age filters.')
                                ->schema([
                                    Grid::make(2)->schema([
                                        TextInput::make('seo_courses_title')
                                            ->label('Courses Catalog Meta Title')
                                            ->placeholder('All Courses & Programs | Sri Deekshaa International Academy')
                                            ->maxLength(70),

                                        TextInput::make('seo_courses_keywords')
                                            ->label('Courses Catalog Keywords')
                                            ->placeholder('all courses, certified skill programs, abacus classes, coding courses'),
                                    ]),
                                    Textarea::make('seo_courses_description')
                                        ->label('Courses Catalog Meta Description')
                                        ->rows(2)
                                        ->placeholder('Explore skill-based certified courses in Abacus, Vedic Maths, Robotics, Coding, Montessori, and Arts at Sri Deekshaa.')
                                        ->maxLength(160)
                                        ->columnSpanFull(),
                                ]),

                            Section::make('Programs for Kids Page (/programs-for-kids)')
                                ->description('Early learner track tailored for children ages 4 to 10 years.')
                                ->schema([
                                    Grid::make(2)->schema([
                                        TextInput::make('seo_kids_title')
                                            ->label('Kids Programs Meta Title')
                                            ->placeholder('Skill Programs for Kids (Ages 4-10) | Sri Deekshaa Academy')
                                            ->maxLength(70),

                                        TextInput::make('seo_kids_keywords')
                                            ->label('Kids Track Keywords')
                                            ->placeholder('courses for kids, abacus for kids, phonics classes, handwriting'),
                                    ]),
                                    Textarea::make('seo_kids_description')
                                        ->label('Kids Programs Meta Description')
                                        ->rows(2)
                                        ->placeholder('Discover brain-boosting courses for early learners: Abacus Mental Math, Phonics, Creative Arts, and Handwriting.')
                                        ->maxLength(160)
                                        ->columnSpanFull(),
                                ]),

                            Section::make('Programs for Teens Page (/programs-for-teens)')
                                ->description('Advanced STEM, robotics, coding, and competitive skill track for ages 10 to 18.')
                                ->schema([
                                    Grid::make(2)->schema([
                                        TextInput::make('seo_teens_title')
                                            ->label('Teens Programs Meta Title')
                                            ->placeholder('Programs for Teens & Young Achievers | Sri Deekshaa Academy')
                                            ->maxLength(70),

                                        TextInput::make('seo_teens_keywords')
                                            ->label('Teens Track Keywords')
                                            ->placeholder('coding for teens, robotics hackathons, advanced vedic maths, public speaking'),
                                    ]),
                                    Textarea::make('seo_teens_description')
                                        ->label('Teens Programs Meta Description')
                                        ->rows(2)
                                        ->placeholder('Future-ready skills for teenagers: Robotics, Python Coding, Public Speaking, and Vedic Mathematics.')
                                        ->maxLength(160)
                                        ->columnSpanFull(),
                                ]),
                        ]),

                    // Tab 3: Events & Blog
                    Tab::make('Events & Articles')
                        ->icon(Heroicon::OutlinedCalendarDays)
                        ->schema([
                            Section::make('Events & Workshops Page (/events)')
                                ->description('Listing of academy championships, hackathons, and teacher training seminars.')
                                ->schema([
                                    Grid::make(2)->schema([
                                        TextInput::make('seo_events_title')
                                            ->label('Events Listing Meta Title')
                                            ->placeholder('Upcoming Academy Events & Workshops | Sri Deekshaa International Academy')
                                            ->maxLength(70),

                                        TextInput::make('seo_events_keywords')
                                            ->label('Events Keywords')
                                            ->placeholder('abacus competition, robotics championship, student tournaments'),
                                    ]),
                                    Textarea::make('seo_events_description')
                                        ->label('Events Listing Meta Description')
                                        ->rows(2)
                                        ->placeholder('Explore upcoming student championships, robotics hackathons, teacher training seminars, and skill competitions at Sri Deekshaa International Academy.')
                                        ->maxLength(160)
                                        ->columnSpanFull(),
                                ]),

                            Section::make('Blog & Learning Articles Page (/blog)')
                                ->description('Parenting advice, cognitive research insights, and student guide repository.')
                                ->schema([
                                    Grid::make(2)->schema([
                                        TextInput::make('seo_blog_title')
                                            ->label('Blog Listing Meta Title')
                                            ->placeholder('Articles, Parenting Insights & Learning Tips | Sri Deekshaa Blog')
                                            ->maxLength(70),

                                        TextInput::make('seo_blog_keywords')
                                            ->label('Blog Keywords')
                                            ->placeholder('parenting blog, abacus vs vedic maths, child cognitive development'),
                                    ]),
                                    Textarea::make('seo_blog_description')
                                        ->label('Blog Listing Meta Description')
                                        ->rows(2)
                                        ->placeholder('Read expert articles on early child development, Abacus vs Vedic math, phonics education, and creative skills from Sri Deekshaa educators.')
                                        ->maxLength(160)
                                        ->columnSpanFull(),
                                ]),
                        ]),

                    // Tab 4: Interactive Portals & Tools
                    Tab::make('Portals & Verification')
                        ->icon(Heroicon::OutlinedSparkles)
                        ->schema([
                            Section::make('Skill Assessment Quiz Page (/skill-assessment)')
                                ->description('2-minute automated child aptitude diagnostic quiz and course recommender.')
                                ->schema([
                                    Grid::make(2)->schema([
                                        TextInput::make('seo_assessment_title')
                                            ->label('Skill Quiz Meta Title')
                                            ->placeholder('Interactive Skill Assessment & Course Advisor | Sri Deekshaa Academy')
                                            ->maxLength(70),

                                        TextInput::make('seo_assessment_keywords')
                                            ->label('Skill Quiz Keywords')
                                            ->placeholder('child skill quiz, aptitude test, academic track advisor'),
                                    ]),
                                    Textarea::make('seo_assessment_description')
                                        ->label('Skill Quiz Meta Description')
                                        ->rows(2)
                                        ->placeholder('Take our 2-minute interactive skill assessment to discover the best learning track for your child.')
                                        ->maxLength(160)
                                        ->columnSpanFull(),
                                ]),

                            Section::make('Certificate Verification Page (/verify-certificate)')
                                ->description('Official student graduation credentials and certificate lookup portal.')
                                ->schema([
                                    Grid::make(2)->schema([
                                        TextInput::make('seo_verify_title')
                                            ->label('Verification Meta Title')
                                            ->placeholder('Online Certificate Verification | Sri Deekshaa International Academy')
                                            ->maxLength(70),

                                        TextInput::make('seo_verify_keywords')
                                            ->label('Verification Keywords')
                                            ->placeholder('certificate verification, student credential lookup, sri deekshaa certificate'),
                                    ]),
                                    Textarea::make('seo_verify_description')
                                        ->label('Verification Meta Description')
                                        ->rows(2)
                                        ->placeholder('Verify student graduation certificates and international credentials issued by Sri Deekshaa International Academy.')
                                        ->maxLength(160)
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
            ->title('Page SEO meta tags saved successfully!')
            ->success()
            ->send();
    }
}
