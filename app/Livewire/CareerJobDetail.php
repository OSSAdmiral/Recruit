<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class CareerJobDetail extends Component
{
    #[Title('Job Details')]
    public function render()
    {
        return view('livewire.career-job-detail');
    }
}
