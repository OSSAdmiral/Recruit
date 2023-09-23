<?php

namespace App\Filament\Enums;

use Filament\Support\Contracts\HasLabel;

enum JobOpeningStatus: string implements HasLabel
{
    case New = 'New';
    case Opened = 'Opened';
    case Closed = 'Closed';

    public function getLabel(): ?string
    {
        return $this->name;
    }

}
