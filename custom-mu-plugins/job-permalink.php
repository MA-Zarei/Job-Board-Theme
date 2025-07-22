<?php
/*
Plugin Name: Job Permalink by ID
Description: change job post type adress to /job/id/{post_id}
Version: 1.0
*/

function custom_job_permalink($permalink, $post) {
    if ($post->post_type === 'job') {
        return home_url('/job/id/' . $post->ID);
    }
    return $permalink;
}
add_filter('post_type_link', 'custom_job_permalink', 10, 2);

function custom_job_rewrite_rule() {
    add_rewrite_rule(
        '^job/id/([0-9]+)/?$',
        'index.php?post_type=job&p=$matches[1]',
        'top'
    );
}
add_action('init', 'custom_job_rewrite_rule');