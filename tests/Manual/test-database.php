<?php

declare(strict_types=1);

use App\Core\Database;

require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2)); 
$dotenv->load();

try {
    $pdo = Database::getConnection();

    $statement = $pdo->query('SELECT DATABASE() AS database_name');

    $result = $statement->fetch();

    echo "اتصال به دیتابیس با موفقیت برقرار شد!\n";
    echo "Database: " . $result['database_name'] . "\n";
} catch (Throwable $exception) {
    echo "خطا در اتصال به دیتابیس:\n";
    echo $exception->getMessage() . "\n";

    exit(1);
}