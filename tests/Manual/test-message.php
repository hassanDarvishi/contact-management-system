<?php

declare(strict_types=1);

use App\Core\Database;
use App\Models\Message;

require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

try {
    $pdo = Database::getConnection();

    $pdo->beginTransaction();

    $messageModel = new Message($pdo);

    $messageId = $messageModel->create(
        'کاربر آزمایشی',
        'test@example.com',
        'موضوع آزمایشی',
        'این یک پیام آزمایشی برای بررسی ذخیره اطلاعات است.'
    );

    echo "پیام با موفقیت ذخیره شد!\n";
    echo "Message ID: " . $messageId . "\n";

    $pdo->rollBack();

    echo "تراکنش آزمایشی بازگردانی شد.\n";
} catch (Throwable $exception) {
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }

    echo "خطا در ذخیره پیام:\n";
    echo $exception->getMessage() . "\n";

    exit(1);
}