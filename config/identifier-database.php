<?php 

return [
    'driver' => 'identifier-database',
    'table' => 'jobs',
    'queue' => 'default',
    'retry_after' => 90,
    'after_commit' => false,
];