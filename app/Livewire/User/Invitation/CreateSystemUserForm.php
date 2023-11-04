<?php

namespace App\Livewire\User\Invitation;

use App\Models\User;
use App\Notifications\User\WelcomeSystemUserNotification;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Exceptions\NoDefaultPanelSetException;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Pages\SimplePage;
use Filament\Support\Colors\Color;
use Illuminate\Http\Request;
use Phpsa\FilamentPasswordReveal\Password;

class CreateSystemUserForm extends SimplePage
{
    use InteractsWithActions;
    use InteractsWithFormActions;
    use InteractsWithForms;

    protected ?string $subheading = 'System User Invitation - Verify and create account.';

    protected static ?string $title = 'Recruit System Invitation';

    protected ?string $heading = '';

    public ?array $data = [];

    public ?User $user;

    public static string $view = 'livewire.user.invitation.create-system-user';

    protected static string $layout = 'components.layouts.simple';

    public function mount(Request $request, ?string $id): void
    {
        if (! $request->hasValidSignature()) {
            abort(403, 'Invalid Signature');
        }
        $this->user = User::whereInvitationId($id)->first();
        if ($this->user === null || $this->user->joined_at) {
            abort(410, 'Link has Expired');
        }

        $this->data = [...$this->user->toArray()];
    }

    /**
     * @throws NoDefaultPanelSetException
     */
    public function create()
    {
        $this->form->getState();
        $this->user->forceFill([
            'password' => \Hash::make($this->data['password']),
            'email_verified_at' => Carbon::now(),
            'joined_at' => Carbon::now(),
        ])->save();

        $this->user->notify(new WelcomeSystemUserNotification($this->user));

        Notification::make('create_account_success')
            ->success()
            ->duration(10000)
            ->title('Your Account is Ready')
            ->body('You can now access the recruit system, by using the credential you\'ve provided.')
            ->send();

        $this->redirect(filament()->getDefaultPanel()->getLoginUrl());

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
                    ->minLength(8)
                    ->confirmed()
                    ->label('Password'),
                Password::make('password_confirmation')
                    ->minLength(8)
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
            ->label('Verify & Create Account')
            ->color(Color::Gray)
            ->submit('create');
    }

    protected function hasFullWidthFormActions(): bool
    {
        return true;
    }
}
