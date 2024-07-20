<?php

namespace App\Providers\Filament;

use App\Filament\Candidate\Pages\Account;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class CandidatePanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('candidate')
            ->path('portal/candidate')
            ->authGuard('candidate_web')
            ->authPasswordBroker('candidate_users')
            ->passwordReset()
            ->emailVerification()
            ->login()
            ->maxContentWidth('full')
            ->colors([
                'primary' => Color::Gray,
            ])
            ->userMenuItems([
                Navigation\MenuItem::make()
                    ->label('Account')
                    ->url(fn (): string => Account::getUrl())
                    ->icon('heroicon-o-user'),
            ])
            ->favicon(asset('favicon.png'))
            ->discoverResources(in: app_path('Filament/Candidate/Resources'), for: 'App\\Filament\\Candidate\\Resources')
            ->discoverPages(in: app_path('Filament/Candidate/Pages'), for: 'App\\Filament\\Candidate\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Candidate/Widgets'), for: 'App\\Filament\\Candidate\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->spa();
    }
}
