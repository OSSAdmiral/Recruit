<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobOpeningsResource\Pages;
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
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use function Laravel\Prompts\confirm;

class JobOpeningsResource extends Resource
{
    protected static ?string $model = JobOpenings::class;

    protected static ?string $slug = 'job-openings';

    protected static ?string $recordTitleAttribute = 'postingTitle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('job-opening-information-section')
                ->label('Job Opening Information')
                ->icon('heroicon-o-briefcase')
                ->schema([
                    TextInput::make('postingTitle')
                        ->length(225)
                        ->required(),
                    TextInput::make('NumberOfPosition')
                        ->numeric()
                        ->required(),
                    TextInput::make('JobTitle')
                        ->length(225)
                        ->required(),
                    TextInput::make('JobOpeningSystemID'),
                    DatePicker::make('TargetDate')
                        ->format('d/m/Y')
                        ->native(false)
                        ->displayFormat('m/d/Y')
                        ->required(),
                    Select::make('Status')
                        ->options(config('recruit.job_opening.status_options'))
                        ->hiddenOn('create')
                        ->default('New')
                        ->required(),
                    TextInput::make('Salary'),
                    Select::make('Department')
                        ->options(config('recruit.job_opening.departments'))
                        ->required(),
                    Select::make('HiringManager')
                        ->options(User::class),
                    Select::make('AssignedRecruiters')
                        ->options(User::class),
                    DatePicker::make('DateOpened')
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
                        ->default(false),
                ])->columns(2),
                Section::make('job-opening-address-information-section')
                ->id('job-opening-address-information-section')
                ->label('Address Information')
                ->schema([
                    TextInput::make('City')
                        ->required(),
                    TextInput::make('Country')
                        ->required(),
                    TextInput::make('State')
                        ->required(),
                    TextInput::make('ZipCode')
                        ->required(),
                ])->columns(2),
                Section::make('job-opening-description-information')
                ->id('job-opening-description-information')
                ->label('Description Information')
                ->schema([
                    RichEditor::make('JobDescription')
                        ->required(),
                    RichEditor::make('JobRequirement')
                        ->required(),
                    RichEditor::make('JobBenefits')
                        ->required(),
                ])->columns(1),
                Section::make('job-opening-system-info')
                ->id('job-opening-system-info')
                ->label('System Information')
                ->schema([
                    TextEntry::make('CreatedBy'),
                    TextEntry::make('ModifiedBy'),
                    TextEntry::make('created_at')
                        ->label('Created Date'),
                    TextEntry::make('updated_at')
                        ->label('Last Modified Date')
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('postingTitle'),
                TextColumn::make('NumberOfPosition'),
                TextColumn::make('JobTitle'),
                TextColumn::make('JobOpeningSystemID'),
                TextColumn::make('TargetDate'),
                TextColumn::make('Status'),
                TextColumn::make('Industry'),
                TextColumn::make('Salary'),
                TextColumn::make('Department'),
                TextColumn::make('HiringManager'),
                TextColumn::make('AssignedRecruiters'),
                TextColumn::make('DateOpened'),
                TextColumn::make('JobType'),
                TextColumn::make('RequiredSkill'),
                TextColumn::make('WorkExperience'),
                TextColumn::make('JobDescription'),
                TextColumn::make('City'),
                TextColumn::make('Country'),
                TextColumn::make('State'),
                TextColumn::make('ZipCode'),
                TextColumn::make('RemoteJob'),
                TextColumn::make('CreatedBy'),
                TextColumn::make('ModifiedBy'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobOpenings::route('/'),
            'create' => Pages\CreateJobOpenings::route('/create'),
            'edit' => Pages\EditJobOpenings::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [];
    }
}
