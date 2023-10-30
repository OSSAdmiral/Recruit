<x-filament-panels::page>
    <form wire:submit="updateAccount">
        {{ $this->form }}


        <div class="mt-3">
            <x-filament::button
                color="warning"
                icon="far-paper-plane"
                icon-position="before"
                iconSize="sm"
                type="submit"
                wire:target="updateAccount"
            >
                Update
            </x-filament::button>
        </div>

    </form>
</x-filament-panels::page>
