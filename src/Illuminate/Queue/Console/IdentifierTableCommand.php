<?php

namespace Kooriv\Queue\Illuminate\Queue\Console;

use Illuminate\Queue\Console\TableCommand;

class IdentifierTableCommand extends TableCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'queue:identifier-table';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $table = $this->laravel['config']['queue.connections.identify.table'];

        $this->replaceMigration(
            $this->createBaseMigration($table),
            $table
        );

        $this->components->info('Migration created successfully.');
    }

    /**
     * Replace the generated migration with the job table stub.
     *
     * @param  string  $path
     * @param  string  $table
     * @return void
     */
    protected function replaceMigration($path, $table)
    {
        $stub = str_replace(
            '{{table}}',
            $table,
            $this->files->get(__DIR__ . '/stubs/jobs.stub')
        );

        $this->files->put($path, $stub);
    }
}
