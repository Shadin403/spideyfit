@extends('layouts.admin')
@section('title', 'Products-Edit')
@section('content')
    <div class="main-content-inner" style="margin-right: 10%">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex flex-wrap items-center justify-between gap20 mb-27">
                <h3>Product Information</h3>
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
                        <a href="{{ route('admin.products') }}">
                            <div class="text-tiny">Products</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Update product</div>
                    </li>
                </ul>
            </div>
            <!-- form-add-product -->
            <form class="tf-section-2 form-add-product" method="POST" enctype="multipart/form-data"
                action="{{ route('admin.product.update', $product->id) }}">
                @csrf
                @method('PUT')
                <div class="wg-box">

                    {{-- name --}}
                    <fieldset class="name">
                        <div class="mb-10 body-title">Product name <span class="tf-color-1">*</span>
                        </div>
                        <input class="mb-10 @error('name') is-invalid @enderror" type="text"
                            placeholder="Enter product name" name="name" tabindex="0" value="{{ $product->name }}"
                            aria-required="true">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong style="font-size: 13px; ">{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="text-tiny">Do not exceed 100 characters when entering the
                            product name.</div>
                    </fieldset>




                    {{-- Slug --}}
                    <fieldset class="name">
                        <div class="mb-10 body-title">Slug <span class="tf-color-1">*</span></div>
                        <input class="mb-10 @error('slug') is-invalid @enderror" type="text"
                            placeholder="Enter product slug" name="slug" tabindex="0" value="{{ $product->slug }}"
                            aria-required="true">
                        @error('slug')
                            <span class="invalid-feedback" role="alert">
                                <strong style="font-size: 13px; ">{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="text-tiny">Do not exceed 100 characters when entering the
                            product name.</div>
                    </fieldset>




                    <div class="gap22 cols">
                        {{-- category_id --}}
                        <fieldset class="category">
                            <div class="mb-10 body-title">Category <span class="tf-color-1">*</span>
                            </div>
                            <div class="select">
                                <select class="@error('category_id') is-invalid @enderror" name="category_id">
                                    <option>Choose category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="font-size: 13px; ">{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>



                        {{-- Brand_id --}}
                        <fieldset class="brand">
                            <div class="mb-10 body-title">Brand <span class="tf-color-1">*</span>
                            </div>
                            <div class="select">

                                <select class="@error('brand_id') is-invalid @enderror" name="brand_id">
                                    <option>Choose Brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}"
                                            {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="font-size: 13px; ">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </fieldset>
                    </div>
                    {{-- Short Description --}}
                    <fieldset class="shortdescription">
                        <div class="mb-10 body-title">Short Description <span class="tf-color-1">*</span></div>
                        <textarea class="mb-10 ht-150" name="short_description" placeholder="Short Description" tabindex="0"
                            aria-required="true">{{ $product->short_description }}</textarea>

                        <div class="text-tiny">Do not exceed 100 characters when entering the
                            product name.</div>
                    </fieldset>
                    {{-- Description --}}
                    <fieldset class="description">
                        <div class="mb-10 body-title">Description <span class="tf-color-1">*</span>
                        </div>
                        <textarea class="mb-10" name="description" placeholder="Description" tabindex="0" aria-required="true">{{ $product->description }}</textarea>

                        <div class="text-tiny">Do not exceed 100 characters when entering the
                            product name.</div>
                    </fieldset>
                </div>




                {{-- Upload images --}}
                <div class="wg-box">
                    <!-- Single Image Upload -->
                    <fieldset>
                        <div class="body-title">Upload images <span class="tf-color-1">*</span></div>
                        <div class="flex-grow upload-image">
                            <div id="upload-file" class="item up-load">
                                <label class="uploadfile" for="myFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="body-text">Drop your images here or select <span class="tf-color">click to
                                            browse</span></span>
                                    <input type="file" id="myFile" name="image" accept="image/*">
                                </label>
                                <div id="imagePreview" style="margin-top: 10px;">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/uploads/products/' . $product->image) }}"
                                            alt="Product Image"
                                            style="width: 150px; height: 150px; border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                    @endif
                                </div>
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="font-size: 13px;">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </fieldset>
                    <!-- Multiple Images Upload -->
                    <fieldset>
                        <div class="mb-10 body-title">Upload Gallery Images</div>
                        <div class="mb-16 upload-image">
                            <div id="galUpload" class="item up-load">
                                <label class="uploadfile" for="gFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="text-tiny">Drop your images here or select <span class="tf-color">click
                                            to browse</span></span>
                                    <input type="file" id="gFile" name="images[]" accept="image/*" multiple>
                                </label>
                            </div>
                            <div id="galleryPreview" style="margin-top: 10px; display: flex; gap: 15px; flex-wrap: wrap;">
                                @if ($product->images)
                                    @foreach (json_decode($product->images) as $image)
                                        <div
                                            style="position: relative; width: 100px; height: 100px; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                            <!-- Image -->
                                            <img src="{{ asset('storage/uploads/products/gallery/' . $image) }}"
                                                alt="Gallery Image" style="width: 100%; height: 100%; object-fit: cover;">

                                            <!-- Delete Button -->
                                            <form method="POST"
                                                action="{{ route('admin.product.gallery.delete', ['product' => $product->id, 'image' => $image]) }}"
                                                style="position: absolute; top: 5px; right: 5px; z-index: 10;">
                                                @csrf
                                                <button type="submit"
                                                    style="background-color: rgba(0, 0, 0, 0.6); color: white; border: none; border-radius: 50%; width: 25px; height: 25px; display: flex; align-items: center; justify-content: center; font-size: 14px; cursor: pointer; transition: background-color 0.3s;">
                                                    &times;
                                                </button>
                                            </form>
                                        </div>
                                    @endforeach
                                @endif
                            </div>


                        </div>
                    </fieldset>
                    {{--  --}}
                    <div class="cols gap22">


                        {{-- Regular Price --}}
                        <fieldset class="name">
                            <div class="mb-10 body-title">Regular Price <span class="tf-color-1">*</span></div>
                            <input class="mb-10 @error('regular_price') is-invalid @enderror" type="text"
                                placeholder="Enter regular price" name="regular_price" tabindex="0"
                                value=" {{ $product->regular_price }}" aria-required="true">
                            @error('regular_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="font-size: 13px; ">{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>


                        {{-- Sale Price --}}
                        <fieldset class="name">
                            <div class="mb-10 body-title ">Sale Price <span class="tf-color-1">*</span></div>
                            <input class="mb-10 @error('sale_price') is-invalid @enderror" type="text"
                                placeholder="Enter sale price" name="sale_price" tabindex="0"
                                value="{{ $product->sale_price }}" aria-required="true">
                            @error('sale_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="font-size: 13px; ">{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                    </div>


                    <div class="cols gap22">

                        {{-- SKU --}}
                        <fieldset class="name">
                            <div class="mb-10 body-title">SKU <span class="tf-color-1">*</span>
                            </div>
                            <input class="mb-10 @error('SKU') is-invalid @enderror" type="text"
                                placeholder="Enter SKU" name="SKU" tabindex="0" value="{{ $product->SKU }}"
                                aria-required="true">
                            @error('SKU')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="font-size: 13px; ">{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>

                        {{-- Quantity --}}
                        <fieldset class="name">
                            <div class="mb-10 body-title">Quantity <span class="tf-color-1">*</span>
                            </div>
                            <input class="mb-10 @error('quantity') is-invalid @enderror" type="text"
                                placeholder="Enter quantity" name="quantity" tabindex="0"
                                value="{{ $product->quantity }}" aria-required="true">
                            @error('quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="font-size: 13px; ">{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                    </div>


                    @php
                        // ডাটাবেজ থেকে আগের sizes ডাটা ডিকোড করছি
                        $selectedSizes = json_decode($product->sizes, true) ?? [];
                    @endphp

                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="mb-10 body-title">Available Sizes <span class="tf-color-1">*</span></div>
                            <div class="flex gap-15" style="flex-wrap: wrap;">
                                @foreach (['XS', 'S', 'M', 'L', 'XL', 'XXL'] as $size)
                                    <div class="checkbox-group">
                                        <input type="checkbox" id="size{{ $size }}" name="sizes[]"
                                            value="{{ $size }}" class="checkbox-input"
                                            {{ in_array($size, $selectedSizes) ? 'checked' : '' }}>
                                        <label for="size{{ $size }}"
                                            class="checkbox-label">{{ $size }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @error('sizes')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="font-size: 13px;">{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                    </div>


                    <div class="cols gap22">
                        {{-- Stock --}}
                        <fieldset class="name">
                            <div class="mb-10 body-title">Stock</div>
                            <div class="mb-10 select">
                                <select class="@error('stock_status') is-invalid @enderror" name="stock_status">
                                    <option value="instock" {{ $product->stock_status == 'instock' ? 'selected' : '' }}>
                                        InStock</option>
                                    <option value="outofstock"
                                        {{ $product->stock_status == 'outofstock' ? 'selected' : '' }}>
                                        Out of Stock</option>
                                </select>
                                @error('stock_status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="font-size: 13px; ">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </fieldset>

                        {{-- Featured --}}
                        <fieldset class="name">
                            <div class="mb-10 body-title">Featured</div>
                            <div class="mb-10 select">
                                <select class="@error('featured') is-invalid @enderror" name="featured">
                                    <option value="0" {{ $product->featured == '0' ? 'selected' : '' }}>No
                                    </option>
                                    <option value="1" {{ $product->featured == '1' ? 'selected' : '' }}>Yes
                                    </option>
                                </select>
                            </div>
                            @error('featured')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="font-size: 13px; ">{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                    </div>
                    <div class="cols gap10">
                        <button class="w-full tf-button" type="submit">Update product</button>
                    </div>
                </div>
            </form>
            <!-- /form-add-product -->
        </div>
        <!-- /main-content-wrap -->
    </div>
@endsection
@push('scripts')
    <script>
        // Single Image Preview
        document.getElementById('myFile').addEventListener('change', function(event) {
            const imagePreview = document.getElementById('imagePreview');
            imagePreview.innerHTML = ''; // Clear previous preview
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '150px';
                    img.style.maxHeight = '150px';
                    img.style.borderRadius = '5px';
                    img.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.1)';
                    imagePreview.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        });

        // Multiple Images Preview
        document.getElementById('gFile').addEventListener('change', function(event) {
            const galleryPreview = document.getElementById('galleryPreview');
            const files = event.target.files;
            Array.from(files).forEach(file => {
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imgContainer = document.createElement('div');
                        imgContainer.style.position = 'relative';
                        imgContainer.style.display = 'inline-block';

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.width = '100px';
                        img.style.height = '100px';
                        img.style.borderRadius = '5px';
                        img.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.1)';

                        imgContainer.appendChild(img);
                        galleryPreview.appendChild(imgContainer);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endpush
@push('styles')
    <style>
        button:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            margin-right: 20px;
        }

        .checkbox-input {
            margin-right: 5px;
        }

        .checkbox-label {
            font-size: 14px;
            cursor: pointer;
        }
    </style>
@endpush
