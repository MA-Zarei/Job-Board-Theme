<?php
/*
Plugin Name: Job Post Creator
Description: Handles AJAX request to create job post for employers.
*/

add_action('wp_ajax_submit_job_post', 'submit_job_post');

function submit_job_post()
{
    if (!is_user_logged_in()) {
        wp_send_json_error(['message' => 'ابتدا باید وارد حساب شوید']);
    }

    $user = wp_get_current_user();
    if (!in_array('employer', $user->roles)) {
        wp_send_json_error(['message' => 'فقط کارفرما مجاز به ثبت آگهی است']);
    }

    $title = sanitize_text_field($_POST['job_title'] ?? '');
    $content = sanitize_textarea_field($_POST['job_content'] ?? '');

    if (!$title || !$content) {
        wp_send_json_error(['message' => 'عنوان و شرح آگهی الزامی است']);
    }

    // ساخت پست
    $post_id = wp_insert_post([
        'post_title' => $title,
        'post_content' => $content,
        'post_type' => 'job',
        'post_status' => 'publish', // یا 'draft' اگر خواستی قابل تنظیم باشه
        'post_author' => $user->ID,
    ]);

    if (is_wp_error($post_id)) {
        wp_send_json_error(['message' => 'خطا در ایجاد آگهی']);
    }

    // ذخیره فیلدهای ACF
    $acf_fields = [
        'job_category',
        'job_location',
        'job_type',
        'job_experience',
        'gender',
        'military_status',
        'min_education',
        'job_salary',
        'job_status',
    ];

    foreach ($acf_fields as $field) {
        if (isset($_POST[$field])) {
            $value = sanitize_text_field($_POST[$field]);
            update_field($field, $value, $post_id);
        }
    }

    wp_send_json_success(['message' => 'آگهی با موفقیت ثبت شد']);
}