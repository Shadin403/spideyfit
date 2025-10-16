{{-- this page name is partials/product-list.blade.php --}}
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
                                        loading="lazy" src="{{ asset('storage/uploads/products/' . $product->image) }}"
                                        width="330" height="400" alt="{{ $product->name }}" class="pc__img"></a>
                            </div>

                            <div class="swiper-slide">
                                <div class="swiper-slide">
                                    <div class="swiper-slide">
                                        <div class="swiper-slide">
                                            @if (!empty($product->images))
                                                @php
                                                    // ডেটা প্রসেস করা (JSON হলে ডিকোড, নাহলে explode)
                                                    $galleryImages = is_array(json_decode($product->images, true))
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
                                                                width="330" height="400" alt="{{ $product->name }}"
                                                                class="pc__img">
                                                        </a>
                                                    @else
                                                        <a
                                                            href="{{ route('website.shop.product.details', $product->slug) }}">
                                                            <img loading="lazy"
                                                                src="{{ asset('storage/uploads/products/gallery/default.jpg') }}"
                                                                width="330" height="400" alt="Default Image"
                                                                class="pc__img">
                                                        </a>
                                                    @endif
                                                @endforeach
                                            @else
                                                <img loading="lazy"
                                                    src="{{ asset('storage/uploads/products/gallery/default.jpg') }}"
                                                    width="330" height="400" alt="Default Image" class="pc__img">
                                            @endif
                                        </div>

                                    </div>

                                </div>

                            </div>



                        </div>
                        <span class="pc__img-prev"><svg width="7" height="11" viewBox="0 0 7 11"
                                xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_prev_sm" />
                            </svg></span>
                        <span class="pc__img-next"><svg width="7" height="11" viewBox="0 0 7 11"
                                xmlns="http://www.w3.org/2000/svg">
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
                                <s>${{ $product->regular_price }}</s> ${{ $product->sale_price }}
                            @else
                                ${{ $product->regular_price }}
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
                            <svg id="icon_heart" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20"
                                height="20">
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
