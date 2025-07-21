<form method="get" action="" id="job-filter-form">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <span class="fw-bold">فیلترها</span>
        <div class="d-flex gap-2">
            <?php
                                $has_active_filters =
                                    !empty($_GET['job_type']) || !empty($_GET['job_salary']);
                                if ($has_active_filters) {
                                    ?>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-link p-0 text-primary text-decoration-none">
                پاک کردن فیلترها
            </a>

            <?php
                                } else { ?>
            <button type="submit" class="btn btn-link p-0 text-primary text-decoration-none">
                اعمال فیلتر
            </button>
            <?php }
                                ?>
        </div>

    </div>
    <div class="accordion" id="filterAccordion">

        <!-- فیلتر نوع کار -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingType">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseType"
                    aria-expanded="true" aria-controls="collapseType">
                    نوع کار
                </button>
            </h2>
            <div id="collapseType" class="accordion-collapse collapse show" aria-labelledby="headingType">
                <div class="accordion-body">
                    <?php
                                        $all_locations = acf_get_field('job_type');
                                        foreach ($all_locations['choices'] as $value => $label) {
                                            ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="job_type[]" value="<?php echo $value ?>"
                            id="<?php echo $value ?>" <?php echo in_array($value, ($_GET['job_type'] ?? [])) ? 'checked'
                            : '' ; ?>>
                        <label class="form-check-label" for="<?php echo $value ?>">
                            <?php echo $label ?>
                        </label>
                    </div>
                    <?php
                                        }
                                        ?>
                </div>
            </div>
        </div>
        <!-- فیلتر قیمت -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingPrice">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePrice"
                    aria-expanded="true" aria-controls="collapsePrice">
                    قیمت
                </button>
            </h2>
            <div id="collapsePrice" class="accordion-collapse collapse show" aria-labelledby="headingPrice">
                <div class="accordion-body">
                    <?php
                                        $selected_prices = $_GET['job_salary'] ?? [];
                                        for ($i = 5; $i <= 30; $i += 5) {
                                            $value = (string) $i;
                                            $checked = in_array($value, $selected_prices) ? 'checked' : '';
                                            ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="job_salary[]" value="<?php echo $value ?>"
                            id="<?php echo 'price-' . $value ?>" <?php echo $checked ?>>
                        <label class="form-check-label" for="<?php echo 'price-' . $value ?>">
                            <?php echo 'از ' . $i . ' تا ' . ($i + 5) . ' میلیون تومان' ?>
                            <?php echo $value ?>
                        </label>
                    </div>
                    <?php
                                        }
                                        $checked = in_array('35', $selected_prices) ? 'checked' : '';
                                        ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="job_salary[]" value="35" id="price-35"
                            <?php echo $checked ?>>
                        <label class="form-check-label" for="price-35">
                            بیشتر از 35 میلیون تومان
                        </label>
                    </div>
                </div>
            </div>
        </div>
</form>