<?php

namespace App\Filament\Candidate\Resources\JobOpeningsResource\Pages;

use App\Filament\Candidate\Pages\MyResumeProfile;
use App\Filament\Candidate\Resources\JobOpeningsResource;
use App\Filament\Enums\JobCandidateStatus;
use App\Models\Candidates;
use App\Models\CandidateUser;
use App\Models\JobCandidates;
use App\Models\SavedJob;
use Filament\Actions\Action;
use Filament\Notifications;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Colors\Color;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\HtmlString;

class ViewJobOpenings extends ViewRecord
{
    protected static string $resource = JobOpeningsResource::class;

    protected function getHeaderActions(): array
    {
        return [

            Action::make('save_job')
                ->icon(function () {
                    return $this->isAlreadySaveJob() === true ? 'heroicon-s-heart' : 'heroicon-o-heart';
                })
                ->color(Color::Red)
                ->label(function () {
                    return $this->isAlreadySaveJob() === true ? 'Job Saved' : 'Save Job';
                })
                ->action(fn () => $this->saveJob()),
            Action::make('apply')
                ->label('Apply Job')
                ->icon('heroicon-o-briefcase')
                ->color(Color::Green)
                ->requiresConfirmation()
                ->modalDescription(function () {
                    return new HtmlString('Are you sure you want to send your Resume without updating your resume?'.
                        '<br><br><i style="color: indianred">Note: You cannot update your submitted resume to the Job you applied.</i>');

                })
                ->modalCancelAction(function () {
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
        if (! $this->isAlreadySaveJob()) {
            // Save the Job
            SavedJob::create([
                'job' => $id,
                'record_owner' => auth()->id(),
            ])->save();
            Notifications\Notification::make()
                ->color(Color::Green)
                ->icon('heroicon-o-check-circle')
                ->body('Job has been added to your job list.')
                ->send();
            // force refresh the page.
            $this->redirect(url(JobOpeningsResource::getUrl('view', [$id])));
        } else {
            // remove the save job
            SavedJob::whereJob($id)->whereRecordOwner(auth()->user()->id)->delete();
            Notifications\Notification::make()
                ->color(Color::Green)
                ->icon('heroicon-o-check-circle')
                ->body('Job has been removed to your job list.')
                ->send();
            // force refresh the page.
            $this->redirect(url(JobOpeningsResource::getUrl('view', [$id])));
        }

    }

    private function applyJob(): void
    {
        // Make sure that the applicant didn't applied to the same job using the email address
        $myAppliedJobs = CandidateUser::find(auth()->id())->myAppliedJobs()->whereId($this->record->id)->get()->toArray();
        if (count($myAppliedJobs) > 0) {
            Notifications\Notification::make()
                ->color(Color::Orange)
                ->icon('heroicon-o-exclamation-circle')
                ->body('You\'ve already applied this job.')
                ->send();
        } else {
            if (count($this->getMyCandidateProfile()->toArray()) === 0) {
                Notifications\Notification::make()
                    ->color(Color::Orange)
                    ->icon('heroicon-o-exclamation-circle')
                    ->title('Applying Job Cancelled.')
                    ->body('Please update your resume profile before applying a job.')
                    ->actions([
                        Notifications\Actions\Action::make('update_resume')
                            ->label('Update Resume')
                            ->icon('heroicon-o-document-text')
                            ->color(Color::Green)
                            ->url(MyResumeProfile::getUrl())
                            ->button(),
                        Notifications\Actions\Action::make('maybe_later')
                            ->label('Maybe Later')
                            ->button(),
                    ])
                    ->persistent()
                    ->send();
            } else {
                // create a candidate job record
                $candidateProfile = $this->getMyCandidateProfile()->toArray()[0];
                $job = JobCandidates::create([
                    'JobId' => $this->record->id,
                    'CandidateSource' => 'Portal',
                    'candidate' => $this->getMyCandidateProfile()->toArray()[0]['id'],
                    'mobile' => $this->getMyCandidateProfile()->toArray()[0]['Mobile'],
                    'Email' => $this->getMyCandidateProfile()->toArray()[0]['Email'],
                    'ExperienceInYears' => $this->getMyCandidateProfile()->toArray()[0]['ExperienceInYears'],
                    'ExpectedSalary' => $this->getMyCandidateProfile()->toArray()[0]['ExpectedSalary'],
                    'HighestQualificationHeld' => $this->getMyCandidateProfile()->toArray()[0]['HighestQualificationHeld'],
                    'CurrentEmployer' => $this->getMyCandidateProfile()->toArray()[0]['CurrentEmployer'],
                    'CurrentJobTitle' => $this->getMyCandidateProfile()->toArray()[0]['CurrentJobTitle'],
                    'CurrentSalary' => $this->getMyCandidateProfile()->toArray()[0]['CurrentSalary'],
                    'CandidateStatus' => JobCandidateStatus::New,
                    'SkillSet' => $this->getMyCandidateProfile()->toArray()[0]['SkillSet'],
                    'Street' => $this->getMyCandidateProfile()->toArray()[0]['Street'],
                    'City' => $this->getMyCandidateProfile()->toArray()[0]['City'],
                    'Country' => $this->getMyCandidateProfile()->toArray()[0]['Country'],
                    'ZipCode' => $this->getMyCandidateProfile()->toArray()[0]['ZipCode'],
                    'State' => $this->getMyCandidateProfile()->toArray()[0]['State'],
                ]);
                Notifications\Notification::make()
                    ->color(Color::Green)
                    ->icon('heroicon-o-check-circle')
                    ->title('Job Applied')
                    ->body('You\'re resume and data has been sent to the hiring party.')
                    ->send();
            }

        }

    }

    protected function isAlreadySaveJob(): bool
    {
        $existing = SavedJob::whereJob($this->record->id)->whereRecordOwner(auth()->user()->id)->count();

        return $existing > 0;

    }

    protected function getMyCandidateProfile(): Collection
    {
        // Key matching using the login email address
        return Candidates::where('Email', '=', auth()->user()->email)->get();
    }
}
