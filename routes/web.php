<?php

declare(strict_types=1);

use App\Core\Router;
use App\Core\View;
use App\Core\Session;

return function (Router $router): void {

    $router->get('/', function (): void {
        View::render('contact/index', [
            'title' => 'تماس با ما'
        ]);
    });

    $router->get('/contact', function (): void {
        View::render('contact/index', [
            'title' => 'تماس با ما'
        ]);
    });
    $router->get('/admin/dashboard', function (): void {

        View::render(
            'admin/dashboard',
            [
                'title' => 'داشبورد مدیریت',
                'adminName' => 'مدیر سیستم'
            ],
            'admin'
        );
    });

    // $router->get('/test-flash', function (): void {

    //     Session::flash(
    //         'success',
    //         'پیام آزمایشی با موفقیت نمایش داده شد!'
    //     );

    //     header('Location: /admin/dashboard');
    //     exit;
    // });
};
