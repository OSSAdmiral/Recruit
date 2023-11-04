<?php

namespace App\Filament\Enums;

use Filament\Support\Contracts\HasLabel;

enum JobCandidateStatus: string implements HasLabel
{
    case New = 'New';
    case WaitingForEvaluation = 'Waiting-for-Evaluation';
    case Contacted = 'Contacted';
    case ContactInFuture = 'Contact in Future';
    case NotContacted = 'Not Contacted';
    case AttemptedToContact = 'Attempted to Contact';
    case Qualified = 'Qualified';
    case Unqualified = 'Unqualified';
    case JunkCandidate = 'Junk candidate';
    case Associated = 'Associated';
    case Rejected = 'Rejected';
    case SubmittedToHiringManager = 'Submitted-to-hiring manager';
    case ApprovedByHiringManager = 'Approved by hiring manager';
    case RejectedByHiringManager = 'Rejected by hiring manager';
    case InterviewToBeScheduled = 'Interview-to-be-Scheduled';
    case InterviewScheduled = 'Interview-Scheduled';
    case InterviewInProgress = 'Interview-in-Progress';
    case AwaitingExamResult = 'Awaiting-Exam-Result';
    case ScheduledExam = 'Scheduled-Exam';
    case OnHold = 'On-Hold';
    case RejectedHirable = 'Rejected-Hirable';
    case RejectedForInterview = 'Rejected-for-Interview';
    case ToBeOffered = 'To-be-Offered';
    case OfferAccepted = 'Offer-Accepted';
    case OfferMade = 'Offer-Made';
    case OfferDeclined = 'Offer-Declined';
    case OfferWithdrawn = 'Offer-Withdrawn';
    case Hired = 'Hired';
    case Joined = 'Joined';
    case NoShow = 'No-Show';
    case ConvertedEmployee = 'Converted - Employee';
    case ForwardToOnboarding = 'Forward-to-Onboarding';

    public function getLabel(): ?string
    {
        return $this->value;
    }
}
