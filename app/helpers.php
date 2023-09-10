<?php

use App\ZorumManager;

if (! function_exists('zorum')) {
    function zorum(): ZorumManager
    {
        /** @var ZorumManager $zorum */
        $zorum = app('zorum');

        return $zorum;
    }
}
