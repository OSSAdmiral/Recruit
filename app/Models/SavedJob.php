<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SavedJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'job',
        'record_owner',
    ];

    public function saveJobRecordOwner(): BelongsTo
    {
        return $this->belongsTo(CandidateUser::class, 'record_owner', 'id');
    }

    public function jobOpening(): BelongsTo
    {
        return $this->belongsTo(JobOpenings::class, 'job', 'id');
    }
}
