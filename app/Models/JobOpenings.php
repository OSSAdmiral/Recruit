<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class JobOpenings extends Model
{
    use SoftDeletes, HasFactory, Userstamps;

    const CREATED_BY = 'CreatedBy';

    const UPDATED_BY = 'ModifiedBy';

    const DELETED_BY = 'DeletedBy';

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
        'DeletedBy',
    ];

    public function department(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Departments::class, 'Department', 'id');
    }

    protected $casts = [
        'RequiredSkill' => 'array',
    ];
}
