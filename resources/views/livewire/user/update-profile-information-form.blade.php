<x-grid-section md="2">
    <x-slot name="title">
        Update Profile Information
    </x-slot>

    <x-slot name="description">
        Update your account's profile information and email address.
    </x-slot>

    <x-filament::section>
        <x-filament-panels::form wire:submit="updateProfileInformation">
            <!-- Profile Photo -->

            <!-- Name -->
            <x-filament-forms::field-wrapper id="name" statePath="name" required="required" label="Name">
                <x-filament::input.wrapper class="overflow-hidden">
                    <x-filament::input id="name" type="text" maxLength="255" required="required" wire:model="state.name" autocomplete="name" />
                </x-filament::input.wrapper>
            </x-filament-forms::field-wrapper>

            <!-- Email -->
            <x-filament-forms::field-wrapper id="email" statePath="email" required="required" label="Email">
                <x-filament::input.wrapper class="overflow-hidden">
                    <x-filament::input id="email" type="email" wire:model="state.email" maxLength="255" required="required" autocomplete="username" />
                </x-filament::input.wrapper>
            </x-filament-forms::field-wrapper>

            <div class="text-left">
                <x-filament::button type="submit" wire:target="photo">
                    Update
                </x-filament::button>
            </div>
        </x-filament-panels::form>
    </x-filament::section>
</x-grid-section>
