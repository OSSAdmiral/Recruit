<?php

namespace App\Filament\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum AttachmentCategory: string implements HasColor, HasLabel
{
    case Others = 'Others';
    case Contracts = 'Contracts';
    case Resume = 'Resume';
    case CoverLetter = 'Cover Letter';
    case Offers = 'Offers';
    case JobSummary = 'Job Summary';

    public function getLabel(): ?string
    {
        return $this->value;
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Others => 'gray',
            self::Contracts => 'warning',
            self::Resume => 'success',
            self::CoverLetter => 'green',
            self::Offers => 'blue',
            self::JobSummary => 'yellow',
        };
    }
}
