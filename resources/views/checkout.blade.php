@extends('layouts.app')
@section('title', 'Checkout')
@section('content')
    <main class="pt-90">
        <div class="pb-4 mb-4"></div>
        <section class="container shop-checkout">
            <h2 class="page-title">Shipping and Checkout</h2>
            <div class="checkout-steps">
                <a href="{{ route('cart.index') }}" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">01</span>
                    <span class="checkout-steps__item-title">
                        <span>Shopping Bag</span>
                        <em>Manage Your Items List</em>
                    </span>
                </a>
                <a href="{{ route('cart.checkout') }}" class="checkout-steps__item active">
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
            <form name="checkout-form" action="{{ route('cart.place.an.order') }}" method="POST">
                @csrf
                <div class="checkout-form">
                    <div class="billing-info__wrapper">
                        <div class="row">
                            <div class="col-6">
                                <h4>SHIPPING DETAILS</h4>
                            </div>
                            <div class="col-6">
                            </div>
                        </div>
                        @if ($Address)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="my-account__address-list-item">
                                        <div class="my-account__address-item__detail">
                                            <h5>{{ $Address->name }} <i class="fa fa-check-circle text-success"></i>
                                            </h5>
                                            <strong>Address:</strong>
                                            <p>{{ $Address->address }}</p>
                                            <p>{{ $Address->locality }},{{ $Address->city }}</p>
                                            <p>{{ $Address->state }}, {{ $Address->country }}</p>
                                            <p>{{ $Address->landmark }},{{ $Address->zip }}</p>
                                            <br>
                                            <p><strong>Mobile <span style="color: red">:</span></strong>
                                                {{ auth()->user()->address->phone }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('user.address') }}" class="mt-5 btn btn-sm btn-warning">Change Default
                                Address</a>
                            <a href="{{ route('user.address.add') }}" class="mt-5 btn btn-sm btn-info">Add New
                                Address</a>
                        @else
                            <div class="mt-5 row">
                                <div class="col-md-6">
                                    <div class="my-3 form-floating">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" value="{{ auth()->user()->name }}{{ old('name') }}"
                                            required="">
                                        <label for="name">Full Name *</label>
                                        <span class="text-danger"></span>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="my-3 form-floating">
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            name="phone" value="{{ auth()->user()->mobile }}{{ old('phone') }}"
                                            required="">
                                        <label for="phone">Phone Number *</label>
                                        <span class="text-danger"></span>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="my-3 form-floating">
                                        <input type="text" class="form-control @error('zip') is-invalid @enderror"
                                            name="zip" value="{{ old('zip') }}" required="">
                                        <label for="zip">Zipcode *</label>
                                        <span class="text-danger"></span>
                                        @error('zip')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mt-3 mb-3 form-floating">
                                        <input type="text" class="form-control @error('state') is-invalid @enderror"
                                            name="state" value="{{ old('state') }}" required="">
                                        <label for="state">State *</label>
                                        <span class="text-danger"></span>
                                        @error('state')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="my-3 form-floating">
                                        <input type="text" class="form-control @error('city') is-invalid @enderror"
                                            name="city" value="{{ old('city') }}" required="">
                                        <label for="city">Town / City *</label>
                                        <span class="text-danger"></span>
                                        @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="my-3 form-floating">
                                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                                            name="address" value="{{ old('address') }}" required="">
                                        <label for="address">House no, Building Name *</label>
                                        <span class="text-danger"></span>
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="my-3 form-floating">
                                        <input type="text" class="form-control @error('locality') is-invalid @enderror"
                                            name="locality" value="{{ old('locality') }}" required="">
                                        <label for="locality">Road Name, Area, Colony *</label>
                                        <span class="text-danger"></span>
                                        @error('locality')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="my-3 form-floating">
                                        <input type="text" class="form-control @error('landmark') is-invalid @enderror"
                                            name="landmark" value="{{ old('landmark') }}" required="">
                                        <label for="landmark">Landmark *</label>
                                        <span class="text-danger"></span>
                                        @error('landmark')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="checkout__totals-wrapper">
                        <div class="sticky-content">
                            <div class="checkout__totals">
                                <h3>Your Order</h3>
                                <table class="checkout-cart-items">
                                    <thead>
                                        <tr>
                                            <th>PRODUCT</th>
                                            <th align="right">SUBTOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (Cart::instance('cart')->content() as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->name }} x {{ $item->qty }} --
                                                    <b>Size:</b>{{ $item->options['size'] ?? 'N/A' }}
                                                </td>
                                                <td align="right">
                                                    ${{ $item->subtotal }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <table class="checkout-totals">
                                    <tbody>
                                        @if (Session::has('discounts'))
                                            <tr>
                                                <th>Subtotal</th>
                                                <td align="right">${{ Cart::instance('cart')->subtotal() }}</td>
                                            </tr>
                                            <tr>
                                                <th>Discount {{ Session::get('coupon')['code'] }}</th>
                                                <td align="right">${{ Session::get('discounts')['discount'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>Subtotal After Discount</th>
                                                <td align="right">${{ Session::get('discounts')['subtotal'] }}</td>
                                            </tr>

                                            <tr>
                                                <th>SHIPPING</th>
                                                <td align="right">Free shipping</td>
                                            </tr>
                                            <tr>
                                                <th>VAT</th>
                                                <td align="right">{{ Session::get('discounts')['tax'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>Total</th>
                                                <td align="right">{{ Session::get('discounts')['total'] }}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <th>Subtotal</th>
                                                <td align="right">${{ Cart::instance('cart')->subtotal() }}</td>
                                            </tr>
                                            <tr>
                                                <th>SHIPPING</th>
                                                <td align="right">Free shipping</td>
                                            </tr>
                                            <tr>
                                                <th>VAT</th>
                                                <td align="right">{{ Cart::instance('cart')->tax() }}</td>
                                            </tr>
                                            <tr>
                                                <th>Total</th>
                                                <td align="right">{{ Cart::instance('cart')->total() }}</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="checkout__payment-methods">

                                <div class="form-check">
                                    <input class="form-check-input form-check-input_fill" type="radio" name="mode"
                                        id="mode1" value="">
                                    <label class="form-check-label" for="checkout_payment_method_2">
                                        Debit Or Credit Cart

                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input form-check-input_fill" type="radio" name="mode"
                                        id="mode2" value="">
                                    <label class="form-check-label" for="checkout_payment_method_4">
                                        Paypal
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input form-check-input_fill" type="radio" name="mode"
                                        id="mode3" value="cod">
                                    <label class="form-check-label" for="checkout_payment_method_3">
                                        Cash on delivery
                                    </label>
                                </div>
                                <div class="policy-text">
                                    Your personal data will be used to process your order, support your experience
                                    throughout this
                                    website, and for other purposes described in our <a href="terms.html"
                                        target="_blank">privacy
                                        policy</a>.
                                </div>
                            </div>
                            <button class="btn btn-primary btn-checkout">PLACE ORDER</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>

@endsection


@push('styles')
    <style>
        .btn-warning:hover {
            background-color: #e09e36;

            color: #fff;

        }

        .btn-warning {
            border-radius: 5px;
            margin-right: 5px;
            margin-top: 9px;
        }
    </style>
@endpush
