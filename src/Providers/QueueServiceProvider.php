<?php

namespace Kooriv\Queue\Providers;

use Illuminate\Support\ServiceProvider;
use Kooriv\Queue\Illuminate\Queue\Connector\IdentifierDatabaseConnector;
use Kooriv\Queue\Illuminate\Queue\Console\IdentifierTableCommand;

class QueueServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        /** @var QueueManager $queue */
        $queue = $this->app['queue'];
        $queue->addConnector('identify', function () {
            return new IdentifierDatabaseConnector($this->app['db']);
        });

        if ($this->app->runningInConsole()) {
            $this->commands(commands: [IdentifierTableCommand::class]);
        }

        if (isLumen()) {
            $this->mergeConfigFrom(
                path: dirname(__DIR__, 2) . '/config/identify.php',
                key: 'queue.connections.identify'
            );
            $this->app->configure(name: 'queue.connections.identify');
        }
    }
}
