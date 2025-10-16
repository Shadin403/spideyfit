@extends('layouts.admin')
@section('title', 'Contact Show')

@section('content')
    <div style="margin-top: 50px;" class="container-fluid">
        <div class="mx-auto shadow-sm card" style="max-width: 700px;">
            <div class=" card-header bg-primary">
                <h3 class="mb-0 text-white" style="font-size: 22px;">Contact Information</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold" style="font-size: 16px;">Name:</label>
                    <input type="text" class="form-control" value="{{ $contact->name }}" disabled
                        style="font-size: 14px; padding: 10px;">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold" style="font-size: 16px;">Phone:</label>
                    <input type="text" class="form-control" value="{{ $contact->phone }}" disabled
                        style="font-size: 14px; padding: 10px;">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold" style="font-size: 16px;">Email:</label>
                    <input type="email" class="form-control" value="{{ $contact->email }}" disabled
                        style="font-size: 14px; padding: 10px;">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold" style="font-size: 16px;">Message:</label>
                    <textarea class="form-control" rows="4" disabled style="font-size: 14px; padding: 10px;">{{ $contact->comment }}</textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.contact') }}" class="btn btn-secondary"
                        style="font-size: 16px; padding: 8px 16px;">Back</a>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-top: 100px" class="bottom-page">
        <div class="body-text">Copyright © 2025 Dev-Shadin</div>
    </div>
@endsection
