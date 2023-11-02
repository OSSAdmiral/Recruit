<?php

namespace App\Filament\Resources\CandidatesProfileResource\Pages;

use App\Filament\Resources\CandidatesProfileResource;
use App\Models\candidatePortalInvitation;
use App\Models\Candidates;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Colors\Color;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\URL;

class ViewCandidatesProfile extends ViewRecord
{
    protected static string $resource = CandidatesProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->icon('heroicon-o-pencil-square'),
            Actions\Action::make('portal_invite')
                ->icon('heroicon-o-envelope')
                ->color(Color::Green)
                ->label('Invite to Portal')
                ->action(fn () => $this->portalInvite())
        ];
    }

    protected function portalInvite(): void
    {
        $candidate = Candidates::find($this->record->id)->first();
        if ($this->isAlreadyInvited())
        {
            $existing_invite = $this->portalInvitationModel()->first();
            $id = $existing_invite->id;
            $invite_link  = URL::signedRoute('portal.invite', ['id' => $id]);
            $candidate->notifyNow(new \App\Notifications\CandidatePortalInvitation($candidate, $invite_link));
            // update the date sent
            $existing_invite->touch('sent_at');
        }else{
            $invite = candidatePortalInvitation::create([
                'name' => "{$this->record->LastName} {$this->record->FirstName}",
                'email' => $this->record->email,
                'sent_at' => Carbon::now(),
            ]);
            $invite_link  = URL::signedRoute('portal.invite', ['id' => $invite->id]);
            $candidate->notifyNow(new \App\Notifications\CandidatePortalInvitation($candidate, $invite_link));
        }

        Notification::make('invitation_success')
                ->success()
                ->icon('heroicon-o-envelope')
                ->title('Invitation Sent')
                ->body('Invitation has been successfully sent.')
                ->send();
    }

    protected function portalInvitationModel(): Builder
    {
        return candidatePortalInvitation::whereEmail($this->record->email);
    }

    protected function isAlreadyInvited(): bool
    {
      $existing = $this->portalInvitationModel();
      return  $existing->count() > 0 ;
    }
}
