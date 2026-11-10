<?php

declare(strict_types=1);

namespace Test\Unit;

use App\Validators\ContactValidator;
use PHPUnit\Framework\TestCase;

/**
 * تست‌های واحد کلاس ContactValidator.
 */

class contactValidatorTest extends TestCase
{
    /**
     * بررسی پذیرش اطلاعات معتبر فرم تماس.
     *
     * @return void
     */
    public function testValidDataReturnsNoErrors(): void
    {
        $validator = new ContactValidator();
        $data = [
            'name' => 'علی رضایی',
            'email' => 'ali@gmail.com',
            'subject' => 'درخواست همکاری',
            'message' => 'سلام مایل به همکاری هستم!',
        ];

        $errors = $validator->validate($data);

        $this->assertSame([], $errors);
    }

    /**
     * بررسی خطای خالی بودن نام.
     *
     * @return void
     */

    public function testEmptyNameReturnsError(): void
    {
        $validator = new ContactValidator();

        $data = [
            'name' => '',
            'email' => 'ali@example.com',
            'subject' => 'درخواست همکاری',
            'message' => 'متن پیام آزمایشی',
        ];

        $errors = $validator->validate($data);

        $this->assertArrayHasKey('name', $errors);
    }
    /**
     * بررسی خطای نامعتبر بودن ایمیل.
     *
     * @return void
     */

    public function testInvalidEmailReturnsError(): void
    {
        $validator = new ContactValidator();

        $data = [
            'name' => 'علی رضایی',
            'email' => 'invalid-email',
            'subject' => 'درخواست همکاری',
            'message' => 'متن پیام آزمایشی',
        ];

        $errors = $validator->validate($data);

        $this->assertArrayHasKey('email', $errors);
    }
    /**
     * بررسی خطای طول بیش از حد موضوع.
     *
     * @return void
     */

    public function testLongSubjectReturnsError(): void
    {
        $validator = new ContactValidator();

        $data = [
            'name' => 'علی رضایی',
            'email' => 'ali@example.com',
            'subject' => str_repeat('الف', 201),
            'message' => 'متن پیام آزمایشی',
        ];

        $errors = $validator->validate($data);

        $this->assertArrayHasKey('subject', $errors);
    }
    /**
     * بررسی خطای خالی بودن متن پیام.
     *
     * @return void
     */
    public function testEmptyMessageReturnsError(): void
    {
        $validator = new ContactValidator();

        $data = [
            'name' => 'علی رضایی',
            'email' => 'ali@example.com',
            'subject' => 'درخواست همکاری',
            'message' => '',
        ];

        $errors = $validator->validate($data);

        $this->assertArrayHasKey('message', $errors);
    }

    /**
     * بررسی مدیریت نامی که به‌صورت آرایه ارسال شده است.
     *
     * @return void
     */
    public function testArrayNameReturnsErrorWithoutTypeError(): void
    {
        $validator = new ContactValidator();

        $data = [
            'name' => ['علی', 'رضایی'],
            'email' => 'ali@example.com',
            'subject' => 'درخواست همکاری',
            'message' => 'متن پیام آزمایشی',
        ];

        $errors = $validator->validate($data);

        $this->assertArrayHasKey('name', $errors);
    }

    /**
     * بررسی مدیریت پیام غیررشته‌ای.
     *
     * @return void
     */
    public function testArrayMessageReturnsErrorWithoutTypeError(): void
    {
        $validator = new ContactValidator();

        $data = [
            'name' => 'علی رضایی',
            'email' => 'ali@example.com',
            'subject' => 'درخواست همکاری',
            'message' => ['متن اول', 'متن دوم'],
        ];

        $errors = $validator->validate($data);

        $this->assertArrayHasKey('message', $errors);
    }
}
