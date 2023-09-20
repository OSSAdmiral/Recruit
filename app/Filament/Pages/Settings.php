<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.settings';

    protected static bool $shouldRegisterNavigation = false;

    protected ?string $subheading = 'Customize setup';
}
