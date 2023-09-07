<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class CareerJobDetail extends Component
{

    public function mount($jobReferenceNumber)
    {
        // search for the job reference number, if not valid, redirect to all job

    }
    #[Title('Job Details')]
    public function render()
    {
        return view('livewire.career-job-detail');
    }
}
