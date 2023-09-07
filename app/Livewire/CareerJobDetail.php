<?php

namespace App\Livewire;

use Filament\Notifications\Notification;
use Livewire\Attributes\Title;
use Livewire\Component;

class CareerJobDetail extends Component
{
    public function mount($jobReferenceNumber)
    {
        // search for the job reference number, if not valid, redirect to all job

    }

    public function copiedShareLink(): void
    {
        Notification::make()
            ->title('Link Copied')
            ->icon('heroicon-o-check-badge')
            ->iconColor('success')
            ->send();
    }

    #[Title('Job Details')]
    public function render()
    {
        return view('livewire.career-job-detail');
    }
}
