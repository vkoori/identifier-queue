<?php

namespace Kooriv\Queue\Providers;

use Illuminate\Support\ServiceProvider;
use Kooriv\Queue\Illuminate\Queue\Connector\IdentifierDatabaseConnector;
use Kooriv\Queue\Illuminate\Queue\Console\IdentifierTableCommand;

class QueueServiceProvider extends ServiceProvider
{
    public function register()
    {
        /** @var QueueManager $queue */
        $queue = $this->app['queue'];
        $queue->addConnector('identifier-database', function () {
            return new IdentifierDatabaseConnector($this->app['db']);
        });

        if ($this->app->runningInConsole()) {
            $this->commands(commands: [IdentifierTableCommand::class]);
        }
    }

    public function boot(): void
    {
        $this->mergeConfigFrom(path: dirname(__DIR__, 2) . '/config/identifier-database.php', key: 'queue.connections.identifier-database');
        if ($this->isLumen()) {
            $this->app->configure(name: 'queue.connections.identifier-database');
        }
    }

    private function isLumen(): bool
    {
        return get_class(object: app()) == 'Laravel\Lumen\Application';
    }
}