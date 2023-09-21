<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Security & Control';

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(3)
            ->schema([
                Forms\Components\Grid::make()
                    ->columns(1)
                    ->schema([
                    Forms\Components\FileUpload::make('profile_photo_path')
                        ->label('')
                        ->alignCenter()
                        ->avatar()
                        ->visibility('public')
                        ->directory('profile-avatar')
                        ->disk(config('filament.default_filesystem_disk'))
                        ->image(),
                ]),
                Forms\Components\Section::make()
                    ->columns(2)
                    ->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->placeholder('John Doe'),
                    Forms\Components\TextInput::make('email')
                        ->required()
                        ->email(),
                    Forms\Components\TextInput::make('password')
                        ->required()
                        ->confirmed()
                        ->password(),
                    Forms\Components\TextInput::make('password_confirmation')
                        ->required()
                        ->password(),
                ])
                    ->columnSpan(['lg' => fn (?User $record) => $record === null ? 3 : 2]),

                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(fn (User $record): ?string => $record->created_at?->diffForHumans()),

                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Last modified at')
                            ->content(fn (User $record): ?string => $record->updated_at?->diffForHumans()),
                    ])
                    ->columnSpan(['lg' => 1])
                    ->hidden(fn (?User $record) => $record === null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
               Tables\Columns\ImageColumn::make('profile_photo_path')
                   ->label('Profile Photo')
                   ->defaultImageUrl(function (Model $record){
                       return $record->profile_photo_url;
                   })
                   ->circular(),
               Tables\Columns\TextColumn::make('name')
                   ->searchable()
                   ->sortable(),
               Tables\Columns\TextColumn::make('email')
                   ->sortable()
                   ->searchable(),
               Tables\Columns\IconColumn::make('email_verified_at')
                   ->trueIcon('heroicon-o-check-badge')
                   ->falseIcon('heroicon-o-x-mark')
                   ->boolean()
                   ->label('Verified Email'),
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
            ]);
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email'];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
//            ->where('id', '!=', auth()->user()->id)
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
