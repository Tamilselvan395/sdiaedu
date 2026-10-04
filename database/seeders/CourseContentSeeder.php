<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseContentSeeder extends Seeder
{
    /**
     * Run the database seeds to populate all section content in the database.
     */
    public function run(): void
    {
        $coursesData = [
            'abacus' => [
                'batch_ratio' => 'Max 1 : 8 Mentorship',
                'credential_info' => 'ISO 9001:2015 Accredited',
                'what_students_gain' => [
                    'Lightning-fast mental calculation speed without calculator or scratchpad',
                    'Photographic memory retention and spatial bead visualization capabilities',
                    'Laser-sharp focus, longer attention span, and active listening reflexes',
                    'Total eradication of mathematics anxiety and elevated school grades',
                ],
                'has_teacher_training' => true,
                'teacher_training_title' => 'Abacus Teacher Training Certification (TTC)',
                'teacher_training_description' => 'Become an authorized Abacus educator. Master the complete 8-level Soroban syllabus, kinesthetic bead pedagogy, mental Anzan training, and start your own successful learning center.',
                'teacher_training_highlights' => [
                    [
                        'title' => 'Master Trainer Certification',
                        'description' => 'ISO 9001 accredited qualification to train and certify students across schools and private centers.',
                    ],
                    [
                        'title' => 'Complete Teaching Kit & Manuals',
                        'description' => 'Receive teacher demonstration sorobans, 8 levels of graded workbooks, and speed flashcard decks.',
                    ],
                    [
                        'title' => 'Anzan & Speed Pedagogy',
                        'description' => 'Master the neuro-developmental techniques of teaching mental bead visualization and auditory drills.',
                    ],
                    [
                        'title' => 'Academy Franchise & Setup',
                        'description' => 'Complete business blueprint, student assessment tools, and branding support to launch your batch.',
                    ],
                ],
                'institution_highlights' => [
                    [
                        'title' => 'Master Certified Mentors',
                        'icon' => 'fa-solid fa-chalkboard-user',
                        'description' => 'Specialized Abacus trainers certified with ongoing neuro-cognitive developmental research.',
                    ],
                    [
                        'title' => 'Strict 1:8 Student-Mentor Ratio',
                        'icon' => 'fa-solid fa-users',
                        'description' => 'Micro-batches guarantee personalized finger technique corrections and individual pace adjustments.',
                    ],
                    [
                        'title' => 'Physical Kits & Digital Drills',
                        'icon' => 'fa-solid fa-toolbox',
                        'description' => 'Every learner receives dedicated Japanese Soroban equipment, graded workbooks, and speed software.',
                    ],
                    [
                        'title' => 'Hybrid In-Person & Online Delivery',
                        'icon' => 'fa-solid fa-laptop',
                        'description' => 'Study at our modern Chennai campus or join interactive 2-way live online classes worldwide.',
                    ],
                    [
                        'title' => 'Zero Exam Stress Atmosphere',
                        'icon' => 'fa-solid fa-heart-pulse',
                        'description' => 'Continuous positive milestone evaluations that celebrate every small step and build confidence.',
                    ],
                    [
                        'title' => 'QR-Verifiable Credentials',
                        'icon' => 'fa-solid fa-qrcode',
                        'description' => 'ISO 9001 certified graduation certificates backed by our permanent instant public verification portal.',
                    ],
                ],
                'guarantee_checklist' => [
                    'Personalized 1-on-1 trial session available',
                    'Official certificate with QR verification upon completion',
                    'Weekend and weekday batch options available',
                    'Dedicated parent progress review after each level',
                ],
            ],

            'vedic-maths' => [
                'batch_ratio' => 'Max 1 : 8 Mentorship',
                'credential_info' => 'ISO 9001:2015 Accredited',
                'what_students_gain' => [
                    'Solve complex multi-digit calculations 10x to 15x faster than conventional methods',
                    'Cross-check mathematical answers in 3 seconds using Digit Sum sutras',
                    'Definitive competitive advantage in Olympiads, NTSE, JEE, and competitive tests',
                    'Enhanced algebraic mental factorization and root extraction abilities',
                ],
                'has_teacher_training' => true,
                'teacher_training_title' => 'Vedic Mathematics Teacher Training Certification (TTC)',
                'teacher_training_description' => 'Master the 16 ancient Vedic Sutras and 13 Sub-Sutras. Learn structured pedagogical strategies to teach fast mental arithmetic to middle and high school students.',
                'teacher_training_highlights' => [
                    [
                        'title' => 'Certified Vedic Maths Master',
                        'description' => 'Accredited credential certifying you to teach Vedic Mathematics across schools and academies.',
                    ],
                    [
                        'title' => 'Sutra-by-Sutra Lesson Plans',
                        'description' => 'Comprehensive teacher manuals, formula derivation guides, and competitive exam speed drill sheets.',
                    ],
                    [
                        'title' => 'Competitive Coaching Pedagogy',
                        'description' => 'Specialized strategies to coach students for Olympiads, NTSE, and entrance examination speed.',
                    ],
                    [
                        'title' => 'Independent Coaching Blueprint',
                        'description' => 'Step-by-step guidance to launch online and weekend coaching batches with proven marketing strategies.',
                    ],
                ],
                'institution_highlights' => [
                    [
                        'title' => 'Master Vedic Scholars',
                        'icon' => 'fa-solid fa-chalkboard-user',
                        'description' => 'Experienced mathematics mentors trained in classical sutras and high-speed competitive shortcuts.',
                    ],
                    [
                        'title' => 'Strict 1:8 Student-Mentor Ratio',
                        'icon' => 'fa-solid fa-users',
                        'description' => 'Individual attention to ensure complete clarity in shortcut derivation and mental verification.',
                    ],
                    [
                        'title' => 'Speed Drills & Olympiad Kits',
                        'icon' => 'fa-solid fa-toolbox',
                        'description' => 'Curated formula handbooks, daily mental worksheets, and timed speed challenges.',
                    ],
                    [
                        'title' => 'Hybrid In-Person & Online Delivery',
                        'icon' => 'fa-solid fa-laptop',
                        'description' => 'Attend interactive Chennai classroom workshops or join live interactive digital cohorts.',
                    ],
                    [
                        'title' => 'Joyful Math Mindset',
                        'icon' => 'fa-solid fa-heart-pulse',
                        'description' => 'Transforms math dread into a captivating game of speed, patterns, and instant solutions.',
                    ],
                    [
                        'title' => 'QR-Verifiable Credentials',
                        'icon' => 'fa-solid fa-qrcode',
                        'description' => 'Recognized certification backed by our 24/7 public online verification portal.',
                    ],
                ],
                'guarantee_checklist' => [
                    'Personalized 1-on-1 trial session available',
                    'Official certificate with QR verification upon completion',
                    'Weekend and weekday batch options available',
                    'Immediate measurable boost in calculation speed',
                ],
            ],

            'phonics' => [
                'batch_ratio' => 'Max 1 : 6 Mentorship',
                'credential_info' => 'Synthetic Phonics Certified',
                'what_students_gain' => [
                    'Master 42 core letter sounds and blend them effortlessly into words',
                    'Read unknown multi-syllable storybooks without hesitation or guessing',
                    'Develop clear English pronunciation, rich vocabulary, and spoken confidence',
                    'Cultivate a lifelong love for reading and independent comprehension',
                ],
                'has_teacher_training' => true,
                'teacher_training_title' => 'Synthetic Phonics Teacher Training Certification (TTC)',
                'teacher_training_description' => 'Equip yourself with international synthetic phonics methodologies. Learn multi-sensory teaching tools, decodable reader sequencing, and early childhood literacy frameworks.',
                'teacher_training_highlights' => [
                    [
                        'title' => 'Accredited Phonics Specialist',
                        'description' => 'Certified credentials to teach early literacy and synthetic phonics in international and Montessori schools.',
                    ],
                    [
                        'title' => 'Multi-Sensory Teaching Kit',
                        'description' => 'Complete action flashcards, audio sound guides, decodable reader sets, and tactile tracing resources.',
                    ],
                    [
                        'title' => 'Early Childhood Literacy Pedagogy',
                        'description' => 'Strategies to identify speech impediments, pronunciation hurdles, and reading hesitation in young minds.',
                    ],
                    [
                        'title' => 'Tuition & Preschool Center Setup',
                        'description' => 'Full curriculum roadmap to conduct phonics foundation workshops and parent orientation sessions.',
                    ],
                ],
                'institution_highlights' => [
                    [
                        'title' => 'Certified Phonics Mentors',
                        'icon' => 'fa-solid fa-chalkboard-user',
                        'description' => 'Empathetic early childhood educators specializing in multi-sensory synthetic phonics.',
                    ],
                    [
                        'title' => 'Micro-Batches (1:6 Ratio)',
                        'icon' => 'fa-solid fa-users',
                        'description' => 'Ensures individual articulation observation and personalized phoneme correction.',
                    ],
                    [
                        'title' => 'Hands-On Sound Kits & Readers',
                        'icon' => 'fa-solid fa-toolbox',
                        'description' => 'Sensory sandpaper letters, sound buttons, decodable storybooks, and phonics games.',
                    ],
                    [
                        'title' => 'Interactive Hybrid Batches',
                        'icon' => 'fa-solid fa-laptop',
                        'description' => 'Engaging on-campus audio-visual classrooms and vibrant live interactive online sessions.',
                    ],
                    [
                        'title' => 'Play-Way Stress-Free Learning',
                        'icon' => 'fa-solid fa-heart-pulse',
                        'description' => 'Songs, kinesthetic actions, and colorful story characters make reading an exciting adventure.',
                    ],
                    [
                        'title' => 'Tamper-Proof Certification',
                        'icon' => 'fa-solid fa-qrcode',
                        'description' => 'Official certificate with instant QR code validation honoring early reading milestones.',
                    ],
                ],
                'guarantee_checklist' => [
                    'Personalized 1-on-1 trial session available',
                    'Official certificate with QR verification upon completion',
                    'Flexible morning and evening micro-batches',
                    'Independent book reading milestone within 90 days',
                ],
            ],

            'mid-brain-activation' => [
                'batch_ratio' => 'Max 1 : 6 Mentorship',
                'credential_info' => 'Neuro-Cognitive Certified',
                'what_students_gain' => [
                    'Heightened intuitive sensory perception and spatial awareness',
                    'Synchronization of left logical and right creative brain hemispheres',
                    'Dramatic improvement in concentration span and photographic recall',
                    'Emotional equanimity, stress reduction, and positive academic mindset',
                ],
                'has_teacher_training' => true,
                'teacher_training_title' => 'Mid Brain Activation Trainer Certification (TTC)',
                'teacher_training_description' => 'Learn soundwave stimulation techniques, brain gym protocols, and blindfold sensory exercises to conduct high-impact cognitive workshops for children.',
                'teacher_training_highlights' => [
                    [
                        'title' => 'Neuro-Cognitive Master Trainer',
                        'description' => 'Authorized trainer credentials to lead certified Mid Brain and brain gym workshops.',
                    ],
                    [
                        'title' => 'Soundwave & Acoustic Protocols',
                        'description' => 'Access to specialized alpha acoustic frequencies, blindfold sensory test cards, and diagnostic kits.',
                    ],
                    [
                        'title' => 'Brain Gym & Cross-Lateral Drills',
                        'description' => 'Step-by-step kinesiology exercises for brain hemisphere balancing and hyper-focus induction.',
                    ],
                    [
                        'title' => 'Workshop Marketing Blueprint',
                        'description' => 'Marketing materials, live demonstration scripts, and parental orientation presentation decks.',
                    ],
                ],
                'institution_highlights' => [
                    [
                        'title' => 'Neuro-Development Specialists',
                        'icon' => 'fa-solid fa-chalkboard-user',
                        'description' => 'Experienced practitioners trained in alpha-wave stimulation and cognitive psychology.',
                    ],
                    [
                        'title' => 'Ultra-Focused 1:6 Batches',
                        'icon' => 'fa-solid fa-users',
                        'description' => 'Guarantees calm, individualized guidance throughout sensory activation exercises.',
                    ],
                    [
                        'title' => 'Brain Gym & Blindfold Kits',
                        'icon' => 'fa-solid fa-toolbox',
                        'description' => 'Professional sensory testing cards, eye-masks, and specialized acoustic relaxation soundscapes.',
                    ],
                    [
                        'title' => 'Chennai Campus & Hybrid Sessions',
                        'icon' => 'fa-solid fa-laptop',
                        'description' => 'State-of-the-art sensory-friendly environment at our campus with guided home routines.',
                    ],
                    [
                        'title' => 'Zero Stress & Deep Calm',
                        'icon' => 'fa-solid fa-heart-pulse',
                        'description' => 'Promotes emotional composure, reduced screen fatigue, and relaxed focus.',
                    ],
                    [
                        'title' => 'Recognized Level Credentials',
                        'icon' => 'fa-solid fa-qrcode',
                        'description' => 'Tamper-proof verifiable certification honoring cognitive milestone accomplishments.',
                    ],
                ],
                'guarantee_checklist' => [
                    'Personalized 1-on-1 trial session available',
                    'Official certificate with QR verification upon completion',
                    'Weekend intensive workshop schedules',
                    'Parent orientation and guided home practice protocol',
                ],
            ],

            'quantum-speed-reading' => [
                'batch_ratio' => 'Max 1 : 6 Mentorship',
                'credential_info' => 'QSR Certified Pedagogy',
                'what_students_gain' => [
                    'Flip through books and absorb central ideas in minutes through right-brain image processing',
                    'Expand peripheral vision field and master rapid saccadic eye movements',
                    'Dramatically cut study time for academic exams while boosting retention',
                    'Develop vivid mental imagery and intuitive information mapping',
                ],
                'has_teacher_training' => true,
                'teacher_training_title' => 'Quantum Speed Reading Instructor Certification (TTC)',
                'teacher_training_description' => 'Master the advanced Japanese right-brain rapid reading methodology and receive complete training manuals to guide students through high-speed reading.',
                'teacher_training_highlights' => [
                    [
                        'title' => 'Certified QSR Instructor',
                        'description' => 'Accredited international instructor certificate to teach Quantum Speed Reading professionally.',
                    ],
                    [
                        'title' => 'Saccadic Eye & After-Image Kits',
                        'description' => 'Complete optical expansion cards, 3D image charts, and rapid page-turning drill manuals.',
                    ],
                    [
                        'title' => 'Right-Brain Imaging Pedagogy',
                        'description' => 'Techniques to activate high-speed photographic comprehension without vocalization barriers.',
                    ],
                    [
                        'title' => 'Reading Studio Business Setup',
                        'description' => 'Guidance on setting up dedicated reading labs and running holiday speed-reading bootcamps.',
                    ],
                ],
                'institution_highlights' => [
                    [
                        'title' => 'Certified Speed Reading Coaches',
                        'icon' => 'fa-solid fa-chalkboard-user',
                        'description' => 'Specialists trained in Japanese right-brain reading and ophthalmological eye movement drills.',
                    ],
                    [
                        'title' => 'Micro-Mentorship 1:6 Batches',
                        'icon' => 'fa-solid fa-users',
                        'description' => 'Careful monitoring of reading rhythm, posture, and comprehension recall accuracy.',
                    ],
                    [
                        'title' => 'Eye Muscle & After-Image Tools',
                        'icon' => 'fa-solid fa-toolbox',
                        'description' => 'Specialized optical training plates, high-speed flip materials, and comprehension rubrics.',
                    ],
                    [
                        'title' => 'Campus & Digital Practice',
                        'icon' => 'fa-solid fa-laptop',
                        'description' => 'Structured physical workshops supported by guided daily digital peripheral vision drills.',
                    ],
                    [
                        'title' => 'Effortless Joyful Learning',
                        'icon' => 'fa-solid fa-heart-pulse',
                        'description' => 'Eliminates textbook exhaustion and turns book reading into an exhilarating visual experience.',
                    ],
                    [
                        'title' => 'ISO 9001 Certified Milestone',
                        'icon' => 'fa-solid fa-qrcode',
                        'description' => 'Verifiable graduation certificate confirming measured Words-Per-Minute reading speeds.',
                    ],
                ],
                'guarantee_checklist' => [
                    'Personalized 1-on-1 trial session available',
                    'Official certificate with QR verification upon completion',
                    'Weekend and evening session availability',
                    'Measured 3x to 5x reading speed improvement guarantee',
                ],
            ],

            'spell-bee' => [
                'batch_ratio' => 'Max 1 : 8 Mentorship',
                'credential_info' => 'International Spelling League',
                'what_students_gain' => [
                    'Master Greek, Latin, French, and German root words and etymology rules',
                    'Expand active vocabulary by over 1,500 advanced words',
                    'Overcome stage fright with simulated buzzer rounds and live spelling bees',
                    'Develop sharp auditory phonetic processing and memory retention',
                ],
                'has_teacher_training' => true,
                'teacher_training_title' => 'Spell Bee & Vocabulary Coach Certification (TTC)',
                'teacher_training_description' => 'Train to coach school students for national and international spell bee competitions. Master phonetic rules, root word classification, and buzzer contest prep.',
                'teacher_training_highlights' => [
                    [
                        'title' => 'Certified Spell Bee Coach',
                        'description' => 'Recognized credential as an official competitive spelling coach for schools and private cohorts.',
                    ],
                    [
                        'title' => 'Etymology & Root Word Dictionaries',
                        'description' => 'Comprehensive master wordlists, pronunciation audio keys, and origin classification guides.',
                    ],
                    [
                        'title' => 'Stage & Buzzer Contest Simulation',
                        'description' => 'Methods to host inter-school spelling tournaments, buzzer rounds, and timed sudden-death stages.',
                    ],
                    [
                        'title' => 'Center Launch Blueprint',
                        'description' => 'Turnkey curriculum and marketing materials to run year-round competitive English language clubs.',
                    ],
                ],
                'institution_highlights' => [
                    [
                        'title' => 'Linguistics & Etymology Mentors',
                        'icon' => 'fa-solid fa-chalkboard-user',
                        'description' => 'Passionate vocabulary trainers with championship coaching credentials and phonetic mastery.',
                    ],
                    [
                        'title' => '1:8 Micro-Group Practice',
                        'icon' => 'fa-solid fa-users',
                        'description' => 'Ensures every learner gets extensive turn-taking, pronunciation drills, and oral spelling practice.',
                    ],
                    [
                        'title' => 'Buzzer Systems & Word Banks',
                        'icon' => 'fa-solid fa-toolbox',
                        'description' => 'Access to official competition buzzer hardware, curated root-word flashcards, and online mock tests.',
                    ],
                    [
                        'title' => 'Hybrid In-Person & Online Delivery',
                        'icon' => 'fa-solid fa-laptop',
                        'description' => 'Join live classroom spelling bees at our campus or participate in multi-city digital bees.',
                    ],
                    [
                        'title' => 'Fearless Stage Confidence',
                        'icon' => 'fa-solid fa-heart-pulse',
                        'description' => 'Transform stage anxiety into poise, quick thinking, and articulate public expression.',
                    ],
                    [
                        'title' => 'Tamper-Proof QR Certification',
                        'icon' => 'fa-solid fa-qrcode',
                        'description' => 'Permanent verifiable certificate detailing competitive level benchmarks and word mastery.',
                    ],
                ],
                'guarantee_checklist' => [
                    'Personalized 1-on-1 trial session available',
                    'Official certificate with QR verification upon completion',
                    'Flexible weekend tournament prep schedules',
                    'Comprehensive competitive championship word bank',
                ],
            ],

            'rubiks-cube' => [
                'batch_ratio' => 'Max 1 : 6 Mentorship',
                'credential_info' => 'WCA Standard Method',
                'what_students_gain' => [
                    'Solve the 3x3 Rubik\'s Cube in under 60 seconds with CFOP speed algorithms',
                    'Expand spatial intelligence, pattern recognition, and 3D visualization',
                    'Build immense patience, cognitive perseverance, and problem-solving grit',
                    'Master specialty twisty puzzles including 2x2, 4x4, and Pyraminx',
                ],
                'has_teacher_training' => true,
                'teacher_training_title' => 'Rubik\'s Cube & Speedcubing Coach Certification (TTC)',
                'teacher_training_description' => 'Learn how to teach cube notation, beginner layer-by-layer methods, and advanced speedcubing algorithms to children with gamified lesson plans.',
                'teacher_training_highlights' => [
                    [
                        'title' => 'Authorized Speedcubing Coach',
                        'description' => 'Certified credentials to conduct accredited Rubik\'s Cube workshops in schools and clubs.',
                    ],
                    [
                        'title' => 'Algorithm Sheets & Visual Guides',
                        'description' => 'F2L, OLL, PLL formula charts, finger-trick video references, and step-by-step beginner guides.',
                    ],
                    [
                        'title' => 'Multi-Puzzle Pedagogy',
                        'description' => 'Curriculum progression from 2x2, 3x3, 4x4 cubes through Pyraminx and Mirror cubes.',
                    ],
                    [
                        'title' => 'Speedcubing Academy Setup',
                        'description' => 'Complete playbook to organize local speedcubing championships and run weekend puzzle clubs.',
                    ],
                ],
                'institution_highlights' => [
                    [
                        'title' => 'WCA Ranked Speedcubers',
                        'icon' => 'fa-solid fa-chalkboard-user',
                        'description' => 'Championship mentors who teach advanced finger tricks, ergonomic rotations, and algorithm memorization.',
                    ],
                    [
                        'title' => 'Strict 1:6 Student-Mentor Ratio',
                        'icon' => 'fa-solid fa-users',
                        'description' => 'Personal observation of every rotation, preventing bad habits and optimizing solving speed.',
                    ],
                    [
                        'title' => 'Competition Cubes & Timers',
                        'icon' => 'fa-solid fa-toolbox',
                        'description' => 'Magnetic speedcubes, lubricant kits, and official tournament touch-mat timing displays.',
                    ],
                    [
                        'title' => 'Campus & Live Digital Cohorts',
                        'icon' => 'fa-solid fa-laptop',
                        'description' => 'Interactive hands-on classroom coaching in Chennai paired with step-by-step online streams.',
                    ],
                    [
                        'title' => 'Growth Mindset & Resilience',
                        'icon' => 'fa-solid fa-heart-pulse',
                        'description' => 'Teaches students that every scramble has a structured algorithm to solve it.',
                    ],
                    [
                        'title' => 'QR-Verifiable Credentials',
                        'icon' => 'fa-solid fa-qrcode',
                        'description' => 'Official speedcubing certificate indicating verified personal best solving times.',
                    ],
                ],
                'guarantee_checklist' => [
                    'Personalized 1-on-1 trial session available',
                    'Official certificate with QR verification upon completion',
                    'Weekend and holiday bootcamps available',
                    'Guaranteed 100% independent solve within the first module',
                ],
            ],

            'chess' => [
                'batch_ratio' => 'Max 1 : 6 Mentorship',
                'credential_info' => 'FIDE Standard Curriculum',
                'what_students_gain' => [
                    'Deep strategic foresight, planning 3 to 5 moves ahead under clock pressure',
                    'Mastery over classical openings, middle-game tactics, and endgame conversions',
                    'Unwavering patience, emotional resilience, and calculated decision-making',
                    'Readiness for official FIDE rated district and state tournaments',
                ],
                'has_teacher_training' => true,
                'teacher_training_title' => 'Chess Coaching Certification (TTC)',
                'teacher_training_description' => 'Acquire structured training techniques to teach chess fundamentals, tactical puzzles, opening repertoires, and tournament clock discipline to young learners.',
                'teacher_training_highlights' => [
                    [
                        'title' => 'FIDE Aligned Chess Trainer',
                        'description' => 'Accredited coaching credential recognized across schools, academies, and private training.',
                    ],
                    [
                        'title' => 'Curated Puzzles & Database',
                        'description' => 'Access to over 10,000 tactical puzzle databases, opening repertoire trees, and PGN files.',
                    ],
                    [
                        'title' => 'Tournament Clock & Arbiter Rules',
                        'description' => 'Comprehensive instruction in official tournament laws, tie-breaks, notation, and clock rules.',
                    ],
                    [
                        'title' => 'Club & Academy Management',
                        'description' => 'Complete blueprint to establish rated tournaments, summer camps, and weekly chess leagues.',
                    ],
                ],
                'institution_highlights' => [
                    [
                        'title' => 'FIDE Rated Chess Masters',
                        'icon' => 'fa-solid fa-chalkboard-user',
                        'description' => 'Experienced tournament players and certified coaches focused on tactical calculation.',
                    ],
                    [
                        'title' => 'Micro-Group 1:6 Batches',
                        'icon' => 'fa-solid fa-users',
                        'description' => 'In-depth post-game analysis of every student\'s games to identify tactical blindspots.',
                    ],
                    [
                        'title' => 'Tournament Boards & Clocks',
                        'icon' => 'fa-solid fa-toolbox',
                        'description' => 'Weighted tournament regulation boards, digital DGT chess clocks, and software analysis engines.',
                    ],
                    [
                        'title' => 'Hybrid In-Person & Online Delivery',
                        'icon' => 'fa-solid fa-laptop',
                        'description' => 'Campus league play combined with live interactive masterclasses on digital analysis platforms.',
                    ],
                    [
                        'title' => 'Grace Under Pressure',
                        'icon' => 'fa-solid fa-heart-pulse',
                        'description' => 'Builds emotional stability, sportsmanship, and mental stamina during tense match situations.',
                    ],
                    [
                        'title' => 'QR-Verifiable Credentials',
                        'icon' => 'fa-solid fa-qrcode',
                        'description' => 'Recognized certification validating tactical proficiency and tournament readiness.',
                    ],
                ],
                'guarantee_checklist' => [
                    'Personalized 1-on-1 trial session available',
                    'Official certificate with QR verification upon completion',
                    'Weekend and evening tournament batches',
                    'Weekly intra-academy rating tournament matches included',
                ],
            ],

            'drawing-and-coloring' => [
                'batch_ratio' => 'Max 1 : 8 Mentorship',
                'credential_info' => 'Fine Arts Board Certified',
                'what_students_gain' => [
                    'Flawless pencil control, proportion estimation, and contour line drafting',
                    'Mastery of color wheel harmony, smooth blending, and shading gradients',
                    'Boosted creative expression, imaginative thinking, and fine motor coordination',
                    'Confidence to participate and win in school art competitions and exhibitions',
                ],
                'has_teacher_training' => true,
                'teacher_training_title' => 'Art & Drawing Educator Certification (TTC)',
                'teacher_training_description' => 'Master step-by-step progressive drawing pedagogy for children, material selection, medium transitions, and setting up a neighborhood art studio.',
                'teacher_training_highlights' => [
                    [
                        'title' => 'Certified Art Educator',
                        'description' => 'Fine Arts certified credential qualifying you to teach children\'s art programs in schools and studios.',
                    ],
                    [
                        'title' => 'Graded Curriculum Manuals',
                        'description' => 'Step-by-step drawing templates, color mixing charts, perspective guides, and lesson plans.',
                    ],
                    [
                        'title' => 'Medium Versatility Training',
                        'description' => 'Instruction in graphite, oil pastels, soft pastels, watercolor cakes, and colored pencils.',
                    ],
                    [
                        'title' => 'Art Studio Business Blueprint',
                        'description' => 'Guidance on organizing student exhibitions, art camps, sourcing wholesale materials, and marketing.',
                    ],
                ],
                'institution_highlights' => [
                    [
                        'title' => 'Professional Fine Artists',
                        'icon' => 'fa-solid fa-chalkboard-user',
                        'description' => 'Practicing artists and certified art educators passionate about nurturing young talent.',
                    ],
                    [
                        'title' => '1:8 Studio Mentorship',
                        'icon' => 'fa-solid fa-users',
                        'description' => 'Easel-side guidance ensuring correct wrist movement, stroke pressure, and blending technique.',
                    ],
                    [
                        'title' => 'Premium Art Grade Materials',
                        'icon' => 'fa-solid fa-toolbox',
                        'description' => 'High-GSM cartridge papers, artist-grade pastels, shading pencils, and blending stumps.',
                    ],
                    [
                        'title' => 'Campus Studio & Digital Sessions',
                        'icon' => 'fa-solid fa-laptop',
                        'description' => 'Well-lit creative art studio in Chennai along with multi-camera live online classes.',
                    ],
                    [
                        'title' => 'Therapeutic Creative Calm',
                        'icon' => 'fa-solid fa-heart-pulse',
                        'description' => 'Screen-free artistic immersion that relieves academic tension and develops aesthetic appreciation.',
                    ],
                    [
                        'title' => 'Exhibition & QR Credentials',
                        'icon' => 'fa-solid fa-qrcode',
                        'description' => 'Official certificate honoring artistic milestones backed by instant public QR verification.',
                    ],
                ],
                'guarantee_checklist' => [
                    'Personalized 1-on-1 trial session available',
                    'Official certificate with QR verification upon completion',
                    'Weekend and after-school batch timings',
                    'Student portfolio exhibition feature included',
                ],
            ],

            'art-and-craft' => [
                'batch_ratio' => 'Max 1 : 8 Mentorship',
                'credential_info' => 'Certified Creative Arts',
                'what_students_gain' => [
                    'Proficiency in origami, paper mache, clay modeling, and recycled craft creations',
                    'Refined bilateral hand coordination, finger dexterity, and tactile sensory development',
                    'Inventive problem solving by transforming raw materials into beautiful artifacts',
                    'Joyful screen-free creative bonding, self-reliance, and artistic pride',
                ],
                'has_teacher_training' => true,
                'teacher_training_title' => 'Art & Craft Instructor Certification (TTC)',
                'teacher_training_description' => 'Learn to plan seasonal craft curriculums, organize creative summer camps, source child-safe materials, and lead engaging hands-on craft workshops.',
                'teacher_training_highlights' => [
                    [
                        'title' => 'Certified Craft Specialist',
                        'description' => 'Accredited credential to teach diverse handicrafts, clay crafts, and origami in schools and activity clubs.',
                    ],
                    [
                        'title' => 'Complete DIY Project Manuals',
                        'description' => 'Over 80 curated age-graded project blueprints with material lists, templates, and safety guidelines.',
                    ],
                    [
                        'title' => 'Clay & Papercraft Masterclasses',
                        'description' => 'Detailed techniques in polymer clay, air-dry clay, quilling, 3D papercraft, and festive decor.',
                    ],
                    [
                        'title' => 'Holiday Camp Business Setup',
                        'description' => 'How to launch profitable holiday craft camps, mother-toddler workshops, and after-school clubs.',
                    ],
                ],
                'institution_highlights' => [
                    [
                        'title' => 'Creative Master Crafters',
                        'icon' => 'fa-solid fa-chalkboard-user',
                        'description' => 'Expert artisans specializing in child-safe tactile crafts, modeling, and mixed-media art.',
                    ],
                    [
                        'title' => '1:8 Interactive Craft Studio',
                        'icon' => 'fa-solid fa-users',
                        'description' => 'Safe, hands-on assistance with scissors, clay sculpting tools, and precision folding.',
                    ],
                    [
                        'title' => 'Non-Toxic DIY Craft Kits',
                        'icon' => 'fa-solid fa-toolbox',
                        'description' => 'Eco-friendly craft papers, non-toxic clays, quilling tools, and recycled craft materials.',
                    ],
                    [
                        'title' => 'Campus Studio & Hybrid Workshops',
                        'icon' => 'fa-solid fa-laptop',
                        'description' => 'Spacious Chennai creative workspace with step-by-step home delivery project kits.',
                    ],
                    [
                        'title' => 'Tactile Screen-Free Exploration',
                        'icon' => 'fa-solid fa-heart-pulse',
                        'description' => 'Boosts imaginative joy, tactile curiosity, and independent creative building.',
                    ],
                    [
                        'title' => 'Tamper-Proof QR Certification',
                        'icon' => 'fa-solid fa-qrcode',
                        'description' => 'Official certificate honoring creative craftsmanship and project mastery.',
                    ],
                ],
                'guarantee_checklist' => [
                    'Personalized 1-on-1 trial session available',
                    'Official certificate with QR verification upon completion',
                    'Flexible weekend and holiday batch options',
                    'All project artifacts taken home by students',
                ],
            ],

            'calligraphy' => [
                'batch_ratio' => 'Max 1 : 6 Mentorship',
                'credential_info' => 'Certified Penmanship Master',
                'what_students_gain' => [
                    'Precision nib control, ink flow regulation, and consistent 45-degree angle stroke technique',
                    'Mastery over Roman Roundhand, Gothic Blackletter, and modern brush lettering',
                    'Heightened aesthetic sensibility, patience, and fine motor precision',
                    'Skill to create customized invitations, certificates, and artistic lettering pieces',
                ],
                'has_teacher_training' => true,
                'teacher_training_title' => 'Calligraphy & Lettering Trainer Certification (TTC)',
                'teacher_training_description' => 'Learn classical calligraphy alphabets, nib diagnostics, guideline grids, and how to conduct successful lettering workshops for students and adults.',
                'teacher_training_highlights' => [
                    [
                        'title' => 'Master Penmanship Certification',
                        'description' => 'Recognized credential validating your expertise in traditional and contemporary calligraphy fonts.',
                    ],
                    [
                        'title' => 'Exemplar Slates & Grids',
                        'description' => 'High-resolution ductus guidelines, slant grids, letter proportion ratios, and practice sheets.',
                    ],
                    [
                        'title' => 'Nib & Medium Ergonomics',
                        'description' => 'Complete understanding of broad edge nibs, pointed dip pens, parallel pens, and specialty inks.',
                    ],
                    [
                        'title' => 'Calligraphy Workshop Business',
                        'description' => 'Blueprint to host weekend adult workshops, corporate calligraphy events, and personalized commissions.',
                    ],
                ],
                'institution_highlights' => [
                    [
                        'title' => 'Master Calligraphers',
                        'icon' => 'fa-solid fa-chalkboard-user',
                        'description' => 'Practicing lettering artists with deep knowledge of historical scripts and contemporary styles.',
                    ],
                    [
                        'title' => 'Strict 1:6 Nib Mentorship',
                        'icon' => 'fa-solid fa-users',
                        'description' => 'Micro-guidance on nib angle, paper friction, pen pressure, and ink feathering prevention.',
                    ],
                    [
                        'title' => 'Specialized Lettering Kits',
                        'icon' => 'fa-solid fa-toolbox',
                        'description' => 'Pilot Parallel pens, fountain nibs, sumi inks, rhodia guideline pads, and brush markers.',
                    ],
                    [
                        'title' => 'Studio & HD Digital Macro Feeds',
                        'icon' => 'fa-solid fa-laptop',
                        'description' => 'Classroom sessions with high-definition overhead cameras capturing every delicate ink stroke.',
                    ],
                    [
                        'title' => 'Meditative Focus & Discipline',
                        'icon' => 'fa-solid fa-heart-pulse',
                        'description' => 'Calligraphy provides a calming, zen-like mindfulness experience that resets mental fatigue.',
                    ],
                    [
                        'title' => 'QR-Verifiable Credentials',
                        'icon' => 'fa-solid fa-qrcode',
                        'description' => 'Official certificate honoring mastery of classical letterforms and ink craftsmanship.',
                    ],
                ],
                'guarantee_checklist' => [
                    'Personalized 1-on-1 trial session available',
                    'Official certificate with QR verification upon completion',
                    'Weekend and evening masterclass batches',
                    'Take-home premium calligraphy pen kit included',
                ],
            ],

            'handwriting' => [
                'batch_ratio' => 'Max 1 : 8 Mentorship',
                'credential_info' => 'Graphology-Backed Method',
                'what_students_gain' => [
                    'Clear, legible, and aesthetically consistent cursive and print handwriting',
                    'Correction of pencil grip, posture, and hand fatigue for long exam papers',
                    'Substantial increase in writing speed without sacrificing neatness',
                    'Higher academic grades as examiners easily read clean test answer sheets',
                ],
                'has_teacher_training' => true,
                'teacher_training_title' => 'Handwriting Improvement Coach Certification (TTC)',
                'teacher_training_description' => 'Learn scientific handwriting analysis, motor therapy exercises, grip correction tools, and progressive speed writing drills to tutor struggling students.',
                'teacher_training_highlights' => [
                    [
                        'title' => 'Certified Handwriting Analyst & Coach',
                        'description' => 'Recognized grapho-motor specialist certificate to consult and coach students in schools and centers.',
                    ],
                    [
                        'title' => 'Diagnostic Assessment Rubrics',
                        'description' => 'Comprehensive evaluation charts analyzing slant, spacing, letter size, margins, and pen pressure.',
                    ],
                    [
                        'title' => 'Motor Therapy & Grip Correction',
                        'description' => 'Ergonomic exercises and specialized silicone grips to eliminate writer\'s cramp and wrist strain.',
                    ],
                    [
                        'title' => 'High-Demand Coaching Practice',
                        'description' => 'Proven marketing strategies to partner with schools and run high-volume exam-prep handwriting clinics.',
                    ],
                ],
                'institution_highlights' => [
                    [
                        'title' => 'Graphology & Motor Specialists',
                        'icon' => 'fa-solid fa-chalkboard-user',
                        'description' => 'Expert handwriting remediation specialists addressing underlying motor and spatial factors.',
                    ],
                    [
                        'title' => 'Strict 1:8 Student-Mentor Ratio',
                        'icon' => 'fa-solid fa-users',
                        'description' => 'Individual letter-by-letter analysis with immediate physical grip and posture feedback.',
                    ],
                    [
                        'title' => 'Scientific Workbooks & Grips',
                        'icon' => 'fa-solid fa-toolbox',
                        'description' => 'Custom four-line, double-line, and single-line transition pads with ergonomic pencil aids.',
                    ],
                    [
                        'title' => 'Campus & Online Live Correction',
                        'icon' => 'fa-solid fa-laptop',
                        'description' => 'In-person classroom guidance with digital high-resolution document camera review.',
                    ],
                    [
                        'title' => 'Exam Fatigue Elimination',
                        'icon' => 'fa-solid fa-heart-pulse',
                        'description' => 'Enables children to write 3-hour board exams effortlessly without hand cramps or messy pages.',
                    ],
                    [
                        'title' => 'QR-Verifiable Credentials',
                        'icon' => 'fa-solid fa-qrcode',
                        'description' => 'Official certification demonstrating verified speed and legibility transformation.',
                    ],
                ],
                'guarantee_checklist' => [
                    'Personalized 1-on-1 trial session available',
                    'Official certificate with QR verification upon completion',
                    'Weekend and weekday evening batches',
                    'Guaranteed visible legibility transformation within 15 sessions',
                ],
            ],

            'carnatic-music' => [
                'batch_ratio' => 'Max 1 : 6 Mentorship',
                'credential_info' => 'Bridge to Music Board Exams',
                'what_students_gain' => [
                    'Flawless pitch alignment (Shruti Shuddham) and rhythmic precision (Talam)',
                    'Mastery of foundational Sarali, Jantai, Dhatu Varisais, and Alankarams',
                    'Progressive learning of classic Geethams, Swarajathis, and Varnams',
                    'Confidence to perform live recitals and appear for certified music board exams',
                ],
                'has_teacher_training' => true,
                'teacher_training_title' => 'Carnatic Vocal Teaching Certification (TTC)',
                'teacher_training_description' => 'Learn structured vocal pedagogy, voice culture techniques, talam training tools, and syllabus breakdown for certified grade examinations.',
                'teacher_training_highlights' => [
                    [
                        'title' => 'Certified Carnatic Vocal Guru',
                        'description' => 'Accredited music educator credential recognized for vocal coaching and exam preparation.',
                    ],
                    [
                        'title' => 'Systematic Abhyasa Gana Manuals',
                        'description' => 'Full notation books for varisais, alankarams in 3 speeds, geethams, and varnams in Mayamalavagowla and Shankarabharanam.',
                    ],
                    [
                        'title' => 'Voice Culture & Breath Control',
                        'description' => 'Specialized vocal warm-ups, range expansion techniques, and gamaka ornamentation pedagogy.',
                    ],
                    [
                        'title' => 'Sangeetha Gurukulam Setup',
                        'description' => 'Blueprint to launch an authentic home or online music school with structured grade grading.',
                    ],
                ],
                'institution_highlights' => [
                    [
                        'title' => 'Vidwans & Certified Vocalists',
                        'icon' => 'fa-solid fa-chalkboard-user',
                        'description' => 'Seasoned concert performers from traditional lineages dedicated to disciplined teaching.',
                    ],
                    [
                        'title' => 'Strict 1:6 Vocal Mentorship',
                        'icon' => 'fa-solid fa-users',
                        'description' => 'Individual pitch listening to ensure no learner sings off-key or loses talam rhythm.',
                    ],
                    [
                        'title' => 'Electronic Tanpura & Notation',
                        'icon' => 'fa-solid fa-toolbox',
                        'description' => 'Digital shruti boxes, metronomes, authentic notation guides, and audio reference tracks.',
                    ],
                    [
                        'title' => 'Hybrid In-Person & Online Delivery',
                        'icon' => 'fa-solid fa-laptop',
                        'description' => 'Acoustically treated Chennai music studio along with crystal-clear 2-way online vocal rooms.',
                    ],
                    [
                        'title' => 'Spiritual & Emotional Harmony',
                        'icon' => 'fa-solid fa-heart-pulse',
                        'description' => 'Classical ragas promote deep inner peace, concentration, and cultural groundedness.',
                    ],
                    [
                        'title' => 'QR-Verifiable Credentials',
                        'icon' => 'fa-solid fa-qrcode',
                        'description' => 'Official certificate aligned with certified music board milestones.',
                    ],
                ],
                'guarantee_checklist' => [
                    'Personalized 1-on-1 trial session available',
                    'Official certificate with QR verification upon completion',
                    'Weekend and weekday morning/evening schedules',
                    'Stage performance recital opportunities included',
                ],
            ],

            'keyboard' => [
                'batch_ratio' => 'Max 1 : 6 Mentorship',
                'credential_info' => 'Trinity & ABRSM Aligned',
                'what_students_gain' => [
                    'Fluent musical staff notation sight-reading in both treble and bass clefs',
                    'Two-hand independent coordination, fingering technique, and chord harmonizations',
                    'Mastery of major/minor scales, arpeggios, and expressive dynamic playing',
                    'Preparation for international music examinations (Trinity College London)',
                ],
                'has_teacher_training' => true,
                'teacher_training_title' => 'Electronic Keyboard Instructor Certification (TTC)',
                'teacher_training_description' => 'Master international keyboard curriculum sequencing, sight-reading pedagogy, MIDI arrangement basics, and private piano/keyboard studio setup.',
                'teacher_training_highlights' => [
                    [
                        'title' => 'Trinity-Aligned Certified Teacher',
                        'description' => 'Accredited music educator certificate recognized for grooming students for grade examinations.',
                    ],
                    [
                        'title' => 'Sight-Reading & Theory Curriculum',
                        'description' => 'Graded staff notation workbooks, ear-training exercises, and dynamic fingering blueprints.',
                    ],
                    [
                        'title' => 'Arranger & Lead Sheet Skills',
                        'description' => 'Methods to teach keyboard auto-accompaniment, chord progressions, and modern pop/classical pieces.',
                    ],
                    [
                        'title' => 'Private Music Studio Setup',
                        'description' => 'Equipment recommendation, studio soundproofing, exam registration, and student recruitment guide.',
                    ],
                ],
                'institution_highlights' => [
                    [
                        'title' => 'Trinity Certified Pianists',
                        'icon' => 'fa-solid fa-chalkboard-user',
                        'description' => 'Experienced Western music educators trained in classical piano and contemporary keyboard styles.',
                    ],
                    [
                        'title' => 'Strict 1:6 Key Mentorship',
                        'icon' => 'fa-solid fa-users',
                        'description' => 'Direct observation of finger curvature, wrist posture, and tempo regularity on dedicated keys.',
                    ],
                    [
                        'title' => 'Full-Size Touch Keyboards',
                        'icon' => 'fa-solid fa-toolbox',
                        'description' => 'Velocity-sensitive weighted keyboards, sustain pedals, sheet music stands, and metronomes.',
                    ],
                    [
                        'title' => 'Campus Studio & MIDI Online Feeds',
                        'icon' => 'fa-solid fa-laptop',
                        'description' => 'Modern lab in Chennai with direct MIDI-to-screen feedback for seamless online instruction.',
                    ],
                    [
                        'title' => 'Neuro-Cognitive Synchronization',
                        'icon' => 'fa-solid fa-heart-pulse',
                        'description' => 'Playing with both hands stimulates neural pathways linking rhythm, sight, and motor coordination.',
                    ],
                    [
                        'title' => 'Tamper-Proof QR Certification',
                        'icon' => 'fa-solid fa-qrcode',
                        'description' => 'Official certificate indicating completed grades and performance repertoire.',
                    ],
                ],
                'guarantee_checklist' => [
                    'Personalized 1-on-1 trial session available',
                    'Official certificate with QR verification upon completion',
                    'Weekend and evening batch slots available',
                    'Dedicated keyboard assigned to each student in class',
                ],
            ],

            'classical-dance' => [
                'batch_ratio' => 'Max 1 : 8 Mentorship',
                'credential_info' => 'Natya Board Aligned',
                'what_students_gain' => [
                    'Crisp footwork (Adavus), authentic body geometry (Aramandi), and stamina',
                    'Expressive storytelling through classic Asamyuta and Samyuta Hasthas (Mudras)',
                    'Deep rhythmic synchronization with complex Tala cycles and solkattu',
                    'Graceful stage poise and preparation for Salangai Pooja and Arangetram',
                ],
                'has_teacher_training' => true,
                'teacher_training_title' => 'Bharatanatyam Dance Educator Certification (TTC)',
                'teacher_training_description' => 'Learn structured Natyashastra theory, adavu sequencing, nattuvangam rhythm recitation, costume design, and student stage choreography.',
                'teacher_training_highlights' => [
                    [
                        'title' => 'Certified Natya Guru',
                        'description' => 'Accredited dance educator credential authorizing you to run classical dance academies and stage shows.',
                    ],
                    [
                        'title' => 'Natyashastra & Abhinaya Syllabi',
                        'description' => 'Complete theoretical manuals covering shlokas, navarasas, hasta viniyogas, and tala structures.',
                    ],
                    [
                        'title' => 'Nattuvangam & Rhythm Recitation',
                        'description' => 'Hands-on training in reciting sollukattu rhythm syllables and playing the brass talam cymbals.',
                    ],
                    [
                        'title' => 'Arangetram & Academy Guidance',
                        'description' => 'Step-by-step framework to prepare senior disciples for Salangai Pooja, Arangetram, and dance exams.',
                    ],
                ],
                'institution_highlights' => [
                    [
                        'title' => 'Accomplished Natya Vidushis',
                        'icon' => 'fa-solid fa-chalkboard-user',
                        'description' => 'Senior exponents from prestigious Kalakshetra and classical traditions with rich stage careers.',
                    ],
                    [
                        'title' => '1:8 Personalized Natya Batches',
                        'icon' => 'fa-solid fa-users',
                        'description' => 'Close postural corrections ensuring clean lines, accurate foot stomps, and expressive eyes.',
                    ],
                    [
                        'title' => 'Mirrored Dance Studios',
                        'icon' => 'fa-solid fa-toolbox',
                        'description' => 'Sprung wooden dance flooring, full-length wall mirrors, and live nattuvangam rhythm support.',
                    ],
                    [
                        'title' => 'Campus & Online Live Streams',
                        'icon' => 'fa-solid fa-laptop',
                        'description' => 'Spacious Chennai dance hall with wide-angle multi-camera online streaming.',
                    ],
                    [
                        'title' => 'Cultural Poise & Physical Stamina',
                        'icon' => 'fa-solid fa-heart-pulse',
                        'description' => 'Builds incredible lower-body strength, core endurance, discipline, and cultural devotion.',
                    ],
                    [
                        'title' => 'QR-Verifiable Credentials',
                        'icon' => 'fa-solid fa-qrcode',
                        'description' => 'Official certificate validating completed adavu grades and margam repertoire.',
                    ],
                ],
                'guarantee_checklist' => [
                    'Personalized 1-on-1 trial session available',
                    'Official certificate with QR verification upon completion',
                    'Weekend and weekday evening batches',
                    'Annual stage performance and Salangai Pooja opportunities',
                ],
            ],

            'western-and-folk-dance' => [
                'batch_ratio' => 'Max 1 : 10 Mentorship',
                'credential_info' => 'Certified Performance Arts',
                'what_students_gain' => [
                    'Rhythm-driven footwork, dynamic body isolations, and groove synchronization',
                    'Immense cardiovascular stamina, full-body flexibility, and agility',
                    'Fearless stage presence and expressive emotional performance',
                    'Ensemble synchronization and team choreography synchronization',
                ],
                'has_teacher_training' => true,
                'teacher_training_title' => 'Western & Folk Dance Trainer Certification (TTC)',
                'teacher_training_description' => 'Learn music count breakdowns, warm-up safety protocols, age-appropriate choreography styles, and setting up dynamic dance studios.',
                'teacher_training_highlights' => [
                    [
                        'title' => 'Certified Dance Choreographer',
                        'description' => 'Accredited dance instructor certificate to teach hip-hop, contemporary, and folk routines.',
                    ],
                    [
                        'title' => '8-Count Breakdown Manuals',
                        'description' => 'Choreography blueprints across hip-hop foundations, jazz funk, lyrical, and regional folk dances.',
                    ],
                    [
                        'title' => 'Injury Prevention & Safe Warming',
                        'description' => 'Kinesiology principles for safe stretching, dynamic joint warm-ups, and student safety.',
                    ],
                    [
                        'title' => 'Dance Studio & Event Setup',
                        'description' => 'How to coordinate school annual days, corporate flash mobs, dance battles, and studio classes.',
                    ],
                ],
                'institution_highlights' => [
                    [
                        'title' => 'Celebrated Choreographers',
                        'icon' => 'fa-solid fa-chalkboard-user',
                        'description' => 'High-energy professional dancers with credits in stage productions, reality shows, and competitions.',
                    ],
                    [
                        'title' => 'Personalized 1:10 Groups',
                        'icon' => 'fa-solid fa-users',
                        'description' => 'Dynamic group synergy with individualized coaching on timing, lines, and stage presence.',
                    ],
                    [
                        'title' => 'High-Fidelity Sound Studios',
                        'icon' => 'fa-solid fa-toolbox',
                        'description' => 'Acoustic audio surround systems, full mirrored rehearsal halls, and safety-padded dance floors.',
                    ],
                    [
                        'title' => 'Campus & Digital Practice',
                        'icon' => 'fa-solid fa-laptop',
                        'description' => 'Vibrant studio sessions in Chennai along with step-by-step video practice breakdowns.',
                    ],
                    [
                        'title' => 'Cardio Energy & Euphoria',
                        'icon' => 'fa-solid fa-heart-pulse',
                        'description' => 'An exhilarating aerobic workout that burns calories, elevates mood, and banishes shyness.',
                    ],
                    [
                        'title' => 'QR-Verifiable Credentials',
                        'icon' => 'fa-solid fa-qrcode',
                        'description' => 'Official certificate validating choreography routines and stage performance excellence.',
                    ],
                ],
                'guarantee_checklist' => [
                    'Personalized 1-on-1 trial session available',
                    'Official certificate with QR verification upon completion',
                    'Weekend and evening batch options',
                    'Showcase videos and recital participation included',
                ],
            ],

            'karate' => [
                'batch_ratio' => 'Max 1 : 10 Mentorship',
                'credential_info' => 'WKF & KAI Aligned',
                'what_students_gain' => [
                    'Effective self-defense reflexes and tactical awareness against confrontation',
                    'Ironclad mental discipline, respect for teachers/peers, and unwavering focus',
                    'Explosive core strength, cardiovascular stamina, and body flexibility',
                    'Official colored belt grading leading up to Black Belt recognition',
                ],
                'has_teacher_training' => true,
                'teacher_training_title' => 'Karate Martial Arts Instructor Certification (TTC)',
                'teacher_training_description' => 'Master traditional Kata, Kihon, and controlled Kumite safety standards, dojo discipline management, and belt examination refereeing.',
                'teacher_training_highlights' => [
                    [
                        'title' => 'Certified Black Belt Sensei',
                        'description' => 'Recognized martial arts instructor certification allowing you to open your own Dojo.',
                    ],
                    [
                        'title' => 'Kihon, Kata & Kumite Manuals',
                        'description' => 'Detailed curriculum manuals for White to Black belt grading syllabus and refereeing rules.',
                    ],
                    [
                        'title' => 'Self-Defense & Dojo Discipline',
                        'description' => 'Pedagogy for child safety, anti-bullying coaching, practical street defense, and mindfulness.',
                    ],
                    [
                        'title' => 'Dojo Management & Tournaments',
                        'description' => 'Complete framework to affiliate with state boards, host belt exams, and organize tournaments.',
                    ],
                ],
                'institution_highlights' => [
                    [
                        'title' => 'Black Belt 5th Dan Senseis',
                        'icon' => 'fa-solid fa-chalkboard-user',
                        'description' => 'Nationally certified master instructors with decades of martial arts and refereeing experience.',
                    ],
                    [
                        'title' => 'Disciplined 1:10 Dojo Batches',
                        'icon' => 'fa-solid fa-users',
                        'description' => 'Strict oversight on strike alignment, blocking angles, and controlled contact safety.',
                    ],
                    [
                        'title' => 'Padded Mats & Sparring Gear',
                        'icon' => 'fa-solid fa-toolbox',
                        'description' => 'Shock-absorbing tatami mats, focus pads, kicking shields, and certified protective guards.',
                    ],
                    [
                        'title' => 'Chennai Dojo & Hybrid Sessions',
                        'icon' => 'fa-solid fa-laptop',
                        'description' => 'Traditional dojo atmosphere in Chennai with live digital form practice and correction.',
                    ],
                    [
                        'title' => 'Confidence & Anti-Bullying Grit',
                        'icon' => 'fa-solid fa-heart-pulse',
                        'description' => 'Develops courage, calm composure under threat, and deep humility toward peers.',
                    ],
                    [
                        'title' => 'Recognized Belt Credentials',
                        'icon' => 'fa-solid fa-qrcode',
                        'description' => 'Official belt certification backed by 24/7 online credential validation portal.',
                    ],
                ],
                'guarantee_checklist' => [
                    'Personalized 1-on-1 trial session available',
                    'Official certificate with QR verification upon completion',
                    'Morning and evening dojo training times',
                    'Official belt grading examinations twice a year',
                ],
            ],

            'silambam' => [
                'batch_ratio' => 'Max 1 : 10 Mentorship',
                'credential_info' => 'Traditional Tamil Martial Board',
                'what_students_gain' => [
                    'Mastery of traditional bamboo staff spins (Veechu), stances, and footwork',
                    'Lightning-fast hand-eye reflexes and 360-degree spatial peripheral awareness',
                    'Incredible wrist strength, core balance, and whole-body agility',
                    'Deep connection to indigenous martial heritage and tournament eligibility',
                ],
                'has_teacher_training' => true,
                'teacher_training_title' => 'Traditional Silambam Asaan Certification (TTC)',
                'teacher_training_description' => 'Preserve and teach ancient Tamil martial arts. Master staff spinning mechanics, sparring safety rules, Por Silambam, and school coaching protocols.',
                'teacher_training_highlights' => [
                    [
                        'title' => 'Certified Silambam Asaan',
                        'description' => 'Recognized master instructor certificate to teach Silambam across schools and cultural centers.',
                    ],
                    [
                        'title' => 'Spinning & Por Silambam Syllabi',
                        'description' => 'Full breakdown of Ottaiveechu, Erattaiveechu, Por Silambam defensive blocks, and weapon forms.',
                    ],
                    [
                        'title' => 'Youth Heritage & Fitness Coaching',
                        'description' => 'Curriculum adapted for young learners to build motor reflexes, agility, and historical reverence.',
                    ],
                    [
                        'title' => 'Silambam Kalari Setup',
                        'description' => 'Guidance on running outdoor academies, conducting demonstrations, and registering with state associations.',
                    ],
                ],
                'institution_highlights' => [
                    [
                        'title' => 'Master Asaan Instructors',
                        'icon' => 'fa-solid fa-chalkboard-user',
                        'description' => 'Traditional master trainers from hereditary lineages preserving authentic Dravidian martial arts.',
                    ],
                    [
                        'title' => '1:10 Safe Sparring Batches',
                        'icon' => 'fa-solid fa-users',
                        'description' => 'Ensures correct staff grips, fluid rotational momentum, and safe sparring distances.',
                    ],
                    [
                        'title' => 'Seasoned Bamboo Staves',
                        'icon' => 'fa-solid fa-toolbox',
                        'description' => 'Authentic seasoned Thara bamboo sticks sized to each student\'s height, plus safety gear.',
                    ],
                    [
                        'title' => 'Spacious Training Grounds',
                        'icon' => 'fa-solid fa-laptop',
                        'description' => 'Open-air and covered traditional training arenas in Chennai with video masterclasses.',
                    ],
                    [
                        'title' => 'Peak Physical Agility & Reflexes',
                        'icon' => 'fa-solid fa-heart-pulse',
                        'description' => 'Continuous rotational momentum strengthens wrists, shoulders, and cardiovascular capacity.',
                    ],
                    [
                        'title' => 'QR-Verifiable Credentials',
                        'icon' => 'fa-solid fa-qrcode',
                        'description' => 'Official certificate recognized for sports quotas and tournament participation.',
                    ],
                ],
                'guarantee_checklist' => [
                    'Personalized 1-on-1 trial session available',
                    'Official certificate with QR verification upon completion',
                    'Morning outdoor and evening indoor options',
                    'State tournament and demonstration eligibility',
                ],
            ],

            'yoga' => [
                'batch_ratio' => 'Max 1 : 8 Mentorship',
                'credential_info' => 'Yoga Alliance Aligned',
                'what_students_gain' => [
                    'Enhanced spinal flexibility, muscular balance, and ergonomic body posture',
                    'Controlled breathing techniques (Pranayama) to instantly ease stress and anxiety',
                    'Sharper mental focus, longer study concentration, and deeper restful sleep',
                    'Immune system boost, metabolic balance, and grounded emotional calm',
                ],
                'has_teacher_training' => true,
                'teacher_training_title' => 'Yoga & Mindfulness Teacher Training (YTT 200)',
                'teacher_training_description' => 'Accredited yoga instructor program covering asana biomechanics, pranayama science, yoga philosophy, child anatomy, and therapeutic sequencing.',
                'teacher_training_highlights' => [
                    [
                        'title' => 'Certified Yoga Acharya (YTT 200)',
                        'description' => 'Accredited qualification to teach Hatha, Vinyasa, and kids\' yoga internationally.',
                    ],
                    [
                        'title' => 'Asana Biomechanics & Anatomy',
                        'description' => 'In-depth manuals on skeletal alignment, muscular adjustments, contraindications, and therapy.',
                    ],
                    [
                        'title' => 'Pranayama & Meditation Science',
                        'description' => 'Master classical breath control methods (Nadi Shodhana, Bhastrika) and guided mindfulness.',
                    ],
                    [
                        'title' => 'Yoga Studio & Retreat Business',
                        'description' => 'Complete playbook to launch wellness studios, corporate sessions, and weekend retreats.',
                    ],
                ],
                'institution_highlights' => [
                    [
                        'title' => 'Certified Yoga Acharyas',
                        'icon' => 'fa-solid fa-chalkboard-user',
                        'description' => 'Traditional yoga masters combining Vedic philosophy with contemporary biomechanics.',
                    ],
                    [
                        'title' => 'Mindful 1:8 Asana Mentorship',
                        'icon' => 'fa-solid fa-users',
                        'description' => 'Careful personal alignment adjustments preventing hyperextension or strain.',
                    ],
                    [
                        'title' => 'Natural Eco Mats & Props',
                        'icon' => 'fa-solid fa-toolbox',
                        'description' => 'Organic cotton/rubber yoga mats, yoga blocks, straps, bolsters, and meditation cushions.',
                    ],
                    [
                        'title' => 'Serene Studio & Online Sangha',
                        'icon' => 'fa-solid fa-laptop',
                        'description' => 'Peaceful, light-filled Chennai yoga shala with calming live online morning sessions.',
                    ],
                    [
                        'title' => 'Holistic Mind-Body Balance',
                        'icon' => 'fa-solid fa-heart-pulse',
                        'description' => 'Restores physical energy, relieves school desk stiffness, and calms an overstimulated mind.',
                    ],
                    [
                        'title' => 'Tamper-Proof QR Certification',
                        'icon' => 'fa-solid fa-qrcode',
                        'description' => 'Recognized credential validating asana mastery and holistic mindfulness hours.',
                    ],
                ],
                'guarantee_checklist' => [
                    'Personalized 1-on-1 trial session available',
                    'Official certificate with QR verification upon completion',
                    'Early morning sunrise and evening relaxation batches',
                    'Personalized posture and wellness guidance report',
                ],
            ],

            'zumba-and-fitness' => [
                'batch_ratio' => 'Max 1 : 10 Mentorship',
                'credential_info' => 'Certified Fitness Specialist',
                'what_students_gain' => [
                    'High-energy calorie burning and cardiovascular endurance improvement',
                    'Better motor coordination, musical rhythm matching, and joint mobility',
                    'Release of endorphins that elevate mood, self-confidence, and energy levels',
                    'Lifelong habit of active physical health and enthusiastic wellness',
                ],
                'has_teacher_training' => true,
                'teacher_training_title' => 'Kids & Youth Fitness Instructor Certification (TTC)',
                'teacher_training_description' => 'Learn motivational cueing, safe plyometric movements, high-low impact choreography adjustments, and group fitness class management.',
                'teacher_training_highlights' => [
                    [
                        'title' => 'Certified Youth Fitness Coach',
                        'description' => 'Accredited fitness instructor credential to lead youth aerobic and Zumba classes.',
                    ],
                    [
                        'title' => 'Latin & Pop Choreography Sets',
                        'description' => 'Ready-to-teach 45-minute playlist routines with salsa, merengue, reggaeton, and pop tracks.',
                    ],
                    [
                        'title' => 'Child Physiology & Heart-Rate Zones',
                        'description' => 'Safe aerobic pacing, hydration protocols, and engaging active games for young age groups.',
                    ],
                    [
                        'title' => 'Fitness Club & Studio Launch',
                        'description' => 'Turnkey business blueprint to partner with schools, gyms, and residential gated communities.',
                    ],
                ],
                'institution_highlights' => [
                    [
                        'title' => 'Licensed Zumba Instructors',
                        'icon' => 'fa-solid fa-chalkboard-user',
                        'description' => 'Dynamic, enthusiastic fitness trainers specializing in child and adolescent cardio wellness.',
                    ],
                    [
                        'title' => 'High-Energy 1:10 Micro Groups',
                        'icon' => 'fa-solid fa-users',
                        'description' => 'Encouraging atmosphere with personalized attention to safe movement form and posture.',
                    ],
                    [
                        'title' => 'Shock-Absorbing Aerobic Floors',
                        'icon' => 'fa-solid fa-toolbox',
                        'description' => 'Joint-friendly sprung wooden flooring, high-energy sound beats, and light resistance props.',
                    ],
                    [
                        'title' => 'Campus Studio & Virtual Workouts',
                        'icon' => 'fa-solid fa-laptop',
                        'description' => 'Exciting studio in Chennai paired with motivating, high-energy live virtual workouts.',
                    ],
                    [
                        'title' => 'Pure Joy & Stress Relief',
                        'icon' => 'fa-solid fa-heart-pulse',
                        'description' => 'Dances away academic fatigue and instills a lifelong enthusiasm for active fitness.',
                    ],
                    [
                        'title' => 'QR-Verifiable Credentials',
                        'icon' => 'fa-solid fa-qrcode',
                        'description' => 'Official certificate honoring endurance milestones and fitness accomplishments.',
                    ],
                ],
                'guarantee_checklist' => [
                    'Personalized 1-on-1 trial session available',
                    'Official certificate with QR verification upon completion',
                    'Weekend and evening after-school slots',
                    'Fun fitness tracking and progress recognition awards',
                ],
            ],

            'gymnastics' => [
                'batch_ratio' => 'Max 1 : 8 Mentorship',
                'credential_info' => 'Gymnastics Federation Standards',
                'what_students_gain' => [
                    'Superb core strength, hamstring flexibility, and joint range of motion',
                    'Mastery over foundational tumbling: forward/backward rolls, handstands, and cartwheels',
                    'Acrobatic spatial orientation, balance beam control, and landing safety',
                    'Overcoming fear of physical obstacles with disciplined coach guidance',
                ],
                'has_teacher_training' => true,
                'teacher_training_title' => 'Gymnastics & Tumbling Coach Certification (TTC)',
                'teacher_training_description' => 'Learn apparatus spotting safety, progressive tumbling drills, flexibility conditioning, injury prevention, and competitive coaching.',
                'teacher_training_highlights' => [
                    [
                        'title' => 'Certified Gymnastics Coach',
                        'description' => 'Accredited coaching credential adhering to standard artistic gymnastics guidelines.',
                    ],
                    [
                        'title' => 'Progressive Spotting Techniques',
                        'description' => 'Hands-on manuals detailing spotting mechanics for handstands, walkovers, round-offs, and flips.',
                    ],
                    [
                        'title' => 'Flexibility & Strength Protocols',
                        'description' => 'Specific conditioning routines for shoulder opening, back bridges, and split flexibility.',
                    ],
                    [
                        'title' => 'Gymnastics Club Setup',
                        'description' => 'Apparatus sourcing guide, safety pit requirements, insurance, and student progression badges.',
                    ],
                ],
                'institution_highlights' => [
                    [
                        'title' => 'National Gymnastics Coaches',
                        'icon' => 'fa-solid fa-chalkboard-user',
                        'description' => 'Former competitive gymnasts and certified spotters trained in child biomechanics.',
                    ],
                    [
                        'title' => 'Safe 1:8 Spotting Ratio',
                        'icon' => 'fa-solid fa-users',
                        'description' => 'Strict coach-to-student supervision ensures no child attempts a skill without spotting support.',
                    ],
                    [
                        'title' => 'Olympic-Grade Safety Mats',
                        'icon' => 'fa-solid fa-toolbox',
                        'description' => 'Thick crash pads, low balance beams, air tracks, vaulting blocks, and springboards.',
                    ],
                    [
                        'title' => 'Dedicated Chennai Gymnasium',
                        'icon' => 'fa-solid fa-laptop',
                        'description' => 'Fully equipped indoor gymnastic facility with video playback for form analysis.',
                    ],
                    [
                        'title' => 'Fearlessness & Spatial Agility',
                        'icon' => 'fa-solid fa-heart-pulse',
                        'description' => 'Builds immense courage, body control, and athletic capability applicable to any sport.',
                    ],
                    [
                        'title' => 'QR-Verifiable Credentials',
                        'icon' => 'fa-solid fa-qrcode',
                        'description' => 'Official certificate honoring skill tier completions (Level 1 Foundation to Advanced).',
                    ],
                ],
                'guarantee_checklist' => [
                    'Personalized 1-on-1 trial session available',
                    'Official certificate with QR verification upon completion',
                    'Weekend and weekday afternoon sessions',
                    '100% safety-first padded environment with certified spotters',
                ],
            ],

            'carrom' => [
                'batch_ratio' => 'Max 1 : 6 Mentorship',
                'credential_info' => 'State Carrom Association Aligned',
                'what_students_gain' => [
                    'Consistent straight, thumb, and scissor striker stroke precision',
                    'Geometric board rebound angle calculations and bank shot mastery',
                    'Strategic coin positioning, defensive blocking, and board dominance',
                    'Mental calmness, patience, and readiness for sanctioned tournaments',
                ],
                'has_teacher_training' => true,
                'teacher_training_title' => 'Carrom Coach & Referee Certification (TTC)',
                'teacher_training_description' => 'Learn tournament rules, striker mechanics analysis, board maintenance, and methods to coach young players from basic grips to competitive matches.',
                'teacher_training_highlights' => [
                    [
                        'title' => 'Certified Carrom Coach',
                        'description' => 'Recognized credential validating coaching ability for schools, clubs, and competitive leagues.',
                    ],
                    [
                        'title' => 'Stroke Mechanics & Geometric Angle Math',
                        'description' => 'Manuals covering grip varieties, rebound mathematics, double-touch shots, and cuts.',
                    ],
                    [
                        'title' => 'Tournament Laws & White Slam Rules',
                        'description' => 'Complete coverage of official carrom association rules, fouls, penalties, and refereeing.',
                    ],
                    [
                        'title' => 'Carrom Club & League Launch',
                        'description' => 'How to maintain championship boards, apply specialty powders, and run sanctioned weekend tournaments.',
                    ],
                ],
                'institution_highlights' => [
                    [
                        'title' => 'State Champion Mentors',
                        'icon' => 'fa-solid fa-chalkboard-user',
                        'description' => 'Experienced tournament competitors who teach master-level striker release and tactical board play.',
                    ],
                    [
                        'title' => 'Strict 1:6 Board Ratio',
                        'icon' => 'fa-solid fa-users',
                        'description' => 'Focused supervision ensuring proper finger placement and eliminating foul strokes.',
                    ],
                    [
                        'title' => 'Champion English Birch Boards',
                        'icon' => 'fa-solid fa-toolbox',
                        'description' => 'Tournament-regulation waterproof plywood boards, weighted strikers, and boric powder.',
                    ],
                    [
                        'title' => 'Campus League Arena',
                        'icon' => 'fa-solid fa-laptop',
                        'description' => 'Professional match setup with focused overhead lighting and digital scoring displays.',
                    ],
                    [
                        'title' => 'Calculated Focus & Patience',
                        'icon' => 'fa-solid fa-heart-pulse',
                        'description' => 'Hones laser-like concentration, geometric estimation, and graceful sportsmanship.',
                    ],
                    [
                        'title' => 'Tamper-Proof QR Certification',
                        'icon' => 'fa-solid fa-qrcode',
                        'description' => 'Official certificate validating stroke proficiency and match tournament play.',
                    ],
                ],
                'guarantee_checklist' => [
                    'Personalized 1-on-1 trial session available',
                    'Official certificate with QR verification upon completion',
                    'Weekend and evening training slots',
                    'Intra-academy league tournaments included',
                ],
            ],

            'dart' => [
                'batch_ratio' => 'Max 1 : 6 Mentorship',
                'credential_info' => 'National Dart League Standards',
                'what_students_gain' => [
                    'Precision biomechanical elbow and wrist release consistency',
                    'Instant mental arithmetic for 501/301 checkout combinations',
                    'Unshakable fine motor composure under high-pressure competitive conditions',
                    'Target visualization, grip stability, and stance equilibrium',
                ],
                'has_teacher_training' => true,
                'teacher_training_title' => 'Precision Dart Coaching Certification (TTC)',
                'teacher_training_description' => 'Learn trajectory physics, release mechanics, checkout strategy math, dartboard lighting standards, and competitive player development.',
                'teacher_training_highlights' => [
                    [
                        'title' => 'Certified Precision Dart Coach',
                        'description' => 'Accredited coaching certificate adhering to world dart federation guidelines.',
                    ],
                    [
                        'title' => 'Trajectory & Biomechanics Manuals',
                        'description' => 'Scientific guides analyzing stance balance, release arcs, follow-through, and barrel weighting.',
                    ],
                    [
                        'title' => 'Checkout Strategy & Speed Math',
                        'description' => 'Complete double and treble checkout charts, combination routing, and subtraction drills.',
                    ],
                    [
                        'title' => 'Dart League & Club Setup',
                        'description' => 'Oche measurement standards, lighting installation, tournament software, and ranking ladders.',
                    ],
                ],
                'institution_highlights' => [
                    [
                        'title' => 'National League Dart Mentors',
                        'icon' => 'fa-solid fa-chalkboard-user',
                        'description' => 'Experienced tournament competitors focused on biomechanical consistency and mental coolness.',
                    ],
                    [
                        'title' => 'Strict 1:6 Precision Mentorship',
                        'icon' => 'fa-solid fa-users',
                        'description' => 'Slow-motion video review of release mechanics and elbow alignment for each player.',
                    ],
                    [
                        'title' => 'Sisal Dartboards & Tungsten Darts',
                        'icon' => 'fa-solid fa-toolbox',
                        'description' => 'Official staple-free sisal bristle boards, custom-weighted tungsten barrels, and shadowless lighting.',
                    ],
                    [
                        'title' => 'Dedicated Oche Practice Lane',
                        'icon' => 'fa-solid fa-laptop',
                        'description' => 'Regulation oche lanes in Chennai with automated digital scoring tablets.',
                    ],
                    [
                        'title' => 'Zen-Like Mental Equilibrium',
                        'icon' => 'fa-solid fa-heart-pulse',
                        'description' => 'Builds extraordinary hand-eye synchronization, stress regulation, and mental focus.',
                    ],
                    [
                        'title' => 'QR-Verifiable Credentials',
                        'icon' => 'fa-solid fa-qrcode',
                        'description' => 'Official certificate validating checkout accuracy and tournament scoring averages.',
                    ],
                ],
                'guarantee_checklist' => [
                    'Personalized 1-on-1 trial session available',
                    'Official certificate with QR verification upon completion',
                    'Flexible weekend and evening practice sessions',
                    'Dedicated regulation practice lane for every learner',
                ],
            ],

            'spoken-english' => [
                'batch_ratio' => 'Max 1 : 6 Mentorship',
                'credential_info' => 'CEFR Aligned Certification',
                'what_students_gain' => [
                    'Fluent, effortless English conversation without mental translation from mother tongue',
                    'Neutral pronunciation, voice modulation, and clear professional diction',
                    'Confidence to deliver school speeches, debate topics, and ace interviews',
                    'Mastery of everyday idioms, professional email etiquette, and active listening',
                ],
                'has_teacher_training' => true,
                'teacher_training_title' => 'Spoken English & Communication Trainer (TTC)',
                'teacher_training_description' => 'Master modern communicative language teaching (CLT), speech therapy exercises, roleplay design, and corporate/school soft skills coaching.',
                'teacher_training_highlights' => [
                    [
                        'title' => 'Certified Spoken English Coach',
                        'description' => 'Accredited ELT credential to teach conversational fluency, public speaking, and business English.',
                    ],
                    [
                        'title' => 'Communicative Activity Blueprints',
                        'description' => 'Over 100 roleplay scenarios, debate prompt cards, voice modulation exercises, and idiom banks.',
                    ],
                    [
                        'title' => 'Mother-Tongue Influence (MTI) Remediation',
                        'description' => 'Phonetic drill methods to remove regional accents, syllable stressing errors, and mother-tongue interference.',
                    ],
                    [
                        'title' => 'Language Institute Business Setup',
                        'description' => 'Turnkey curriculum and marketing frameworks to run thriving spoken English academies.',
                    ],
                ],
                'institution_highlights' => [
                    [
                        'title' => 'Certified Corporate & ELT Trainers',
                        'icon' => 'fa-solid fa-chalkboard-user',
                        'description' => 'Empathetic language coaches with international TESOL/CELTA certifications and public speaking mastery.',
                    ],
                    [
                        'title' => 'Strict 1:6 Conversation Circles',
                        'icon' => 'fa-solid fa-users',
                        'description' => 'Ensures maximum student talking time (STT) with compassionate, real-time grammar feedback.',
                    ],
                    [
                        'title' => 'Smart Audio-Visual Labs',
                        'icon' => 'fa-solid fa-toolbox',
                        'description' => 'Speech recording studios, debate podiums, fluency prompt decks, and pronunciation software.',
                    ],
                    [
                        'title' => 'Interactive Hybrid Batches',
                        'icon' => 'fa-solid fa-laptop',
                        'description' => 'Lively Chennai classroom discussion rounds or dynamic live interactive global video rooms.',
                    ],
                    [
                        'title' => 'Eradication of Hesitation & Fear',
                        'icon' => 'fa-solid fa-heart-pulse',
                        'description' => 'A supportive, non-judgmental environment where mistakes are celebrated as learning steps.',
                    ],
                    [
                        'title' => 'CEFR Aligned QR Credentials',
                        'icon' => 'fa-solid fa-qrcode',
                        'description' => 'Official certificate validating conversational English proficiency level (A1 to C1).',
                    ],
                ],
                'guarantee_checklist' => [
                    'Personalized 1-on-1 trial session available',
                    'Official certificate with QR verification upon completion',
                    'Flexible morning, evening, and weekend batches',
                    'Noticeable conversational fluency transformation within 30 days',
                ],
            ],

            'hindi' => [
                'batch_ratio' => 'Max 1 : 8 Mentorship',
                'credential_info' => 'DBHPS Chennai Recognized',
                'what_students_gain' => [
                    'Thorough preparation for official Dakshin Bharat Hindi Prachar Sabha examinations',
                    'Strong command of Hindi Devanagari script, grammar rules, and vocabulary',
                    'Fluent reading of prescribed literature prose, poetry, and essay writing',
                    'Prestigious recognized government certification from Prathmic through Praveen',
                ],
                'has_teacher_training' => true,
                'teacher_training_title' => 'Hindi Sabha Exam Educator Certification (TTC)',
                'teacher_training_description' => 'Learn DBHPS syllabus coaching, question blueprint analysis, evaluation rubrics, and methods to help non-native speakers excel in Hindi exams.',
                'teacher_training_highlights' => [
                    [
                        'title' => 'Certified Hindi Sabha Pracharak',
                        'description' => 'Accredited teaching credential recognized for coaching students through all 8 DBHPS examination tiers.',
                    ],
                    [
                        'title' => 'Prescribed Exam Textbooks & Keys',
                        'description' => 'Comprehensive question paper solutions, essay blueprints, grammar guides, and letter writing templates.',
                    ],
                    [
                        'title' => 'Non-Native Pedagogy & Phonetics',
                        'description' => 'Specialized strategies to teach South Indian students fluent Hindi reading, writing, and oral expression.',
                    ],
                    [
                        'title' => 'Sabha Examination Center Setup',
                        'description' => 'Exam hall application procedures, student hall-ticket processing, and running examination coaching centers.',
                    ],
                ],
                'institution_highlights' => [
                    [
                        'title' => 'Rashtrabhasha Vidwans',
                        'icon' => 'fa-solid fa-chalkboard-user',
                        'description' => 'Senior Hindi Pracharaks with decades of track record in DBHPS examination excellence.',
                    ],
                    [
                        'title' => 'Strict 1:8 Student-Mentor Ratio',
                        'icon' => 'fa-solid fa-users',
                        'description' => 'Individual handwriting correction, gender concord checking, and oral poem recitation.',
                    ],
                    [
                        'title' => 'Model Papers & Past Question Banks',
                        'icon' => 'fa-solid fa-toolbox',
                        'description' => '10 years of solved question papers, timed mock test booklets, and grammar flashcards.',
                    ],
                    [
                        'title' => 'Campus & Digital Sabha Classes',
                        'icon' => 'fa-solid fa-laptop',
                        'description' => 'In-person classroom coaching in Chennai paired with live interactive online cohorts.',
                    ],
                    [
                        'title' => 'Stress-Free Exam Excellence',
                        'icon' => 'fa-solid fa-heart-pulse',
                        'description' => 'Regular chapter tests ensure students enter exam halls completely relaxed and prepared.',
                    ],
                    [
                        'title' => 'Government Recognized Credentials',
                        'icon' => 'fa-solid fa-qrcode',
                        'description' => 'Preparation leading to official DBHPS certificates plus academy QR-verified diplomas.',
                    ],
                ],
                'guarantee_checklist' => [
                    'Personalized 1-on-1 trial session available',
                    'Official certificate with QR verification upon completion',
                    'Weekend and weekday evening batches',
                    '100% first-class pass track record guarantee',
                ],
            ],
        ];

        $aliases = [
            'spellbee' => 'spell-bee',
            'hindi-saba-exams' => 'hindi',
        ];

        foreach ($coursesData as $slug => $data) {
            $course = Course::where('slug', $slug)->first();
            if (! $course) {
                // Check if any alias points to this slug
                $aliasKey = array_search($slug, $aliases, true);
                if ($aliasKey) {
                    $course = Course::where('slug', $aliasKey)->first();
                }
            }

            if ($course) {
                $course->update([
                    'batch_ratio' => $data['batch_ratio'],
                    'credential_info' => $data['credential_info'],
                    'what_students_gain' => $data['what_students_gain'],
                    'has_teacher_training' => $data['has_teacher_training'],
                    'teacher_training_title' => $data['teacher_training_title'],
                    'teacher_training_description' => $data['teacher_training_description'],
                    'teacher_training_highlights' => $data['teacher_training_highlights'],
                    'institution_highlights' => $data['institution_highlights'],
                    'guarantee_checklist' => $data['guarantee_checklist'],
                ]);
            }
        }

        // Ensure 100% of all courses have their institutional highlights and details populated
        foreach (Course::all() as $course) {
            $updates = [];

            if (empty($course->institution_highlights)) {
                $updates['institution_highlights'] = [
                    [
                        'title' => 'Master Certified Mentors',
                        'icon' => 'fa-solid fa-chalkboard-user',
                        'description' => 'Certified trainers trained specifically in '.$course->title.' with ongoing neuro-cognitive developmental research.',
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
                ];
            }

            if (empty($course->what_students_gain)) {
                $updates['what_students_gain'] = [
                    'Higher school test scores & faster homework turnaround',
                    'Stronger photographic memory & spatial visualization',
                    'Self-directed problem-solving and critical reasoning',
                    'Joyful classroom atmosphere with gamified milestones',
                ];
            }

            if (empty($course->teacher_training_highlights)) {
                $updates['teacher_training_highlights'] = [
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
                ];
            }

            if (empty($course->guarantee_checklist)) {
                $updates['guarantee_checklist'] = [
                    'Personalized 1-on-1 trial session available',
                    'Official certificate upon completion',
                    'Weekend and weekday batch options',
                ];
            }

            if (empty($course->teacher_training_title)) {
                $updates['teacher_training_title'] = $course->title.' Teacher Training Certification (TTC)';
            }

            if (empty($course->teacher_training_description)) {
                $updates['teacher_training_description'] = 'Are you a school educator, tuition teacher, or aspiring academic entrepreneur? Our specialized Teacher Training Certification equips you with global pedagogy, comprehensive lesson kits, and certification to teach '.$course->title.' professionally.';
            }

            if (empty($course->batch_ratio)) {
                $updates['batch_ratio'] = 'Max 1 : 8 Mentorship';
            }

            if (empty($course->credential_info)) {
                $updates['credential_info'] = 'ISO 9001 Certified';
            }

            if (! empty($updates)) {
                $course->update($updates);
            }
        }
    }
}
