<?php 

namespace Kooriv\Queue\Lumen\Bus;

use Laravel\Lumen\Bus\PendingDispatch as LumenPendingDispatch;

class PendingDispatch extends LumenPendingDispatch
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