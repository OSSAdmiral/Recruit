<?php

namespace App\Livewire;

use App\Models\JobOpenings;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Attributes\Title;
use Filament\Forms\Components\Wizard;
use Livewire\Component;

class CareerApplyJob extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    private static ?JobOpenings $jobDetails;

    public ?string $referenceNumber;

    public function mount($jobReferenceNumber)
    {
        // search for the job reference number, if not valid, redirect to all job
        $this->jobOpeningDetails($jobReferenceNumber);
        $this->referenceNumber = $jobReferenceNumber;

    }

    private function jobOpeningDetails($reference): void
    {
        static::$jobDetails = JobOpenings::jobStillOpen()->where('JobOpeningSystemID', '=', $reference)->first();
        if (! static::$jobDetails) {
            // redirect back as the job opening is closed or tampered id or not existing
            Notification::make()
                ->title('Job Opening is already closed or doesn\'t exist.')
                ->icon('heroicon-o-x-circle')
                ->iconColor('warning')
                ->send();
//            $this->redirectRoute('career.landing_page');
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                Wizard::make(
                    array_merge(static::candidateBasicDetailsForm())
                )
            ]);
    }

    private static function candidateBasicDetailsForm(): array
    {
        return [
            Wizard\Step::make('Candidate Profile')
                ->description('candidate basic information')
                ->icon('heroicon-o')
                ->schema([
                    // ...
                ]),
        ];
    }





    #[Title('Apply Job ')]
    public function render()
    {
        return view('livewire.career-apply-job');
    }
}
