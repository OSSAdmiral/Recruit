<x-filament-panels::page>
    <x-filament::tabs label="Content tabs" contained="true" x-data="{ activeTab: 'tab1' }">
        <x-filament::tabs.item alpine-active="activeTab === 'tab1'"
                               x-on:click="activeTab = 'tab1'">
            Company Details
        </x-filament::tabs.item>
        <x-filament::tabs.item alpine-active="activeTab === 'tab2'"
                               x-on:click="activeTab = 'tab2'">Users
        </x-filament::tabs.item>
        <x-filament::tabs.item>Security Control</x-filament::tabs.item>
    </x-filament::tabs>
</x-filament-panels::page>
