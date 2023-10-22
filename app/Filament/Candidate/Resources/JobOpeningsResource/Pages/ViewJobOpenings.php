<?php

namespace App\Filament\Candidate\Resources\JobOpeningsResource\Pages;

use App\Filament\Candidate\Pages\MyResumeProfile;
use App\Filament\Candidate\Resources\JobOpeningsResource;
use App\Models\CandidateUser;
use App\Models\SavedJob;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Colors\Color;
use Illuminate\Support\HtmlString;

class ViewJobOpenings extends ViewRecord
{
    protected static string $resource = JobOpeningsResource::class;

    protected function getHeaderActions(): array
    {
        return [

            Action::make('save_job')
                ->icon(function() {
                    $existing = SavedJob::whereJob($this->record->id)->get()->count();
                    return $existing === 0 ? 'heroicon-o-heart': 'heroicon-s-heart';
                })
                ->color(Color::Red)
                ->label('Save Job')
                ->action(fn () => $this->saveJob()),
            Action::make('apply')
                ->label('Apply Job')
                ->icon('heroicon-o-briefcase')
                ->color(Color::Green)
                ->requiresConfirmation()
                ->modalDescription(function(){
                    return new HtmlString('Are you sure you want to send your Resume without updating your resume?'.
                        '<br><br><i style="color: indianred">Note: You cannot update your submitted resume to the Job you applied.</i>');

                })
                ->modalCancelAction(function (){
                    return Action::make('Update Resume')
                        ->color(Color::Teal)
                        ->url(MyResumeProfile::getUrl());
                })
                ->modalCancelActionLabel('Update Resume')
                ->action(fn () => $this->applyJob()),

        ];
    }

    private function saveJob(): void
    {
        $id = $this->record->id;
        // check if the job is already saved before or not
        if (SavedJob::whereJob($id)->count() <= 0) {
            // Save the Job
            SavedJob::create([
                'job' => $id,
                'record_owner' => auth()->id(),
            ])->save();
        }
        Notification::make()
            ->color(Color::Green)
            ->icon('heroicon-o-check-circle')
            ->body('Job has been added to your job list.')
            ->send();

    }

    private function applyJob(): void
    {
        // Make sure that the applicant didn't applied to the same job using the email address
        $myAppliedJobs = CandidateUser::find(auth()->id())->myAppliedJobs()->whereId($this->record->id)->get()->toArray();
        if (count($myAppliedJobs) > 0) {
            Notification::make()
                ->color(Color::Orange)
                ->icon('heroicon-o-exclamation-circle')
                ->body('You\'ve already applied this job.')
                ->send();
        } else {
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
