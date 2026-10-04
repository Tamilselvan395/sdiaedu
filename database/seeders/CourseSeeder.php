<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseFaq;
use App\Models\CourseModule;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = CourseCategory::all()->keyBy('slug');

        $courses = [
            // ==========================================
            // 1. BRAIN & ACADEMIC EXCELLENCE (8 Courses)
            // ==========================================
            [
                'category_slug' => 'brain-and-academic-excellence',
                'title' => 'Abacus Mental Arithmetic',
                'slug' => 'abacus',
                'short_description' => 'Supercharge mental arithmetic calculation speed, focus, and photographic memory through structured abacus bead manipulation.',
                'description' => 'The Sri Deekshaa Abacus program is a proven cognitive development journey that transforms the way young minds perceive numbers. By training with physical and mental soroban abacus instruments, learners activate both brain hemispheres, unlocking lightning-fast mental calculations, laser-sharp focus, and profound academic self-confidence.',
                'age_min' => 4,
                'age_max' => 18,
                'duration' => '8 Months',
                'mode' => 'In-Person',
                'eligibility' => 'Children aged 5 to 14 years who can recognize and write numbers from 1 to 50.',
                'curriculum' => [
                    'Foundation of Soroban Beads & Value Systems',
                    'Direct Addition & Subtraction Techniques',
                    'Five-Complement & Ten-Complement Mental Strategies',
                    'Advanced Multi-Digit Calculations & Anzan Visualization',
                    'Speed Drills, Auditory Calculations & Mental Agility Challenges',
                ],
                'learning_outcomes' => [
                    'Perform rapid mental calculations without calculators or paper',
                    'Dramatically improve concentration, working memory, and listening skills',
                    'Eliminate fear of mathematics and develop profound subject love',
                    'Enhance visualization abilities and cognitive spatial processing',
                ],
                'who_is_for' => [
                    'Young learners needing a solid foundation in mental numeracy',
                    'Students looking to overcome math anxiety and enhance school performance',
                    'Children aiming to sharpen working memory, focus span, and speed',
                ],
                'why_choose' => [
                    'Structured multi-level global curriculum with continuous milestone tracking',
                    'Certified and empathetic trainers specialized in early brain development',
                    'Hands-on physical abacus kits and interactive speed drill software',
                    'Regular friendly competitive assessments and verifiable certification',
                ],
                'teaching_approach' => 'Kinesthetic bead manipulation combined with flash card visualization and progressive mental arithmetic (Anzan) practice.',
                'class_schedule' => 'Weekend batches (2 hours/session) or Weekday evenings (1 hour, twice a week).',
                'certificate_available' => true,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
                'modules' => [
                    ['title' => 'Level 1: Bead Basics & Single-Digit Operations', 'description' => 'Mastering bead representation, finger techniques, and direct addition/subtraction.'],
                    ['title' => 'Level 2: Small Friends & Big Friends Formulae', 'description' => 'Complements of 5 and 10, multi-step operations on the physical soroban.'],
                    ['title' => 'Level 3: Anzan Introduction & 2-Digit Mental Math', 'description' => 'Mental imaging of beads without touching the physical tool; lightning speed flash cards.'],
                    ['title' => 'Level 4: Multiplication Concepts & Mental Products', 'description' => '2-digit by 1-digit mental multiplications and auditory calculation drills.'],
                    ['title' => 'Level 5: Division Techniques & Higher Complex Arithmetic', 'description' => 'Multi-digit division, decimals introduction, and championship level speed challenges.'],
                ],
                'faqs' => [
                    ['question' => 'At what age should my child start Abacus?', 'answer' => 'Children aged 5 and above with basic number recognition can start. The brain’s neuroplasticity peaks between 5 and 12 years.'],
                    ['question' => 'How does Abacus help in general school academics?', 'answer' => 'Abacus stimulates both left and right brain hemispheres, strengthening memory recall, concentration, visualization, and speed across all school subjects.'],
                ],
            ],

            [
                'category_slug' => 'brain-and-academic-excellence',
                'title' => 'Vedic Mathematics',
                'slug' => 'vedic-maths',
                'short_description' => 'High-speed mental calculation shortcuts, algebraic mental tricks, and speed arithmetic rooted in ancient Vedic Sutras.',
                'description' => 'Rooted in the timeless mathematical insights of the 16 Vedic Sutras, this program equips students with breathtaking calculation shortcuts. From squaring large numbers in seconds to solving algebraic equations mentally, Vedic Maths turns complex calculations into child’s play, giving students a definitive competitive edge in Olympiads and competitive entrance exams.',
                'age_min' => 8,
                'age_max' => 18,
                'duration' => '3 Months',
                'mode' => 'In-Person',
                'eligibility' => 'Students from Grade 4 upwards with basic familiarity with standard multiplication tables.',
                'curriculum' => [
                    'The 16 Vedic Sutras and 13 Sub-Sutras Overview',
                    'Base Multiplication (Nikhilam Navatashcaramam Dashatah)',
                    'Vertically and Crosswise Multiplication (Urdhva Tiryagbhyam)',
                    'Lightning Fast Squares, Square Roots, Cubes & Cube Roots',
                    'Mental Division & Rapid Algebraic Factorization',
                ],
                'learning_outcomes' => [
                    'Solve multi-digit arithmetic 10x to 15x faster than conventional methods',
                    'Cross-check calculations mentally within 3 seconds using Digit Sum checks',
                    'Excel in competitive exams (Olympiads, NTSE, JEE Foundation, SAT)',
                    'Gain mathematical independence and eliminate calculation errors',
                ],
                'who_is_for' => [
                    'School students from 4th standard and above preparing for competitive tests',
                    'Students who find conventional math calculations lengthy and stressful',
                    'Enthusiasts wanting to experience the elegance of Indian mathematical heritage',
                ],
                'why_choose' => [
                    'Concept-first teaching that bridges Vedic shortcuts with school curriculum',
                    'Extensive workbook practice with real-time timed speed drills',
                    'Tips & tricks specifically tuned for Olympiads and competitive exams',
                ],
                'teaching_approach' => 'Pattern recognition, heuristic discovery, and mental math practice sessions.',
                'class_schedule' => 'Weekend batches (2 hours on Saturday or Sunday).',
                'certificate_available' => true,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
                'modules' => [
                    ['title' => 'Module 1: High-Speed Multiplication Techniques', 'description' => 'Nikhilam and Urdhva Tiryagbhyam sutras for instant 2, 3, and 4-digit products.'],
                    ['title' => 'Module 2: Squaring, Cubing & Digital Roots', 'description' => 'Yavadunam sutra for squaring numbers near bases; instant digit sum verification.'],
                    ['title' => 'Module 3: Fast Roots & Straight Division', 'description' => 'Vilokanam (by inspection) square root and cube root extraction in seconds.'],
                    ['title' => 'Module 4: Competitive Algebra & Equation Solving', 'description' => 'Paravartya Yojayet sutra applied to linear and quadratic systems.'],
                ],
                'faqs' => [
                    ['question' => 'Will Vedic Maths confuse my child’s regular school syllabus?', 'answer' => 'Not at all! Vedic Maths complements school math by providing intuitive cross-checks and faster mental pathways, actually boosting school grades.'],
                    ['question' => 'Is Vedic Maths useful for competitive entrance tests?', 'answer' => 'Yes! The ability to calculate rapidly without scrap paper is the biggest differentiator in timed examinations like Olympiads and JEE.'],
                ],
            ],

            [
                'category_slug' => 'brain-and-academic-excellence',
                'title' => 'Jolly Phonics & Reading Mastery',
                'slug' => 'phonics',
                'short_description' => 'Master synthetic phonics, letter-sound blends, tricky words, and fluent independent reading using international methods.',
                'description' => 'Sri Deekshaa Phonics program uses the world-renowned synthetic phonics methodology to empower young children to read and write English with ease. By teaching the 42 letter sounds multi-sensorially through fun actions, songs, and stories, children learn to blend sounds into words effortlessly without rote memorization.',
                'age_min' => 3,
                'age_max' => 10,
                'duration' => '6 Months',
                'mode' => 'In-Person',
                'eligibility' => 'Children aged 4 to 8 years beginning their reading and English literacy journey.',
                'curriculum' => [
                    'The 42 Core Letter Sounds (Actions, Songs & Stories)',
                    'Letter Formation & Pencil Grip Mechanics',
                    'Blending Techniques for Fluent Reading',
                    'Segmenting Sounds for Spelling & Dictation',
                    'Mastering Tricky Sight Words & Reading Leveled Storybooks',
                ],
                'learning_outcomes' => [
                    'Read unfamiliar words independently without guessing',
                    'Spell phonetically regular words with high precision',
                    'Build natural English pronunciation and expressive articulation',
                    'Develop a lifelong love for reading and independent story comprehension',
                ],
                'who_is_for' => [
                    'Pre-schoolers and early primary children learning to read',
                    'Children struggling with word recognition, spelling, or pronunciation',
                    'Parents seeking an international, systematic phonics foundation',
                ],
                'why_choose' => [
                    'Certified Jolly Phonics practitioners with multi-sensory teaching tools',
                    'Story-based, joyful learning environment that keeps children engaged',
                    'Comprehensive library of decodable readers and flashcard exercises',
                ],
                'teaching_approach' => 'Multi-sensory synthetic phonics combining physical actions, audio songs, tactile letter tracing, and decodable storybooks.',
                'class_schedule' => '3 sessions per week (1 hour each) or Weekend intensive batches.',
                'certificate_available' => true,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 3,
                'modules' => [
                    ['title' => 'Stage 1: 42 Letter Sounds & Formation', 'description' => '7 groups of letter sounds taught with kinesthetic actions, songs, and correct pencil movement.'],
                    ['title' => 'Stage 2: Blending & Segmenting Mastery', 'description' => 'Merging consonant-vowel-consonant (CVC) sounds into words and segmenting for spelling.'],
                    ['title' => 'Stage 3: Digraphs, Tricky Words & Fluency', 'description' => 'Vowel digraphs, alternative spellings, non-decodable tricky words, and full sentence reading.'],
                ],
                'faqs' => [
                    ['question' => 'How is Synthetic Phonics different from traditional ABC learning?', 'answer' => 'Traditional learning teaches letter names (A, B, C), which confuses early readers. Synthetic phonics teaches the exact sounds letters make (ah, buh, kuh), enabling children to read words phonetically from day one.'],
                ],
            ],

            [
                'category_slug' => 'brain-and-academic-excellence',
                'title' => 'Mid Brain Activation',
                'slug' => 'mid-brain-activation',
                'short_description' => 'Awaken the bridge between left and right brain hemispheres to enhance sensory perception, intuition, photographic memory, and emotional balance.',
                'description' => 'The Mid Brain Activation program is a specialized neuro-cognitive development workshop designed for children aged 5 to 15. The midbrain acts as the control bridge between the left logical brain and the right creative brain. Through scientifically designed soundwave stimulation, blindfold sensory exercises, breathing drills, and brain gym workouts, children unlock heightened intuition, photographic memory retention, and laser-like focus.',
                'age_min' => 5,
                'age_max' => 18,
                'duration' => '1 Year',
                'mode' => 'In-Person',
                'eligibility' => 'Children aged 5 to 15 years with enthusiastic participation and parental support.',
                'curriculum' => [
                    'Brain Hemisphere Synchronization & Neuro-Gym Exercises',
                    'Alpha Wave Relaxation & Focused Meditation Techniques',
                    'Blindfold Sensory Perception Drills (Color, Shape & Number Sensing)',
                    'Enhanced Intuitive Thinking & Subconscious Processing',
                    'Emotional Equanimity, Self-Confidence & Stress Relief',
                ],
                'learning_outcomes' => [
                    'Significant enhancement in concentration span and memory retention',
                    'Heightened intuitive perception and sensory awareness',
                    'Balanced emotional temperament and reduced exam anxiety',
                    'Faster learning capability and improved academic performance',
                ],
                'who_is_for' => [
                    'Children with hyperactive focus or short attention spans',
                    'Students who wish to enhance intuition, photographic memory, and creativity',
                    'Learners preparing for intensive competitive academic milestones',
                ],
                'why_choose' => [
                    'Certified brain gym and alpha-frequency audio technology',
                    'Safe, joyful, stress-free guided sessions with proven track records',
                    'Continuous progress tracking and parental guidance workshops',
                ],
                'teaching_approach' => 'Soundwave therapy, brain gym physical exercises, blindfolded sensory drills, and guided visualization.',
                'class_schedule' => 'Weekend 2-hour workshops with 10-minute daily home practice routines.',
                'certificate_available' => true,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 4,
                'modules' => [
                    ['title' => 'Module 1: Brain Gym & Hemisphere Balancing', 'description' => 'Physical cross-lateral movements and breathing exercises to synchronize brain lobes.'],
                    ['title' => 'Module 2: Alpha Soundwave Therapy & Focus Induction', 'description' => 'Special acoustic sound frequencies to guide the brain into calm, hyper-receptive alpha states.'],
                    ['title' => 'Module 3: Blindfold Sensory Perception Testing', 'description' => 'Identifying colors, numbers, and cards blindfolded using olfactory and tactile senses.'],
                    ['title' => 'Module 4: Photographic Memory & Intuition Integration', 'description' => 'Applying activated cognitive abilities to fast memorization and school curricula.'],
                ],
                'faqs' => [
                    ['question' => 'Is Mid Brain Activation scientifically proven?', 'answer' => 'Yes, midbrain techniques are based on neuroplasticity, alpha-wave relaxation, and multi-sensory cross-activation proven to stimulate cognitive connectivity in children.'],
                    ['question' => 'How soon will I see results in my child?', 'answer' => 'Most parents observe noticeable improvements in focus, calmness, and recall ability within 4 to 6 weeks of consistent practice.'],
                ],
            ],

            [
                'category_slug' => 'brain-and-academic-excellence',
                'title' => 'Quantum Speed Reading',
                'slug' => 'quantum-speed-reading',
                'short_description' => 'Revolutionary speed comprehension technique enabling students to absorb entire books in minutes through right-brain image processing.',
                'description' => 'Quantum Speed Reading (QSR) is an advanced Japanese-origin methodology that bypasses the slow left-brain auditory reading process and harnesses the right brain’s photographic capacity. By developing rapid eye movement, peripheral vision expansion, and subconscious image perception, students can flip through books and comprehend core concepts at astonishing speeds.',
                'age_min' => 5,
                'age_max' => 18,
                'duration' => '1 Year',
                'mode' => 'In-Person',
                'eligibility' => 'Children aged 6 to 16 years with basic reading comprehension.',
                'curriculum' => [
                    'Rapid Eye Movement (Saccadic) & Visual Field Expansion',
                    'Subconscious Page Flipping & After-Image Training',
                    'High-Speed Information Processing & Intuitive Summarization',
                    'Mental Visualization of Written Text into Dynamic Images',
                    'Focus Retention Drills & Exam Preparation Efficiency',
                ],
                'learning_outcomes' => [
                    'Dramatically accelerate reading speed by 5x to 10x with high comprehension',
                    'Absorb bulky school textbooks and reference literature in fraction of time',
                    'Develop extraordinary visual imagination and creative storytelling power',
                    'Sharpen instantaneous information retrieval during exams',
                ],
                'who_is_for' => [
                    'Students overwhelmed by heavy textbook reading and syllabus loads',
                    'Avid book lovers who want to read multiple books every week',
                    'Competitive exam aspirants needing fast comprehension of long passages',
                ],
                'why_choose' => [
                    'Authentic QSR training methodologies adapted for school curricula',
                    'Dedicated visual training equipment and specialized reading flashcards',
                    'Proven speed benchmarks measured with real comprehension quizzes',
                ],
                'teaching_approach' => 'Eye coordination workouts, blind reading exercises, page-flipping speed drills, and comprehension testing.',
                'class_schedule' => 'Weekend batches (2 hours per week).',
                'certificate_available' => true,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 5,
                'modules' => [
                    ['title' => 'Module 1: Eye Muscle Conditioning & Wide Span Vision', 'description' => 'Developing 180-degree peripheral vision and eliminating vocalization while reading.'],
                    ['title' => 'Module 2: After-Image & Resonance Training', 'description' => 'Visualizing shapes and colors retained on the retina to stimulate right-brain processing.'],
                    ['title' => 'Module 3: Fast Flipping & Wave Reading', 'description' => 'Flipping pages at 1 second per page while retaining subconscious impressions.'],
                    ['title' => 'Module 4: Comprehension & Expressive Recall', 'description' => 'Translating subconscious impressions into verbal summaries and written answers.'],
                ],
                'faqs' => [
                    ['question' => 'Can a child really read a book just by flipping pages?', 'answer' => 'Quantum Speed Reading activates the right brain’s photographic processing. With training, students intuitively grasp the narrative and core facts far beyond regular word-by-word reading.'],
                ],
            ],

            [
                'category_slug' => 'brain-and-academic-excellence',
                'title' => 'Spell Bee & Vocabulary Mastery',
                'slug' => 'spellbee',
                'short_description' => 'Decode etymology, phonemic spelling patterns, word origins, and competitive tournament vocabulary strategies.',
                'description' => 'Prepare for prestigious national and international spelling championships with our structured Spell Bee program. Moving far beyond mechanical rote memorization, this course decodes linguistic roots, Greek and Latin prefixes/suffixes, phoneme-grapheme correspondences, and pronunciation keys to make word mastery instinctive and fascinating.',
                'age_min' => 7,
                'age_max' => 18,
                'duration' => '5 Months',
                'mode' => 'In-Person',
                'eligibility' => 'Children aged 6 to 15 years who can read age-appropriate English sentences.',
                'curriculum' => [
                    'Phonetic Transcription & IPA Symbol Fundamentals',
                    'Greek, Latin, French & Anglo-Saxon Word Roots',
                    'Rules of Prefixes, Suffixes & Inflexions',
                    'Tricky Silent Letters, Homophones & Homographs',
                    'Rapid Buzzer Rounds, Dictation Speed & Championship Mocks',
                ],
                'learning_outcomes' => [
                    'Spelling accuracy for over 3,000+ advanced words',
                    'Intuitive understanding of unfamiliar words through root-word analysis',
                    'Confidence to compete in school, national, and international Spell Bee contests',
                    'Vastly enriched vocabulary for creative writing and academic essays',
                ],
                'who_is_for' => [
                    'Aspiring Spell Bee competitors and language enthusiasts',
                    'Students who frequently make spelling mistakes in school exams',
                    'Children wanting to expand their vocabulary and linguistic intellect',
                ],
                'why_choose' => [
                    'Curriculum aligned with Scripps and National Spell Bee standards',
                    'Interactive spelling software, buzzer rounds, and weekly mock tournaments',
                    'Comprehensive vocabulary flashcards and etymology guides',
                ],
                'teaching_approach' => 'Etymological inquiry, mnemonic associations, oral spelling drills, and tournament simulations.',
                'class_schedule' => 'Weekend batches (2 hours per week) or twice-weekly evening batches.',
                'certificate_available' => true,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 6,
                'modules' => [
                    ['title' => 'Level 1: Phonetics & Word Construction', 'description' => 'Short/long vowels, consonant blends, and basic spelling rules.'],
                    ['title' => 'Level 2: Prefixes, Suffixes & Etymology', 'description' => 'Greek and Latin root exploration and compound word analysis.'],
                    ['title' => 'Level 3: Foreign Loanwords & Silent Letters', 'description' => 'French, German, and Italian origin words with irregular spelling patterns.'],
                    ['title' => 'Level 4: Tournament Drills & Championship Simulation', 'description' => 'Timed buzzer practice, pronunciation queries, and mock stage contests.'],
                ],
                'faqs' => [
                    ['question' => 'How does this course help general school writing?', 'answer' => 'Students who master spelling patterns write with greater confidence, eliminate red marks on essays, and naturally use sophisticated vocabulary.'],
                ],
            ],

            [
                'category_slug' => 'brain-and-academic-excellence',
                'title' => 'Rubik’s Cube & Speedcubing',
                'slug' => 'rubiks-cube',
                'short_description' => 'Conquer the 3x3, 4x4, Pyraminx, and Mirror cubes with CFOP speed algorithms and pattern memory.',
                'description' => 'Transform a scrambled puzzle into a masterpiece of spatial logic! Our Rubik’s Cube and Speedcubing masterclass guides beginners from solving their very first 3x3 cube to mastering advanced Fridrich (CFOP) speed techniques. Students develop algorithmic thinking, 3D visualization, finger dexterity, and mental resilience under pressure.',
                'age_min' => 3,
                'age_max' => 10,
                'duration' => '6 Months',
                'mode' => 'In-Person',
                'eligibility' => 'Curious minds aged 6 and above. No prior cubing experience needed.',
                'curriculum' => [
                    'Cube Anatomy, Notation (R, U, L, F, D) & Color Neutrality',
                    'Beginner Layer-by-Layer (LBL) Solution Method',
                    'Speedcubing Finger Tricks & Ergonomic Cube Handling',
                    'Intermediate CFOP: Cross, F2L (First 2 Layers), 2-Look OLL & PLL',
                    'Multi-Cube Mastery: Pyraminx, Mirror Cube, 2x2 & 4x4 Introduction',
                ],
                'learning_outcomes' => [
                    'Solve standard 3x3 Rubik’s cube in under 60 seconds independently',
                    'Understand 3D spatial geometry and algorithmic problem solving',
                    'Dramatically boost patience, fine-motor coordination, and spatial memory',
                    'Participate confidently in WCA-style speedcubing competitions',
                ],
                'who_is_for' => [
                    'Children eager to solve their first Rubik’s cube without guides',
                    'Cubers wanting to drop their solve times from minutes to seconds',
                    'Students who enjoy tactile puzzles, spatial logic, and speed challenges',
                ],
                'why_choose' => [
                    'Taught by experienced speedcubers with sub-20 second personal records',
                    'High-quality magnetic speedcubes provided during hands-on training',
                    'Clear algorithm reference cheat sheets and video recaps for home practice',
                ],
                'teaching_approach' => 'Hands-on tactile algorithm repetition, pattern recognition, and stop-watch timed battles.',
                'class_schedule' => 'Weekend batches (1.5 hours per session).',
                'certificate_available' => true,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 7,
                'modules' => [
                    ['title' => 'Module 1: The White Cross & First Layer', 'description' => 'Cube notation, center piece orientation, and corner placement.'],
                    ['title' => 'Module 2: Middle Layer & Yellow Cross', 'description' => 'Edge insertion algorithms and orienting the top layer cross.'],
                    ['title' => 'Module 3: Permuting Corners & Final Solve', 'description' => 'Finishing the cube reliably with beginner algorithms.'],
                    ['title' => 'Module 4: Speedcubing Finger Tricks & CFOP Introduction', 'description' => 'Smooth finger rotations, look-ahead techniques, and timer trials.'],
                ],
                'faqs' => [
                    ['question' => 'Can a 6-year-old learn to solve the cube?', 'answer' => 'Absolutely! Our step-by-step pictorial method breaks the cube down into simple, memorable stories that children as young as 6 master effortlessly.'],
                ],
            ],

            [
                'category_slug' => 'brain-and-academic-excellence',
                'title' => 'Strategic Chess & Game Theory',
                'slug' => 'chess',
                'short_description' => 'Develop forward planning, positional awareness, tactical motifs, and endgame finesse through FIDE-standard chess coaching.',
                'description' => 'Chess is the ultimate gym for the mind. Our structured Chess program takes students on an intellectual journey from board setup and basic piece movements to sophisticated middlegame tactics, opening theory, and precise endgame execution. Led by FIDE-rated coaches, the course instills foresight, sportsmanship, and mental discipline.',
                'age_min' => 5,
                'age_max' => 18,
                'duration' => 'Ongoing / Graded',
                'mode' => 'In-Person',
                'eligibility' => 'Children aged 5 to 16 years. All skill levels welcome.',
                'curriculum' => [
                    'Board Geometry, Piece Movements & Special Rules (Castling, En Passant)',
                    'Tactical Motifs: Forks, Pins, Skewers, Discovered Checks & Overloading',
                    'Classic Opening Principles: Italian Game, Ruy Lopez, Queen’s Gambit',
                    'Middlegame Strategy: Outposts, Open Files, Pawn Structures & King Safety',
                    'Essential Endgames: King + Pawn, Rook Endgames, Opposition & Checkmates',
                    'Tournament Clock Management, Notation & Sportsmanship Etiquette',
                ],
                'learning_outcomes' => [
                    'Think 3 to 5 moves ahead and anticipate opponent strategies',
                    'Develop extraordinary patience, emotional resilience, and impulse control',
                    'Analyze mistakes objectively to turn losses into valuable learning lessons',
                    'Compete in district, state, and national rated chess tournaments',
                ],
                'who_is_for' => [
                    'Beginners learning chess rules and fundamental strategy from scratch',
                    'Intermediate players wanting to boost their rating and eliminate blunders',
                    'Young strategists aiming for school team and tournament trophies',
                ],
                'why_choose' => [
                    'Coached by FIDE-rated trainers with championship coaching experience',
                    'Regular internal rapid tournaments, puzzle challenges, and Elo rating tracking',
                    'Digital game analysis and customized training homework',
                ],
                'teaching_approach' => 'Interactive board lessons, tactical puzzle-solving drills, live sparring, and post-game computerized analysis.',
                'class_schedule' => 'Weekend batches (2 hours per week) with optional weekly online sparring.',
                'certificate_available' => true,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 8,
                'modules' => [
                    ['title' => 'Module 1: Foundations & Tactical Basics', 'description' => 'Piece values, board notation, check, checkmate, stalemate, and basic checkmate patterns.'],
                    ['title' => 'Module 2: Tactical Weapons & Attack Patterns', 'description' => 'Mastering forks, pins, skewers, double attacks, and clearance sacrifices.'],
                    ['title' => 'Module 3: Opening Repertoire & Positional Play', 'description' => 'Controlling center squares, minor piece development, and defensive pawn structures.'],
                    ['title' => 'Module 4: King & Pawn Endgames & Tournament Prep', 'description' => 'The square of the pawn, opposition rule, clock usage, and tournament notation.'],
                ],
                'faqs' => [
                    ['question' => 'How does chess improve academic performance?', 'answer' => 'Chess exercises both executive functioning and working memory, helping children concentrate for extended periods during school studies and exam evaluations.'],
                ],
            ],

            // ==========================================
            // 2. ARTS & CREATIVITY (4 Courses)
            // ==========================================
            [
                'category_slug' => 'arts-and-creativity',
                'title' => 'Drawing & Coloring Foundations',
                'slug' => 'drawing-and-coloring',
                'short_description' => 'Master color theory, crayon and oil pastel blending, geometric shapes, and perspective sketching for young artists.',
                'description' => 'Unlock the vibrant world of visual imagination! Our Drawing & Coloring course teaches young learners the foundational grammar of art. From mastering pencil grips, basic geometric outlines, and color harmonies to expressive oil pastel shading and watercolor washes, children learn to translate their creative thoughts onto paper with joyful confidence.',
                'age_min' => 2,
                'age_max' => 18,
                'duration' => '10 Months',
                'mode' => 'In-Person',
                'eligibility' => 'Children aged 4 to 12 years with an enthusiasm for colors and sketching.',
                'curriculum' => [
                    'Lines, Basic Shapes & Freehand Composition',
                    'Color Theory: Primary, Secondary & Warm/Cool Palettes',
                    'Oil Pastel Blending, Gradients & Texture Techniques',
                    'Nature Sketching: Landscapes, Animals, Birds & Flora',
                    'Human Figure Proportions & Cartoon Character Sketching',
                ],
                'learning_outcomes' => [
                    'Draw balanced, proportional figures and landscapes freehand',
                    'Apply advanced color blending and shading without smudging or gaps',
                    'Build fine motor hand-eye coordination and spatial aesthetic sensibility',
                    'Create original artwork ready for school competitions and home display',
                ],
                'who_is_for' => [
                    'Budding artists who love spending hours drawing and coloring',
                    'Children wanting to improve their sketching neatness and color control',
                    'Students preparing for school drawing competitions and grade examinations',
                ],
                'why_choose' => [
                    'Structured syllabus moving step-by-step from simple shapes to complex scenes',
                    'Fine arts graduates with gentle, encouraging pedagogical techniques',
                    'Annual academy art exhibitions showcasing every student’s creations',
                ],
                'teaching_approach' => 'Guided visual demonstration, hands-on practice with multiple mediums, and constructive personalized feedback.',
                'class_schedule' => 'Weekend batches (2 hours on Saturday or Sunday).',
                'certificate_available' => true,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 9,
                'modules' => [
                    ['title' => 'Module 1: Shapes to Objects', 'description' => 'Converting circles, squares, and triangles into everyday objects, fruits, and cartoon animals.'],
                    ['title' => 'Module 2: Color Harmony & Pastel Blending', 'description' => 'Learning color wheel relationships, smooth dual-tone blending, and highlight effects.'],
                    ['title' => 'Module 3: Landscape & Perspective Basics', 'description' => 'Horizon line, foreground, background, mountains, rivers, and village sceneries.'],
                    ['title' => 'Module 4: Exhibition Artwork Creation', 'description' => 'Creating independent thematic masterpiece paintings for the annual academy art showcase.'],
                ],
                'faqs' => [
                    ['question' => 'What art materials do I need to bring?', 'answer' => 'All basic drawing sheets, drawing boards, oil pastels, and pencil sets are provided during classes; a recommended home kit list will be shared for practice.'],
                ],
            ],

            [
                'category_slug' => 'arts-and-creativity',
                'title' => 'Creative Art & Craft Workshops',
                'slug' => 'art-and-craft',
                'short_description' => 'Hands-on 3D crafting, origami, clay sculpting, recycled art projects, and creative tactile design workshops.',
                'description' => 'Unleash tactile imagination and maker skills! Our Art & Craft workshop transforms everyday materials into imaginative sculptures, functional artifacts, and decorative wonders. Children explore origami paper folding, non-toxic clay modeling, quilling, recycled eco-crafts, and festive holiday decor, building extraordinary dexterity and inventive problem-solving.',
                'age_min' => 4,
                'age_max' => 10,
                'duration' => '5 Months',
                'mode' => 'In-Person',
                'eligibility' => 'Children aged 4 to 14 years. No prior crafting experience required.',
                'curriculum' => [
                    'Origami & Paper Engineering (3D Pop-Up Cards, Modular Origami)',
                    'Clay Sculpting & Terracotta Miniature Modeling',
                    'Paper Quilling & Decorative Mosaic Crafting',
                    'Eco-Friendly Craft: Best Out of Waste Creative Upcycling',
                    'Festive Lanterns, Greeting Cards & Handcrafted Keepsakes',
                ],
                'learning_outcomes' => [
                    'Master diverse crafting mediums and safe tool handling (scissors, glue, cutters)',
                    'Develop high fine-motor dexterity and 3-dimensional spatial awareness',
                    'Cultivate environmental awareness through creative upcycling',
                    'Gain immense satisfaction by turning raw materials into finished artworks',
                ],
                'who_is_for' => [
                    'Children who love building, cutting, folding, and creating with their hands',
                    'Parents wanting to reduce screen time with productive artistic hobbies',
                    'Young learners preparing creative school projects and exhibitions',
                ],
                'why_choose' => [
                    'Rich variety of crafts covering paper, clay, fabric, and eco-materials',
                    'Child-safe, non-toxic materials provided in every hands-on workshop',
                    'Every student takes home their completed craft projects after each session',
                ],
                'teaching_approach' => 'Tactile maker workshops with step-by-step demonstrative guidance and encouraging creative freedom.',
                'class_schedule' => 'Weekend batches (2 hours per session).',
                'certificate_available' => true,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 10,
                'modules' => [
                    ['title' => 'Module 1: Paper Craft & Origami Engineering', 'description' => 'Precision folding techniques, kinetic origami toys, and 3D greeting cards.'],
                    ['title' => 'Module 2: Clay Modeling & Tactile Sculpting', 'description' => 'Pinching, coiling, and slab techniques to create animal figurines and miniature pottery.'],
                    ['title' => 'Module 3: Paper Quilling & Filigree Art', 'description' => 'Rolling, shaping, and gluing paper strips to create floral patterns and framed art.'],
                    ['title' => 'Module 4: Upcycled Eco-Art & Project Showcase', 'description' => 'Turning cardboard, bottle caps, and scrap fabric into functional home organizers and toys.'],
                ],
                'faqs' => [
                    ['question' => 'Are the tools and scissors safe for young children?', 'answer' => 'Yes, all scissors are rounded-tip safety scissors, and all glues and modeling clays are 100% non-toxic and child-certified.'],
                ],
            ],

            [
                'category_slug' => 'arts-and-creativity',
                'title' => 'Artistic Calligraphy & Lettering',
                'slug' => 'calligraphy',
                'short_description' => 'Elegant broad-edge and pointed-pen cursive calligraphy, Gothic scripts, flourished typography, and creative poster aesthetics.',
                'description' => 'Elevate writing into a timeless fine art. Our Calligraphy program introduces learners to classical scripts like Foundational Hand, Gothic Blackletter, and modern flourished brush calligraphy. Students master nib angles, ink flow, pen pressure, rhythmic stroke sequences, and ornate letter designs that add prestige to certificates, invitations, and journals.',
                'age_min' => 7,
                'age_max' => 18,
                'duration' => '6 Months',
                'mode' => 'In-Person',
                'eligibility' => 'Students aged 8 and above with basic handwriting stability.',
                'curriculum' => [
                    'Calligraphy Tool Anatomy: Broad Nib, Pointed Pen & Brush Pens',
                    'Foundational Hand & Roman Minuscule Alphabet Anatomy',
                    'Gothic / Blackletter Script Angles & Dramatic Flourishes',
                    'Modern Cursive Brush Lettering & Pressure Transitions',
                    'Project Design: Parchment Quotes, Monograms & Custom Invitations',
                ],
                'learning_outcomes' => [
                    'Write breathtaking classical and modern calligraphic scripts fluently',
                    'Control pen pressure, slant consistency, and geometric letter balance',
                    'Design bespoke quote posters, greeting cards, and certificate lettering',
                    'Cultivate deep mindfulness, patience, and fine motor precision',
                ],
                'who_is_for' => [
                    'Students who appreciate elegant typography and artistic penmanship',
                    'Teens interested in graphic design, bullet journaling, and visual arts',
                    'Anyone wanting to transform their writing into a lifelong artistic hobby',
                ],
                'why_choose' => [
                    'Comprehensive tool kit including broad-edge pens, dual-brush pens, and grid guides',
                    'Personalized posture and stroke alignment corrections from master penmen',
                    'Practical portfolio projects that students can proudly frame or gift',
                ],
                'teaching_approach' => 'Rhythmic stroke drills, guideline-based practice sheets, and portfolio project creation.',
                'class_schedule' => 'Weekend batches (1.5 hours per session).',
                'certificate_available' => true,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 11,
                'modules' => [
                    ['title' => 'Module 1: Nib Mechanics & Basic Strokes', 'description' => 'Holding the pen at 45-degree angle, downstrokes, upstrokes, and serifs.'],
                    ['title' => 'Module 2: Foundational & Roman Minuscules', 'description' => 'Mastering lower-case alphabet proportions, ascenders, and descenders.'],
                    ['title' => 'Module 3: Gothic Blackletter & Majestic Capitals', 'description' => 'Heavy vertical strokes, diagonal diamonds, and intricate majuscule capitals.'],
                    ['title' => 'Module 4: Modern Brush Calligraphy & Final Project', 'description' => 'Flexible brush markers, bouncy modern script, and creating an illuminated quote poster.'],
                ],
                'faqs' => [
                    ['question' => 'Do I need good handwriting to learn calligraphy?', 'answer' => 'No! Calligraphy is drawing letters as art using specific geometric angles and tools, completely separate from everyday handwriting.'],
                ],
            ],

            [
                'category_slug' => 'arts-and-creativity',
                'title' => 'Handwriting Improvement & Speed Writing',
                'slug' => 'handwriting',
                'short_description' => 'Scientific posture, grip correction, letter sizing, slope consistency, and speed writing for neat, legible exam presentation.',
                'description' => 'Neat handwriting can significantly impact school marks, exam evaluations, and self-confidence. Sri Deekshaa scientific handwriting correction program addresses root causes of messy writing: improper grip, awkward posture, letter-height inconsistency, and incorrect stroke direction. Within 30 days, students develop beautiful, effortless cursive or print penmanship with optimized writing speed.',
                'age_min' => 3,
                'age_max' => 18,
                'duration' => '3 Months',
                'mode' => 'In-Person',
                'eligibility' => 'Students aged 5 to 16 years struggling with illegible or slow handwriting.',
                'curriculum' => [
                    'Ergonomic Tripod Grip Correction & Paper Angle Adjustment',
                    'Upper-Zone, Middle-Zone & Lower-Zone Letter Anatomy',
                    'Cursive Stroke Joins, Spacing Consistency & Uniform Slant',
                    'Speed Writing Drills Without Sacrificing Neatness or Legibility',
                    'Exam Paper Presentation Techniques & Margin Management',
                ],
                'learning_outcomes' => [
                    'Transform messy handwriting into neat, print-quality legibility',
                    'Eliminate finger fatigue, hand cramps, and pencil stress',
                    'Increase writing speed by 30% to 50% for timed school examinations',
                    'Boost marks by presenting answers cleanly with clear examiner appeal',
                ],
                'who_is_for' => [
                    'Students who lose marks in school exams due to illegible handwriting',
                    'Children who write too slowly and leave exam papers incomplete',
                    'Early learners developing their initial cursive or print writing style',
                ],
                'why_choose' => [
                    'Guaranteed visible transformation within 30 structured sessions',
                    'Customized handwriting diagnostic assessment before starting',
                    'Specialized ergonomic grip aids and ruled practice workbooks provided',
                ],
                'teaching_approach' => 'Kinesthetic finger workouts, diagnostic stroke analysis, and progressive timed speed tests.',
                'class_schedule' => 'Daily 1-hour batches during vacations or Weekend regular batches.',
                'certificate_available' => true,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 12,
                'modules' => [
                    ['title' => 'Module 1: Motor Mechanics & Grip Realignment', 'description' => 'Fixing tight fist grips, wrist positions, and paper tilt for effortless ink flow.'],
                    ['title' => 'Module 2: 4-Line Letter Proportions & Zones', 'description' => 'Calibrating ascenders (b, d, h) and descenders (g, p, y) with uniform middle-zone bodies.'],
                    ['title' => 'Module 3: Cursive Connectors & Word Spacing', 'description' => 'Smooth joining loops, eliminating broken words, and consistent finger-width gaps.'],
                    ['title' => 'Module 4: Exam Speed Conditioning', 'description' => 'Timed paragraphs under exam constraints to ensure beautiful penmanship at high speeds.'],
                ],
                'faqs' => [
                    ['question' => 'How quickly will my child’s handwriting change?', 'answer' => 'With daily 20-minute practice following our diagnostic worksheets, noticeable transformation is clearly visible within 15 to 20 days.'],
                ],
            ],

            // ==========================================
            // 3. MUSIC & DANCE (4 Courses)
            // ==========================================
            [
                'category_slug' => 'music-and-dance',
                'title' => 'Carnatic Music Vocal & Sangeetham',
                'slug' => 'carnatic-music',
                'short_description' => 'Classical South Indian vocal music instruction covering Sruti alignment, Sarali, Jantai, Alankaram, Geethams, and Varnams.',
                'description' => 'Immerse your child in the sublime tradition of South Indian classical music. Our Carnatic vocal curriculum is taught by accomplished vidwans who nurture pitch precision (Sruti), rhythm calculation (Tala), voice culture, and devotional expression (Bhava). Students progress systematically through foundational varisais to singing intricate ragas and classical compositions.',
                'age_min' => 4,
                'age_max' => 18,
                'duration' => 'Ongoing / Graded',
                'mode' => 'In-Person',
                'eligibility' => 'Children and youth aged 5 and above with an ear for music and desire to sing.',
                'curriculum' => [
                    'Sruti Alignment with Tambura & Breath Control Exercises',
                    'Abhyasa Gana: Sarali Varisai, Jantai Varisai & Dhatu Varisai',
                    'Alankarams in the 7 Fundamental Talas (Sapta Talas)',
                    'Melodic Geethams, Swarajathis & Nottuswarams',
                    'Introduction to Ragas: Mayamalavagowla, Shankarabharanam, Kalyani',
                    'Devotional Bhajans, Slokas & Stage Vocal Performance',
                ],
                'learning_outcomes' => [
                    'Sing in accurate Sruti pitch without deviation across three octaves',
                    'Master complex Tala rhythm patterns with accurate hands beats and kriyas',
                    'Identify classical ragas and perform traditional Geethams with diction',
                    'Gain poise, breath capacity, memory retention, and cultural grounding',
                ],
                'who_is_for' => [
                    'Young children beginning their classical vocal journey',
                    'Students preparing for Music Academy grade exams and youth festivals',
                    'Music lovers wanting to understand the rich mathematics and melody of Carnatic music',
                ],
                'why_choose' => [
                    'Taught by seasoned classical vocalists with Guru-Shishya pedagogical care',
                    'Individual attention to voice modulation and correct pronunciation of Telugu/Sanskrit/Tamil lyrics',
                    'Regular stage kutcheri performance opportunities for all students',
                ],
                'teaching_approach' => 'Tambura accompaniment, oral transmission, swara notation recording, and repetitive vocal drills.',
                'class_schedule' => 'Two sessions per week (1 hour each).',
                'certificate_available' => true,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 13,
                'modules' => [
                    ['title' => 'Module 1: Sruti & Sarali Varisai in 3 Speeds', 'description' => 'Finding individual pitch, singing sapta swaras, and 14 Sarali varisais in 3 speeds.'],
                    ['title' => 'Module 2: Jantai & Dhatu Varisais', 'description' => 'Double notes, zigzag swara patterns, and strengthening vocal agility.'],
                    ['title' => 'Module 3: Sapta Tala Alankarams', 'description' => 'Dhruva, Matya, Roopaka, Jhampa, Triputa, Ata, and Eka tala rhythm cycles.'],
                    ['title' => 'Module 4: Geethams, Swarajathis & Bhajans', 'description' => 'Singing complete melodic compositions in Malahari, Mohanam, and Kalyani ragas.'],
                ],
                'faqs' => [
                    ['question' => 'Does my child need prior musical talent to join?', 'answer' => 'No prior experience is necessary. Pitch sense and rhythm can be developed systematically through regular vocal exercises.'],
                ],
            ],

            [
                'category_slug' => 'music-and-dance',
                'title' => 'Electronic Keyboard & Piano Basics',
                'slug' => 'keyboard',
                'short_description' => 'Western music notation, two-hand keyboard coordination, chords, scales, arpeggios, and expressive repertoire performance.',
                'description' => 'Unlock the magic of instrumental melody! Our Keyboard and Piano course blends classical Western music theory with enjoyable contemporary performance. Students learn to read both treble and bass clef sheet music, coordinate both hands independently, master chords and scales, and play classical masterpieces as well as popular melodies with expressive touch.',
                'age_min' => 4,
                'age_max' => 18,
                'duration' => 'Ongoing / Graded',
                'mode' => 'In-Person',
                'eligibility' => 'Students aged 6 and above. Access to a 61-key keyboard at home is recommended.',
                'curriculum' => [
                    'Staff Notation, Treble & Bass Clef Reading, Time Signatures',
                    'Finger Numbering & Posture (Curved Fingers, Relaxed Wrists)',
                    'Major & Minor Scales, Broken Chords & Arpeggios',
                    'Two-Hand Coordination (Melody in Right, Chords in Left)',
                    'Playing Classical Repertoire, Theme Songs & Trinity Grade Exam Pieces',
                ],
                'learning_outcomes' => [
                    'Sight-read sheet music and play unfamiliar melodies effortlessly',
                    'Perform two-handed arrangements with rhythmic precision and dynamic touch',
                    'Understand harmony, chord progressions, and musical composition basics',
                    'Qualify with distinction in prestigious Trinity College London grade examinations',
                ],
                'who_is_for' => [
                    'Beginners wanting to learn keyboard/piano with proper Western notation',
                    'Students preparing for international music board examinations (Trinity / ABRSM)',
                    'Children wanting to develop ambidexterity, auditory sensitivity, and musical joy',
                ],
                'why_choose' => [
                    'Dedicated keyboard workstations for every student in class',
                    'Comprehensive Trinity College London curriculum alignment',
                    'Patience-driven mentorship focusing on technique, rhythm, and musicality',
                ],
                'teaching_approach' => 'Sight-reading exercises, metronome rhythm practice, fingering drills, and recital performances.',
                'class_schedule' => 'Two sessions per week (1 hour each).',
                'certificate_available' => true,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 14,
                'modules' => [
                    ['title' => 'Module 1: Staff Notation & Right Hand Melody', 'description' => 'Notes on the staff (Every Good Boy Does Fine), C Major scale, and simple melodies.'],
                    ['title' => 'Module 2: Left Hand Chords & Bass Clef', 'description' => 'Triad chords (C, G, F, Am), rhythm counting in 4/4 and 3/4 time signatures.'],
                    ['title' => 'Module 3: Hands Together Coordination', 'description' => 'Synchronizing melody with left-hand accompaniment patterns and pedal usage.'],
                    ['title' => 'Module 4: Repertoire & Trinity Exam Prep', 'description' => 'Selected classical and contemporary performance pieces prepared to examination standards.'],
                ],
                'faqs' => [
                    ['question' => 'Do I need a piano at home to join the course?', 'answer' => 'A standard 61-key electronic keyboard with touch-sensitive keys is sufficient for practice in the initial grades.'],
                ],
            ],

            [
                'category_slug' => 'music-and-dance',
                'title' => 'Classical Dance (Bharatanatyam)',
                'slug' => 'classical-dance',
                'short_description' => 'Traditional Kalakshetra-style Bharatanatyam instruction emphasizing posture (Aramandi), Mudras, Adavus, and Abhinaya expression.',
                'description' => 'Step into the divine grace and architectural discipline of Bharatanatyam, India’s sacred classical dance. Our academy imparts pure Kalakshetra-style training, focusing on solid footwork (Tattadavu), balanced knee alignment (Aramandi), symbolic hand gestures (Mudras), rhythmic timing (Nattuvangam), and evocative facial expressions (Navarasa Abhinaya).',
                'age_min' => 4,
                'age_max' => 18,
                'duration' => 'Ongoing / Graded',
                'mode' => 'In-Person',
                'eligibility' => 'Children and youth aged 5 and above. Physical stamina and enthusiasm for classical dance.',
                'curriculum' => [
                    'Basic Stances: Aramandi (Ayatham) & Murumandi Postural Rigor',
                    'Fundamental Adavu Sequences (Tatta, Natta, Kuditta Mettu, Mai Adavu)',
                    'Asamyuta & Samyuta Hasta Mudras (28 Single & 24 Double Hand Gestures)',
                    'Shiro, Drishti & Greeva Bheda (Head, Eye & Neck Movements)',
                    'Repertoire Items: Pushpanjali, Alarippu, Jathiswaram, Shabdam & Varnam',
                    'Abhinaya: Portraying Stories from Mythology with Navarasa Expressions',
                ],
                'learning_outcomes' => [
                    'Achieve exceptional physical balance, stamina, core strength, and poise',
                    'Master intricate rhythmic footwork synchronized to classical Carnatic beats',
                    'Express subtle emotions and narrative storytelling through eyes, gestures, and expressions',
                    'Perform on prestigious stages with authentic costume, salangai bells, and makeup',
                ],
                'who_is_for' => [
                    'Young children starting their classical dance journey with proper technique',
                    'Dancers seeking rigorous Kalakshetra style posture and rhythm training',
                    'Students aiming for Salangai Pooja, grade certifications, and stage Arangetram',
                ],
                'why_choose' => [
                    'Instructed by seasoned Kalakshetra alumni dance gurus',
                    'Spacious wooden-floor dance studio with full-length mirrors for alignment checks',
                    'Annual temple dance festivals and classical theater performance opportunities',
                ],
                'teaching_approach' => 'Physical conditioning drills, mirrored posture correction, Nattuvangam rhythm practice, and expressive storytelling.',
                'class_schedule' => 'Two sessions per week (1.5 hours each).',
                'certificate_available' => true,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 15,
                'modules' => [
                    ['title' => 'Module 1: Body Conditioning & Initial Adavus', 'description' => 'Aramandi stance, Tatta Adavu (tapping), and Natta Adavu (heel-toe stamping).'],
                    ['title' => 'Module 2: Advanced Adavus & Hasta Mudras', 'description' => 'Kuditta Mettu (jumping on toes), Sarikal, and memorizing single/double hand gestures.'],
                    ['title' => 'Module 3: Nattuvangam Beats & Alarippu', 'description' => 'Reciting solkattu syllables (Ta-Dhi-Tom-Nam) and dancing the invocatory Alarippu.'],
                    ['title' => 'Module 4: Jathiswaram & Abhinaya Expressions', 'description' => 'Pure melodic dance sequences and introduction to facial expressions (Navarasas).'],
                ],
                'faqs' => [
                    ['question' => 'At what age can a child start Bharatanatyam?', 'answer' => 'Children can start at age 5 when their bone structure and listening skills are ready for basic posture and foot stamping exercises.'],
                ],
            ],

            [
                'category_slug' => 'music-and-dance',
                'title' => 'Western & Folk Dance Academy',
                'slug' => 'western-and-folk-dance',
                'short_description' => 'High-energy hip-hop, contemporary, cinematic freestyle, and cultural folk choreographies building rhythm, stage confidence, and agility.',
                'description' => 'Unleash infectious rhythm, joy, and physical energy! Our Western & Folk Dance academy offers a dynamic blend of high-energy hip-hop, expressive contemporary dance, cinematic freestyle, and vibrant traditional Indian folk forms (Garba, Dandiya, Kolattam). Students build stellar stamina, body coordination, stage presence, and teamwork in an uplifting studio environment.',
                'age_min' => 4,
                'age_max' => 18,
                'duration' => 'Ongoing / Graded',
                'mode' => 'In-Person',
                'eligibility' => 'Children and teens aged 4 to 18. No dance experience necessary.',
                'curriculum' => [
                    'Cardio Warm-Ups, Core Strengthening & Flexibility Conditioning',
                    'Hip-Hop Basics: Popping, Locking, Footwork & Isolations',
                    'Contemporary & Lyrical: Flow, Floor Work & Expressive Movement',
                    'Traditional Indian Folk Dance: Kolattam, Karagattam & Dandiya Steps',
                    'Stage Presence, Synchronization & Ensemble Group Choreography',
                ],
                'learning_outcomes' => [
                    'Develop high cardiovascular endurance, flexibility, and physical rhythm',
                    'Perform synchronized choreography across multiple contemporary genres',
                    'Overcome stage fright and shine with radiant confidence in group performances',
                    'Express personal emotion freely through musical interpretation and body flow',
                ],
                'who_is_for' => [
                    'Kids and teens who love moving to modern music and upbeat beats',
                    'Students preparing for annual day school dance competitions',
                    'Anyone wanting a fun, energetic alternative to traditional gym workouts',
                ],
                'why_choose' => [
                    'Professional choreographers with cinematic and TV stage experience',
                    'High-energy, positive environment that celebrates every child’s movement style',
                    'Exciting stage showcases, video shoots, and performance opportunities',
                ],
                'teaching_approach' => 'Beat-by-beat count breakdown, mirror synchronization drills, and energetic group routines.',
                'class_schedule' => 'Weekend batches (2 hours per session).',
                'certificate_available' => true,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 16,
                'modules' => [
                    ['title' => 'Module 1: Rhythm Basics & Body Isolations', 'description' => 'Head, chest, and hip isolations, 8-count beat recognition, and bounce grooves.'],
                    ['title' => 'Module 2: Hip-Hop Steps & Floor Routines', 'description' => 'Top rock, six-step, glide, wave, and high-energy modern street dance combos.'],
                    ['title' => 'Module 3: Folk Dance Traditions & Props', 'description' => 'Festive folk choreography using sticks (Dandiya/Kolattam) and celebratory folk footwork.'],
                    ['title' => 'Module 4: Grand Stage Choreography', 'description' => 'Assembling all learned steps into an electrifying medley dance performance.'],
                ],
                'faqs' => [
                    ['question' => 'Are separate batches arranged by age group?', 'answer' => 'Yes! We conduct separate batches for Little Stars (ages 4-7), Juniors (ages 8-12), and Teens (ages 13-18) to ensure age-appropriate music and moves.'],
                ],
            ],

            // ==========================================
            // 4. SPORTS & FITNESS (7 Courses)
            // ==========================================
            [
                'category_slug' => 'sports-and-fitness',
                'title' => 'Karate Martial Arts & Self Defense',
                'slug' => 'karate',
                'short_description' => 'Shotokan / Goju-Ryu Karate training focusing on Kihon (basics), Kata (forms), Kumite (sparring), physical discipline, and practical self-defense.',
                'description' => 'Build rock-solid physical stamina, unwavering discipline, and life-saving self-defense capability. Our Karate academy follows traditional Japanese martial arts pedagogy. Students progress through graded belt rankings by mastering fundamental strikes, blocks, kicks (Kihon), synchronized forms (Kata), and controlled sparring (Kumite) under certified Black Belt Senseis.',
                'age_min' => 2,
                'age_max' => 18,
                'duration' => 'Belt-Graded / Ongoing',
                'mode' => 'In-Person',
                'eligibility' => 'Children and youth aged 5 and above. Ready for athletic physical activity.',
                'curriculum' => [
                    'Dojo Etiquette, Bowing Respect & Martial Warm-Ups',
                    'Kihon: Stances (Zenkutsu-Dachi), Punches (Tsuki), Blocks (Age-Uke, Soto-Uke)',
                    'Kicking Mechanics: Mae-Geri (Front), Mawashi-Geri (Roundhouse), Yoko-Geri (Side)',
                    'Kata: Heian Shodan to Godan Traditional Japanese Forms',
                    'Kumite: Safe Controlled Sparring, Reaction Timing & Counter-Strikes',
                    'Anti-Bullying Strategies, Situational Awareness & Street Self-Defense',
                ],
                'learning_outcomes' => [
                    'Develop explosive core strength, speed, flexibility, and reflexes',
                    'Master practical anti-bullying and self-defense escape techniques',
                    'Cultivate profound humility, respect, emotional composure, and grit',
                    'Achieve officially certified belt ranks recognized by national federations',
                ],
                'who_is_for' => [
                    'Children needing physical confidence, discipline, and healthy exercise',
                    'Parents wanting their children equipped with real-world self-defense skills',
                    'Youth aspiring to participate in district, state, and national Karate tournaments',
                ],
                'why_choose' => [
                    'Affiliated with recognized national and international Karate federations',
                    'Qualified 4th & 5th Dan Black Belt instructors prioritizing student safety',
                    'Protective sparring gear and padded training dojo floors',
                ],
                'teaching_approach' => 'Repetitive muscle memory drills, partner pad-work, form demonstrations, and controlled sparring.',
                'class_schedule' => 'Weekend batches (2 hours) or Weekday morning/evening options.',
                'certificate_available' => true,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 17,
                'modules' => [
                    ['title' => 'Module 1: White to Yellow Belt Fundamentals', 'description' => 'Dojo bowing, front stance, straight punch, high block, and front kick.'],
                    ['title' => 'Module 2: Orange to Green Belt Progression', 'description' => 'Side stance, back stance, knife-hand block, roundhouse kicks, and Heian Shodan kata.'],
                    ['title' => 'Module 3: Blue to Brown Belt Sparring Dynamics', 'description' => 'Target strikes on focus pads, foot sweeps, rapid counter-punches, and Heian Sandan kata.'],
                    ['title' => 'Module 4: Advanced Kata & Federation Tournament Prep', 'description' => 'Competition Kata execution, point-sparring tactics, and belt grading examinations.'],
                ],
                'faqs' => [
                    ['question' => 'Is Karate dangerous for young children?', 'answer' => 'Not at all. In our dojo, safety and control are paramount. Sparring is non-contact or light-touch with full protective gear under direct Sensei supervision.'],
                ],
            ],

            [
                'category_slug' => 'sports-and-fitness',
                'title' => 'Silambam Traditional Martial Arts',
                'slug' => 'silambam',
                'short_description' => 'Ancient Tamil martial art of bamboo staff fighting promoting lightning reflexes, wrist flexibility, footwork, and cultural heritage.',
                'description' => 'Silambam is an ancient weapon-based martial art from Tamil Nadu dating back thousands of years. Centered on the agile manipulation of a flexible bamboo staff, this art form develops incredible 360-degree bodily awareness, explosive wrist speed, circular footwork (Kaaladi), and mental sharpness while connecting students to pride in their cultural martial heritage.',
                'age_min' => 5,
                'age_max' => 18,
                'duration' => 'Graded / Ongoing',
                'mode' => 'In-Person',
                'eligibility' => 'Students aged 6 and above. No prior martial arts experience required.',
                'curriculum' => [
                    'Bamboo Staff Selection, Balance & Vanakkam Salutation Stances',
                    'Footwork Mechanics: 16 Core Kaaladi Patterns & Multi-Directional Dodging',
                    'Staff Rotation Drills: Single-Hand & Double-Hand Rapid Twirls (Suvadu)',
                    'Offensive Thrusts (Kuttu), Defensive Parries (Thaduppu) & Sweeps',
                    'Speed Demonstration Routines, Synchronization & Tournament Sparring Rules',
                ],
                'learning_outcomes' => [
                    'Build extraordinary wrist strength, shoulder flexibility, and cardiovascular stamina',
                    'Achieve rapid 360-degree peripheral vision and instantaneous reflex reactions',
                    'Learn traditional self-defense tactics using sticks and everyday objects',
                    'Compete in school and district level Silambam championships',
                ],
                'who_is_for' => [
                    'Children wanting to learn an authentic traditional Indian martial art',
                    'Students looking to build lightning-fast reflexes and whole-body agility',
                    'Youth interested in martial weapon mastery, stick fighting, and cultural pride',
                ],
                'why_choose' => [
                    'Taught by certified Silambam Asans (Masters) with heritage lineage',
                    'Handpicked seasoned bamboo staves matched to every student’s height',
                    'Safe open-floor training ground with progressive grading milestones',
                ],
                'teaching_approach' => 'Circular movement drills, staff spinning partner exchanges, and footwork pattern mastery.',
                'class_schedule' => 'Weekend batches (2 hours on Saturday or Sunday mornings).',
                'certificate_available' => true,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 18,
                'modules' => [
                    ['title' => 'Module 1: Vanakkam & Staff Grip Fundamentals', 'description' => 'Staff measuring, finger placement, figure-8 wrist rotation, and salutation.'],
                    ['title' => 'Module 2: Kaaladi Footwork & Circular Movement', 'description' => 'Moving in square and triangular patterns while keeping the staff in continuous defensive motion.'],
                    ['title' => 'Module 3: Offensive & Defensive Suvadus', 'description' => 'Linear thrusts, high sweeps, ground strikes, and blocking overhead attacks.'],
                    ['title' => 'Module 4: Synchronized Demonstration & Sparring', 'description' => 'Performing fast twin-stick and staff routines to rhythmic beats and mock tournament fights.'],
                ],
                'faqs' => [
                    ['question' => 'How heavy is the Silambam staff for a child?', 'answer' => 'We use lightweight, flexible, smoothed bamboo staffs custom-cut to reach just below the child’s eye level, making it completely safe and easy to maneuver.'],
                ],
            ],

            [
                'category_slug' => 'sports-and-fitness',
                'title' => 'Holistic Yoga & Mindfulness',
                'slug' => 'yoga',
                'short_description' => 'Hatha and Vinyasa asanas, Pranayama breath control, Surya Namaskar series, and guided meditation for focus and flexibility.',
                'description' => 'In an era of digital distractions and academic pressures, our Yoga & Mindfulness program provides a sanctuary of health, serenity, and mental clarity. Designed specifically for growing children and teenagers, the curriculum blends dynamic Surya Namaskars, balance asanas, calming Pranayama breathwork, and guided meditation to build posture, flexibility, and focus.',
                'age_min' => 3,
                'age_max' => 18,
                'duration' => '3 Months',
                'mode' => 'In-Person',
                'eligibility' => 'Students aged 5 to 18. All fitness levels and body types welcome.',
                'curriculum' => [
                    'Dynamic & Traditional Surya Namaskar (12-Step Sun Salutation Series)',
                    'Standing Balance Asanas: Vrikshasana (Tree), Tadasana, Virabhadrasana (Warrior)',
                    'Floor Flexibility & Spine Alignment: Bhujangasana, Dhanurasana, Paschimottanasana',
                    'Pranayama Breathing: Nadi Shodhana, Anulom Vilom, Bhramari, Kapalabhati',
                    'Guided Yoga Nidra, Relaxation Visualization & Exam Stress Relief',
                ],
                'learning_outcomes' => [
                    'Correct poor study postures, back slouching, and neck stiffness',
                    'Dramatically enhance mental calmness, memory concentration, and emotional stability',
                    'Build deep lung capacity, immunity, flexibility, and bodily strength',
                    'Cultivate lifelong mindfulness tools to manage stress and anxiety easily',
                ],
                'who_is_for' => [
                    'Children with posture issues from heavy schoolbags and screen usage',
                    'Students experiencing exam anxiety, restlessness, or trouble sleeping',
                    'Young athletes looking to improve overall flexibility and avoid sports injuries',
                ],
                'why_choose' => [
                    'Certified Yoga Alliance & AYUSH-certified instructors with child-friendly methods',
                    'Calm, airy, hygienic yoga hall with natural light and eco-friendly mats',
                    'Interactive, fun approach incorporating animal postures and breathing games for kids',
                ],
                'teaching_approach' => 'Gentle alignment cues, progressive breathing harmonization, and meditative storytelling.',
                'class_schedule' => 'Weekend morning batches (1 hour) or Weekday dawn sessions.',
                'certificate_available' => true,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 19,
                'modules' => [
                    ['title' => 'Module 1: Spine Mobility & Sun Salutations', 'description' => 'Gentle joint rotations (Sukshma Vyayama) and mastering the 12 steps of Surya Namaskar.'],
                    ['title' => 'Module 2: Balance & Core Stability Asanas', 'description' => 'Tree pose, eagle pose, and warrior stances to strengthen ankles, legs, and concentration.'],
                    ['title' => 'Module 3: Pranayama & Breath Control', 'description' => 'Alternate nostril breathing, bee breath (Bhramari), and calming heart-rate techniques.'],
                    ['title' => 'Module 4: Yoga Nidra & Mindfulness Integration', 'description' => 'Deep body relaxation, positive self-affirmations, and daily morning routines.'],
                ],
                'faqs' => [
                    ['question' => 'My child is not flexible. Can they still join Yoga?', 'answer' => 'Yes, absolutely! Flexibility is the outcome of practicing yoga, not a prerequisite. Every posture is modified gently according to the child’s starting level.'],
                ],
            ],

            [
                'category_slug' => 'sports-and-fitness',
                'title' => 'Zumba & Aerobic Fitness',
                'slug' => 'zumba-and-fitness',
                'short_description' => 'Dynamic dance-fitness choreography blending Latin rhythms, pop cardio, core strengthening, and fun calorie-burning workouts.',
                'description' => 'Make fitness the happiest hour of the week! Zumba & Aerobic Fitness blends pulsating dance rhythms with high-energy aerobic intervals. Tailored for children and teens, our classes transform standard workouts into vibrant dance parties that incinerate calories, boost stamina, release happy endorphins, and build lifelong healthy physical habits.',
                'age_min' => 3,
                'age_max' => 18,
                'duration' => 'Ongoing / Fitness',
                'mode' => 'In-Person',
                'eligibility' => 'Students aged 5 to 18 years. Ready to sweat, smile, and dance.',
                'curriculum' => [
                    'Dynamic Cardio Warm-Ups & Joint Mobility Activation',
                    'Zumba Kids Choreography: Merengue, Salsa, Cumbia & Pop Hits',
                    'Bodyweight Aerobic Intervals: Jumping Jacks, Squats, High Knees & Lunges',
                    'Rhythm Follow-the-Leader Games & Team Coordination Battles',
                    'Cool Down Stretching, Breathing & Muscle Recovery Routine',
                ],
                'learning_outcomes' => [
                    'Burn excess energy, maintain healthy BMI, and boost cardiovascular stamina',
                    'Improve rhythm, body coordination, and quick neuromuscular responses',
                    'Alleviate mental fatigue, stress, and moodiness through endorphin release',
                    'Build positive body image and enthusiasm for daily physical activity',
                ],
                'who_is_for' => [
                    'Children with sedentary lifestyles needing energetic aerobic activity',
                    'Kids who dislike boring gym exercises but love dancing to upbeat music',
                    'Students wanting to stay physically fit, agile, and energized',
                ],
                'why_choose' => [
                    'Licensed Zumba Kids instructors with infectious high energy',
                    'Pumping surround-sound music system and shock-absorbent studio flooring',
                    'Positive, encouraging, zero-judgment atmosphere where every child shines',
                ],
                'teaching_approach' => 'Follow-along visual dance cues, interval tempo changes, and fun team dance games.',
                'class_schedule' => 'Weekend batches or Weekday evening batches (1 hour per session).',
                'certificate_available' => true,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 20,
                'modules' => [
                    ['title' => 'Module 1: Cardio Fundamentals & Easy Grooves', 'description' => 'Bouncing steps, slide-and-step footwork, arm reaches, and tempo matching.'],
                    ['title' => 'Module 2: Latin & Global Beat Choreographies', 'description' => 'Salsa side-steps, reggaeton stomps, and upbeat African & Bollywood fusion dance routines.'],
                    ['title' => 'Module 3: Aerobic Conditioning & Core Games', 'description' => 'Fun fitness challenges, obstacle hops, and agility ladder games disguised as dance.'],
                    ['title' => 'Module 4: Performance Routines & Celebration Show', 'description' => 'Putting together high-energy group fitness choreographies for studio showcases.'],
                ],
                'faqs' => [
                    ['question' => 'What attire is suitable for Zumba classes?', 'answer' => 'Comfortable, breathable sportswear (t-shirt and tracks/leggings) along with supportive athletic sports shoes with non-marking soles.'],
                ],
            ],

            [
                'category_slug' => 'sports-and-fitness',
                'title' => 'Kids & Youth Gymnastics',
                'slug' => 'gymnastics',
                'short_description' => 'Floor gymnastics, body conditioning, somersaults, handstands, cartwheels, and flexibility under safe padded mat supervision.',
                'description' => 'Build breathtaking balance, body control, and acrobatic agility! Our Gymnastics program introduces children to floor acrobatics, tumbling, balancing beams, and vault fundamentals. Under the watchful eyes of certified gymnastics coaches and on thick safety crash mats, children master rolls, cartwheels, bridges, and handstands with complete confidence and safety.',
                'age_min' => 3,
                'age_max' => 18,
                'duration' => 'Ongoing / Graded',
                'mode' => 'In-Person',
                'eligibility' => 'Children aged 4 to 14. Eager to tumble, roll, and balance.',
                'curriculum' => [
                    'Core Conditioning, Ankle/Wrist Strengthening & Split Stretches',
                    'Floor Tumbling: Forward Rolls, Backward Rolls, Pike Rolls & Dive Rolls',
                    'Balance Postures: Bridge, Candle Stand, Handstand Holds & Cartwheels',
                    'Acrobatic Elements: Round-Offs, Front Walkovers & Back Bends',
                    'Balance Beam Walking, Mini-Vault Springs & Soft Mat Landings',
                ],
                'learning_outcomes' => [
                    'Develop extraordinary core strength, full-body flexibility, and balance',
                    'Learn safe landing mechanics that prevent physical injuries in all sports',
                    'Overcome fear of inversion through gradual assisted handstand training',
                    'Build impeccable athletic posture, physical courage, and agility',
                ],
                'who_is_for' => [
                    'Active children who love tumbling, somersaulting, and climbing at home',
                    'Young athletes wanting foundational flexibility and core strength for other sports',
                    'Children needing improved motor coordination and postural balance',
                ],
                'why_choose' => [
                    'Fully equipped gymnastics floor with high-density EVA safety mats and incline wedges',
                    'Trained gymnastics coaches with spotter safety certifications',
                    'Carefully calibrated progress tracking ensuring no child is pushed beyond their biomechanics',
                ],
                'teaching_approach' => 'Guided spotting, progressive wedge-mat drills, and gymnastic routine sequencing.',
                'class_schedule' => 'Weekend batches (1.5 hours per session).',
                'certificate_available' => true,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 21,
                'modules' => [
                    ['title' => 'Module 1: Safe Landings & Floor Rolls', 'description' => 'Hollow body hold, tuck roll, forward somersault, and safe fall distribution.'],
                    ['title' => 'Module 2: Inversions & Bridge Flexibility', 'description' => 'Full back bridge, tripod headstand, and assisted wall handstands.'],
                    ['title' => 'Module 3: Cartwheels & Acrobatic Dynamics', 'description' => 'Left and right side cartwheels, round-offs, and balance beam straight-line walks.'],
                    ['title' => 'Module 4: Gymnastics Routine Sequencing', 'description' => 'Combining rolls, cartwheels, and balances into a smooth continuous performance routine.'],
                ],
                'faqs' => [
                    ['question' => 'Is gymnastics safe for young kids?', 'answer' => 'Yes! Safety is our first rule. Every maneuver is taught on thick padded mats with dedicated coach spotting until the child demonstrates independent mastery.'],
                ],
            ],

            [
                'category_slug' => 'sports-and-fitness',
                'title' => 'Carrom Board Tactics & Tournament Play',
                'slug' => 'carrom',
                'short_description' => 'Master striker techniques, rebound geometry, cut shots, double pockets, thumb shots, and national tournament carrom board rules.',
                'description' => 'Step onto the championship carrom board! Carrom is a brilliant blend of geometric precision, fine finger mechanics, and tactical board management. Our coaching program guides players from basic grip and striking power to complex rebound banking, cut shots, second-coin pocketing, and defensive Queen control under official International Carrom Federation rules.',
                'age_min' => 6,
                'age_max' => 16,
                'duration' => '2 Months',
                'mode' => 'In-Person',
                'eligibility' => 'Children aged 6 to 16. Enthusiastic about board games and precision sports.',
                'curriculum' => [
                    'Board Geometry, Striker Balance, Powder Friction & Baseline Positioning',
                    'Fundamental Grips: Middle-Finger Flick, Scissor Grip & Thumb Push',
                    'Linear Pocketing, Center Break Techniques & Follow-Through Mechanics',
                    'Rebound Angles: Single Bank, Double Bank & Frame Reflection Mathematics',
                    'Tactical Shots: Cut Shots, Slice Pockets, Double Pocketing & Queen Cover Maneuvers',
                    'Tournament Rules, Foul Penalties, Board Etiquette & Timed Matches',
                ],
                'learning_outcomes' => [
                    'Pocket carrom men accurately from challenging board angles and corners',
                    'Calculate rebound trajectories instinctively using geometric intuition',
                    'Master finger strength, striker control, and touch sensitivity',
                    'Compete in school, club, and state-level carrom tournaments with poise',
                ],
                'who_is_for' => [
                    'Children who enjoy board games and want to learn genuine championship techniques',
                    'Players looking to eliminate fouls and pocket coins with reliable accuracy',
                    'Students seeking a focused indoor sport that builds patience and hand-eye precision',
                ],
                'why_choose' => [
                    'Championship-grade English Birch ply tournament carrom boards',
                    'Certified carrom players and state medalists as personal coaches',
                    'Weekly in-house ranking tournaments and singles/doubles mock matches',
                ],
                'teaching_approach' => 'Target practice drills, angle visualization coaching, and supervised competitive matches.',
                'class_schedule' => 'Weekend batches (1.5 hours per session).',
                'certificate_available' => true,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 22,
                'modules' => [
                    ['title' => 'Module 1: Board Setup & Striking Mechanics', 'description' => 'Finger placement, thumbing techniques, baseline rules, and straight pocketing.'],
                    ['title' => 'Module 2: Center Break & Cut Shots', 'description' => 'Powerful break techniques to scatter coins favorably and angled slice cuts.'],
                    ['title' => 'Module 3: Rebound Banks & Multi-Coin Tactics', 'description' => 'Bouncing striker off cushions to reach blocked coins; double coin pocketing.'],
                    ['title' => 'Module 4: Queen Management & Tournament Rules', 'description' => 'Covering the Queen, penalty coins, match scoring, and competitive game management.'],
                ],
                'faqs' => [
                    ['question' => 'How does carrom help a child’s concentration?', 'answer' => 'Carrom requires intense visual targeting, breath control before striking, and deep patience—substantially enhancing attention spans.'],
                ],
            ],

            [
                'category_slug' => 'sports-and-fitness',
                'title' => 'Precision Dart & Target Focus',
                'slug' => 'dart',
                'short_description' => 'Develop laser-sharp focus, hand-eye coordination, trajectory mechanics, stance balance, and competitive dartboard scoring tactics.',
                'description' => 'Sharpen focus to pinpoint accuracy! Dart is an Olympic-recognized precision sport that demands stillness of mind, perfect stance alignment, and exact parabolic throwing mechanics. Our Precision Dart course trains students in official 501/301 tournament formats, teaching grip consistency, elbow hinge movement, fast mental arithmetic checkouts, and unshakeable psychological focus.',
                'age_min' => 8,
                'age_max' => 18,
                'duration' => '2 Months',
                'mode' => 'In-Person',
                'eligibility' => 'Students aged 8 to 18 years. Ready for target concentration training.',
                'curriculum' => [
                    'Dartboard Anatomy (Bullseye, Double & Triple Rings, Oche Line)',
                    'Stance Alignment, Center of Gravity & Foot Placement at the Oche',
                    'Grip Consistency, Elbow Pivot Alignment & Release Follow-Through',
                    'Parabolic Flight Mechanics & Eliminating Wobble / Deflection',
                    'Game Mathematics: 501 & 301 Scoring, Rapid Mental Subtraction & Doubles Checkouts',
                    'Pressure Play Psychology, Tournament Formats & Match Play',
                ],
                'learning_outcomes' => [
                    'Achieve high cluster grouping and consistent targeting on triple & double rings',
                    'Calculate fast mental subtraction checkouts without hesitation during matches',
                    'Develop extraordinary stillness of mind, breath control, and emotional composure',
                    'Participate in organized youth dart tournaments with tournament confidence',
                ],
                'who_is_for' => [
                    'Students who enjoy precision target games and mental focus challenges',
                    'Youth looking for an Olympic-caliber sport requiring minimal physical bulk but high skill',
                    'Learners wanting to combine fast mental math calculations with athletic precision',
                ],
                'why_choose' => [
                    'Professional sisal bristle dartboards mounted to exact WDF height and distance',
                    'High-grade tungsten steel-tip and soft-tip practice darts fitted to student hand sizes',
                    'Specialized training software for real-time scoring and checkout calculations',
                ],
                'teaching_approach' => 'Stance analysis, release trajectory video capture, group games (Around the Clock, 501), and pressure matches.',
                'class_schedule' => 'Weekend batches (1.5 hours per session).',
                'certificate_available' => true,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 23,
                'modules' => [
                    ['title' => 'Module 1: The Oche Stance & Finger Grip', 'description' => 'Foot angle, body weight distribution, 3-finger grip, and level elbow targeting.'],
                    ['title' => 'Module 2: Throw Mechanics & Trajectory Control', 'description' => 'Smooth backswing, forward acceleration, release point, and pointed follow-through.'],
                    ['title' => 'Module 3: Around the Clock & Ring Targeting', 'description' => 'Targeting numbers 1 to 20 sequentially, double rings, and bullseye precision.'],
                    ['title' => 'Module 4: 501 Tournament Play & Fast Checkouts', 'description' => 'Rapid subtraction math, two-dart and three-dart checkouts, and championship match play.'],
                ],
                'faqs' => [
                    ['question' => 'Are darts safe for students?', 'answer' => 'Yes. Safety protocols are rigorously enforced: students only throw from behind the oche line, and retrieving darts is strictly coordinated by the coach.'],
                ],
            ],

            // ==========================================
            // 5. LANGUAGE DEVELOPMENT (2 Courses)
            // ==========================================
            [
                'category_slug' => 'language-development',
                'title' => 'Spoken English & Communication Skills',
                'slug' => 'spoken-english',
                'short_description' => 'Overcome hesitation, master everyday grammar, natural phonetics, storytelling, group discussions, and confident public speaking.',
                'description' => 'Fluency in English is the ultimate passport to academic and global success. The Sri Deekshaa Spoken English academy transforms shy, hesitant speakers into articulate, expressive communicators. Through real-world role-plays, impromptu speech sessions (JAM), vocabulary expansion, and accent neutralisation, students gain the confidence to express ideas eloquently in any environment.',
                'age_min' => 6,
                'age_max' => 18,
                'duration' => '3 Months',
                'mode' => 'In-Person',
                'eligibility' => 'Students aged 6 to 18 years seeking English speaking fluency and confidence.',
                'curriculum' => [
                    'Overcoming Stage Fright, Hesitation & Mother-Tongue Influence (MTI)',
                    'Functional Grammar: Tenses, Modals, Prepositions & Sentence Frameworks',
                    'Everyday Situational Conversations: Social, Academic & Public Interactions',
                    'Vocabulary Power: Idioms, Phrasal Verbs & Professional Expressions',
                    'Public Speaking: Impromptu Speaking (JAM), Debating, Storytelling & Presentations',
                    'Active Listening, Voice Modulation & Non-Verbal Body Language',
                ],
                'learning_outcomes' => [
                    'Speak fluent, grammatically sound English without hesitation or pausing',
                    'Deliver school presentations and speeches with charismatic stage presence',
                    'Express complex thoughts clearly in debates, interviews, and group discussions',
                    'Cultivate a natural global accent and clear phonetic articulation',
                ],
                'who_is_for' => [
                    'Students who understand English well but hesitate or freeze while speaking',
                    'Children wanting to prepare for school debates, elocution, and student council',
                    'Youth aiming to build commanding interpersonal and communication skills',
                ],
                'why_choose' => [
                    '100% conversational practice with zero mechanical rote-memorization',
                    'Safe, encouraging, supportive classroom culture where mistakes are welcomed as learning',
                    'Video-recorded speech evaluations showing clear before-and-after progress',
                ],
                'teaching_approach' => 'Immersive spoken activities, podium speeches, paired dialogues, and constructive mentor feedback.',
                'class_schedule' => 'Weekend batches (2 hours) or 3 weekday evening sessions (1 hour each).',
                'certificate_available' => true,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 24,
                'modules' => [
                    ['title' => 'Module 1: Breaking Hesitation & Daily Conversations', 'description' => 'Icebreakers, self-introductions, daily routines, and building vocabulary for everyday life.'],
                    ['title' => 'Module 2: Practical Grammar in Action', 'description' => 'Expressing past experiences, future plans, conditional sentences, and questions effortlessly.'],
                    ['title' => 'Module 3: Pronunciation, MTI Neutralisation & Voice', 'description' => 'Correct syllable stress, phonetic clarity, eliminating regional accents, and intonation.'],
                    ['title' => 'Module 4: Public Speaking, Debating & Presentations', 'description' => 'Structuring a 3-minute speech, persuasive arguing, answering questions, and body language.'],
                ],
                'faqs' => [
                    ['question' => 'Will this course help my child who is very shy to speak?', 'answer' => 'Yes! Over 80% of our students started as shy, hesitant speakers. Our small batch sizes and positive encouragement make every child comfortable speaking from the very first week.'],
                ],
            ],

            [
                'category_slug' => 'language-development',
                'title' => 'Hindi (Saba Exams & Spoken Hindi)',
                'slug' => 'hindi-saba-exams',
                'short_description' => 'Complete coaching for Dakshin Bharat Hindi Prachar Sabha (DBHPS) certifications alongside conversational spoken Hindi fluency.',
                'description' => 'Master India’s national language with academic recognition and spoken elegance! Our Hindi curriculum provides dual mastery: complete syllabus coaching for the prestigious Dakshin Bharat Hindi Prachar Sabha (DBHPS) examinations (Parichaya, Prathmic, Madhyama, Rashtrabhasha, Praveshika) as well as practical, fluent spoken Hindi for daily social communication.',
                'age_min' => 6,
                'age_max' => 18,
                'duration' => '6 Months per Level',
                'mode' => 'In-Person',
                'eligibility' => 'Students aged 6 and above. No prior knowledge of Hindi required for beginner levels.',
                'curriculum' => [
                    'Devanagari Script: Varnamala, Matras, Conjunct Letters & Neat Writing',
                    'Official DBHPS Syllabus Coaching: Parichaya, Prathmic & Madhyama',
                    'Prose, Poetry Recitation, Word Meanings & Question-Answer Mastery',
                    'Hindi Grammar: Sangya, Sarvanam, Kriya, Kaal (Tenses), Ling & Vachan',
                    'Conversational Spoken Hindi: Daily Dialogues, Market Visits & Social Greetings',
                    'Model Exam Papers, Mock Tests, Speed Writing & Official Exam Center Guidance',
                ],
                'learning_outcomes' => [
                    'Pass official DBHPS examinations with First Class and Distinction honors',
                    'Read, write, and comprehend Devanagari script fluently and accurately',
                    'Converse confidently in spoken Hindi with natural accent and vocabulary',
                    'Gain government-recognized Hindi language qualification certificates',
                ],
                'who_is_for' => [
                    'Students preparing for official Dakshin Bharat Hindi Prachar Sabha exams',
                    'School students who need extra coaching for school Hindi second/third language',
                    'Anyone living in South India wanting to achieve fluent spoken Hindi skills',
                ],
                'why_choose' => [
                    'Certified Hindi Pracharaks with over 15 years of Sabha exam training experience',
                    '100% pass track record with majority students securing Distinctions',
                    'Assistance with official exam registration, hall tickets, and certification',
                ],
                'teaching_approach' => 'Systematic textbook coaching, grammar breakdown, past question paper drills, and oral conversational practice.',
                'class_schedule' => 'Weekend batches (2 hours) or twice-weekly evening batches.',
                'certificate_available' => true,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 25,
                'modules' => [
                    ['title' => 'Module 1: Varnamala, Matras & Basic Reading', 'description' => 'Vowels (Swar), consonants (Vyanjan), 2-letter and 3-letter word reading, and pronunciation.'],
                    ['title' => 'Module 2: Sabha Exam Text & Translation', 'description' => 'Lesson chapters, stories, moral poems, and Hindi-to-Tamil/English word meanings.'],
                    ['title' => 'Module 3: Essential Grammar & Essay Writing', 'description' => 'Noun, pronouns, gender rules, sentence corrections, and short creative essays.'],
                    ['title' => 'Module 4: Exam Mock Papers & Spoken Fluency', 'description' => 'Solving previous 5 years examination papers under timed constraints and conversational dialogues.'],
                ],
                'faqs' => [
                    ['question' => 'Are Dakshin Bharat Hindi Prachar Sabha certificates recognized?', 'answer' => 'Yes! DBHPS is an Institution of National Importance recognized by the Government of India, and its certificates hold lifetime validity.'],
                    ['question' => 'Can complete beginners join directly for Prathmic?', 'answer' => 'Beginners first complete the Parichaya introductory level or our accelerated Varnamala bridge course before taking the Prathmic exam.'],
                ],
            ],
        ];

        $validSlugs = collect($courses)->pluck('slug')->all();

        // Remove any legacy courses that are not part of the specified 25 courses
        Course::whereNotIn('slug', $validSlugs)->delete();

        $shortCodeMap = [
            'abacus' => 'ABA',
            'vedic-maths' => 'VM',
            'phonics' => 'PHO',
            'mid-brain-activation' => 'MBA',
            'quantum-speed-reading' => 'QSR',
            'spellbee' => 'SPB',
            'rubiks-cube' => 'RC',
            'chess' => 'CHS',
            'drawing-and-coloring' => 'DNC',
            'art-and-craft' => 'ANC',
            'calligraphy' => 'CAL',
            'handwriting' => 'HW',
            'carnatic-music' => 'CM',
            'keyboard' => 'KB',
            'classical-dance' => 'CD',
            'western-and-folk-dance' => 'WFD',
            'karate' => 'KAR',
            'silambam' => 'SIL',
            'yoga' => 'YOG',
            'zumba-and-fitness' => 'ZUM',
            'gymnastics' => 'GYM',
            'carrom' => 'CRM',
            'dart' => 'DRT',
            'spoken-english' => 'ENG',
            'hindi-saba-exams' => 'HIN',
        ];

        foreach ($courses as $courseData) {
            $catSlug = $courseData['category_slug'];
            $modules = $courseData['modules'] ?? [];
            $faqs = $courseData['faqs'] ?? [];

            unset($courseData['category_slug'], $courseData['modules'], $courseData['faqs']);

            if (isset($categories[$catSlug])) {
                $courseData['course_category_id'] = $categories[$catSlug]->id;
            }

            if (! isset($courseData['short_code']) && isset($shortCodeMap[$courseData['slug']])) {
                $courseData['short_code'] = $shortCodeMap[$courseData['slug']];
            }

            $course = Course::updateOrCreate(
                ['slug' => $courseData['slug']],
                $courseData
            );

            // Clear old modules & FAQs to prevent duplicate accumulation
            CourseModule::where('course_id', $course->id)->delete();
            CourseFaq::where('course_id', $course->id)->delete();

            // Seed Modules
            foreach ($modules as $index => $mod) {
                CourseModule::create([
                    'course_id' => $course->id,
                    'title' => $mod['title'],
                    'description' => $mod['description'] ?? null,
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]);
            }

            // Seed FAQs
            foreach ($faqs as $index => $faq) {
                CourseFaq::create([
                    'course_id' => $course->id,
                    'question' => $faq['question'],
                    'answer' => $faq['answer'],
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]);
            }
        }
    }
}
