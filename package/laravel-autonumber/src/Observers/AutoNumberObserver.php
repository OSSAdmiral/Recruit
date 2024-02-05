<?php
/*
 * Copyright (c) Marjose Darang. - All Rights Reserved
 *
 * Unauthorized copying or redistribution of this file in source and
 * binary forms via any medium is strictly prohibited.
 */

namespace Alfa6661\AutoNumber\Observers;

use Alfa6661\AutoNumber\AutoNumber;
use Illuminate\Database\Eloquent\Model;

class AutoNumberObserver
{
    /**
     * @var AutoNumber
     */
    private $autoNumber;

    /**
     * AutoNumberObserver constructor.
     */
    public function __construct(AutoNumber $autoNumber)
    {
        $this->autoNumber = $autoNumber;
    }

    /**
     * @return null
     */
    public function saving(Model $model)
    {
        if (! config('autonumber.onUpdate', false) && $model->exists) {
            return;
        }

        $this->generateAutoNumber($model);
    }

    /**
     * Generate auto number.
     *
     * @return bool
     */
    protected function generateAutoNumber(Model $model)
    {
        $generated = $this->autoNumber->generate($model);

        return $generated;
    }
}
