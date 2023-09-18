<x-filament-panels::page>
@foreach($components as $index => $component)
    @livewire($component)
        @if($loop->remaining)
            <x-section-border />
        @endif
@endforeach
</x-filament-panels::page>
