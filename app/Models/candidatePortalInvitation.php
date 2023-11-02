<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class candidatePortalInvitation extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'email',
        'name',
        'sent_at',
        'joined_at',
    ];

    protected $casts = [
        'id' => 'string',
        'sent_at' => 'datetime',
        'joined_at' => 'datetime',
    ];
}
