<?php

namespace App\Livewire\User;

use App\Filament\Pages\Profile;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateProfileInformationForm extends Component
{
    use WithFileUploads;

    /**
     * The component's state.
     */
    public array $state = [];

    /**
     * The new avatar for the user.
     */
    public $photo;

    /**
     * Determine if the verification email was sent.
     */
    public bool $verificationLinkSent = false;

    /**
     * Prepare the component.
     */
    public function mount(): void
    {
        $user = Auth::user();

        $this->state = ['email' => $user?->email, ...$user?->withoutRelations()->toArray()];
    }

    /**
     * Update the user's profile information.
     */
    public function updateProfileInformation(): void
    {
        $this->resetErrorBag();

        $this->updateUserProfile(
            Auth::user(),
            $this->photo
                ? [...$this->state, 'photo' => $this->photo]
                : $this->state
        );

        $this->redirect(Profile::getUrl());
        $this->profileInformationUpdated();

    }

    public function updateUserProfile(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
            ])->save();
        }
    }

    protected function profileInformationUpdated(): void
    {
        Notification::make()
            ->title('Profile information updated')
            ->success()
            ->body('Your profile information has been updated successfully.')
            ->send();
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }

    /**
     * Delete user's profile photo.
     */
    public function deleteProfilePhoto(): void
    {
        Auth::user()?->deleteProfilePhoto();
    }

    /**
     * Sent the email verification.
     */
    public function sendEmailVerification(): void
    {
        Auth::user()?->sendEmailVerificationNotification();

        $this->verificationLinkSent = true;

        Notification::make()
            ->title(__('filament-companies::default.notifications.verification_link_sent.title'))
            ->success()
            ->body(__('filament-companies::default.notifications.verification_link_sent.body'))
            ->send();
    }

    /**
     * Get the current user of the application.
     */
    public function getUserProperty(): ?Authenticatable
    {
        return Auth::user();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('livewire.user.update-profile-information-form');
    }
}
