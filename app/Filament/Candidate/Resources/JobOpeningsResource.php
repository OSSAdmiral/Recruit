<?php

namespace App\Filament\Candidate\Resources;

use App\Filament\Candidate\Resources\JobOpeningsResource\Pages;
use App\Models\JobOpenings;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class JobOpeningsResource extends Resource
{
    protected static ?string $model = JobOpenings::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
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
                    ->limit(),
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
            'create' => Pages\CreateJobOpenings::route('/create'),
            'view' => Pages\ViewJobOpenings::route('/{record}'),
            'edit' => Pages\EditJobOpenings::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->jobStillOpen()
            ->where('published_career_site', '=', 1);
    }
}
