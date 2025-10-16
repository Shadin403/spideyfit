@extends('layouts.admin')

@section('title', 'Orders-Details')

@section('content')

    <style>
        .table-transaction>tbody>tr:nth-of-type(odd) {
            --bs-table-accent-bg: #fff !important;
        }
    </style>
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex flex-wrap items-center justify-between gap20 mb-27">
                <h3>Order Details</h3>
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
                        <div class="text-tiny">Order details</div>
                    </li>
                </ul>
            </div>
            <div class="wg-box">
                <div class="flex flex-wrap items-center justify-between gap10">
                    <div class="flex-grow wg-filter">
                        <h5>Ordered Details</h5>
                    </div>
                    <a class="tf-button style-1 w208" href="{{ route('admin.orders') }}">Back</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Order No</th>
                                <td>{{ $order->id }}</td>
                                <th>Mobile</th>
                                <td>{{ $order->phone }}</td>
                                <th>Zip Code</th>
                                <td>{{ $order->zip }}</td>
                            </tr>
                            <tr>
                                <th>Order Date</th>
                                <td>{{ $order->created_at }}</td>
                                <th>Dalivared Date</th>
                                <td>{{ $order->delivered_date }}</td>
                                <th>Canceled Date</th>
                                <td>{{ $order->canceled_date }}</td>
                            </tr>
                            <tr>
                                <th>Order Status</th>
                                <td colspan="5">
                                    @if ($order->status == 'ordered')
                                        <span class="badge bg-info">Ordered</span>
                                    @elseif ($order->status == 'shipped')
                                        <span class="badge bg-warning">Shipped</span>
                                    @elseif ($order->status == 'delivered')
                                        <span class="badge bg-success">Delivered</span>
                                    @elseif ($order->status == 'returned')
                                        <span class="badge bg-danger">Return</span>
                                    @else
                                        <span class="badge bg-danger">Canceled</span>
                                    @endif
                                </td>
                            </tr>
                        </thead>
                    </table>
                </div>


            </div>
            <div class="wg-box" style="margin-top: 20px;">
                <div class="flex flex-wrap items-center justify-between gap10">
                    <div class="flex-grow wg-filter">
                        <h5>Ordered Items</h5>
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
                            @foreach ($orderItems as $item)
                                <tr>

                                    <td class="pname">
                                        <div class="image">
                                            <img src="{{ asset('storage/uploads/products/' . $item->product->image) }}"
                                                alt="{{ $item->product->name }}" class="image">
                                        </div>
                                        <div class="name">
                                            <a href="{{ route('website.shop.product.details', $item->product->slug) }}"
                                                target="_blank" class="body-title-2">{{ $item->product->name }}</a>
                                        </div>
                                    </td>
                                    <td class="text-center"><strong>${{ $item->price }}</strong></td>
                                    <td class="text-center"><strong>{{ $item->quantity }}</strong></td>
                                    <td class="text-center"><strong>{{ $item->size }}</strong></td>
                                    <td class="text-center">{{ $item->product->SKU }}</td>
                                    <td class="text-center">{{ $item->product->category->name }}</td>
                                    <td class="text-center">{{ $item->product->brand->name }}</td>
                                    <td class="text-center">{{ $item->options }}</td>
                                    <td class="text-center">
                                        @if ($item->return_status == 0)
                                            <span class="badge bg-warning">Not Returned</span>
                                        @else
                                            <span class="badge bg-danger">Returned</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="list-icon-function view-icon">
                                            <div class="item eye">
                                                <i class="icon-eye"></i>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>

                <div class="divider"></div>
                <div class="flex flex-wrap items-center justify-between gap10 wgp-pagination">
                    {{ $orderItems->links('pagination::bootstrap-5') }}
                </div>
            </div>

            <div class="mt-5 wg-box">
                <h5>Shipping Address</h5>
                <div class="my-account__address-item col-md-6">
                    <div class="my-account__address-item__detail">
                        <p>{{ $order->name }}</p>
                        <p>{{ $order->address }}</p>
                        <p>{{ $order->locality }}</p>
                        <p>{{ $order->city }},{{ $order->country }}</p>
                        <p>{{ $order->landmark }}</p>
                        <p>{{ $order->zip }}</p>
                        <br>
                        <p>Mobile : {{ $order->phone }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-5 wg-box">
                <h5>Transactions</h5>
                <table class="table table-striped table-bordered table-transaction">
                    <tbody>
                        <tr>
                            <th>Subtotal</th>
                            <td>${{ $order->subtotal }}</td>
                            <th>Tax</th>
                            <td>${{ $order->tax == null ? 0 : $order->tax }}</td>
                            <th>Discount</th>
                            <td><strong
                                    class="text-success">${{ $order->discount == null ? 0 : $order->discount }}</strong>
                            </td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>${{ $order->total }}</td>
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

            <div class="mt-5 wg-box">
                <h5>Update Order Status</h5>
                <form action="{{ route('admin.order.update.status', $order->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="select">
                                <select name="order_status" id="order_status">
                                    <option value="ordered" {{ $order->status == 'ordered' ? 'selected' : '' }}>Ordered
                                    </option>
                                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>
                                        Delivered
                                    </option>
                                    <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled
                                    </option>
                                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped
                                    </option>
                                    <option value="returned" {{ $order->status == 'returned' ? 'selected' : '' }}>
                                        Return
                                    </option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary tf-button w208">Update</button>
                        </div>
                    </div>


                </form>

            </div>

        </div>
    </div>
    </div>


    <div class="bottom-page">
        <div class="body-text">Copyright © 2024 Dev-Shadin</div>
    </div>

@endsection
