<?php $__env->startSection('title', 'Contact'); ?>

<?php $__env->startSection('content'); ?>
    <?php if(Session::has('success')): ?>
        <script>
            Swal.fire({
                title: 'Success!',
                text: "<?php echo e(Session::get('success')); ?>",
                icon: 'success',
                timer: 5000, // 2 second
                showConfirmButton: false
            });
        </script>
    <?php endif; ?>

    <?php if(Session::has('error')): ?>
        <script>
            Swal.fire({
                title: 'Error!',
                text: "<?php echo e(Session::get('error')); ?>",
                icon: 'error',
                timer: 5000, // 2 second
                showConfirmButton: false
            });
        </script>
    <?php endif; ?>
    <main class="pt-90">
        <div class="pb-4 mb-4"></div>
        <section class="container contact-us">
            <div class="mw-930">
                <h2 class="page-title">CONTACT US</h2>
            </div>
        </section>

        <hr class="mt-2 text-secondary " />
        <div class="pb-4 mb-4"></div>

        <section class="container contact-us">
            <div class="mw-930">
                <div class="contact-us__form">
                    <form name="contact-us-form" class="needs-validation" action="<?php echo e(route('website.contact.submit')); ?>"
                        method="POST">
                        <?php echo csrf_field(); ?>
                        <h3 class="mb-5">Get In Touch</h3>
                        <div class="my-4 form-floating">
                            <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name"
                                placeholder="Name *" value="<?php echo e(old('name')); ?>">
                            <label for="contact_us_name">Name *</label>
                            <span class="text-danger"></span>
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="my-4 form-floating">
                            <input type="text" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="phone"
                                placeholder="Phone *" value="<?php echo e(old('phone')); ?>">
                            <label for="contact_us_name">Phone *</label>
                            <span class="text-danger"></span>
                            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="my-4 form-floating">
                            <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email"
                                placeholder="Email address *" value="<?php echo e(old('email')); ?>">
                            <label for="contact_us_name">Email address *</label>
                            <span class="text-danger"></span>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        </div>
                        <div class="my-4">
                            <textarea class="form-control form-control_gray <?php $__errorArgs = ['comment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="comment"
                                placeholder="Your Message" cols="30" rows="8"><?php echo e(old('comment')); ?></textarea>
                            <span class="text-danger"></span>
                            <?php $__errorArgs = ['comment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        </div>
                        <div class="my-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/devshadin/ecommercesite.dev-shadin.com/resources/views/contact.blade.php ENDPATH**/ ?>