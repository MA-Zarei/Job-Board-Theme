<nav class="navbar navbar-expand-lg bg-light navbar-light border-bottom shadow-sm  mb-4">
    <div class="container-fluid">
        <a class="navbar-brand ms-2" href="<?php echo get_bloginfo('url'); ?>">
            <?php echo get_bloginfo('name'); ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php
                if (!is_user_logged_in()) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php
                        $page = get_page_by_path('login');
                        echo get_permalink($page->ID);
                        ?>">
                            ورود / ثبت نام
                        </a>
                    </li>
                <?php } else {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <?php
                            echo wp_get_current_user()->display_name;
                            ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            حساب کاربری
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>