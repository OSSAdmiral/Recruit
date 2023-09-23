<?php

namespace App\Filament\Resources\JobOpeningsResource\Pages;

use App\Filament\Resources\JobOpeningsResource;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListJobOpenings extends ListRecords
{
    protected static string $resource = JobOpeningsResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make()
                ->icon('heroicon-m-plus-small'),
        ];
    }
}
