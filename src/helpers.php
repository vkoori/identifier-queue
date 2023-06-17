<?php

use Kooriv\Queue\PendingDispatch\Lumen as LumenPendingDispatch;
use Kooriv\Queue\PendingDispatch\Laravel as LaravelPendingDispatch;

if (!function_exists('isLumen')) {
    function isLumen(): bool
    {
        return get_class(object: app()) == 'Laravel\Lumen\Application';
    }
}

if (!function_exists('dispatcher')) {
    /**
     * Dispatch a job to its appropriate handler.
     *
     * @param  mixed  $job
     * @return PendingDispatch
     */
    function dispatcher($job): LumenPendingDispatch|LaravelPendingDispatch
    {
        return isLumen()
            ? new LumenPendingDispatch($job)
            : new LaravelPendingDispatch($job);
    }
}
