<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachments extends Model
{
    protected $fillable = [
        'attachment',
        'attachmentName',
        'category',
        'attachmentOwner',
        'moduleName',
    ];
}
