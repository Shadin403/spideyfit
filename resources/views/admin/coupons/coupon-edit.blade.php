@extends('layouts.admin')

@section('title', 'Coupon-edit')
@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">
                <div class="flex flex-wrap items-center justify-between gap20 mb-27">
                    <h3>Coupon infomation</h3>
                    <ul class="flex flex-wrap items-center justify-start breadcrumbs gap10">
                        <li>
                            <a href="{{ route('admin.index') }}">
                                <div class="text-tiny">Dashboard</div>
                            </a>
                        </li>
                        <li>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <a href="{{ route('admin.coupons') }}">
                                <div class="text-tiny">Coupons</div>
                            </a>
                        </li>
                        <li>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <div class="text-tiny">Edit Coupon</div>
                        </li>
                    </ul>
                </div>
                <div class="wg-box">
                    <form class="form-new-product form-style-1" method="post"
                        action="{{ route('admin.coupon.update', $coupon->id) }}">
                        @csrf
                        @method('PUT')
                        <fieldset class="name">
                            <div class="body-title">Coupon Code <span class="tf-color-1">*</span></div>
                            <input class="flex-grow @error('code') is-invalid @enderror" type="text"
                                placeholder="Coupon Code" name="code" tabindex="0" value="{{ $coupon->code }}"
                                aria-required="true">
                            @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                        <fieldset class="category">
                            <div class="body-title ">Coupon Type</div>
                            <div class="flex-grow select @error('type') is-invalid @enderror">
                                <select class="" name="type">
                                    <option value="">Select</option>
                                    <option value="fixed" {{ $coupon->type == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                    <option value="percentage" {{ $coupon->type == 'percentage' ? 'selected' : '' }}>Percent
                                    </option>
                                </select>

                            </div>
                            @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                        <fieldset class="name">
                            <div class="body-title">Value <span class="tf-color-1">*</span></div>
                            <input class="flex-grow @error('value') is-invalid @enderror" type="text"
                                placeholder="Coupon Value" name="value" tabindex="0" value="{{ $coupon->value }}"
                                aria-required="true">
                            @error('value')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </fieldset>
                        <fieldset class="name">
                            <div class="body-title">Cart Value <span class="tf-color-1">*</span></div>
                            <input class="flex-grow @error('cart_value') is-invalid @enderror" type="text"
                                placeholder="Cart Value" name="cart_value" tabindex="0" value="{{ $coupon->cart_value }}"
                                aria-required="true">
                            @error('cart_value')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                        <fieldset class="name">
                            <div class="body-title">Expiry Date <span class="tf-color-1">*</span></div>
                            <input class="flex-grow @error('expiry_date') is-invalid @enderror" type="date"
                                placeholder="Expiry Date" name="expiry_date" tabindex="0"
                                value="{{ $coupon->expiry_date }}" aria-required="true">
                            @error('expiry_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>

                        <div class="bot">
                            <div></div>
                            <button class="tf-button w208" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="bottom-page">
            <div class="body-text">Copyright © 2025 Dev-Shadin</div>
        </div>
    </div>
@endsection
