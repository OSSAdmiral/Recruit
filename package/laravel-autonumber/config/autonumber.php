<?php
/*
 * Copyright (c) Marjose Darang. - All Rights Reserved
 *
 * Unauthorized copying or redistribution of this file in source and
 * binary forms via any medium is strictly prohibited.
 */

return [

    /*
     * Autonumber format
     * '?' will be replaced with the increment number.
     */
    'format' => '?',

    /*
     * The number of digits in the autonumber
     */
    'length' => 4,

    /*
     * Whether to update the autonumber value when a model is being updated.
     * Defaults to false, which means autonumber are not updated.
     */
    'onUpdate' => false,

];
