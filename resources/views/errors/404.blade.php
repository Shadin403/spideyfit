@extends('layouts.app')
@section('content')
    <section class="page_404" style="margin:50px 0px 0px 30px">
        <div class="container">
            <div class="row">

                <div class="text-center col-sm-10 col-sm-offset-1">

                    <div class="col-sm-12">
                        <div class="four_zero_four_bg" style="margin-bottom: 20px;">
                            <h1 class="text-center ">404</h1>

                        </div>
                        <div class="contant_box_404">
                            <h3 class="h2">
                                Page Not Found
                            </h3>

                            <p>the page you are looking for not avaible!</p>

                            <a href="{{ route('home.index') }}" class="link_404">Go to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
