<?php

namespace App\Filament\Resources\JobOpeningsResource\Pages;

use App\Filament\Resources\JobOpeningsResource;
use Filament\Resources\Pages\CreateRecord;

class CreateJobOpenings extends CreateRecord
{
    protected static string $resource = JobOpeningsResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['Status'] = 'New';

        return $data;
    }
}
