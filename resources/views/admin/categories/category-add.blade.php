@extends('layouts.admin')
@section('title', 'Categories-add')

@section('content')

    <div class="main-content-inner" style="margin-right: 10%">
        <div class="main-content-wrap">
            <div class="flex flex-wrap items-center justify-between gap20 mb-27">
                <h3>Category infomation</h3>
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
                        <a href="{{ route('admin.categories') }}">
                            <div class="text-tiny">Categories</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">New Category</div>
                    </li>
                </ul>
            </div>
            <!-- new-category -->
            <div class="wg-box">
                <form class="form-new-product form-style-1" action="{{ route('admin.category.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <fieldset class="name">
                        <div class="body-title">Category Name <span class="tf-color-1">*</span></div>
                        <input class="flex-grow @error('name') is-invalid @enderror" type="text"
                            placeholder="Category name" name="name" tabindex="0" value="{{ old('name') }}"
                            aria-required="true">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong style="font-size: 13px; ">{{ $message }}</strong>
                            </span>
                        @enderror
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title @error('slug') is-invalid @enderror">Category Slug <span
                                class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Category Slug" name="slug" tabindex="0"
                            value="{{ old('slug') }}" aria-required="true">
                        @error('slug')
                            <span class="invalid-feedback" role="alert">
                                <strong style="font-size: 13px; ">{{ $message }}</strong>
                            </span>
                        @enderror
                    </fieldset>
                    {{-- <fieldset class="brand">
                            <div class="mb-10 body-title">Brand <span class="tf-color-1">*</span>
                            </div>
                            <div class="select">

                                <select style="width: 200px;" class="" name="brand_id">
                                    <option>Choose Brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </fieldset> --}}
                    {{-- <fieldset>
                        <div class="body-title">Upload images <span class="tf-color-1">*</span>
                        </div>
                        <div class="flex-grow upload-image">
                            <div class="item" id="imgpreview" style="display:none">
                                <img src="upload-1.html" class="effect8" alt="">
                            </div>
                            <div id="upload-file" class="item up-load">
                                <label class="uploadfile" for="myFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="body-text">Drop your images here or select <span class="tf-color">click
                                            to browse</span></span>
                                    <input type="file" id="myFile" name="image" accept="image/*"
                                        class="@error('image') is-invalid @enderror" onchange="previewImage(event)">
                                    <div id="imagePreview" style="margin-top: 10px"></div>
                                </label>
                            </div>
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </fieldset> --}}


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
                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="bottom-page">
        <div class="body-text">Copyright © 2024 Dev-Shadin</div>
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
