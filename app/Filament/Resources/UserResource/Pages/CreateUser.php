<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use App\Notifications\User\InviteNewSystemUserNotification;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected static ?string $title = 'Invite User';

    protected static bool $canCreateAnother = false;

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Invitation Sent')
            ->body('Invitation email sent to the user email address');
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreateFormAction(): Action
    {
        return Action::make('create')
            ->label('Create and Invite User')
            ->submit('create')
            ->keyBindings(['mod+s']);
    }

    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        return static::getModel()::create([
            ...$data,
            'password' => Hash::make(Str::random(15)), // temp password
            'sent_at' => Carbon::now(),
            'invitation_id' => Str::uuid(),
        ]);
    }

    protected function afterCreate(): void
    {
        // Send Invitation to the user
        $record = $this->getRecord();
        $link = URL::signedRoute('system-user.invite', ['id' => $record->invitation_id]);
        $record->notify(new InviteNewSystemUserNotification($record, $link));

    }
}
