<?php

return [
    'driver' => 'identify',
    'table' => 'identify_jobs',
    'queue' => 'default',
    'retry_after' => 90,
    'after_commit' => false,
];
