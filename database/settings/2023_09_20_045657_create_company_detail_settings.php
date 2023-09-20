<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('company.site_name', 'RecruitLab');
        $this->migrator->add('company.company_name', 'RecruitLab');
        $this->migrator->add('company.company_website', 'www.recruitlab.com');
        $this->migrator->add('company.company_primary_contact_email', 'help@recruitlab.com');
        $this->migrator->add('company.company_employee_count', 2);
        $this->migrator->add('company.company_country', 'Philippines');
        $this->migrator->add('company.company_state', 'Leyte');
        $this->migrator->add('company.company_city', 'Tacloban');

    }
};
