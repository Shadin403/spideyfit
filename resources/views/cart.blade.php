@extends('layouts.app')

@section('title', 'Cart')
@section('content')
    <main class="pt-90">
        <div class="pb-4 mb-4"></div>
        <section class="container shop-checkout">
            <h2 class="page-title">Cart</h2>
            <div class="checkout-steps">
                <a href="javascript:void(0)" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">01</span>
                    <span class="checkout-steps__item-title">
                        <span>Shopping Bag</span>
                        <em>Manage Your Items List</em>
                    </span>
                </a>
                <a href="javascript:void(0)" class="checkout-steps__item">
                    <span class="checkout-steps__item-number">02</span>
                    <span class="checkout-steps__item-title">
                        <span>Shipping and Checkout</span>
                        <em>Checkout Your Items List</em>
                    </span>
                </a>
                <a href="javascript:void(0)" class="checkout-steps__item">
                    <span class="checkout-steps__item-number">03</span>
                    <span class="checkout-steps__item-title">
                        <span>Confirmation</span>
                        <em>Review And Submit Your Order</em>
                    </span>
                </a>
            </div>
            <div class="shopping-cart">
                @if ($items->count() > 0)
                    <div class="cart-table__wrapper">
                        <table class="cart-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th></th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>
                                            <div class="shopping-cart__product-item">
                                                @if ($item->model && $item->model->image)
                                                    <img loading="lazy"
                                                        src="{{ asset('storage/uploads/products/' . $item->model->image) }}"
                                                        width="120" height="120" alt="{{ $item->name }}" />
                                                @else
                                                    <img loading="lazy"
                                                        src="{{ asset('storage/uploads/products/default-image.jpg') }}"
                                                        width="120" height="120" alt="{{ $item->name }}" />
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="shopping-cart__product-item__detail">
                                                <h4>{{ $item->model ? $item->model->name : $item->name }}</h4>
                                                <ul class="shopping-cart__product-item__options">
                                                    <li>Color: Yellow</li>
                                                    <li>Size:
                                                        {{ isset($item->options['size']) ? $item->options['size'] : 'N/A' }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="shopping-cart__product-price">${{ $item->price }}</span>
                                        </td>
                                        <td>
                                            <div class="qty-control position-relative">
                                                <input type="number" name="quantity" value="{{ $item->qty }}"
                                                    min="1" class="text-center qty-control__number">


                                                <form
                                                    action="{{ route('cart.quantity.decrease', ['rowId' => $item->rowId]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="qty-control__reduce">-</div>
                                                </form>

                                                <form
                                                    action="{{ route('cart.quantity.increase', ['rowId' => $item->rowId]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="qty-control__increase">+</div>
                                                </form>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="shopping-cart__subtotal">${{ $item->subtotal }}</span>
                                        </td>
                                        <td>
                                            <form action="{{ route('cart.remove', ['rowId' => $item->rowId]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="border: none; background-color: transparent;">
                                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="#767676"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M0.259435 8.85506L9.11449 0L10 0.885506L1.14494 9.74056L0.259435 8.85506Z" />
                                                        <path
                                                            d="M0.885506 0.0889838L9.74057 8.94404L8.85506 9.82955L0 0.97449L0.885506 0.0889838Z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="cart-table-footer">
                            @if (Session::has('coupon'))
                                <form action="{{ route('cart.coupon.remove') }}" class="position-relative bg-body"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input class="form-control" type="text" name="coupon_code" placeholder="Coupon Code"
                                        value="{{ Session::get('coupon')['code'] }} Applied!">
                                    <input class="top-0 px-4 btn-link fw-medium position-absolute end-0 h-100"
                                        type="submit" value="REMOVE COUPON">
                                </form>
                            @else
                                <form action="{{ route('cart.coupon.apply') }}" class="position-relative bg-body"
                                    method="POST">
                                    @csrf
                                    <input class="form-control" type="text" name="coupon_code" placeholder="Coupon Code"
                                        value="@if (Session::has('coupon')) {{ Session::get('coupon')['code'] }} Applied! @endif">
                                    <input class="top-0 px-4 btn-link fw-medium position-absolute end-0 h-100"
                                        type="submit" value="APPLY COUPON">
                                </form>
                            @endif

                            <form action="{{ route('cart.empty') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-light">CLEAR CART</button>
                            </form>

                        </div>
                        @if (Session::has('success'))
                            <div class="alert alert-success" style="margin-top: 5px;">
                                {{ Session::get('success') }}

                            </div>
                        @elseif(Session::has('error'))
                            <div class="alert alert-danger" style="margin-top: 5px;">
                                {{ Session::get('error') }}

                            </div>
                        @endif
                    </div>
                    <div class="shopping-cart__totals-wrapper">
                        <div class="sticky-content">
                            <div class="shopping-cart__totals">
                                <h3>Cart Totals</h3>
                                @if (Session::has('discounts'))
                                    <table class="cart-totals">
                                        <tbody>
                                            <tr>
                                                <th>Subtotal</th>
                                                <td>${{ Cart::instance('cart')->subtotal() }}</td>
                                            </tr>
                                            <tr>
                                                <th>Discount {{ Session::get('coupon')['code'] }}</th>
                                                <td>${{ Session::get('discounts')['discount'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>Subtotal After Discount
                                                </th>
                                                <td>${{ Session::get('discounts')['subtotal'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>Shipping</th>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input form-check-input_fill"
                                                            type="checkbox" value="" id="free_shipping">
                                                        <label class="form-check-label" for="free_shipping">Free
                                                            shipping</label>
                                                    </div>
                                                    {{-- <div>
                                                <a href="#" class="menu-link menu-link_us-s">CHANGE ADDRESS</a>
                                            </div> --}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>VAT</th>
                                                <td>${{ Cart::instance('cart')->tax() }}</td>
                                            </tr>
                                            <tr>
                                                <th>Total</th>
                                                <td>${{ Session::get('discounts')['total'] }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @else
                                    <table class="cart-totals">
                                        <tbody>
                                            <tr>
                                                <th>Subtotal</th>
                                                <td>${{ Cart::instance('cart')->subtotal() }}</td>
                                            </tr>
                                            <tr>
                                                <th>Shipping</th>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input form-check-input_fill"
                                                            type="checkbox" value="" id="free_shipping">
                                                        <label class="form-check-label" for="free_shipping">Free
                                                            shipping</label>
                                                    </div>
                                                    {{-- <div>
                                                <a href="#" class="menu-link menu-link_us-s">CHANGE ADDRESS</a>
                                            </div> --}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>VAT</th>
                                                <td>${{ Cart::instance('cart')->tax() }}</td>
                                            </tr>
                                            <tr>
                                                <th>Total</th>
                                                <td>${{ Cart::instance('cart')->total() }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                            <div class="mobile_fixed-btn_wrapper">
                                <div class="container button-wrapper">
                                    <a href="{{ route('cart.checkout') }}" class="btn btn-primary btn-checkout">PROCEED
                                        TO CHECKOUT</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row">

                        <div class="pt-5 text-center col-md-12 bp-5">
                            <tr>
                                <td colspan="6">
                                    <h4 class="text-center">No items in your cart</h4>
                                </td>
                            </tr>
                            <a href="{{ route('website.shop') }}"
                                class="btn btn-outline-info :hover btn-primary ">Continue
                                Shopping</a>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </main>
@endsection


@push('scripts')
    <script>
        $(function() {
            $(".qty-control__increase").click(function(e) {
                $(this).closest('form').submit();
            })
            $(".qty-control__reduce").click(function(e) {
                $(this).closest('form').submit();
            })
        })
    </script>
@endpush
