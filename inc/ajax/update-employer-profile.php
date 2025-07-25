<?php
/**
 * Handles employer profile update via AJAX.
 * Validates input data, processes company logo upload, and updates ACF fields.
 */

// Main handler function (does NOT register the AJAX hook here)
function update_user_profile() {
    // Verify authentication
    if (!is_user_logged_in()) {
        wp_send_json_error(['message' => 'You must be logged in to perform this action']);
    }

    // Get current user ID
    $user_id         = get_current_user_id();
    $company_name    = sanitize_text_field($_POST['company_name'] ?? '');
    $contact_number  = sanitize_text_field($_POST['contact_number'] ?? '');
    $company_address = sanitize_textarea_field($_POST['company_address'] ?? '');
    $errors          = [];
    $company_logo_url = '';

    /**
     * Validate form inputs
     */
    if (!$company_name) {
        $errors[] = 'Company name is required';
    }

    if (!$contact_number) {
        $errors[] = 'Contact number is required';
    } elseif (!preg_match('/^\d{8,15}$/', $contact_number)) {
        $errors[] = 'Invalid contact number format';
    }

    if (!$company_address) {
        $errors[] = 'Company address is required';
    }

    // Validate company logo file (if uploaded)
    if (!empty($_FILES['company_logo']['name'])) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/webp'];
        if (!in_array($_FILES['company_logo']['type'], $allowed_types)) {
            $errors[] = 'Logo must be an image file (jpg, png, webp)';
        }
    }

    // Return validation errors (if any)
    if (!empty($errors)) {
        wp_send_json_error(['message' => implode('<br>', $errors)]);
    }

    /**
     * Update user meta & ACF fields
     */
    wp_update_user([
        'ID'           => $user_id,
        'display_name' => $company_name,
    ]);

    update_field('contact_number', $contact_number, 'user_' . $user_id);
    update_field('company_address', $company_address, 'user_' . $user_id);

    /**
     * Upload and attach company logo
     */
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

    /**
     * Return success response with updated data
     */
    wp_send_json_success([
        'updated' => [
            'contact_number'     => $contact_number,
            'company_address'    => $company_address,
            'company_logo_url'   => $company_logo_url ?? '',
        ]
    ]);
}