<?php

namespace App\Filament\Candidate\Pages;

use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Pages\Page;

class MyResumeProfile extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected ?string $subheading = 'This profile will be used once you apply a job in the portal.';

    protected static ?int $navigationSort = 3;

    protected static string $view = 'filament.candidate.pages.my-resume-profile';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Label')
                    ->tabs([
                        Tabs\Tab::make('Basic Information')
                            ->icon('heroicon-o-user')
                            ->schema([
                                // ...
                            ]),
                        Tabs\Tab::make('Experience Information')
                            ->icon('phosphor-stack-overflow-logo')
                            ->schema([
                                // ...
                            ]),
                        Tabs\Tab::make('Skill Set Information')
                            ->icon('gameicon-skills')
                            ->schema([
                                // ...
                            ]),
                        Tabs\Tab::make('Current Job Information')
                            ->icon('heroicon-o-briefcase')
                            ->schema([
                                // ...
                            ]),
                        Tabs\Tab::make('Address Information')
                            ->icon('heroicon-o-map-pin')
                            ->schema([
                                // ...
                            ]),
                        Tabs\Tab::make('Academic Information')
                            ->icon('heroicon-o-academic-cap')
                            ->schema([
                                // ...
                            ]),

                    ]),
            ])
            ->statePath('data');
    }
}
