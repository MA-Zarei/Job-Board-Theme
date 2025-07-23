<?php
add_action('wp_ajax_update_jobseeker_profile', 'update_jobseeker_profile');

function update_jobseeker_profile() {
  if (!is_user_logged_in()) {
    wp_send_json_error(['message' => 'ابتدا وارد شوید']);
  }

  $user_id = get_current_user_id();
  $name    = sanitize_text_field($_POST['display_name'] ?? '');
  $phone   = sanitize_text_field($_POST['contact_number'] ?? '');

  if (!$name) {
    wp_send_json_error(['message' => 'نام نمی‌تواند خالی باشد']);
  }

  wp_update_user([
    'ID'           => $user_id,
    'display_name' => $name,
  ]);

  update_field('contact_number', $phone, 'user_' . $user_id);

  wp_send_json_success();
}