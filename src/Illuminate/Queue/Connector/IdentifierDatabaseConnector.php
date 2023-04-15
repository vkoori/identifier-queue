<?php

namespace Kooriv\Queue\Illuminate\Queue\Connector;

use Illuminate\Queue\Connectors\DatabaseConnector;
use Kooriv\Queue\Illuminate\Queue\IdentifierDatabaseQueue;

class IdentifierDatabaseConnector extends DatabaseConnector
{
    /**
     * Establish a queue connection.
     *
     * @param  array  $config
     * @return \Illuminate\Contracts\Queue\Queue
     */
    public function connect(array $config)
    {
        return new IdentifierDatabaseQueue(
            $this->connections->connection($config['connection'] ?? null),
            $config['table'],
            $config['queue'],
            $config['retry_after'] ?? 60,
            $config['after_commit'] ?? null
        );
    }
}
