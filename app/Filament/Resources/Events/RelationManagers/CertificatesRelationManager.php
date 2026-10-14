<?php

namespace App\Filament\Resources\Events\RelationManagers;

use App\Models\EventCertificate;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class CertificatesRelationManager extends RelationManager
{
    protected static string $relationship = 'certificates';

    protected static ?string $title = 'Participant Certificates (PDF)';

    protected static ?string $recordTitleAttribute = 'participant_name';

    protected static bool $isLazy = false;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)->schema([
                    TextInput::make('participant_name')
                        ->label('Participant Full Name')
                        ->placeholder('e.g. Aarav Sharma')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('registration_number')
                        ->label('Registration / Roll / Hall Ticket No')
                        ->placeholder('e.g. REG-2026-101')
                        ->maxLength(100)
                        ->helperText('Participants can search by this number on the event details page.'),

                    TextInput::make('certificate_title')
                        ->label('Certificate Title / Honor')
                        ->default('Certificate of Participation')
                        ->placeholder('e.g. Certificate of Participation, 1st Prize, Excellence Award')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('certificate_number')
                        ->label('Certificate ID Number (Optional)')
                        ->placeholder('e.g. SDIA-EVT-2026-001')
                        ->helperText('Leave empty to automatically generate a unique ID.')
                        ->maxLength(100),

                    FileUpload::make('certificate_file')
                        ->label('Certificate File (PDF Preferred)')
                        ->acceptedFileTypes(['application/pdf', 'application/x-pdf', 'image/jpeg', 'image/png'])
                        ->directory('events/certificates')
                        ->disk('public')
                        ->maxSize(51200)
                        ->openable()
                        ->downloadable()
                        ->required()
                        ->columnSpanFull()
                        ->helperText('Upload the participant certificate as a PDF (up to 50MB). Participants can download this directly from the event details page.'),

                    TextInput::make('mobile')
                        ->label('Mobile Number (Optional)')
                        ->tel()
                        ->maxLength(30),

                    TextInput::make('email')
                        ->label('Email Address (Optional)')
                        ->email()
                        ->maxLength(255),

                    TextInput::make('remarks')
                        ->label('Remarks / Category (Optional)')
                        ->placeholder('e.g. Sub-Junior Category, Speed Math Track')
                        ->columnSpanFull(),

                    Toggle::make('is_published')
                        ->label('Published & Available for Download')
                        ->default(true)
                        ->helperText('When enabled, the certificate can be searched and downloaded on the event details page.'),
                ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('participant_name')
            ->defaultSort('participant_name', 'asc')
            ->columns([
                TextColumn::make('participant_name')
                    ->label('Participant Name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('registration_number')
                    ->label('Reg / Roll No')
                    ->badge()
                    ->color('info')
                    ->searchable()
                    ->placeholder('—'),

                TextColumn::make('certificate_title')
                    ->label('Certificate Honor')
                    ->badge()
                    ->color('success')
                    ->searchable(),

                TextColumn::make('certificate_number')
                    ->label('Certificate ID')
                    ->badge()
                    ->color('gray')
                    ->searchable(),

                TextColumn::make('certificate_file')
                    ->label('File')
                    ->badge()
                    ->color('primary')
                    ->formatStateUsing(fn ($state): string => str_ends_with(strtolower((string) $state), '.pdf') ? 'PDF' : 'Doc')
                    ->url(fn (EventCertificate $record): string => $record->file_url, shouldOpenInNewTab: true),

                IconColumn::make('is_published')
                    ->label('Published')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Uploaded')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_published')
                    ->label('Published Status'),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Add Single Certificate')
                    ->icon(Heroicon::OutlinedPlus),

                Action::make('bulk_upload')
                    ->label('Bulk Upload Certificates (Multiple PDFs)')
                    ->icon(Heroicon::OutlinedArrowUpTray)
                    ->color('info')
                    ->modalHeading('Bulk Upload Participant Certificate PDFs')
                    ->modalDescription('Upload multiple certificate PDF files. For each file, the participant name will be automatically derived from the filename (e.g. "Rahul_Sharma.pdf" -> "Rahul Sharma"). You can edit each record afterwards.')
                    ->form([
                        TextInput::make('default_title')
                            ->label('Default Certificate Title')
                            ->default('Certificate of Participation')
                            ->required(),

                        FileUpload::make('pdf_files')
                            ->label('Certificate PDF Files')
                            ->multiple()
                            ->acceptedFileTypes(['application/pdf', 'application/x-pdf', 'image/jpeg', 'image/png'])
                            ->directory('events/certificates')
                            ->disk('public')
                            ->maxSize(51200)
                            ->maxFiles(100)
                            ->required()
                            ->helperText('Select participant certificate PDF files (up to 50MB per file) to upload together.'),
                    ])
                    ->action(function (array $data): void {
                        $files = (array) ($data['pdf_files'] ?? []);
                        $defaultTitle = $data['default_title'] ?? 'Certificate of Participation';
                        $event = $this->getOwnerRecord();
                        $count = 0;

                        foreach ($files as $filePath) {
                            $basename = pathinfo($filePath, PATHINFO_FILENAME);
                            $cleanName = ucwords(str_replace(['_', '-', '.'], ' ', $basename));

                            EventCertificate::create([
                                'event_id' => $event->id,
                                'participant_name' => $cleanName,
                                'certificate_title' => $defaultTitle,
                                'certificate_file' => $filePath,
                                'is_published' => true,
                            ]);
                            $count++;
                        }

                        Notification::make()
                            ->title("Successfully uploaded {$count} participant certificates!")
                            ->success()
                            ->send();
                    }),
            ])
            ->recordActions([
                Action::make('download')
                    ->label('View / Download')
                    ->icon(Heroicon::OutlinedArrowDownTray)
                    ->url(fn (EventCertificate $record): string => $record->file_url, shouldOpenInNewTab: true),

                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
