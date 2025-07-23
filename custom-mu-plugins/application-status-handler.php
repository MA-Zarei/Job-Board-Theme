<?php

add_action('wp_ajax_update_application_status', 'update_application_status');

function update_application_status() {
  if (!is_user_logged_in()) {
    wp_send_json_error(['message' => 'ابتدا وارد شوید']);
  }

  $app_id     = intval($_POST['application_id']);
  $new_status = sanitize_text_field($_POST['new_status']);

  if (!$app_id || !$new_status) {
    wp_send_json_error(['message' => 'اطلاعات ناقص ارسال شده']);
  }

  $application = get_post($app_id);
  if (!$application || $application->post_type !== 'job_application') {
    wp_send_json_error(['message' => 'درخواست نامعتبر']);
  }

  // می‌تونی اجازه تغییر فقط توسط کارفرمای مرتبط رو اضافه کنی

  update_field('status', $new_status, $app_id);
  wp_send_json_success();
}