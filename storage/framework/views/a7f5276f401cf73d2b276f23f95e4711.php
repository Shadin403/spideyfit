<?php $__env->startSection('title', 'Checkout'); ?>
<?php $__env->startSection('content'); ?>
    <main class="pt-90">
        <div class="pb-4 mb-4"></div>
        <section class="container shop-checkout">
            <h2 class="page-title">Shipping and Checkout</h2>
            <div class="checkout-steps">
                <a href="<?php echo e(route('cart.index')); ?>" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">01</span>
                    <span class="checkout-steps__item-title">
                        <span>Shopping Bag</span>
                        <em>Manage Your Items List</em>
                    </span>
                </a>
                <a href="<?php echo e(route('cart.checkout')); ?>" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">02</span>
                    <span class="checkout-steps__item-title">
                        <span>Shipping and Checkout</span>
                        <em>Checkout Your Items List</em>
                    </span>
                </a>
                <a href="javascript:void(0)" class="checkout-steps__item">
                    <span class="checkout-steps__item-number">03</span>
                    <span class="checkout-steps__item-title">
                        <span>Confirmation</span>
                        <em>Review And Submit Your Order</em>
                    </span>
                </a>
            </div>
            <form name="checkout-form" action="<?php echo e(route('cart.place.an.order')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="checkout-form">
                    <div class="billing-info__wrapper">
                        <div class="row">
                            <div class="col-6">
                                <h4>SHIPPING DETAILS</h4>
                            </div>
                            <div class="col-6">
                            </div>
                        </div>
                        <?php if($Address): ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="my-account__address-list-item">
                                        <div class="my-account__address-item__detail">
                                            <h5><?php echo e($Address->name); ?> <i class="fa fa-check-circle text-success"></i>
                                            </h5>
                                            <strong>Address:</strong>
                                            <p><?php echo e($Address->address); ?></p>
                                            <p><?php echo e($Address->locality); ?>,<?php echo e($Address->city); ?></p>
                                            <p><?php echo e($Address->state); ?>, <?php echo e($Address->country); ?></p>
                                            <p><?php echo e($Address->landmark); ?>,<?php echo e($Address->zip); ?></p>
                                            <br>
                                            <p><strong>Mobile <span style="color: red">:</span></strong>
                                                <?php echo e(auth()->user()->address->phone); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a href="<?php echo e(route('user.address')); ?>" class="mt-5 btn btn-sm btn-warning">Change Default
                                Address</a>
                            <a href="<?php echo e(route('user.address.add')); ?>" class="mt-5 btn btn-sm btn-info">Add New
                                Address</a>
                        <?php else: ?>
                            <div class="mt-5 row">
                                <div class="col-md-6">
                                    <div class="my-3 form-floating">
                                        <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            name="name" value="<?php echo e(auth()->user()->name); ?><?php echo e(old('name')); ?>"
                                            required="">
                                        <label for="name">Full Name *</label>
                                        <span class="text-danger"></span>
                                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="my-3 form-floating">
                                        <input type="text" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            name="phone" value="<?php echo e(auth()->user()->mobile); ?><?php echo e(old('phone')); ?>"
                                            required="">
                                        <label for="phone">Phone Number *</label>
                                        <span class="text-danger"></span>
                                        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="my-3 form-floating">
                                        <input type="text" class="form-control <?php $__errorArgs = ['zip'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            name="zip" value="<?php echo e(old('zip')); ?>" required="">
                                        <label for="zip">Zipcode *</label>
                                        <span class="text-danger"></span>
                                        <?php $__errorArgs = ['zip'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mt-3 mb-3 form-floating">
                                        <input type="text" class="form-control <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            name="state" value="<?php echo e(old('state')); ?>" required="">
                                        <label for="state">State *</label>
                                        <span class="text-danger"></span>
                                        <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="my-3 form-floating">
                                        <input type="text" class="form-control <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            name="city" value="<?php echo e(old('city')); ?>" required="">
                                        <label for="city">Town / City *</label>
                                        <span class="text-danger"></span>
                                        <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="my-3 form-floating">
                                        <input type="text" class="form-control <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            name="address" value="<?php echo e(old('address')); ?>" required="">
                                        <label for="address">House no, Building Name *</label>
                                        <span class="text-danger"></span>
                                        <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="my-3 form-floating">
                                        <input type="text" class="form-control <?php $__errorArgs = ['locality'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            name="locality" value="<?php echo e(old('locality')); ?>" required="">
                                        <label for="locality">Road Name, Area, Colony *</label>
                                        <span class="text-danger"></span>
                                        <?php $__errorArgs = ['locality'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="my-3 form-floating">
                                        <input type="text" class="form-control <?php $__errorArgs = ['landmark'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            name="landmark" value="<?php echo e(old('landmark')); ?>" required="">
                                        <label for="landmark">Landmark *</label>
                                        <span class="text-danger"></span>
                                        <?php $__errorArgs = ['landmark'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="checkout__totals-wrapper">
                        <div class="sticky-content">
                            <div class="checkout__totals">
                                <h3>Your Order</h3>
                                <table class="checkout-cart-items">
                                    <thead>
                                        <tr>
                                            <th>PRODUCT</th>
                                            <th align="right">SUBTOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = Cart::instance('cart')->content(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <?php echo e($item->name); ?> x <?php echo e($item->qty); ?> --
                                                    <b>Size:</b><?php echo e($item->options['size'] ?? 'N/A'); ?>

                                                </td>
                                                <td align="right">
                                                    $<?php echo e($item->subtotal); ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                <table class="checkout-totals">
                                    <tbody>
                                        <?php if(Session::has('discounts')): ?>
                                            <tr>
                                                <th>Subtotal</th>
                                                <td align="right">$<?php echo e(Cart::instance('cart')->subtotal()); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Discount <?php echo e(Session::get('coupon')['code']); ?></th>
                                                <td align="right">$<?php echo e(Session::get('discounts')['discount']); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Subtotal After Discount</th>
                                                <td align="right">$<?php echo e(Session::get('discounts')['subtotal']); ?></td>
                                            </tr>

                                            <tr>
                                                <th>SHIPPING</th>
                                                <td align="right">Free shipping</td>
                                            </tr>
                                            <tr>
                                                <th>VAT</th>
                                                <td align="right"><?php echo e(Session::get('discounts')['tax']); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Total</th>
                                                <td align="right"><?php echo e(Session::get('discounts')['total']); ?></td>
                                            </tr>
                                        <?php else: ?>
                                            <tr>
                                                <th>Subtotal</th>
                                                <td align="right">$<?php echo e(Cart::instance('cart')->subtotal()); ?></td>
                                            </tr>
                                            <tr>
                                                <th>SHIPPING</th>
                                                <td align="right">Free shipping</td>
                                            </tr>
                                            <tr>
                                                <th>VAT</th>
                                                <td align="right"><?php echo e(Cart::instance('cart')->tax()); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Total</th>
                                                <td align="right"><?php echo e(Cart::instance('cart')->total()); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="checkout__payment-methods">

                                <div class="form-check">
                                    <input class="form-check-input form-check-input_fill" type="radio" name="mode"
                                        id="mode1" value="">
                                    <label class="form-check-label" for="checkout_payment_method_2">
                                        Debit Or Credit Cart

                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input form-check-input_fill" type="radio" name="mode"
                                        id="mode2" value="">
                                    <label class="form-check-label" for="checkout_payment_method_4">
                                        Paypal
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input form-check-input_fill" type="radio" name="mode"
                                        id="mode3" value="cod">
                                    <label class="form-check-label" for="checkout_payment_method_3">
                                        Cash on delivery
                                    </label>
                                </div>
                                <div class="policy-text">
                                    Your personal data will be used to process your order, support your experience
                                    throughout this
                                    website, and for other purposes described in our <a href="terms.html"
                                        target="_blank">privacy
                                        policy</a>.
                                </div>
                            </div>
                            <button class="btn btn-primary btn-checkout">PLACE ORDER</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('styles'); ?>
    <style>
        .btn-warning:hover {
            background-color: #e09e36;

            color: #fff;

        }

        .btn-warning {
            border-radius: 5px;
            margin-right: 5px;
            margin-top: 9px;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/devshadin/ecommercesite.dev-shadin.com/resources/views/checkout.blade.php ENDPATH**/ ?>