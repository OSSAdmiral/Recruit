<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class JobOpenings extends Model
{
    use HasFactory, SoftDeletes, Userstamps;

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
        'published_career_site',
        'CreatedBy',
        'ModifiedBy',
        'DeletedBy',
    ];

    public function department(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Departments::class, 'Department', 'id');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(Attachments::class, 'attachmentOwner', 'id');
    }

    public function scopeJobStillOpen(Builder $query): void
    {
        $query->where('TargetDate', '>=', now()->format('d/m/Y'));
    }

    public function scopeRemoteJob(Builder $query): void
    {
        $query->where('RemoteJob', '=', true);
    }

    protected $casts = [
        'RequiredSkill' => 'array',
    ];
}
