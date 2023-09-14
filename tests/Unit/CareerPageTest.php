<?php

use function Pest\Livewire\livewire;

it('can see the career page', function () {
    livewire(\App\Livewire\CareerLandingPage::class)->assertStatus(200);
});
