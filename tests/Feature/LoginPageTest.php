<?php

namespace Tests\Feature;


use Filament\Pages\Auth\Login;

it("can render login page", function (){
    $this->get('/')->assertSee('login');
});


