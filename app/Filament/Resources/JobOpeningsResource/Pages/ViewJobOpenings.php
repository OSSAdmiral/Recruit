<?php

namespace App\Filament\Resources\JobOpeningsResource\Pages;

use App\Filament\Resources\JobOpeningsResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewJobOpenings extends ViewRecord
{
    protected static string $resource = JobOpeningsResource::class;

    protected function getActions(): array
    {
        return [
            DeleteAction::make(),
            EditAction::make(),
        ];
    }
}
