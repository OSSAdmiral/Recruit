<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\HasDatabaseNotifications;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\RoutesNotifications;

class Candidates extends Model
{
    use AutoNumberTrait, HasDatabaseNotifications, HasFactory, Notifiable, RoutesNotifications, SoftDeletes;

    protected $fillable = [
        'CandidateId',
        'email',
        'FirstName',
        'LastName',
        'Mobile',
        'ExperienceInYears',
        'CurrentJobTitle',
        'ExpectedSalary',
        'SkillSet',
        'HighestQualificationHeld',
        'CurrentEmployer',
        'CurrentSalary',
        'AdditionalInformation',
        'Street',
        'City',
        'Country',
        'ZipCode',
        'State',
        'CandidateStatus',
        'CandidateSource',
        'CandidateOwner',
        'School',
        'ExperienceDetails',
    ];

    public function attachments(): HasMany
    {
        return $this->hasMany(Attachments::class, 'attachmentOwner', 'id');
    }

    /**
     * @return array[]
     */
    public function getAutoNumberOptions(): array
    {
        return [
            'CandidateId' => [
                'format' => 'RLR_?_CANDP', // autonumber format. '?' will be replaced with the generated number.
                'length' => 5, // The number of digits in an autonumber
            ],
        ];
    }

    protected $casts = [
        'ExperienceDetails' => 'array',
        'School' => 'array',
        'SkillSet' => 'array',
    ];
}
