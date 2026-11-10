<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($title ?? 'سیستم مدیریت پیام‌های تماس', ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.rtl.min.css">

    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>

    <header>
        <h1>سیستم مدیریت پیام‌های تماس</h1>

        <nav>
            <a href="/">صفحه اصلی</a>
            <a href="/contact">تماس با ما</a>
        </nav>
    </header>

    <main>

        <?php

        use App\Core\Session;

        $successMessage = Session::getflash('success');
        $errorMessage = Session::getflash('error');
        ?>
        <?php if ($successMessage): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($successMessage, ENT_QUOTES, 'utf8') ?>
            </div>
        <?php endif; ?>

        <?php if ($errorMessage): ?>
            <div class="alert alert-error">
                <?= htmlspecialchars($errorMessage, ENT_QUOTES, 'utf8') ?>
            </div>
        <?php endif; ?>
        <?= $content ?? '' ?>
    </main>

    <footer>
        <p>تمام حقوق محفوظ است.</p>
    </footer>
<script src="/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>