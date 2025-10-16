<?php $__env->startSection('title', 'Register'); ?>

<?php $__env->startSection('content'); ?>

    <div id="loading-spinner" class="spinner-overlay" style="display:none;">
        <div class="spinner"></div>
        <p class="loading-text">Register Process is sending...</p>
    </div>
    <main class="pt-90">
        <div class="pb-4 mb-4"></div>
        <section class="container login-register">
            <ul class="mb-5 nav nav-tabs" id="login_register" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link nav-link_underscore active" id="register-tab" data-bs-toggle="tab"
                        href="#tab-item-register" role="tab" aria-controls="tab-item-register"
                        aria-selected="true">Register</a>
                </li>
            </ul>
            <div class="pt-2 tab-content" id="login_register_tab_content">
                <div class="tab-pane fade show active" id="tab-item-register" role="tabpanel"
                    aria-labelledby="register-tab">
                    <div class="register-form">
                        <form method="POST" action="<?php echo e(route('register')); ?>" name="register-form" class="needs-validation"
                            novalidate="">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3 form-floating">
                                <input class="form-control form-control_gray  <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    name="name" value="<?php echo e(old('name')); ?>" required="" autocomplete="name"
                                    autofocus="">
                                <label for="name">Name</label>
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
                            <div class="pb-3"></div>
                            <div class="mb-3 form-floating">
                                <input id="email" type="email"
                                    class="form-control form-control_gray  <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    name="email" value="<?php echo e(old('email')); ?>" required="" autocomplete="email">
                                <label for="email">Email address *</label>
                                <?php $__errorArgs = ['email'];
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

                            <div class="pb-3"></div>

                            <div class="mb-3 form-floating">
                                <input id="mobile" type="text"
                                    class="form-control form-control_gray  <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    name="mobile" value="<?php echo e(old('mobile')); ?>" required="" autocomplete="mobile">
                                <label for="mobile">Mobile *</label>

                                <?php $__errorArgs = ['mobile'];
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

                            <div class="pb-3"></div>

                            <div class="mb-3 form-floating">
                                <input id="password" type="password"
                                    class="form-control form-control_gray <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    name="password" required="" autocomplete="new-password">
                                <label for="password">Password *</label>
                                <?php $__errorArgs = ['password'];
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

                            <div class="mb-3 form-floating">
                                <input id="password-confirm" type="password" class="form-control form-control_gray"
                                    name="password_confirmation" required="" autocomplete="new-password">
                                <label for="password">Confirm Password *</label>
                            </div>

                            <div class="pb-2 mb-3 d-flex align-items-center">
                                <p class="m-0">Your personal data will be used to support your experience throughout this
                                    website, to
                                    manage access to your account, and for other purposes described in our privacy policy.
                                </p>
                            </div>

                            <button class="btn btn-primary w-100 text-uppercase" type="submit">Register</button>

                            <div class="mt-4 text-center customer-option">
                                <span class="text-secondary">Have an account?</span>
                                <a href="<?php echo e(route('login')); ?>" class="btn-text js-show-register">Login to your Account</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .spinner-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            z-index: 9999;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(2px);
        }

        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        .loading-text {
            margin-top: 15px;
            color: #3498db;
            font-weight: 500;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');
            const spinner = document.getElementById('loading-spinner');

            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    // ফর্ম ভ্যালিডেশন চেক
                    if (form.checkValidity()) {
                        spinner.style.display = 'flex';

                        // সাবমিশন শেষে স্পিনার হাইড (যদি AJAX ব্যবহার না করেন)
                        window.addEventListener('pageshow', function() {
                            spinner.style.display = 'none';
                        });
                    }
                });
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/devshadin/ecommercesite.dev-shadin.com/resources/views/auth/register.blade.php ENDPATH**/ ?>