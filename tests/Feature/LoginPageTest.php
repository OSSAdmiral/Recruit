<?php

namespace Tests\Feature;

it('can render login page', function () {
    $this->get('/')->assertSee('login');
});
