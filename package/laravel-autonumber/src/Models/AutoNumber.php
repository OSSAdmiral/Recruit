<?php
/*
 * Copyright (c) Marjose Darang. - All Rights Reserved
 *
 * Unauthorized copying or redistribution of this file in source and
 * binary forms via any medium is strictly prohibited.
 */

namespace Alfa6661\AutoNumber\Models;

use Illuminate\Database\Eloquent\Model;

class AutoNumber extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'number',
    ];
}
