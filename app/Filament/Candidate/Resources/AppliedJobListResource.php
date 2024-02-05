<?php

namespace App\Filament\Candidate\Resources;

use App\Filament\Candidate\Resources\AppliedJobListResource\Pages;
use App\Filament\Enums\JobCandidateStatus;
use App\Models\JobCandidates;
use Filament\Facades\Filament;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AppliedJobListResource extends Resource
{
    protected static ?string $model = JobCandidates::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'My Applied Jobs';

    protected static ?string $modelLabel = 'Applied Job';

    protected static ?string $pluralModelLabel = 'Applied Jobs';

    protected static ?int $navigationSort = 2;

    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::where('Email', '=', Filament::auth()->user()->email)->count();

        return $count > 0 ? $count : '';
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::where('Email', '=', Filament::auth()->user()->email)->count() > 0 ? 'success' : '';
    }

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
            ->striped()
            ->columns([
                Tables\Columns\TextColumn::make('JobCandidateId')
                    ->label('Job Candidate Number'),
                Tables\Columns\TextColumn::make('job.postingTitle')
                    ->label('Job Title'),
                Tables\Columns\BooleanColumn::make('job.RemoteJob')
                    ->label('Remote Job'),
                Tables\Columns\TextColumn::make('job.Salary')
                    ->toggleable()
                    ->label('Salary'),
                Tables\Columns\TextColumn::make('CandidateStatus')
                    ->label('Application Status'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(JobCandidateStatus::class)
                    ->attribute('CandidateStatus'),
            ])
            ->actions([
            ])
            ->emptyStateHeading('No Job Applied.')
            ->emptyStateDescription('Once you applied a job, it will appear here.')
            ->emptyStateIcon('heroicon-o-briefcase');
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('Email', '=', auth()->user()->email);
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
            'index' => Pages\ListAppliedJobLists::route('/'),
        ];
    }
}
