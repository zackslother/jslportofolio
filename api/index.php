<?php
// api/index.php - The Final Correct Serverless Handler

use Illuminate\Http\Request;

// 1. Load the Composer Autoloader
require __DIR__ . '/../vendor/autoload.php';

// 2. Instantiate the Application
$app = require_once __DIR__ . '/../bootstrap/app.php';

// 3. Manually Bootstrap the Kernel (Essential for Vercel/Serverless)
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

// 4. Handle the Request (using the correct Request class)
$response = $kernel->handle(
    $request = Request::capture() // ⬅️ The fix is here: uses 'Request' which is aliased via 'use Illuminate\Http\Request;'
);

// 5. Send Response and Terminate
$response->send();
$kernel->terminate($request, $response);
