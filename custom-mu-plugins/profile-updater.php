<?php
/*
Plugin Name: Employer Profile Updater
Description: Handles AJAX requests to update employer profile information.
*/

add_action('wp_ajax_update_user_profile', 'update_user_profile');

function update_user_profile()
{
    if (!is_user_logged_in()) {
        wp_send_json_error(['message' => 'برای انجام این عملیات ابتدا وارد شوید']);
    }

    $user_id = get_current_user_id();
    $company_name = sanitize_text_field($_POST['company_name'] ?? '');
    $contact_number = sanitize_text_field($_POST['contact_number'] ?? '');
    $company_address = sanitize_textarea_field($_POST['company_address'] ?? '');
    $errors = [];

    // اعتبارسنجی
    if (!$company_name) {
        $errors[] = 'نام شرکت نمی‌تواند خالی باشد';
    }

    if (!$contact_number) {
        $errors[] = 'شماره تماس باید وارد شود';
    } elseif (!preg_match('/^\d{8,15}$/', $contact_number)) {
        $errors[] = 'فرمت شماره تماس معتبر نیست';
    }

    if (!$company_address) {
        $errors[] = 'آدرس شرکت باید وارد شود';
    }

    // بررسی لوگو (در صورت وجود)
    $company_logo_url = '';
    if (!empty($_FILES['company_logo']['name'])) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/webp'];
        if (!in_array($_FILES['company_logo']['type'], $allowed_types)) {
            $errors[] = 'فرمت فایل لوگو باید تصویری باشد (jpg، png، webp)';
        }
    }

    if (!empty($errors)) {
        wp_send_json_error(['message' => implode('<br>', $errors)]);
    }

    // ذخیره اطلاعات متنی
    wp_update_user([
        'ID' => $user_id,
        'display_name' => $company_name
    ]);

    update_field('contact_number', $contact_number, 'user_' . $user_id);
    update_field('company_address', $company_address, 'user_' . $user_id);

    // آپلود لوگو (در صورت وجود)
    if (!empty($_FILES['company_logo']['name'])) {
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/media.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';

        $attachment_id = media_handle_upload('company_logo', 0);

        if (!is_wp_error($attachment_id)) {
            update_field('company_logo', $attachment_id, 'user_' . $user_id);
            $company_logo_url = wp_get_attachment_image_url($attachment_id, 'thumbnail');
        }
    } else {
        $existing_logo_id = get_field('company_logo', 'user_' . $user_id);
        if ($existing_logo_id) {
            $company_logo_url = wp_get_attachment_image_url($existing_logo_id, 'thumbnail');
        }
    }

    // ارسال پاسخ موفقیت‌آمیز
    wp_send_json_success([
        'updated' => [
            'contact_number' => $contact_number,
            'company_address' => $company_address,
            'company_logo_url' => $company_logo_url ?? '',
        ]
    ]);
}