<?php

declare(strict_types=1);

use App\Core\Router;

ob_start();

require_once __DIR__ . '/../../app/Core/Router.php';

$router = new Router();

// Define routes
$router->get('/', function (): void {
    echo 'Home page works!';
});

$router->get('/contact', function (): void {
    echo 'Contact page works!';
});

$router->post('/contact', function (): void {
    echo 'Contact form submitted!';
});

// Test GET /
ob_start();
$router->dispatch('/', 'GET');
$result = ob_get_clean();

echo "Testing GET /:\n";
echo $result . "\n\n";

// Test GET /contact
ob_start();
$router->dispatch('/contact', 'GET');
$result = ob_get_clean();

echo "Testing GET /contact:\n";
echo $result . "\n\n";

// Test POST /contact
ob_start();
$router->dispatch('/contact', 'POST');
$result = ob_get_clean();

echo "Testing POST /contact:\n";
echo $result . "\n\n";

// Test 404
ob_start();
$router->dispatch('/unknown', 'GET');
$result = ob_get_clean();

echo "Testing GET /unknown:\n";
echo $result . "\n";

ob_end_flush();