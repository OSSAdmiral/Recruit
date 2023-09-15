<?php

test('can render career landing page', function () {
    $response = $this->get('/career');
    $response->assertStatus(200);
});

it('can see the career landing page component', function () {
    \Pest\Laravel\get('/career')
        ->assertSeeLivewire(\App\Livewire\CareerLandingPage::class);
});
