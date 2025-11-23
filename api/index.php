<?php
// api/index.php - The Final, Vercel-Stable Serverless Handler

use Illuminate\Http\Request;
use Illuminate\Contracts\Http\Kernel;

// 1. Define LARAVEL_START for performance metrics
define('LARAVEL_START', microtime(true));

// 2. Load the Composer Autoloader
require __DIR__ . '/../vendor/autoload.php';

// 3. Instantiate the Application
$app = require_once __DIR__ . '/../bootstrap/app.php';

// 4. Resolve the HTTP Kernel and Bootstrap (CRUCIAL FIX)
$kernel = $app->make(Kernel::class);

// 5. Handle the Request explicitly
$response = $kernel->handle(
    $request = Request::capture()
);

// 6. Send Response and Terminate
$response->send();

$kernel->terminate($request, $response);
