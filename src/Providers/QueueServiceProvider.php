<?php

namespace Kooriv\Queue\Providers;

use Illuminate\Support\ServiceProvider;
use Kooriv\Queue\Illuminate\Queue\Connector\IdentifierDatabaseConnector;
use Kooriv\Queue\Illuminate\Queue\Console\IdentifierTableCommand;

class QueueServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(path: dirname(__DIR__, 2) . '/config/identifier-database.php', key: 'queue.connections.identifier-database');

        if ($this->app->runningInConsole()) {
            $this->commands(commands: [IdentifierTableCommand::class]);
        }
    }

    public function boot(): void
    {
        /** @var QueueManager $queue */
        $queue = $this->app['queue'];
        $queue->addConnector('identifier-database', function () {
            return new IdentifierDatabaseConnector($this->app['db']);
        });
    }
}