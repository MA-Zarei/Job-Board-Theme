<?php
add_action('wp_ajax_submit_job_application', 'handle_job_application');
add_action('wp_ajax_nopriv_submit_job_application', 'handle_job_application');

function handle_job_application()
{
    if (!is_user_logged_in()) {
        wp_send_json_error(['message' => 'برای ارسال درخواست باید وارد حساب شوید']);
    }

    $user_id = get_current_user_id();
    $job_id  = intval($_POST['job_id']);
    $file    = $_FILES['resume'];

    // بررسی تکراری نبودن درخواست
    $existing = get_posts([
        'post_type'  => 'job_application',
        'meta_query' => [
            ['key' => 'job_id',       'value' => $job_id],
            ['key' => 'jobseeker_id', 'value' => $user_id],
        ],
    ]);

    if (!empty($existing)) {
        wp_send_json_error(['message' => 'شما قبلاً برای این آگهی درخواست ارسال کرده‌اید']);
    }

    // ساخت پست درخواست
    $application_id = wp_insert_post([
        'post_type'   => 'job_application',
        'post_title'  => 'درخواست کارجو ' . get_the_author_meta('nickname', $user_id),
        'post_status' => 'publish',
        'post_author' => $user_id,
    ]);

    // آپلود فایل رزومه
    require_once ABSPATH . 'wp-admin/includes/file.php';
    $uploaded = wp_handle_upload($file, ['test_form' => false]);

    if (isset($uploaded['error'])) {
        wp_send_json_error(['message' => 'آپلود فایل ناموفق بود']);
    }

    // ساخت ضمیمه و اتصال به رسانه‌ها
    require_once ABSPATH . 'wp-admin/includes/image.php';

    $attachment = [
        'guid'           => $uploaded['url'],
        'post_mime_type' => $uploaded['type'],
        'post_title'     => sanitize_file_name($uploaded['file']),
        'post_content'   => '',
        'post_status'    => 'inherit',
    ];

    $attachment_id = wp_insert_attachment($attachment, $uploaded['file'], $application_id);

    $attach_data = wp_generate_attachment_metadata($attachment_id, $uploaded['file']);
    wp_update_attachment_metadata($attachment_id, $attach_data);

    // ذخیره فیلدها
    update_post_meta($application_id, 'job_id',          $job_id);
    update_post_meta($application_id, 'jobseeker_id',    $user_id);
    update_post_meta($application_id, 'resume_file',     $attachment_id); // ذخیره آیدی فایل برای ACF
    update_post_meta($application_id, 'submission_date', current_time('Y-m-d'));

    // ارسال موفقیت‌آمیز
    wp_send_json_success(['message' => 'درخواست شما با موفقیت ثبت شد']);
}