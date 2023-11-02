<?php

namespace App\Livewire\Portal\Invitation;

use App\Models\candidatePortalInvitation;
use Livewire\Component;
use Illuminate\Http\Request;

class CreateCandidateUser extends Component
{

    Public candidatePortalInvitation $candidatePortalInvitation;

    public function mount(Request $request, candidatePortalInvitation $id): void
    {
        if (! $request->hasValidSignature()) {
            abort(404);
        }

        $this->candidatePortalInvitation = $id;
    }

    public function render()
    {
        return view('livewire.portal.invitation.create-candidate-user');
    }
}
