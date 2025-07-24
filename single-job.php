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
                        <div class="d-flex flex-column flex-md-row align-items-start gap-4">
                            <!-- تصویر کارفرما -->
                            <div class="flex-shrink-0">
                                <img src="<?= esc_url(get_field('company_logo', 'user_' . get_post_field('post_author')) ?: get_template_directory_uri() . '/assets/photo/placeholder.png') ?>"
                                    alt="لوگوی <?= esc_attr(get_user_meta(get_post_field('post_author'), 'nickname', true) ?: get_the_author_meta('display_name', get_post_field('post_author'))) ?>"
                                    class="img-fluid rounded shadow" width="96" height="96">
                            </div>

                            <!-- اطلاعات آگهی -->
                            <div class="flex-grow-1">
                                <h4 class="fw-bold mb-2"><?= esc_html(get_the_title()); ?></h4>

                                <p class="text-muted mb-1">
                                    <?= esc_html(get_the_author_meta('nickname', get_post_field('post_author'))) . ' . ' . get_post_field('job_location'); ?>
                                </p>

                                <p class="text-muted small">
                                    <?php
                                    $type = get_field('job_type');
                                    $exp = get_field('job_experience');
                                    echo esc_html($type);
                                    echo $exp ? ' . حداقل ' . esc_html($exp) . ' سال تجربه' : ' . بدون نیاز به تجربه کاری مرتبط';
                                    ?>
                                </p>
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
                                <?php echo (get_field('job_salary') ? 'حقوق تقریبی: ' . get_field('job_salary') . ' میلیون‌تومان در ماه' : 'دستمزد توافقی') ?>
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
                                'meta_query' => [
                                    'relation' => 'OR',
                                    [
                                        'key' => 'job_status',
                                        'value' => 'غیرفعال',
                                        'compare' => '!=',
                                    ],
                                    [
                                        'key' => 'job_status',
                                        'compare' => 'NOT EXISTS',
                                    ]
                                ]
                            ];

                            $job_cards = new WP_Query($job_posts);

                            if ($job_cards->have_posts()):
                                while ($job_cards->have_posts()):
                                    $job_cards->the_post();

                                    $post_id = get_the_ID();
                                    $employer_id = get_post_field('post_author', $post_id);
                                    $employer_nick = get_user_meta($employer_id, 'nickname', true) ?: get_the_author_meta('display_name', $employer_id);
                                    $employer_logo = get_field('company_logo', 'user_' . $employer_id);
                                    $logo_url = $employer_logo ?: get_template_directory_uri() . '/assets/photo/placeholder.png';

                                    $post_timestamp = get_the_time('U');
                                    $current_timestamp = current_time('timestamp');
                                    $diff_days = floor(($current_timestamp - $post_timestamp) / DAY_IN_SECONDS);
                                    $date_text = ($diff_days < 1) ? 'امروز' : $diff_days . ' روز پیش';

                                    $job_location = get_post_field('job_location', $post_id);
                                    $job_type = get_field('job_type');
                                    $job_experience = get_field('job_experience');
                                    ?>

                                    <!-- cards -->
                                    <div class="card shadow-sm border-0 mb-3">
                                        <div class="card-body d-flex gap-3 align-items-start">
                                            <img src="<?= esc_url($logo_url); ?>" alt="لوگوی <?= esc_attr($employer_nick); ?>"
                                                class="rounded" width="48" height="48">
                                            <div class="flex-grow-1">
                                                <h6 class="fw-bold mb-1">
                                                    <a class="text-reset text-decoration-none" href="<?= get_permalink(); ?>">
                                                        <?= esc_html(get_the_title()); ?>
                                                    </a>
                                                </h6>
                                                <p class="text-muted small mb-1">
                                                    <?= esc_html($employer_nick . ' . ' . $job_location); ?>
                                                </p>
                                                <div class="d-flex flex-wrap gap-2 mb-2">
                                                    <?php if ($job_type): ?>
                                                        <span class="badge bg-light text-dark"><?= esc_html($job_type); ?></span>
                                                    <?php endif; ?>
                                                    <span class="badge bg-light text-dark">
                                                        <?= $job_experience ? ' حداقل ' . esc_html($job_experience) . ' سال تجربه' : 'بدون نیاز به تجربه مرتبط'; ?>
                                                    </span>
                                                </div>
                                                <p class="text-muted small mb-0"><?= esc_html($date_text); ?></p>
                                            </div>
                                        </div>
                                    </div>

                                <?php endwhile;
                            endif;

                            wp_reset_postdata();
                            ?>

                        </div>

                        <!-- mobile: recent jobs carousel -->
                        <?php if ($job_cards->have_posts()): ?>
                            <div class="d-lg-none mt-4">
                                <h6 class="fw-bold mb-3">شغل‌های مشابه</h6>

                                <div id="similarJobsCarousel" class="carousel slide" data-bs-ride="carousel"
                                    data-bs-interval="5000">
                                    <div class="carousel-inner">
                                        <?php
                                        $first = true;
                                        while ($job_cards->have_posts()):
                                            $job_cards->the_post();
                                            $post_id = get_the_ID();
                                            $employer_id = get_post_field('post_author', $post_id);
                                            $employer_nick = get_user_meta($employer_id, 'nickname', true) ?: get_the_author_meta('display_name', $employer_id);
                                            $employer_logo = get_field('company_logo', 'user_' . $employer_id);
                                            $logo_url = $employer_logo ?: get_template_directory_uri() . '/assets/photo/placeholder.png';
                                            $diff_days = floor((current_time('timestamp') - get_the_time('U')) / DAY_IN_SECONDS);
                                            $date_text = ($diff_days < 1) ? 'امروز' : $diff_days . ' روز پیش';
                                            $job_location = get_post_field('job_location', $post_id);
                                            $job_type = get_field('job_type');
                                            $job_experience = get_field('job_experience');
                                            ?>

                                            <div class="carousel-item <?= $first ? 'active' : '' ?>">
                                                <div class="card shadow-sm border-0 mx-3">
                                                    <div class="card-body d-flex gap-3 align-items-start">
                                                        <img src="<?= esc_url($logo_url); ?>"
                                                            alt="<?= esc_attr($employer_nick); ?> Logo" class="rounded"
                                                            width="48" height="48">
                                                        <div class="flex-grow-1">
                                                            <a class="text-reset text-decoration-none"
                                                                href="<?= get_permalink(); ?>">
                                                                <h6 class="fw-bold mb-2"><?= get_the_title(); ?></h6>
                                                            </a>
                                                            <p class="text-muted small mb-3"><?= esc_html($employer_nick); ?> ·
                                                                <?= esc_html($job_location); ?>
                                                            </p>
                                                            <div class="d-flex flex-wrap gap-2 mb-2">
                                                                <?php if ($job_type): ?>
                                                                    <span
                                                                        class="badge bg-light text-dark"><?= esc_html($job_type); ?></span>
                                                                <?php endif; ?>
                                                                <span
                                                                    class="badge bg-light text-dark"><?php echo $job_experience ? 'حداقل ' . $job_experience . ' سال سابقه کاری مرتبط' : 'بدون نیاز به سابقه کاری مرتبط'; ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php
                                            $first = false;
                                        endwhile;
                                        wp_reset_postdata();
                                        ?>
                                    </div>

                                    <!-- کنترل‌ها -->
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
                        <?php endif; ?>
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