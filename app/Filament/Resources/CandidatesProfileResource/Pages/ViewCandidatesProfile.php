<?php

namespace App\Filament\Resources\CandidatesProfileResource\Pages;

use App\Filament\Resources\CandidatesProfileResource;
use App\Models\candidatePortalInvitation;
use App\Models\Candidates;
use App\Models\CandidateUser;
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
                ->icon('heroicon-m-pencil-square'),
            Actions\ActionGroup::make([
                Actions\Action::make('portal_invite')
                    ->icon('heroicon-o-envelope')
                    ->color(Color::Green)
                    ->label('Invite to Portal')
                    ->close()
                    ->action(fn () => $this->portalInvite()),
            ]),
        ];
    }

    protected function portalInvite(): void
    {
        $candidate = Candidates::find($this->record->id)->first();

        if ($this->candidateUserModel()->count() > 0) {
            Notification::make('invitation_error')
                ->warning()
                ->title('Candidate Already Registered')
                ->body('The candidate you\'re inviting is already registered in the portal.')
                ->send();

            return;
        }

        if ($this->isAlreadyInvited()) {
            $existing_invite = $this->portalInvitationModel()->first();
            $id = $existing_invite->id;
            $invite_link = URL::signedRoute('portal.invite', ['id' => $id]);
            $candidate->notifyNow(new \App\Notifications\Candidates\CandidatePortalInvitation($candidate, $invite_link));
            // update the date sent
            $existing_invite->touch('sent_at');

        } else {
            $invite = candidatePortalInvitation::create([
                'name' => "{$this->record->FirstName} {$this->record->LastName}",
                'email' => $this->record->email,
                'sent_at' => Carbon::now(),
            ]);
            $invite_link = URL::signedRoute('portal.invite', ['id' => $invite->id]);
            $candidate->notifyNow(new \App\Notifications\Candidates\CandidatePortalInvitation($candidate, $invite_link));
        }
        $this->notificatioinInviteSent();

    }

    protected function notificatioinInviteSent(): void
    {
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

    protected function candidateUserModel(): Builder
    {
        return CandidateUser::whereEmail($this->record->email);
    }

    protected function isAlreadyInvited(): bool
    {
        $existing = $this->portalInvitationModel();

        return $existing->count() > 0;
    }
}
