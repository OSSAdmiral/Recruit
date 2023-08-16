<?php

namespace App\Filament\Resources\JobCandidatesResource\Pages;

use App\Filament\Resources\JobCandidatesResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewJobCandidates extends ViewRecord
{
    protected static string $resource = JobCandidatesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
