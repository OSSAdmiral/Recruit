<?php

namespace App\Filament\Enums;

use Filament\Support\Contracts\HasLabel;

enum JobCandidateStatus: string implements HasLabel
{
    case Associated = 'associated';
    case Reviewing = 'reviewing';
    case Published = 'published';
    case Rejected = 'rejected';

    public function getLabel(): ?string
    {
        return $this->name;
    }
}
