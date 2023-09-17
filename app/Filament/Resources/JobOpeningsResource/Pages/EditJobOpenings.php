<?php

namespace App\Filament\Resources\JobOpeningsResource\Pages;

use App\Filament\Resources\JobOpeningsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditJobOpenings extends EditRecord
{
    protected static string $resource = JobOpeningsResource::class;

    protected function getActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('view', ['record' => $this->getRecord()]);
    }

    public function getRelationManagers(): array
    {
        return [];
    }
}
