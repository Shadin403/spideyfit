@extends('layouts.app')

@section('title', 'Order Confirmation')

@section('content')
    <main class="pt-90">
        <div class="pb-4 mb-4"></div>
        <section class="container shop-checkout">
            <h2 class="page-title">Order Received</h2>
            <div class="checkout-steps">
                <a href="{{ route('cart.index') }}" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">01</span>
                    <span class="checkout-steps__item-title">
                        <span>Shopping Bag</span>
                        <em>Manage Your Items List</em>
                    </span>
                </a>
                <a href="javascript:void(0)" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">02</span>
                    <span class="checkout-steps__item-title">
                        <span>Shipping and Checkout</span>
                        <em>Checkout Your Items List</em>
                    </span>
                </a>
                <a href="javascript:void(0)" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">03</span>
                    <span class="checkout-steps__item-title">
                        <span>Confirmation</span>
                        <em>Review And Submit Your Order</em>
                    </span>
                </a>
            </div>
            <div class="order-complete">
                <div class="order-complete__message">
                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle cx="40" cy="40" r="40" fill="#B9A16B" />
                        <path
                            d="M52.9743 35.7612C52.9743 35.3426 52.8069 34.9241 52.5056 34.6228L50.2288 32.346C49.9275 32.0446 49.5089 31.8772 49.0904 31.8772C48.6719 31.8772 48.2533 32.0446 47.952 32.346L36.9699 43.3449L32.048 38.4062C31.7467 38.1049 31.3281 37.9375 30.9096 37.9375C30.4911 37.9375 30.0725 38.1049 29.7712 38.4062L27.4944 40.683C27.1931 40.9844 27.0257 41.4029 27.0257 41.8214C27.0257 42.24 27.1931 42.6585 27.4944 42.9598L33.5547 49.0201L35.8315 51.2969C36.1328 51.5982 36.5513 51.7656 36.9699 51.7656C37.3884 51.7656 37.8069 51.5982 38.1083 51.2969L40.385 49.0201L52.5056 36.8996C52.8069 36.5982 52.9743 36.1797 52.9743 35.7612Z"
                            fill="white" />
                    </svg>
                    <h3>Your order is completed!</h3>
                    <p>Thank you. Your order has been received.</p>
                    <button onclick="printTable()" class="mt-3 btn-primary print-button">Print Order Details</button>
                </div>
                <div class="order-info">
                    <div class="order-info__item">
                        <label>Order Number</label>
                        <span>{{ $order->id }}</span>
                    </div>
                    <div class="order-info__item">
                        <label>Date</label>
                        <span>{{ $order->created_at }}</span>
                    </div>
                    <div class="order-info__item">
                        <label>Total</label>
                        <span>${{ $order->total }}</span>
                    </div>
                    <div class="order-info__item">
                        <label>Paymetn Method</label>
                        <span>{{ $order->transaction->mode }}</span>
                    </div>
                </div>
                <div class="checkout__totals-wrapper">
                    <div class="checkout__totals">
                        <h3>Order Details</h3>
                        <table id="table" class="checkout-cart-items">
                            <thead>
                                <tr>
                                    <th>PRODUCT</th>
                                    <th>SUBTOTAL</th>
                                </tr>
                            </thead>
                            @foreach ($order->orderItems as $item)
                                <tbody>
                                    <tr>
                                        <td>
                                            {{ $item->product->name }} x {{ $item->quantity }}
                                        </td>
                                        <td>
                                            <b>Size:</b> {{ $item->size }}
                                        </td>
                                        <td>
                                            ${{ $item->price * $item->quantity }}
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                        <table class="checkout-totals">
                            <tbody>
                                <tr>
                                    <th>SUBTOTAL</th>
                                    <td>${{ $order->subtotal }}</td>
                                </tr>
                                <tr>
                                    <th>Discount</th>
                                    <td>${{ $order->discount }}</td>
                                </tr>
                                <tr>
                                    <th>SHIPPING</th>
                                    <td>Free shipping</td>
                                </tr>
                                <tr>
                                    <th>VAT</th>
                                    <td>
                                        @if ($order->tax == null)
                                            $0.00
                                        @else
                                            ${{ $order->tax }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>TOTAL</th>
                                    <td>${{ $order->total }}</td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection

@push('scripts')
    <script>
        function printTable() {
            // টেবিল এলিমেন্ট সিলেক্ট করুন
            var table = document.querySelector('.checkout__totals');

            // একটি নতুন উইন্ডো খুলুন
            var printWindow = window.open('', '', 'height=600,width=800');

            // নতুন উইন্ডোতে টেবিল এবং স্টাইল যোগ করুন
            printWindow.document.write('<html><head><title>Order Details</title>');
            printWindow.document.write('<style>');
            printWindow.document.write(`
            body {
                font-family: Arial, sans-serif;
                margin: 20px;
            }
            h2 {
                text-align: center;
                color: #333;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }
            th, td {
                border: 1px solid #000;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
            .checkout__totals {
                width: 100%;
                max-width: 600px;
                margin: 0 auto;
            }
            .checkout-cart-items th,
            .checkout-cart-items td {
                border: 1px solid #000;
                padding: 8px;
            }
            .checkout-totals th,
            .checkout-totals td {
                border: 1px solid #000;
                padding: 8px;
            }
        `);
            printWindow.document.write('</style>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(table.outerHTML); // টেবিল যোগ করুন
            printWindow.document.write('</body></html>');

            // প্রিন্ট ডায়ালগ খুলুন
            printWindow.document.close();
            printWindow.print();
        }
    </script>
@endpush
