<?php

namespace Tests\Unit;

use App\Livewire\CareerLandingPage;

use function Pest\Laravel\{get};
use function Pest\Livewire\livewire;

it('can load the career page', function () {
    livewire(\App\Livewire\CareerLandingPage::class)->assertStatus(200);
});
it('can see the component for the landing page', function () {
    get('/career')->assertSeeLivewire(CareerLandingPage::class);
});
