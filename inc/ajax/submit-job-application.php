<?php
/**
 * Handles AJAX submission of job applications.
 * Creates a new job_application post and uploads resume file.
 */

function handle_job_application() {
    // Require user to be logged in
    if (!is_user_logged_in()) {
        wp_send_json_error(['message' => 'You must be logged in to submit a job application']);
    }

    // Get current user ID and job ID
    $user_id = get_current_user_id();
    $job_id  = intval($_POST['job_id']);
    $file    = $_FILES['resume'];

    /**
     * Check if user has already applied to this job
     */
    $existing = get_posts([
        'post_type'  => 'job_application',
        'meta_query' => [
            ['key' => 'job_id',       'value' => $job_id],
            ['key' => 'jobseeker_id', 'value' => $user_id],
        ],
    ]);

    if (!empty($existing)) {
        wp_send_json_error(['message' => 'You have already submitted an application for this job']);
    }

    /**
     * Create a new job_application post
     */
    $application_id = wp_insert_post([
        'post_type'   => 'job_application',
        'post_title'  => 'Application by ' . get_the_author_meta('nickname', $user_id),
        'post_status' => 'publish',
        'post_author' => $user_id,
    ]);

    /**
     * Upload resume file and attach to post
     */
    require_once ABSPATH . 'wp-admin/includes/file.php';
    $uploaded = wp_handle_upload($file, ['test_form' => false]);

    if (isset($uploaded['error'])) {
        wp_send_json_error(['message' => 'Resume upload failed']);
    }

    // Prepare media attachment
    require_once ABSPATH . 'wp-admin/includes/image.php';

    $attachment = [
        'guid'           => $uploaded['url'],
        'post_mime_type' => $uploaded['type'],
        'post_title'     => sanitize_file_name($uploaded['file']),
        'post_content'   => '',
        'post_status'    => 'inherit',
    ];

    $attachment_id = wp_insert_attachment($attachment, $uploaded['file'], $application_id);

    // Generate attachment metadata
    $attach_data = wp_generate_attachment_metadata($attachment_id, $uploaded['file']);
    wp_update_attachment_metadata($attachment_id, $attach_data);

    /**
     * Save post meta fields
     */
    update_post_meta($application_id, 'job_id',          $job_id);
    update_post_meta($application_id, 'jobseeker_id',    $user_id);
    update_post_meta($application_id, 'resume_file',     $attachment_id); // For ACF relationship
    update_post_meta($application_id, 'submission_date', current_time('Y-m-d'));

    /**
     * Return success response
     */
    wp_send_json_success(['message' => 'Your application has been successfully submitted']);
}