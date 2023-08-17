<?php

namespace App\Filament\Resources\JobCandidatesResource\RelationManagers;

use App\Filament\Enums\AttachmentCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class AttachmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'attachments';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('attachment')
                    ->preserveFilenames()
                    ->storeFileNamesIn('attachmentName')
                    ->directory('JobOpening-attachments')
                    ->visibility('private')
                    ->openable()
                    ->downloadable()
                    ->previewable()
                    ->acceptedFileTypes([
                        'application/pdf',
                        'image/jpeg',
                        'image/png',
                    ])
                    ->disabledOn('edit')
                    ->required(),
                Forms\Components\TextInput::make('attachmentName')
                    ->disabledOn('edit')
                    ->hidden()
                    ->maxLength(255),
                Forms\Components\Select::make('category')
                    ->options(AttachmentCategory::class)
                    ->required(),
                Forms\Components\TextInput::make('attachmentOwner')
                    ->readOnly()
                    ->default(fn ($livewire) => $livewire->ownerRecord->id)
                    ->required()
                    ->hidden()
                    ->maxLength(255),
                Forms\Components\TextInput::make('moduleName')
                    ->readOnly()
                    ->default('JobCandidates')
                    ->hidden()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('attachmentName')
            ->columns([
                Tables\Columns\TextColumn::make('attachmentName'),
                Tables\Columns\TextColumn::make('category'),
                Tables\Columns\TextColumn::make('created_at'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
}
