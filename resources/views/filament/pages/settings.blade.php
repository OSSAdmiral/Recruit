<x-filament-panels::page>
    <div x-data="{ tab: 'Company Details' }">
        <x-filament::tabs label="Content tabs" contained="true">
            <x-filament::tabs.item
                @click="tab = 'Company Details'"
                :alpine-active="'tab === \'Company Details\''"
                icon="healthicons-o-ui-preferences"
                icon-position="before"
            >
                Company Details
            </x-filament::tabs.item>

            <x-filament::tabs.item
                @click="tab = 'tab2'"
                :alpine-active="'tab === \'tab2\''"
            >
                Tab 2
            </x-filament::tabs.item>

        </x-filament::tabs>

        <div>
            <div x-show="tab === 'Company Details'">
               @livewire(\App\Livewire\Settings\CompanyDetails::class)
            </div>

            <div x-show="tab === 'tab2'">
                content 2...
            </div>
        </div>
    </div>
</x-filament-panels::page>
