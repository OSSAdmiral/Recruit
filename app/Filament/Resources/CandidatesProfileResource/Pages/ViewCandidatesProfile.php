<?php

namespace App\Filament\Resources\CandidatesProfileResource\Pages;

use App\Filament\Resources\CandidatesProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCandidatesProfile extends ViewRecord
{
    protected static string $resource = CandidatesProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
