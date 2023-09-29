<?php

namespace App\Filament\Candidate\Resources\JobOpeningsResource\Pages;

use App\Filament\Candidate\Resources\JobOpeningsResource;
use App\Models\CandidateUser;
use App\Models\SavedJob;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Colors\Color;
use Livewire\Component;

class ViewJobOpenings extends ViewRecord
{
    protected static string $resource = JobOpeningsResource::class;

    protected function getHeaderActions(): array
    {
        return [

            Action::make('save_job')
                ->icon('heroicon-o-heart')
                ->color(Color::Red)
                ->label('Save Job')
                ->action(fn() => $this->saveJob()),
            Action::make('apply')
                ->label('Apply Job')
                ->icon('heroicon-o-briefcase')
                ->color(Color::Green)
                ->action(fn() => $this->applyJob())

        ];
    }

    /**
     * @return void
     */
    private function saveJob(): void
    {
        $id = $this->record->id;
        // check if the job is already saved before or not
        if(SavedJob::whereJobopening($id)->count() <= 0)
        {
            // Save the Job
            SavedJob::create([
                'jobopening' => $id,
                'record_owner' => auth()->id()
            ])->save();
        }
        Notification::make()
                ->color(Color::Green)
                ->icon('heroicon-o-check-circle')
                ->body('Job has been added to your job list.')
                ->send();

    }

    /**
     * @return void
     */
    private function applyJob(): void
    {
        // Make sure that the applicant didn't applied to the same job using the email address
        $myAppliedJobs = CandidateUser::find(auth()->id())->myAppliedJobs()->whereId($this->record->id)->get()->toArray();
        if(count($myAppliedJobs) > 0)
        {
            Notification::make()
                ->color(Color::Orange)
                ->icon('heroicon-o-exclamation-circle')
                ->body('You\'ve already applied this job.')
                ->send();
        }else{
//            TODO: Work on this logic

            Notification::make()
                ->color(Color::Green)
                ->icon('heroicon-o-check-circle')
                ->title('Job Applied')
                ->body('You\'re resume and data has been sent to the hiring party.')
                ->send();
        }


    }
}
