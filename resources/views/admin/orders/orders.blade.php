@extends('layouts.admin')

@section('title', 'Orders')

@section('content')

    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex flex-wrap items-center justify-between gap20 mb-27">
                <h3>Orders</h3>
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
                        <div class="text-tiny">Orders</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="flex flex-wrap items-center justify-between gap10">
                    <div class="flex-grow wg-filter">
                        <form class="form-search">
                            <fieldset class="name">
                                <input type="text" placeholder="Search here..." class="" name="name"
                                    tabindex="2" value="" aria-required="true" required="">
                            </fieldset>
                            <div class="button-submit">
                                <button class="" type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:70px">OrderNo</th>
                                    <th class="text-center" style="background-color: rgb(235, 227, 227);">Name</th>
                                    <th class="text-center" style="background-color: rgb(235, 227, 227);">Phone</th>
                                    <th class="text-center" style="background-color: rgb(235, 227, 227);">Subtotal</th>
                                    <th class="text-center" style="background-color: rgb(235, 227, 227);">Tax</th>
                                    <th class="text-center" style="background-color: rgb(235, 227, 227);">Total</th>

                                    <th class="text-center" style="background-color: rgb(235, 227, 227);">Status</th>
                                    <th class="text-center" style="background-color: rgb(235, 227, 227);">Order Date</th>
                                    <th class="text-center" style="background-color: rgb(235, 227, 227);">Total Items</th>
                                    <th class="text-center" style="background-color: rgb(235, 227, 227);">Delivered On</th>
                                    <th class="text-center"
                                        style="background-color: rgb(235, 227, 227); color: rgb(204, 46, 46);">
                                        Canceled Date</th>
                                    <th class="text-center"
                                        style="background-color: rgb(235, 227, 227); color: rgb(204, 46, 46);">
                                        Returned Date</th>
                                    <th class="text-center" style="background-color: rgb(235, 227, 227);">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <td class="text-center"><strong>{{ $order->id }}</strong></td>
                                        <td class="text-center"><strong>{{ $order->name }}</strong></td>
                                        <td class="text-center"><strong>{{ $order->phone }}</strong></td>
                                        <td class="text-center"><strong>${{ $order->subtotal }}</strong></td>
                                        <td class="text-center">
                                            @if ($order->tax)
                                                ${{ $order->tax }}
                                            @else
                                                $0.00
                                            @endif
                                        </td>
                                        <td class="text-center"><strong>${{ $order->total }}</strong></td>
                                        <td class="text-center">
                                            @if ($order->status == 'ordered')
                                                <span class="badge bg-info ">Ordered</span>
                                            @elseif ($order->status == 'shipped')
                                                <span class="badge bg-warning">Shipped</span>
                                            @elseif ($order->status == 'delivered')
                                                <span class="badge bg-success">Delivered</span>
                                            @else
                                                <span class="badge bg-danger">Canceled</span>
                                            @endif
                                        </td>
                                        <td class="text-center"><strong>{{ $order->created_at }}</strong></td>
                                        <td class="text-center"><strong>{{ $order->orderItems->count() }}</strong></td>
                                        <td class="text-center"><strong>
                                                @if ($order->delivered_date)
                                                    {{ $order->delivered_date }}
                                                @else
                                                    N/A
                                                @endif
                                            </strong></td>
                                        <td class="text-center"><strong>
                                                @if ($order->canceled_date)
                                                    {{ $order->canceled_date }}
                                                @else
                                                    N/A
                                                @endif
                                            </strong></td>
                                        <td class="text-center"><strong>
                                                @if ($order->returned_date)
                                                    {{ $order->returned_date }}
                                                @else
                                                    N/A
                                                @endif
                                            </strong></td>
                                        <td class="text-center">
                                            <form action="{{ route('admin.order.details', $order->id) }}" method="post">
                                                @csrf
                                                <a href="javascript:void(0)" onclick="this.closest('form').submit()">
                                                    <div class="list-icon-function view-icon">
                                                        <div class="item eye">
                                                            <i class="icon-eye"></i>
                                                        </div>
                                                    </div>
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center">No Orders Found</td>
                                    </tr>
                                @endforelse


                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="flex flex-wrap items-center justify-between gap10 wgp-pagination">
                    {{ $orders->links('pagination::bootstrap-5') }}

                </div>
            </div>
        </div>
    </div>


    <div class="bottom-page">
        <div class="body-text">Copyright © 2024 Dev-Shadin</div>
    </div>

@endsection
@push('styles')
    <style>
        .swal2-popup {
            font-size: 18px;
            /* পুরো পপআপের টেক্সট বড় করার জন্য */
            width: 50rem;
            /* পপআপের প্রস্থ */
            padding: 25px;
            /* অতিরিক্ত প্যাডিং */
        }

        .swal2-title {
            font-size: 24px;
            /* টাইটেল টেক্সট বড় করার জন্য */
        }

        .swal2-content {
            font-size: 20px;
            /* কনটেন্টের টেক্সট বড় করার জন্য */
        }

        .swal2-confirm {
            font-size: 20px !important;
            /* নিশ্চিত করে যে এটা ওভাররাইড করবে */
            border-radius: 5px !important;
        }

        .swal2-cancel {
            font-size: 20px !important;
            border-radius: 5px !important;
        }

        .truncate {
            max-width: 10ch;
            /* Max 10 characters */
            overflow: hidden;
            /* Hide extra text */
            white-space: nowrap;
            /* Prevent text wrapping */
            text-overflow: ellipsis;
            /* Add "..." at the end */
        }

        .delete-button {
            background: none;

            border: none;

            padding: 0;

            margin: 0;

            cursor: pointer;

            color: red;

            display: inline-flex;

            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
    </style>
@endpush
