<?php
/**
 * Plugin Name: Job Applications Post Type
 * Description: Custom post type for managing job applications sent by jobseekers.
 */

add_action('init', 'register_job_application_cpt');

function register_job_application_cpt()
{
    register_post_type('job_application', [
        'labels' => [
            'name' => 'درخواست‌ها',
            'singular_name' => 'درخواست',
            'add_new' => 'افزودن درخواست',
            'edit_item' => 'ویرایش درخواست',
            'new_item' => 'درخواست جدید',
            'view_item' => 'مشاهده درخواست',
            'search_items' => 'جستجوی درخواست',
        ],
        'public' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'job_application',
        'capabilities' => [
            'edit_post' => 'edit_job_application',
            'read_post' => 'read_job_application',
            'delete_post' => 'delete_job_application',
            'edit_posts' => 'edit_job_applications',
            'edit_others_posts' => 'edit_others_job_applications',
            'delete_posts' => 'delete_job_applications',
            'delete_others_posts' => 'delete_others_job_applications',
            'publish_posts' => 'publish_job_applications',
            'read_private_posts' => 'read_private_job_applications',
        ],
        'map_meta_cap' => true,
        'supports' => ['title', 'author', 'custom-fields'],
        'menu_icon' => 'dashicons-clipboard',
        'menu_position' => 25
    ]);
}