<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF8">
    <title> سایت کاریابی</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"
        href="<?php echo get_template_directory_uri(); ?>/assets/bootstrap/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nouislider@15.7.0/dist/nouislider.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>./assets/css/font.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>./assets/css/front-page.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <?php get_header(); ?>
    <main class="flex-grow-1">
        <div class="container-fluid">
            <div class="row">
                <!-- main container -->
                <div class="main-content bg-light text-white col-12 col-md-9">
                    <!-- search fields - desktop-->
                    <div class="container my-4">
                        <form method="get" class="d-flex flex-column flex-md-row gap-3 mt-4">
                            <div class="position-relative flex-grow-1">
                                <input type="text" name="name_search" class="form-control pe-5"
                                    placeholder="عنوان شغلی، مهارت یا ..."
                                    value="<?php echo esc_attr($_GET['name_search'] ?? ''); ?>" />
                                <span class="position-absolute top-50 end-0 translate-middle-y pe-2 text-muted">
                                    <i class="bi bi-search"></i>
                                </span>
                            </div>
                            <div class="position-relative flex-grow-1 test">
                                <select name="location" class="form-select select2 ps-3" dir="rtl"
                                    data-placeholder="همه استان‌ها">
                                    <option>همه استان‌ها</option>
                                    <?php
                                    $all_locations = acf_get_field('job_location');
                                    foreach ($all_locations['choices'] as $value => $label) {
                                        ?>
                                        <option value="<?php echo $value ?>" <?php echo ($_GET['location'] ?? '') === $label ? 'selected' : ''; ?>><?php echo $label ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="position-relative flex-grow-1">
                                <select name="category" class="form-select select2 pe-3"
                                    data-placeholder="همه دسته‌بندی‌ها">
                                    <option>همه دسته‌بندی‌ها</option>
                                    <?php
                                    $all_locations = acf_get_field('job_category');
                                    foreach ($all_locations['choices'] as $value => $label) {
                                        ?>
                                        <option value="<?php echo $value ?>" <?php echo ($_GET['category'] ?? '') === $label ? 'selected' : ''; ?>><?php echo $label ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">جستجو</button>
                            <?php
                            $has_active_filters =
                                !empty($_GET['name_search']) ||
                                (!empty($_GET['location']) && $_GET['location'] !== 'همه استان‌ها') ||
                                (!empty($_GET['category']) && $_GET['category'] !== 'همه دسته‌بندی‌ها');
                            if ($has_active_filters) {
                                ?>
                                <button type="button" class="btn btn-secondary"
                                    onclick="window.location.href='<?php echo esc_url(get_permalink()); ?>'">
                                    پاک کردن فیلترها
                                </button>
                                <?php
                            }
                            ?>
                        </form>
                    </div>
                    <button class="btn btn-primary d-md-none w-100 mb-3" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#sidebarOffcanvas">
                        فیلترها
                    </button>
                    <!-- cards container-->
                    <div class="row g-3 justify-content-start">
                        <!-- card -->
                        <?php
                        $filters = [
                            'name_search' => $_GET['name_search'] ?? '',
                            'location' => $_GET['location'] ?? '',
                            'category' => $_GET['category'] ?? '',
                            'job_type' => $_GET['job_type'] ?? [],
                            'salary_type' => $_GET['job_salary'] ?? [],
                        ];
                        $meta_query = [];
                        $single_fields = [
                            'location' => 'job_location',
                            'category' => 'job_category',
                        ];
                        foreach ($single_fields as $key => $meta_key) {
                            $value = $filters[$key] ?? '';
                            if (!empty($value) && $value !== 'همه استان‌ها' && $value !== 'همه دسته‌بندی‌ها') {
                                $meta_query[] = [
                                    'key' => $meta_key,
                                    'value' => $value,
                                    'compare' => '='
                                ];
                            }
                        }
                        $multi_fields = [
                            'job_type' => 'job_type',
                        ];
                        foreach ($multi_fields as $key => $meta_key) {
                            $values = $filters[$key];
                            if (!empty($values) && is_array($values)) {
                                $group = ['relation' => 'OR'];
                                foreach ($values as $val) {
                                    $group[] = [
                                        'key' => $meta_key,
                                        'value' => $val,
                                        'compare' => 'LIKE'
                                    ];
                                }
                                $meta_query[] = $group;
                            }
                        }
                        $salary_ranges = [
                            '5' => ['min' => 5, 'max' => 10],
                            '10' => ['min' => 10, 'max' => 15],
                            '15' => ['min' => 15, 'max' => 20],
                            '20' => ['min' => 20, 'max' => 25],
                            '25' => ['min' => 25, 'max' => 30],
                            '30' => ['min' => 30, 'max' => 35],
                            '35' => ['min' => 35, 'max' => null],
                        ];
                        $salary_selected = $_GET['job_salary'] ?? [];
                        $salary_query = ['relation' => 'OR'];
                        foreach ($salary_selected as $key) {
                            if (isset($salary_ranges[$key])) {
                                $min = $salary_ranges[$key]['min'];
                                $max = $salary_ranges[$key]['max'];
                                $salary_query[] = $max
                                    ? ['key' => 'job_salary', 'value' => [$min, $max], 'type' => 'NUMERIC', 'compare' => 'BETWEEN']
                                    : ['key' => 'job_salary', 'value' => $min, 'type' => 'NUMERIC', 'compare' => '>='];
                            }
                        }
                        if (count($salary_query) > 1) {
                            $meta_query[] = $salary_query;
                        }
                        $paged = get_query_var('paged') ?: get_query_var('page') ?: 1;
                        $job_posts = [
                            'post_type' => 'job',
                            'posts_per_page' => 12,
                            'paged' => $paged,
                            'orderby' => 'date',
                            'order' => 'DESC',
                        ];
                        if (!empty($filters['name_search'])) {
                            $job_posts['s'] = sanitize_text_field($filters['name_search']);
                        }
                        if (!empty($meta_query)) {
                            $job_posts['meta_query'] = $meta_query;
                        }
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
                                <div class="col-12 col-sm-6 col-xl-3">
                                    <div class="card h-100 shadow-sm">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <div>
                                                    <h6 class="fw-bold mb-1"><?php echo get_the_title() ?></h6>
                                                    <small
                                                        class="text-muted"><?php echo get_the_author() . ' . ' . get_field('job_category') ?>
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-wrap mb-3">
                                                <div class="d-flex gap-2 w-100">
                                                    <span
                                                        class="badge bg-light text-dark"><?php echo get_field('job_location'); ?></span>
                                                    <span
                                                        class="badge bg-light text-dark"><?php echo get_field('job_type'); ?></span>
                                                </div>
                                                <div class="w-100 mt-2">
                                                    <span class="badge bg-light text-dark">
                                                        <?php echo 'حداقل سابقه مرتبط: ' . get_field('job_experience'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <p class="text-muted small mb-2"><?php echo $date_text; ?></p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="fw-bold text-primary">
                                                    <?php
                                                    if (get_field('job_salary')) {
                                                        echo get_field('job_salary') . ' میلیون تومان';
                                                    } else {
                                                        echo 'توافقی';
                                                    }
                                                    ?>
                                                </span>
                                                <a href="<?php echo get_permalink(); ?>" class="btn btn-primary btn-sm">
                                                    ارسال درخواست
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        } else { ?>
                            <div class="col-12">
                                <div class="alert alert-warning text-center border-0 shadow-sm">
                                    <div class="d-flex flex-column align-items-center gap-2">
                                        <i class="bi bi-search text-warning fs-3"></i>
                                        <div>
                                            <strong>نتیجه‌ای مطابق با فیلترهای شما یافت نشد.</strong>
                                            <p class="mb-0 small text-muted">لطفاً تنظیمات فیلتر را بررسی یا تغییر دهید و
                                                دوباره تلاش کنید.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        ?>
                        <?php
                        $total_pages = $job_cards->max_num_pages;
                        $current_page = max(1, get_query_var('paged'));
                        if ($total_pages > 1) {
                            echo '<nav aria-label="Page navigation">';
                            echo '<ul class="pagination justify-content-center">';

                            for ($i = 1; $i <= $total_pages; $i++) {
                                $active = ($i == $paged) ? 'active' : '';
                                echo '<li class="page-item ' . $active . '">';
                                echo '<a class="page-link" href="' . get_pagenum_link($i) . '">' . $i . '</a>';
                                echo '</li>';
                            }
                            echo '</ul>';
                            echo '</nav>';
                        }
                        ?>
                    </div>
                </div>
                <!-- desktop sidebar -->
                <div class="sidebar d-none d-md-block bg-light p-3 col-12 col-md-3">
                    <?php get_template_part('template-parts/job-filter-form'); ?>
                </div>
            </div>
        </div>
        </div>
    </main>

    <!-- Mobile sidebar (offcanvas) -->
    <div class="offcanvas offcanvas-start offcanvas-md" tabindex="-1" id="sidebarOffcanvas"
        aria-labelledby="sidebarLabel">
        <div class="offcanvas-header">
            <!-- <h5 class="offcanvas-title" id="sidebarLabel">فیلترها</h5> -->
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="بستن"></button>
        </div>

        <div class="offcanvas-body px-3"> <!-- فضای داخلی از چپ و راست -->
            <?php get_template_part('template-parts/job-filter-form'); ?>
        </div>
    </div>
    </div>
    <?php get_footer(); ?>

    <!-- Bootstrap JS -->
    <script src="<?php echo get_template_directory_uri(); ?>./assets/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>