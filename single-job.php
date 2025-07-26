<?php get_header(); ?>

<!-- Job details page layout -->
<main class="flex-grow-1">
    <div class="container">
        <div class="row mb-5">

            <!-- right column: main job content -->
            <div class="col-12 col-lg-9 mb-4">

                <!-- Job header: logo + metadata -->
                <div class="d-flex flex-column flex-md-row align-items-start gap-4">

                    <!-- Company logo (fallback if not available) -->
                    <div class="flex-shrink-0">
                        <img src="<?= esc_url(get_field('company_logo', 'user_' . get_post_field('post_author')) ?: get_template_directory_uri() . '/assets/photo/placeholder.png') ?>"
                            alt="لوگوی <?= esc_attr(get_user_meta(get_post_field('post_author'), 'nickname', true) ?: get_the_author_meta('display_name', get_post_field('post_author'))) ?>"
                            class="img-fluid rounded shadow object-fit-cover" width="96" height="96">
                    </div>

                    <!-- Job title, author name, location, type, experience -->
                    <div class="flex-grow-1">
                        <h4 class="fw-bold mb-2"><?= esc_html(get_the_title()); ?></h4>

                        <!-- Employer name and job location -->
                        <p class="text-muted mb-1">
                            <?= esc_html(get_the_author_meta('nickname', get_post_field('post_author'))) . ' . ' . get_post_field('job_location'); ?>
                        </p>

                        <!-- Job type and experience level -->
                        <p class="text-muted small">
                            <?php
                            $type = get_field('job_type');      // Type: full-time, freelance, etc.
                            $exp = get_field('job_experience'); // Required experience in years
                            
                            echo esc_html($type);
                            echo $exp
                                ? ' . حداقل ' . esc_html($exp) . ' سال تجربه'
                                : ' . بدون نیاز به تجربه کاری مرتبط';
                            ?>
                        </p>
                    </div>
                </div>

                <hr>

                <!-- Job description section -->
                <h6 class="fw-bold mt-4">شرح موقعیت شغلی</h6>
                <p>
                    <?php echo nl2br(esc_html(get_the_content())); ?>
                </p>

                <hr>

                <!-- Salary display -->
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-bold text-primary">
                        <?php
                        echo get_field('job_salary')
                            ? 'حقوق تقریبی: ' . get_field('job_salary') . ' میلیون‌تومان در ماه'
                            : 'دستمزد توافقی';
                        ?>
                    </span>
                </div>

                <hr>

                <?php
                $user_roles = wp_get_current_user()->roles;
                ?>

                <!-- Resume submission interface (role-based) -->
                <?php if (is_user_logged_in() && (in_array('administrator', $user_roles) || in_array('jobseeker', $user_roles))): ?>

                    <!-- Resume upload form (PDF only) -->
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

                    <!-- Employers not allowed to upload resumes -->
                    <div class="text-danger small mt-4">
                        شما به عنوان کارفرما مجاز به ارسال رزومه نمی‌باشید.
                    </div>

                <?php else: ?>

                    <!-- Unauthenticated users need to log in -->
                    <div class="text-danger small mt-4">
                        برای ارسال رزومه به حساب کاربری خود وارد شوید.
                    </div>

                <?php endif; ?>
            </div>

            <!-- Left column: latest job listings -->
            <div class="col-12 col-lg-3">
                <div class="d-none d-lg-block">
                    <h6 class="fw-bold mb-3">آخرین آگهی‌ها</h6>

                    <?php
                    // Fetch latest active job posts
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
                            ],
                        ],
                    ];

                    $job_cards = new WP_Query($job_posts);

                    if ($job_cards->have_posts()):
                        while ($job_cards->have_posts()):
                            $job_cards->the_post();

                            // Get post and employer details
                            $post_id = get_the_ID();
                            $employer_id = get_post_field('post_author', $post_id);
                            $employer_nick = get_user_meta($employer_id, 'nickname', true)
                                ?: get_the_author_meta('display_name', $employer_id);
                            $employer_logo = get_field('company_logo', 'user_' . $employer_id);
                            $logo_url = $employer_logo ?: get_template_directory_uri() . '/assets/photo/placeholder.png';

                            // Calculate number of days since post date
                            $post_timestamp = get_the_time('U');
                            $current_timestamp = current_time('timestamp');
                            $diff_days = floor(($current_timestamp - $post_timestamp) / DAY_IN_SECONDS);
                            $date_text = ($diff_days < 1) ? 'امروز' : $diff_days . ' روز پیش';

                            // Job-specific fields
                            $job_location = get_post_field('job_location', $post_id);
                            $job_type = get_field('job_type');
                            $job_experience = get_field('job_experience');
                            ?>

                            <!-- Job card for desktop view -->
                            <div class="card shadow-sm border-0 mb-3">
                                <div class="card-body d-flex gap-3 align-items-start">
                                    <!-- Company logo -->
                                    <img src="<?= esc_url($logo_url); ?>" alt="لوگوی <?= esc_attr($employer_nick); ?>"
                                        class="rounded object-fit-cover" width="48" height="48">

                                    <div class="flex-grow-1">
                                        <!-- Job title with permalink -->
                                        <h6 class="fw-bold mb-1">
                                            <a class="text-reset text-decoration-none" href="<?= get_permalink(); ?>">
                                                <?= esc_html(get_the_title()); ?>
                                            </a>
                                        </h6>

                                        <!-- Employer name and location -->
                                        <p class="text-muted small mb-1">
                                            <?= esc_html($employer_nick . ' . ' . $job_location); ?>
                                        </p>

                                        <!-- Job type and experience badges -->
                                        <div class="d-flex flex-wrap gap-2 mb-2">
                                            <?php if ($job_type): ?>
                                                <span class="badge bg-light text-dark"><?= esc_html($job_type); ?></span>
                                            <?php endif; ?>
                                            <span class="badge bg-light text-dark">
                                                <?= $job_experience
                                                    ? ' حداقل ' . esc_html($job_experience) . ' سال تجربه'
                                                    : 'بدون نیاز به تجربه مرتبط'; ?>
                                            </span>
                                        </div>

                                        <!-- Relative post date -->
                                        <p class="text-muted small mb-0"><?= esc_html($date_text); ?></p>
                                    </div>
                                </div>
                            </div>

                        <?php endwhile; endif;
                    wp_reset_postdata(); ?>
                </div> <!-- End desktop cards wrapper -->

                <!-- Render job carousel for mobile view -->
                <?php if ($job_cards->have_posts()): ?>
                    <div class="d-lg-none mt-4">
                        <h6 class="fw-bold mb-3">شغل‌های مشابه</h6>

                        <!-- Bootstrap carousel -->
                        <div id="similarJobsCarousel" class="carousel slide" data-bs-ride="carousel"
                            data-bs-interval="5000">
                            <div class="carousel-inner">
                                <?php
                                $first = true;
                                while ($job_cards->have_posts()):
                                    $job_cards->the_post();

                                    // Get employer and job details
                                    $post_id = get_the_ID();
                                    $employer_id = get_post_field('post_author', $post_id);
                                    $employer_nick = get_user_meta($employer_id, 'nickname', true)
                                        ?: get_the_author_meta('display_name', $employer_id);
                                    $employer_logo = get_field('company_logo', 'user_' . $employer_id);
                                    $logo_url = $employer_logo ?: get_template_directory_uri() . '/assets/photo/placeholder.png';
                                    $diff_days = floor((current_time('timestamp') - get_the_time('U')) / DAY_IN_SECONDS);
                                    $date_text = ($diff_days < 1) ? 'امروز' : $diff_days . ' روز پیش';
                                    $job_location = get_post_field('job_location', $post_id);
                                    $job_type = get_field('job_type');
                                    $job_experience = get_field('job_experience');
                                    ?>

                                    <!-- Single carousel slide -->
                                    <div class="carousel-item <?= $first ? 'active' : '' ?>">
                                        <div class="card shadow-sm border-0 mx-3">
                                            <div class="card-body d-flex gap-3 align-items-start">
                                                <!-- Logo -->
                                                <img src="<?= esc_url($logo_url); ?>"
                                                    alt="<?= esc_attr($employer_nick); ?> Logo" class="rounded object-fit-cover" width="48"
                                                    height="48">

                                                <!-- Job content -->
                                                <div class="flex-grow-1">
                                                    <a class="text-reset text-decoration-none" href="<?= get_permalink(); ?>">
                                                        <h6 class="fw-bold mb-2"><?= get_the_title(); ?></h6>
                                                    </a>

                                                    <p class="text-muted small mb-3">
                                                        <?= esc_html($employer_nick); ?> · <?= esc_html($job_location); ?>
                                                    </p>

                                                    <div class="d-flex flex-wrap gap-2 mb-2">
                                                        <?php if ($job_type): ?>
                                                            <span
                                                                class="badge bg-light text-dark"><?= esc_html($job_type); ?></span>
                                                        <?php endif; ?>
                                                        <span class="badge bg-light text-dark">
                                                            <?= $job_experience
                                                                ? 'حداقل ' . esc_html($job_experience) . ' سال سابقه کاری مرتبط'
                                                                : 'بدون نیاز به سابقه کاری مرتبط'; ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php $first = false; endwhile;
                                wp_reset_postdata(); ?>
                            </div>

                            <!-- Carousel controls -->
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
                <?php endif; ?>
            </div> <!-- End of row -->
        </div> <!-- End of container -->
</main> <!-- End of main content -->

<?php get_footer(); ?>