<?php
/**
 * Template Name: employer-dashboard
 */
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>داشبورد کارفرما</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap RTL -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/bootstrap/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>./assets/css/font.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>./assets/css/style.css">
</head>

<body class="bg-light">

    <div class="container py-5">

        <!-- dashboard header -->
        <div class="mb-4 text-center">
            <h4 class="fw-bold">داشبورد کارفرما</h4>
            <p class="text-muted">مدیریت شرکت و آگهی‌های استخدامی</p>
        </div>

        <div class="row g-4">

            <!-- employer specs -->
            <div class="col-12 col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">مشخصات شرکت</h5>
                        <div class="mb-2"><strong>نام شرکت:</strong> <span class="text-muted">ایسوس ایران</span></div>
                        <div class="mb-2"><strong>ایمیل:</strong> <span class="text-muted">hr@asus.ir</span></div>
                        <div class="mb-2"><strong>شماره تماس:</strong> <span class="text-muted">021-88712345</span>
                        </div>
                        <div class="mb-2"><strong>آدرس:</strong> <span class="text-muted">تهران، سعادت آباد</span></div>
                        <div class="mb-2"><strong>توضیحات:</strong>
                            <p class="text-muted small mt-2">شرکت ایسوس ایران فعال در حوزه سخت‌افزار و استخدام متخصصین
                                فناوری اطلاعات</p>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-outline-primary btn-sm w-100">ویرایش اطلاعات</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- list of jobs -->
            <div class="col-12 col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">آگهی‌های فعال</h5>

                        <!-- table of job -->
                        <div class="table-responsive">
                            <table class="table table-striped align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>عنوان شغل</th>
                                        <th>تاریخ انتشار</th>
                                        <th>رزومه‌ها</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>طراح UI/UX</td>
                                        <td>۱۴۰۳/۰۴/۲۰</td>
                                        <td><span class="badge bg-secondary">۲۵</span></td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-outline-success">مشاهده رزومه‌ها</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>برنامه‌نویس React</td>
                                        <td>۱۴۰۳/۰۴/۲۵</td>
                                        <td><span class="badge bg-secondary">۱۲</span></td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-outline-success">مشاهده رزومه‌ها</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>مدیر محصول</td>
                                        <td>۱۴۰۳/۰۵/۰۱</td>
                                        <td><span class="badge bg-secondary">۷</span></td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-outline-success">مشاهده رزومه‌ها</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- btn to add job -->
                        <div class="text-end mt-3">
                            <a href="#" class="btn btn-primary">افزودن آگهی جدید</a>
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