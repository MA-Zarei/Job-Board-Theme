<?php

add_action('wp_ajax_toggle_job_status', 'toggle_job_status');

function toggle_job_status() {
  if (!is_user_logged_in()) {
    wp_send_json_error(['message' => 'ابتدا وارد شوید']);
  }

  $job_id     = intval($_POST['job_id']);
  $new_status = sanitize_text_field($_POST['new_status']);

  if (!$job_id || !in_array($new_status, ['فعال', 'غیرفعال'])) {
    wp_send_json_error(['message' => 'مقدار نامعتبر']);
  }

  $post = get_post($job_id);
  if (!$post || $post->post_type !== 'job' || $post->post_author != get_current_user_id()) {
    wp_send_json_error(['message' => 'دسترسی غیرمجاز']);
  }

  update_field('job_status', $new_status, $job_id);
  wp_send_json_success();
}