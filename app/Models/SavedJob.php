<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SavedJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'jobopening',
        'record_owner',
    ];

    public function mySavedJob(): BelongsTo
    {
        return $this->belongsTo(CandidateUser::class, 'record_owner', 'id');
    }
}
