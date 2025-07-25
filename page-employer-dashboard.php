<?php get_header(); ?>
    <main class="flex-grow-1">
        <div class="container py-5">
            <!-- dashboard header -->
            <div class="mb-4 text-center">
                <h4 class="fw-bold">داشبورد کارفرما</h4>
                <p class="text-muted">مدیریت شرکت و آگهی‌های استخدامی</p>
            </div>
            <div class="row g-4">
                <!-- employer specs -->
                <div class="col-12 col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-body" id="profileCard">
                            <div class="d-flex justify-content-between align-items-start gap-3 mb-3">
                                <h5 class="fw-bold mb-0">مشخصات شرکت</h5>
                                <!-- logo -->
                                <div>
                                    <img id="companyLogoPreview"
                                        src="<?= esc_url(get_field('company_logo', 'user_' . get_current_user_id()) ?: get_template_directory_uri() . '/assets/photo/placeholder.png'); ?>"
                                        alt="لوگوی شرکت <?= esc_attr(wp_get_current_user()->display_name); ?>"
                                        class="rounded shadow-sm object-fit-cover"
                                        style="width: 64px; height: 64px; object-fit: cover;" />
                                    <input type="file" id="companyLogoInput"
                                        class="form-control form-control-sm d-none mt-2" accept="image/*" />
                                </div>
                            </div>
                            <!-- company name -->
                            <div class="mb-2">
                                <strong>نام شرکت:</strong>
                                <span class="text-muted"
                                    id="companyNameDisplay"><?= esc_html(wp_get_current_user()->display_name); ?></span>
                                <input type="text" class="form-control form-control-sm d-none" id="companyNameInput"
                                    value="<?= esc_attr(wp_get_current_user()->display_name); ?>">
                            </div>
                            <!-- email -->
                            <div class="mb-2">
                                <strong>ایمیل:</strong>
                                <span class="text-muted"
                                    id="companyEmailDisplay"><?= esc_html(wp_get_current_user()->user_email); ?></span>
                                <input type="email" class="form-control form-control-sm d-none" id="companyEmailInput"
                                    value="<?= esc_attr(wp_get_current_user()->user_email); ?>" readonly>
                            </div>
                            <!-- contact number -->
                            <div class="mb-2">
                                <strong>شماره تماس:</strong>
                                <span class="text-muted" dir="ltr"
                                    id="contactNumberDisplay"><?= esc_html(get_field('contact_number', 'user_' . get_current_user_id())); ?></span>
                                <input type="tel" class="form-control form-control-sm d-none" id="contactNumberInput"
                                    value="<?= esc_attr(get_field('contact_number', 'user_' . get_current_user_id())); ?>">
                            </div>
                            <!-- address -->
                            <div class="mb-2">
                                <strong>آدرس:</strong>
                                <span class="text-muted"
                                    id="companyAddressDisplay"><?= esc_html(get_field('company_address', 'user_' . get_current_user_id())); ?></span>
                                <textarea class="form-control form-control-sm d-none"
                                    id="companyAddressInput"><?= esc_textarea(get_field('company_address', 'user_' . get_current_user_id())); ?></textarea>
                            </div>
                            <!-- btns -->
                            <div class="text-center mt-3" id="profileButtons">
                                <button type="button" id="editProfileBtn"
                                    class="btn btn-outline-primary btn-sm w-100">ویرایش اطلاعات</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- list of jobs -->
                <div class="col-12 col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="accordion" id="jobAccordion">
                                <!-- 1st accordion - submitted jobs -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingJobs">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseJobs" aria-expanded="true"
                                            aria-controls="collapseJobs">
                                            آگهی‌های ثبت شده
                                        </button>
                                    </h2>
                                    <div id="collapseJobs" class="accordion-collapse collapse show"
                                        aria-labelledby="headingJobs" data-bs-parent="#jobAccordion">
                                        <div class="accordion-body">
                                            <?php
                                            $current_user_id = get_current_user_id();
                                            $args = [
                                                'post_type' => 'job',
                                                'post_status' => 'publish',
                                                'author' => $current_user_id,
                                                'orderby' => 'date',
                                                'order' => 'DESC',
                                                'posts_per_page' => -1,
                                            ];
                                            $jobs = get_posts($args);
                                            ?>
                                            <div class="table-responsive">
                                                <table class="table table-striped align-middle text-nowrap">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>عنوان شغل</th>
                                                            <th>تاریخ انتشار</th>
                                                            <th>رزومه‌ها</th>
                                                            <th>وضعیت</th>
                                                            <th>عملیات</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($jobs as $job):
                                                            $job_id = $job->ID;
                                                            $title = get_the_title($job_id);
                                                            $date = get_the_date('Y/m/d', $job_id);
                                                            $status = get_field('job_status', $job_id); // 'فعال' or 'غیرفعال'
                                                            $is_active = ($status === 'فعال');

                                                            $applications = get_posts([
                                                                'post_type' => 'job_application',
                                                                'post_status' => 'publish',
                                                                'numberposts' => -1,
                                                                'meta_query' => [
                                                                    [
                                                                        'key' => 'job_id',
                                                                        'value' => $job_id,
                                                                        'compare' => '=',
                                                                    ],
                                                                ],
                                                            ]);
                                                            $res_count = count($applications);
                                                            ?>
                                                            <tr
                                                                class="<?= $is_active ? '' : 'text-muted fw-light bg-light' ?>">
                                                                <td><?= esc_html($title) ?></td>
                                                                <td><?= esc_html($date) ?></td>
                                                                <td><span
                                                                        class="badge bg-secondary"><?= $res_count ?></span>
                                                                </td>
                                                                <td>
                                                                    <div
                                                                        class="form-check form-switch d-flex align-items-center gap-2">
                                                                        <input class="form-check-input job-status-toggle"
                                                                            type="checkbox"
                                                                            id="toggleJobStatus<?= $job_id ?>"
                                                                            data-job-id="<?= $job_id ?>"
                                                                            data-current-status="<?= esc_attr($status) ?>"
                                                                            <?= $status === 'فعال' ? 'checked' : '' ?>>
                                                                        <label for="toggleJobStatus<?= $job_id ?>"
                                                                            class="form-check-label mb-0">
                                                                            <?= esc_html($status) ?>
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-sm btn-outline-primary"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#resumes-<?= $job_id ?>"
                                                                        aria-expanded="false"
                                                                        aria-controls="resumes-<?= $job_id ?>">
                                                                        مشاهده رزومه‌ها
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            <!-- resume accorsion -->
                                                            <tr class="collapse" id="resumes-<?= $job_id ?>">
                                                                <td colspan="5">
                                                                    <?php if ($res_count): ?>
                                                                        <div class="table-responsive border rounded p-2">
                                                                            <table class="table table-sm table-bordered mb-0">
                                                                                <thead class="table-light">
                                                                                    <tr>
                                                                                        <th>کارجو</th>
                                                                                        <th>تاریخ ارسال</th>
                                                                                        <th>وضعیت درخواست</th>
                                                                                        <th>دانلود رزومه</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php foreach ($applications as $app):
                                                                                        $jobseeker_id = get_field('jobseeker_id', $app->ID);
                                                                                        $nickname = get_field('nickname', 'user_' . $jobseeker_id);
                                                                                        $sub_date = get_field('submission_date', $app->ID);
                                                                                        $file_id = get_field('resume_file', $app->ID);
                                                                                        $file_url = $file_id ? wp_get_attachment_url($file_id) : '';
                                                                                        $app_status = get_field('status', $app->ID); // مقدار انتخاب‌شده از ACF
                                                                                        $status_choices = get_field_object('status')['choices'] ?? [];
                                                                                        ?>
                                                                                        <tr>
                                                                                            <td><?= esc_html($nickname) ?: '—' ?>
                                                                                            </td>
                                                                                            <td><?= esc_html($sub_date) ?: '—' ?>
                                                                                            </td>
                                                                                            <td>
                                                                                                <?php if ($file_url): ?>
                                                                                                    <a href="<?= esc_url($file_url) ?>"
                                                                                                        target="_blank"
                                                                                                        class="text-decoration-none text-primary">
                                                                                                        دانلود رزومه
                                                                                                    </a>
                                                                                                <?php else: ?>
                                                                                                    <span class="text-muted">فایلی موجود
                                                                                                        نیست</span>
                                                                                                <?php endif; ?>
                                                                                            </td>
                                                                                            <td
                                                                                                class="d-flex align-items-center gap-2">
                                                                                                <select
                                                                                                    class="form-select form-select-sm app-status-dropdown"
                                                                                                    name="status_<?= $app->ID ?>"
                                                                                                    data-application-id="<?= $app->ID ?>">
                                                                                                    <?php
                                                                                                    $all_statuses = acf_get_field('status');
                                                                                                    $current_status = get_field('status', $app->ID);
                                                                                                    foreach ($all_statuses['choices'] as $value => $label): ?>
                                                                                                        <option
                                                                                                            value="<?= esc_attr($value) ?>"
                                                                                                            <?= selected($value, $current_status) ?>>
                                                                                                            <?= esc_html($label) ?>
                                                                                                        </option>
                                                                                                    <?php endforeach; ?>
                                                                                                </select>
                                                                                                <!-- apply changes btn -->
                                                                                                <button type="button"
                                                                                                    class="btn btn-sm btn-outline-success apply-status-btn"
                                                                                                    data-application-id="<?= $app->ID ?>">
                                                                                                    ✔
                                                                                                </button>
                                                                                            </td>
                                                                                        </tr>
                                                                                    <?php endforeach; ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    <?php else: ?>
                                                                        <div class="alert alert-info">رزومه‌ای برای این آگهی
                                                                            ارسال
                                                                            نشده است.</div>
                                                                    <?php endif; ?>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- 2nd accordion - sumbit new job -->
                                <div class="accordion-item mt-3">
                                    <h2 class="accordion-header" id="headingCreate">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseCreate"
                                            aria-expanded="false" aria-controls="collapseCreate">
                                            ساخت آگهی جدید
                                        </button>
                                    </h2>
                                    <div id="collapseCreate" class="accordion-collapse collapse"
                                        aria-labelledby="headingCreate" data-bs-parent="#jobAccordion">
                                        <div class="accordion-body">
                                            <form id="createJobForm" class="row g-3">
                                                <!-- job name -->
                                                <div class="col-12">
                                                    <label for="job_title" class="form-label">عنوان آگهی</label>
                                                    <input type="text" class="form-control" id="job_title"
                                                        name="job_title" required>
                                                </div>
                                                <!-- job description -->
                                                <div class="col-12">
                                                    <label for="job_content" class="form-label">شرح آگهی</label>
                                                    <textarea class="form-control" id="job_content" name="job_content"
                                                        rows="4" required></textarea>
                                                </div>
                                                <!-- job category -->
                                                <div class="col-md-6">
                                                    <label for="job_category" class="form-label">دسته‌بندی شغل</label>
                                                    <select class="form-select" id="job_category" name="job_category"
                                                        required>
                                                        <option value="">انتخاب کنید ...</option>
                                                        <?php
                                                        $all_categories = acf_get_field('job_category');
                                                        foreach ($all_categories['choices'] as $value => $label) {
                                                            ?>
                                                            <option value="<?php echo $value ?>"><?php echo $label ?>
                                                            </option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <!-- job city -->
                                                <div class="col-md-6">
                                                    <label for="job_location" class="form-label">شهر محل کار</label>
                                                    <select class="form-select" id="job_location" name="job_location"
                                                        required>
                                                        <option value="">انتخاب کنید ...</option>
                                                        <?php
                                                        $all_locations = acf_get_field('job_location');
                                                        foreach ($all_locations['choices'] as $value => $label) {
                                                            ?>
                                                            <option value="<?php echo $value ?>"><?php echo $label ?>
                                                            </option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <!-- job contract type -->
                                                <div class="col-md-6">
                                                    <label for="job_type" class="form-label">نوع قرارداد</label>
                                                    <select class="form-select" id="job_type" name="job_type" required>
                                                        <option value="">انتخاب کنید ...</option>
                                                        <?php
                                                        $all_job_types = acf_get_field('job_type');
                                                        foreach ($all_job_types['choices'] as $value => $label) {
                                                            ?>
                                                            <option value="<?php echo $value ?>"><?php echo $label ?>
                                                            </option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <!-- min job experience -->
                                                <div class="col-md-6">
                                                    <label for="job_experience" class="form-label">حداقل سابقه کار
                                                        (سال)</label>
                                                    <input type="number" class="form-control" id="job_experience"
                                                        name="job_experience" min="0"
                                                        placeholder="در صورت عدم اهمیت این مقدار را خالی بگذارید">
                                                </div>
                                                <!-- gender -->
                                                <div class="col-md-6">
                                                    <label for="gender" class="form-label">جنسیت</label>
                                                    <select class="form-select" id="gender" name="gender" required>
                                                        <option value="">انتخاب کنید ...</option>
                                                        <?php
                                                        $all_genders = acf_get_field('gender');
                                                        foreach ($all_genders['choices'] as $value => $label) {
                                                            ?>
                                                            <option value="<?php echo $value ?>"><?php echo $label ?>
                                                            </option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <!-- military status -->
                                                <div class="col-md-6">
                                                    <label for="military_status" class="form-label">وضعیت نظام
                                                        وظیفه</label>
                                                    <select class="form-select" id="military_status"
                                                        name="military_status" required>
                                                        <option value="">انتخاب کنید ...</option>
                                                        <?php
                                                        $all_military_status = acf_get_field('military_status');
                                                        foreach ($all_military_status['choices'] as $value => $label) {
                                                            ?>
                                                            <option value="<?php echo $value ?>"><?php echo $label ?>
                                                            </option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <!-- min education -->
                                                <div class="col-md-6">
                                                    <label for="min_education" class="form-label">حداقل مدرک
                                                        تحصیلی</label>
                                                    <select class="form-select" id="min_education" name="min_education"
                                                        required>
                                                        <option value="">انتخاب کنید ...</option>
                                                        <?php
                                                        $all_min_education = acf_get_field('min_education');
                                                        foreach ($all_min_education['choices'] as $value => $label) {
                                                            ?>
                                                            <option value="<?php echo $value ?>"><?php echo $label ?>
                                                            </option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <!-- job salary -->
                                                <div class="col-md-6">
                                                    <label for="job_salary" class="form-label">حقوق تقریبی (میلیون
                                                        تومان)</label>
                                                    <input type="number" class="form-control" id="job_salary"
                                                        name="job_salary" min="0"
                                                        placeholder="در صورت توافقی بودن، این مقدار را خالی بگذارید">
                                                </div>
                                                <!-- job status -->
                                                <div class="col-md-6">
                                                    <label for="job_status" class="form-label">وضعیت آگهی</label>
                                                    <select class="form-select" id="job_status" name="job_status"
                                                        required>
                                                        <?php
                                                        $all_job_status = acf_get_field('job_status');
                                                        foreach ($all_job_status['choices'] as $value => $label) {
                                                            ?>
                                                            <option value="<?php echo $value ?>"><?php echo $label ?>
                                                            </option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <!-- submit btn -->
                                                <div class="col-12 text-end mt-4">
                                                    <button type="submit" class="btn btn-primary">ثبت آگهی</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
<?php get_footer(); ?>