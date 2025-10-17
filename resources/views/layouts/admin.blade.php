<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    {{-- <title>Sadhin Store</title> --}}
    <meta charset="utf-8">
    <meta name="author" content="dev-shadin.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/animation.css ') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('font/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('icon/style.css') }}">
    <link rel="shortcut icon" href="{{ asset(' images/favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/favicon.ico') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .toast {
            font-size: 15px !important;

            border-radius: 8px !important;
            /* কোণ গোলাকার করার জন্য */
        }

        #toast-container>.toast {
            width: 400px !important;
            /* টোস্টার এর প্রস্থ নির্ধারণ */
        }

        #toast-container {
            top: 50px !important;
            /* উপরের থেকে দূরত্ব */

        }
    </style>

    @stack('styles')
</head>

<body class="body">
    <div>
        @if (Session::has('success'))
            <script>
                Swal.fire({
                    title: 'Success!',
                    text: "{{ Session::get('success') }}",
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif

        @if (Session::has('error'))
            <script>
                Swal.fire({
                    title: 'Error!',
                    text: "{{ Session::get('error') }}",
                    icon: 'error',
                    confirmButtonText: 'Try Again'
                });
            </script>
        @endif

    </div>

    <div id="wrapper">

        <div id="page" class="">
            <div class="layout-wrap">

                @include('admin.partials.sidebar-nav')
                <div class="section-content-right">

                    @include('admin.partials.header-nav')



                    <div class="main-content">
                        @yield('content')


                        {{ $slot ?? null }}

                    </div>
                </div>
            </div>
        </div>


        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
        <script src="{{ asset('js/sweetalert.min.js') }}"></script>
        <script src="{{ asset('js/apexcharts/apexcharts.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        @stack('scripts')
        <script>
            $(function() {
                let timer;

                $("#search-input").on("keyup", function() {
                    clearTimeout(timer);

                    // ডিবাউন্সিং যোগ করুন
                    timer = setTimeout(function() {
                        let value = $("#search-input").val().trim();

                        // সার্চ কুয়েরি ভেরিফিকেশন
                        if (value.length > 2 && !/^\s*$/.test(value)) {
                            $.ajax({
                                url: "{{ route('admin.search') }}",
                                type: "GET",
                                data: {
                                    query: value
                                },
                                dataType: "json",
                                beforeSend: function() {
                                    // This is the loading state
                                    $("#box-content-search").html('<li>Loading...</li>');
                                },
                                success: function(response) {
                                    // This is the null result state
                                    if (response.length === 0) {
                                        $("#box-content-search").html(
                                            '<li>No results found.</li>');
                                    } else {
                                        // This is the success state
                                        $("#box-content-search").html('');
                                        $.each(response, function(index, item) {
                                            let url =
                                                "{{ route('admin.product.edit', ['id' => 'product_id']) }}";
                                            let link = url.replace(
                                                'product_id', item.id);
                                            $("#box-content-search").append(`
                                        <li>
                                            <ul>
                                                <li class="mb-10 product-item gap14">
                                                    <div class="image no-bg">
                                                        <a href="${link}"> <img src="{{ asset('uploads/products/') }}/${item.image}" alt="${item.name}"></a>
                                                    </div>
                                                    <div class="flex items-center justify-between flex-grow gap20">
                                                        <div class="name">
                                                            <a href="${link}">${item.name}</a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mb-10">
                                                    <div class="divider"></div>
                                                </li>
                                            </ul>
                                        </li>
                                    `);
                                        });
                                    }
                                },
                                error: function(xhr, status, error) {
                                    // This is the error state
                                    console.error("Error fetching search results:", error);
                                    $("#box-content-search").html(
                                        '<li>Error loading search results. Please try again.</li>'
                                    );
                                }
                            });
                        } else {
                            // this is handle the empty search
                            $("#box-content-search").html('');
                        }
                    }, 200);
                });
            });
        </script>
</body>

</html>
