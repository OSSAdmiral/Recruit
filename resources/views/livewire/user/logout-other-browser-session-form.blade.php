<x-grid-section md="2">
    <x-slot name="title">
        Browser Sessions
    </x-slot>

    <x-slot name="description">
        Manage and log out your active sessions on other browsers and devices.
    </x-slot>

    <x-filament::section>
        <div class="grid gap-y-6">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                If necessary, you may log out of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password.
            </p>

            <!-- Browser Sessions -->
            @if (count($this->sessions) > 0)
                @foreach ($this->sessions as $session)
                    <div class="flex items-center">
                        <div class="pe-3">
                            @if ($session->device === 'desktop')
                                <x-heroicon-o-computer-desktop class="h-8 w-8 text-gray-500" />
                            @elseif ($session->device === 'tablet')
                                <x-heroicon-o-device-tablet class="h-8 w-8 text-gray-500" />
                            @else
                                <x-heroicon-o-device-phone-mobile class="h-8 w-8 text-gray-500" />
                            @endif
                        </div>

                        <div class="font-semibold">
                            <div class="text-sm text-gray-800 dark:text-gray-200">
                                {{ $session->os_name ? $session->os_name . ($session->os_version ? ' ' . $session->os_version : '') : 'Unknown' }}
                                -
                                {{ $session->client_name ?: 'Unknown' }}
                            </div>

                            <div class="text-xs text-gray-600 dark:text-gray-300">
                                {{ $session->ip_address }},

                                @if ($session->is_current_device)
                                    <span class="text-primary-700 dark:text-primary-500">This device</span>
                                @else
                                    <span class="text-gray-400">Last active: {{ $session->last_active }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            <!-- Log Out Other Devices Confirmation Modal -->
            <x-filament::modal id="confirmingLogout" icon="heroicon-o-information-circle" icon-color="primary" alignment="center" footer-actions-alignment="center" width="2xl">
                <x-slot name="trigger">
                    <div class="text-left">
                        <x-filament::button wire:click="confirmLogout">
                            Log Out Other Browser Sessions
                        </x-filament::button>
                    </div>
                </x-slot>

                <x-slot name="heading">
                    Log Out Other Browser Sessions
                </x-slot>

                <x-slot name="description">
                    Please enter your password to confirm you would like to log out of your other browser sessions.
                </x-slot>

                <x-filament-forms::field-wrapper id="password" statePath="password" x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-filament::input.wrapper>
                        <x-filament::input type="password" placeholder="Password" x-ref="password" wire:model="password" wire:keydown.enter="logoutOtherBrowserSessions" />
                    </x-filament::input.wrapper>
                </x-filament-forms::field-wrapper>

                <x-slot name="footerActions">
                        <x-filament::button color="gray" wire:click="cancelLogoutOtherBrowserSessions">
                            Cancel
                        </x-filament::button>
                    <x-filament::button wire:click="logoutOtherBrowserSessions">
                        Log Out Other Browser Sessions
                    </x-filament::button>
                </x-slot>
            </x-filament::modal>
        </div>
    </x-filament::section>
</x-grid-section>
