<?php get_header(); ?>

<!-- Main dashboard container with padding -->
<main class="flex-grow-1">
  <div class="container py-5">

    <!-- Dashboard header -->
    <div class="text-center mb-4">
      <h4 class="fw-bold">داشبورد کارجو</h4>
      <p class="text-muted">مدیریت اطلاعات شخصی و پیگیری درخواست‌ها</p>
    </div>

    <div class="row g-4">

      <!-- User information card (right column) -->
      <div class="col-12 col-lg-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="fw-bold mb-3">اطلاعات کاربری</h5>

            <!-- Display/edit user's name -->
            <div class="mb-2">
              <strong>نام:</strong>
              <span class="text-muted" id="companyNameDisplay">
                <?= esc_html(wp_get_current_user()->display_name); ?>
              </span>
              <input type="text" class="form-control form-control-sm d-none" id="companyNameInput"
                value="<?= esc_attr(wp_get_current_user()->display_name); ?>">
            </div>

            <!-- Display/edit user's email -->
            <div class="mb-2">
              <strong>ایمیل:</strong>
              <span class="text-muted" id="companyEmailDisplay">
                <?= esc_html(wp_get_current_user()->user_email); ?>
              </span>
              <input type="email" class="form-control form-control-sm d-none" id="companyEmailInput"
                value="<?= esc_attr(wp_get_current_user()->user_email); ?>" readonly>
            </div>

            <!-- Display/edit user's phone (ACF field) -->
            <div class="mb-2">
              <strong>شماره تماس:</strong>
              <span class="text-muted" dir="ltr" id="contactNumberDisplay">
                <?= esc_html(get_field('contact_number', 'user_' . get_current_user_id())); ?>
              </span>
              <input type="tel" class="form-control form-control-sm d-none" id="contactNumberInput"
                value="<?= esc_attr(get_field('contact_number', 'user_' . get_current_user_id())); ?>">
            </div>

            <!-- Action button to edit user info -->
            <div class="text-center mt-3">
              <a href="#" class="btn btn-outline-primary btn-sm w-100">ویرایش اطلاعات</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Applications & Tabs section (left column) -->
      <div class="col-12 col-lg-8">
        <?php
        // Load current user's job applications
        $current_user_id = get_current_user_id();
        $applications = get_posts([
          'post_type' => 'job_application',
          'post_status' => 'publish',
          'numberposts' => -1,
          'meta_query' => [
            [
              'key' => 'jobseeker_id',
              'value' => $current_user_id,
              'compare' => '=',
            ],
          ],
        ]);

        // Get status choices from ACF field (for tab generation)
        $all_statuses = acf_get_field('status')['choices'] ?? [];

        // Generate tab ID from status slug
        function status_slug($text)
        {
          return 'tab-' . sanitize_title($text);
        }

        // Assign bootstrap badge class based on status label
        function status_badge_class($status)
        {
          return match ($status) {
            'تایید شده' => 'bg-success text-white',
            'رد شده' => 'bg-danger text-white',
            'در حال بررسی' => 'bg-warning text-dark',
            default => 'bg-secondary text-white'
          };
        }
        ?>

        <!-- Application status navigation tabs -->
        <ul class="nav nav-pills mb-3" id="applicationTabs">
          <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#tab-all">همه</button>
          </li>
          <?php foreach ($all_statuses as $value => $label): ?>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="pill" data-bs-target="#<?= status_slug($value) ?>">
                <?= esc_html($label) ?>
              </button>
            </li>
          <?php endforeach; ?>
        </ul>

        <!-- Tab content panels -->
        <div class="tab-content">

          <!-- All applications tab -->
          <div class="tab-pane fade show active" id="tab-all">
            <?php if ($applications): ?>
              <div class="table-responsive">
                <table class="table table-sm table-bordered text-nowrap">
                  <thead class="table-light">
                    <tr>
                      <th>عنوان آگهی - شرکت</th>
                      <th>تاریخ ارسال</th>
                      <th>رزومه</th>
                      <th>وضعیت</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($applications as $app):
                      $job_id = get_field('job_id', $app->ID);
                      $job_title = get_the_title($job_id);
                      $employer_id = get_post_field('post_author', $job_id);
                      $employer_name = get_user_meta($employer_id, 'nickname', true)
                        ?: get_the_author_meta('display_name', $employer_id);
                      $submission_date = get_field('submission_date', $app->ID);
                      $resume_id = get_field('resume_file', $app->ID);
                      $resume_url = $resume_id ? wp_get_attachment_url($resume_id) : '';
                      $status = get_field('status', $app->ID);
                      $status_class = status_badge_class($status);
                      ?>
                      <tr>
                        <!-- Job title and employer -->
                        <td><?= esc_html($job_title) ?> - <span class="text-muted"><?= esc_html($employer_name) ?></span>
                        </td>

                        <!-- Submission date -->
                        <td><?= esc_html($submission_date ?: '—') ?></td>

                        <!-- Resume download link -->
                        <td>
                          <?php if ($resume_url): ?>
                            <a href="<?= esc_url($resume_url) ?>" class="text-primary text-decoration-none"
                              target="_blank">دانلود</a>
                          <?php else: ?>
                            <span class="text-muted">رزومه موجود نیست</span>
                          <?php endif; ?>
                        </td>

                        <!-- Status badge -->
                        <td>
                          <span class="px-2 py-1 rounded-pill small <?= $status_class ?>">
                            <?= esc_html($status ?: 'تعیین نشده') ?>
                          </span>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            <?php else: ?>
              <!-- No applications alert -->
              <div class="alert alert-info">درخواستی ثبت نشده است.</div>
            <?php endif; ?>
          </div>

          <!-- Status-specific tabs -->
          <?php foreach ($all_statuses as $value => $label): ?>
            <div class="tab-pane fade" id="<?= status_slug($value) ?>">
              <?php
              // Filter applications by status
              $filtered_apps = array_filter($applications, fn($app) => get_field('status', $app->ID) === $value);
              ?>
              <?php if ($filtered_apps): ?>
                <div class="table-responsive">
                  <table class="table table-sm table-bordered text-nowrap">
                    <thead class="table-light">
                      <tr>
                        <th>عنوان آگهی - شرکت</th>
                        <th>تاریخ ارسال</th>
                        <th>رزومه</th>
                        <th>وضعیت</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($filtered_apps as $app):
                        $job_id = get_field('job_id', $app->ID);
                        $job_title = get_the_title($job_id);
                        $employer_id = get_post_field('post_author', $job_id);
                        $employer_name = get_user_meta($employer_id, 'nickname', true)
                          ?: get_the_author_meta('display_name', $employer_id);
                        $submission_date = get_field('submission_date', $app->ID);
                        $resume_id = get_field('resume_file', $app->ID);
                        $resume_url = $resume_id ? wp_get_attachment_url($resume_id) : '';
                        $status_class = status_badge_class($value);
                        ?>
                        <tr>
                          <td><?= esc_html($job_title) ?> - <span class="text-muted"><?= esc_html($employer_name) ?></span>
                          </td>
                          <td><?= esc_html($submission_date ?: '—') ?></td>
                          <td>
                            <?php if ($resume_url): ?>
                              <a href="<?= esc_url($resume_url) ?>" class="text-primary text-decoration-none"
                                target="_blank">دانلود</a>
                            <?php else: ?>
                              <span class="text-muted">رزومه موجود نیست</span>
                            <?php endif; ?>
                          </td>
                          <td>
                            <span class="px-2 py-1 rounded-pill small <?= $status_class ?>">
                              <?= esc_html($value) ?>
                            </span>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              <?php else: ?>
                <!-- Alert if no applications match this status -->
                <div class="alert alert-warning">
                  درخواستی با وضعیت «<?= esc_html($label) ?>» ثبت نشده است.
                </div>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div> <!-- End tab-content -->
      </div> <!-- End col-lg-8 -->
    </div> <!-- End row -->
  </div> <!-- End container -->
</main>

<?php get_footer(); ?>