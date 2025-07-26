<?php
if (!defined('ABSPATH')) {
    exit;
}

function theme_enqueue_assets()
{
    wp_enqueue_style(
        'bootstrap-rtl',
        get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.rtl.min.css',
        [],
        null
    );
    wp_enqueue_style(
        'bootstrap-icons',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css',
        [],
        null
    );
    wp_enqueue_style(
        'fonts',
        get_template_directory_uri() . '/assets/css/font.css',
        [],
        null
    );
    wp_enqueue_style(
        'fonts-set',
        get_template_directory_uri() . '/assets/css/styles.css',
        [],
        null
    );
    if (is_page('صفحه اصلی')) {
        wp_enqueue_style(
            'front-page-styles',
            get_template_directory_uri() . '/assets/css/front-page.css',
            [],
            null
        );
    }
}
add_action('wp_enqueue_scripts', 'theme_enqueue_assets');
add_filter('show_admin_bar', '__return_false');

function theme_enqueue_scripts()
{
    wp_enqueue_script(
        'bootstrap-bundle',
        get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.bundle.min.js',
        [],
        null,
        true
    );
    if (is_page('login')) {
        wp_enqueue_script(
            'toast',
            get_template_directory_uri() . '/assets/js/toast.js',
            [],
            null,
            true
        );
    }
    if (is_page('employer-dashboard')) {
        wp_enqueue_script(
            'edit-profile',
            get_template_directory_uri() . '/assets/js/edit-profile.js',
            [],
            null,
            true
        );
        wp_enqueue_script(
            'create-job',
            get_template_directory_uri() . '/assets/js/create-job.js',
            [],
            null,
            true
        );
        wp_enqueue_script(
            'manage-job',
            get_template_directory_uri() . '/assets/js/manage-job.js',
            [],
            null,
            true
        );
        wp_enqueue_script(
            'application-status',
            get_template_directory_uri() . '/assets/js/application-status.js',
            [],
            null,
            true
        );
    }
    if (is_page('jobseeker-dashboard')) {
        wp_enqueue_script(
            'edit-jobseeker-profile',
            get_template_directory_uri() . '/assets/js/edit-jobseeker-profile.js',
            [],
            null,
            true
        );
    }
    if (is_singular('job')) {
        wp_enqueue_script(
            'resume-upload',
            get_template_directory_uri() . '/assets/js/upload resume.js',
            [],
            null,
            true
        );
        wp_add_inline_script(
            'resume-upload',
            'window.jobPostID = ' . get_the_ID() . ';'
        );
    }
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');


// Hook into template_redirect to intercept page access
add_action('template_redirect', function () {
    // Apply guest redirect only on dashboard pages, not globally
    if (!is_user_logged_in() && is_page(['employer-dashboard', 'jobseeker-dashboard'])) {
        wp_redirect(home_url());
        exit;
    }

    // Proceed with role-based restrictions for logged-in users
    if (is_user_logged_in() && is_page(['employer-dashboard', 'jobseeker-dashboard'])) {
        $user = wp_get_current_user();
        $role = $user->roles[0] ?? '';

        if (is_page('employer-dashboard') && $role !== 'employer') {
            wp_redirect(home_url());
            exit;
        }

        if (is_page('jobseeker-dashboard') && $role !== 'jobseeker') {
            wp_redirect(home_url());
            exit;
        }
    }
});


/**
 * Register AJAX handler for updating job application status
 */
add_action('wp_ajax_update_application_status', 'update_application_status');
function update_application_status()
{
    // Ensure user is logged in
    if (!is_user_logged_in()) {
        wp_send_json_error(['message' => 'ابتدا وارد شوید']);
    }
    // Sanitize input values
    $app_id = intval($_POST['application_id']);
    $new_status = sanitize_text_field($_POST['new_status']);
    // Validate input
    if (!$app_id || !$new_status) {
        wp_send_json_error(['message' => 'اطلاعات ناقص ارسال شده']);
    }
    // Retrieve the application post
    $application = get_post($app_id);
    // Validate post type
    if (!$application || $application->post_type !== 'job_application') {
        wp_send_json_error(['message' => 'درخواست نامعتبر']);
    }
    // Update status field using ACF
    update_field('status', $new_status, $app_id);
    // Send success response
    wp_send_json_success();
}


// Hook into wp_login to perform redirection based on user role
add_action('wp_login', function ($user_login, $user) {
    // Get the user's primary role
    $role = $user->roles[0] ?? '';
    // Redirect jobseekers and employers to homepage after login
    if (in_array($role, ['jobseeker', 'employer'])) {
        wp_redirect(home_url('/'));
        exit;
    }
}, 10, 2);


/**
 * Define custom user roles and capabilities
 */
function add_custom_user_roles()
{
    // Create 'employer' role with specific capabilities
    add_role('employer', 'کارفرما', [
        'read' => true,
        'upload_files' => true,
        // Capabilities for 'job' post type
        'edit_job' => true,
        'read_job' => true,
        'delete_job' => true,
        'edit_jobs' => true,
        'publish_jobs' => true,
        'delete_jobs' => true,
        'edit_published_jobs' => true,
        'delete_published_jobs' => true,
        // Limited access to 'job_application' post type
        'read_job_application' => true,
        'edit_job_application' => true // for updating application status only
    ]);
    // Create 'jobseeker' role with read-only access
    add_role('jobseeker', 'کارجو', [
        'read' => true,
        'read_job_application' => true
    ]);
    // Add extended capabilities to 'administrator'
    $role = get_role('administrator');
    if ($role) {
        $job_caps = [
            // Full access to 'job' post type
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

            // Full access to 'job_application' post type
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

        // Apply each capability to administrator
        foreach ($job_caps as $cap) {
            $role->add_cap($cap);
        }
    }
}
/**
 * Ensure admin always has full application access on init
 * (Redundant safeguard for plugin reloads or theme switches)
 */
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


/**
 * Plugin Name: Job Applications Post Type
 * Description: Custom post type for managing job applications sent by jobseekers.
 */
// Register custom post type on 'init' hook
add_action('init', 'register_job_application_cpt');
function register_job_application_cpt()
{
    register_post_type('job_application', [
        'labels' => [
            // Admin panel labels (Persian localization)
            'name' => 'درخواست‌ها',
            'singular_name' => 'درخواست',
            'add_new' => 'افزودن درخواست',
            'edit_item' => 'ویرایش درخواست',
            'new_item' => 'درخواست جدید',
            'view_item' => 'مشاهده درخواست',
            'search_items' => 'جستجوی درخواست',
        ],
        // CPT visibility and query access
        'public' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        // Set up granular capabilities (mapped below)
        'capability_type' => 'job_application',
        'capabilities' => [
            // Singular capabilities
            'edit_post' => 'edit_job_application',
            'read_post' => 'read_job_application',
            'delete_post' => 'delete_job_application',
            // Plural/group capabilities
            'edit_posts' => 'edit_job_applications',
            'edit_others_posts' => 'edit_others_job_applications',
            'delete_posts' => 'delete_job_applications',
            'delete_others_posts' => 'delete_others_job_applications',
            'publish_posts' => 'publish_job_applications',
            'read_private_posts' => 'read_private_job_applications',
        ],
        // Enable automatic mapping to user capabilities
        'map_meta_cap' => true,
        // Supported post fields
        'supports' => ['title', 'author', 'custom-fields'],
        // Admin UI settings
        'menu_icon' => 'dashicons-clipboard',
        'menu_position' => 25
    ]);
}


/*
Description: Change job post type URL to use /job/id/{post_id}
*/
// Filter to modify the job permalink structure
function custom_job_permalink($permalink, $post)
{
    // Check if post type is 'job'
    if ($post->post_type === 'job') {
        // Return custom permalink using ID
        return home_url('/job/id/' . $post->ID);
    }
    return $permalink;
}
add_filter('post_type_link', 'custom_job_permalink', 10, 2);
// Add rewrite rule to interpret custom job URLs correctly
function custom_job_rewrite_rule()
{
    add_rewrite_rule(
        '^job/id/([0-9]+)/?$',
        'index.php?post_type=job&p=$matches[1]',
        'top'
    );
}
add_action('init', 'custom_job_rewrite_rule');


/*
Handles AJAX request to create job post for employers.
*/
// Register AJAX handler for job post creation
add_action('wp_ajax_submit_job_post', 'submit_job_post');
function submit_job_post()
{
    // Reject unauthenticated users
    if (!is_user_logged_in()) {
        wp_send_json_error(['message' => 'ابتدا باید وارد حساب شوید']);
    }
    $user = wp_get_current_user();
    // Only allow users with 'employer' role
    if (!in_array('employer', $user->roles)) {
        wp_send_json_error(['message' => 'فقط کارفرما مجاز به ثبت آگهی است']);
    }
    // Sanitize input fields
    $title = sanitize_text_field($_POST['job_title'] ?? '');
    $content = sanitize_textarea_field($_POST['job_content'] ?? '');
    // Basic validation
    if (!$title || !$content) {
        wp_send_json_error(['message' => 'عنوان و شرح آگهی الزامی است']);
    }
    // Create job post
    $post_id = wp_insert_post([
        'post_title' => $title,
        'post_content' => $content,
        'post_type' => 'job',
        'post_status' => 'publish', // You could also use 'draft'
        'post_author' => $user->ID,
    ]);
    // Check for post creation error
    if (is_wp_error($post_id)) {
        wp_send_json_error(['message' => 'خطا در ایجاد آگهی']);
    }
    // Store employer name in ACF field
    $employer_name = $user->nickname ?: $user->display_name;
    update_field('job_auther', $employer_name, $post_id);
    // Update ACF fields from submitted form data
    $acf_fields = [
        'job_category',
        'job_location',
        'job_type',
        'job_experience',
        'gender',
        'military_status',
        'min_education',
        'job_salary',
        'job_status',
    ];
    foreach ($acf_fields as $field) {
        if (isset($_POST[$field])) {
            $value = sanitize_text_field($_POST[$field]);
            update_field($field, $value, $post_id);
        }
    }
    // Return success response
    wp_send_json_success(['message' => 'آگهی با موفقیت ثبت شد']);
}


/**
 * Register Custom Post Type: Job
 */
function register_job_post_type()
{
    // Persian-localized labels for admin interface
    $labels = array(
        'name' => 'آگهی‌های شغلی',
        'singular_name' => 'آگهی شغلی',
        'add_new' => 'افزودن آگهی جدید',
        'add_new_item' => 'افزودن آگهی شغلی جدید',
        'edit_item' => 'ویرایش آگهی شغلی',
        'new_item' => 'آگهی شغلی جدید',
        'all_items' => 'همه آگهی‌ها',
        'view_item' => 'مشاهده آگهی',
        'search_items' => 'جستجوی آگهی',
        'not_found' => 'یافت نشد',
        'menu_name' => 'آگهی‌های شغلی',
    );

    $args = array(
        'labels' => $labels,
        'public' => true, // Enable front-end access
        'has_archive' => false, // Disable default archive
        'menu_icon' => 'dashicons-media-document',
        'supports' => array('title', 'editor', 'custom-fields'),
        'show_in_rest' => false, // Hide from block editor & REST API

        // Custom capability mapping for granular permission control
        'capabilities' => [
            'edit_post' => 'edit_job',
            'read_post' => 'read_job',
            'delete_post' => 'delete_job',
            'edit_posts' => 'edit_jobs',
            'edit_others_posts' => 'edit_others_jobs',
            'publish_posts' => 'publish_jobs',
            'read_private_posts' => 'read_private_jobs',
            'delete_posts' => 'delete_jobs',
            'delete_private_posts' => 'delete_private_jobs',
            'delete_published_posts' => 'delete_published_jobs',
            'delete_others_posts' => 'delete_others_jobs',
            'edit_private_posts' => 'edit_private_jobs',
            'edit_published_posts' => 'edit_published_jobs',
        ],
    );

    // Register 'job' post type
    register_post_type('job', $args);
}
add_action('init', 'register_job_post_type');


// Register AJAX handler to toggle job post status
add_action('wp_ajax_toggle_job_status', 'toggle_job_status');

function toggle_job_status()
{
    // Require authentication
    if (!is_user_logged_in()) {
        wp_send_json_error(['message' => 'ابتدا وارد شوید']);
    }

    // Sanitize and validate inputs
    $job_id = intval($_POST['job_id']);
    $new_status = sanitize_text_field($_POST['new_status']);

    // Ensure valid job ID and allowed status values
    if (
        !$job_id ||
        !in_array($new_status, ['فعال', 'غیرفعال']) // Allowed status values
    ) {
        wp_send_json_error(['message' => 'مقدار نامعتبر']);
    }

    // Load the post and validate access control
    $post = get_post($job_id);
    if (
        !$post ||
        $post->post_type !== 'job' ||
        $post->post_author != get_current_user_id()
    ) {
        wp_send_json_error(['message' => 'دسترسی غیرمجاز']);
    }

    // Update job_status ACF field
    update_field('job_status', $new_status, $job_id);

    // Return success
    wp_send_json_success();
}

// Register AJAX handler for updating jobseeker profile info
add_action('wp_ajax_update_jobseeker_profile', 'update_jobseeker_profile');

function update_jobseeker_profile()
{
    // Ensure user is logged in
    if (!is_user_logged_in()) {
        wp_send_json_error(['message' => 'ابتدا وارد شوید']);
    }

    // Get current user ID
    $user_id = get_current_user_id();

    // Sanitize input data
    $name = sanitize_text_field($_POST['display_name'] ?? '');
    $phone = sanitize_text_field($_POST['contact_number'] ?? '');

    // Validate required fields
    if (!$name) {
        wp_send_json_error(['message' => 'نام نمی‌تواند خالی باشد']);
    }

    // Update WordPress display name
    wp_update_user([
        'ID' => $user_id,
        'display_name' => $name,
    ]);

    // Update ACF field for contact number (stored in user meta)
    update_field('contact_number', $phone, 'user_' . $user_id);

    // Return success response
    wp_send_json_success();
}


// Register AJAX endpoint and include employer profile logic
add_action('wp_ajax_update_user_profile', 'update_user_profile');

// Include the AJAX handler file
require_once get_template_directory() . '/inc/ajax/update-employer-profile.php';


/**
 * AJAX Registration: Job Application Submission
 */
require_once get_template_directory() . '/inc/ajax/submit-job-application.php';
add_action('wp_ajax_submit_job_application', 'handle_job_application');
add_action('wp_ajax_nopriv_submit_job_application', 'handle_job_application');


/**
 * User Authentication: Registration & Login Logic
 * Handles jobseeker and employer registration with auto-login, plus user login flow.
 */

// Listen to POST requests globally via init hook
add_action('init', 'handle_custom_auth');

function handle_custom_auth()
{
    // Process only POST requests
    if ($_SERVER['REQUEST_METHOD'] !== 'POST')
        return;

    // Jobseeker registration
    if (isset($_POST['jobseeker_register_submit'])) {
        handle_jobseeker_register();
    }

    // Employer registration
    if (isset($_POST['employer_register_submit'])) {
        handle_employer_register();
    }

    // Login handler
    if (isset($_POST['login_submit'])) {
        handle_user_login();
    }
}

/**
 * Handles jobseeker registration
 * Creates user with 'jobseeker' role, sets personal info, and auto signs in
 */
function handle_jobseeker_register()
{
    // Sanitize input fields
    $email = sanitize_email($_POST['email']);
    $password = sanitize_text_field($_POST['password']);
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $phone = sanitize_text_field($_POST['phone']);

    // Prevent duplicate accounts
    if (username_exists($email) || email_exists($email)) {
        set_transient('register_error', 'Email already exists.', 10);
        return;
    }

    // Create user
    $user_id = wp_create_user($email, $password, $email);

    // Set user meta and role
    wp_update_user([
        'ID' => $user_id,
        'role' => 'jobseeker',
        'first_name' => $first_name,
        'last_name' => $last_name,
        'nickname' => "$first_name $last_name",
        'display_name' => "$first_name $last_name"
    ]);

    // Save phone number via ACF
    update_field('contact_number', $phone, "user_$user_id");

    // Auto-login user
    wp_signon([
        'user_login' => $email,
        'user_password' => $password,
        'remember' => true
    ]);

    wp_redirect(home_url('/'));
    exit;
}

/**
 * Handles employer registration
 * Stores company data, uploads logo, assigns 'employer' role, and logs in
 */
function handle_employer_register()
{
    // Sanitize inputs
    $email = sanitize_email($_POST['email']);
    $password = sanitize_text_field($_POST['password']);
    $company = sanitize_text_field($_POST['company']);
    $address = sanitize_text_field($_POST['address']);
    $phone = sanitize_text_field($_POST['phone']);
    $logo = $_FILES['logo'];

    // Prevent duplicate registration
    if (username_exists($email) || email_exists($email)) {
        set_transient('register_error', 'Email already exists.', 10);
        return;
    }

    // Create user
    $user_id = wp_create_user($email, $password, $email);

    // Set employer info and role
    wp_update_user([
        'ID' => $user_id,
        'role' => 'employer',
        'first_name' => $company,
        'nickname' => $company,
        'display_name' => $company
    ]);

    // Save company info via ACF
    update_field('contact_number', $phone, "user_$user_id");
    update_field('company_address', $address, "user_$user_id");

    // Upload company logo (if provided)
    if (!empty($logo['name'])) {
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/media.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';

        $attachment_id = media_handle_upload('logo', 0);
        if (!is_wp_error($attachment_id)) {
            update_field('company_logo', $attachment_id, "user_$user_id");
        }
    }

    // Auto-login employer
    wp_signon([
        'user_login' => $email,
        'user_password' => $password,
        'remember' => true
    ]);

    wp_redirect(home_url('/'));
    exit;
}

/**
 * Handles user login
 * Validates credentials and logs in user, sets error transient if login fails
 */
function handle_user_login()
{
    $email = sanitize_email($_POST['email']);
    $password = $_POST['password'];

    // Ensure fields are filled
    if (empty($email) || empty($password)) {
        set_transient('login_error', 'Please enter both email and password.', 10);
        return;
    }

    // Attempt login
    $user = wp_signon([
        'user_login' => $email,
        'user_password' => $password,
        'remember' => true
    ]);

    // Error or success
    if (is_wp_error($user)) {
        set_transient('login_error', 'Incorrect email or password.', 10);
    } else {
        wp_redirect(home_url('/'));
        exit;
    }
}