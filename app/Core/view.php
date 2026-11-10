<?php

declare(strict_types=1);

namespace App\Core;

class View
{
    public static function render(
        string $view,
        array $data = [],
        string $layout = 'main'
    ): void {

        $allowedLayouts = ['main', 'admin'];

        if (!in_array($layout, $allowedLayouts, true)) {
            throw new \RuntimeException('Invalid layout.');
        }

        $viewPath = dirname(__DIR__) . '/Views/' . $view . '.php';

        $layoutPath = dirname(__DIR__)
            . '/Views/layouts/'
            . $layout
            . '.php';

        if (!file_exists($viewPath)) {
            throw new \RuntimeException('View not found: ' . $view);
        }

        if (!file_exists($layoutPath)) {
            throw new \RuntimeException('Layout not found: ' . $layout);
        }

        extract($data, EXTR_SKIP);

        ob_start();

        require $viewPath;

        $content = ob_get_clean();

        require $layoutPath;
    }
}