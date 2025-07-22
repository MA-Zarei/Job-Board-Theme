<?php
/**
 * Plugin Name: User Auth Logic
 * Description: Handles login and registration for jobseeker and employer roles.
 */

add_action('init', 'handle_custom_auth');

function handle_custom_auth() {
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;

  if (isset($_POST['jobseeker_register_submit'])) {
    handle_jobseeker_register();
  }

  if (isset($_POST['employer_register_submit'])) {
    handle_employer_register();
  }

  if (isset($_POST['login_submit'])) {
    handle_user_login();
  }
}

function handle_jobseeker_register() {
  $email      = sanitize_email($_POST['email']);
  $password   = sanitize_text_field($_POST['password']);
  $first_name = sanitize_text_field($_POST['first_name']);
  $last_name  = sanitize_text_field($_POST['last_name']);
  $phone      = sanitize_text_field($_POST['phone']);

  if (username_exists($email) || email_exists($email)) {
    set_transient('register_error', 'ایمیل وارد‌شده قبلاً ثبت شده است.', 10);
    return;
  }

  $user_id = wp_create_user($email, $password, $email);

  wp_update_user([
    'ID'           => $user_id,
    'role'         => 'jobseeker',
    'first_name'   => $first_name,
    'last_name'    => $last_name,
    'nickname'     => "$first_name $last_name",
    'display_name' => "$first_name $last_name"
  ]);

  update_field('contact_number', $phone, "user_$user_id");

  wp_signon([
    'user_login'    => $email,
    'user_password' => $password,
    'remember'      => true
  ]);

  wp_redirect(home_url('/'));
  exit;
}

function handle_employer_register() {
  $email   = sanitize_email($_POST['email']);
  $password= sanitize_text_field($_POST['password']);
  $company = sanitize_text_field($_POST['company']);
  $address = sanitize_text_field($_POST['address']);
  $phone   = sanitize_text_field($_POST['phone']);
  $logo    = $_FILES['logo'];

  if (username_exists($email) || email_exists($email)) {
    set_transient('register_error', 'این ایمیل قبلاً در سایت ثبت شده است.', 10);
    return;
  }

  $user_id = wp_create_user($email, $password, $email);

  wp_update_user([
    'ID'           => $user_id,
    'role'         => 'employer',
    'first_name'   => $company,
    'nickname'     => $company,
    'display_name' => $company
  ]);

  update_field('contact_number', $phone, "user_$user_id");
  update_field('company_address', $address, "user_$user_id");

  if (!empty($logo['name'])) {
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/media.php');
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attachment_id = media_handle_upload('logo', 0);
    if (!is_wp_error($attachment_id)) {
      update_field('company_logo', $attachment_id, "user_$user_id");
    }
  }

  wp_signon([
    'user_login'    => $email,
    'user_password' => $password,
    'remember'      => true
  ]);

  wp_redirect(home_url('/'));
  exit;
}

function handle_user_login() {
  $email    = sanitize_email($_POST['email']);
  $password = $_POST['password'];

  if (empty($email) || empty($password)) {
    set_transient('login_error', 'ایمیل و رمز عبور را کامل وارد کنید.', 10);
    return;
  }

  $user = wp_signon([
    'user_login'    => $email,
    'user_password' => $password,
    'remember'      => true
  ]);

  if (is_wp_error($user)) {
    set_transient('login_error', 'ایمیل یا رمز عبور اشتباه است.', 10);
  } else {
    wp_redirect(home_url('/'));
    exit;
  }
}