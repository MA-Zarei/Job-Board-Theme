<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF8">
    <title> سایت کاریابی</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/bootstrap/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nouislider@15.7.0/dist/nouislider.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>./assets/css/font.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>./assets/css/front-page.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light navbar-light border-bottom shadow-sm  mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">قالب سایت کاریابی</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#">ورود</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            حساب کاربری
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">درخواست‌های من</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">نشان شده‌ها</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="d-md-flex flex-md-row flex-column">

            <!-- main container -->
            <div class="main-content flex-grow-1 bg-light text-white p-3">

                <!-- search fields - desktop-->
                <div class="container my-4">
                    <form class="d-flex flex-column flex-md-row gap-3 mt-4">
                        <div class="position-relative flex-grow-1">
                            <input type="text" class="form-control pe-5" placeholder="عنوان شغلی، مهارت یا ..." />
                            <span class="position-absolute top-50 end-0 translate-middle-y pe-2 text-muted">
                                <i class="bi bi-search"></i>
                            </span>
                        </div>
                        <div class="position-relative flex-grow-1 test">
                            <select class="form-select select2 ps-3" dir="rtl" data-placeholder="همه استان‌ها">
                                <option>همه استان‌ها</option>
                                <option>تهران</option>
                                <option>اصفهان</option>
                                <option>شیراز</option>
                                <option>مشهد</option>
                                <option>تبریز</option>
                            </select>
                        </div>
                        <div class="position-relative flex-grow-1">
                            <select class="form-select select2 pe-3" data-placeholder="همه دسته‌بندی‌ها">
                                <option>همه دسته‌بندی‌ها</option>
                                <option>برنامه‌نویسی</option>
                                <option>طراحی گرافیک</option>
                                <option>مدیریت پروژه</option>
                                <option>فروش و بازاریابی</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">جستجو</button>
                    </form>
                </div>
                <button class="btn btn-primary d-md-none w-100 mb-3" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#sidebarOffcanvas">
                    فیلترها
                </button>

                <!-- cards container-->
                <div class="row g-3 justify-content-start">

                    <!-- 1st card -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h6 class="fw-bold mb-1">UI/UX Designer</h6>
                                        <small class="text-muted">Pixelz Studio · تهران</small>
                                    </div>
                                    <i class="bi bi-bookmark"></i>
                                </div>

                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="badge bg-light text-dark">تمام‌وقت</span>
                                    <span class="badge bg-light text-dark">حضوری</span>
                                    <span class="badge bg-light text-dark">۲ تا ۴ سال</span>
                                </div>

                                <p class="text-muted small mb-2">۲ روز پیش</p>

                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-primary">۱۰٬۰۰۰٬۰۰۰ تومان</span>
                                    <button class="btn btn-primary btn-sm">ارسال درخواست</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 2nd card -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h6 class="fw-bold mb-1">UI/UX Designer</h6>
                                        <small class="text-muted">Pixelz Studio · تهران</small>
                                    </div>
                                    <i class="bi bi-bookmark"></i>
                                </div>

                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="badge bg-light text-dark">تمام‌وقت</span>
                                    <span class="badge bg-light text-dark">حضوری</span>
                                    <span class="badge bg-light text-dark">۲ تا ۴ سال</span>
                                </div>

                                <p class="text-muted small mb-2">۲ روز پیش</p>

                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-primary">۱۰٬۰۰۰٬۰۰۰ تومان</span>
                                    <button class="btn btn-primary btn-sm">ارسال درخواست</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 3th card -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h6 class="fw-bold mb-1">UI/UX Designer</h6>
                                        <small class="text-muted">Pixelz Studio · تهران</small>
                                    </div>
                                    <i class="bi bi-bookmark"></i>
                                </div>

                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="badge bg-light text-dark">تمام‌وقت</span>
                                    <span class="badge bg-light text-dark">حضوری</span>
                                    <span class="badge bg-light text-dark">۲ تا ۴ سال</span>
                                </div>

                                <p class="text-muted small mb-2">۲ روز پیش</p>

                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-primary">۱۰٬۰۰۰٬۰۰۰ تومان</span>
                                    <button class="btn btn-primary btn-sm">ارسال درخواست</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 4th card -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h6 class="fw-bold mb-1">UI/UX Designer</h6>
                                        <small class="text-muted">Pixelz Studio · تهران</small>
                                    </div>
                                    <i class="bi bi-bookmark"></i>
                                </div>

                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="badge bg-light text-dark">تمام‌وقت</span>
                                    <span class="badge bg-light text-dark">حضوری</span>
                                    <span class="badge bg-light text-dark">۲ تا ۴ سال</span>
                                </div>

                                <p class="text-muted small mb-2">۲ روز پیش</p>

                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-primary">۱۰٬۰۰۰٬۰۰۰ تومان</span>
                                    <button class="btn btn-primary btn-sm">ارسال درخواست</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 5th card -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h6 class="fw-bold mb-1">UI/UX Designer</h6>
                                        <small class="text-muted">Pixelz Studio · تهران</small>
                                    </div>
                                    <i class="bi bi-bookmark"></i>
                                </div>

                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="badge bg-light text-dark">تمام‌وقت</span>
                                    <span class="badge bg-light text-dark">حضوری</span>
                                    <span class="badge bg-light text-dark">۲ تا ۴ سال</span>
                                </div>

                                <p class="text-muted small mb-2">۲ روز پیش</p>

                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-primary">۱۰٬۰۰۰٬۰۰۰ تومان</span>
                                    <button class="btn btn-primary btn-sm">ارسال درخواست</button>
                                </div>
                            </div>
                        </div>
                    </div>





                </div>

            </div>
            <!-- desktop sidebar -->
            <div class="sidebar d-none d-md-block bg-light p-3" style="width: 20%; min-width: 200px;">
                <div class="d-flex flex-row justify-content-between align-items-center gap-2 p-2">
                    <span class="fw-bold">فیلترها</span>
                    <button type="button" class="btn btn-link p-0 text-primary text-decoration-none">
                        پاک کردن همه
                    </button>
                </div>
                <div class="accordion" id="filterAccordion">

                    <!-- فیلتر نوع کار -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingType">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseType" aria-expanded="true" aria-controls="collapseType">
                                نوع کار
                            </button>
                        </h2>
                        <div id="collapseType" class="accordion-collapse collapse show" aria-labelledby="headingType">
                            <div class="accordion-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remote">
                                    <label class="form-check-label" for="remote">دورکاری</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="fulltime">
                                    <label class="form-check-label" for="fulltime">تمام‌وقت</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="parttime">
                                    <label class="form-check-label" for="parttime">پاره‌وقت</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- فیلتر قیمت -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingPrice">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapsePrice" aria-expanded="true" aria-controls="collapsePrice">
                                قیمت
                            </button>
                        </h2>
                        <div id="collapsePrice" class="accordion-collapse collapse show" aria-labelledby="headingPrice">
                            <div class="accordion-body">
                                <label for="price-slider" class="form-label mb-3">محدوده قیمت (میلیون تومان)</label>
                                <div id="price-slider"></div>
                                <div class="mt-2 text-muted" id="price-output">از ۲٬۰۰۰٬۰۰۰ تا ۶٬۰۰۰٬۰۰۰ میلیون تومان</div>

                                <hr class="my-3">

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="price-free">
                                    <label class="form-check-label" for="price-free">حقوق توافقی</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="price-negotiable">
                                    <label class="form-check-label" for="price-negotiable">پذیرش کارآموز</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Career history filter -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingExperience">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseExperience" aria-expanded="false"
                                aria-controls="collapseExperience">
                                تجربه کاری
                            </button>
                        </h2>
                        <div id="collapseExperience" class="accordion-collapse collapse show"
                            aria-labelledby="headingExperience">
                            <div class="accordion-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="experience" id="exp-0" value="0">
                                    <label class="form-check-label" for="exp-0">بدون تجربه</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="experience" id="exp-1" value="1">
                                    <label class="form-check-label" for="exp-1">۱ تا ۳ سال</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="experience" id="exp-3" value="3">
                                    <label class="form-check-label" for="exp-3">بیش از ۳ سال</label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- Mobile sidebar (offcanvas) -->
    <div class="offcanvas offcanvas-start offcanvas-md" tabindex="-1" id="sidebarOffcanvas"
        aria-labelledby="sidebarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarLabel">فیلترها</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="بستن"></button>
        </div>
        <div class="offcanvas-body">
            <div class="d-flex flex-row justify-content-between align-items-center gap-2 p-2">
                <span class="fw-bold">فیلترها</span>
                <button type="button" class="btn btn-link p-0 text-primary text-decoration-none">
                    پاک کردن همه
                </button>
            </div>
            <div class="accordion" id="filterAccordion">

                <!-- type of job -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingType">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseType" aria-expanded="true" aria-controls="collapseType">
                            نوع کار
                        </button>
                    </h2>
                    <div id="collapseType" class="accordion-collapse collapse show" aria-labelledby="headingType">
                        <div class="accordion-body">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remote">
                                <label class="form-check-label" for="remote">دورکاری</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="fulltime">
                                <label class="form-check-label" for="fulltime">تمام‌وقت</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="parttime">
                                <label class="form-check-label" for="parttime">پاره‌وقت</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- price filter -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingPrice">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsePrice" aria-expanded="true" aria-controls="collapsePrice">
                            قیمت
                        </button>
                    </h2>
                    <div id="collapsePrice" class="accordion-collapse collapse show" aria-labelledby="headingPrice">
                        <div class="accordion-body">
                            <label for="price-slider" class="form-label mb-3">محدوده قیمت (میلیون تومان)</label>
                            <div id="price-slider-mobile"></div>
                            <div class="mt-2 text-muted" id="price-output">از ۲٬۰۰۰٬۰۰۰ تا ۶٬۰۰۰٬۰۰۰ میلیون تومان</div>

                            <hr class="my-3">

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="price-free">
                                <label class="form-check-label" for="price-free">حقوق توافقی</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="price-negotiable">
                                <label class="form-check-label" for="price-negotiable">پذیرش کارآموز</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Career history filter -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingExperience">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseExperience" aria-expanded="false"
                            aria-controls="collapseExperience">
                            تجربه کاری
                        </button>
                    </h2>
                    <div id="collapseExperience" class="accordion-collapse collapse show"
                        aria-labelledby="headingExperience">
                        <div class="accordion-body">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="experience" id="exp-0" value="0">
                                <label class="form-check-label" for="exp-0">بدون تجربه</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="experience" id="exp-1" value="1">
                                <label class="form-check-label" for="exp-1">۱ تا ۳ سال</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="experience" id="exp-3" value="3">
                                <label class="form-check-label" for="exp-3">بیش از ۳ سال</label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="<?php echo get_template_directory_uri(); ?>./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- noUiSlider -->
    <script src="https://cdn.jsdelivr.net/npm/nouislider@15.7.0/dist/nouislider.min.js"></script>
    <!-- js files -->
    <script src="<?php echo get_template_directory_uri(); ?>./assets/js/filters.js"></script>


</body>

</html>