@extends('layouts.admin')

@section('title', 'Slides')

@section('content')



    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex flex-wrap items-center justify-between gap20 mb-27">
                <h3>Slider</h3>
                <ul class="flex flex-wrap items-center justify-start breadcrumbs gap10">
                    <li>
                        <a href="{{ route('admin.index') }}" class="color-gray">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Slider</div>
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
                    <a class="tf-button style-1 w208" href="{{ route('admin.slide.add') }}"><i class="icon-plus"></i>Add
                        new</a>
                </div>
                <div class="wg-table table-all-user">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#Id</th>
                                <th>Image</th>
                                <th>Tagline</th>
                                <th>Title</th>
                                <th>Subtitle</th>
                                <th>Link</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($slides as $slide)
                                <tr>
                                    <td>{{ $slide->id }}</td>
                                    <td class="pname">
                                        <div class="image">
                                            <img src="{{ asset('storage/uploads/slides/' . $slide->image) }}"
                                                alt="{{ $slide->title }}" class="image">
                                        </div>
                                    </td>
                                    <td>{{ $slide->tagline }}</td>
                                    <td>{{ $slide->title }}</td>
                                    <td>{{ $slide->subtitle }}</td>
                                    <td>{{ Str::limit($slide->link, 10) }}</td>
                                    <td>
                                        <div class="list-icon-function">
                                            <form action="{{ route('admin.slide.edit', $slide->id) }}" method="get">
                                                @csrf
                                                <a href="javascript:void(0)" onclick="this.closest('form').submit()">
                                                    <div class="item edit">
                                                        <i class="icon-edit-3"></i>
                                                    </div>
                                                </a>
                                            </form>
                                            <form id="delete-form-{{ $slide->id }}"
                                                action="{{ route('admin.slide.destroy', $slide->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="item text-danger delete"
                                                    onclick="deleteConfirmation(event,'{{ $slide->id }}')">
                                                    <i class="icon-trash-2"></i>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No slides found</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
                <div class="divider"></div>
                <div class="flex flex-wrap items-center justify-between gap10 wgp-pagination">
                    {{ $slides->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>


    <div class="bottom-page">
        <div class="body-text">Copyright © 2025 Dev-Shadin</div>
    </div>


@endsection
@push('scripts')
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function deleteConfirmation(event, slideId) {
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
                    document.getElementById("delete-form-" + slideId).submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire({
                        title: "Cancelled",
                        text: "Your Slide is safe 😰",
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
