<?php $__env->startSection('title', 'Products-Edit'); ?>
<?php $__env->startSection('content'); ?>
    <div class="main-content-inner" style="margin-right: 10%">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex flex-wrap items-center justify-between gap20 mb-27">
                <h3>Product Information</h3>
                <ul class="flex flex-wrap items-center justify-start breadcrumbs gap10">
                    <li>
                        <a href="<?php echo e(route('admin.index')); ?>">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="<?php echo e(route('admin.products')); ?>">
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
                action="<?php echo e(route('admin.product.update', $product->id)); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="wg-box">

                    
                    <fieldset class="name">
                        <div class="mb-10 body-title">Product name <span class="tf-color-1">*</span>
                        </div>
                        <input class="mb-10 <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                            placeholder="Enter product name" name="name" tabindex="0" value="<?php echo e($product->name); ?>"
                            aria-required="true">
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert">
                                <strong style="font-size: 13px; "><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <div class="text-tiny">Do not exceed 100 characters when entering the
                            product name.</div>
                    </fieldset>




                    
                    <fieldset class="name">
                        <div class="mb-10 body-title">Slug <span class="tf-color-1">*</span></div>
                        <input class="mb-10 <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                            placeholder="Enter product slug" name="slug" tabindex="0" value="<?php echo e($product->slug); ?>"
                            aria-required="true">
                        <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert">
                                <strong style="font-size: 13px; "><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <div class="text-tiny">Do not exceed 100 characters when entering the
                            product name.</div>
                    </fieldset>




                    <div class="gap22 cols">
                        
                        <fieldset class="category">
                            <div class="mb-10 body-title">Category <span class="tf-color-1">*</span>
                            </div>
                            <div class="select">
                                <select class="<?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="category_id">
                                    <option>Choose category</option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>"
                                            <?php echo e($product->category_id == $category->id ? 'selected' : ''); ?>>
                                            <?php echo e($category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong style="font-size: 13px; "><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </fieldset>



                        
                        <fieldset class="brand">
                            <div class="mb-10 body-title">Brand <span class="tf-color-1">*</span>
                            </div>
                            <div class="select">

                                <select class="<?php $__errorArgs = ['brand_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="brand_id">
                                    <option>Choose Brand</option>
                                    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($brand->id); ?>"
                                            <?php echo e($product->brand_id == $brand->id ? 'selected' : ''); ?>><?php echo e($brand->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['brand_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="font-size: 13px; "><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </fieldset>
                    </div>
                    
                    <fieldset class="shortdescription">
                        <div class="mb-10 body-title">Short Description <span class="tf-color-1">*</span></div>
                        <textarea class="mb-10 ht-150" name="short_description" placeholder="Short Description" tabindex="0"
                            aria-required="true"><?php echo e($product->short_description); ?></textarea>

                        <div class="text-tiny">Do not exceed 100 characters when entering the
                            product name.</div>
                    </fieldset>
                    
                    <fieldset class="description">
                        <div class="mb-10 body-title">Description <span class="tf-color-1">*</span>
                        </div>
                        <textarea class="mb-10" name="description" placeholder="Description" tabindex="0" aria-required="true"><?php echo e($product->description); ?></textarea>

                        <div class="text-tiny">Do not exceed 100 characters when entering the
                            product name.</div>
                    </fieldset>
                </div>




                
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
                                    <?php if($product->image): ?>
                                        <img src="<?php echo e(asset('storage/uploads/products/' . $product->image)); ?>"
                                            alt="Product Image"
                                            style="width: 150px; height: 150px; border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                    <?php endif; ?>
                                </div>
                                <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="font-size: 13px;"><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                                <?php if($product->images): ?>
                                    <?php $__currentLoopData = json_decode($product->images); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div
                                            style="position: relative; width: 100px; height: 100px; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                            <!-- Image -->
                                            <img src="<?php echo e(asset('storage/uploads/products/gallery/' . $image)); ?>"
                                                alt="Gallery Image" style="width: 100%; height: 100%; object-fit: cover;">

                                            <!-- Delete Button -->
                                            <form method="POST"
                                                action="<?php echo e(route('admin.product.gallery.delete', ['product' => $product->id, 'image' => $image])); ?>"
                                                style="position: absolute; top: 5px; right: 5px; z-index: 10;">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit"
                                                    style="background-color: rgba(0, 0, 0, 0.6); color: white; border: none; border-radius: 50%; width: 25px; height: 25px; display: flex; align-items: center; justify-content: center; font-size: 14px; cursor: pointer; transition: background-color 0.3s;">
                                                    &times;
                                                </button>
                                            </form>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>


                        </div>
                    </fieldset>
                    
                    <div class="cols gap22">


                        
                        <fieldset class="name">
                            <div class="mb-10 body-title">Regular Price <span class="tf-color-1">*</span></div>
                            <input class="mb-10 <?php $__errorArgs = ['regular_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                placeholder="Enter regular price" name="regular_price" tabindex="0"
                                value=" <?php echo e($product->regular_price); ?>" aria-required="true">
                            <?php $__errorArgs = ['regular_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong style="font-size: 13px; "><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </fieldset>


                        
                        <fieldset class="name">
                            <div class="mb-10 body-title ">Sale Price <span class="tf-color-1">*</span></div>
                            <input class="mb-10 <?php $__errorArgs = ['sale_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                placeholder="Enter sale price" name="sale_price" tabindex="0"
                                value="<?php echo e($product->sale_price); ?>" aria-required="true">
                            <?php $__errorArgs = ['sale_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong style="font-size: 13px; "><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </fieldset>
                    </div>


                    <div class="cols gap22">

                        
                        <fieldset class="name">
                            <div class="mb-10 body-title">SKU <span class="tf-color-1">*</span>
                            </div>
                            <input class="mb-10 <?php $__errorArgs = ['SKU'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                placeholder="Enter SKU" name="SKU" tabindex="0" value="<?php echo e($product->SKU); ?>"
                                aria-required="true">
                            <?php $__errorArgs = ['SKU'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong style="font-size: 13px; "><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </fieldset>

                        
                        <fieldset class="name">
                            <div class="mb-10 body-title">Quantity <span class="tf-color-1">*</span>
                            </div>
                            <input class="mb-10 <?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                placeholder="Enter quantity" name="quantity" tabindex="0"
                                value="<?php echo e($product->quantity); ?>" aria-required="true">
                            <?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong style="font-size: 13px; "><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </fieldset>
                    </div>


                    <?php
                        // ডাটাবেজ থেকে আগের sizes ডাটা ডিকোড করছি
                        $selectedSizes = json_decode($product->sizes, true) ?? [];
                    ?>

                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="mb-10 body-title">Available Sizes <span class="tf-color-1">*</span></div>
                            <div class="flex gap-15" style="flex-wrap: wrap;">
                                <?php $__currentLoopData = ['XS', 'S', 'M', 'L', 'XL', 'XXL']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="checkbox-group">
                                        <input type="checkbox" id="size<?php echo e($size); ?>" name="sizes[]"
                                            value="<?php echo e($size); ?>" class="checkbox-input"
                                            <?php echo e(in_array($size, $selectedSizes) ? 'checked' : ''); ?>>
                                        <label for="size<?php echo e($size); ?>"
                                            class="checkbox-label"><?php echo e($size); ?></label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <?php $__errorArgs = ['sizes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong style="font-size: 13px;"><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </fieldset>
                    </div>


                    <div class="cols gap22">
                        
                        <fieldset class="name">
                            <div class="mb-10 body-title">Stock</div>
                            <div class="mb-10 select">
                                <select class="<?php $__errorArgs = ['stock_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="stock_status">
                                    <option value="instock" <?php echo e($product->stock_status == 'instock' ? 'selected' : ''); ?>>
                                        InStock</option>
                                    <option value="outofstock"
                                        <?php echo e($product->stock_status == 'outofstock' ? 'selected' : ''); ?>>
                                        Out of Stock</option>
                                </select>
                                <?php $__errorArgs = ['stock_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="font-size: 13px; "><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </fieldset>

                        
                        <fieldset class="name">
                            <div class="mb-10 body-title">Featured</div>
                            <div class="mb-10 select">
                                <select class="<?php $__errorArgs = ['featured'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="featured">
                                    <option value="0" <?php echo e($product->featured == '0' ? 'selected' : ''); ?>>No
                                    </option>
                                    <option value="1" <?php echo e($product->featured == '1' ? 'selected' : ''); ?>>Yes
                                    </option>
                                </select>
                            </div>
                            <?php $__errorArgs = ['featured'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong style="font-size: 13px; "><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>
<?php $__env->startPush('styles'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/devshadin/ecommercesite.dev-shadin.com/resources/views/admin/products/product-edit.blade.php ENDPATH**/ ?>