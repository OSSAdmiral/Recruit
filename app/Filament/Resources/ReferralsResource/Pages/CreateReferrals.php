<?php

namespace App\Filament\Resources\ReferralsResource\Pages;

use App\Filament\Resources\ReferralsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateReferrals extends CreateRecord
{
    protected static string $resource = ReferralsResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['ReferredBy'] = auth()->id();

        return $data;
    }
}
