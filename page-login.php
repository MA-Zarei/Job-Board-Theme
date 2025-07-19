<?php
/**
 * Template Name: صفحه ورود و ثبت‌نام
 */
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>ثبت‌نام و ورود</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/bootstrap/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>./assets/css/font.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>./assets/css/page-login.css">
</head>

<body class="bg-light">

    <div class="container py-5">
        <div class="mx-auto bg-white shadow-sm rounded p-4" style="max-width: 720px;">

            <!-- 🔹 عنوان صفحه 🔹 -->
            <h5 class="fw-bold text-center mb-4">ورود / ثبت‌نام</h5>

            <!-- تب‌های کارفرما / کارجو -->
            <ul class="nav nav-tabs mb-4" id="userTypeTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="jobseeker-tab" data-bs-toggle="tab" data-bs-target="#jobseeker"
                        type="button" role="tab">کارجو</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="employer-tab" data-bs-toggle="tab" data-bs-target="#employer"
                        type="button" role="tab">کارفرما</button>
                </li>
            </ul>

            <div class="tab-content" id="userTypeContent">

                <!-- کـــارجو -->
                <div class="tab-pane fade show active" id="jobseeker" role="tabpanel">
                    <ul class="nav nav-pills mb-3" id="jobseeker-inner-tabs">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="pill"
                                data-bs-target="#jobseeker-login">ورود</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="pill"
                                data-bs-target="#jobseeker-register">ثبت‌نام</button>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <!-- ورود کارجو -->
                        <div class="tab-pane fade show active" id="jobseeker-login">
                            <form>
                                <div class="mb-3">
                                    <label class="form-label">ایمیل</label>
                                    <input type="email" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">رمز عبور</label>
                                    <input type="password" class="form-control">
                                </div>
                                <button class="btn btn-primary w-100">ورود به حساب کاربری</button>
                            </form>
                        </div>

                        <!-- ثبت‌نام کارجو -->
                        <div class="tab-pane fade" id="jobseeker-register">
                            <form>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">نام</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">نام خانوادگی</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">ایمیل</label>
                                    <input type="email" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">شماره تماس</label>
                                    <input type="tel" class="form-control">
                                </div>
                                <button class="btn btn-success w-100">ثبت‌نام کارجو</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- کـــارفرما -->
                <div class="tab-pane fade" id="employer" role="tabpanel">
                    <ul class="nav nav-pills mb-3" id="employer-inner-tabs">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="pill"
                                data-bs-target="#employer-login">ورود</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="pill"
                                data-bs-target="#employer-register">ثبت‌نام</button>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <!-- ورود کارفرما -->
                        <div class="tab-pane fade show active" id="employer-login">
                            <form>
                                <div class="mb-3">
                                    <label class="form-label">ایمیل</label>
                                    <input type="email" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">رمز عبور</label>
                                    <input type="password" class="form-control">
                                </div>
                                <button class="btn btn-primary w-100">ورود به حساب کارفرما</button>
                            </form>
                        </div>

                        <!-- ثبت‌نام کارفرما -->
                        <div class="tab-pane fade" id="employer-register">
                            <form>
                                <div class="mb-3">
                                    <label class="form-label">نام شرکت/سازمان</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">آدرس ثبتی</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">شماره تماس ثابت</label>
                                    <input type="tel" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">ایمیل</label>
                                    <input type="email" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">توضیحات کوتاه درباره شرکت</label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">آیکون شرکت (لوگو)</label>
                                    <input type="file" accept="image/*" class="form-control">
                                </div>
                                <button class="btn btn-success w-100">ثبت‌نام کارفرما</button>
                            </form>
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