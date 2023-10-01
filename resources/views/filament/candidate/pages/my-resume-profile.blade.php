<x-filament-panels::page>
    <form wire:submit="create">
        {{ $this->form }}

        <button type="submit">
            Submit
        </button>
    </form>
</x-filament-panels::page>
