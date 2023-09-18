<?php

namespace App\Livewire\User;

use Carbon\Carbon;
use DeviceDetector\DeviceDetector;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class LogoutOtherBrowserSessionForm extends Component
{
    /**
     * The user's current password.
     */
    public string $password = '';

    /**
     * Confirm that the user would like to log out from other browser sessions.
     */
    public function confirmLogout(): void
    {
        $this->password = '';

        $this->dispatch('confirming-logout-other-browser-sessions');

        $this->dispatch('open-modal', id: 'confirmingLogout');
    }

    /**
     * Log out from other browser sessions.
     *
     * @throws AuthenticationException
     */
    public function logoutOtherBrowserSessions(): void
    {
        if (config('session.driver') !== 'database') {
            return;
        }

        $this->resetErrorBag();

        $guard = Filament::auth();

        if (! Hash::check($this->password, Auth::user()->password)) {
            throw ValidationException::withMessages([
                'password' => ['The password you entered is invalid.'],
            ]);
        }

        $guard->logoutOtherDevices($this->password);

        $this->deleteOtherSessionRecords();

        session()->put([
            'password_hash_'.Auth::getDefaultDriver() => Auth::user()?->getAuthPassword(),
        ]);

        $this->browserSessionsTerminated();

        $this->dispatch('close-modal', id: 'confirmingLogout');
    }

    /**
     * Cancel the other browser sessions logout process.
     */
    public function cancelLogoutOtherBrowserSessions(): void
    {
        $this->dispatch('close-modal', id: 'confirmingLogout');
    }

    /**
     * Delete the other browser session records from storage.
     */
    protected function deleteOtherSessionRecords(): void
    {
        if (config('session.driver') !== 'database') {
            return;
        }

        DB::connection(config('session.connection'))->table(config('session.table', 'sessions'))
            ->where('user_id', Auth::user()?->getAuthIdentifier())
            ->where('id', '!=', session()->getId())
            ->delete();
    }

    /**
     * Get the current sessions.
     */
    public function getSessionsProperty(): \Illuminate\Support\Collection
    {
        if (config('session.driver') !== 'database') {
            return collect();
        }

        return collect(
            DB::connection(config('session.connection'))->table(config('session.table', 'sessions'))
                ->where('user_id', Auth::user()?->getAuthIdentifier())
                ->orderBy('last_activity', 'desc')
                ->get()
        )->map(function ($session) {
            $deviceDetector = $this->createAgent($session);

            return (object) [
                'device' => $deviceDetector->getDeviceName(),
                'client_name' => $deviceDetector->getClient('name'),
                'os_name' => $deviceDetector->getOs('name'),
                'os_version' => $deviceDetector->getOs('version'),
                'ip_address' => $session->ip_address,
                'is_current_device' => $session->id === session()->getId(),
                'last_active' => Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
            ];
        });
    }

    /**
     * Create a new agent instance from the given session.
     */
    protected function createAgent(mixed $session): DeviceDetector
    {
        $deviceDetector = new DeviceDetector($session->user_agent);
        $deviceDetector->parse();

        return $deviceDetector;
    }

    public function browserSessionsTerminated(): void
    {
        Notification::make()
            ->title('Browser sessions terminated')
            ->success()
            ->body('Your account has been logged out of other browser sessions for security purposes.')
            ->send();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('livewire.user.logout-other-browser-session-form');
    }
}
