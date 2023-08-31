<?php

namespace App\Livewire;

use App\Models\JobOpenings;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Title;
use Livewire\Component;

class CareerLandingPage extends Component
{
    private static function queryTable(): Builder
    {
        return JobOpenings::query()->where('published_career_site', '=', true);
    }

    #[Title('Work with us')]
    public function render()
    {
        return view('livewire.career-landing-page');
    }
}
