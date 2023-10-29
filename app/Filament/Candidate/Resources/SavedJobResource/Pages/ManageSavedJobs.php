<?php

namespace App\Filament\Candidate\Resources\SavedJobResource\Pages;

use App\Filament\Candidate\Resources\SavedJobResource;
use Filament\Resources\Pages\ManageRecords;

class ManageSavedJobs extends ManageRecords
{
    protected static string $resource = SavedJobResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
