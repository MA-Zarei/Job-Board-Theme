<?php
function add_custom_user_roles()
{
    add_role('employer', 'کارفرما', [
        'read' => true,
        'upload_files' => true,
        'edit_job' => true,
        'read_job' => true,
        'delete_job' => true,
        'edit_jobs' => true,
        'publish_jobs' => true,
        'delete_jobs' => true,
        'edit_published_jobs' => true,
        'delete_published_jobs' => true,
    ]);
    add_role('jobseeker', 'کارجو', [
        'read' => true,
    ]);
    $role = get_role('administrator');
    if ($role) {
        $caps = [
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
            'edit_published_jobs'
        ];
        foreach ($caps as $cap) {
            $role->add_cap($cap);
        }
    }
}
add_action('init', 'add_custom_user_roles');
?>