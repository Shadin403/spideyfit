@extends('layouts.app')

@section('title', 'Orders')

@section('content')
    <style>
        .table> :not(caption)>tr>th {
            padding: 0.625rem 1.5rem .625rem !important;
            background-color: #6a6e51 !important;
        }

        .table>tr>td {
            padding: 0.625rem 1.5rem .625rem !important;
        }

        .table-bordered> :not(caption)>tr>th,
        .table-bordered> :not(caption)>tr>td {
            border-width: 1px 1px;
            border-color: #6a6e51;
        }

        .table> :not(caption)>tr>td {
            padding: .8rem 1rem !important;
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
    </style>
    <main class="pt-90" style="padding-top: 0px;">
        <div class="pb-4 mb-4"></div>
        <section class="container my-account">
            <h2 class="page-title">Orders</h2>
            <div class="row">
                <div class="col-lg-2">
                    @include('Components.account-nav')
                </div>

                <div class="col-lg-10">
                    <div class="wg-table table-all-user">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 80px">OrderNo</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Phone</th>
                                        <th class="text-center">Items</th>
                                        <th class="text-center">Subtotal</th>
                                        <th class="text-center">Tax</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Order Date</th>
                                        <th class="text-center">Delivered On</th>
                                        <th class="text-center">Returned Date</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $order)
                                        <tr>
                                            <td class="text-center">{{ $order->id }}</td>
                                            <td class="text-center"> {{ $order->name }}</td>
                                            <td class="text-center">{{ $order->phone }}</td>
                                            <td class="text-center">{{ $order->orderItems->count() }}</td>
                                            <td class="text-center">{{ $order->subtotal }}</td>
                                            <td class="text-center">
                                                @if ($order->tax == 0)
                                                    $0.00
                                                @else
                                                    {{ $order->tax }}
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $order->total }}</td>

                                            <td class="text-center">
                                                @if ($order->status == 'ordered')
                                                    <span class="badge bg-info">Ordered</span>
                                                @elseif($order->status == 'delivered')
                                                    <span class="badge bg-success">Delivered</span>
                                                @elseif($order->status == 'canceled')
                                                    <span class="badge bg-danger">Canceled</span>
                                                @elseif($order->status == 'returned')
                                                    <span class="badge bg-danger">Return</span>
                                                @else
                                                    <span class="badge bg-warning">Shipped</span>
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $order->created_at }}</td>

                                            <td>
                                                @if ($order->delivered_date)
                                                    {{ $order->delivered_date }}
                                                @else
                                                    <span class="badge bg-secondary">Not Delivered</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($order->returned_date)
                                                    {{ $order->returned_date }}
                                                @else
                                                    <span class="badge bg-secondary">Not Returned</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('user.order.details', $order->id) }}">
                                                    <div class="list-icon-function view-icon">
                                                        <div class="item eye">
                                                            <i class="fa fa-eye" title="View"></i>
                                                        </div>
                                                    </div>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="11" class="text-center">No orders found</td>
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
        </section>
    </main>
@endsection
