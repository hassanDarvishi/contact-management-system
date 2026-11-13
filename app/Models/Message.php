<?php

declare(strict_types=1);

namespace App\Models;

use PDO;

/**
 * مدیریت اطلاعات پیام‌های دریافتی از فرم تماس.
 *
 * این کلاس مسئول عملیات مربوط به جدول messages در دیتابیس است.
 */

class Message
{
        /**
     * اتصال PDO به دیتابیس.
     *
     * @var PDO
     */
    private PDO $database;

        /**
     * ساخت نمونه مدل و دریافت اتصال دیتابیس.
     *
     * @param PDO $database اتصال PDO
     *
     * @return void
     */

        public function __construct(PDO $database)
        {
            $this->database = $database;
        }
    /**
     * ذخیره پیام جدید در دیتابیس.
     *
     * @param string $name نام ارسال‌کننده
     * @param string $email ایمیل ارسال‌کننده
     * @param string $subject موضوع پیام
     * @param string $message متن پیام
     *
     * @return int شناسه پیام ذخیره‌شده
     */

    public function create(
        string $name,
        string $email,
        string $subject,
        string $message
    ): int {
        $sql = "
            INSERT INTO messages (
                name,
                email,
                subject,
                message  
            ) VALUES (
                :name,
                :email,
                :subject,
                :message
            )
        ";

         $statement = $this->database->prepare($sql);

         $statement->execute([
            'name'=> $name,
            'email'=> $email,
            'subject'=> $subject,
            'message'=> $message,
         ]);

         return (int) $this->database->lastInsertId();

    }















}