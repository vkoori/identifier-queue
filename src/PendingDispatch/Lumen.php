<?php

namespace Kooriv\Queue\PendingDispatch;

use Laravel\Lumen\Bus\PendingDispatch as LumenPendingDispatch;

class Lumen extends LumenPendingDispatch
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
