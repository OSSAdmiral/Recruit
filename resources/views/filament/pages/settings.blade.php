<x-filament-panels::page>
    <div x-data="{ tab: 'Company Details' }">
        <x-filament::tabs label="Content tabs" contained="true">
            <x-filament::tabs.item
                @click="tab = 'tab1'"
                :alpine-active="'tab === \'tab1\''"
                icon="heroicon-m-bell"
                icon-position="before"
            >
                General Settings
            </x-filament::tabs.item>

            <x-filament::tabs.item
                @click="tab = 'tab2'"
                :alpine-active="'tab === \'tab2\''"
            >
                Tab 2
            </x-filament::tabs.item>

        </x-filament::tabs>

        <div>
            <div x-show="tab === 'tab1'">
                content 1...
            </div>

            <div x-show="tab === 'tab2'">
                content 2...
            </div>
        </div>
    </div>
</x-filament-panels::page>
