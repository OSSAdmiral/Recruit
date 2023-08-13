<?php

namespace App\Filament\Resources;

use App\Filament\Enums\JobCandidateStatus;
use App\Filament\Resources\JobCandidatesResource\Pages;
use App\Filament\Resources\JobCandidatesResource\RelationManagers;
use App\Models\Candidates;
use App\Models\JobCandidates;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JobCandidatesResource extends Resource
{
    protected static ?string $model = JobCandidates::class;

    protected static ?string $recordTitleAttribute = 'postingTitle';

    protected static ?int $navigationSort = 1;

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
                    Forms\Components\Select::make('CandidateStatus')
                        ->options(JobCandidateStatus::class)
                        ->required(),
                    Forms\Components\TextInput::make('CandidateSource')
                        ->nullable('')
                        ->default('web'),
                    Forms\Components\Select::make('CandidateOwner')
                        ->options(User::all()->pluck('name', 'id'))
                        ->nullable()
                ])->columns(2)
        ];
    }

    public static function candidateBasicInformationFormLayout(): array
    {
        return  [
            Forms\Components\TextInput::make('JobCandidateId')
                ->visibleOn('view')
                ->readOnly()
                ->disabled(),
            Forms\Components\Section::make('Candidate Basic Information')
                ->schema([
                    Forms\Components\Select::make('candidate')
                        ->options(Candidates::all()->pluck('FullName', 'id'))
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
                        ->mask(RawJs::make(<<<'JS'
                                $money($input, '.',',')
                                JS))
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
                ])->columns(2)
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
                        ->label('Current Salary')
                        ->mask(RawJs::make(<<<'JS'
                                $money($input, '.',',')
                                JS)),
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
                //
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            //
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
