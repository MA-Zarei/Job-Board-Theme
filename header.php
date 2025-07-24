<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF8">
    <title>
        <?php
        if (is_page('صفحه اصلی')) {
            $page_title = '';
        } elseif (is_page('login')) {
            $page_title = ' | ثبت نام و ورود';
        } elseif (is_page('jobseeker-dashboard')) {
            $page_title = ' | داشبورد کارفرما';
        } elseif (is_page('employer-dashboard')) {
            $page_title = ' | داشبورد کارجو';
        } elseif (is_single()) {
            $page_title = ' | ' . get_the_title();
        }
        ;
        echo $page_title ? $page_title . ' | ' . bloginfo('name') : bloginfo('name');
        ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php
if (is_page('employer-dashboard')){
    body_class('bg-light d-flex flex-column min-vh-100')    ;
} else{
body_class('d-flex flex-column min-vh-100');
}
?>>
    <nav class="navbar navbar-expand-lg bg-light navbar-light border-bottom shadow-sm  mb-4">
        <div class="container-fluid">
            <a class="navbar-brand ms-2" href="<?php echo get_bloginfo('url'); ?>">
                <?php echo get_bloginfo('name'); ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php
                    if (!is_user_logged_in()) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php
                            $page = get_page_by_path('login');
                            echo get_permalink($page->ID);
                            ?>">
                                ورود / ثبت نام
                            </a>
                        </li>
                    <?php } else {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php
                            $current_user = wp_get_current_user();
                            if (in_array('administrator', $current_user->roles) || in_array('employer', $current_user->roles)) {
                                echo home_url('/employer-dashboard/');
                            } elseif (in_array('jobseeker', $current_user->roles)) {
                                echo home_url('/jobseeker-dashboard/');
                            }
                            ?>">
                                <?php
                                echo wp_get_current_user()->display_name;
                                ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo wp_logout_url(home_url('/')); ?>">
                                خروج
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>