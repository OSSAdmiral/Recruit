<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobOpeningsResource\Pages;
use App\Models\JobOpenings;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class JobOpeningsResource extends Resource
{
    protected static ?string $model = JobOpenings::class;

    protected static ?string $slug = 'job-openings';

    protected static ?string $recordTitleAttribute = 'postingTitle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('postingTitle')
                    ->required(),
                TextInput::make('NumberOfPosition')
                    ->required(),
                TextInput::make('JobTitle')
                    ->required(),
                TextInput::make('JobOpeningSystemID'),
                TextInput::make('TargetDate')
                    ->required(),
                TextInput::make('Status')
                    ->required(),
                TextInput::make('Salary'),
                TextInput::make('Department')
                    ->required(),
                TextInput::make('HiringManager'),
                TextInput::make('AssignedRecruiters'),
                TextInput::make('DateOpened')
                    ->required(),
                TextInput::make('JobType')
                    ->required(),
                TextInput::make('RequiredSkill')
                    ->required(),
                TextInput::make('WorkExperience')
                    ->required(),
                TextInput::make('JobDescription')
                    ->required(),
                TextInput::make('City')
                    ->required(),
                TextInput::make('Country')
                    ->required(),
                TextInput::make('State')
                    ->required(),
                TextInput::make('ZipCode')
                    ->required(),
                Checkbox::make('RemoteJob'),
                TextInput::make('CreatedBy')
                    ->required(),
                TextInput::make('ModifiedBy')
                    ->required(),
                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn (?JobOpenings $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn (?JobOpenings $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ])->columns(2);
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
