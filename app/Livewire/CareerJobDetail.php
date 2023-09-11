<?php

namespace App\Livewire;

use App\Models\JobOpenings;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Title;
use Livewire\Component;

class CareerJobDetail extends Component
{
    private static ?JobOpenings $jobDetails;

    public ?string $referenceNumber;

    public function mount($jobReferenceNumber)
    {
        // search for the job reference number, if not valid, redirect to all job
        $this->referenceNumber = $jobReferenceNumber;
        $this->jobOpeningDetails($jobReferenceNumber);

    }

    private function jobOpeningDetails($reference)
    {
        static::$jobDetails = JobOpenings::jobStillOpen()->where('JobOpeningSystemID', '=', $reference)->first();
        if (! static::$jobDetails) {
            // redirect back as the job opening is closed or tampered id or not existing
            Notification::make()
                ->title('Job Opening is already closed or doesn\'t exist.')
                ->icon('heroicon-o-x-circle')
                ->iconColor('warning')
                ->send();
            $this->redirectRoute('career.landing_page');
        }
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
        return view('livewire.career-job-detail', [
            'jobDetails' => static::$jobDetails,
        ]);
    }
}
