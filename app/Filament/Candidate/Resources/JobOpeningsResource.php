<?php

namespace App\Filament\Candidate\Resources;

use App\Filament\Candidate\Resources\JobOpeningsResource\Pages;
use App\Models\JobOpenings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class JobOpeningsResource extends Resource
{
    protected static ?string $model = JobOpenings::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?int $navigationSort = 1;

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
                Forms\Components\TextInput::make('JobTitle')
                    ->maxLength(225)
                    ->required(),
                Forms\Components\TextInput::make('Salary'),
                Forms\Components\Checkbox::make('RemoteJob')
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
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('JobTitle')
                    ->searchable()
                    ->label('Job Title'),
                Tables\Columns\TextColumn::make('Salary')
                    ->label('Salary'),
                Tables\Columns\IconColumn::make('RemoteJob')
                    ->searchable()
                    ->boolean(),
                Tables\Columns\TextColumn::make('JobType')
                    ->label('Type'),
                Tables\Columns\TextColumn::make('JobDescription')
                    ->label('Description')
                    ->limit(length: 50),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ], position: Tables\Enums\ActionsPosition::BeforeCells);
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
            'index' => Pages\ListJobOpenings::route('/'),
            'view' => Pages\ViewJobOpenings::route('/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->jobStillOpen()
            ->where('published_career_site', '=', 1);
    }
}
