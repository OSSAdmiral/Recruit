<?php

namespace App\Filament\Enums;

use App\Traits\EnumToArray;
use Filament\Support\Contracts\HasLabel;

enum JobOpeningStatus: string implements HasLabel
{
    use EnumToArray;

    case New = 'New';
    case Opened = 'Opened';
    case Closed = 'Closed';

    public function getLabel(): ?string
    {
        return $this->value;
    }
}
