<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2))->load();

try {
    $pdo = App\Core\Database::getConnection();

    echo "Database connection successful!" . PHP_EOL;

    echo "MySQL version: "
        . $pdo->getAttribute(PDO::ATTR_SERVER_VERSION)
        . PHP_EOL;

} catch (Throwable $exception) {
    echo "Database connection failed!" . PHP_EOL;
    echo $exception->getMessage() . PHP_EOL;
}