<?php $__env->startSection('title', 'Home'); ?>
<?php $__env->startSection('content'); ?>


    <main>
        <section class="swiper-container js-swiper-slider swiper-number-pagination slideshow"
            data-settings='{
    "autoplay": {
      "delay": 3000
    },
    "slidesPerView": 1,
    "effect": "fade",
    "loop": true
  }'>
            <div class="swiper-wrapper" id="slideshow">
                <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="swiper-slide">
                        <div class="overflow-hidden position-relative h-100" id="h100">
                            <div class="bottom-0 slideshow-character position-absolute pos_right-center">
                                <img loading="lazy" src="<?php echo e(asset('storage/uploads/slides/' . $slide->image)); ?>"
                                    width="842" height="1033" alt="Woman Fashion 1"
                                    class="w-auto h-auto slideshow-character__img animate animate_fade animate_btt animate_delay-9" />
                                <div class="character_markup type2">
                                    <p
                                        class="mb-0 text-uppercase font-sofia mark-grey-color animate animate_fade animate_btt animate_delay-10">
                                        <?php echo e($slide->tagline); ?></p>
                                    </p>
                                </div>
                            </div>
                            <div class="container slideshow-text position-absolute start-50 top-50 translate-middle">
                                <h6
                                    class="text_dash text-uppercase fs-base fw-medium animate animate_fade animate_btt animate_delay-3">
                                    New Arrivals
                                </h6>
                                <h2 class="mb-0 h1 fw-normal animate animate_fade animate_btt animate_delay-5">
                                    <?php echo e($slide->title); ?>

                                </h2>
                                <h2 class="h1 fw-bold animate animate_fade animate_btt animate_delay-5">
                                    <?php echo e($slide->subtitle); ?>

                                </h2>
                                <a href="<?php echo e($slide->link); ?>"
                                    class="btn-link btn-link_lg default-underline fw-medium animate animate_fade animate_btt animate_delay-7">Shop
                                    Now</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


            </div>

            <div class="container">
                <div
                    class="bottom-0 mb-5 slideshow-pagination slideshow-number-pagination d-flex align-items-center position-absolute">
                </div>
            </div>
        </section>
        <div class="container bg-white mw-1620 border-radius-10">
            <div class="pt-1 pb-4 mb-3 mb-xl-5"></div>
            <section class="container category-carousel">
                <h2 class="mb-3 text-center section-title pb-xl-2 mb-xl-4">
                    You Might Like Our <span style="color: orange">Categories</span>
                </h2>

                <div class="position-relative">
                    <div class="swiper-container js-swiper-slider"
                        data-settings='{
          "autoplay": {
            "delay": 5000
          },
          "slidesPerView": 8,
          "slidesPerGroup": 1,
          "effect": "none",
          "loop": true,
          "navigation": {
            "nextEl": ".products-carousel__next-1",
            "prevEl": ".products-carousel__prev-1"
          },
          "breakpoints": {
            "320": {
              "slidesPerView": 2,
              "slidesPerGroup": 2,
              "spaceBetween": 15
            },
            "768": {
              "slidesPerView": 4,
              "slidesPerGroup": 4,
              "spaceBetween": 30
            },
            "992": {
              "slidesPerView": 6,
              "slidesPerGroup": 1,
              "spaceBetween": 45,
              "pagination": false
            },
            "1200": {
              "slidesPerView": 8,
              "slidesPerGroup": 1,
              "spaceBetween": 60,
              "pagination": false
            }
          }
        }'>
                        <div class="swiper-wrapper">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="swiper-slide">
                                    <img loading="lazy" class="h-auto mb-3 w-100 circular-image"
                                        src="<?php echo e(asset('storage/uploads/categories/' . $category->image)); ?>" width="124"
                                        height="124" alt="<?php echo e($category->name); ?>" />
                                    <div class="text-center">
                                        <a href="<?php echo e(route('website.shop', ['categories' => $category->id])); ?>"
                                            class="menu-link fw-medium"><?php echo e($category->name); ?></a>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <!-- /.swiper-wrapper -->
                    </div>
                    <!-- /.swiper-container js-swiper-slider -->

                    <div
                        class="products-carousel__prev products-carousel__prev-1 position-absolute top-50 d-flex align-items-center justify-content-center">
                        <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_prev_md" />
                        </svg>
                    </div>
                    <!-- /.products-carousel__prev -->
                    <div
                        class="products-carousel__next products-carousel__next-1 position-absolute top-50 d-flex align-items-center justify-content-center">
                        <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_next_md" />
                        </svg>
                    </div>
                    <!-- /.products-carousel__next -->
                </div>
                <!-- /.position-relative -->
            </section>

            <div class="pt-1 pb-4 mb-3 mb-xl-5"></div>

            <section class="container hot-deals">
                <h2 class="mb-3 text-center section-title pb-xl-3 mb-xl-4">
                    Hot Deals &#129309;
                </h2>
                <div class="row">
                    <div
                        class="py-4 col-md-6 col-lg-4 col-xl-20per d-flex align-items-center flex-column justify-content-center align-items-md-start">
                        <div style="display: flex ; bottom: 2px;">
                            <h2>Summer Sale</h2><img height="30px" width="30px"
                                src="<?php echo e(asset('icon/icons8-celebration-48 (1).png')); ?>" />
                        </div>

                        <h2 class="fw-bold">Up to <span style="color: red">-30%</span> Off</h2>

                        <div class="mb-3 text-center position-relative d-flex align-items-center pt-xxl-4 js-countdown"
                            data-date="18-3-2024" data-time="06:50">
                            <div class="day countdown-unit">
                                <span class="countdown-num d-block"></span>
                                <span class="countdown-word text-uppercase text-secondary">Days</span>
                            </div>

                            <div class="hour countdown-unit">
                                <span class="countdown-num d-block"></span>
                                <span class="countdown-word text-uppercase text-secondary">Hours</span>
                            </div>

                            <div class="min countdown-unit">
                                <span class="countdown-num d-block"></span>
                                <span class="countdown-word text-uppercase text-secondary">Mins</span>
                            </div>

                            <div class="sec countdown-unit">
                                <span class="countdown-num d-block"></span>
                                <span class="countdown-word text-uppercase text-secondary">Sec</span>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-6 col-lg-8 col-xl-80per">
                        <div class="position-relative">
                            <div class="swiper-container js-swiper-slider"
                                data-settings='{
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": 4,
              "slidesPerGroup": 4,
              "effect": "none",
              "loop": false,
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "slidesPerGroup": 2,
                  "spaceBetween": 14
                },
                "768": {
                  "slidesPerView": 2,
                  "slidesPerGroup": 3,
                  "spaceBetween": 24
                },
                "992": {
                  "slidesPerView": 3,
                  "slidesPerGroup": 1,
                  "spaceBetween": 30,
                  "pagination": false
                },
                "1200": {
                  "slidesPerView": 4,
                  "slidesPerGroup": 1,
                  "spaceBetween": 30,
                  "pagination": false
                }
              }
            }'>
                                <div class="swiper-wrapper">
                                    <?php $__currentLoopData = $saleProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="swiper-slide product-card product-card_style3">
                                            <div class="pc__img-wrapper">
                                                <a
                                                    href="<?php echo e(route('website.shop.product.details', ['product_slug' => $product->slug])); ?>">
                                                    <img loading="lazy"
                                                        src="<?php echo e(asset('storage/uploads/products/' . $product->image)); ?>"
                                                        width="258" height="313" alt="<?php echo e($product->name); ?>"
                                                        class="pc__img" />

                                                </a>
                                                <!-- Stock Badge -->
                                                <span
                                                    class="top-0 px-3 py-1 m-2 text-white position-absolute start-0 rounded-pill fw-bold "
                                                    style="background-color: <?php echo e($product->quantity > 0 ? 'green' : 'red'); ?>">
                                                    <?php echo e($product->quantity > 0 ? 'In Stock' : 'Out of Stock'); ?>

                                                </span>
                                            </div>

                                            <div class="pc__info position-relative">
                                                <h6 class="pc__title">
                                                    <a
                                                        href="<?php echo e(route('website.shop.product.details', ['product_slug' => $product->slug])); ?>"><?php echo e($product->name); ?></a>
                                                </h6>
                                                <div class="product-card__price d-flex">
                                                    <span class="money price" style="color: red">
                                                        <?php if($product->sale_price): ?>
                                                            <s style="color: gray">$<?php echo e($product->regular_price); ?></s>
                                                            $<?php echo e($product->sale_price); ?>

                                                        <?php else: ?>
                                                            $<?php echo e($product->regular_price); ?>

                                                        <?php endif; ?>
                                                    </span>
                                                </div>

                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </div>
                                <a href="<?php echo e(route('website.shop')); ?>" style="text-decoration: underline"
                                    class="mt-3 btn-link text-uppercase fw-medium">View
                                    All</a>
                                <!-- /.swiper-wrapper -->
                            </div>
                            <!-- /.swiper-container js-swiper-slider -->
                        </div>
                        <!-- /.position-relative -->
                    </div>
                </div>
            </section>

            <div class="pt-1 pb-4 mb-3 mb-xl-5"></div>

            <section class="container category-banner">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-5 category-banner__item border-radius-10">
                            <img loading="lazy" class="h-auto"
                                src="<?php echo e(asset('assets/images/home/demo3/DSC02602.jpg')); ?>" width="690" height="665"
                                alt="" />
                            <div class="category-banner__item-mark">Starting at $19</div>
                            <div class="category-banner__item-content">
                                <h3 class="mb-0">Blazers</h3>
                                <a href="#" class="btn-link default-underline text-uppercase fw-medium">Shop
                                    Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-5 category-banner__item border-radius-10">
                            <img loading="lazy" class="h-auto"
                                src="<?php echo e(asset('assets/images/home/demo3/DSC04407(1).jpg')); ?>" width="690"
                                height="665" alt="" />
                            <div class="category-banner__item-mark">Starting at $19</div>
                            <div class="category-banner__item-content">
                                <h3 class="mb-0">Sportswear</h3>
                                <a href="#" class="btn-link default-underline text-uppercase fw-medium">Shop
                                    Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="pt-1 pb-4 mb-3 mb-xl-5"></div>

            <section class="container p-4 shadow-lg products-grid rounded-4">
                <h2 class="mb-3 text-center section-title pb-xl-3 mb-xl-4">
                    Featured Products 📦
                </h2>

                <div class="row" id="featured-products">
                    <?php $__currentLoopData = $featureProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="mb-3 overflow-hidden shadow-lg product-card product-card_style3 mb-md-4 mb-xxl-5 rounded-4"
                                id="product-card">
                                <div class="pc__img-wrapper position-relative">
                                    <a href="javascript:void(0)">
                                        <img loading="lazy"
                                            src="<?php echo e(asset('storage/uploads/products/' . $product->image)); ?>"
                                            width="330" height="400" alt="<?php echo e($product->name); ?>"
                                            class="pc__img w-100 rounded-4" />
                                    </a>

                                    <?php
                                        $sizes = json_decode($product->sizes, true); // true দিয়ে অ্যারে রিটার্ন করবে
                                    ?>

                                    <span
                                        class="top-0 px-3 py-1 m-2 text-white position-absolute start-0 rounded-pill fw-bold"
                                        style="background-color: <?php echo e($product->quantity == 0 || empty($sizes) ? 'red' : 'green'); ?>">
                                        <?php echo e($product->quantity == 0 || empty($sizes) ? 'Out of Stock' : 'In Stock'); ?>

                                    </span>

                                    <!-- Hover Effect for Avg Reviews -->
                                    <div class="avg-review-tooltip">
                                        Avg Rating: <?php echo e(round($product->reviews->avg('rating'), 1)); ?> <span
                                            style="color: #FACA51">★</span>
                                    </div>
                                </div>

                                <div class="p-3 text-center pc__info position-relative col-12">
                                    <h6 class="pc__title fw-semibold text-dark">
                                        <a href="<?php echo e(route('website.shop.product.details', $product->slug)); ?>"
                                            class="text-decoration-none text-dark"><strong><?php echo e($product->name); ?></strong></a>
                                    </h6>
                                    <div class="product-card__price d-flex justify-content-center align-items-center">
                                        <span class="money price text-secondary fw-bold">
                                            <?php if($product->sale_price): ?>
                                                <s class="text-muted">$<?php echo e($product->regular_price); ?></s>
                                                <span style="color: red">$<?php echo e($product->sale_price); ?></span>
                                            <?php else: ?>
                                                <span class="text-dark">$<?php echo e($product->regular_price); ?></span>
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                    <a href="#" title="Add Wishlist" style="margin-right:10px "
                                        class="top-0 bg-transparent border-0 pc__btn-wl position-absolute end-0 js-add-wishlist <?php echo e(Cart::instance('wishlist')->content()->where('id', $product->id)->count() > 0 ? 'filled-heart' : ''); ?>"
                                        data-id="<?php echo e($product->id); ?>" data-name="<?php echo e($product->name); ?>"
                                        data-price="<?php echo e($product->sale_price == '' ? $product->regular_price : $product->sale_price); ?>"
                                        title="<?php echo e(Cart::instance('wishlist')->content()->where('id', $product->id)->count() > 0 ? 'Remove From Wishlist' : 'Add To Wishlist'); ?>">

                                        <?php if(Cart::instance('wishlist')->content()->where('id', $product->id)->count() > 0): ?>
                                            <svg id="icon_heart" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                width="20" height="20">
                                                <path
                                                    d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"
                                                    fill="#f24444" />
                                            </svg>
                                        <?php else: ?>
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_heart" />
                                            </svg>
                                        <?php endif; ?>
                                    </a>
                                    <div class="product-card__review d-flex align-items-center">
                                        <span class="reviews-note text-lowercase ms-1" style="color: black;">
                                            <span class="fs-6 " style="color: #FACA51; margin-left: 30px;">
                                                <?php echo e(str_repeat('★', round($product->reviews->avg('rating')))); ?><?php echo e(str_repeat('☆', 5 - round($product->reviews->avg('rating')))); ?>

                                            </span>(<?php echo e($product->reviews->count()); ?>

                                            <span style="color: gray">Customer Reviews</span>)
                                        </span>
                                    </div>
                                    <!-- Buttons -->
                                    <div class="gap-3 mt-3 d-flex justify-content-center">

                                        <?php
                                            $sizes = json_decode($product->sizes, true); // true দিয়ে অ্যারে রিটার্ন করবে
                                        ?>
                                        <?php if($product->quantity == 0 || empty($sizes)): ?>
                                            <button class="px-4 py-2 shadow-sm btn btn-danger rounded-pill" disabled>Out of
                                                Stock</button>
                                        <?php else: ?>
                                            <?php if(Cart::instance('cart')->content()->where('id', $product->id)->count() > 0): ?>
                                                <a href="<?php echo e(route('cart.index')); ?>"
                                                    class="px-4 py-2 shadow-sm btn btn-dark rounded-pill">&#128722; View
                                                    Cart</a>
                                            <?php else: ?>
                                                
                                                <a href="<?php echo e(route('website.shop.product.details', $product->slug)); ?>"><button
                                                        class="px-4 py-2 shadow-sm btn btn-outline-dark rounded-pill js-quick-view"
                                                        data-bs-toggle="modal" data-bs-target="#quickView"
                                                        title="Quick view">
                                                        &#128722; Buy Now
                                                    </button></a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
                <!-- /row -->
                <div class="mt-2 text-center">
                    <a class="btn-link btn-link_lg default-underline text-uppercase fw-medium"
                        href="<?php echo e(route('website.shop')); ?>">View More</a>
                </div>
            </section>

        </div>

        
        <div class="pt-1 pb-4 mt-5 mb-3 mb-xl-5">
            <section class="container shadow-lg products-grid rounded-4" style="padding: 60px">
                <h2 class="mb-3 section-title pb-xl-3 mb-xl-4">
                    Customer Feedbacks <img src="<?php echo e(asset('icon/icons8-message-48.png')); ?>">
                </h2>

                <div id="feedbackCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">

                        <?php $__empty_1 = true; $__currentLoopData = $feedbacks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $feedback): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>">
                                <div class="p-4 text-center border rounded shadow-sm feedback-card">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <?php if($feedback->profile_picture == null): ?>
                                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRknnc4OqRgNtBh8jwv-wY4dpK-YZ8AHDMktRa85N4YD2wp-zhQvYavkyKPtCZtC48DLrw&usqp=CAU"
                                                alt="Profile Image" class="profile-img rounded-circle me-3"
                                                style="width: 60px; height: 60px; object-fit: cover;">
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('storage/uploads/feedback/' . $feedback->profile_picture)); ?>"
                                                alt="Profile Image" class="profile-img rounded-circle me-3"
                                                style="width: 60px; height: 60px; object-fit: cover;">
                                        <?php endif; ?>
                                        <div>
                                            <h6 class="mb-0 fw-bold"><?php echo e($feedback->name); ?></h6>
                                            <small class="text-muted">
                                                <?php echo e(\Carbon\Carbon::parse($feedback->created_at)->format('F d, Y')); ?>

                                            </small>
                                        </div>
                                    </div>
                                    <b class="mt-5 text-secondary"><?php echo e($feedback->comment); ?></b>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="carousel-item active">
                                <div class="p-4 text-center border rounded shadow-sm feedback-card">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRknnc4OqRgNtBh8jwv-wY4dpK-YZ8AHDMktRa85N4YD2wp-zhQvYavkyKPtCZtC48DLrw&usqp=CAU"
                                            alt="Profile Image" class="profile-img rounded-circle me-3"
                                            style="width: 60px; height: 60px; object-fit: cover;">
                                        <div>
                                            <h6 class="mb-0 fw-bold">No Feedbacks</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Carousel Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#feedbackCarousel"
                        data-bs-slide="prev">
                        <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_prev_md" />
                        </svg>
                    </button>

                    <button class="carousel-control-next" type="button" data-bs-target="#feedbackCarousel"
                        data-bs-slide="next">
                        <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_next_md" />
                        </svg>
                    </button>
                </div>

                <div class="mt-5 text-center" style="position: fixeds">
                    <button class="btn btn-primary-gradient" id="customerFeedback">Share Your Feedback</button>
                </div>
            </section>

        </div>

        
        <div class="pt-1 pb-4 mb-3 mb-xl-5">

            <section id="feedback-form" class="container p-4 mt-5 products-grid rounded-4" style="display:none;">
                <h2 class="mb-3 text-center section-title pb-xl-3 mb-xl-4">
                    Share Your Feedback </h2>

                <div class="container shadow-lg rounded-4 mw-930" style="padding: 50px">
                    <div style="float: right">
                        <a id="hideForm" href="javascript:void(0)" class="mt-3 btn-link text-uppercase fw-medium"
                            style="float: right; color: rgb(255, 0, 0);">Hide
                            Form</a>
                    </div>
                    <div class="contact-us__form">
                        <form name="contact-us-form" class="needs-validation" action="<?php echo e(route('feedback.submit')); ?>"
                            method="POST" enctype="multipart/form-data" id="feedbackForm">
                            <?php echo csrf_field(); ?>
                            <h3 class="mb-5">Let us know what you think</h3> <img
                                src="<?php echo e(asset('icon/icons8-hugging-face-48.png')); ?>" />

                            <!-- Name Field -->
                            <div class="my-4 form-floating">
                                <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    name="name" placeholder="Name *" value="<?php echo e(old('name')); ?>" id="name">
                                <label for="contact_us_name">Name *</label>
                                <span class="text-danger"></span>
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Phone Field -->
                            <div class="my-4 form-floating">
                                <input type="text" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    name="phone" placeholder="Phone *" value="<?php echo e(old('phone')); ?>" id="phone">
                                <label for="contact_us_name">Phone *</label>
                                <span class="text-danger"></span>
                                <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Email Field -->
                            <div class="my-4 form-floating">
                                <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    name="email" placeholder="Email address *" value="<?php echo e(old('email')); ?>"
                                    id="email" required>
                                <label for="contact_us_name">Email address *</label>
                                <span class="text-danger"></span>
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Profile Picture Upload -->
                            <div class="my-4 form-floating">
                                <input type="file" class="form-control <?php $__errorArgs = ['profile_picture'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    name="profile_picture" accept="image/*" id="profilePicture">
                                <label for="contact_us_name">Profile Picture</label>
                                <span class="text-danger"></span>
                                <?php $__errorArgs = ['profile_picture'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Comment Field -->
                            <div class="my-4">
                                <textarea class="form-control form-control_gray <?php $__errorArgs = ['comment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="comment"
                                    placeholder="Your Message" cols="30" rows="8" id="comment"><?php echo e(old('comment')); ?></textarea>
                                <span class="text-danger"></span>
                                <?php $__errorArgs = ['comment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Submit Button -->
                            <div class="my-4">
                                <button type="button" class="btn btn-primary" id="previewBtn">Submit</button>
                                <button type="submit" class="btn btn-success" id="submitBtn"
                                    style="display:none;">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Preview Modal -->
                <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="previewModalLabel">Preview Your Feedback</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="feedback-card">
                                    <img src="" id="previewImage" alt="Profile Image"
                                        class="profile-img rounded-circle" style="width: 100px; height: 100px;">
                                    <h5 id="previewName"></h5>
                                    <p id="previewPhone"></p>
                                    <p id="previewEmail"></p>
                                    <p id="previewComment"></p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="editBtn">Edit</button>
                                <button type="button" class="btn btn-success" id="finalSubmitBtn">Confirm &
                                    Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>



        <div class="pt-1 pb-4 mb-3 mb-xl-5">

            <section id="location-section" class="container p-4 mt-5 products-grid rounded-4">
                <h2 class="mb-3 text-center section-title pb-xl-3 mb-xl-4">
                    Our Shop Location <img src="<?php echo e(asset('icon/icons8-location-48.png')); ?>" alt="<?php echo e(__('Location')); ?>"
                        height="30px" width="30px">
                </h2>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d57844.96643998712!2d90.0116!3d25.023538!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3757d0c623aa02cf%3A0xac610521513a6cd2!2sSherpur%20District!5e0!3m2!1sen!2sbd!4v1739646513604!5m2!1sen!2sbd"
                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

            </section>
        </div>

    </main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .circular-image {
            width: 120px;
            /* ইমেজের সাইজ */
            height: 120px;
            /* ইমেজের সাইজ */
            border-radius: 50%;
            /* একে গোলাকার করবে */
            object-fit: cover;
            /* ইমেজের সঠিক ফিট রাখবে */
        }

        /* Large Phones (Big Screens) */
        @media (max-width: 520px) {
            #slideshow {
                margin-top: -100px !important;
            }

            .slideshow-character__img {
                margin-bottom: 110px !important;
            }

            #h100 {
                height: 460px !important;
                margin-top: 250px !important;

            }

        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    
    

    <script>
        $(document).ready(function() {
            const $wishlistCountElement = $(".js-wishlist-items-count");

            // Use event delegation for dynamically added elements
            $(document).on("click", ".js-add-wishlist", function(event) {
                event.preventDefault();

                let $button = $(this); // Store reference to `this`
                let productId = $button.data("id");
                let productName = $button.data("name");
                let productPrice = $button.data("price");
                let csrfToken = $("meta[name='csrf-token']").attr("content");

                if (!productId || !productName || !productPrice) {
                    console.error("Missing product data!", {
                        productId,
                        productName,
                        productPrice
                    });
                    alert("Product data missing! Please refresh the page.");
                    return;
                }

                if (!csrfToken) {
                    console.error("CSRF token not found!");
                    return;
                }

                $.ajax({
                    url: "/wishlist/toggle",
                    method: "POST",
                    data: JSON.stringify({
                        id: productId,
                        name: productName,
                        price: productPrice
                    }),
                    contentType: "application/json",
                    headers: {
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function(data) {
                        if (data.success) {
                            if (data.action === "added") {
                                $button.addClass("filled-heart");
                                $button.html(`
                        <svg id="icon_heart" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" fill="#f24444" />
                        </svg>
                    `);
                            } else {
                                $button.removeClass("filled-heart");
                                $button.html(`
                        <svg width="16" height="16" viewBox="0 0 20 20">
                            <use href="#icon_heart" />
                        </svg>
                    `);
                            }

                            // Update wishlist count
                            if ($wishlistCountElement.length) {
                                $wishlistCountElement.text(data.wishlist_count);
                            }
                        } else {
                            alert("Failed to update wishlist. Try again!");
                        }
                    },
                    error: function(error) {
                        console.error("AJAX Error:", error);
                        alert("Something went wrong!");
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Preview button click event
            $('#previewBtn').on('click', function() {
                var name = $('#name').val().trim();
                var phone = $('#phone').val().trim();
                var email = $('#email').val().trim();
                var comment = $('#comment').val().trim();
                var profile_picture = $('#profilePicture')[0].files[0];

                if (name === '' || phone === '' || email === '' || comment === '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Please fill in all required fields!',
                    });
                    return;
                }

                if (!isValidEmail(email)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Email',
                        text: 'Please enter a valid email address!',
                    });
                    return;
                }

                $('#previewName').text(name);
                $('#previewPhone').text('Phone: ' + phone);
                $('#previewEmail').text('Email: ' + email);
                $('#previewComment').text(comment);

                if (profile_picture) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#previewImage').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(profile_picture);
                } else {
                    $('#previewImage').attr('src', 'https://via.placeholder.com/100');
                }

                $('#previewModal').modal('show');
            });

            // Edit button click event
            $('#editBtn').on('click', function() {
                $('#previewModal').modal('hide');
            });

            // Final submit button click event (AJAX Submit)
            $('#finalSubmitBtn').on('click', function(e) {
                e.preventDefault();
                var formData = new FormData($('#feedbackForm')[0]);

                $.ajax({
                    url: "<?php echo e(route('feedback.submit')); ?>",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Thank You!',
                                text: response.message,
                            }).then(() => {
                                $('#feedbackForm')[0].reset();
                                $('#previewModal').modal('hide');
                            });
                        }
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        var errorMessage = '';

                        $.each(errors, function(key, value) {
                            errorMessage += value[0] + "\n";
                        });

                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: errorMessage,
                        });
                    }
                });
            });

            // Email validation function
            function isValidEmail(email) {
                var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailPattern.test(email);
            }
        });
    </script>


    <script>
        const customerFeedback = document.getElementById('customerFeedback');
        const feedbackForm = document.getElementById('feedback-form');
        const hideForm = document.getElementById('hideForm');
        customerFeedback.addEventListener('click', () => {
            feedbackForm.style.display = "block";
            feedbackForm.scrollIntoView({
                behavior: "smooth"
            });
        });

        hideForm.addEventListener('click', () => {
            feedbackForm.style.display = "none";

        });
    </script>

    

    <script>
        function initMap() {
            var location = {
                lat: 51.5007327,
                lng: -0.1224351
            }; // Westminster Bridge
            var map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: location,
            });
            var marker = new google.maps.Marker({
                position: location,
                map: map,
                title: "Westminster Bridge",
            });
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/devshadin/ecommercesite.dev-shadin.com/resources/views/index.blade.php ENDPATH**/ ?>