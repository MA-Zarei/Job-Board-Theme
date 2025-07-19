<?php
/**
 * Template Name: صفحه معرفی شرکت
 */
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>معرفی شرکت</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"
        href="<?php echo get_template_directory_uri(); ?>/assets/bootstrap/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>./assets/css/font.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>./assets/css/style.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>./assets/css/page-auther.css">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">

                <!-- اطلاعات شرکت -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <div class="d-flex flex-column flex-md-row align-items-center gap-4 mb-4">
                            <!-- <img src="https://via.placeholder.com/100x100.png?text=Logo" alt="لوگوی شرکت" class="rounded shadow-sm" width="100" height="100"> -->
                            <div>
                                <h4 class="fw-bold mb-1">ایسوس ایران</h4>
                                <p class="text-muted mb-0">فعال در حوزه سخت‌افزار، لپ‌تاپ و منابع انسانی</p>
                            </div>
                        </div>

                        <hr>

                        <div class="row gy-3">
                            <div class="col-sm-6">
                                <strong>آدرس:</strong>
                                <p class="text-muted mb-0">تهران، خیابان ولیعصر، برج فناوری</p>
                            </div>
                            <div class="col-sm-6">
                                <strong>شماره تماس:</strong>
                                <p class="text-muted mb-0">021-88712345</p>
                            </div>
                            <div class="col-sm-6">
                                <strong>ایمیل:</strong>
                                <p class="text-muted mb-0">contact@asusiran.com</p>
                            </div>
                            <div class="col-12">
                                <strong>توضیحات:</strong>
                                <p class="text-muted small mt-2">
                                    ایسوس ایران با هدف جذب متخصصین حوزه فناوری اطلاعات و طراحی محصولات دیجیتال پیشرفته،
                                    فرصت‌های شغلی متعددی را برای کارجویان فراهم کرده است.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- کروسل آگهی‌ها -->
                <h5 class="fw-bold mb-4 text-center">آگهی‌های این شرکت</h5>

<!-- اسلایدر با فلش‌ها در بیرون محتوای کارت‌ها -->
<div class="position-relative">

  <!-- فلش‌ها خارج از .swiper -->
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>

  <!-- Swiper wrapper -->
  <div class="swiper jobSwiper">
    <div class="swiper-wrapper">

      <!-- کارت‌های آگهی -->
      <div class="swiper-slide">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h6 class="fw-bold mb-1">طراح UI</h6>
            <p class="text-muted small mb-2">تمام‌وقت · تهران</p>
            <p class="text-muted small mb-0">۳ روز پیش · ۱۲۵ رزومه</p>
          </div>
        </div>
      </div>

      <div class="swiper-slide">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h6 class="fw-bold mb-1">برنامه‌نویس React</h6>
            <p class="text-muted small mb-2">ریموت · تمام‌وقت</p>
            <p class="text-muted small mb-0">۷ روز پیش · ۹۸ رزومه</p>
          </div>
        </div>
      </div>

      <div class="swiper-slide">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h6 class="fw-bold mb-1">مدیر محصول</h6>
            <p class="text-muted small mb-2">حضوری · تمام‌وقت</p>
            <p class="text-muted small mb-0">۱۴ روز پیش · ۴۶ رزومه</p>
          </div>
        </div>
      </div>

      <div class="swiper-slide">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h6 class="fw-bold mb-1">پشتیبان شبکه</h6>
            <p class="text-muted small mb-2">پاره‌وقت · حضوری</p>
            <p class="text-muted small mb-0">۱۶ روز پیش · ۳۵ رزومه</p>
          </div>
        </div>
      </div>

      <div class="swiper-slide">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h6 class="fw-bold mb-1">کارشناس فروش</h6>
            <p class="text-muted small mb-2">پاره‌وقت · ریموت</p>
            <p class="text-muted small mb-0">۳۰ روز پیش · ۴۲ رزومه</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>




                <!-- Bootstrap Bundle JS -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="<?php echo get_template_directory_uri(); ?>./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <!-- تنظیمات Swiper -->
    <script>
  const swiper = new Swiper(".jobSwiper", {
    slidesPerView: 1,
    spaceBetween: 20,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev"
    },
    breakpoints: {
      576: { slidesPerView: 1 },
      768: { slidesPerView: 2 },
      992: { slidesPerView: 3 }
    }
  });
</script>



</body>

</html>