<?php

declare(strict_types=1);

namespace App\Core;

/**
 * مدیریت توکن‌های CSRF برای محافظت از فرم‌ها.
 */
class Csrf
{
    /**
     * دریافت توکن فعلی یا ساخت توکن جدید.
     *
     * @return string توکن امنیتی فرم
     * @throws \Random\RandomException اگر تولید عدد تصادفی ناموفق باشد
     */

    public static function token(): string
    {

        $token = Session::get('_csrf_token');

        if (!is_string($token) || $token === '') {
            $token = bin2hex(random_bytes(32));
            Session::set('_csrf_token', $token);
        }
        return $token;
    }

    /**
     * بررسی معتبر بودن توکن ارسالی فرم.
     *
     * @param mixed $token توکن دریافت‌شده از درخواست
     * @return bool نتیجه اعتبارسنجی
     */

    public static function validate(mixed $token): bool
    {
        $storedToken = Session::get('_csrf_token');

        if (
            !is_string($token) ||
            !is_string($storedToken) ||
            $token === '' ||
            $storedToken === ''
        ) {
            return false;
        }

        return hash_equals($storedToken, $token);
    }
    /**
     * حذف توکن فعلی برای تولید توکن جدید در درخواست بعدی.
     *
     * @return void
     */
    public static function regenerate(): void
    {
        Session::remove('_csrf_token');
    }
}
