<?php

namespace App\Filament\Candidate\Resources\JobOpeningsResource\Pages;

use App\Filament\Candidate\Resources\JobOpeningsResource;
use Filament\Resources\Pages\ListRecords;

class ListJobOpenings extends ListRecords
{
    protected static string $resource = JobOpeningsResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
