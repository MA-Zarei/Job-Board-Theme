<?php
/**
 * Template Name: jobseeker-dashboard
 */
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>داشبورد کارجو</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/bootstrap/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>./assets/css/font.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>./assets/css/style.css">
</head>

<body class="bg-light">

    <div class="container py-5">

        <!-- هدر -->
        <div class="text-center mb-4">
            <h4 class="fw-bold">داشبورد کارجو</h4>
            <p class="text-muted">مدیریت اطلاعات شخصی و پیگیری درخواست‌ها</p>
        </div>

        <div class="row g-4">

            <!-- اطلاعات کاربری -->
            <div class="col-12 col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">اطلاعات کاربری</h5>
                        <div class="mb-2"><strong>نام:</strong> <span class="text-muted">محمد کریمی</span></div>
                        <div class="mb-2"><strong>ایمیل:</strong> <span class="text-muted">karimi@example.com</span>
                        </div>
                        <div class="mb-2"><strong>شماره تماس:</strong> <span class="text-muted">09351234567</span></div>
                        <div class="mb-2"><strong>وضعیت رزومه:</strong> <span class="text-muted">آپلود شده</span></div>
                        <div class="text-center mt-3">
                            <a href="#" class="btn btn-outline-primary btn-sm w-100">ویرایش اطلاعات</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- درخواست‌ها و تب‌ها -->
            <div class="col-12 col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">درخواست‌های من</h5>

                        <!-- تب‌های دسته‌بندی -->
                        <ul class="nav nav-pills mb-3" id="applicationTabs">
                            <li class="nav-item"><button class="nav-link active" data-bs-toggle="pill"
                                    data-bs-target="#tab-all">همه</button></li>
                            <li class="nav-item"><button class="nav-link" data-bs-toggle="pill"
                                    data-bs-target="#tab-reviewed">بررسی‌شده</button></li>
                            <li class="nav-item"><button class="nav-link" data-bs-toggle="pill"
                                    data-bs-target="#tab-interview">مصاحبه</button></li>
                            <li class="nav-item"><button class="nav-link" data-bs-toggle="pill"
                                    data-bs-target="#tab-hired">استخدام‌شده</button></li>
                            <li class="nav-item"><button class="nav-link" data-bs-toggle="pill"
                                    data-bs-target="#tab-other">سایر</button></li>
                        </ul>

                        <!-- محتوا -->
                        <div class="tab-content">

                            <!-- همه -->
                            <div class="tab-pane fade show active" id="tab-all">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        طراح UI - همراه اول
                                        <span class="badge bg-info text-dark">در حال بررسی</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        برنامه‌نویس React - نوین پرداز
                                        <span class="badge bg-warning text-dark">مصاحبه</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        بازاریاب دیجیتال - دیجی‌کالا
                                        <span class="badge bg-success">استخدام‌شده</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        پشتیبان شبکه - نت‌سرویس
                                        <span class="badge bg-secondary">بدون پاسخ</span>
                                    </li>
                                </ul>
                            </div>

                            <!-- بررسی‌شده -->
                            <div class="tab-pane fade" id="tab-reviewed">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        طراح UI - همراه اول
                                        <span class="badge bg-info text-dark">در حال بررسی</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        پشتیبان وب - آوا سیستم
                                        <span class="badge bg-info text-dark">در حال بررسی</span>
                                    </li>
                                </ul>
                            </div>

                            <!-- مصاحبه -->
                            <div class="tab-pane fade" id="tab-interview">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        برنامه‌نویس React - نوین پرداز
                                        <span class="badge bg-warning text-dark">مصاحبه</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        کارشناس محصول - دیجی‌پی
                                        <span class="badge bg-warning text-dark">مصاحبه</span>
                                    </li>
                                </ul>
                            </div>

                            <!-- استخدام‌شده -->
                            <div class="tab-pane fade" id="tab-hired">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        بازاریاب دیجیتال - دیجی‌کالا
                                        <span class="badge bg-success">استخدام‌شده</span>
                                    </li>
                                </ul>
                            </div>

                            <!-- سایر -->
                            <div class="tab-pane fade" id="tab-other">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        مسئول محتوا - فرتک
                                        <span class="badge bg-secondary">رد‌شده</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        پشتیبان شبکه - نت‌سرویس
                                        <span class="badge bg-secondary">بدون پاسخ</span>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="<?php echo get_template_directory_uri(); ?>./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>