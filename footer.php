<!-- Footer section with dark background and light text -->
<footer class="bg-dark text-white mt-5 py-4">
    <div class="container">
        <div class="row text-center text-md-start align-items-center justify-content-between">

            <!-- Branding and copyright area (right column) -->
            <div class="col-md-6 mb-3 mb-md-0">
                <h6 class="fw-bold mb-2">
                    <!-- Site title linked to homepage -->
                    <a class="navbar-brand" href="<?php echo get_bloginfo('url'); ?>">
                        <?php echo get_bloginfo('name'); ?>
                    </a>
                </h6>
                <!-- Copyright note -->
                <small class="text-light d-block">© تمامی حقوق محفوظ است - ۱۴۰۴</small>
            </div>

            <!-- Quick navigation links (left column) -->
            <div class="col-md-6 text-md-end">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <a href="#" class="text-light text-decoration-none">درباره ما</a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" class="text-light text-decoration-none">تماس با ما</a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" class="text-light text-decoration-none">سوالات متداول</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</footer>

<!-- Outputs necessary WordPress scripts before closing body -->
<?php wp_footer(); ?>

</body>

</html>