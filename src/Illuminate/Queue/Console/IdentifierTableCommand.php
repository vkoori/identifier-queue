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
     * Replace the generated migration with the job table stub.
     *
     * @param  string  $path
     * @param  string  $table
     * @return void
     */
    protected function replaceMigration($path, $table)
    {
        $stub = str_replace(
            '{{table}}', $table, $this->files->get(__DIR__.'/stubs/jobs.stub')
        );

        $this->files->put($path, $stub);
    }
}