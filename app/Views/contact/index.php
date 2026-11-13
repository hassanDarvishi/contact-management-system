<?php
$name = $old['name'] ?? null;
$name = is_string($name) ? $name : '';

$email = $old['email'] ?? null;
$email = is_string($email) ? $email : '';

$subject = $old['subject'] ?? null;
$subject = is_string($subject) ? $subject : '';

$message = $old['message'] ?? null;
$message = is_string($message) ? $message : '';
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">

                    <div class="text-center mb-4">
                        <h1 class="h3 mb-3">تماس با ما</h1>
                        <p class="text-muted">
                            پیام خود را برای ما ارسال کنید.
                            در اولین فرصت پاسخ خواهیم داد.
                        </p>
                    </div>
                    <?php if (!empty($success)): ?>
                        <div class="alert alert-success">
                            <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
                        </div>
                    <?php endif; ?>
                    <form action="/contact" method="POST">

                        <div class="mb-3">
                            <label for="name" class="form-label">
                                نام و نام خانوادگی
                            </label>

                            <input
                                type="text"
                                class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>"
                                id="name"
                                name="name"
                                value="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>"
                                placeholder="نام خود را وارد کنید">
                            <?php if (isset($errors['name'])): ?>
                                <div class="invalid-feedback">
                                    <?= htmlspecialchars($errors['name'], ENT_QUOTES, 'UTF-8') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">
                                ایمیل
                            </label>

                            <input
                                type="email"
                                class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                                id="email"
                                name="email"
                                value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>"
                                placeholder="example@email.com">
                            <?php if (isset($errors['email'])): ?>
                                <div class="invalid-feedback">
                                    <?= htmlspecialchars($errors['email'], ENT_QUOTES, 'UTF-8') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label">
                                موضوع پیام
                            </label>

                            <input
                                type="text"
                                class="form-control <?= isset($errors['subject']) ? 'is-invalid' : '' ?>"
                                id="subject"
                                name="subject"
                                value="<?= htmlspecialchars($subject, ENT_QUOTES, 'UTF-8') ?>"
                                placeholder="موضوع پیام را وارد کنید">

                            <?php if (isset($errors['subject'])): ?>
                                <div class="invalid-feedback">
                                    <?= htmlspecialchars($errors['subject'], ENT_QUOTES, 'UTF-8') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-4">
                            <label for="message" class="form-label">
                                متن پیام
                            </label>

                            <textarea
                                class="form-control <?= isset($errors['message']) ? 'is-invalid' : '' ?>"
                                id="message"
                                name="message"
                                rows="6"
                                placeholder="پیام خود را بنویسید..."><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></textarea>

                            <?php if (isset($errors['message'])): ?>
                                <div class="invalid-feedback">
                                    <?= htmlspecialchars($errors['message'], ENT_QUOTES, 'UTF-8') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            ارسال پیام
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>