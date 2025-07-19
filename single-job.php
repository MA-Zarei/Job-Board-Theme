<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF8">
    <title>شرح شغل - UI/UX Designer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/bootstrap/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nouislider@15.7.0/dist/nouislider.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>./assets/css/font.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>./assets/css/single-job.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-light navbar-light border-bottom shadow-sm   mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">قالب سایت کاریابی</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#">ورود</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            حساب کاربری
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end start-auto">
                            <li><a class="dropdown-item" href="#">درخواست‌های من</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">نشان شده‌ها</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- job details page -->
    <div class="container">
        <div class="row mb-5">
            <!-- main column: job details -->
            <div class="col-12 col-lg-9 mb-4">
                <h4 class="fw-bold mb-2">UI/UX Designer</h4>
                <p class="text-muted mb-1">Pixelz Studio · Yogyakarta</p>
                <p class="text-muted small">تمام‌وقت · ریموت · ۲ تا ۴ سال تجربه</p>

                <hr>

                <h6 class="fw-bold mt-4">شرح موقعیت شغلی</h6>
                <p>
                    به عنوان طراح UI/UX در Pixelz Studio، تمرکز شما بر طراحی رابط‌های کاربری کاربرپسند در پلتفرم‌های
                    مختلف خواهد بود. شما با تیم توسعه همکاری نزدیکی خواهید داشت تا تجربه‌ای روان و جذاب برای کاربران
                    ایجاد کنید.
                </p>

                <h6 class="fw-bold mt-4">وظایف</h6>
                <ul>
                    <li>تحلیل نیازهای کاربر و تبدیل آن‌ها به طراحی قابل اجرا</li>
                    <li>ساخت وایرفریم، پروتوتایپ و طراحی نهایی</li>
                    <li>همکاری با تیم فنی برای پیاده‌سازی دقیق طراحی‌ها</li>
                </ul>

                <h6 class="fw-bold mt-4">شرایط مورد نیاز</h6>
                <ul>
                    <li>تجربه کاری مرتبط حداقل ۲ سال</li>
                    <li>آشنایی با Figma و ابزارهای طراحی</li>
                    <li>درک قوی از اصول UX و طراحی واکنش‌گرا</li>
                </ul>

                <hr>

                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-bold text-primary">۱۰٬۰۰۰٬۰۰۰ تومان / ماه</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mt-4">
                    <div id="resumeInfo" class="text-muted small">
                        ارسال رزومه (با فرمت PDF)
                    </div>
                    <div>
                        <input type="file" id="resumeUpload" accept=".pdf" class="d-none">
                        <button type="button" class="btn btn-success btn-sm"
                            onclick="document.getElementById('resumeUpload').click()">
                            انتخاب فایل رزومه
                        </button>
                    </div>
                </div>
            </div>

            <!-- similar jobs -->
            <div class="col-12 col-lg-3">
                <!-- desktop: second column -->
                <div class="d-none d-lg-block">
                    <h6 class="fw-bold mb-3">شغل‌های مشابه</h6>

                    <!--1st card-->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-body d-flex gap-3 align-items-start">
                            <img src="https://via.placeholder.com/48x48.png?text=GJ" alt="Gojek Logo" class="rounded"
                                width="48" height="48">
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-1">Lead UI Designer</h6>
                                <p class="text-muted small mb-1">Gojek · Jakarta</p>
                                <div class="d-flex flex-wrap gap-2 mb-2">
                                    <span class="badge bg-light text-dark">تمام‌وقت</span>
                                    <span class="badge bg-light text-dark">حضوری</span>
                                    <span class="badge bg-light text-dark">۳ تا ۵ سال</span>
                                </div>
                                <p class="text-muted small mb-0">۲ روز پیش · ۵۲۱ متقاضی</p>
                            </div>
                        </div>
                    </div>

                    <!--2nd card-->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-body d-flex gap-3 align-items-start">
                            <img src="https://via.placeholder.com/48x48.png?text=GP" alt="GoPay Logo" class="rounded"
                                width="48" height="48">
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-1">Sr. UX Designer</h6>
                                <p class="text-muted small mb-1">GoPay · Jakarta</p>
                                <div class="d-flex flex-wrap gap-2 mb-2">
                                    <span class="badge bg-light text-dark">تمام‌وقت</span>
                                    <span class="badge bg-light text-dark">ریموت</span>
                                    <span class="badge bg-light text-dark">۳ تا ۵ سال</span>
                                </div>
                                <p class="text-muted small mb-0">۱ روز پیش · ۳۱۲ متقاضی</p>
                            </div>
                        </div>
                    </div>
                    <!--3th card-->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-body d-flex gap-3 align-items-start">
                            <img src="https://via.placeholder.com/48x48.png?text=GJ" alt="Gojek Logo" class="rounded"
                                width="48" height="48">
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-1">Lead UI Designer</h6>
                                <p class="text-muted small mb-1">Gojek · Jakarta</p>
                                <div class="d-flex flex-wrap gap-2 mb-2">
                                    <span class="badge bg-light text-dark">تمام‌وقت</span>
                                    <span class="badge bg-light text-dark">حضوری</span>
                                    <span class="badge bg-light text-dark">۳ تا ۵ سال</span>
                                </div>
                                <p class="text-muted small mb-0">۲ روز پیش · ۵۲۱ متقاضی</p>
                            </div>
                        </div>
                    </div>

                    <!--4th card-->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-body d-flex gap-3 align-items-start">
                            <img src="https://via.placeholder.com/48x48.png?text=GP" alt="GoPay Logo" class="rounded"
                                width="48" height="48">
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-1">Sr. UX Designer</h6>
                                <p class="text-muted small mb-1">GoPay · Jakarta</p>
                                <div class="d-flex flex-wrap gap-2 mb-2">
                                    <span class="badge bg-light text-dark">تمام‌وقت</span>
                                    <span class="badge bg-light text-dark">ریموت</span>
                                    <span class="badge bg-light text-dark">۳ تا ۵ سال</span>
                                </div>
                                <p class="text-muted small mb-0">۱ روز پیش · ۳۱۲ متقاضی</p>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- mobile: similar jobs carousel -->
                <div class="d-lg-none mt-4">
                    <h6 class="fw-bold mb-3">شغل‌های مشابه</h6>
                    <div id="similarJobsCarousel" class="carousel slide" data-bs-ride="carousel"
                        data-bs-interval="5000">
                        <div class="carousel-inner">
                            <!-- 1st item -->
                            <div class="carousel-item active">
                                <div class="card shadow-sm border-0 mx-3">
                                    <div class="card-body d-flex gap-3 align-items-start">
                                        <img src="https://via.placeholder.com/48x48.png?text=GJ" alt="Gojek Logo"
                                            class="rounded" width="48" height="48">
                                        <div class="flex-grow-1">
                                            <h6 class="fw-bold mb-1">Lead UI Designer</h6>
                                            <p class="text-muted small mb-1">Gojek · Jakarta</p>
                                            <div class="d-flex flex-wrap gap-2 mb-2">
                                                <span class="badge bg-light text-dark">تمام‌وقت</span>
                                                <span class="badge bg-light text-dark">حضوری</span>
                                                <span class="badge bg-light text-dark">۳ تا ۵ سال</span>
                                            </div>
                                            <p class="text-muted small mb-0">۲ روز پیش · ۵۲۱ متقاضی</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 2nd item -->
                            <div class="carousel-item">
                                <div class="card shadow-sm border-0 mx-3">
                                    <div class="card-body d-flex gap-3 align-items-start">
                                        <img src="https://via.placeholder.com/48x48.png?text=GP" alt="GoPay Logo"
                                            class="rounded" width="48" height="48">
                                        <div class="flex-grow-1">
                                            <h6 class="fw-bold mb-1">Sr. UX Designer</h6>
                                            <p class="text-muted small mb-1">GoPay · Jakarta</p>
                                            <div class="d-flex flex-wrap gap-2 mb-2">
                                                <span class="badge bg-light text-dark">تمام‌وقت</span>
                                                <span class="badge bg-light text-dark">ریموت</span>
                                                <span class="badge bg-light text-dark">۳ تا ۵ سال</span>
                                            </div>
                                            <p class="text-muted small mb-0">۱ روز پیش · ۳۱۲ متقاضی</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 3th item -->
                            <div class="carousel-item active">
                                <div class="card shadow-sm border-0 mx-3">
                                    <div class="card-body d-flex gap-3 align-items-start">
                                        <img src="https://via.placeholder.com/48x48.png?text=GJ" alt="Gojek Logo"
                                            class="rounded" width="48" height="48">
                                        <div class="flex-grow-1">
                                            <h6 class="fw-bold mb-1">Lead UI Designer</h6>
                                            <p class="text-muted small mb-1">Gojek · Jakarta</p>
                                            <div class="d-flex flex-wrap gap-2 mb-2">
                                                <span class="badge bg-light text-dark">تمام‌وقت</span>
                                                <span class="badge bg-light text-dark">حضوری</span>
                                                <span class="badge bg-light text-dark">۳ تا ۵ سال</span>
                                            </div>
                                            <p class="text-muted small mb-0">۲ روز پیش · ۵۲۱ متقاضی</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 4th item -->
                            <div class="carousel-item">
                                <div class="card shadow-sm border-0 mx-3">
                                    <div class="card-body d-flex gap-3 align-items-start">
                                        <img src="https://via.placeholder.com/48x48.png?text=GP" alt="GoPay Logo"
                                            class="rounded" width="48" height="48">
                                        <div class="flex-grow-1">
                                            <h6 class="fw-bold mb-1">Sr. UX Designer</h6>
                                            <p class="text-muted small mb-1">GoPay · Jakarta</p>
                                            <div class="d-flex flex-wrap gap-2 mb-2">
                                                <span class="badge bg-light text-dark">تمام‌وقت</span>
                                                <span class="badge bg-light text-dark">ریموت</span>
                                                <span class="badge bg-light text-dark">۳ تا ۵ سال</span>
                                            </div>
                                            <p class="text-muted small mb-0">۱ روز پیش · ۳۱۲ متقاضی</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- دکمه‌های کنترل -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#similarJobsCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                            <span class="visually-hidden">قبلی</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#similarJobsCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                            <span class="visually-hidden">بعدی</span>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap JS -->
    <script src="<?php echo get_template_directory_uri(); ?>./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- js files -->
    <script src="<?php echo get_template_directory_uri(); ?>./assets/js/upload resume.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>./assets/js/caousel.js"></script>
</body>

</html>