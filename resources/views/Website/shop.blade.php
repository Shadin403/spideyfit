@extends('layouts.app')

@section('title', 'Shop')
@section('content')

    <style>
        .brand-list li,
        .category-list li {
            line-height: 40px;
        }

        .brand-list li .chk-brand,
        .category-list li .chk-category {
            width: 1rem;
            height: 1rem;
            color: #e4e4e4;
            border: 0.125rem solid currentColor;
            border-radius: 0;
            margin-right: 0.75rem;
        }

        .pc__img {
            transition: transform 0.5s ease-in-out;
        }

        .pc__img:hover {
            transform: scale(1.1);
        }

        /* Loading Spinner Styles */
        #loading {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .products-grid {
            min-height: 200px;
            position: relative;

        }

        .products-grid.loading {
            opacity: 0.5;
            pointer-events: none;
        }

        .pc__atc {
            opacity: 0 !important;
            visibility: hidden !important;
            transform: translateY(10px) !important;
            transition: all 0.3s ease-in-out !important;
        }

        .product-card-wrapper:hover .pc__atc {
            opacity: 1 !important;
            visibility: visible !important;
            transform: translateY(0) !important;
        }

        /* মোবাইল ডিভাইসের জন্য সবসময় দৃশ্যমান থাকবে */
        @media (max-width: 768px) {
            .pc__atc {
                opacity: 1 !important;
                visibility: visible !important;
                transform: translateY(0) !important;
                bottom: 10px !important;


            }

            .pc__img-prev,
            .pc__img-next {
                opacity: 1 !important;
                visibility: visible !important;
                transform: translateY(0) !important;
            }

            .pc__img-prev {
                left: 5px !important;
            }

            .pc__img-next {
                right: 5px !important;
            }

            .avg-review-tooltip {
                display: none !important;
            }

        }

        .avg-review-tooltip {
            position: absolute;
            top: 10px;
            height: 30px;
            width: 130px;
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 5px 10px;
            font-size: 14px;
            font-weight: bold;
            z-index: 10;
            white-space: nowrap;
        }

        /* Large screens (desktop) */
        @media (min-width: 1024px) {
            .avg-review-tooltip {
                right: 10px;
                /* Top right */
                left: auto;
            }
        }

        /* Tablets */
        @media (min-width: 768px) and (max-width: 1023px) {
            .avg-review-tooltip {
                left: 50%;
                transform: translateX(-50%);
                /* Center */
            }
        }
    </style>



    <main class="pt-90">
        <!-- Your existing main content here -->
        <!-- Loading Spinner -->
        <div id="loading"
            style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.2);">
            <div class="d-flex align-items-center">
                <div class="spinner-border text-primary me-2" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <strong class="text-primary">Loading products...</strong>
            </div>
        </div>

        <section class="container pt-4 shop-main d-flex pt-xl-5">
            <div class="shop-sidebar side-sticky bg-body" id="shopFilter">
                <div class="aside-header d-flex d-lg-none align-items-center">
                    <h3 class="mb-0 text-uppercase fs-6">Filter By</h3>
                    <button class="btn-close-lg js-close-aside btn-close-aside ms-auto"></button>
                </div>

                <div class="pt-4 pt-lg-0"></div>

                <div class="accordion" id="categories-list">
                    <div class="pb-3 mb-4 accordion-item">
                        <h5 class="accordion-header" id="accordion-heading-1">
                            <button class="p-0 border-0 accordion-button fs-5 text-uppercase" type="button"
                                data-bs-toggle="collapse" data-bs-target="#accordion-filter-1" aria-expanded="true"
                                aria-controls="accordion-filter-1">
                                Product Categories
                                <svg class="accordion-button__icon type2" viewBox="0 0 10 6"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                        <path
                                            d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                                    </g>
                                </svg>
                            </button>
                        </h5>
                        <div id="accordion-filter-1" class="border-0 accordion-collapse collapse show"
                            aria-labelledby="accordion-heading-1" data-bs-parent="#categories-list">
                            <div class="px-0 pt-3 pb-0 accordion-body category-list">
                                <ul class="mb-0 list list-inline">
                                    @forelse ($categories as $category)
                                        <li class="list-item">
                                            <span><input type="checkbox" class="chk-category" name="categories[]"
                                                    value="{{ $category->id }}" id="category"
                                                    @if (in_array($category->id, $f_categories)) checked="checked" @endif>
                                                <a href="#" class="py-1 menu-link">{{ $category->name }}</a>
                                            </span>
                                            <span
                                                class="text-right float-end">{{ \App\Models\Product::where('category_id', $category->id)->count() }}</span>

                                        </li>
                                    @empty
                                        <p>No Categories</p>
                                    @endforelse


                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="accordion" id="color-filters">
                    <div class="pb-3 mb-4 accordion-item">
                        <h5 class="accordion-header" id="accordion-heading-1">
                            <button class="p-0 border-0 accordion-button fs-5 text-uppercase" type="button"
                                data-bs-toggle="collapse" data-bs-target="#accordion-filter-2" aria-expanded="true"
                                aria-controls="accordion-filter-2">
                                Color
                                <svg class="accordion-button__icon type2" viewBox="0 0 10 6"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                        <path
                                            d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                                    </g>
                                </svg>
                            </button>
                        </h5>
                        <div id="accordion-filter-2" class="border-0 accordion-collapse collapse show"
                            aria-labelledby="accordion-heading-1" data-bs-parent="#color-filters">
                            <div class="px-0 pb-0 accordion-body">
                                <div class="flex-wrap d-flex">
                                    <a href="#" class="swatch-color js-filter" style="color: #0a2472"></a>
                                    <a href="#" class="swatch-color js-filter" style="color: #d7bb4f"></a>
                                    <a href="#" class="swatch-color js-filter" style="color: #282828"></a>
                                    <a href="#" class="swatch-color js-filter" style="color: #b1d6e8"></a>
                                    <a href="#" class="swatch-color js-filter" style="color: #9c7539"></a>
                                    <a href="#" class="swatch-color js-filter" style="color: #d29b48"></a>
                                    <a href="#" class="swatch-color js-filter" style="color: #e6ae95"></a>
                                    <a href="#" class="swatch-color js-filter" style="color: #d76b67"></a>
                                    <a href="#" class="swatch-color swatch_active js-filter"
                                        style="color: #bababa"></a>
                                    <a href="#" class="swatch-color js-filter" style="color: #bfdcc4"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="accordion" id="size-filters">
                    <div class="pb-3 mb-4 accordion-item">
                        <h5 class="accordion-header" id="accordion-heading-size">
                            <button class="p-0 border-0 accordion-button fs-5 text-uppercase" type="button"
                                data-bs-toggle="collapse" data-bs-target="#accordion-filter-size" aria-expanded="true"
                                aria-controls="accordion-filter-size">
                                Sizes
                            </button>
                        </h5>
                        <div id="accordion-filter-size" class="border-0 accordion-collapse collapse show"
                            aria-labelledby="accordion-heading-size" data-bs-parent="#size-filters">
                            <div class="px-0 pb-0 accordion-body">
                                <div class="flex-wrap d-flex">
                                    @foreach (['XS', 'S', 'M', 'L', 'XL', 'XXL'] as $size)
                                        <a href="#"
                                            class="swatch-size1 btn btn-sm btn-primary mb-3 me-3 js-filter {{ in_array($size, $f_sizes) ? 'active' : '' }}"
                                            data-size="{{ $size }}">
                                            {{ $size }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="brand-filters">
                    <div class="pb-3 mb-4 accordion-item">
                        <h5 class="accordion-header" id="accordion-heading-brand">
                            <button class="p-0 border-0 accordion-button fs-5 text-uppercase" type="button"
                                data-bs-toggle="collapse" data-bs-target="#accordion-filter-brand" aria-expanded="true"
                                aria-controls="accordion-filter-brand">
                                Brands
                                <svg class="accordion-button__icon type2" viewBox="0 0 10 6"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                        <path
                                            d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                                    </g>
                                </svg>
                            </button>
                        </h5>
                        <div id="accordion-filter-brand" class="border-0 accordion-collapse collapse show"
                            aria-labelledby="accordion-heading-brand" data-bs-parent="#brand-filters">
                            <div class="px-0 pb-0 search-field multi-select accordion-body">
                                <ul class="mb-0 list list-inline brand-list">
                                    @forelse($brands  as $brand)
                                        <li class="list-item">

                                            <span class="py-1 menu-link">
                                                <input class="chk-brand" type="checkbox" name="brands[]"
                                                    value="{{ $brand->id }}"
                                                    @if (in_array($brand->id, $f_brands)) checked="checked" @endif>
                                                {{ $brand->name }}
                                            </span>
                                            <span
                                                class="text-right float-end">{{ \App\Models\Product::where('brand_id', $brand->id)->count() }}</span>
                                        </li>
                                    @empty
                                        <p>No Brands</p>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="accordion" id="price-filters">
                    <div class="mb-4 accordion-item">
                        <h5 class="mb-2 accordion-header" id="accordion-heading-price">
                            <button class="p-0 border-0 accordion-button fs-5 text-uppercase" type="button"
                                data-bs-toggle="collapse" data-bs-target="#accordion-filter-price" aria-expanded="true"
                                aria-controls="accordion-filter-price">
                                Price
                                <svg class="accordion-button__icon type2" viewBox="0 0 10 6"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                        <path
                                            d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                                    </g>
                                </svg>
                            </button>
                        </h5>
                        <div id="accordion-filter-price" class="border-0 accordion-collapse collapse show"
                            aria-labelledby="accordion-heading-price" data-bs-parent="#price-filters">
                            <input class="price-range-slider" type="text" name="price_range" value=""
                                id="price_range" data-slider-min="1" data-slider-max="5000" data-slider-step="5"
                                data-slider-value="[{{ $min_price }}, {{ $max_price }}]" data-currency="$" />
                            <div class="mt-2 price-range__info d-flex align-items-center">
                                <div class="me-auto">
                                    <span class="text-secondary">Min Price: </span>
                                    <span class="price-range__min">$1</span>
                                </div>
                                <div>
                                    <span class="text-secondary">Max Price: </span>
                                    <span class="price-range__max">$5000</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end" style=" margin-top: 30px; color:">
                            <a id="resetFilter" class="mb-3 swatch-size btn btn-sm btn-outline-light me-3"
                                style="color: red">Reset
                                Filters</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="shop-list flex-grow-1">
                <div class="swiper-container js-swiper-slider slideshow slideshow_small slideshow_split"
                    data-settings='{
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": 1,
            "effect": "fade",
            "loop": true,
            "pagination": {
              "el": ".slideshow-pagination",
              "type": "bullets",
              "clickable": true
            }
          }'>
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="overflow-hidden slide-split h-100 d-block d-md-flex">
                                <div class="slide-split_text position-relative d-flex align-items-center"
                                    style="background-color: #f5e6e0;">
                                    <div class="container p-3 slideshow-text p-xl-5">
                                        <h2
                                            class="mb-3 text-uppercase section-title fw-normal animate animate_fade animate_btt animate_delay-2">
                                            Man's <br /><strong>ACCESSORIES</strong></h2>
                                        <p class="mb-0 animate animate_fade animate_btt animate_delay-5">Accessories are
                                            the best way to
                                            update your look. Add a title edge with new styles and new colors, or go for
                                            timeless pieces.</h6>
                                    </div>
                                </div>
                                <div class="slide-split_media position-relative">
                                    <div class="slideshow-bg" style="background-color: #f5e6e0;">
                                        <img loading="lazy"
                                            src="{{ asset('assets/images/portrait-young-handsome-bearded-man_1303-19639.jpg ') }}"
                                            width="630" height="450" alt="Men's accessories"
                                            class="slideshow-bg__img object-fit-cover" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="overflow-hidden slide-split h-100 d-block d-md-flex">
                                <div class="slide-split_text position-relative d-flex align-items-center"
                                    style="background-color: #f5e6e0;">
                                    <div class="container p-3 slideshow-text p-xl-5">
                                        <h2
                                            class="mb-3 text-uppercase section-title fw-normal animate animate_fade animate_btt animate_delay-2">
                                            Men's <br /><strong>ACCESSORIES</strong></h2>
                                        <p class="mb-0 animate animate_fade animate_btt animate_delay-5">Accessories are
                                            the best way to
                                            update your look. Add a title edge with new styles and new colors, or go for
                                            timeless pieces.</h6>
                                    </div>
                                </div>
                                <div class="slide-split_media position-relative">
                                    <div class="slideshow-bg" style="background-color: #f5e6e0;">
                                        <img loading="lazy"
                                            src="{{ asset('assets/images/portrait-young-handsome-bearded-man_1303-19639.jpg ') }}"
                                            width="630" height="450" alt="Men's accessories"
                                            class="slideshow-bg__img object-fit-cover" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="overflow-hidden slide-split h-100 d-block d-md-flex">
                                <div class="slide-split_text position-relative d-flex align-items-center"
                                    style="background-color: #f5e6e0;">
                                    <div class="container p-3 slideshow-text p-xl-5">
                                        <h2
                                            class="mb-3 text-uppercase section-title fw-normal animate animate_fade animate_btt animate_delay-2">
                                            Men's <br /><strong>ACCESSORIES</strong></h2>
                                        <p class="mb-0 animate animate_fade animate_btt animate_delay-5">Accessories are
                                            the best way to
                                            update your look. Add a title edge with new styles and new colors, or go for
                                            timeless pieces.</h6>
                                    </div>
                                </div>
                                <div class="slide-split_media position-relative">
                                    <div class="slideshow-bg" style="background-color: #f5e6e0;">
                                        <img loading="lazy"
                                            src="{{ asset('assets/images/portrait-young-handsome-bearded-man_1303-19639.jpg ') }}"
                                            width="630" height="450" alt="Men's accessories"
                                            class="slideshow-bg__img object-fit-cover" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container p-3 p-xl-5">
                        <div
                            class="bottom-0 mb-4 slideshow-pagination d-flex align-items-center position-absolute pb-xl-2">
                        </div>

                    </div>
                </div>

                <div class="pb-2 mb-3 pb-xl-3"></div>

                <div class="mb-4 d-flex justify-content-between pb-md-2">
                    <div class="mb-0 breadcrumb d-none d-md-block flex-grow-1">
                        <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium">Home</a>
                        <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1">/</span>
                        <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium">The Shop</a>
                    </div>

                    <div
                        class="shop-acs d-flex align-items-center justify-content-between justify-content-md-end flex-grow-1">

                        <select class="order-1 w-auto py-0 border-0 shop-acs__select form-select order-md-0"
                            aria-label="Page size" id="pagesize" name="pagesize" style="margin-right: 20px">
                            <option value="9" {{ $page_size == '9' ? 'selected' : '' }}>Show</option>
                            <option value="12" {{ $page_size == '12' ? 'selected' : '' }}>12</option>
                            <option value="15" {{ $page_size == '15' ? 'selected' : '' }}>15</option>
                            <option value="21" {{ $page_size == '21' ? 'selected' : '' }}>21</option>
                            <option value="27" {{ $page_size == '27' ? 'selected' : '' }}>27</option>

                        </select>
                        <select class="order-1 w-auto py-0 border-0 shop-acs__select form-select order-md-0"
                            aria-label="Sort Items" name="orderBy" id="orderBy">
                            <option value="-1" {{ $order == '-1' ? 'selected' : '' }}>Default Sorting</option>
                            <option value="1" {{ $order == '1' ? 'selected' : '' }}>Date, new to old</option>
                            <option value="2" {{ $order == '2' ? 'selected' : '' }}>Date, old to new</option>
                            <option value="3" {{ $order == '3' ? 'selected' : '' }}>Price, low to high</option>
                            <option value="4" {{ $order == '4' ? 'selected' : '' }}>Price, high to low</option>
                        </select>
                        <div class="mx-3 shop-asc__seprator bg-light d-none d-md-block order-md-0"></div>

                        <div class="order-1 col-size align-items-center d-none d-lg-flex">
                            <span class="text-uppercase fw-medium me-2">View</span>
                            <button class="btn-link fw-medium me-2 js-cols-size" data-target="products-grid"
                                data-cols="2">2</button>
                            <button class="btn-link fw-medium me-2 js-cols-size" data-target="products-grid"
                                data-cols="3">3</button>
                            {{-- <button class="btn-link fw-medium js-cols-size" data-target="products-grid"
                                data-cols="4">4</button> --}}
                        </div>

                        <div class="shop-filter d-flex align-items-center order-0 order-md-3 d-lg-none">
                            <button class="btn-link btn-link_f d-flex align-items-center ps-0 js-open-aside"
                                data-aside="shopFilter">
                                <svg class="align-middle d-inline-block me-2" width="14" height="10"
                                    viewBox="0 0 14 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_filter" />
                                </svg>
                                <span class="align-middle text-uppercase fw-medium d-inline-block">Filter</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="products-grid row row-cols-2 row-cols-md-3" id="products-grid">
                    @forelse ($products as $product)
                        <div class="product-card-wrapper">
                            <div class="row">
                                <div class="mb-3 product-card mb-md-4 mb-xxl-5">
                                    <div class="pc__img-wrapper position-relative">
                                        <!-- Avg Rating Tooltip -->
                                        <div class="avg-review-tooltip">
                                            Avg Rating: {{ round($product->reviews->avg('rating'), 1) }} <span
                                                style="color: #FACA51">★</span>
                                        </div>

                                        <div class="swiper-container background-img js-swiper-slider"
                                            data-settings='{"resizeObserver": true}'>
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                                                    <a href="{{ route('website.shop.product.details', $product->slug) }}"><img
                                                            loading="lazy"
                                                            src="{{ asset('storage/uploads/products/' . $product->image) }}"
                                                            width="330" height="400" alt="{{ $product->name }}"
                                                            class="pc__img"></a>
                                                </div>

                                                <div class="swiper-slide">
                                                    <div class="swiper-slide">
                                                        <div class="swiper-slide">
                                                            <div class="swiper-slide">
                                                                @if (!empty($product->images))
                                                                    @php
                                                                        // ডেটা প্রসেস করা (JSON হলে ডিকোড, নাহলে explode)
                                                                        $galleryImages = is_array(
                                                                            json_decode($product->images, true),
                                                                        )
                                                                            ? json_decode($product->images, true)
                                                                            : explode(',', $product->images);
                                                                    @endphp

                                                                    {{-- গ্যালারি ইমেজ লুপ করা --}}
                                                                    @foreach ($galleryImages as $gimg)
                                                                        @if (!empty($gimg) && file_exists(public_path('storage/uploads/products/gallery/' . $gimg)))
                                                                            <a
                                                                                href="{{ route('website.shop.product.details', $product->slug) }}">
                                                                                <img loading="lazy"
                                                                                    src="{{ asset('storage/uploads/products/gallery/' . $gimg) }}"
                                                                                    width="330" height="400"
                                                                                    alt="{{ $product->name }}"
                                                                                    class="pc__img">
                                                                            </a>
                                                                        @else
                                                                            <a
                                                                                href="{{ route('website.shop.product.details', $product->slug) }}">
                                                                                <img loading="lazy"
                                                                                    src="{{ asset('storage/uploads/products/gallery/default.jpg') }}"
                                                                                    width="330" height="400"
                                                                                    alt="Default Image" class="pc__img">
                                                                            </a>
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    <img loading="lazy"
                                                                        src="{{ asset('storage/uploads/products/gallery/default.jpg') }}"
                                                                        width="330" height="400" alt="Default Image"
                                                                        class="pc__img">
                                                                @endif
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>



                                            </div>
                                            <span class="pc__img-prev"><svg width="7" height="11"
                                                    viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                                                    <use href="#icon_prev_sm" />
                                                </svg></span>
                                            <span class="pc__img-next"><svg width="7" height="11"
                                                    viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                                                    <use href="#icon_next_sm" />
                                                </svg></span>
                                        </div>

                                        @php
                                            $sizes = json_decode($product->sizes, true); // true দিয়ে অ্যারে রিটার্ন করবে
                                        @endphp
                                        @if ($product->quantity == 0)
                                            <a href="javascript:void(0)"
                                                class="mb-3 border-0 btn btn-danger pc__atc anim_appear-bottom position-absolute text-uppercase fw-medium">Out
                                                of Stock</a>
                                        @elseif(empty($sizes))
                                            <a href="javascript:void(0)"
                                                class="mb-3 border-0 btn btn-danger pc__atc anim_appear-bottom position-absolute text-uppercase fw-medium ">Sizes
                                                Unavailable</a>
                                        @else
                                            @if (Cart::instance('cart')->content()->where('id', $product->id)->count() > 0)
                                                <a href="{{ route('cart.index') }}"
                                                    class="mb-3 border-0 btn btn-warning pc__atc anim_appear-bottom position-absolute text-uppercase fw-medium">Go
                                                    to Cart</a>
                                            @else
                                                <form name="addtocart-form" method="get"
                                                    action="{{ route('website.shop.product.details', $product->slug) }}">
                                                    <button type="submit"
                                                        class="border-0 pc__atc btn anim_appear-bottom position-absolute text-uppercase fw-medium"
                                                        data-aside="cartDrawer" title="Add To Cart"> 🛒 Buy Now</button>
                                                </form>
                                            @endif
                                        @endif
                                    </div>

                                    <div class="pc__info position-relative">
                                        <p class="pc__category">{{ $product->category->name }}</p>
                                        <h6 class="pc__title"><a
                                                href="{{ route('website.shop.product.details', $product->slug) }}">{{ $product->name }}</a>
                                        </h6>
                                        <div class="product-card__price d-flex">
                                            <span class="money price">
                                                @if ($product->sale_price)
                                                    <s class="text-muted">${{ $product->regular_price }}</s>
                                                    <span style="color: red">${{ $product->sale_price }}</span>
                                                @else
                                                    <span style="color: red">${{ $product->regular_price }}</span>
                                                @endif
                                            </span>
                                        </div>
                                        <div class="product-card__review d-flex align-items-center">
                                            <div class="reviews-group d-flex">

                                                <span class="fs-6 " style="color: #FACA51;">
                                                    {{ str_repeat('★', round($product->reviews->avg('rating'))) }}{{ str_repeat('☆', 5 - round($product->reviews->avg('rating'))) }}
                                                    <span class="reviews-note text-lowercase ms-1"
                                                        style="color: black;">({{ $product->reviews->count() }}
                                                        <span style="color: gray">
                                                            Reviews</span>)</span>
                                            </div>

                                        </div>
                                        <a href="#"
                                            class="top-0 bg-transparent border-0 pc__btn-wl position-absolute end-0 js-add-wishlist {{ Cart::instance('wishlist')->content()->where('id', $product->id)->count() > 0 ? 'filled-heart' : '' }}"
                                            data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                            data-price="{{ $product->sale_price == '' ? $product->regular_price : $product->sale_price }}"
                                            title="{{ Cart::instance('wishlist')->content()->where('id', $product->id)->count() > 0 ? 'Remove From Wishlist' : 'Add To Wishlist' }}">

                                            @if (Cart::instance('wishlist')->content()->where('id', $product->id)->count() > 0)
                                                <svg id="icon_heart" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24" width="20" height="20">
                                                    <path
                                                        d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"
                                                        fill="#f24444" />
                                                </svg>
                                            @else
                                                <svg width="16" height="16" viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <use href="#icon_heart" />
                                                </svg>
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @empty
                        <h1 style="font-size: 25px; margin-left:auto; margin-right:auto; text-align:center;">Product not
                            available</h1>
                    @endforelse
                </div>

                <nav class="mt-3 shop-pages d-flex justify-content-between align-items-center"
                    aria-label="Page navigation">
                    {{ $products->links('vendor.pagination.custom-pagination') }}
                </nav>
            </div>
        </section>



    </main>

    <form id="frmfilter" action="{{ route('website.shop') }}" method="GET">
        <input type="hidden" name="page" value="{{ $products->currentPage() }}">
        <input type="hidden" name="size" id="size" value="{{ $page_size }}">
        <input type="hidden" name="order" id="order" value="{{ $order }}">
        <input type="hidden" name="brands" id="hiddenBrands" value="{{ implode(',', $f_brands) }}">
        <input type="hidden" name="categories" id="hiddenCategories" value="{{ implode(',', $f_categories) }}">
        <input type="hidden" id="hiddenMinPrice" name="min" value="{{ $min_price }}">
        <input type="hidden" id="hiddenMaxPrice" name="max" value="{{ $max_price }}">
        <input type="hidden" name="sizes" id="hiddenSizes" value="{{ implode(',', $f_sizes) }}">
    </form>

