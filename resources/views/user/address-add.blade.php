@extends('layouts.app')

@section('title', 'Address-add')

@section('content')
    <style>
        .custom-select-wrapper {
            width: 20% !important;
            position: relative !important;
        }

        .custom-select-wrapper select {
            width: 100% !important;
            padding: 8px 12px !important;
            border: 2px solid #007bff !important;
            border-radius: 6px !important;
            appearance: none !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            background-color: white !important;
            font-size: 16px !important;
            cursor: pointer !important;
            transition: all 0.3s ease-in-out !important;
        }

        .custom-select-wrapper select:focus {
            border-color: #0056b3 !important;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            outline: none;
        }

        .custom-select-wrapper::after {

            position: absolute !important;
            top: 50% !important;
            right: 12px !important;
            transform: translateY(-50%) !important;
            color: #007bff !important;
            pointer-events: none !important;
        }

        /* Error Style */
        .is-invalid {
            border-color: #dc3545 !important;
        }

        .is-invalid:focus {
            box-shadow: 0 0 5px rgba(220, 53, 69, 0.5) !important;
        }
    </style>

    <main class="pt-90">
        <div class="pb-4 mb-4"></div>
        <section class="container my-account">
            <h2 class="page-title">Address-Add</h2>
            <div class="row">
                <div class="col-lg-3">
                    @include('Components.account-nav')
                </div>
                <div class="col-lg-9">
                    <form action="{{ route('user.address.store') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mt-5 row">

                            <div class="col-md-6">
                                <div class="my-3 form-floating">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}">
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
                                        name="phone" value="{{ old('phone') }}">
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
                                        name="zip" value="{{ old('zip') }}">
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
                                        name="state" value="{{ old('state') }}">
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
                                        name="city" value="{{ old('city') }}">
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
                                        name="address" value="{{ old('address') }}">
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
                                        name="locality" value="{{ old('locality') }}">
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
                                        name="landmark" value="{{ old('landmark') }}">
                                    <label for="landmark">Landmark *</label>
                                    <span class="text-danger"></span>
                                    @error('landmark')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="my-3 form-floating">
                                    <div style="bottom: 5px;"><strong style="font-size: 15px; color: rgb(131, 15, 15);">Set
                                            as
                                            Default:</strong>
                                    </div>
                                    <div class="custom-select-wrapper">
                                        <select name="is_default" id="is_default"
                                            class="form-select @error('is_default') is-invalid @enderror">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                    @error('landmark')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-5 col-md-12">
                                <button type="submit" class="btn btn-outline-info :hover btn-primary ">Add
                                    Address</button>
                            </div>
                        </div>
                </div>
                </form>
            </div>
            </div>
        </section>
    </main>
@endsection
