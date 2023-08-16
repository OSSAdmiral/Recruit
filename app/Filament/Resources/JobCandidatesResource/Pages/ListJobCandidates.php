<?php

namespace App\Filament\Resources\JobCandidatesResource\Pages;

use App\Filament\Resources\JobCandidatesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJobCandidates extends ListRecords
{
    protected static string $resource = JobCandidatesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
