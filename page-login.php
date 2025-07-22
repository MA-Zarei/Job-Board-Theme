<?php
/**
 * Template Name: Login Page
 */
?>

<?php if ($error = get_transient('register_error')): ?>
    <script>
        document.addEventListener("DOMContentLoaded", () => showToastError("<?php echo esc_js($error); ?>"));
    </script>
<?php endif; ?>

<?php if ($error = get_transient('login_error')): ?>
    <script>
        document.addEventListener("DOMContentLoaded", () => showToastError("<?php echo esc_js($error); ?>"));
    </script>
<?php endif; ?>


<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>ثبت‌نام و ورود</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link rel="stylesheet"
        href="<?php echo get_template_directory_uri(); ?>/assets/bootstrap/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>./assets/css/font.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>./assets/css/page-login.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <main class="flex-grow-1">
        <div class="mx-auto bg-white shadow-sm rounded p-4" style="max-width: 720px;">

            <h4 class="fw-bold text-center mb-4">ورود / ثبت‌نام</h4>

            <ul class="nav nav-tabs mb-4" role="tablist">
                <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab"
                        data-bs-target="#login">ورود</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab"
                        data-bs-target="#register">ثبت‌نام</button></li>
            </ul>

            <div class="tab-content">
                <!-- ورود -->
                <div class="tab-pane fade show active" id="login">
                    <?php if (isset($login_error))
                        echo "<div class='alert alert-danger'>$login_error</div>"; ?>
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">ایمیل</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">رمز عبور</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button name="login_submit" class="btn btn-primary w-100">ورود به حساب کاربری</button>
                    </form>
                </div>

                <!-- ثبت‌نام -->
                <div class="tab-pane fade" id="register">
                    <ul class="nav nav-pills mb-3">
                        <li class="nav-item"><button class="nav-link active" data-bs-toggle="pill"
                                data-bs-target="#jobseekerReg">کارجو</button></li>
                        <li class="nav-item"><button class="nav-link" data-bs-toggle="pill"
                                data-bs-target="#employerReg">کارفرما</button></li>
                    </ul>

                    <div class="tab-content">
                        <!-- ثبت‌نام کارجو -->
                        <div class="tab-pane fade show active" id="jobseekerReg">
                            <?php if (isset($register_error))
                                echo "<div class='alert alert-danger'>$register_error</div>"; ?>
                            <form method="post">
                                <div class="row">
                                    <div class="col-md-6 mb-3"><label>نام</label><input type="text" name="first_name"
                                            class="form-control" required></div>
                                    <div class="col-md-6 mb-3"><label>نام خانوادگی</label><input type="text"
                                            name="last_name" class="form-control" required></div>
                                </div>
                                <div class="mb-3"><label>ایمیل</label><input type="email" name="email"
                                        class="form-control" required></div>
                                <div class="mb-3"><label>شماره تماس</label><input type="tel" name="phone"
                                        class="form-control"></div>
                                <div class="mb-3"><label>رمز عبور</label><input type="password" name="password"
                                        class="form-control" required></div>
                                <button name="jobseeker_register_submit" class="btn btn-success w-100">ثبت‌نام
                                    کارجو</button>
                            </form>
                        </div>

                        <!-- ثبت‌نام کارفرما -->
                        <div class="tab-pane fade" id="employerReg">
                            <?php if (isset($register_error))
                                echo "<div class='alert alert-danger'>$register_error</div>"; ?>
                            <form method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label class="form-label">نام شرکت</label>
                                    <input type="text" name="company" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">آدرس ثبتی</label>
                                    <input type="text" name="address" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">شماره تماس</label>
                                    <input type="tel" name="phone" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">ایمیل</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">رمز عبور</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">لوگوی شرکت</label>
                                    <input type="file" name="logo" class="form-control" accept="image/*" required>
                                </div>
                                <button name="employer_register_submit" class="btn btn-success w-100">ثبت‌نام
                                    کارفرما</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050">
        <div id="toastError" class="toast align-items-center text-white bg-danger border-0" role="alert">
            <div class="d-flex">
                <div class="toast-body" id="toastErrorText">
                    <!-- پیام ارور اینجا قرار می‌گیره -->
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>

    <?php get_footer(); ?>
    <!-- Bootstrap JS -->
    <script src="<?php echo get_template_directory_uri(); ?>./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- -->
    <script>
        function showToastError(message) {
            document.getElementById('toastErrorText').innerText = message;
            const toastElement = document.getElementById('toastError');
            const toast = new bootstrap.Toast(toastElement);
            toast.show();
        }
    </script>
    <!-- -->
    <?php if ($error = get_transient('login_error')): ?>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                showToastError("<?php echo esc_js($error); ?>");
            });
        </script>
    <?php endif; ?>

    <?php if ($error = get_transient('register_error')): ?>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                showToastError("<?php echo esc_js($error); ?>");
            });
        </script>
    <?php endif; ?>

</body>

</html>