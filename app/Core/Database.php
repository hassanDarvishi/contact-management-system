<?php

declare(strict_types=1);

namespace App\Core;

use PDO;
use PDOException;
use RuntimeException;

/**
 * مدیریت اتصال مرکزی برنامه به پایگاه داده MySQL.
 *
 * این کلاس از الگوی Singleton استفاده می‌کند تا در هر درخواست،
 * فقط یک نمونه اتصال PDO ایجاد و استفاده شود.
 */

class Database
{
    /**
     * نمونه اتصال فعال به دیتابیس.
     *
     * @var PDO|null
     */

    private static ?PDO $connection = null;

    /**
     * جلوگیری از ساخت مستقیم نمونه کلاس.
     *
     * @return void
     */

    private function __construct() {}

    /**
     * دریافت اتصال PDO به دیتابیس.
     *
     * اگر اتصال قبلاً ایجاد شده باشد، همان اتصال برگردانده می‌شود.
     * در غیر این صورت، اتصال جدیدی با تنظیمات فایل محیطی ساخته می‌شود.
     *
     * @return PDO اتصال برقرارشده به دیتابیس
     *
     * @throws RuntimeException اگر تنظیمات دیتابیس ناقص باشند
     * @throws PDOException اگر اتصال به دیتابیس ناموفق باشد
     */

    public static function getConnection(): PDO
    {
        if (self::$connection instanceof PDO) {
            return self::$connection;
        }

        $host = $_ENV['DB_HOST'] ?? '';
        $port = $_ENV['DB_PORT'] ?? '';
        $database = $_ENV['DB_DATABASE'] ?? '';
        $username = $_ENV['DB_USERNAME'] ?? '';
        $password = $_ENV['DB_PASSWORD'] ?? '';

        if (
            $host === ''
            || $port === ''
            || $database === ''
            || $username === ''
        ) {
            throw new RuntimeException(
                'تنظیمات اتصال دیتابیس کامل نیستند.'
            );
        }

        $dns = sprintf(
            'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
            $host,
            $port,
            $database
        );

        self::$connection = new PDO(
            $dns,
            $username,
            $password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]
        );

        return self::$connection;
    }
}
