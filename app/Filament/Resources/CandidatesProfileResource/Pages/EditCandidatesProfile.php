<?php

namespace App\Filament\Resources\CandidatesProfileResource\Pages;

use App\Filament\Resources\CandidatesProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCandidatesProfile extends EditRecord
{
    protected static string $resource = CandidatesProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
