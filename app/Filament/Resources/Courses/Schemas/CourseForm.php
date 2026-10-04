<?php

namespace App\Filament\Resources\Courses\Schemas;

use App\Enums\CourseMode;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Str;

class CourseForm
{
    /**
     * Configure the Course Create and Edit Form.
     * The tabs are ordered in the exact visual sequence of the public Course Details page.
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make()->tabs([

                    // 1. Hero & Header Banner (Top of Course Detail Page)
                    Tab::make('Hero & Header')
                        ->icon(Heroicon::OutlinedAcademicCap)
                        ->schema([
                            Section::make('Hero Header & Core Information')
                                ->description('Configure top hero header elements displayed on the course page.')
                                ->schema([
                                    Grid::make(2)->schema([
                                        Select::make('course_category_id')
                                            ->relationship('category', 'name')
                                            ->required()
                                            ->label('Course Category (Domain Badge)'),

                                        Select::make('mode')
                                            ->options(CourseMode::class)
                                            ->required()
                                            ->label('Learning Mode (Campus, Online, Hybrid)'),

                                        TextInput::make('title')
                                            ->required()
                                            ->label('Course Title')
                                            ->placeholder('e.g. Abacus Mental Arithmetic')
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set(
                                                'slug',
                                                Str::slug($state ?? ''),
                                            )),

                                        TextInput::make('slug')
                                            ->required()
                                            ->label('URL Slug')
                                            ->placeholder('e.g. abacus-mental-arithmetic'),

                                        TextInput::make('duration')
                                            ->required()
                                            ->label('Course Duration')
                                            ->placeholder('e.g. 8 Levels (3 Months per Level)'),

                                        Grid::make(2)->schema([
                                            TextInput::make('age_min')
                                                ->numeric()
                                                ->label('Minimum Age (Years)')
                                                ->placeholder('e.g. 5'),

                                            TextInput::make('age_max')
                                                ->numeric()
                                                ->label('Maximum Age (Years)')
                                                ->placeholder('e.g. 15'),
                                        ]),
                                    ]),

                                    Textarea::make('short_description')
                                        ->required()
                                        ->rows(3)
                                        ->columnSpanFull()
                                        ->label('Hero Short Description / Tagline')
                                        ->placeholder('Concise 1-2 sentence value proposition displayed directly under the title in the dark hero header.'),

                                    Grid::make(2)->schema([
                                        TextInput::make('short_code')
                                            ->label('Certificate Short Code')
                                            ->placeholder('e.g. ABA, VM, PHO, MBA')
                                            ->maxLength(10)
                                            ->extraInputAttributes(['style' => 'text-transform: uppercase'])
                                            ->dehydrateStateUsing(fn (?string $state): ?string => $state ? strtoupper(trim($state)) : null)
                                            ->helperText('Short identifier used for certificate numbers (e.g. SDIA-2026-ABA-01)'),

                                        TextInput::make('certificate_name')
                                            ->label('Awarded Credential Title')
                                            ->placeholder('e.g. ISO 9001:2015 Certified Diploma in Mental Arithmetic')
                                            ->helperText('Full credential title displayed on certificates and public page'),
                                    ]),

                                    Grid::make(2)->schema([
                                        FileUpload::make('thumbnail')
                                            ->image()
                                            ->directory('courses/thumbnails')
                                            ->asWebp()
                                            ->label('Course Illustration / Thumbnail Image'),

                                        FileUpload::make('banner_image')
                                            ->image()
                                            ->directory('courses/banners')
                                            ->asWebp()
                                            ->label('Course Hero Banner Background (Optional)'),
                                    ]),
                                ]),
                        ]),

                    // 2. Section 1: About Course
                    Tab::make('1. About Course')
                        ->icon(Heroicon::OutlinedBookOpen)
                        ->schema([
                            Section::make('Section 1: About Course')
                                ->description('First main section on the course page covering the overview story, pedagogy, and eligibility.')
                                ->schema([
                                    RichEditor::make('description')
                                        ->columnSpanFull()
                                        ->label('About Course (Full Overview & Syllabus Story)')
                                        ->placeholder('Describe the course origin, historical background, learning methodology, and overall student journey...'),

                                    Textarea::make('teaching_approach')
                                        ->rows(3)
                                        ->columnSpanFull()
                                        ->label('Pedagogical / Teaching Approach Callout')
                                        ->placeholder('e.g. Two-handed bead manipulation activating left & right hemispheres with progressive mental arithmetic (Anzan) drills.'),

                                    Textarea::make('eligibility')
                                        ->rows(2)
                                        ->columnSpanFull()
                                        ->label('Eligibility Criteria')
                                        ->placeholder('e.g. Children aged 5 to 14 years who can recognize and write numbers from 1 to 50.'),

                                    Grid::make(2)->schema([
                                        TextInput::make('batch_ratio')
                                            ->label('Batch Ratio Badge')
                                            ->default('Max 1 : 8 Mentorship')
                                            ->placeholder('e.g. Max 1 : 8 Mentorship'),

                                        TextInput::make('credential_info')
                                            ->label('Credential / Quality Badge')
                                            ->default('ISO 9001 Certified')
                                            ->placeholder('e.g. ISO 9001 Certified'),
                                    ]),
                                ]),
                        ]),

                    // 3. Section 2: Why Choose This Course
                    Tab::make('2. Why Choose')
                        ->icon(Heroicon::OutlinedStar)
                        ->schema([
                            Section::make('Section 2: Why Choose This Course (Course Benefits)')
                                ->description('Key benefits displayed in the checkmark feature cards grid.')
                                ->schema([
                                    Repeater::make('why_choose')
                                        ->simple(
                                            TextInput::make('point')
                                                ->required()
                                                ->placeholder('e.g. Structured progressive curriculum with continuous milestone checkpoints')
                                        )
                                        ->label('Course Benefit Points')
                                        ->addActionLabel('Add Course Benefit Point')
                                        ->columnSpanFull(),
                                ]),
                        ]),

                    // 4. Section 3: Curriculum & Learning Milestones
                    Tab::make('3. Curriculum')
                        ->icon(Heroicon::OutlinedQueueList)
                        ->schema([
                            Section::make('Section 3: Curriculum & Learning Milestones')
                                ->description('Sequential learning modules and syllabus breakdown.')
                                ->schema([
                                    Repeater::make('modules')
                                        ->relationship()
                                        ->schema([
                                            TextInput::make('title')
                                                ->required()
                                                ->columnSpan(2)
                                                ->label('Module Title')
                                                ->placeholder('e.g. Level 1: Foundational Bead Mastery'),

                                            TextInput::make('duration')
                                                ->columnSpan(1)
                                                ->label('Duration / Hours')
                                                ->placeholder('e.g. 12 Weeks (24 Hours)'),

                                            TextInput::make('sort_order')
                                                ->numeric()
                                                ->default(0)
                                                ->columnSpan(1)
                                                ->label('Sort Order'),

                                            Textarea::make('description')
                                                ->rows(2)
                                                ->columnSpanFull()
                                                ->label('Module Description & Syllabus Details')
                                                ->placeholder('Core concepts covered, practical exercises, and completion criteria.'),
                                        ])
                                        ->columns(4)
                                        ->label('Curriculum Modules')
                                        ->addActionLabel('Add Curriculum Module')
                                        ->columnSpanFull(),
                                ]),
                        ]),

                    // 5. Section 4: Learning Outcomes
                    Tab::make('4. Outcomes')
                        ->icon(Heroicon::OutlinedCheckCircle)
                        ->schema([
                            Section::make('Section 4: Learning Outcomes (Core Competencies)')
                                ->description('Measurable outcomes and cognitive capabilities mastered by learners.')
                                ->schema([
                                    Repeater::make('learning_outcomes')
                                        ->simple(
                                            TextInput::make('point')
                                                ->required()
                                                ->placeholder('e.g. Perform rapid multi-digit mental calculations without calculators or paper')
                                        )
                                        ->label('Learning Outcome Points')
                                        ->addActionLabel('Add Learning Outcome')
                                        ->columnSpanFull(),
                                ]),
                        ]),

                    // 6. Section 5: Why Learn at SDIA
                    Tab::make('5. Why SDIA')
                        ->icon(Heroicon::OutlinedBuildingOffice)
                        ->schema([
                            Section::make('Section 5: Why Learn at SDIA (Institutional Excellence)')
                                ->description('Dark-theme cards highlighting institutional strengths, mentorship ratio, certification, and hybrid infrastructure.')
                                ->schema([
                                    Repeater::make('institution_highlights')
                                        ->schema([
                                            TextInput::make('title')
                                                ->required()
                                                ->label('Highlight Title')
                                                ->placeholder('e.g. Master Certified Mentors'),

                                            TextInput::make('icon')
                                                ->label('FontAwesome Icon Class')
                                                ->placeholder('e.g. fa-solid fa-chalkboard-user'),

                                            Textarea::make('description')
                                                ->rows(2)
                                                ->required()
                                                ->label('Highlight Description')
                                                ->placeholder('Detailed rationale and institutional standard.'),
                                        ])
                                        ->columns(3)
                                        ->itemLabel(fn (array $state): ?string => $state['title'] ?? 'Highlight Card')
                                        ->collapsible()
                                        ->default([
                                            [
                                                'title' => 'Master Certified Mentors',
                                                'icon' => 'fa-solid fa-chalkboard-user',
                                                'description' => 'Certified trainers specialized in cognitive developmental research and individualized pedagogy.',
                                            ],
                                            [
                                                'title' => 'Strict 1:8 Student-Mentor Ratio',
                                                'icon' => 'fa-solid fa-users',
                                                'description' => 'Micro-batches guarantee personalized pace adjustments, real-time error corrections, and individual support.',
                                            ],
                                            [
                                                'title' => 'Physical Kits & Digital Drills',
                                                'icon' => 'fa-solid fa-toolbox',
                                                'description' => 'Every learner receives dedicated hands-on equipment, graded workbooks, and speed-test software tools.',
                                            ],
                                            [
                                                'title' => 'Hybrid Delivery',
                                                'icon' => 'fa-solid fa-laptop',
                                                'description' => 'Study in-person at our modern Chennai campus or join interactive 2-way live online classes worldwide.',
                                            ],
                                            [
                                                'title' => 'Zero Exam Stress',
                                                'icon' => 'fa-solid fa-heart-pulse',
                                                'description' => 'Continuous positive milestone evaluations that celebrate every small step and build an unbreakable growth mindset.',
                                            ],
                                            [
                                                'title' => 'QR-Verifiable Credentials',
                                                'icon' => 'fa-solid fa-qrcode',
                                                'description' => 'ISO 9001 certified credentials backed by our permanent instant public verification portal.',
                                            ],
                                        ])
                                        ->label('Institutional Excellence Cards')
                                        ->addActionLabel('Add Custom Highlight Card')
                                        ->columnSpanFull(),
                                ]),
                        ]),

                    // 7. Section 6: Course for Students
                    Tab::make('6. Students Track')
                        ->icon(Heroicon::OutlinedUserGroup)
                        ->schema([
                            Section::make('Section 6: Course for Students (Student Track)')
                                ->description('Details specific to young learners, student benefits, and target profiles.')
                                ->schema([
                                    Repeater::make('who_is_for')
                                        ->simple(
                                            TextInput::make('point')
                                                ->required()
                                                ->placeholder('e.g. Young learners seeking accelerated numeracy and exam confidence')
                                        )
                                        ->label('Ideal Student Profiles (Who is this course for?)')
                                        ->addActionLabel('Add Ideal Student Profile')
                                        ->columnSpanFull(),

                                    Repeater::make('what_students_gain')
                                        ->simple(
                                            TextInput::make('point')
                                                ->required()
                                                ->placeholder('e.g. Higher school test scores & faster homework turnaround')
                                        )
                                        ->label('What Students Gain (Checklist Points)')
                                        ->addActionLabel('Add Student Takeaway Point')
                                        ->columnSpanFull(),
                                ]),
                        ]),

                    // 8. Section 7: Teacher Training Track (TTC)
                    Tab::make('7. Teacher Track')
                        ->icon(Heroicon::OutlinedIdentification)
                        ->schema([
                            Section::make('Section 7: Teacher Training Track (TTC for Educators)')
                                ->description('Accredited educator certification section for tutors, teachers, and aspiring academy entrepreneurs.')
                                ->schema([
                                    Toggle::make('has_teacher_training')
                                        ->label('Display Teacher Training Track (TTC) Section on this Course Page')
                                        ->default(true)
                                        ->columnSpanFull(),

                                    TextInput::make('teacher_training_title')
                                        ->label('Teacher Track Section Title')
                                        ->placeholder('e.g. Teacher Training Certification (TTC)')
                                        ->columnSpanFull(),

                                    Textarea::make('teacher_training_description')
                                        ->rows(3)
                                        ->label('Teacher Track Overview Description')
                                        ->placeholder('Are you a school educator, tuition teacher, or aspiring academic entrepreneur? Our specialized Teacher Training Certification equips you with global pedagogy, comprehensive lesson kits, and certification to teach professionally.')
                                        ->columnSpanFull(),

                                    Repeater::make('teacher_training_highlights')
                                        ->schema([
                                            TextInput::make('title')
                                                ->required()
                                                ->label('Card Title')
                                                ->placeholder('e.g. Authorized Trainer Certification'),

                                            Textarea::make('description')
                                                ->rows(2)
                                                ->required()
                                                ->label('Card Description')
                                                ->placeholder('Earn recognized credentials from Sri Deekshaa to conduct certified classes in schools or private tutoring.'),
                                        ])
                                        ->columns(2)
                                        ->itemLabel(fn (array $state): ?string => $state['title'] ?? 'Feature Card')
                                        ->collapsible()
                                        ->default([
                                            [
                                                'title' => 'Authorized Trainer Certification',
                                                'description' => 'Earn recognized credentials from Sri Deekshaa to conduct certified classes in schools, learning centers, or private tutoring.',
                                            ],
                                            [
                                                'title' => 'Complete Lesson Plans & Kits',
                                                'description' => 'Receive full teacher guidebooks, student practice sheets, lesson-by-lesson agendas, and demonstration kits.',
                                            ],
                                            [
                                                'title' => 'Child Psychology & Class Management',
                                                'description' => 'Master student engagement techniques, micro-pacing, identifying developmental roadblocks, and parent communication.',
                                            ],
                                            [
                                                'title' => 'Academy Startup & Entrepreneurship',
                                                'description' => 'Guidance and marketing materials to start your own after-school academy, home center, or weekend batch.',
                                            ],
                                        ])
                                        ->label('Teacher Training Feature Cards')
                                        ->addActionLabel('Add Teacher Training Feature Card')
                                        ->columnSpanFull(),
                                ]),
                        ]),

                    // 9. Section 8: Frequently Asked Questions
                    Tab::make('8. FAQs')
                        ->icon(Heroicon::OutlinedQuestionMarkCircle)
                        ->schema([
                            Section::make('Section 8: Frequently Asked Questions')
                                ->description('Interactive accordion FAQs answering prospective parent and student queries.')
                                ->schema([
                                    Repeater::make('faqs')
                                        ->relationship()
                                        ->schema([
                                            TextInput::make('question')
                                                ->required()
                                                ->columnSpanFull()
                                                ->label('Question')
                                                ->placeholder('e.g. What is the ideal age group for this course?'),

                                            Textarea::make('answer')
                                                ->required()
                                                ->rows(3)
                                                ->columnSpanFull()
                                                ->label('Answer')
                                                ->placeholder('Detailed clear answer explaining schedules, formats, or credentials.'),
                                        ])
                                        ->label('Course FAQs')
                                        ->addActionLabel('Add FAQ Question')
                                        ->columnSpanFull(),
                                ]),
                        ]),

                    // 10. Pricing, Schedule & Sidebar
                    Tab::make('Fee & Schedule')
                        ->icon(Heroicon::OutlinedCurrencyRupee)
                        ->schema([
                            Section::make('Sidebar Enrollment & Fee Card')
                                ->description('Fee per level, batch schedules, and quick guarantee checklist points shown in the sticky right sidebar.')
                                ->schema([
                                    Grid::make(2)->schema([
                                        TextInput::make('fee')
                                            ->numeric()
                                            ->prefix('INR')
                                            ->label('Course Fee (per level)')
                                            ->placeholder('e.g. 3500'),

                                        Textarea::make('class_schedule')
                                            ->rows(2)
                                            ->label('Class Schedule Details')
                                            ->placeholder('e.g. Weekend batches (2 hours/session) or Weekday evenings (1 hour, twice a week).'),
                                    ]),

                                    Repeater::make('guarantee_checklist')
                                        ->simple(
                                            TextInput::make('point')
                                                ->required()
                                                ->placeholder('e.g. Personalized 1-on-1 trial session available')
                                        )
                                        ->default([
                                            'Personalized 1-on-1 trial session available',
                                            'Official certificate upon completion',
                                            'Weekend and weekday batch options',
                                        ])
                                        ->label('Sidebar Guarantee Checklist Points')
                                        ->addActionLabel('Add Checklist Item')
                                        ->columnSpanFull(),
                                ]),
                        ]),

                    // 11. Publishing & SEO
                    Tab::make('Publishing & SEO')
                        ->icon(Heroicon::OutlinedGlobeAlt)
                        ->schema([
                            Section::make('Course Visibility & Settings')
                                ->schema([
                                    Grid::make(3)->schema([
                                        Toggle::make('is_active')
                                            ->label('Active (Publicly Visible)')
                                            ->default(true),

                                        Toggle::make('is_featured')
                                            ->label('Featured on Home'),

                                        TextInput::make('sort_order')
                                            ->numeric()
                                            ->default(0)
                                            ->label('Sort Order Index'),
                                    ]),
                                ]),

                            Section::make('Search Engine Optimization (SEO)')
                                ->schema([
                                    TextInput::make('meta_title')
                                        ->label('SEO Meta Title')
                                        ->placeholder('e.g. Abacus Mental Arithmetic Course | Sri Deekshaa Academy'),

                                    Textarea::make('meta_description')
                                        ->rows(3)
                                        ->label('SEO Meta Description')
                                        ->placeholder('Engaging meta description for search engine result snippets...'),

                                    TextInput::make('meta_keywords')
                                        ->label('SEO Meta Keywords (Comma separated)')
                                        ->placeholder('abacus, mental arithmetic, speed math, brain development'),

                                    TextInput::make('canonical_url')
                                        ->url()
                                        ->label('Canonical URL (Optional)'),
                                ]),
                        ]),

                ])->columnSpanFull(),
            ]);
    }
}
