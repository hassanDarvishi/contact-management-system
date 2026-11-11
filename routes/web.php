<?php

declare(strict_types=1);

use App\Controllers\ContactController;
use App\Validators\ContactValidator;
use App\Core\Router;
use App\Core\View;
use App\Core\Session;



return function (Router $router): void {

    $contactController = new ContactController(
    new ContactValidator()
);

    $router->get('/', [$contactController, 'index']);
    $router->get('/contact', [$contactController, 'index']);
    $router->post('/contact', [$contactController, 'store']);

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
