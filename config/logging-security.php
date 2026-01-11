<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Security Logging Channel
    |--------------------------------------------------------------------------
    |
    | Dedykowany kanał do logowania zdarzeń bezpieczeństwa
    |
    */
    'security' => [
        'driver' => 'daily',
        'path' => storage_path('logs/security.log'),
        'level' => 'info',
        'days' => 90, // Przechowuj logi 90 dni
    ],
];
