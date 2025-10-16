@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
    <style>
        .pt-90 {
            padding-top: 90px !important;
        }

        .pr-6px {
            padding-right: 6px;
            text-transform: uppercase;
        }

        .my-account .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 40px;
            border-bottom: 1px solid;
            padding-bottom: 13px;
        }

        .my-account .wg-box {
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            padding: 24px;
            flex-direction: column;
            gap: 24px;
            border-radius: 12px;
            background: var(--White);
            box-shadow: 0px 4px 24px 2px rgba(20, 25, 38, 0.05);
        }

        .bg-success {
            background-color: #40c710 !important;
        }

        .bg-danger {
            background-color: #f44032 !important;
        }

        .bg-warning {
            background-color: #f5d700 !important;
            color: #000;
        }

        .bg-info {
            background-color: #10c2dd !important;
            color: #fcfafa;
        }

        .btn-bg-danger {
            background-color: #f44032 !important;
            color: #fff !important;
        }

        .table-transaction>tbody>tr:nth-of-type(odd) {
            --bs-table-accent-bg: #fff !important;

        }

        .table-transaction th,
        .table-transaction td {
            padding: 0.625rem 1.5rem .25rem !important;
            color: #000 !important;
        }

        .table> :not(caption)>tr>th {
            padding: 0.625rem 1.5rem .25rem !important;
            background-color: #6a6e51 !important;
        }

        .table-bordered>:not(caption)>*>* {
            border-width: inherit;
            line-height: 32px;
            font-size: 14px;
            border: 1px solid #e1e1e1;
            vertical-align: middle;
        }

        .table-striped .image {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            flex-shrink: 0;
            border-radius: 10px;
            overflow: hidden;
        }

        .table-striped td:nth-child(1) {
            min-width: 250px;
            padding-bottom: 7px;
        }

        .pname {
            display: flex;
            gap: 13px;
        }

        .table-bordered> :not(caption)>tr>th,
        .table-bordered> :not(caption)>tr>td {
            border-width: 1px 1px;
            border-color: #6a6e51;
        }
    </style>
    <main class="pt-90" style="padding-top: 0px;">
        <div class="pb-4 mb-4"></div>
        <section class="container my-account">
            <h2 class="page-title">Order's Details</h2>
            <div class="row">
                <div class="col-lg-2">
                    @include('Components.account-nav')
                </div>

                <div class="col-lg-10">
                    <div class="mt-5 mb-5 wg-box">
                        <div class="row">
                            <div class="col-6">
                                <h5>Ordered Details</h5>
                            </div>
                            <div class="text-right col-6">
                                <a class="btn btn-sm btn-success" href="{{ route('user.orders') }}">Back</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-transaction">
                                <tbody>
                                    <tr>
                                        <th>Order No</th>
                                        <td>{{ $order->id }}</td>
                                        <th>Mobile</th>
                                        <td>{{ $order->phone }}</td>
                                        <th>Pin/Zip Code</th>
                                        <td>{{ $order->zip }}</td>
                                    </tr>
                                    <tr>
                                        <th>Order Date</th>
                                        <td>{{ $order->created_at }}</td>
                                        <th>Delivered Date</th>
                                        <td>{{ $order->delivered_date == null ? 'N/A' : $order->delivered_date }}</td>
                                        <th>Canceled Date</th>
                                        <td>{{ $order->canceled_date == null ? 'N/A' : $order->canceled_date }}</td>
                                    </tr>
                                    <tr>
                                        <th>Order Status</th>
                                        <td colspan="5">
                                            @if ($order->status == 'delivered')
                                                <span class="badge bg-success">Delivered</span>
                                            @elseif ($order->status == 'canceled')
                                                <span class="badge bg-danger">Canceled</span>
                                            @elseif($order->status == 'shipped')
                                                <span class="badge bg-warning">Shipped</span>
                                            @elseif($order->status == 'returned')
                                                <span class="badge bg-danger">Return</span>
                                            @else
                                                <span class="badge bg-info">Ordered</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="wg-box wg-table table-all-user">
                        <div class="row">
                            <div class="col-6">
                                <h5>Ordered Items</h5>
                            </div>
                            <div class="text-right col-6">

                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Size</th>
                                        <th class="text-center">SKU</th>
                                        <th class="text-center">Category</th>
                                        <th class="text-center">Brand</th>
                                        <th class="text-center">Options</th>
                                        <th class="text-center">Return Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderItems as $item)
                                        <tr>
                                            <td class="pname">
                                                <div class="image">
                                                    <img src="{{ asset('storage/uploads/products/' . $item->product->image) }}"
                                                        alt="{{ $item->product->name }}" class="image">
                                                </div>
                                                <div class="name">
                                                    <a href="{{ route('website.shop.product.details', $item->product->slug) }}"
                                                        target="_blank"
                                                        class="body-title-2">{{ Str::limit($item->product->name, 5) }}</a>
                                                </div>
                                            </td>
                                            <td class="text-center">${{ $item->price }}</td>
                                            <td class="text-center">{{ $item->quantity }}</td>
                                            <td class="text-center">{{ $item->size }}</td>
                                            <td class="text-center"
                                                style=" white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 100px;">
                                                {{ Str::limit($item->product->SKU, 5) }}</td>
                                            <td class="text-center">{{ $item->product->category->name }}</td>
                                            <td class="text-center">{{ $item->product->brand->name }}</td>
                                            <td class="text-center">{{ $item->options }}</td>
                                            <td class="text-center">
                                                @if ($item->return_status == 0)
                                                    <span class="badge bg-warning">No</span>
                                                @else
                                                    <span class="badge bg-success">Yes</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('website.shop.product.details', $item->product->slug) }}"
                                                    target="_blank">
                                                    <div class="list-icon-function view-icon">
                                                        <div class="item eye">
                                                            <i class="fa fa-eye"></i>
                                                        </div>
                                                    </div>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="flex flex-wrap items-center justify-between gap10 wgp-pagination">

                    </div>

                    <div class="mt-5 wg-box">
                        <h5>Shipping Address</h5>
                        <div class="my-account__address-item col-md-6">
                            <div class="my-account__address-item__detail">
                                <p>{{ $order->name }}</p>
                                <p>{{ $order->address }}</p>
                                <p>{{ $order->locality }}</p>
                                <p>{{ $order->landmark }}</p>
                                <p>{{ $order->city }},{{ $order->country }}</p>
                                <p>{{ $order->zip }}</p>
                                <br>
                                <p>Mobile : {{ $order->phone }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 wg-box" style="overflow: auto;">
                        <h5>Transactions</h5>
                        <table class="table table-striped table-bordered table-transaction">
                            <tbody>
                                <tr>
                                    <th>Subtotal</th>
                                    <td>{{ $order->subtotal }}</td>
                                    <th>Tax</th>
                                    <td>{{ $order->tax == null ? 0 : $order->tax }}</td>
                                    <th>Discount</th>
                                    <td>{{ $order->discount == null ? 0 : $order->discount }}</td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td>{{ $order->total }}</td>
                                    <th>Payment Mode</th>
                                    <td>{{ $transactions->mode }}</td>
                                    <th>Status</th>
                                    <td>
                                        @if ($transactions->status == 'approved')
                                            <span class="badge bg-success">Approved</span>
                                        @elseif($transactions->status == 'declined')
                                            <span class="badge bg-danger">Declined</span>
                                        @elseif($transactions->status == 'refunded')
                                            <span class="badge bg-secondary">Refunded</span>
                                        @else
                                            <span class="badge bg-warning">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Order Date</th>
                                    <td>{{ $order->created_at == null ? 'N/A' : $order->created_at }}</td>
                                    <th>Delivered Date</th>
                                    <td>{{ $order->delivered_date == null ? 'N/A' : $order->delivered_date }}</td>
                                    <th>Canceled Date</th>
                                    <td>{{ $order->canceled_date == null ? 'N/A' : $order->canceled_date }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-5 text-right wg-box">
                        @if ($order->status == 'canceled')
                            <form action="{{ route('website.shop') }}" method="GET">
                                @csrf
                                <button type="submit" class="btn btn-danger">Re Order</button>
                            </form>
                        @elseif($order->status == 'shipped')
                            <button type="button" class="btn btn-warning">Order Shipped</button>
                        @elseif($order->status == 'delivered')
                            <form action="{{ route('website.shop') }}" method="GET">
                                @csrf
                                <button type="submit" class="btn btn-success">Order Completed | Shipping Continue</button>
                            </form>
                        @elseif($order->status == 'returned')
                            <form action="{{ route('website.shop') }}" method="GET">
                                @csrf
                                <button type="submit" class="btn btn-secondary ">Order Return | Re
                                    Order</button>
                            </form>
                        @else
                            <form id="delete-form-{{ $order->id }}"
                                action="{{ route('user.order.cancel', $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="order_id"
                                    value="{{ $order->id }}
                                autocomplete="off">
                                <button type="submit" class="btn btn-bg-danger"
                                    onclick="deleteConfirmation(event,'{{ $order->id }}')">Cancel Order</button>
                            </form>
                        @endif

                    </div>
                </div>

            </div>
        </section>
    </main>

@endsection

@push('scripts')
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function deleteConfirmation(event, categoryId) {
            event.preventDefault(); // ফর্ম সাবমিট বন্ধ করুন

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success mx-2 py-3 px-4 font-bold text-lg",
                    cancelButton: "btn btn-danger mx-2 py-3 px-4 font-bold text-lg" //
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // ফর্ম সাবমিট করুন
                    document.getElementById("delete-form-" + categoryId).submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire({
                        title: "Cancelled",
                        text: "Your Order Items is safe 🙂‍↕️",
                        icon: "error"
                    });
                }
            });
        }
    </script>
@endpush


@push('styles')
    <style>
        .swal2-popup {
            font-size: 18px;
            width: 50rem;
            padding: 25px;

        }

        .swal2-title {
            font-size: 24px;
        }

        .swal2-content {
            font-size: 20px;
        }

        .swal2-confirm {
            font-size: 20px !important;
            border-radius: 5px !important;
            background-color: #22bb33 !important;
        }

        .swal2-cancel {
            font-size: 20px !important;
            border-radius: 5px !important;
            background-color: #f43f32be !important;
        }
    </style>
@endpush
