<?php

namespace Kooriv\Queue\PendingDispatch;

use Illuminate\Foundation\Bus\PendingDispatch as LaravelPendingDispatch;

class Laravel extends LaravelPendingDispatch
{
    /**
     * Set the desired identifier for the job.
     *
     * @param  string  $identifier
     * @return $this
     */
    public function setIdentifier(string $identifier)
    {
        $this->job->setIdentifier($identifier);

        return $this;
    }
}
