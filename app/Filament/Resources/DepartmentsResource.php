<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepartmentsResource\Pages;
use App\Filament\Resources\DepartmentsResource\RelationManagers;
use App\Models\Departments;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DepartmentsResource extends Resource
{
    protected static ?string $model = Departments::class;

    protected static ?int $navigationSort = 4;

    protected static ?string $recordTitleAttribute = 'DepartmentName';

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Department Information')
                    ->id('department-information')
                    ->icon('lucide-building-2')
                    ->schema([
                        Forms\Components\TextInput::make('DepartmentName')
                            ->required(),
                        Forms\Components\Select::make('ParentDepartment')
                            ->options(Departments::all()->pluck('DepartmentName', 'id'))
                            ->nullable(),
                    ]),
                Forms\Components\Section::make('System Information')
                    ->hiddenOn('create')
                    ->id('job-opening-system-info')
                    ->icon('heroicon-o-computer-desktop')
                    ->label('System Information')
                    ->schema([
                        Forms\Components\TextInput::make('CreatedBy'),
                        Forms\Components\TextInput::make('ModifiedBy'),
                        Forms\Components\DateTimePicker::make('created_at')
                            ->label('Created Date'),
                        Forms\Components\DateTimePicker::make('updated_at')
                            ->label('Last Modified Date'),
                    ])->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('DepartmentName')
                    ->label('Department Name'),
                Tables\Columns\TextColumn::make('creator.name')
                    ->label('Parent Department'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListDepartments::route('/'),
            'create' => Pages\CreateDepartments::route('/create'),
            'view' => Pages\ViewDepartments::route('/{record}'),
            'edit' => Pages\EditDepartments::route('/{record}/edit'),
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
