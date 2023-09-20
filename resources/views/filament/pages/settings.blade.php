<x-filament-panels::page>
    <div x-data="{ tab: 'General Settings' }">
        <x-filament::tabs label="Content tabs">
            <x-filament::tabs.item
                @click="tab = 'General Settings'"
                :alpine-active="'tab === \'General Settings\''"
                icon="healthicons-o-ui-preferences"
                icon-position="before"
            >
                General Settings
            </x-filament::tabs.item>

        </x-filament::tabs>
        <div>
            <div x-show="tab === 'General Settings'">
               @livewire(\App\Livewire\Settings\CompanyDetails::class)
            </div>
        </div>
    </div>
</x-filament-panels::page>
