@extends('layouts.admin')
@section('title', 'Products-add')

@section('content')

    <style>
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
    <div class="main-content-inner" style="margin-right: 10%">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex flex-wrap items-center justify-between gap20 mb-27">
                <h3>Add Product</h3>
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
                        <div class="text-tiny">Add product</div>
                    </li>
                </ul>
            </div>
            <!-- form-add-product -->
            <form class="tf-section-2 form-add-product" method="POST" enctype="multipart/form-data"
                action="{{ route('admin.products.store') }}">
                @csrf
                <div class="wg-box">

                    {{-- name --}}
                    <fieldset class="name">
                        <div class="mb-10 body-title">Product name <span class="tf-color-1">*</span>
                        </div>
                        <input class="mb-10 @error('name') is-invalid @enderror" type="text"
                            placeholder="Enter product name" name="name" tabindex="0" value="{{ old('name') }}"
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
                            placeholder="Enter product slug" name="slug" tabindex="0" value="{{ old('slug') }}"
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
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
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
                            aria-required="true">{{ old('short_description') }}</textarea>

                        <div class="text-tiny">Do not exceed 100 characters when entering the
                            product name.</div>
                    </fieldset>
                    {{-- Description --}}
                    <fieldset class="description">
                        <div class="mb-10 body-title">Description <span class="tf-color-1">*</span>
                        </div>
                        <textarea class="mb-10" name="description" placeholder="Description" tabindex="0" aria-required="true">{{ old('description') }}</textarea>

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
                                <div id="imagePreview" style="margin-top: 10px;"></div>
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
                            <div id="galleryPreview" style="margin-top: 10px; display: flex; gap: 10px;"></div>
                        </div>
                    </fieldset>
                    {{--  --}}
                    <div class="cols gap22">


                        {{-- Regular Price --}}
                        <fieldset class="name">
                            <div class="mb-10 body-title">Regular Price <span class="tf-color-1">*</span></div>
                            <input class="mb-10 @error('regular_price') is-invalid @enderror" type="text"
                                placeholder="Enter regular price" name="regular_price" tabindex="0"
                                value=" {{ old('regular_price') }} " aria-required="true">
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
                                value="{{ old('sale_price') }}" aria-required="true">
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
                                placeholder="Enter SKU" name="SKU" tabindex="0" value="{{ old('SKU') }}"
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
                                value="{{ old('quantity') }}" aria-required="true">
                            @error('quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="font-size: 13px; ">{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                    </div>
                    {{-- Size Selection --}}
                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="mb-10 body-title">Available Sizes <span class="tf-color-1">*</span></div>
                            <div class="flex gap-15" style="flex-wrap: wrap;">
                                <div class="checkbox-group">
                                    <input type="checkbox" id="sizeXS" name="sizes[]" value="XS"
                                        class="checkbox-input">
                                    <label for="sizeXS" class="checkbox-label">XS</label>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="sizeS" name="sizes[]" value="S"
                                        class="checkbox-input">
                                    <label for="sizeS" class="checkbox-label">S</label>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="sizeM" name="sizes[]" value="M"
                                        class="checkbox-input">
                                    <label for="sizeM" class="checkbox-label">M</label>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="sizeL" name="sizes[]" value="L"
                                        class="checkbox-input">
                                    <label for="sizeL" class="checkbox-label">L</label>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="sizeXL" name="sizes[]" value="XL"
                                        class="checkbox-input">
                                    <label for="sizeXL" class="checkbox-label">XL</label>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="sizeXXL" name="sizes[]" value="XXL"
                                        class="checkbox-input">
                                    <label for="sizeXXL" class="checkbox-label">XXL</label>
                                </div>
                            </div>
                            @error('sizes')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="font-size: 13px;">{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                    </div>


                    {{--  --}}
                    <div class="cols gap22">
                        {{-- Stock --}}
                        <fieldset class="name">
                            <div class="mb-10 body-title">Stock</div>
                            <div class="mb-10 select">
                                <select class="@error('stock_status') is-invalid @enderror" name="stock_status">
                                    <option value="instock">InStock</option>
                                    <option value="outofstock">Out of Stock</option>
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
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
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
                        <button class="w-full tf-button" type="submit">Add product</button>
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
            galleryPreview.innerHTML = ''; // Clear previous preview
            const files = event.target.files;
            Array.from(files).forEach(file => {
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.maxWidth = '100px';
                        img.style.maxHeight = '100px';
                        img.style.marginRight = '10px';
                        img.style.borderRadius = '5px';
                        img.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.1)';
                        galleryPreview.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endpush
@push('styles')
@endpush
