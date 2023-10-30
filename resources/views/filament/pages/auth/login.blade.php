<x-slot name="subheading">
    {{ __('filament-panels::pages/auth/login.actions.register.before') }}
    <x-filament::link size="sm" :href="filament()->getPanel('candidate')->getLoginUrl()">
        sign in as candidate portal user
    </x-filament::link>
</x-slot>

