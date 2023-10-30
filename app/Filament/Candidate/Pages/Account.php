<?php

namespace App\Filament\Candidate\Pages;

use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Account extends Page
{
    protected static bool $shouldRegisterNavigation = false;

    protected static string $view = 'filament.candidate.pages.accounts';

    public ?array $data = [];

    public function updateAccount(): void
    {
        $this->form->getState();

        if (filled($this->data['new_password'])) {
            auth()->user()->forceFill([
                'password' => Hash::make($this->data['new_password']),
            ])->save();
        } else {
            auth()->user()->forceFill([
                'name' => $this->data['name'],
            ])->save();
        }
        // update the session hash password; this make the user able to navigate the system without re-login after changing password.
        if (session() !== null) {
            session()->put([
                'password_hash_candidate_web' => Auth::user()?->getAuthPassword(),
            ]);
        }

    }

    public function mount()
    {
        $this->data = auth()->user()->toArray();
        $this->form->fill($this->data);
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Components\Section::make('User Info')
                ->schema([
                    Components\TextInput::make('name')
                        ->label('Name')
                        ->required(),
                    Components\TextInput::make('email')
                        ->email()
                        ->disabled()
                        ->readOnly(),
                ])->columns(2),
            Components\Section::make('Change Password')
                ->schema([
                    Components\TextInput::make('old_password')
                        ->label('Current Password')
                        ->rules(['current_password:candidate_web'])
                        ->password()
                        ->requiredWith('new_password, password_confirmation'),
                    Components\TextInput::make('new_password')
                        ->label('New Password')
                        ->password()
                        ->confirmed()
                        ->requiredWith('old_password, new_password_confirmation'),
                    Components\TextInput::make('new_password_confirmation')
                        ->label('Confirm Password')
                        ->password(),

                ]),

        ])
            ->columns(1)
            ->statePath('data');
    }
}
