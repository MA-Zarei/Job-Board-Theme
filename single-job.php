<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF8">
    <title><?php echo get_the_title() . ' | ' . get_bloginfo('name'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"
        href="<?php echo get_template_directory_uri(); ?>/assets/bootstrap/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nouislider@15.7.0/dist/nouislider.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>./assets/css/font.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>./assets/css/single-job.css">
</head>

<body>
    <div class="min-vh-100 d-flex flex-column">
        <?php get_header(); ?>

        <!-- job details page -->
        <main class="flex-grow-1">
            <div class="container">
                <div class="row mb-5">
                    <!-- main column: job details -->
                    <div class="col-12 col-lg-9 mb-4">
                        <div class="row align-items-center g-4">

                            <!-- بخش متنی سمت چپ -->
                            <div class="col-md-8">
                                <h4 class="fw-bold mb-2"><?php echo esc_html(get_the_title()); ?></h4>

                                <p class="text-muted mb-1">
                                    <?php echo esc_html(get_the_author_meta('nickname', get_post_field('post_author'))) . ' . ' . get_post_field('job_location'); ?>
                                </p>

                                <p class="text-muted small">
                                    <?php
                                    $type = get_field('job_type');
                                    $exp = get_field('job_experience');
                                    echo esc_html($type);
                                    echo $exp ? ' . حداقل ' . esc_html($exp) . ' سال تجربه' : '';
                                    ?>
                                </p>
                            </div>

                            <!-- تصویر سمت راست -->
                            <div class="col-md-4 text-end">
                                <?php
                                $logo = get_field('company_logo', 'user_' . get_post_field('post_author'));
                                if ($logo) {
                                    echo wp_get_attachment_image($logo, 'medium', false, ['class' => 'img-fluid rounded shadow']);
                                }
                                ?>
                            </div>

                        </div>


                        <hr>

                        <h6 class="fw-bold mt-4">شرح موقعیت شغلی</h6>
                        <p>
                            <?php echo get_the_content(); ?>
                        </p>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-primary">
                                <?php echo (get_field('job_salary') ? 'حقوق تقریبی: ' . get_field('job_salary') . ' میلیون‌تومان در ماه' : 'توافقی') ?>
                            </span>
                        </div>
                        <hr>
                        <?php
                        $user_roles = wp_get_current_user()->roles;
                        if (is_user_logged_in() && (in_array('administrator', $user_roles) || in_array('jobseeker', $user_roles))): ?>
                            <!-- admin or jobseeker: can upload resume -->
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mt-4">
                                <div id="resumeInfo" class="text-muted small">
                                    ارسال رزومه (با فرمت PDF)
                                </div>
                                <div>
                                    <input type="file" id="resumeUpload" accept=".pdf" class="d-none">
                                    <div id="resumeButtonArea">
                                        <button type="button" class="btn btn-success btn-sm" id="resumeUploadButton">
                                            انتخاب فایل رزومه
                                        </button>
                                    </div>

                                </div>
                            </div>

                        <?php elseif (is_user_logged_in() && in_array('employer', $user_roles)): ?>
                            <!-- employer: can upload resume and see error -->
                            <div class="text-danger small mt-4">
                                شما به عنوان کارفرما مجاز به ارسال رزومه نمی‌باشید.
                            </div>

                        <?php else: ?>
                            <!-- 🔒 کاربر وارد نشده: پیام ورود -->
                            <div class="text-danger small mt-4">
                                برای ارسال رزومه به حساب کاربری خود وارد شوید.
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- similar jobs -->
                    <div class="col-12 col-lg-3">
                        <!-- desktop: second column -->
                        <div class="d-none d-lg-block">
                            <h6 class="fw-bold mb-3">آخرین آگهی‌ها</h6>

                            <?php
                            $job_posts = [
                                'post_type' => 'job',
                                'posts_per_page' => 8,
                                'orderby' => 'date',
                                'order' => 'DESC',
                            ];
                            $job_cards = new WP_Query($job_posts);
                            if ($job_cards->have_posts()) {
                                while ($job_cards->have_posts()) {
                                    $job_cards->the_post();
                                    $post_timestamp = get_the_time('U');
                                    $current_timestamp = current_time('timestamp');
                                    $diff_days = floor(($current_timestamp - $post_timestamp) / DAY_IN_SECONDS);
                                    if ($diff_days < 1) {
                                        $date_text = 'امروز';
                                    } else {
                                        $date_text = $diff_days . ' روز پیش';
                                    }
                                    ?>
                                    <!-- cards -->
                                    <div class="card shadow-sm border-0 mb-3">
                                        <div class="card-body d-flex gap-3 align-items-start">
                                            <img src="https://via.placeholder.com/48x48.png?text=GJ" alt="Gojek Logo"
                                                class="rounded" width="48" height="48">
                                            <div class="flex-grow-1">
                                                <h6 class="fw-bold mb-1">
                                                    <a class="text-reset text-decoration-none"
                                                        href="<?php echo get_permalink(); ?>">
                                                        <?php echo get_the_title(); ?>
                                                    </a>
                                                </h6>
                                                <p class="text-muted small mb-1">
                                                    <?php echo esc_html(get_the_author_meta('nickname', get_post_field('post_author'))) . ' . ' . get_post_field('job_location'); ?>
                                                </p>
                                                <div class="d-flex flex-wrap gap-2 mb-2">
                                                    <span class="badge bg-light text-dark">
                                                        <?php
                                                        echo get_field('job_type');
                                                        ?>
                                                    </span>
                                                    <span class="badge bg-light text-dark">
                                                        <?php
                                                        echo get_field('job_experience') ? ' حداقل ' . get_field('job_experience') . ' سال تجربه' : '';
                                                        ?>
                                                    </span>
                                                </div>
                                                <p class="text-muted small mb-0">
                                                    <?php echo $date_text; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                            }
                            ?>
                            <?php wp_reset_postdata(); ?>

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
                                                <img src="https://via.placeholder.com/48x48.png?text=GJ"
                                                    alt="Gojek Logo" class="rounded" width="48" height="48">
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
                                                <img src="https://via.placeholder.com/48x48.png?text=GP"
                                                    alt="GoPay Logo" class="rounded" width="48" height="48">
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
                                                <img src="https://via.placeholder.com/48x48.png?text=GJ"
                                                    alt="Gojek Logo" class="rounded" width="48" height="48">
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
                                                <img src="https://via.placeholder.com/48x48.png?text=GP"
                                                    alt="GoPay Logo" class="rounded" width="48" height="48">
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
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#similarJobsCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                    <span class="visually-hidden">قبلی</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#similarJobsCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                    <span class="visually-hidden">بعدی</span>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php get_footer(); ?>
    </div>


    <!-- Bootstrap JS -->
    <script src="<?php echo get_template_directory_uri(); ?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- js files -->
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/upload resume.js" defer></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/caousel.js"></script>
    <script>
        window.jobPostID = <?php echo get_the_ID(); ?>;
    </script>

</body>

</html>