<?php
function register_job_post_type()
{
    $labels = array(
        'name' => 'آگهی‌های شغلی',
        'singular_name' => 'آگهی شغلی',
        'add_new' => 'افزودن آگهی جدید',
        'add_new_item' => 'افزودن آگهی شغلی جدید',
        'edit_item' => 'ویرایش آگهی شغلی',
        'new_item' => 'آگهی شغلی جدید',
        'all_items' => 'همه آگهی‌ها',
        'view_item' => 'مشاهده آگهی',
        'search_items' => 'جستجوی آگهی',
        'not_found' => 'یافت نشد',
        'menu_name' => 'آگهی‌های شغلی',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-media-document',
        'supports' => array('title', 'editor', 'custom-fields'),
        'show_in_rest' => false,
        'capabilities' => [
            'edit_post' => 'edit_job',
            'read_post' => 'read_job',
            'delete_post' => 'delete_job',
            'edit_posts' => 'edit_jobs',
            'edit_others_posts' => 'edit_others_jobs',
            'publish_posts' => 'publish_jobs',
            'read_private_posts' => 'read_private_jobs',
            'delete_posts' => 'delete_jobs',
            'delete_private_posts' => 'delete_private_jobs',
            'delete_published_posts' => 'delete_published_jobs',
            'delete_others_posts' => 'delete_others_jobs',
            'edit_private_posts' => 'edit_private_jobs',
            'edit_published_posts' => 'edit_published_jobs',
        ],
    );

    register_post_type('job', $args);
}
add_action('init', 'register_job_post_type');
?>