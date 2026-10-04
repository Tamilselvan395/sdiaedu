<?php

namespace App\Filament\Resources\Certificates\Schemas;

use App\Enums\CertificateStatus;
use App\Models\Certificate;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class CertificateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Certificate Management')->tabs([

                    // Tab 1: Certificate & Student Details
                    Tab::make('Certificate Details')
                        ->icon('heroicon-o-identification')
                        ->schema([
                            Section::make('Student & Course Information')
                                ->schema([
                                    Grid::make(2)->schema([
                                        TextInput::make('certificate_number')
                                            ->label('Enrollment / Certificate No.')
                                            ->required()
                                            ->maxLength(255)
                                            ->unique(ignoreRecord: true)
                                            ->default(fn (Get $get) => Certificate::generateCertificateNumber($get('course_id')))
                                            ->helperText('Auto-generated format: SDIA-{YEAR}-{SHORT_CODE}-{01}. Automatically updates when course is selected.'),

                                        Select::make('student_id')
                                            ->label('Enrolled Student')
                                            ->relationship('student', 'first_name')
                                            ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->student_code} - {$record->first_name} {$record->last_name}")
                                            ->searchable(['student_code', 'first_name', 'last_name'])
                                            ->preload()
                                            ->required(),

                                        Select::make('course_id')
                                            ->label('Enrolled Course')
                                            ->relationship('course', 'title')
                                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->certificate_name ? "{$record->title} ({$record->certificate_name})" : $record->title)
                                            ->searchable(['title', 'certificate_name'])
                                            ->preload()
                                            ->live()
                                            ->afterStateUpdated(function (Set $set, $state, ?string $operation) {
                                                if ($operation === 'create' && ! empty($state)) {
                                                    $set('certificate_number', Certificate::generateCertificateNumber($state));
                                                }
                                            })
                                            ->required()
                                            ->columnSpanFull(),
                                    ]),
                                ]),

                            Section::make('Dates & Status')
                                ->schema([
                                    Grid::make(3)->schema([
                                        DatePicker::make('issue_date')
                                            ->label('Issue Date')
                                            ->default(now())
                                            ->required(),

                                        DatePicker::make('completion_date')
                                            ->label('Completion Date'),

                                        Select::make('status')
                                            ->label('Validity Status')
                                            ->options(CertificateStatus::class)
                                            ->default('Valid')
                                            ->required(),
                                    ]),

                                    FileUpload::make('certificate_file')
                                        ->label('Digital Certificate File (PDF / Image)')
                                        ->disk('public')
                                        ->directory('certificates')
                                        ->visibility('public')
                                        ->acceptedFileTypes(['application/pdf', 'image/*'])
                                        ->openable()
                                        ->downloadable()
                                        ->columnSpanFull(),
                                ]),
                        ]),

                    // Tab 2: Marksheet & Subject-Wise Marks
                    Tab::make('Subject-Wise Marksheet')
                        ->icon('heroicon-o-academic-cap')
                        ->schema([
                            Section::make('Examination & Grading Summary')
                                ->description('Overall examination result details displayed on the official marksheet.')
                                ->schema([
                                    Grid::make(3)->schema([
                                        TextInput::make('exam_session')
                                            ->label('Exam Session')
                                            ->placeholder('e.g. JULY 2026')
                                            ->default('JULY 2026'),

                                        TextInput::make('result_status')
                                            ->label('Result Status')
                                            ->default('PASSED')
                                            ->placeholder('e.g. PASSED'),

                                        TextInput::make('division')
                                            ->label('Division / Class')
                                            ->default('Distinction')
                                            ->placeholder('e.g. Distinction, First Class'),

                                        TextInput::make('grade')
                                            ->label('Grade / Award')
                                            ->placeholder('e.g. A+, A (Distinction)'),

                                        TextInput::make('total_marks')
                                            ->label('Total Marks')
                                            ->placeholder('e.g. 627 / 700')
                                            ->helperText('Optional: Calculated automatically from subjects if left blank.'),

                                        TextInput::make('percentage')
                                            ->label('Percentage')
                                            ->placeholder('e.g. 90%')
                                            ->helperText('Optional: Calculated automatically from subjects if left blank.'),
                                    ]),
                                ]),

                            Section::make('Subject-Wise Marks')
                                ->description('Add, edit, or remove subjects, marks obtained, and maximum marks.')
                                ->schema([
                                    Repeater::make('subject_marks')
                                        ->label('Subject Modules & Marks')
                                        ->schema([
                                            Grid::make(12)->schema([
                                                TextInput::make('subject')
                                                    ->label('Subject / Module Name & Code')
                                                    ->placeholder('e.g. FOUNDATIONS OF EDUCATIONAL PSYCHOLOGY (CMTC001)')
                                                    ->required()
                                                    ->columnSpan(7),

                                                TextInput::make('obtained')
                                                    ->label('Marks Obtained')
                                                    ->numeric()
                                                    ->required()
                                                    ->placeholder('95')
                                                    ->columnSpan(2),

                                                TextInput::make('maximum')
                                                    ->label('Max Marks')
                                                    ->numeric()
                                                    ->required()
                                                    ->default(100)
                                                    ->placeholder('100')
                                                    ->columnSpan(3),
                                            ]),
                                        ])
                                        ->itemLabel(fn (array $state): ?string => ! empty($state['subject'])
                                                ? "{$state['subject']} (Marks: ".($state['obtained'] ?? 0).' / '.($state['maximum'] ?? 100).')'
                                                : null
                                        )
                                        ->collapsible()
                                        ->cloneable()
                                        ->reorderable()
                                        ->addActionLabel('+ Add Subject')
                                        ->default([
                                            ['subject' => 'THEORY MODULE 1', 'obtained' => 90, 'maximum' => 100],
                                            ['subject' => 'PRACTICAL MODULE 1', 'obtained' => 95, 'maximum' => 100],
                                        ])
                                        ->columnSpanFull(),
                                ]),
                        ]),

                ])->columnSpanFull(),
            ]);
    }
}
