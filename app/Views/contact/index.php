
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

                    <form action="/contact" method="POST">

                        <div class="mb-3">
                            <label for="name" class="form-label">
                                نام و نام خانوادگی
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="name"
                                name="name"
                                placeholder="نام خود را وارد کنید"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">
                                ایمیل
                            </label>

                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                placeholder="example@email.com"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label">
                                موضوع پیام
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="subject"
                                name="subject"
                                placeholder="موضوع پیام را وارد کنید"
                                required
                            >
                        </div>

                        <div class="mb-4">
                            <label for="message" class="form-label">
                                متن پیام
                            </label>

                            <textarea
                                class="form-control"
                                id="message"
                                name="message"
                                rows="6"
                                placeholder="پیام خود را بنویسید..."
                                required
                            ></textarea>
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
