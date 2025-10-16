@extends('layouts.app')

@section('title', 'Register')

@section('content')

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
                        <form method="POST" action="{{ route('register') }}" name="register-form" class="needs-validation"
                            novalidate="">
                            @csrf
                            <div class="mb-3 form-floating">
                                <input class="form-control form-control_gray  @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required="" autocomplete="name"
                                    autofocus="">
                                <label for="name">Name</label>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="pb-3"></div>
                            <div class="mb-3 form-floating">
                                <input id="email" type="email"
                                    class="form-control form-control_gray  @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required="" autocomplete="email">
                                <label for="email">Email address *</label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="pb-3"></div>

                            <div class="mb-3 form-floating">
                                <input id="mobile" type="text"
                                    class="form-control form-control_gray  @error('mobile') is-invalid @enderror"
                                    name="mobile" value="{{ old('mobile') }}" required="" autocomplete="mobile">
                                <label for="mobile">Mobile *</label>

                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="pb-3"></div>

                            <div class="mb-3 form-floating">
                                <input id="password" type="password"
                                    class="form-control form-control_gray @error('password') is-invalid @enderror"
                                    name="password" required="" autocomplete="new-password">
                                <label for="password">Password *</label>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
                                <a href="{{ route('login') }}" class="btn-text js-show-register">Login to your Account</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('styles')
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
@endpush

@push('scripts')
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
@endpush
