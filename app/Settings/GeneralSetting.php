<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSetting extends Settings
{
    public ?string $site_name;

    public ?string $company_name;

    public ?string $company_website;

    public ?string $company_primary_contact_email;

    public ?int $company_employee_count;

    public ?string $company_country;

    public ?string $company_state;

    public ?string $company_city;

    public static function group(): string
    {
        return 'company';
    }
}
