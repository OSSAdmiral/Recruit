<?php

namespace App\Livewire\User;

use Livewire\Component;

class UpdateProfileInformationForm extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('livewire.user.update-profile-information-form');
    }
}
