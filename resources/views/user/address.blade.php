@extends('layouts.app')

@section('title', 'Address')

@section('content')
    <main class="pt-90">
        <div class="pb-4 mb-4"></div>
        <section class="container my-account">
            <h2 class="page-title">Addresses</h2>
            <div class="row">
                <div class="col-lg-3">
                    @include('Components.account-nav')
                </div>
                <div class="col-lg-9">
                    <div class="page-content my-account__address">
                        <div class="row">
                            <div class="col-6">
                                <p style="color: red;" class="notice alert ">The following addresses will be used on the
                                    checkout page
                                    by
                                    default.</p>
                            </div>
                            <div class="text-right col-6">
                                <a href="{{ route('user.address.add') }}" class="btn btn-sm btn-info">Add New</a>
                            </div>
                        </div>
                        <div class="my-account__address-list row">
                            <h5>Default Shipping Address</h5>

                            @if ($defaultAddress)
                                <div class="my-account__address-item col-md-6">
                                    <div class="my-account__address-item__title">
                                        <h5>{{ $defaultAddress->name }} <i class="fa fa-check-circle text-success"></i></h5>
                                        <a href="{{ route('user.address.edit', $defaultAddress->id) }}">Edit</a>
                                    </div>
                                    <div class="my-account__address-item__detail">
                                        <strong style="text-decoration: underline">Address:</strong>
                                        <p>{{ $defaultAddress->address }},{{ $defaultAddress->locality }}</p>
                                        <p>{{ $defaultAddress->landmark }}</p>
                                        <p>{{ $defaultAddress->city }},{{ $defaultAddress->state }},
                                            {{ $defaultAddress->country }}</p>
                                        <p>, {{ $defaultAddress->zip }}</p>
                                        <br>
                                        <p><strong>Mobile <span>:</span></strong>
                                            <span
                                                style="color: #d63384; font-weight: 500;">{{ $defaultAddress->phone }}</span>
                                        </p>

                                    </div>
                                </div>
                            @else
                                <p>No default address set.</p>
                            @endif
                        </div>

                        <div class="my-account__address-list row">
                            <hr>
                            <hr>
                            <h5 class="bg-info">Others Addresses</h5>
                            @foreach ($otherAddresses as $addresses)
                                @php
                                    $number = $loop->iteration;
                                @endphp
                                <h2>Address-{{ $number }}
                                </h2>

                                <div class="my-account__address-item__title">
                                    <h5>{{ $addresses->name }} <i class="fa fa-check-circle text-success"></i></h5>
                                    <a href="{{ route('user.address.edit', $addresses->id) }}">Edit</a>
                                </div>
                                <div class="my-account__address-item__detail">
                                    <strong style="text-decoration: underline">Address:</strong>
                                    <p>{{ $addresses->address }}, {{ $addresses->locality }}</p>
                                    <p>{{ $addresses->landmark }}</p>
                                    <p>{{ $addresses->city }},{{ $addresses->state }}, {{ $addresses->country }}</p>
                                    <p>{{ $addresses->zip }}</p>
                                    <br>
                                    <p><strong>Mobile <span>:</span></strong>
                                        <span style="color: #d63384; font-weight: 500;">{{ $addresses->phone }}</span>
                                    </p>

                                    <div class="mt-2 my-account__address-item__title">
                                        <form action="{{ route('user.address.set.default', $addresses->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-sm btn-warning" type="submit">Set as default
                                                Adderss</button>
                                        </form>
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
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
