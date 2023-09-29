<?php

namespace App\Filament\Candidate\Resources\JobOpeningsResource\Pages;

use App\Filament\Candidate\Resources\JobOpeningsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewJobOpenings extends ViewRecord
{
    protected static string $resource = JobOpeningsResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
