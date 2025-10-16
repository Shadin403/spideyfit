@extends('layouts.admin')

@section('title', 'Contact')

@section('content')

    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex flex-wrap items-center justify-between gap20 mb-27">
                <h3>Coupons</h3>
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
                        <div class="text-tiny">Coupons</div>
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
                    <a class="tf-button style-1 w208" href="{{ route('admin.coupons.add') }}"><i class="icon-plus"></i>Add
                        new</a>
                </div>
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Comment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($contacts as $contact)
                                    <tr>
                                        <td>{{ $contact->id }}</td>
                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->phone }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ Str::limit($contact->comment, 10) }}</td>
                                        <td>
                                            <div class="list-icon-function">
                                                <a href="{{ route('admin.contact.show', $contact->id) }}">
                                                    <div class="item edit">
                                                        <i class="icon-eye"></i>
                                                    </div>
                                                </a>
                                                <form id="delete-form-{{ $contact->id }}"
                                                    action="{{ route('admin.contact.destroy', $contact->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="item text-danger delete">
                                                        <i class="icon-trash-2"
                                                            onclick="deleteConfirmation(event, {{ $contact->id }})"></i>
                                                    </div>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No Coupons Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="flex flex-wrap items-center justify-between gap10 wgp-pagination">
                    {{ $contacts->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>


    <div class="bottom-page">
        <div class="body-text">Copyright © 2024 Dev-Shadin</div>
    </div>

@endsection


@push('scripts')
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function deleteConfirmation(event, contactId) {
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
                    document.getElementById("delete-form-" + contactId).submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire({
                        title: "Cancelled",
                        text: "Your Contact is safe",
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
    </style>
@endpush
