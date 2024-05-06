<?php

namespace App\Filament\Resources;

use App\Filament\Enums\JobOpeningStatus;
use App\Filament\Resources\JobOpeningsResource\Pages;
use App\Filament\Resources\JobOpeningsResource\RelationManagers;
use App\Models\Departments;
use App\Models\JobOpenings;
use App\Models\User;
use App\Settings\JobOpeningSettings;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Collection;

class JobOpeningsResource extends Resource
{
    protected static ?string $model = JobOpenings::class;

    protected static ?string $slug = 'job-openings';

    protected static ?string $recordTitleAttribute = 'postingTitle';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static array $requiredSkills = [];

    public function mount(JobOpeningSettings $setting): void
    {
        self::$requiredSkills = $setting->requiredSkills;
        parent::mount();

    }

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
                            ->options(JobOpeningStatus::class)
                            ->hiddenOn('create')
                            ->native(false)
                            ->default('New')
                            ->required(),
                        TextInput::make('Salary'),
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
                            ->options(self::$requiredSkills)
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
                        RichEditor::make('AdditionalNotes')
                            ->hintIcon('heroicon-o-information-circle', tooltip: 'This field will display in the career job portal')
                            ->label('Additional Notes')
                            ->nullable(),
                    ])->columns(1),
                Section::make('System Information')
                    ->hiddenOn(['create', 'edit'])
                    ->id('job-opening-system-info')
                    ->icon('heroicon-o-computer-desktop')
                    ->label('System Information')
                    ->schema([
                        TextInput::make('CreatedBy'),
                        TextInput::make('ModifiedBy'),
                        TextInput::make('created_at')
                            ->label('Created Date'),
                        TextInput::make('updated_at')
                            ->label('Last Modified Date'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('postingTitle')
                    ->label('Job Title Name'),
                TextColumn::make('NumberOfPosition')
                    ->label('# of Vacancy'),
                TextColumn::make('TargetDate')
                    ->label('Target Date'),
                TextColumn::make('DateOpened')
                    ->label('Date Opened'),
                TextColumn::make('JobType')
                    ->label('Job Type'),
                IconColumn::make('RemoteJob')
                    ->label('Remote')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-badge'),
            ])->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->icon('heroicon-m-plus-small'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('unpublished')
                        ->tooltip('Unpublished this opening job in the career page')
                        ->icon('heroicon-o-arrow-uturn-left')
                        ->label('Unpublished')
                        ->requiresConfirmation()
                        ->deselectRecordsAfterCompletion()
                        ->action(function (Collection $records) {
                            foreach ($records as $record) {
                                $record->published_career_site = 0;
                                $record->save();
                            }
                            Notification::make()
                                ->body('Job Opening has been unpublished.')
                                ->success()
                                ->send();
                        }),
                    Tables\Actions\BulkAction::make('published')
                        ->label('Publish')
                        ->icon('heroicon-o-arrow-uturn-up')
                        ->tooltip('Publish this opening job to the career page')
                        ->requiresConfirmation()
                        ->deselectRecordsAfterCompletion()
                        ->action(function (Collection $records) {
                            foreach ($records as $record) {
                                $record->published_career_site = 1;
                                $record->save();
                            }
                            Notification::make()
                                ->body('Job Opening has been published.')
                                ->success()
                                ->send();
                        }),
                ])
                    ->icon('heroicon-o-globe-alt')
                    ->label('Publish/Unpublished'),
                Tables\Actions\BulkAction::make('change_status')
                    ->label('Update Status')
                    ->icon('heroicon-o-pencil-square')
                    ->requiresConfirmation()
                    ->deselectRecordsAfterCompletion()
                    ->form([
                        Select::make('Status')
                            ->options(JobOpeningStatus::class)
                            ->native(false)
                            ->required(),
                    ])
                    ->action(function (Collection $records, array $data) {
                        foreach ($records as $record) {
                            $record->Status = $data['Status'];
                            $record->save();
                        }
                        Notification::make()
                            ->body("Job Opening status has been successfully updated to {$data['Status']}.")
                            ->success()
                            ->send();
                    }),

            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobOpenings::route('/'),
            'create' => Pages\CreateJobOpenings::route('/create'),
            'view' => Pages\ViewJobOpenings::route('/{record}'),
            'edit' => Pages\EditJobOpenings::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\AttachmentsRelationManager::class,
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [];
    }
}
