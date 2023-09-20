<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Collection;

class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.settings';

    protected static bool $shouldRegisterNavigation = false;

    public ?Collection $tabsComponents;

    public function mount()
    {
        $this->tabsComponents = $this->getTabComponents();
    }

    public function getTabComponents(): \Illuminate\Support\Collection
    {
        return collect([

        ]);
    }
}
