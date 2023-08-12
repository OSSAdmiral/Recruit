<?php

namespace App\Filament\Resources\CandidatesProfileResource\Pages;

use App\Filament\Resources\CandidatesProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCandidatesProfiles extends ListRecords
{
    protected static string $resource = CandidatesProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
