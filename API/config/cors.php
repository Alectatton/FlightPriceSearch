<?php

return [
    'paths' => ['*', 'api/*'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['*', 'http://localhost:5173'], // TODO: Update before production
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*', 'Content-Type', 'Accept'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];
