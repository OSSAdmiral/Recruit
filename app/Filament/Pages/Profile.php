<?php

namespace App\Filament\Pages;

use App\Livewire\User\LogoutOtherBrowserSessionForm;
use App\Livewire\User\UpdatePasswordForm;
use App\Livewire\User\UpdateProfileInformationForm;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class Profile extends Page
{
    protected static string $view = 'filament.pages.profile';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Profile';

    public ?array $userComponents = [];

    public function mount()
    {
        $this->userComponents = $this->getUserComponents();
    }

    public function getUserComponents(): array
    {
        return [
            UpdateProfileInformationForm::class,
            UpdatePasswordForm::class,
            LogoutOtherBrowserSessionForm::class,
        ];
    }

    protected function getViewData(): array
    {
        return [
            'user' => Auth::user(),
            'components' => $this->userComponents,
        ];
    }
}