@endsection

@push('styles')
    <style>
        .swatch-size1 {
            background-color: rgb(245, 242, 242) !important;
            /* Gray background */
            color: rgb(15, 15, 15) !important;
            /* Black text */
            border: 1px solid gray !important;
            /* Border same as background */
            transition: all 0.3s ease-in-out !important;
        }

        .swatch-size1:hover,
        .swatch-size1.active {
            background-color: black !important;
            /* Black background when clicked */
            color: white !important;
            /* White text */
            border-color: black !important;
        }

        @media screen and (max-width: 768px) {
            .swatch-size1:hover {
                background-color: rgba(245, 242, 242, 0.726) !important;
            }

        }
    </style>
@endpush
@push('scripts')
    <script>
        $(function() {
            // Update products with AJAX
            function updateProducts() {
                const data = {
                    page: $('input[name="page"]').val() || 1,
                    size: $('#size').val(),
                    order: $('#order').val(),
                    brands: $('#hiddenBrands').val(),
                    categories: $('#hiddenCategories').val(),
                    min: $('#hiddenMinPrice').val(),
                    max: $('#hiddenMaxPrice').val(),
                    sizes: $('#hiddenSizes').val()
                };

                $.ajax({
                    url: $('#frmfilter').attr('action'),
                    method: 'GET',
                    data: data,
                    beforeSend: function() {
                        $('#loading').fadeIn();
                        $('#products-grid').css('opacity', '0.5');
                    },
                    success: function(response) {
                        $('#products-grid').html(response.products);
                        $('.shop-pages').html(response.pagination);



                        // // Scroll to pagination (optional)
                        // $('html, body').animate({
                        //     scrollTop: $('.shop-pages').offset().top - 100 // Adjust as needed
                        // }, 'slow');



                        // Update URL
                        const url = new URL(window.location.href);
                        Object.entries(data).forEach(([key, value]) => {
                            if (value) {
                                url.searchParams.set(key, value);
                            } else {
                                url.searchParams.delete(key);
                            }
                        });
                        history.pushState(data, '', url.toString());
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText);
                        alert('Error loading products. Please try again.');
                    },
                    complete: function() {
                        $('#loading').fadeOut();
                        $('#products-grid').css('opacity', '1');
                    }
                });
            }

            // Event Handlers
            $('#pagesize, #orderBy').change(function() {
                const target = $(this).attr('id') === 'pagesize' ? 'size' : 'order';
                $(`#${target}`).val($(this).val());
                $('input[name="page"]').val(1);
                updateProducts();
            });

            $('input[name="brands[]"], input[name="categories[]"]').change(function() {
                const type = $(this).attr('name').replace('[]', '');
                const values = $(`input[name="${type}[]"]:checked`).map(function() {
                    return this.value;
                }).get().join(',');
                $(`#hidden${type.charAt(0).toUpperCase() + type.slice(1)}`).val(values);
                $('input[name="page"]').val(1);
                updateProducts();
            });

            $('input[name="price_range"]').on('change', function() {
                const [min, max] = $(this).val().split(',');
                $('#hiddenMinPrice').val(min);
                $('#hiddenMaxPrice').val(max);
                $('input[name="page"]').val(1);
                updateProducts();
            });

            $('.swatch-size1').click(function(e) {
                e.preventDefault();
                $(this).toggleClass('active');

                const activeSizes = $('.swatch-size1.active').map(function() {
                    return $(this).data('size');
                }).get().join(',');

                $('#hiddenSizes').val(activeSizes);
                $('input[name="page"]').val(1);
                updateProducts();
            });
            // Reset Filter Button
            $('#resetFilter').click(function() {
                // Reset input values
                $('#size, #order').val('');
                $('#hiddenBrands, #hiddenCategories, #hiddenMinPrice, #hiddenMaxPrice, #hiddenSizes').val(
                    '');

                // Uncheck all checkboxes
                $('input[name="brands[]"], input[name="categories[]"]').prop('checked', false);

                // Reset page number
                $('input[name="page"]').val(1);

                $('html, body').animate({
                    scrollTop: $('#products-grid').offset().bottom - 100
                }, 'fast');


                // Update products after reset
                updateProducts();
            });
            // Pagination Handler
            $(document).on('click', '.shop-pages a', function(e) {
                e.preventDefault();
                const page = $(this).attr('href').split('page=')[1];

                $('input[name="page"]').val(page);
                updateProducts();
                $('html, body').animate({
                    scrollTop: $('#products-grid').offset().top - 100
                }, 'fast');
            });

            // Browser History Handler
            window.onpopstate = function(event) {
                if (event.state) {
                    Object.entries(event.state).forEach(([key, value]) => {
                        $(`#${key}, input[name="${key}"]`).val(value);

                        if (key === 'categories' || key === 'brands') {
                            const values = value ? value.split(',') : [];
                            $(`input[name="${key}[]"]`).prop('checked', false);
                            values.forEach(v => {
                                $(`input[name="${key}[]"][value="${v}"]`).prop('checked', true);
                            });
                        }

                        if (key === 'sizes') {
                            $('.swatch-size1').removeClass('active');
                            const sizes = value ? value.split(',') : [];
                            sizes.forEach(size => {
                                $(`.swatch-size1[data-size="${size}"]`).addClass('active');
                            });
                        }
                    });
                    updateProducts();
                }
            };

            // Load from URL params
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.toString()) {
                urlParams.forEach((value, key) => {
                    $(`#${key}, input[name="${key}"]`).val(value);

                    if (key === 'categories' || key === 'brands') {
                        const values = value.split(',');
                        values.forEach(v => {
                            $(`input[name="${key}[]"][value="${v}"]`).prop('checked', true);
                        });
                    }

                    if (key === 'sizes') {
                        const sizes = value.split(',');
                        sizes.forEach(size => {
                            $(`.swatch-size1[data-size="${size}"]`).addClass('active');
                        });
                    }
                });
            }
        });
    </script>

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
@endpush
