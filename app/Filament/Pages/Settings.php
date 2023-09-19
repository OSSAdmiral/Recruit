<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.settings-modals';

    protected static bool $shouldRegisterNavigation = false;

    public ?array $tabsComponents = [];

    public function mount()
    {
        $this->tabsComponents = $this->getTabComponents();
    }

    public function getTabComponents(): array
    {
        return [
          [
              'tab_name' => 'Company Details',
              'icon' => 'healthicons-o-ui-preferences',
              'components' => '',
          ]
        ];
    }
}
