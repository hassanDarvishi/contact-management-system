<?php

declare(strict_types=1);

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/';

$file = __DIR__ . $path;

// اگر فایل واقعی مثل CSS یا تصویر وجود دارد
if ($path !== '/' && is_file($file)) {
    return false;
}

// در غیر این صورت درخواست را به برنامه بفرست
require __DIR__ . '/index.php';