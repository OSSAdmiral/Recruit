<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOpenings extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'postingTitle',
        'NumberOfPosition',
        'JobTitle',
        'JobOpeningSystemID',
        'TargetDate',
        'Status',
        'Industry',
        'Salary',
        'Department',
        'HiringManager',
        'AssignedRecruiters',
        'DateOpened',
        'JobType',
        'RequiredSkill',
        'WorkExperience',
        'JobDescription',
        'City',
        'Country',
        'State',
        'ZipCode',
        'RemoteJob',
        'CreatedBy',
        'ModifiedBy',
    ];

    protected $casts = [
        'Industry' => 'array',
    ];
}
