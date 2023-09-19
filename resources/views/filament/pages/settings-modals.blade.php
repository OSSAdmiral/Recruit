<x-filament-panels::page>
    <x-filament::tabs label="Content tabs" x-data="{ activeTab: 'tab1' }">
        <x-filament::tabs.item
            alpine-active="activeTab === 'tab1'"
            x-on:click="activeTab = 'tab1'"
        >
            <x-slot name="slot">
                Company Details
            </x-slot>



        </x-filament::tabs.item>
        <x-filament::tabs.item
            alpine-active="activeTab === 'tab2'"
            x-on:click="activeTab = 'tab2'"
        >
            <x-slot name="slot">
                User
            </x-slot>
        </x-filament::tabs.item>
        <x-filament::tabs.item>Security Control</x-filament::tabs.item>
    </x-filament::tabs>
</x-filament-panels::page>
