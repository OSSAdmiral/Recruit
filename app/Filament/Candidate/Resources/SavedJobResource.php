<?php

namespace App\Filament\Candidate\Resources;

use App\Filament\Candidate\Resources\SavedJobResource\Pages;
use App\Models\SavedJob;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SavedJobResource extends Resource
{
    protected static ?string $model = SavedJob::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';

    protected static ?int $navigationSort = 3;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count() > 0 ? static::getModel()::count() : '';
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 0 ? 'success' : '';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                /*Forms\Components\TextInput::make('JobTitle')
                    ->rela
                    ->label('Job Title')
                    ->maxLength(225)
                    ->required(),
                Forms\Components\TextInput::make('Salary')
                    ->label('Salary'),
                Forms\Components\Checkbox::make('RemoteJob')
                    ->label('Remote')
                    ->inline(false)
                    ->default(false),
                Forms\Components\Section::make('Description Information')
                    ->id('job-opening-description-information')
                    ->icon('heroicon-o-briefcase')
                    ->label('Description Information')
                    ->schema([
                        Forms\Components\RichEditor::make('JobDescription')
                            ->label('Job Description'),
                        Forms\Components\RichEditor::make('JobRequirement')
                            ->label('Requirements'),
                        Forms\Components\RichEditor::make('JobBenefits')
                            ->label('Benefits'),
                    ]),*/
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('jobOpening.JobTitle')
                    ->searchable()
                    ->label('Job Title'),
                Tables\Columns\TextColumn::make('jobOpening.Salary')
                    ->label('Salary'),
                Tables\Columns\IconColumn::make('jobOpening.RemoteJob')
                    ->label('Remote')
                    ->searchable()
                    ->boolean(),
                Tables\Columns\TextColumn::make('jobOpening.JobType')
                    ->toggleable()
                    ->searchable()
                    ->label('Type'),
                Tables\Columns\TextColumn::make('jobOpening.JobDescription')
                    ->toggleable()
                    ->label('Description')
                    ->limit(length: 50),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->url(fn (SavedJob $record) => JobOpeningsResource::getUrl('view', ['record' => $record->jobOpening()->find($record->job)])),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSavedJobs::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('record_owner', '=', auth()->id());

    }
}
