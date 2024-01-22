<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CandidatesProfileResource\Pages;
use App\Filament\Resources\CandidatesProfileResource\RelationManagers;
use App\Models\Candidates;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;

class CandidatesProfileResource extends Resource
{
    protected static ?string $model = Candidates::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'full_name';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(array_merge(
                self::standardBasicInformationFormLayout(),
                self::standardSkillSetFormLayout(),
                self::standardCurrentJobInformationFormLayout(),
                self::standardAddressInformationFormLayout(),
                self::standardSchoolInformationFormLayout(),
                self::standardCandidatesExperienceFormLayout(),
                self::standardAdditionalInformationFormLayout(),
                []
            ));
    }

    private static function standardSchoolInformationFormLayout(): array
    {
        return [
            Forms\Components\Section::make('Candidate Degree Information')
                ->schema([
                    Forms\Components\Repeater::make('School')
                        ->label('')
                        ->addActionLabel('Add Degree Information')
                        ->schema([
                            Forms\Components\TextInput::make('school_name')
                                ->required(),
                            Forms\Components\TextInput::make('major')
                                ->required(),
                            Forms\Components\Select::make('duration')
                                ->options([
                                    '4years' => '4 Years',
                                    '5years' => '5 Years',
                                ])
                                ->required(),
                            Forms\Components\Checkbox::make('pursuing')
                                ->inline(false),
                        ])
                        ->deleteAction(
                            fn (Forms\Components\Actions\Action $action) => $action->requiresConfirmation(),
                        )
                        ->columns(4),
                ]),
        ];
    }

    private static function standardBasicInformationFormLayout(): array
    {
        return [
            Forms\Components\TextInput::make('CandidateId')
                ->readOnly()
                ->disabled()
                ->visibleOn('view'),
            Forms\Components\Section::make('Candidate Basic Information')
                ->schema([
                    Forms\Components\TextInput::make('FirstName')
                        ->label('First Name'),
                    Forms\Components\TextInput::make('LastName')
                        ->label('Last Name'),
                    Forms\Components\TextInput::make('Mobile')
                        ->label('Mobile')
                        ->tel(),
                    Forms\Components\TextInput::make('email')
                        ->required(),
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
                ])->columns(2),

        ];

    }

    public static function standardSkillSetFormLayout(): array
    {
        return [
            Forms\Components\Section::make('Candidate Skill Set Information')
                ->schema([
                    Forms\Components\Repeater::make('SkillSet')
                        ->label('')
                        ->addActionLabel('Add Another Skill Set')
                        ->columns(4)
                        ->schema([
                            Forms\Components\TextInput::make('skill')
                                ->label('Skill'),
                            Forms\Components\Select::make('proficiency')
                                ->options([
                                    'Master' => 'Master',
                                    'Intermediate' => 'Intermediate',
                                    'Beginner' => 'Beginner',
                                ])
                                ->label('Proficiency'),
                            Forms\Components\Select::make('experience')
                                ->options([
                                    '1year' => '1year',
                                    '2year' => '2 Years',
                                    '3year' => '3 Years',
                                    '4year' => '4 Years',
                                    '5year' => '5 Years',
                                    '6year' => '6 Years',
                                    '7year' => '7 Years',
                                    '8year' => '8 Years',
                                    '9year' => '9 Years',
                                    '10year+' => '10 Years & Above',
                                ])
                                ->label('Experience'),
                            Forms\Components\Select::make('last_used')
                                ->options(function () {
                                    $lastUsedOptions = [];
                                    $counter = 30;
                                    for ($i = $counter; $i >= 0; $i--) {
                                        $lastUsedOptions[
                                        sprintf('%s', Carbon::now()->subYear($i)->year)
                                            ] =
                                            sprintf('%s', Carbon::now()->subYear($i)->year);
                                    }

                                    return $lastUsedOptions;
                                })
                                ->label('Last Used'),

                        ]),
                ]),

        ];

    }

    public static function standardCurrentJobInformationFormLayout(): array
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

    public static function standardAddressInformationFormLayout(): array
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

    public static function standardCandidatesExperienceFormLayout(): array
    {
        return [
            Forms\Components\Section::make('Candidate Experience Information')
                ->schema([
                    Forms\Components\Repeater::make('ExperienceDetails')
                        ->label('')
                        ->addActionLabel('Add Experience Details')
                        ->schema([
                            Forms\Components\Checkbox::make('current')
                                ->label('Current?')
                                ->inline(false),
                            Forms\Components\TextInput::make('company_name'),
                            Forms\Components\TextInput::make('duration'),
                            Forms\Components\TextInput::make('role'),
                            Forms\Components\Textarea::make('company_address'),
                        ])
                        ->deleteAction(
                            fn (Forms\Components\Actions\Action $action) => $action->requiresConfirmation(),
                        )
                        ->columns(5),
                ]),
        ];
    }

    public static function standardAdditionalInformationFormLayout(): array
    {
        return [
            Forms\Components\Section::make('Additional Information')
                ->schema([
                    Forms\Components\Textarea::make('AdditionalInformation')
                        ->label(''),
                ]),

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
            RelationManagers\AttachmentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCandidatesProfiles::route('/'),
            'create' => Pages\CreateCandidatesProfile::route('/create'),
            'view' => Pages\ViewCandidatesProfile::route('/{record}'),
            'edit' => Pages\EditCandidatesProfile::route('/{record}/edit'),
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
