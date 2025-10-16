@extends('layouts.app')

@section('title', 'Contact')

@section('content')
    @if (Session::has('success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: "{{ Session::get('success') }}",
                icon: 'success',
                timer: 5000, // 2 second
                showConfirmButton: false
            });
        </script>
    @endif

    @if (Session::has('error'))
        <script>
            Swal.fire({
                title: 'Error!',
                text: "{{ Session::get('error') }}",
                icon: 'error',
                timer: 5000, // 2 second
                showConfirmButton: false
            });
        </script>
    @endif
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
                    <form name="contact-us-form" class="needs-validation" action="{{ route('website.contact.submit') }}"
                        method="POST">
                        @csrf
                        <h3 class="mb-5">Get In Touch</h3>
                        <div class="my-4 form-floating">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                placeholder="Name *" value="{{ old('name') }}">
                            <label for="contact_us_name">Name *</label>
                            <span class="text-danger"></span>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="my-4 form-floating">
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                                placeholder="Phone *" value="{{ old('phone') }}">
                            <label for="contact_us_name">Phone *</label>
                            <span class="text-danger"></span>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="my-4 form-floating">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                placeholder="Email address *" value="{{ old('email') }}">
                            <label for="contact_us_name">Email address *</label>
                            <span class="text-danger"></span>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="my-4">
                            <textarea class="form-control form-control_gray @error('comment') is-invalid @enderror" name="comment"
                                placeholder="Your Message" cols="30" rows="8">{{ old('comment') }}</textarea>
                            <span class="text-danger"></span>
                            @error('comment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="my-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>

@endsection
