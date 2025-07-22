<?php
function add_custom_user_roles()
{
  // employer role
  add_role('employer', 'کارفرما', [
    'read' => true,
    'upload_files' => true,

    // job post type access capabilities
    'edit_job' => true,
    'read_job' => true,
    'delete_job' => true,
    'edit_jobs' => true,
    'publish_jobs' => true,
    'delete_jobs' => true,
    'edit_published_jobs' => true,
    'delete_published_jobs' => true,

    // job application post type access capabilities
    'read_job_application' => true,
    'edit_job_application' => true // just for status updates
  ]);

  // jobseeker role
  add_role('jobseeker', 'کارجو', [
    'read' => true,
    'read_job_application' => true
  ]);

  // administrator role
  $role = get_role('administrator');
  if ($role) {
    $job_caps = [
      // job post type access capabilities
      'edit_job',
      'read_job',
      'delete_job',
      'edit_jobs',
      'edit_others_jobs',
      'publish_jobs',
      'read_private_jobs',
      'delete_jobs',
      'delete_private_jobs',
      'delete_published_jobs',
      'delete_others_jobs',
      'edit_private_jobs',
      'edit_published_jobs',

      // job application post type access capabilities
      'edit_job_application',
      'read_job_application',
      'delete_job_application',
      'edit_job_applications',
      'edit_others_job_applications',
      'delete_job_applications',
      'delete_others_job_applications',
      'publish_job_applications',
      'read_private_job_applications',
    ];
    foreach ($job_caps as $cap) {
      $role->add_cap($cap);
    }
  }
}
add_action('init', function () {
  $admin = get_role('administrator');
  if ($admin) {
    $caps = [
      'edit_job_application',
      'read_job_application',
      'delete_job_application',
      'edit_job_applications',
      'edit_others_job_applications',
      'delete_job_applications',
      'delete_others_job_applications',
      'publish_job_applications',
      'read_private_job_applications',
    ];
    foreach ($caps as $cap) {
      $admin->add_cap($cap);
    }
  }
});