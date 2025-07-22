<?php
add_action('wp_login', function ($user_login, $user) {
    $role = $user->roles[0];

    if (in_array($role, ['jobseeker', 'employer'])) {
        wp_redirect(home_url('/'));
        exit;
    }
}, 10, 2);
?>