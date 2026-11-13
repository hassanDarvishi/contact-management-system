<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Controllers\ContactController;
use App\Validators\ContactValidator;
use PHPUnit\Framework\TestCase;
use App\Models\Message;
use PDO;


class ContactControllerTest extends TestCase
{
    /**
     * آماده‌سازی متغیرهای عمومی قبل از هر تست.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST = [];
    }

    /**
     * پاک‌سازی متغیرهای عمومی پس از هر تست.
     *
     * @return void
     */
    protected function tearDown(): void
    {
        $_POST = [];
        unset($_SERVER['REQUEST_METHOD']);

        http_response_code(200);

        parent::tearDown();
    }

    /**
     * بررسی نمایش صحیح فرم تماس.
     *
     * @return void
     */
    public function testIndexDisplaysContactForm(): void
    {

        $messageModel = $this->createStub(Message::class);
        $controller = new ContactController(
            new ContactValidator(),
            $messageModel
        );

        ob_start();

        $controller->index();

        $output = ob_get_clean();

        $this->assertIsString($output);
        $this->assertStringContainsString('تماس با ما', $output);
    }

    /**
     * بررسی رد کردن اطلاعات نامعتبر فرم.
     *
     * @return void
     */
    public function testStoreRejectsInvalidData(): void
    {
        $_POST = [
            'name' => '',
            'email' => 'invalid-email',
            'subject' => '',
            'message' => '',
        ];


        $messageModel = $this->createStub(Message::class);
        $controller = new ContactController(
            new ContactValidator(),
            $messageModel
        );

        ob_start();

        $controller->store();

        $output = ob_get_clean();

        $this->assertSame(422, http_response_code());

        $this->assertStringContainsString(
            'وارد کردن نام الزامی است.',
            $output
        );

        $this->assertStringContainsString(
            'فرمت ایمیل معتبر نیست.',
            $output
        );
    }

    /**
     * بررسی پذیرش اطلاعات معتبر فرم.
     *
     * @return void
     */
    public function testStoreAcceptsValidData(): void
    {
        $_POST = [
            'name' => 'Ali Rezaei',
            'email' => 'ali@example.com',
            'subject' => 'درخواست همکاری',
            'message' => 'این یک پیام آزمایشی است.',
        ];


        $messageModel = $this->createMock(Message::class);
        $messageModel
            ->expects($this->once())
            ->method('create')
            ->with(
                'Ali Rezaei',
                'ali@example.com',
                'درخواست همکاری',
                'این یک پیام آزمایشی است.',
            )
            ->willReturn(1);
        $controller = new ContactController(
            new ContactValidator(),
            $messageModel
        );

        ob_start();

        try {
            $controller->store();
            $output = ob_get_contents();
        } finally {
            ob_end_clean();
        }

        $this->assertSame(200, http_response_code());

        $this->assertStringContainsString(
            'اطلاعات با موفقیت اعتبارسنجی شد!',
            $output
        );
    }

    /**
     * بررسی جلوگیری از اجرای متد با درخواست غیر POST.
     *
     * @return void
     */
    public function testStoreRejectsNonPostRequest(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';


        $messageModel = $this->createStub(Message::class);
        $controller = new ContactController(
            new ContactValidator(),
            $messageModel
        );

        ob_start();

        $controller->store();

        $output = ob_get_clean();

        $this->assertSame(405, http_response_code());

        $this->assertStringContainsString(
            'متد درخواست مجاز نیست!',
            $output
        );
    }
}
