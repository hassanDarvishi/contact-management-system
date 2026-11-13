<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;
use App\Validators\ContactValidator;
use App\Core\Database;
use App\Models\Message;
use App\Core\Csrf;
use App\Core\Session;


/**
 * مدیریت درخواست‌های مربوط به فرم تماس.
 * 
 */
class ContactController
{

    /**
     * مدل مدیریت پیام‌های تماس.
     *
     * @var Message
     */

    private Message $messageModel;
    /**
     * اعتبارسنج فرم تماس.
     *
     * @var ContactValidator
     */

    private ContactValidator $validator;

    /**
     * ساخت نمونه Controller و دریافت Validator.
     * ساخت کنترلر و دریافت وابستگی‌های موردنیاز.
     * @param ContactValidator $validator ابزار اعتبارسنجی فرم
     * @param Message $messageModel مدل مدیریت پیام‌ها
     * @return void
     */

    public function __construct(
        ContactValidator $validator,
        Message $messageModel
    ) {
        $this->validator = $validator;
        $this->messageModel = $messageModel;
    }

    /**
     * نمایش فرم تماس با ما
     * 
     * @return void
     */
    public function index(): void
    {
        $success = Session::getFlash('success');

        View::render('contact/index', [
            'title' => 'تماس با ما',
            'errors' => [],
            'old' => [],
            'success' => $success
        ]);
    }

    /**
     * دریافت و اعتبار سنجی اطلاعات ارسال‌شده از فرم تماس.
     *
     * @return void
     */
    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo 'متد درخواست مجاز نیست!';
            return;
        }

        if (!Csrf::validate($_POST['_token'] ?? null)) {
            http_response_code(419);

            echo 'درخواست نامعتبر است یا نشست شما منقضی شده است. لطفا صفحه را دوباره بارگذاری کنید.';
            return;
        }
        $data = $_POST;

        $errors = $this->validator->validate($data);

        if (!empty($errors)) {
            http_response_code(422);
            View::render('contact/index', [
                'title' => 'تماس با ما',
                'errors' => $errors,
                'old' => $data,
                'success' => null,
            ]);
            return;
        }

        try {
            $messageId = $this->messageModel->create(
                trim($data['name']),
                trim($data['email']),
                trim($data['subject']),
                trim($data['message'])

            );

            Csrf::regenerate();

            Session::flash(
                'success',
                'پیام شما با موفقیت ثبت شد.'
            );

            header('Location: /contact', true, 303);
            exit;

        } catch (\PDOException $exeption) {
            error_log($exeption->getMessage());

            http_response_code(500);
            View::render('contact/index', [
                'title' => 'تماس با ما',
                'errors' => [],
                'old' => $data,
                'success' => null,
                'error' => 'درحال حاضر امکان ثبت پیام وجود ندارد. لطفا دوباره تلاش کنید.'
            ]);
        }
    }
}
