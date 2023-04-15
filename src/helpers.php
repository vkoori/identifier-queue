<?php

use Kooriv\Queue\Lumen\Bus\PendingDispatch;

if (! function_exists('dispatcher')) {
    /**
     * Dispatch a job to its appropriate handler.
     *
     * @param  mixed  $job
     * @return mixed
     */
    function dispatcher($job): PendingDispatch
    {
        return new PendingDispatch($job);
    }
}