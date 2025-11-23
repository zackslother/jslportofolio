<?php
// api/index.php

// This is the path to the Laravel bootstrap file
require __DIR__ . '/../vendor/autoload.php';

// Instantiate the application
$app = require_once __DIR__ . '/../bootstrap/app.php';

// --- ADD THESE LINES TO MANUALLY BOOTSTRAP ESSENTIAL SERVICES ---
$app->make(\Illuminate\Contracts\Http\Kernel::class)->bootstrap();
// --- END OF ADDED LINES ---

// Handle the request
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = \Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
