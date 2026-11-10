
<?php

require_once __DIR__ . '/config/database.php';

echo "Database connection successful!" . PHP_EOL;

$stmt = $pdo->query("SHOW TABLES");

$tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

echo "Database tables:" . PHP_EOL;

foreach ($tables as $table) {
    echo "- " . $table . PHP_EOL;
}