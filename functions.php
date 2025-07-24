<?php
if (!defined('ABSPATH')) {
    exit;
}

function theme_enqueue_assets()
{
    wp_enqueue_style(
        'bootstrap-rtl',
        get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.rtl.min.css',
        [],
        null
    );
    wp_enqueue_style(
        'bootstrap-icons',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css',
        [],
        null
    );
    wp_enqueue_style(
        'fonts',
        get_template_directory_uri() . '/assets/css/font.css',
        [],
        null
    );
    if (is_page('صفحه اصلی')) {
        wp_enqueue_style(
            'front-page-styles',
            get_template_directory_uri() . '/assets/css/front-page.css',
            [],
            null
        );
    }
}
add_action('wp_enqueue_scripts', 'theme_enqueue_assets');
add_filter('show_admin_bar', '__return_false');