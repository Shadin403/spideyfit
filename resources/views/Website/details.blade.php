@extends('layouts.app')

@section('title', $product->name)

@section('content')

    <style>
        @media (max-width: 768px) {
            .pc__atc {
                opacity: 1 !important;
                visibility: visible !important;
                transform: translateY(0) !important;
                bottom: 10px !important;


            }

            .avg-review-tooltip {
                display: none !important;
            }

        }

        .avg-review-tooltip {
            position: absolute;
            top: 10px;
            left: 190px;
            height: 30px;
            width: 130px;
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 5px 10px;
            /* border-radius: 8px; */
            font-size: 14px;
            font-weight: bold;
            z-index: 10;
            white-space: nowrap;

        }
    </style>
    <main class="pt-90">
        <div class="mb-md-1 pb-md-3"></div>
        <section class="container product-single">
            <div class="row">
                <div class="col-lg-7">
                    <div class="product-single__media" data-media-type="vertical-thumbnail">
                        <div class="product-single__image">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide product-single__image-item">
                                        @if (!empty($product->image))
                                            <img loading="lazy" class="h-auto" id="product-image"
                                                src="{{ asset('storage/uploads/products/' . $product->image) }}"
                                                width="674" height="674" alt="" />
                                            <a data-fancybox="gallery"
                                                href="{{ asset('storage/uploads/products/' . $product->image) }}"
                                                data-bs-toggle="tooltip" data-bs-placement="left" title="Zoom">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <use href="#icon_zoom" />
                                                </svg>
                                            </a>
                                        @else
                                            <p style="text-align: center">Image Unavailable</p>
                                        @endif

                                    </div>

                                    @if (!empty($product->images))
                                        @php

                                            $galleryImages = is_array(json_decode($product->images, true))
                                                ? json_decode($product->images, true)
                                                : explode(',', $product->images);
                                        @endphp


                                        @foreach ($galleryImages as $gimg)
                                            @if (!empty($gimg) && file_exists(public_path('storage/uploads/products/gallery/' . $gimg)))
                                                <div class="swiper-slide product-single__image-item">
                                                    <img loading="lazy" class="h-auto"
                                                        src="{{ asset('storage/uploads/products/gallery/' . $gimg) }}"
                                                        width="674" height="674" alt="" />
                                                    <a data-fancybox="gallery"
                                                        href="{{ asset('storage/uploads/products/gallery/' . $gimg) }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="left" title="Zoom">
                                                        <svg width="16" height="16" viewBox="0 0 16 16"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <use href="#icon_zoom" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <div class="swiper-slide product-single__image-item">
                                            <img loading="lazy" class="h-auto" style="display: none"
                                                src="{{ asset('storage/assets/images/no-image.jpg') }}" width="674"
                                                height="674" alt="{{ $product->name }}" />
                                            <p style="text-align: center">Image Unavailable</p>
                                        </div>
                                    @endif

                                </div>
                                <div class="swiper-button-prev"><svg width="7" height="11" viewBox="0 0 7 11"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_prev_sm" />
                                    </svg></div>
                                <div class="swiper-button-next"><svg width="7" height="11" viewBox="0 0 7 11"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_next_sm" />
                                    </svg></div>
                            </div>
                        </div>
                        <div class="product-single__thumbnail">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide product-single__image-item"><img loading="lazy" class="h-auto"
                                            src=" {{ asset('storage/uploads/products/' . $product->image) }} "
                                            width="104" height="104" alt="" /></div>
                                    @if (!empty($product->images))
                                        @php

                                            $galleryImages = is_array(json_decode($product->images, true))
                                                ? json_decode($product->images, true)
                                                : explode(',', $product->images);
                                        @endphp

                                        @if (!empty($galleryImages))
                                            {{-- যদি গ্যালারি ইমেজ থাকে --}}
                                            @foreach ($galleryImages as $galleryImage)
                                                <div class="swiper-slide product-single__image-item">
                                                    <img loading="lazy" class="h-auto"
                                                        src="{{ asset('storage/uploads/products/gallery/' . $galleryImage) }}"
                                                        width="104" height="104" alt="{{ $product->name }}" />
                                                </div>
                                            @endforeach
                                        @else
                                            <p>No images available</p>
                                        @endif
                                    @else
                                        <p>No images available</p>
                                    @endif




                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="mb-4 d-flex justify-content-between pb-md-2">
                        <div class="mb-0 breadcrumb d-none d-md-block flex-grow-1">
                            <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium">Home</a>
                            <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1">/</span>
                            <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium">The Shop</a>
                        </div><!-- /.breadcrumb -->

                        <div
                            class="product-single__prev-next d-flex align-items-center justify-content-between justify-content-md-end flex-grow-1">

                            <a href="{{ route('website.shop.product.details', $product->slug) }}"
                                class="text-uppercase fw-medium"><svg width="10" height="10" viewBox="0 0 25 25"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_prev_md" />
                                </svg><span class="menu-link menu-link_us-s">Prev</span></a>
                            <a href="{{ route('website.shop.product.details', $product->slug) }}"
                                class="text-uppercase fw-medium"><span class="menu-link menu-link_us-s">Next</span><svg
                                    width="10" height="10" viewBox="0 0 25 25"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_next_md" />
                                </svg></a>
                        </div><!-- /.shop-acs -->
                    </div>
                    <h1 class="product-single__name">{{ $product->name }}</h1>
                    <div class="product-single__rating">
                        <div class="reviews-group d-flex">

                            <span class="fs-3 "
                                style="color: #FACA51">{{ str_repeat('★', round($product->reviews->avg('rating'))) }}{{ str_repeat('☆', 5 - round($product->reviews->avg('rating'))) }}</span>
                        </div>
                        <span class="reviews-note text-lowercase text-secondary ms-1"><b
                                style="color: rgb(0, 0, 0)">({{ $product->reviews->count() }} <span
                                    style="color: gray">Customer
                                    Reviews</span>
                                )</b></span>
                    </div>
                    <div class="product-single__price">

                        <span class="current-price"><span class="money price">
                                <span class="text-uppercase">Price: <span />
                                    @if ($product->sale_price)
                                        <s style="color: gray">${{ $product->regular_price }}</s>
                                        <span style="color: red"> ${{ $product->regular_price }}</span>
                                    @else
                                        <span style="color: red"> ${{ $product->regular_price }}</span>
                                    @endif
                                </span></span>
                    </div>
                    <div class="product-single__short-desc">
                        <pre><h6>{{ $product->short_description }}</h6></pre>
                    </div>

                    @if ($product->quantity == 0)
                        <div class="product-single__short-desc">
                            <pre><h2 style="color: red">Product is out of stock</h2></pre>
                        </div>

                        <div class="product-single__addtolinks">
                            <div>
                                @if (Cart::instance('wishlist')->content()->where('id', $product->id)->count() > 0)
                                    <a href="javascript:void(0);" style="margin-top: 15px;"
                                        class="bg-transparent border-0 menu-link menu-link_us-s add-to-wishlist filled-heart js-add-wishlist"
                                        title="Remove from Wishlist" data-id="{{ $product->id }}"
                                        data-name="{{ $product->name }}"
                                        data-price="{{ $product->sale_price == '' ? $product->regular_price : $product->sale_price }}">
                                        <svg id="icon_heart" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            width="24" height="24">
                                            <path
                                                d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"
                                                fill="#f24444" />
                                        </svg>
                                        <span style="font-weight: bold; font-size: 10px; color: rgb(201, 145, 61);">Remove
                                            Wishlist</span>
                                    </a>
                                @else
                                    <a href="javascript:void(0);" style="margin-top: 5px;"
                                        class="menu-link menu-link_us-s add-to-wishlist js-add-wishlist"
                                        title="Add To Wishlist" data-id="{{ $product->id }}"
                                        data-name="{{ $product->name }}"
                                        data-price="{{ $product->sale_price == '' ? $product->regular_price : $product->sale_price }}">
                                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <use href="#icon_heart" />
                                        </svg>
                                        <span> Add to Wishlist</span>
                                    </a>
                                @endif
                            </div>
                            <share-button class="share-button" style="margin-top: 20px;">
                                <button
                                    class="bg-transparent border-0 menu-link menu-link_us-s to-share d-flex align-items-center">
                                    <svg width="16" height="19" viewBox="0 0 16 19" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_sharing" />
                                    </svg>
                                    <span>Share</span>
                                </button>
                                <details id="Details-share-template__main" class="m-1 xl:m-1.5" hidden="">
                                    <summary class="btn-solid m-1 xl:m-1.5 pt-3.5 pb-3 px-5">+</summary>
                                    <div id="Article-share-template__main"
                                        class="absolute left-0 z-10 flex items-center w-full px-2 py-4 border-t share-button__fallback top-full bg-container shadow-theme">
                                        <div class="mr-4 field grow">
                                            <label class="sr-only field__label" for="url">Link</label>
                                            <input type="text" class="w-full field__input" id="url"
                                                value="https://uomo-crystal.myshopify.com/blogs/news/go-to-wellness-tips-for-mental-health"
                                                placeholder="Link" onclick="this.select();" readonly="">
                                        </div>
                                        <button class="share-button__copy no-js-hidden">
                                            <svg class="inline-block mr-1 icon icon-clipboard" width="11"
                                                height="13" fill="none" xmlns="http://www.w3.org/2000/svg"
                                                aria-hidden="true" focusable="false" viewBox="0 0 11 13">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M2 1a1 1 0 011-1h7a1 1 0 011 1v9a1 1 0 01-1 1V1H2zM1 2a1 1 0 00-1 1v9a1 1 0 001 1h7a1 1 0 001-1V3a1 1 0 00-1-1H1zm0 10V3h7v9H1z"
                                                    fill="currentColor"></path>
                                            </svg>
                                            <span class="sr-only">Copy link</span>
                                        </button>
                                    </div>
                                </details>
                            </share-button>

                        </div>
                    @else
                        @if (Cart::instance('cart')->content()->where('id', $product->id)->count() > 0)

                            {{-- add to  cart after --}}
                            <p class="text-center " style="color: green">Product is already in Go to Cart</p>
                            <div class="accordion" id="size-filters">
                                <div class="pb-3 mb-4 accordion-item">
                                    <h5 class="accordion-header" id="accordion-heading-size">
                                        <button class="p-0 border-0 accordion-button fs-5 text-uppercase" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#accordion-filter-size"
                                            aria-expanded="true" aria-controls="accordion-filter-size">
                                            Available Sizes
                                            <svg class="accordion-button__icon type2" viewBox="0 0 10 6"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                                    <path
                                                        d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                                                </g>
                                            </svg>
                                        </button>
                                    </h5>
                                    <div id="accordion-filter-size" class="border-0 accordion-collapse collapse show"
                                        aria-labelledby="accordion-heading-size" data-bs-parent="#size-filters">
                                        <div class="px-0 pb-0 accordion-body">
                                            <div class="flex-wrap d-flex">
                                                @php
                                                    $sizeLabels = [
                                                        'xs' => 'Extra Small(XS)',
                                                        's' => 'Small (S)',
                                                        'm' => 'Medium (M)',
                                                        'l' => 'Large (L)',
                                                        'xl' => 'Extra Large (XL)',
                                                        'xxl' => 'Double Extra Large (XXL)',
                                                    ];
                                                    $sizes = json_decode($product->sizes);

                                                @endphp
                                                @if (!empty($sizes))
                                                    <select class="form-select" name="size" id="size"
                                                        onchange="updateHiddenSize()">
                                                        <option value="">Select Size</option>
                                                        @if (!empty($sizes))
                                                            @foreach ($sizes as $size)
                                                                <option value="{{ $size }}">
                                                                    {{ $sizeLabels[strtolower($size)] ?? strtoupper($size) }}
                                                                </option>
                                                            @endforeach
                                                        @else
                                                            <option value="">No sizes available</option>
                                                        @endif
                                                    </select>
                                                @else
                                                    <h1 class="text-center text-danger">No sizes available"></h1>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form name="addtocart-form" method="post" action="{{ route('cart.add') }}">
                                @csrf
                                <div class="product-single__addtocart">
                                    <div class="qty-control position-relative">
                                        <input type="number" name="quantity" value="1" min="1"
                                            class="text-center qty-control__number">
                                        <div class="qty-control__reduce">-</div>
                                        <div class="qty-control__increase">+</div>
                                    </div><!-- .qty-control -->
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <input type="hidden" name="name" value="{{ $product->name }}">
                                    <input type="hidden" name="size" id="selected_size" value="">
                                    <input type="hidden" name="price"
                                        value="{{ $product->sale_price == '' ? $product->regular_price : $product->sale_price }}">
                                    <button type="submit" class="btn btn-primary btn-addtocart"
                                        data-aside="cartDrawer">Add to Cart</button>
                                </div>
                            </form>
                            <div class="product-single__addtolinks">
                                <div>
                                    @if (Cart::instance('wishlist')->content()->where('id', $product->id)->count() > 0)
                                        <a href="javascript:void(0);" style="margin-top: 15px;"
                                            class="bg-transparent border-0 menu-link menu-link_us-s add-to-wishlist filled-heart js-add-wishlist"
                                            title="Remove from Wishlist" data-id="{{ $product->id }}"
                                            data-name="{{ $product->name }}"
                                            data-price="{{ $product->sale_price == '' ? $product->regular_price : $product->sale_price }}">
                                            <svg id="icon_heart" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                width="24" height="24">
                                                <path
                                                    d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"
                                                    fill="#f24444" />
                                            </svg>
                                            <span
                                                style="font-weight: bold; font-size: 10px; color: rgb(201, 145, 61);">Remove
                                                Wishlist</span>
                                        </a>
                                    @else
                                        <a href="javascript:void(0);" style="margin-top: 5px;"
                                            class="menu-link menu-link_us-s add-to-wishlist js-add-wishlist"
                                            title="Add To Wishlist" data-id="{{ $product->id }}"
                                            data-name="{{ $product->name }}"
                                            data-price="{{ $product->sale_price == '' ? $product->regular_price : $product->sale_price }}">
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_heart" />
                                            </svg>
                                            <span> Add to Wishlist</span>
                                        </a>
                                    @endif
                                </div>
                                <share-button class="share-button" style="margin-top: 20px;">
                                    <button
                                        class="bg-transparent border-0 menu-link menu-link_us-s to-share d-flex align-items-center">
                                        <svg width="16" height="19" viewBox="0 0 16 19" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <use href="#icon_sharing" />
                                        </svg>
                                        <span>Share</span>
                                    </button>
                                    <details id="Details-share-template__main" class="m-1 xl:m-1.5" hidden="">
                                        <summary class="btn-solid m-1 xl:m-1.5 pt-3.5 pb-3 px-5">+</summary>
                                        <div id="Article-share-template__main"
                                            class="absolute left-0 z-10 flex items-center w-full px-2 py-4 border-t share-button__fallback top-full bg-container shadow-theme">
                                            <div class="mr-4 field grow">
                                                <label class="sr-only field__label" for="url">Link</label>
                                                <input type="text" class="w-full field__input" id="url"
                                                    value="https://uomo-crystal.myshopify.com/blogs/news/go-to-wellness-tips-for-mental-health"
                                                    placeholder="Link" onclick="this.select();" readonly="">
                                            </div>
                                            <button class="share-button__copy no-js-hidden">
                                                <svg class="inline-block mr-1 icon icon-clipboard" width="11"
                                                    height="13" fill="none" xmlns="http://www.w3.org/2000/svg"
                                                    aria-hidden="true" focusable="false" viewBox="0 0 11 13">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M2 1a1 1 0 011-1h7a1 1 0 011 1v9a1 1 0 01-1 1V1H2zM1 2a1 1 0 00-1 1v9a1 1 0 001 1h7a1 1 0 001-1V3a1 1 0 00-1-1H1zm0 10V3h7v9H1z"
                                                        fill="currentColor"></path>
                                                </svg>
                                                <span class="sr-only">Copy link</span>
                                            </button>
                                        </div>
                                    </details>
                                </share-button>
                                <script src="js/details-disclosure.html" defer="defer"></script>
                                <script src="js/share.html" defer="defer"></script>
                            </div>
                        @else
                            {{-- <div class="accordion" id="color-filters">
                                <div class="pb-3 mb-4 accordion-item">
                                    <h5 class="accordion-header" id="accordion-heading-1">
                                        <button class="p-0 border-0 accordion-button fs-5 text-uppercase" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#accordion-filter-2"
                                            aria-expanded="true" aria-controls="accordion-filter-2">
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
                                                <select id="color-select" class="form-select" name="color">
                                                    <option>Select Color</option>
                                                    <option value="#0a2472"
                                                        style="background-color: #0a2472; color: white;"><span
                                                            style="color: #0a2472 !important ;">Navy
                                                            Blue</span></option>
                                                    <option value="#d7bb4f"
                                                        style="background-color: #d7bb4f; cursor: none;">Golden
                                                    </option>
                                                    <option value="#282828"
                                                        style="background-color: #282828; color: white;">Black</option>
                                                    <option value="#b1d6e8" style="background-color: #b1d6e8;">Light Blue
                                                    </option>
                                                    <option value="#9c7539" style="background-color: #9c7539;">Brown
                                                    </option>
                                                    <option value="#d29b48" style="background-color: #d29b48;">Light Brown
                                                    </option>
                                                    <option value="#e6ae95" style="background-color: #e6ae95;">Peach
                                                    </option>
                                                    <option value="#d76b67" style="background-color: #d76b67;">Red
                                                    </option>
                                                    <option value="#bababa" style="background-color: #bababa;">Gray
                                                    </option>
                                                    <option value="#bfdcc4" style="background-color: #bfdcc4;">Light Green
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            {{-- add to cart Before --}}
                            <div class="accordion" id="size-filters">
                                <div class="pb-3 mb-4 accordion-item">
                                    <h5 class="accordion-header" id="accordion-heading-size">
                                        <button class="p-0 border-0 accordion-button fs-5 text-uppercase" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#accordion-filter-size"
                                            aria-expanded="true" aria-controls="accordion-filter-size">
                                            Available Sizes
                                            <svg class="accordion-button__icon type2" viewBox="0 0 10 6"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                                    <path
                                                        d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                                                </g>
                                            </svg>
                                        </button>
                                    </h5>
                                    <div id="accordion-filter-size" class="border-0 accordion-collapse collapse show"
                                        aria-labelledby="accordion-heading-size" data-bs-parent="#size-filters">
                                        <div class="px-0 pb-0 accordion-body">
                                            <div class="flex-wrap d-flex">
                                                @php
                                                    $sizeLabels = [
                                                        'xs' => 'Extra Small(XS)',
                                                        's' => 'Small (S)',
                                                        'm' => 'Medium (M)',
                                                        'l' => 'Large (L)',
                                                        'xl' => 'Extra Large (XL)',
                                                        'xxl' => 'Double Extra Large (XXL)',
                                                    ];
                                                    $sizes = json_decode($product->sizes);

                                                @endphp
                                                <select class="form-select" name="size" id="size"
                                                    onchange="updateHiddenSize()">
                                                    <option value="">Select Size</option>
                                                    @if (!empty($sizes))
                                                        @foreach ($sizes as $size)
                                                            <option value="{{ $size }}">
                                                                {{ $sizeLabels[strtolower($size)] ?? strtoupper($size) }}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        <option value="">No sizes available</option>
                                                    @endif
                                                </select>
                                                {{-- <select id="pa_size" class="" name="attribute_pa_size"
                                                    data-attribute_name="attribute_pa_size" data-show_option_none="yes">
                                                    <option value="">Choose an option</option>
                                                    <option value="medium" class="attached enabled">Medium</option>
                                                </select> --}}
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form name="addtocart-form" method="post" action="{{ route('cart.add') }}">
                                @csrf
                                <div class="product-single__addtocart">
                                    <div class="qty-control position-relative">
                                        <input type="number" name="quantity" value="1" min="1"
                                            class="text-center qty-control__number">
                                        <div class="qty-control__reduce">-</div>
                                        <div class="qty-control__increase">+</div>
                                    </div><!-- .qty-control -->
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <input type="hidden" name="name" value="{{ $product->name }}">
                                    <input type="hidden" name="size" id="selected_size" value="">
                                    <input type="hidden" name="price"
                                        value="{{ $product->sale_price == '' ? $product->regular_price : $product->sale_price }}">
                                    <button type="submit" class="btn btn-primary btn-addtocart"
                                        data-aside="cartDrawer">Add to Cart</button>
                                </div>
                            </form>
                            <div class="product-single__addtolinks">
                                <div>
                                    @if (Cart::instance('wishlist')->content()->where('id', $product->id)->count() > 0)
                                        <a href="javascript:void(0);" style="margin-top: 15px;"
                                            class="bg-transparent border-0 menu-link menu-link_us-s add-to-wishlist filled-heart js-add-wishlist"
                                            title="Remove from Wishlist" data-id="{{ $product->id }}"
                                            data-name="{{ $product->name }}"
                                            data-price="{{ $product->sale_price == '' ? $product->regular_price : $product->sale_price }}">
                                            <svg id="icon_heart" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                width="24" height="24">
                                                <path
                                                    d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"
                                                    fill="#f24444" />
                                            </svg>
                                            <span
                                                style="font-weight: bold; font-size: 10px; color: rgb(201, 145, 61);">Remove
                                                Wishlist</span>
                                        </a>
                                    @else
                                        <a href="javascript:void(0);" style="margin-top: 5px;"
                                            class="menu-link menu-link_us-s add-to-wishlist js-add-wishlist"
                                            title="Add To Wishlist" data-id="{{ $product->id }}"
                                            data-name="{{ $product->name }}"
                                            data-price="{{ $product->sale_price == '' ? $product->regular_price : $product->sale_price }}">
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_heart" />
                                            </svg>
                                            <span> Add to Wishlist</span>
                                        </a>
                                    @endif
                                </div>
                                <share-button class="share-button" style="margin-top: 20px;">
                                    <button
                                        class="bg-transparent border-0 menu-link menu-link_us-s to-share d-flex align-items-center">
                                        <svg width="16" height="19" viewBox="0 0 16 19" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <use href="#icon_sharing" />
                                        </svg>
                                        <span>Share</span>
                                    </button>
                                    <details id="Details-share-template__main" class="m-1 xl:m-1.5" hidden="">
                                        <summary class="btn-solid m-1 xl:m-1.5 pt-3.5 pb-3 px-5">+</summary>
                                        <div id="Article-share-template__main"
                                            class="absolute left-0 z-10 flex items-center w-full px-2 py-4 border-t share-button__fallback top-full bg-container shadow-theme">
                                            <div class="mr-4 field grow">
                                                <label class="sr-only field__label" for="url">Link</label>
                                                <input type="text" class="w-full field__input" id="url"
                                                    value="https://uomo-crystal.myshopify.com/blogs/news/go-to-wellness-tips-for-mental-health"
                                                    placeholder="Link" onclick="this.select();" readonly="">
                                            </div>
                                            <button class="share-button__copy no-js-hidden">
                                                <svg class="inline-block mr-1 icon icon-clipboard" width="11"
                                                    height="13" fill="none" xmlns="http://www.w3.org/2000/svg"
                                                    aria-hidden="true" focusable="false" viewBox="0 0 11 13">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M2 1a1 1 0 011-1h7a1 1 0 011 1v9a1 1 0 01-1 1V1H2zM1 2a1 1 0 00-1 1v9a1 1 0 001 1h7a1 1 0 001-1V3a1 1 0 00-1-1H1zm0 10V3h7v9H1z"
                                                        fill="currentColor"></path>
                                                </svg>
                                                <span class="sr-only">Copy link</span>
                                            </button>
                                        </div>
                                    </details>
                                </share-button>
                                <script src="js/details-disclosure.html" defer="defer"></script>
                                <script src="js/share.html" defer="defer"></script>
                            </div>
                        @endif

                        <div class="product-single__addtolinks">

                            <share-button class="share-button">
                                <button
                                    class="bg-transparent border-0 menu-link menu-link_us-s to-share d-flex align-items-center">

                                    <div class="radio-wrapper">
                                        <label class="radio-container">
                                            <div style="display: flex">
                                                <input type="radio" name="stock" checked>
                                                <span class="radio-circle"></span>
                                                <span class="radio-text">{{ $product->quantity }} in stock</span>
                                            </div>


                                        </label>
                                    </div>
                                </button>
                                <details id="Details-share-template__main" class="m-1 xl:m-1.5" hidden="">
                                    <summary class="btn-solid m-1 xl:m-1.5 pt-3.5 pb-3 px-5">+</summary>
                                    <div id="Article-share-template__main"
                                        class="absolute left-0 z-10 flex items-center w-full px-2 py-4 border-t share-button__fallback top-full bg-container shadow-theme">
                                        <div class="mr-4 field grow">
                                            <label class="sr-only field__label" for="url">Link</label>
                                            <input type="text" class="w-full field__input" id="url"
                                                value="https://uomo-crystal.myshopify.com/blogs/news/go-to-wellness-tips-for-mental-health"
                                                placeholder="Link" onclick="this.select();" readonly="">
                                        </div>
                                        <button class="share-button__copy no-js-hidden">
                                            <svg class="inline-block mr-1 icon icon-clipboard" width="11"
                                                height="13" fill="none" xmlns="http://www.w3.org/2000/svg"
                                                aria-hidden="true" focusable="false" viewBox="0 0 11 13">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M2 1a1 1 0 011-1h7a1 1 0 011 1v9a1 1 0 01-1 1V1H2zM1 2a1 1 0 00-1 1v9a1 1 0 001 1h7a1 1 0 001-1V3a1 1 0 00-1-1H1zm0 10V3h7v9H1z"
                                                    fill="currentColor"></path>
                                            </svg>
                                            <span class="sr-only">Copy link</span>
                                        </button>
                                    </div>
                                </details>
                            </share-button>

                        </div>
                    @endif
                    <div class="product-single__meta-info">
                        <div class="meta-item">
                            <label>SKU:</label>
                            <span>{{ $product->SKU }}</span>
                        </div>
                        <div class="meta-item">
                            <label>Categories:</label>
                            <span>{{ $product->category->name }}</span>
                        </div>
                        <div class="meta-item">
                            <label>Tags:</label>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-single__details-tab">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link_underscore active" id="tab-description-tab" data-bs-toggle="tab"
                            href="#tab-description" role="tab" aria-controls="tab-description"
                            aria-selected="true">Description</a>
                    </li>
                    {{-- <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link_underscore" id="tab-additional-info-tab" data-bs-toggle="tab"
                            href="#tab-additional-info" role="tab" aria-controls="tab-additional-info"
                            aria-selected="false">Additional Information</a>
                    </li> --}}
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link_underscore" id="tab-reviews-tab" data-bs-toggle="tab"
                            href="#tab-reviews" role="tab" aria-controls="tab-reviews" aria-selected="false">Reviews
                            ({{ $product->reviews->count() }})</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-description" role="tabpanel"
                        aria-labelledby="tab-description-tab">
                        <div class="product-single__description">
                            <pre><h6>{{ $product->description }}</h6></pre>
                        </div>
                    </div>
                    {{-- <div class="tab-pane fade" id="tab-additional-info" role="tabpanel"
                        aria-labelledby="tab-additional-info-tab">
                        <div class="product-single__addtional-info">
                            <div class="item">
                                <label class="h6">Weight</label>
                                <span>1.25 kg</span>
                            </div>
                            <div class="item">
                                <label class="h6">Dimensions</label>
                                <span>90 x 60 x 90 cm</span>
                            </div>
                            <div class="item">
                                <label class="h6">Size</label>
                                <span>XS, S, M, L, XL</span>
                            </div>
                            <div class="item">
                                <label class="h6">Color</label>
                                <span>Black, Orange, White</span>
                            </div>
                            <div class="item">
                                <label class="h6">Storage</label>
                                <span>Relaxed fit shirt-style dress with a rugged</span>
                            </div>
                        </div>
                    </div> --}}
                    <div class="tab-pane fade" id="tab-reviews" role="tabpanel" aria-labelledby="tab-reviews-tab">
                        <div id="loading"
                            style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.2);">
                            <div class="d-flex align-items-center">
                                <div class="spinner-border text-primary me-2" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <strong class="text-primary">Loading reviews...</strong>
                            </div>
                        </div>
                        <div class="p-4 rounded shadow-lg product-single__review-form " style="color: white;">
                            <form action="{{ route('user.review.store') }}" method="POST">
                                @csrf
                                <h3>{{ $product->name }}</h3>
                                <h4 class="mb-3 text-primary">Share Your Experience About This Product </h4>
                                <p class="text-muted">Your email address will not be published. Required fields are marked
                                    *</p>

                                <div class="mb-3 select-star-rating">
                                    <label class="font-weight-bold">Your rating *</label>
                                    <div class="gap-2 star-rating d-flex">
                                        @for ($i = 5; $i >= 1; $i--)
                                            <input type="radio" id="star{{ $i }}" name="rating"
                                                value="{{ $i }}" />

                                            <label for="star{{ $i }}" class="star"
                                                title="{{ $i }} Stars">&#9733;</label>
                                        @endfor
                                    </div>
                                </div>

                                <div class="mb-3 form-group">
                                    <textarea name="review" class="form-control" placeholder="Write your review here..." cols="30" rows="4"
                                        required></textarea>
                                </div>

                                <input type="hidden" name="product_id" value="{{ $product->id }}">


                                <div class="form-action">
                                    <button type="submit" class="btn btn-primary">Review Submit</button>
                                </div>
                            </form>
                        </div>
                        <h2 class="mt-5 text-secondary">Customer Reviews</h2>
                        <div class="p-4 mb-4 bg-white rounded shadow-sm rating-summary">
                            <h4 class="text-dark">Overall Rating:
                                {{ number_format($product->reviews->avg('rating'), 1) }}/5</h4>
                            <div class="d-flex align-items-center">
                                <span class="fs-3 "
                                    style="color: #FACA51;">{{ str_repeat('★', round($product->reviews->avg('rating'))) }}{{ str_repeat('☆', 5 - round($product->reviews->avg('rating'))) }}</span>
                                <span class="ms-2">({{ $product->reviews->count() }} Ratings)</span>
                            </div>
                            <div class="mt-3 rating-breakdown">
                                @for ($i = 5; $i >= 1; $i--)
                                    @php
                                        $ratingCount = $product->reviews->where('rating', $i)->count();
                                        $percentage =
                                            $product->reviews->count() > 0
                                                ? ($ratingCount / $product->reviews->count()) * 100
                                                : 0;
                                    @endphp
                                    <div class="d-flex align-items-center">
                                        <span class=""
                                            style="color: #FACA51;">{{ str_repeat('★', $i) }}{{ str_repeat('☆', 5 - $i) }}</span>
                                        <div class="mx-3 progress w-50">
                                            <div class="progress-bar"
                                                style="width: {{ $percentage }}% ; background-color: #FACA51;">
                                            </div>
                                        </div>
                                        <span>{{ $ratingCount }}</span>
                                    </div>
                                @endfor
                            </div>
                        </div>

                        <h2 class="mt-5 product-single__reviews-title">Reviews</h2>
                        <div class="product-single__reviews-list">
                            <!-- Reviews Container -->
                            <div class="product-single__reviews-list">
                                <!-- Reviews Container -->
                                <div class="reviews-container">
                                    @if ($reviews->isNotEmpty())
                                        @foreach ($reviews as $review)
                                            <div class="product-single__reviews-item">
                                                <div class="customer-avatar">
                                                    <img loading="lazy"
                                                        src="{{ asset('images/avatar/avatar-icon0002_750950-43-removebg-preview.png') }}"
                                                        alt="User Avatar" />
                                                </div>
                                                <div class="customer-review">
                                                    <div class="customer-name">
                                                        <h6>{{ $review->user->name }}</h6>
                                                        <div class="reviews-group d-flex">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <svg class="review-star" viewBox="0 0 9 9"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <use href="#icon_star"
                                                                        style="fill: {{ $i <= $review->rating ? '#FACA51' : '#ccc' }};" />
                                                                </svg>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <div class="review-date">{{ $review->created_at->format('F d, Y') }}
                                                    </div>
                                                    <div class="review-text">
                                                        <strong style="color: #000">{{ $review->review }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p>No reviews available for this product yet.</p>
                                    @endif
                                </div>

                                <!-- Pagination -->
                                <div class="pagination">
                                    {{ $reviews->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>

        </section>
        <section class="container products-carousel">
            <h2 class="mb-4 h3 text-uppercase pb-xl-2 mb-xl-4">Related <strong>Products</strong></h2>

            <div id="related_products" class="position-relative">
                <div class="swiper-container js-swiper-slider"
                    data-settings='{
            "autoplay": false,
            "slidesPerView": 4,
            "slidesPerGroup": 4,
            "effect": "none",
            "loop": true,
            "pagination": {
              "el": "#related_products .products-pagination",
              "type": "bullets",
              "clickable": true
            },
            "navigation": {
              "nextEl": "#related_products .products-carousel__next",
              "prevEl": "#related_products .products-carousel__prev"
            },
            "breakpoints": {
              "320": {
                "slidesPerView": 2,
                "slidesPerGroup": 2,
                "spaceBetween": 14
              },
              "768": {
                "slidesPerView": 3,
                "slidesPerGroup": 3,
                "spaceBetween": 24
              },
              "992": {
                "slidesPerView": 4,
                "slidesPerGroup": 4,
                "spaceBetween": 30
              }
            }
          }'>
                    <div class="swiper-wrapper">

                        @foreach ($relatedproducts as $relatedproduct)
                            <div class="swiper-slide product-card">
                                <div class="pc__img-wrapper position-relative">
                                    <!-- Avg Rating Tooltip -->
                                    <div class="avg-review-tooltip">
                                        Avg Rating: {{ round($product->reviews->avg('rating'), 1) }} <span
                                            style="color: #FACA51">★</span>
                                    </div>
                                    <a href="{{ route('website.shop.product.details', $relatedproduct->slug) }}">
                                        <img loading="lazy"
                                            src="{{ asset('storage/uploads/products/' . $relatedproduct->image) }}"
                                            width="330" height="400" alt="Cropped Faux leather Jacket"
                                            class="pc__img">

                                        @php

                                            $galleryImages = is_array(json_decode($relatedproduct->images, true))
                                                ? json_decode($relatedproduct->images, true)
                                                : explode(',', $relatedproduct->images);
                                        @endphp
                                        @foreach ($galleryImages as $galleryImage)
                                            <img loading="lazy"
                                                src="{{ asset('storage/uploads/products/gallery/' . $galleryImage) }} "
                                                width="330" height="400" alt="Cropped Faux leather Jacket"
                                                class="pc__img pc__img-second">
                                        @endforeach
                                    </a>
                                    @php
                                        $sizes = json_decode($relatedproduct->sizes, true); // true দিয়ে অ্যারে রিটার্ন করবে
                                    @endphp
                                    @if ($relatedproduct->quantity == 0)
                                        <a href="javascript:void(0)"
                                            class="mb-3 border-0 btn btn-warning pc__atc anim_appear-bottom position-absolute text-uppercase fw-medium ">Out
                                            of Stock</a>
                                    @elseif(empty($sizes))
                                        <a href="javascript:void(0)"
                                            class="mb-3 border-0 btn btn-danger pc__atc anim_appear-bottom position-absolute text-uppercase fw-medium ">Sizes
                                            Unavailable</a>
                                    @else
                                        @if (Cart::instance('cart')->content()->where('id', $relatedproduct->id)->count() > 0)
                                            <a href="{{ route('cart.index') }}"
                                                class="mb-3 border-0 btn btn-warning pc__atc anim_appear-bottom position-absolute text-uppercase fw-medium ">Go
                                                to Cart</a>
                                        @else
                                            <a href="{{ route('website.shop.product.details', $relatedproduct->slug) }}"
                                                class="border-0 pc__atc btn anim_appear-bottom position-absolute text-uppercase fw-medium "
                                                data-aside="cartDrawer" title="Add To Cart"> 🛒 Buy Now</a>
                                            </form>
                                        @endif
                                    @endif
                                </div>

                                <div class="pc__info position-relative">
                                    <p class="pc__category">{{ $relatedproduct->category->name }}</p>
                                    <h6 class="pc__title"><a
                                            href="{{ route('website.shop.product.details', $relatedproduct->slug) }}">{{ $relatedproduct->name }}</a>
                                    </h6>
                                    <div class="product-card__price d-flex">
                                        <span class="money price">
                                            @if ($relatedproduct->sale_price)
                                                <s>${{ $relatedproduct->regular_price }}</s>
                                                ${{ $relatedproduct->sale_price }}
                                            @else
                                                ${{ $relatedproduct->regular_price }}
                                            @endif
                                        </span>
                                    </div>
                                    <div class="product-card__review d-flex align-items-center">
                                        <div class="reviews-group d-flex">

                                            <span class="fs-6 " style="color: #FACA51;">
                                                {{ str_repeat('★', round($relatedproduct->reviews->avg('rating'))) }}{{ str_repeat('☆', 5 - round($relatedproduct->reviews->avg('rating'))) }}

                                        </div>
                                        <span class="reviews-note text-lowercase ms-1"
                                            style="color: black;">({{ $relatedproduct->reviews->count() }}
                                            <span style="color: gray">Customer
                                                Reviews</span>)</span>
                                    </div>
                                    <a href="#"
                                        class="top-0 bg-transparent border-0 pc__btn-wl position-absolute end-0 js-add-wishlist-related {{ Cart::instance('wishlist')->content()->where('id', $relatedproduct->id)->count() > 0 ? 'filled-heart' : '' }}"
                                        data-id="{{ $relatedproduct->id }}" data-name="{{ $relatedproduct->name }}"
                                        data-price="{{ $relatedproduct->sale_price == '' ? $relatedproduct->regular_price : $relatedproduct->sale_price }}"
                                        title="{{ Cart::instance('wishlist')->content()->where('id', $relatedproduct->id)->count() > 0 ? 'Remove From Wishlist' : 'Add To Wishlist' }}">

                                        @if (Cart::instance('wishlist')->content()->where('id', $relatedproduct->id)->count() > 0)
                                            <svg id="icon_heart" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                width="20" height="20">
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
                        @endforeach

                    </div><!-- /.swiper-wrapper -->
                </div><!-- /.swiper-container js-swiper-slider -->

                <div
                    class="products-carousel__prev position-absolute top-50 d-flex align-items-center justify-content-center">
                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_prev_md" />
                    </svg>
                </div><!-- /.products-carousel__prev -->
                <div
                    class="products-carousel__next position-absolute top-50 d-flex align-items-center justify-content-center">
                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_next_md" />
                    </svg>
                </div><!-- /.products-carousel__next -->

                <div class="mt-4 mb-5 products-pagination d-flex align-items-center justify-content-center"></div>
                <!-- /.products-pagination -->
            </div><!-- /.position-relative -->

        </section><!-- /.products-carousel container -->
    </main>


@endsection

{{-- css --}}
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.31/dist/fancybox.css" />
    <style>
        .radio-container input[type="radio"] {
            display: none;
        }


        .radio-circle {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid green;
            border-radius: 50%;
            position: relative;
            margin-right: 8px;
            background-color: white;
            box-shadow: 0 0 5px rgba(0, 128, 0, 0.5);

        }


        .radio-container input[type="radio"]:checked+.radio-circle::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 8px;
            height: 8px;
            background-color: green;
            border-radius: 50%;
        }


        .radio-text {
            font-size: 14px;
            color: #000;

            vertical-align: middle;
            margin-bottom: 10px;
        }

        .star-rating {
            direction: rtl;
            display: flex;
            justify-content: center;
            margin: 0;
            padding: 0;
        }

        .star-rating input {
            display: none;
        }

        .star {
            font-size: 30px;
            color: #ccc;
            cursor: pointer;
            position: relative;
            transition: color 0.3s ease;
        }

        .star-rating input:checked~.star {
            color: #FACA51;
            /* Yellow color when checked */
        }

        .star-rating input:hover~.star {
            color: #FACA51;
            /* Yellow color on hover */
        }

        .star-rating input:checked+.star {
            color: #FACA51;
            /* Yellow color for selected star */
        }

        .star-rating input:focus+.star {
            outline: none;
        }

        /* Tooltip for title when hovering over the stars */
        .star::after {
            content: attr(title);
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 5px;
            border-radius: 3px;
            font-size: 12px;
            display: none;
        }

        .star:hover::after {
            display: block;
        }
    </style>
@endpush



{{-- javascript --}}
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.31/dist/fancybox.umd.js"></script>

    {{-- fancybox --}}

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize Fancybox for Zoom Popup
            Fancybox.bind("[data-fancybox='gallery']", {
                animated: true,
                dragToClose: false,
                backdropClick: false,
                idle: false,
                Toolbar: {
                    display: ["close", "prev", "next", "zoom", "slideshow", "fullscreen", "thumbs", ],
                },
                mainClass: "custom-fancybox",
                closeButton: "outside",
                animationEffect: "zoom",
                animationDuration: 400,
                zoom: true,

            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let sizeElement = document.getElementById("size");
            let selectedSizeInput = document.getElementById("selected_size");

            if (sizeElement) {
                sizeElement.addEventListener("change", function() {
                    selectedSizeInput.value = this.value;
                    console.log("Size Selected:", this.value); // Debugging
                });
            }

            let cartForm = document.querySelector('form[name="addtocart-form"]');
            // if (cartForm) {
            //     cartForm.addEventListener("submit", function(event) {
            //         if (sizeElement && sizeElement.value === '') {
            //             alert('Please select a size before adding to cart.');
            //             event.preventDefault();
            //         }
            //     });
            // }
        });

        $(document).ready(function() {
            $('form[name="addtocart-form"]').on('submit', function(e) {
                e.preventDefault(); // Prevent form submit

                let formData = $(this).serialize(); // Serialize form data

                $.ajax({
                    url: "{{ route('cart.add') }}", // Laravel route
                    method: "POST",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire({
                            title: "Success!",
                            text: "Product added to cart.",
                            icon: "success",
                            draggable: true,
                            showConfirmButton: false,
                            timer: 2000
                        });

                        // ✅ Update Navbar Cart Count
                        updateCartCount(response.cart_count);
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: "Error!",
                            text: xhr.responseJSON.error || 'Something went wrong!',
                            icon: "error",
                            draggable: true
                        });
                    }
                });
            });

            // ✅ Function to Update Cart Count in Navbar
            function updateCartCount(count) {
                let cartCountElement = $(".js-cart-items-count-header");
                if (cartCountElement.length) {
                    cartCountElement.text(count).show();
                }
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
                    console.error("❌ Missing product data!", {
                        productId,
                        productName,
                        productPrice
                    });
                    alert("⚠️ Product data missing! Please refresh the page.");
                    return;
                }

                if (!csrfToken) {
                    console.error("❌ CSRF token not found! Make sure meta tag is in <head>.");
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
                                $button.addClass("filled-heart").html(`
                            <svg id="icon_heart" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" fill="#f24444" />
                            </svg>
                            <span style="font-weight: bold; font-size: 10px; color: rgb(201, 145, 61);">Remove Wishlist</span>
                        `);
                            } else {
                                $button.removeClass("filled-heart").html(`
                            <svg width="16" height="16" viewBox="0 0 20 20">
                                <use href="#icon_heart" />
                            </svg>
                            <span> Add to Wishlist</span>
                        `);
                            }

                            // **Delay Wishlist Count Update**
                            setTimeout(() => {
                                if ($wishlistCountElement.length) {
                                    $wishlistCountElement.text(data.wishlist_count);
                                }
                            }, 300);
                        } else {
                            alert("❌ Failed to update wishlist: " + data.message);
                        }
                    },
                    error: function(error) {
                        console.error("❌ AJAX Error:", error);
                        alert("❌ Something went wrong! Check console for details.");
                    }
                });
            });
        });
    </script>

    <script>
        const stars = document.querySelectorAll('.star-rating input');

        stars.forEach(star => {
            star.addEventListener('click', () => {
                // Update the value in the form when a star is clicked
                document.querySelector('input[name="rating"]').value = star.value;
            });
        });
    </script>

    {{-- review pagination --}}
    <script>
        $(document).ready(function() {
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault(); // Prevent default link behavior
                var url = $(this).attr('href');
                var page = new URL(url).searchParams.get('page');

                getReviews(page);
                history.pushState(null, null, url);
            });

            function getReviews(page) {
                $("#loading").show(); // Show loading animation

                $.ajax({
                    url: "{{ route('website.shop.product.details', ['product_slug' => $product->slug]) }}?page=" +
                        page,
                    type: "GET",
                    success: function(data) {
                        $('.reviews-container').html(data.reviews);
                        $('.pagination').html(data.pagination);
                    },
                    complete: function() {
                        $("#loading").hide(); // Hide loading animation after AJAX completes
                    }
                });
            }
        });
    </script>



    {{-- relatedproduct-wishlist-functionality --}}

    <script>
        $(document).ready(function() {
            const $wishlistCountElement = $(".js-wishlist-items-count");

            // Use event delegation for dynamically added elements
            $(document).on("click", ".js-add-wishlist-related", function(event) {
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
