<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReferralsResource\Pages;
use App\Models\JobOpenings;
use App\Models\Referrals;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ReferralsResource extends Resource
{
    protected static ?string $model = Referrals::class;

    protected static ?string $recordTitleAttribute = 'jobopenings.postingTitle';

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationIcon = 'healthicons-o-referral';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Refer a Candidate')
                    ->schema([
                        Forms\Components\FileUpload::make('resume')
                            ->hint('Supported file types: .pdf')
                            ->nullable()
                            ->acceptedFileTypes([
                                'application/pdf',
                            ]),
                        Forms\Components\Section::make('Job Recommendation')
                            ->schema([
                                Forms\Components\Select::make('ReferringJob')
                                    ->prefixIcon('heroicon-s-briefcase')
                                    ->options(JobOpenings::all()->pluck('JobTitle', 'id'))
                                    ->required(),
                            ]),
                        Forms\Components\Section::make('Candidate Information')
                            ->schema([
                                Forms\Components\Select::make('Candidate')
                                    ->prefixIcon('heroicon-s-briefcase')
                                    ->relationship(name: 'candidates', titleAttribute: 'full_name')
                                    ->searchable(['email', 'LastName', 'FirstName'])
                                    ->preload()
                                    ->required()
                                    ->createOptionForm([
                                        Forms\Components\TextInput::make('FirstName')
                                            ->label('First Name'),
                                        Forms\Components\TextInput::make('LastName')
                                            ->label('Last Name'),
                                        Forms\Components\TextInput::make('Mobile')
                                            ->label('Mobile')
                                            ->tel(),
                                        Forms\Components\TextInput::make('Email')
                                            ->required(),
                                        Forms\Components\TextInput::make('CurrentEmployer')
                                            ->label('Current Employer (Company Name)'),
                                        Forms\Components\TextInput::make('CurrentJobTitle')
                                            ->label('Current Job Title'),
                                    ]),
                            ]),
                        Forms\Components\Section::make('Additional Information')
                            ->schema([
                                Forms\Components\Select::make('Relationship')
                                    ->options([
                                        'None' => 'None',
                                        'Personally Known' => 'Personally Known',
                                        'Former Colleague' => 'Former Colleague',
                                        'Socially Connected' => 'Socially Connected',
                                        'Got the resume through a common fried' => 'Got the resume through a common fried',
                                        'Others' => 'Others',
                                    ]),
                                Forms\Components\Select::make('KnownPeriod')
                                    ->options([
                                        'None' => 'None',
                                        'Less than a year',
                                        '1-2 years' => '1-2 years',
                                        '3-5 years' => '3-5 years',
                                        '5+ years' => '5+ years',
                                    ]),
                                Forms\Components\Textarea::make('Notes')
                                    ->nullable(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('candidates.FullName'),
                Tables\Columns\TextColumn::make('jobopenings.JobTitle'),
                Tables\Columns\TextColumn::make('jobcandidates.CandidateStatus'),
                Tables\Columns\TextColumn::make('jobcandidates.candidateOwner'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReferrals::route('/'),
            'create' => Pages\CreateReferrals::route('/create'),
            'view' => Pages\ViewReferrals::route('/{record}'),
            'edit' => Pages\EditReferrals::route('/{record}/edit'),
        ];
    }
}
