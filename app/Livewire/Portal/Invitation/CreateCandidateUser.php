<?php

namespace App\Livewire\Portal\Invitation;

use App\Models\candidatePortalInvitation;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Pages\SimplePage;
use Illuminate\Http\Request;
use Phpsa\FilamentPasswordReveal\Password;

class CreateCandidateUser extends SimplePage
{
    use InteractsWithActions;
    use InteractsWithFormActions;
    use InteractsWithForms;

    public candidatePortalInvitation $candidatePortalInvitation;

    protected ?string $subheading = 'Candidate Portal Invitation - Verify and create account.';

    protected static ?string $title = 'Candidate Portal Invitation';

    protected ?string $heading = '';

    public ?array $data = [];

    public static string $view = 'livewire.portal.invitation.create-candidate-user';

    public function mount(Request $request, candidatePortalInvitation $id): void
    {
        if (! $request->hasValidSignature()) {
            abort(403, 'Invalid Signature');
        }

        $this->candidatePortalInvitation = $id;

        $this->data = [...$this->candidatePortalInvitation->toArray()];

    }

    public function create(): void
    {
        $this->form->getState();

    }

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->disabled(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->label('Email')
                    ->disabled(),
                Password::make('password')
                    ->minLength(5)
                    ->confirmed()
                    ->label('Password'),
                Password::make('password_confirmation')
                    ->minLength(5)
                    ->label('Confirm Password'),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            $this->getAuthenticateFormAction(),
        ];
    }

    protected function getAuthenticateFormAction(): Action
    {
        return Action::make('authenticate')
            ->label('Create Account')
            ->submit('create');
    }

    protected function hasFullWidthFormActions(): bool
    {
        return true;
    }
}
