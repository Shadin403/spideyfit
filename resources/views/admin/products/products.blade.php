@extends('layouts.admin')

@section('title', 'Products')

@section('content')

    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex flex-wrap items-center justify-between gap20 mb-27">
                <h3>All Products</h3>
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
                        <div class="text-tiny">Products</div>
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
                    <a class="tf-button style-1 w208" href="{{ route('admin.product.add') }}"><i class="icon-plus"></i>Add
                        new</a>
                </div>
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>{{ Str::limit('Short_description', 10) }}</th>
                                    <th>{{ Str::limit('featured', 5) }}</th>
                                    <th>Reguler_Price</th>
                                    <th>Sale_Price</th>
                                    <th>Description</th>
                                    <th>SKU</th>
                                    <th>Stock_Status</th>
                                    <th>Size</th>
                                    <th>Brand_id</th>
                                    <th>Category_id</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td class="pname">
                                            <div class="image">
                                                <img src="{{ asset('storage/uploads/products/' . $product->image) }}"
                                                    alt="{{ $product->name }}" class="image">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="name">
                                                <a href="#" class="body-title-2">{{ $product->name }}</a>
                                            </div>
                                        </td>
                                        <td>{{ $product->slug }}</td>
                                        <td class="truncate">{{ $product->short_description }}</td>
                                        <td>{{ $product->featured == 0 ? 'No' : 'Yes' }}</td>
                                        <td>{{ $product->regular_price }}</td>
                                        <td>{{ $product->sale_price }}</td>
                                        <td class="truncate">{{ $product->description }}</td>
                                        <td>{{ $product->SKU }}</td>
                                        <td>{{ $product->stock_status }}</td>
                                        <td>{{ count(json_decode($product->sizes, true) ?? []) }}</td>
                                        <td>{{ $product->brand_id }}</td>
                                        <td>{{ $product->category_id }}</td>
                                        <td>
                                            <div class="list-icon-function">
                                                <div class="item eye">
                                                    <a href="{{ route('website.shop.product.details', $product->slug) }}"
                                                        title="view">
                                                        <i class="icon-eye"></i>
                                                    </a>
                                                </div>
                                                <div class="item edit">
                                                    <a href="{{ route('admin.product.edit', $product->id) }}"
                                                        title="Update">
                                                        <i class="icon-edit-3"></i>
                                                    </a>
                                                </div>
                                                <form id="delete-form-{{ $product->id }}"
                                                    action="{{ route('admin.product.destroy', ['id' => $product->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a onclick="deleteConfirmation(event,'{{ $product->id }}')"
                                                        type="submit" class="delete-button">
                                                        <i class="icon-trash-2"></i>
                                                    </a>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="divider"></div>
                    <div class="flex flex-wrap items-center justify-between gap10 wgp-pagination">
                        {{ $products->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bottom-page">
        <div class="body-text">Copyright © 2024 Sadhin Studio</div>
    </div>

@endsection

@push('scripts')
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function deleteConfirmation(event, categoryId) {
            event.preventDefault(); // ফর্ম সাবমিট বন্ধ করুন

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success mx-2 py-3 px-4 font-bold text-lg", // বাটন বড় করার জন্য স্টাইল
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
                        text: "Your Product is safe 😰",
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
