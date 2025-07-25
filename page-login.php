<?php get_header(); ?>

<?php
// Show login error as a toast if one exists in transient
if ($error = get_transient('login_error')) {
    echo '<script>document.addEventListener("DOMContentLoaded", function () { showToastError("' . esc_js($error) . '"); });</script>';
}
?>

<main class="flex-grow-1">
    <div class="mx-auto bg-white shadow-sm rounded p-4" style="max-width: 720px;">

        <!-- Page title -->
        <h4 class="fw-bold text-center mb-4">ورود / ثبت‌نام</h4>

        <!-- Tabs for switching between login and register -->
        <ul class="nav nav-tabs mb-4" role="tablist">
            <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab"
                    data-bs-target="#login">ورود</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab"
                    data-bs-target="#register">ثبت‌نام</button></li>
        </ul>

        <div class="tab-content">

            <!-- Login tab -->
            <div class="tab-pane fade show active" id="login">
                <?php if (isset($login_error))
                    echo "<div class='alert alert-danger'>$login_error</div>"; ?>
                <form method="post">
                    <!-- Email input -->
                    <div class="mb-3">
                        <label class="form-label">ایمیل</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <!-- Password input -->
                    <div class="mb-3">
                        <label class="form-label">رمز عبور</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <!-- Submit button -->
                    <button name="login_submit" class="btn btn-primary w-100">ورود به حساب کاربری</button>
                </form>
            </div>

            <!-- Registration tab -->
            <div class="tab-pane fade" id="register">
                <!-- Role selection: Jobseeker / Employer -->
                <ul class="nav nav-pills mb-3">
                    <li class="nav-item"><button class="nav-link active" data-bs-toggle="pill"
                            data-bs-target="#jobseekerReg">کارجو</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="pill"
                            data-bs-target="#employerReg">کارفرما</button></li>
                </ul>

                <div class="tab-content">
                    <!-- Jobseeker registration form -->
                    <div class="tab-pane fade show active" id="jobseekerReg">
                        <?php if (isset($register_error))
                            echo "<div class='alert alert-danger'>$register_error</div>"; ?>
                        <form method="post">
                            <div class="row">
                                <!-- First name -->
                                <div class="col-md-6 mb-3"><label>نام</label><input type="text" name="first_name"
                                        class="form-control" required></div>
                                <!-- Last name -->
                                <div class="col-md-6 mb-3"><label>نام خانوادگی</label><input type="text"
                                        name="last_name" class="form-control" required></div>
                            </div>
                            <!-- Email -->
                            <div class="mb-3"><label>ایمیل</label><input type="email" name="email" class="form-control"
                                    required></div>
                            <!-- Phone -->
                            <div class="mb-3"><label>شماره تماس</label><input type="tel" name="phone"
                                    class="form-control"></div>
                            <!-- Password -->
                            <div class="mb-3"><label>رمز عبور</label><input type="password" name="password"
                                    class="form-control" required></div>
                            <!-- Submit -->
                            <button name="jobseeker_register_submit" class="btn btn-success w-100">ثبت‌نام
                                کارجو</button>
                        </form>
                    </div>

                    <!-- Employer registration form -->
                    <div class="tab-pane fade" id="employerReg">
                        <?php if (isset($register_error))
                            echo "<div class='alert alert-danger'>$register_error</div>"; ?>
                        <form method="post" enctype="multipart/form-data">
                            <!-- Company name -->
                            <div class="mb-3"><label class="form-label">نام شرکت</label><input type="text"
                                    name="company" class="form-control" required></div>
                            <!-- Address -->
                            <div class="mb-3"><label class="form-label">آدرس ثبتی</label><input type="text"
                                    name="address" class="form-control" required></div>
                            <!-- Phone -->
                            <div class="mb-3"><label class="form-label">شماره تماس</label><input type="tel" name="phone"
                                    class="form-control" required></div>
                            <!-- Email -->
                            <div class="mb-3"><label class="form-label">ایمیل</label><input type="email" name="email"
                                    class="form-control" required></div>
                            <!-- Password -->
                            <div class="mb-3"><label class="form-label">رمز عبور</label><input type="password"
                                    name="password" class="form-control" required></div>
                            <!-- Company logo -->
                            <div class="mb-3"><label class="form-label">لوگوی شرکت</label><input type="file" name="logo"
                                    class="form-control" accept="image/*" required></div>
                            <!-- Submit -->
                            <button name="employer_register_submit" class="btn btn-success w-100">ثبت‌نام
                                کارفرما</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Toast container for error messages -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050">
    <div id="toastError" class="toast align-items-center text-white bg-danger border-0" role="alert">
        <div class="d-flex">
            <div class="toast-body" id="toastErrorText">
                <!-- Error message will be shown here -->
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>

<?php get_footer(); ?>