<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidates extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'CandidateId',
        'Email',
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
        'SchoolName',
        'SchoolMajor',
        'SchoolDegree',
        'SchoolDuration',
        'SchoolCurrentlyPursuing',
        'ExperienceDetails',
    ];

    public function fullNameAttribute()
    {
        return sprintf("%s%s", $this->FirstName, $this->LastName);
    }

    protected $casts = [
        'ExperienceDetails' => 'array',
        'SkillSet' => 'array'
    ];
}
