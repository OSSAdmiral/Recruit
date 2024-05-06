<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class JobOpeningSettings extends Settings
{
    public array $requiredSkills;

    public static function group(): string
    {
        return 'job_opening_settings';
    }
}
