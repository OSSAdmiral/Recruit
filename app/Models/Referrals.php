<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Wildside\Userstamps\Userstamps;

class Referrals extends Model
{
    use Userstamps;

    const CREATED_BY = 'CreatedBy';

    const UPDATED_BY = 'ModifiedBy';

    const DELETED_BY = 'DeletedBy';

    protected $fillable = [
        'ReferringJob',
        'resume',
        'JobCandidate',
        'Candidate',
        'ReferredBy',
        'AssignedRecruiter',
        'Relationship',
        'KnownPeriod',
        'Notes',
        'CreatedBy',
        'ModifiedBy',
        'DeletedBy'
    ];

    /**
     * @return BelongsTo
     */
    public function candidates(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Candidates::class, 'Candidate', 'id');
    }
    /**
     * @return BelongsTo
     */
    public function jobopenings(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(JobOpenings::class, 'ReferringJob', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function jobcandidates(): BelongsTo
    {
        return$this->belongsTo(JobCandidates::class, 'JobCandidate', 'id');
    }
}
