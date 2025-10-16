@extends('layouts.admin')

@section('title', 'Slide-add')

@section('content')
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex flex-wrap items-center justify-between gap20 mb-27">
                <h3>Slide</h3>
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
                        <a href="{{ route('admin.slides') }}">
                            <div class="text-tiny">Slider</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">New Slide</div>
                    </li>
                </ul>
            </div>
            <!-- new-category -->
            <div class="wg-box">
                <form class="form-new-product form-style-1" method="POST" action="{{ route('admin.slide.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <fieldset class="name">
                        <div class="body-title">Tagline <span class="tf-color-1">*</span></div>
                        <input class="flex-grow @error('tagline') is-invalid @enderror" type="text" placeholder="Tagline"
                            name="tagline" tabindex="0" value="{{ old('tagline') }}" aria-required="true">
                        @error('tagline')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title">Title<span class="tf-color-1">*</span></div>
                        <input class="flex-grow @error('title') is-invalid @enderror" type="text" placeholder="Title"
                            name="title" tabindex="0" value="{{ old('title') }}" aria-required="true">
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title">Subtitle<span class="tf-color-1">*</span></div>
                        <input class="flex-grow @error('subtitle') is-invalid @enderror" type="text"
                            placeholder="Subtitle" name="subtitle" tabindex="0" value="{{ old('subtitle') }}"
                            aria-required="true">
                        @error('subtitle')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title">Link<span class="tf-color-1">*</span></div>
                        <input class="flex-grow @error('link') is-invalid @enderror" type="text" placeholder="Link"
                            name="link" tabindex="0" value="{{ old('link') }}" aria-required="true">
                        @error('link')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </fieldset>
                    <fieldset>
                        <div class="body-title">Upload images <span class="tf-color-1">*</span>
                        </div>
                        <div class="flex-grow upload-image">
                            <div id="upload-file" class="item up-load">
                                <label class="uploadfile" for="myFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="body-text">Drop your images here or select <span class="tf-color">click
                                            to browse</span></span>
                                    <input type="file" id="myFile" name="image" accept="image/*"
                                        class="@error('image') is-invalid @enderror" onchange="previewImage(event)">

                                </label>
                            </div>
                            <div class="item" id="imagePreview">
                                <img src="upload-1.html" class="effect8" alt="">
                            </div>
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </fieldset>
                    <fieldset class="category">
                        <div class="body-title">Select category icon</div>
                        <div class="flex-grow select">
                            <select class="" name="status">
                                <option>Select</option>
                                <option value="1" @if (old('status') == 1) selected @endif>Active</option>
                                <option value="0" @if (old('status') == 0) selected @endif>In Active</option>
                            </select>
                        </div>
                    </fieldset>
                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">Save</button>
                    </div>
                </form>
            </div>
            <!-- /new-category -->
        </div>
        <!-- /main-content-wrap -->
    </div>


    <div class="bottom-page">
        <div class="body-text">Copyright © 2025 Dev-Shadin</div>
    </div>
@endsection
@push('scripts')
    <script>
        function previewImage(event) {
            const imagePreview = document.getElementById('imagePreview');
            imagePreview.innerHTML = ''; // পুরোনো ইমেজ রিসেট করার জন্য

            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    imagePreview.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
@endpush
{{-- @push('styles')
    <style>
        #imagePreview img {
            width: 100%;
            height: 100px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
@endpush --}}
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
