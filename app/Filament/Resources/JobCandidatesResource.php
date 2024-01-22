<?php

namespace App\Filament\Resources;

use App\Filament\Enums\JobCandidateStatus;
use App\Filament\Resources\JobCandidatesResource\Pages;
use App\Filament\Resources\JobCandidatesResource\RelationManagers;
use App\Models\Candidates;
use App\Models\JobCandidates;
use App\Models\JobOpenings;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JobCandidatesResource extends Resource
{
    protected static ?string $model = JobCandidates::class;

    protected static ?string $recordTitleAttribute = 'job.postingTitle';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'vaadin-diploma-scroll';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                array_merge([],
                    self::candidatePipelineFormLayout(),
                    self::candidateBasicInformationFormLayout(),
                    self::candidateCurrentJobInformationFormLayout(),
                    self::candidateAddressInformationFormLayout()
                ));
    }

    public static function candidatePipelineFormLayout(): array
    {
        return [
            Forms\Components\Section::make('Candidate Pipeline')
                ->schema([
                    Forms\Components\Select::make('JobId')
                        ->label('Job Associated')
                        ->options(JobOpenings::all()->pluck('JobTitle', 'id'))
                        ->required(),
                    Forms\Components\Select::make('CandidateStatus')
                        ->label('Candidate Status')
                        ->options(JobCandidateStatus::class)
                        ->required(),
                    Forms\Components\TextInput::make('CandidateSource')
                        ->nullable('')
                        ->default('web'),
                    Forms\Components\Select::make('CandidateOwner')
                        ->label('Candidate Owner')
                        ->options(User::all()->pluck('name', 'id'))
                        ->nullable(),
                ])->columns(2),
        ];
    }

    public static function candidateBasicInformationFormLayout(): array
    {
        return [
            Forms\Components\TextInput::make('JobCandidateId')
                ->visibleOn('view')
                ->readOnly()
                ->disabled(),
            Forms\Components\Section::make('Candidate Basic Information')
                ->schema([
                    Forms\Components\Select::make('candidate')
                        ->options(Candidates::all()->pluck('full_name', 'id'))
                        ->required(),
                    Forms\Components\TextInput::make('mobile')
                        ->nullable(),
                    Forms\Components\TextInput::make('Email')
                        ->required()
                        ->email(),
                    Forms\Components\Select::make('ExperienceInYears')
                        ->label('Experience In Years')
                        ->options([
                            '1year' => '1 Year',
                            '2years' => '2 Years',
                            '3years' => '3 Years',
                            '4years' => '4 Years',
                            '5years+' => '5 Years & Above',
                        ]),
                    Forms\Components\TextInput::make('ExpectedSalary')
                        ->label('Expected Salary'),
                    Forms\Components\Select::make('HighestQualificationHeld')
                        ->options([
                            'Secondary/High School' => 'Secondary/High School',
                            'Associates Degree' => 'Associates Degree',
                            'Bachelors Degree' => 'Bachelors Degree',
                            'Masters Degree' => 'Masters Degree',
                            'Doctorate Degree' => 'Doctorate Degree',
                        ])
                        ->label('Highest Qualification Held'),
                ])->columns(2),
        ];
    }

    public static function candidateCurrentJobInformationFormLayout(): array
    {
        return [
            Forms\Components\Section::make('Candidate Current Job Information')
                ->schema([
                    Forms\Components\TextInput::make('CurrentEmployer')
                        ->label('Current Employer (Company Name)'),
                    Forms\Components\TextInput::make('CurrentJobTitle')
                        ->label('Current Job Title'),
                    Forms\Components\TextInput::make('CurrentSalary')
                        ->label('Current Salary'),
                ])->columns(2),
        ];
    }

    public static function candidateAddressInformationFormLayout(): array
    {
        return [
            Forms\Components\Section::make('Candidate Address Information')
                ->schema([
                    Forms\Components\TextInput::make('Street'),
                    Forms\Components\TextInput::make('City'),
                    Forms\Components\TextInput::make('Country'),
                    Forms\Components\TextInput::make('ZipCode'),
                    Forms\Components\TextInput::make('State'),
                ])->columns(2),
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('candidateProfile.full_name')
                    ->label('Candidate Name'),
                Tables\Columns\TextColumn::make('Email'),
                Tables\Columns\TextColumn::make('CandidateStatus')
                    ->label('Candidate Status'),
                Tables\Columns\TextColumn::make('CandidateSource')
                    ->label('Candidate Source')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('recordOwner.name')
                    ->label('Candidate Owner')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('mobile')
                    ->label('Mobile')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('ExpectedSalary')
                    ->label('Expected Salary')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('ExperienceInYears')
                    ->label('Experience In Years')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('HighestQualificationHeld')
                    ->label('Highest Qualification Held')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('CurrentEmployer')
                    ->label('Current Employer Company Name')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('CurrentJobTitle')
                    ->label('Current Job Title')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('CurrentSalary')
                    ->label('Current Salary')
                    ->money(config('recruit.currency_field'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('Street')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('City')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('Country')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('ZipCode')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('State')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\AttachmentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobCandidates::route('/'),
            'create' => Pages\CreateJobCandidates::route('/create'),
            'view' => Pages\ViewJobCandidates::route('/{record}'),
            'edit' => Pages\EditJobCandidates::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
