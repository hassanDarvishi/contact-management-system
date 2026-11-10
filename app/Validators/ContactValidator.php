<?php

declare(strict_types=1);

namespace App\Validators;

/**
 * اعتبار سنجی اطلاعات ارسال شده از فرم
 */
class ContactValidator
{

    /**
     * اعتبارسنجی تمام فیلدهای فرم تماس.
     *
     * @param array $data اطلاعات خام ارسال‌شده از فرم
     *
     * @return array فهرست خطاهای اعتبارسنجی
     */
    public function validate(array $data): array
    {
        $errors = [];

        $name = $this->normalizeField($data['name'] ?? null);
        $email = $this->normalizeField($data['email'] ?? null);
        $subject = $this->normalizeField($data['subject'] ?? null);
        $message = $this->normalizeField($data['message'] ?? null);

        if ($name === '') {
            $errors['name'] = 'وارد کردن نام الزامی است.';
        } elseif (mb_strlen($name) > 100) {
            $errors['name'] = 'نام نباید بیشتر از ۱۰۰ کاراکتر باشد.';
        }

        if ($email === '') {
            $errors['email'] = 'وارد کردن ایمیل الزامی است.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'فرمت ایمیل معتبر نیست.';
        } elseif (mb_strlen($email) > 150) {
            $errors['email'] = 'ایمیل نباید بیشتر از ۱۵۰ کاراکتر باشد.';
        }

        if ($subject === '') {
            $errors['subject'] = 'وارد کردن موضوع الزامی است.';
        } elseif (mb_strlen($subject) > 200) {
            $errors['subject'] = 'موضوع نباید بیشتر از ۲۰۰ کاراکتر باشد.';
        }

        if ($message === '') {
            $errors['message'] = 'وارد کردن متن پیام الزامی است.';
        }

        return $errors;
    }
    /**
     * تبدیل مقدار ورودی به رشته امن برای اعتبارسنجی.
     *
     * فقط مقادیر رشته‌ای پذیرفته می‌شوند.
     *
     * @param mixed $value مقدار دریافت‌شده از ورودی
     *
     * @return string مقدار رشته‌ای پاک‌سازی‌شده یا رشته خالی
     */
    private function normalizeField(mixed $value): string
    {
        if (!is_string($value)) {
            return '';
        }
        return trim($value);
    }
}
