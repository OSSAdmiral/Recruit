<x-filament-panels::page>
    <x-grid-section md="1">
        <x-slot name="title">
            Update Company details
        </x-slot>

        <x-slot name="description">
            Update your account's profile information and email address.
        </x-slot>
        <x-filament::section>
            <x-filament-panels::form wire:submit="saveSettings">
                <x-filament-forms::field-wrapper id="site_name" statePath="site_name" required="required" label="Site Name">
                    <x-filament::input.wrapper class="overflow-hidden">
                        <x-filament::input id="site_name" type="text" maxLength="255" required="required" wire:model="state.site_name"/>
                    </x-filament::input.wrapper>
                </x-filament-forms::field-wrapper>

                <x-filament-forms::field-wrapper id="company_name" statePath="company_name" required="required" label="Company Name">
                    <x-filament::input.wrapper class="overflow-hidden">
                        <x-filament::input id="company_name" type="text" maxLength="255" required="required" wire:model="state.company_name"/>
                    </x-filament::input.wrapper>
                </x-filament-forms::field-wrapper>

                <x-filament-forms::field-wrapper id="website" statePath="website" required="required" label="Company Website">
                    <x-filament::input.wrapper class="overflow-hidden">
                        <x-filament::input id="website" type="text" maxLength="255" required="required" wire:model="state.website"/>
                    </x-filament::input.wrapper>
                </x-filament-forms::field-wrapper>

                <x-filament-forms::field-wrapper id="email" statePath="email" required="required" label="Primary Contact Email">
                    <x-filament::input.wrapper class="overflow-hidden">
                        <x-filament::input id="email" type="email" maxLength="255" required="required" wire:model="state.email"  />
                    </x-filament::input.wrapper>
                </x-filament-forms::field-wrapper>

                <x-filament-forms::field-wrapper id="employee_count" statePath="employee_count" required="required" label="Employee Count">
                    <x-filament::input.wrapper class="overflow-hidden">
                        <x-filament::input id="employee_count" type="number" maxLength="255" required="required" wire:model="state.employee_count" />
                    </x-filament::input.wrapper>
                </x-filament-forms::field-wrapper>

                <x-filament-forms::field-wrapper id="city" statePath="city" required="required" label="City">
                    <x-filament::input.wrapper class="overflow-hidden">
                        <x-filament::input id="city" type="text" maxLength="255" required="required" wire:model="state.city" />
                    </x-filament::input.wrapper>
                </x-filament-forms::field-wrapper>

                <x-filament-forms::field-wrapper id="state" statePath="state" required="required" label="State">
                    <x-filament::input.wrapper class="overflow-hidden">
                        <x-filament::input id="state" type="text" maxLength="255" required="required" wire:model="state.state"/>
                    </x-filament::input.wrapper>
                </x-filament-forms::field-wrapper>

                <x-filament-forms::field-wrapper id="country" statePath="country" required="required" label="Country">
                    <x-filament::input.wrapper class="overflow-hidden">
                        <x-filament::input id="country" type="text" maxLength="255" required="required" wire:model="state.country" />
                    </x-filament::input.wrapper>
                </x-filament-forms::field-wrapper>
                <div class="text-left">
                    <x-filament::button icon="iconpark-send"  icon-position="before" tooltip="Update Company details" type="submit">
                        <span wire:loading.remove wire:target="saveSettings">Update</span>
                        <span wire:loading wire:target="saveSettings">Updating...</span>
                    </x-filament::button>
                </div>
            </x-filament-panels::form>
        </x-filament::section>
    </x-grid-section>
</x-filament-panels::page>
