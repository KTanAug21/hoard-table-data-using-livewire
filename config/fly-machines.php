<?php

// config for SecurityDiscovery/LaravelFlyMachines
return [
    'proto' => env('FLY_API_PROTO', 'http'),
    // The endpoint to the Fly machines API.
    'endpoint' => env('FLY_API_HOSTNAME', '127.0.0.1:4280'),
    // The token to authenticate to the API.
    'token' => env('FLY_API_TOKEN'),
];
