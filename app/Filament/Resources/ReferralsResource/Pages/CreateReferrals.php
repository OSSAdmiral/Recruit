<?php

namespace App\Filament\Resources\ReferralsResource\Pages;

use App\Filament\Resources\ReferralsResource;
use App\Models\Candidates;
use App\Models\JobCandidates;
use Filament\Resources\Pages\CreateRecord;

class CreateReferrals extends CreateRecord
{
    protected static string $resource = ReferralsResource::class;

    protected static string $jobCandidateId;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['ReferredBy'] = auth()->id();
        $data['JobCandidate'] = self::$jobCandidateId;

        return $data;
    }

    protected function beforeCreate(): void
    {
        // Runs before the form fields are saved to the database.
        // Retrieve a created candidate
        $candidate = Candidates::find($this->data['Candidate'])->first();
        // Create JobCandidates record before the referral will be created
        $jobCandidates = JobCandidates::create([
            'candidate' => $this->record?->Candidate,
            'mobile' => $candidate?->Mobile,
            'Email' => $candidate?->Email,
            'CurrentJobTitle' => $candidate?->CurrentJobTitle,
            'CurrentEmployer' => $candidate?->CurrentEmployer,
        ]);

        self::$jobCandidateId = $jobCandidates->id;
    }
}
