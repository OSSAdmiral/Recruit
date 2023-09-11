<?php

namespace App\Livewire;

use App\Models\Candidates;
use App\Models\JobOpenings;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\RawJs;
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
        if (!static::$jobDetails) {
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
                    array_merge(
                        static::candidateBasicDetailsForm(),
                        static::candidateCurrentJobDetails()
                    )
                )
            ]);
    }

    private static function candidateBasicDetailsForm(): array
    {
        return [
            Wizard\Step::make('Candidate Profile')
                ->description('candidate basic information')
                ->icon('heroicon-o-user')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('FirstName')
                        ->required()
                        ->label('First Name'),
                    Forms\Components\TextInput::make('LastName')
                        ->required()
                        ->label('Last Name'),
                    Forms\Components\TextInput::make('mobile')
                        ->required(),
                    Forms\Components\TextInput::make('Email')
                        ->required()
                        ->email(),
                    Forms\Components\Select::make('HighestQualificationHeld')
                        ->options([
                            'Secondary/High School' => 'Secondary/High School',
                            'Associates Degree' => 'Associates Degree',
                            'Bachelors Degree' => 'Bachelors Degree',
                            'Masters Degree' => 'Masters Degree',
                            'Doctorate Degree' => 'Doctorate Degree',
                        ])
                        ->label('Highest Qualification Held'),
                ]),
        ];
    }

    private static function candidateCurrentJobDetails(): array
    {
        return  [
            Wizard\Step::make('Candidate Profile')
                ->description('candidate basic information')
                ->icon('heroicon-o-user')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('CurrentEmployer')
                        ->label('Current Employer (Company Name)'),
                    Forms\Components\TextInput::make('CurrentJobTitle')
                        ->label('Current Job Title'),
                    Forms\Components\TextInput::make('CurrentSalary')
                        ->label('Current Salary')
                        ->mask(RawJs::make(<<<'JS'
                                $money($input, '.',',')
                                JS)),
                ])
        ];
    }





    #[Title('Apply Job ')]
    public function render()
    {
        return view('livewire.career-apply-job');
    }
}
