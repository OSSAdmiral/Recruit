{{--
<div class="fi-simple-layout flex min-h-screen flex-col items-center">
    <div class="fi-simple-main-ctn flex w-full flex-grow items-center justify-center">
        <main class="fi-simple-main my-16 w-full bg-white px-6 py-12 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 sm:max-w-lg sm:rounded-xl sm:px-12">
            <section class="grid auto-cols-fr gap-y-6">
                <header class="fi-simple-header">
                    <div class="mb-4 flex justify-center">
                        <div class="fi-logo text-xl font-bold leading-5 tracking-tight text-gray-950 dark:text-white">
                            {{filament()->getBrandName()}}
                        </div>
                    </div>
                    <p class="fi-simple-header-subheading mt-2 text-center text-sm text-gray-500 dark:text-gray-400 italic">Candidate Portal Invitation - Verify and create account.</p>
                </header>
                <x-filament-panels::form>
                    {{$this->form}}

                    <x-filament::button
                        color="gray"
                        iconSize="lg"
                        type="submit"
                        wire:target="updateRecord"
                    >
                        Create Account
                    </x-filament::button>
                </x-filament-panels::form>
            </section>
        </main>
    </div>
</div>
--}}
<x-filament-panels::page.simple>
    <x-filament-panels::form wire:submit="create">
        {{ $this->form }}

        <x-filament-panels::form.actions
            :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()"
        />
    </x-filament-panels::form>

</x-filament-panels::page.simple>
