<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;
use App\Validators\ContactValidator;

/**
 * مدیریت درخواست‌های مربوط به فرم تماس.
 * 
 */
class ContactController
{
    /**
     * اعتبارسنج فرم تماس.
     *
     * @var ContactValidator
     */

    private ContactValidator $validator;
    /**
     * ساخت نمونه Controller و دریافت Validator.
     * 
     * @param ContactValidator $validator ابزار اعتبارسنجی فرم
     * 
     * @return void
     */
    public function __construct(ContactValidator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * نمایش فرم تماس با ما
     * 
     * @return void
     */
    public function index(): void
    {
        View::render('contact/index', [
            'title' => 'تماس با ما',
            'errors' => [],
            'old' => []
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

        $data = $_POST;

        $errors = $this->validator->validate($data);

        if (!empty($errors)) {
            http_response_code(422);
            View::render('contact/index', [
                'title' => 'تماس با ما',
                'errors' => $errors,
                'old' => $data
            ]);
            return;
        }
        http_response_code(200);
        View::render('contact/index', [
            'title' => 'تماس با ما',
            'errors' => [],
            'old' => [],
            'success'=> 'اطلاعات با موفقیت اعتبارسنجی شد!'
        ]);
    }
}
