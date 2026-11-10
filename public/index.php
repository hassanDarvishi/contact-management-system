<?php

declare(strict_types=1);

use App\Core\Router;
use App\Core\Session;


require_once __DIR__ . '/../vendor/autoload.php';

// create Router

$router = new Router();

Session::start();

// Load web routes
$webRoutes = require dirname(__DIR__) . '/routes/web.php';
$webRoutes($router);

// Get request information

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/';

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

// Dispatch request
$router->dispatch($uri, $method);
