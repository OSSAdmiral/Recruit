<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobOpeningsResource\Pages;
use App\Models\Departments;
use App\Models\JobOpenings;
use App\Models\User;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables;
use function Laravel\Prompts\confirm;

class JobOpeningsResource extends Resource
{
    protected static ?string $model = JobOpenings::class;

    protected static ?string $slug = 'job-openings';

    protected static ?string $recordTitleAttribute = 'postingTitle';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Job Opening Information')
                ->icon('heroicon-o-briefcase')
                ->schema([
                    TextInput::make('postingTitle')
                        ->maxLength(225)
                        ->required(),
                    TextInput::make('NumberOfPosition')
                        ->numeric()
                        ->required(),
                    TextInput::make('JobTitle')
                        ->maxLength(225)
                        ->required(),
                    TextInput::make('JobOpeningSystemID')
                        ->label('Job Opening Unique Key ID')
                        ->readOnly()
                        ->hiddenOn('create'),
                    DatePicker::make('TargetDate')
                        ->label('Target Date')
                        ->format('d/m/Y')
                        ->native(false)
                        ->displayFormat('m/d/Y')
                        ->required(),
                    Select::make('Status')
                        ->options(config('recruit.job_opening.status_options'))
                        ->hiddenOn('create')
                        ->native(false)
                        ->default('new')
                        ->required(),
                    TextInput::make('Salary')
                        ->numeric(),
                    Select::make('Department')
                        ->options(Departments::all()->pluck('DepartmentName', 'id'))
                        ->required(),
                    Select::make('HiringManager')
                        ->options(User::all()->pluck('name', 'id')),
                    Select::make('AssignedRecruiters')
                        ->options(User::all()->pluck('name', 'id')),
                    DatePicker::make('DateOpened')
                        ->label('Date Opened')
                        ->format('d/m/Y')
                        ->native(false)
                        ->displayFormat('m/d/Y')
                        ->required(),
                    Select::make('JobType')
                        ->options(config('recruit.job_opening.job_type_options'))
                        ->required(),
                    Select::make('RequiredSkill')
                        ->multiple()
                        ->options(config('recruit.job_opening.required_skill_options'))
                        ->required(),
                    Select::make('WorkExperience')
                        ->options(config('recruit.job_opening.work_experience'))
                        ->required(),
                    Checkbox::make('RemoteJob')
                        ->inline(false)
                        ->default(false),
                ])->columns(2),
                Section::make('Address Information')
                ->id('job-opening-address-information-section')
                ->icon('heroicon-o-map')
                ->schema([
                    TextInput::make('City')
                        ->required(),
                    TextInput::make('Country')
                        ->required(),
                    TextInput::make('State')
                        ->label('State/Province')
                        ->required(),
                    TextInput::make('ZipCode')
                        ->label('Zip/Postal Code')
                        ->required(),
                ])->columns(2),
                Section::make('Description Information')
                ->id('job-opening-description-information')
                ->icon('heroicon-o-briefcase')
                ->label('Description Information')
                ->schema([
                    RichEditor::make('JobDescription')
                        ->label('Job Description')
                        ->required(),
                    RichEditor::make('JobRequirement')
                        ->label('Requirements')
                        ->required(),
                    RichEditor::make('JobBenefits')
                        ->label('Benefits')
                        ->required(),
                ])->columns(1),
                Section::make('System Information')
                ->hiddenOn('create')
                ->id('job-opening-system-info')
                ->icon('heroicon-o-computer-desktop')
                ->label('System Information')
                ->schema([
                    TextInput::make('CreatedBy'),
                    TextInput::make('ModifiedBy'),
                    TextInput::make('created_at')
                        ->label('Created Date'),
                    TextInput::make('updated_at')
                        ->label('Last Modified Date')
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('postingTitle')
                    ->label('Job Opening Title'),
                TextColumn::make('NumberOfPosition')
                    ->label('Number Of Vacancy'),
                TextColumn::make('TargetDate')
                    ->label('Job Opening Target Date'),
                TextColumn::make('DateOpened')
                    ->label('Job Opening Date Opened'),
                TextColumn::make('JobType')
                    ->label('Job Type'),
                IconColumn::make('RemoteJob')
                    ->label('Remote')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-badge'),
            ])->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobOpenings::route('/'),
            'create' => Pages\CreateJobOpenings::route('/create'),
            'view' => Pages\ViewJobOpenings::route('/{record}'),
            'edit' => Pages\EditJobOpenings::route('/{record}/edit')
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [];
    }
}
