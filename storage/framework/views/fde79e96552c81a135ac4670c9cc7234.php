<?php $__env->startSection('title', 'Products-add'); ?>

<?php $__env->startSection('content'); ?>

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
                        <div class="text-tiny">Add product</div>
                    </li>
                </ul>
            </div>
            <!-- form-add-product -->
            <form class="tf-section-2 form-add-product" method="POST" enctype="multipart/form-data"
                action="<?php echo e(route('admin.products.store')); ?>">
                <?php echo csrf_field(); ?>
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
                            placeholder="Enter product name" name="name" tabindex="0" value="<?php echo e(old('name')); ?>"
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
                            placeholder="Enter product slug" name="slug" tabindex="0" value="<?php echo e(old('slug')); ?>"
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
                                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
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
                                        <option value="<?php echo e($brand->id); ?>"><?php echo e($brand->name); ?></option>
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
                            aria-required="true"><?php echo e(old('short_description')); ?></textarea>

                        <div class="text-tiny">Do not exceed 100 characters when entering the
                            product name.</div>
                    </fieldset>
                    
                    <fieldset class="description">
                        <div class="mb-10 body-title">Description <span class="tf-color-1">*</span>
                        </div>
                        <textarea class="mb-10" name="description" placeholder="Description" tabindex="0" aria-required="true"><?php echo e(old('description')); ?></textarea>

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
                                <div id="imagePreview" style="margin-top: 10px;"></div>
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
                            <div id="galleryPreview" style="margin-top: 10px; display: flex; gap: 10px;"></div>
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
                                value=" <?php echo e(old('regular_price')); ?> " aria-required="true">
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
                                value="<?php echo e(old('sale_price')); ?>" aria-required="true">
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
                                placeholder="Enter SKU" name="SKU" tabindex="0" value="<?php echo e(old('SKU')); ?>"
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
                                value="<?php echo e(old('quantity')); ?>" aria-required="true">
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
                                    <option value="instock">InStock</option>
                                    <option value="outofstock">Out of Stock</option>
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
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
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
                        <button class="w-full tf-button" type="submit">Add product</button>
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
<?php $__env->stopPush(); ?>
<?php $__env->startPush('styles'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/devshadin/ecommercesite.dev-shadin.com/resources/views/admin/products/product-add.blade.php ENDPATH**/ ?>