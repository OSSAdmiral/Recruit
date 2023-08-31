<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class CareerLandingPage extends Component
{



    #[Title("Work with us")]
    public function render()
    {
        return view('livewire.career-landing-page');
    }
}
