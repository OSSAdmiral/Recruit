<?php

namespace App\Filament\Candidate\Resources\JobOpeningsResource\Pages;

use App\Filament\Candidate\Resources\JobOpeningsResource;
use Filament\Resources\Pages\EditRecord;

class EditJobOpenings extends EditRecord
{
    protected static string $resource = JobOpeningsResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
