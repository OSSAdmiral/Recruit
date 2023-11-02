<?php

namespace App\Livewire\Portal\Invitation;

use App\Models\candidatePortalInvitation;
use Livewire\Attributes\Title;
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

    #[Title('Candidate Invitation to Portal')]
    public function render()
    {
        return view('livewire.portal.invitation.create-candidate-user');
    }
}
