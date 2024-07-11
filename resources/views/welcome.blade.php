@extends('layouts/app', ['activePage' => 'welcome', 'title' => 'Mathematics Challenge Platform'])

@section('content')
    <div class="full-page section-image" data-image="{{asset('light-bootstrap/img/full-screen-image-4.jpg')}}">
        <div class="content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7 col-md-8">
                        <h1 class="text-white text-center"><b>{{ __('Welcome to Mathematics Challenge Platform') }}</b></h1>
                        <h4 class="text-white text-center"><b><i>{{ __('"Unlock the Power of Mathematics, One Challenge at a Time"') }}</i></b></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            demo.checkFullPageBackgroundImage();

            setTimeout(function() {
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 700)
        });
    </script>
@endpush