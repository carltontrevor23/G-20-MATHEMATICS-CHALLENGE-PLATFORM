@extends('layouts.app', ['activePage' => 'uploadschools', 'title' => 'Upload Schools', 'navName' => 'Typography', 'activeButton' => 'laravel'])

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="section-image">
                <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
                <div class="row">

                    <div class="card col-md-8">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h3 class="mb-0">{{ __('School Details') }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('school.store') }}" autocomplete="off"
                                enctype="multipart/form-data">
                                @csrf
                                
                                @include('alerts.success')
                                @include('alerts.error_self_update', ['key' => 'not_allow_profile'])
        
                                <div class="pl-lg-4">
                                    <div class="form-group{{ $errors->has('schoolName') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-schoolName">
                                            <i class="w3-xxlarge fa fa-user"></i>{{ __('School Name') }}
                                        </label>
                                        <input type="text" name="schoolName" id="input-schoolName" class="form-control{{ $errors->has('schoolName') ? ' is-invalid' : '' }}" placeholder="{{ __('School Name') }}" required autofocus>
        
                                        @include('alerts.feedback', ['field' => 'schoolName'])
                                    </div>
                                    <div class="form-group{{ $errors->has('district') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-district">
                                            <i class="w3-xxlarge fa fa-user"></i>{{ __('District') }}
                                        </label>
                                        <input type="text" name="district" id="input-district" class="form-control{{ $errors->has('district') ? ' is-invalid' : '' }}" placeholder="{{ __('District Name') }}" required autofocus>
        
                                        @include('alerts.feedback', ['field' => 'district'])
                                    </div>
                                    <div class="form-group{{ $errors->has('schoolRegNo') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-schoolRegNo">
                                            <i class="w3-xxlarge fa fa-user"></i>{{ __('School Registration Number') }}
                                        </label>
                                        <input type="text" name="schoolRegNo" id="input-schoolRegNo" class="form-control{{ $errors->has('schoolRegNo') ? ' is-invalid' : '' }}" placeholder="{{ __('Registration Number') }}" required autofocus>
        
                                        @include('alerts.feedback', ['field' => 'schoolRegNo'])
                                    </div>
                                    <div class="form-group{{ $errors->has('repName') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-repName">
                                            <i class="w3-xxlarge fa fa-user"></i>{{ __('Name of Representative') }}
                                        </label>
                                        <input type="text" name="repName" id="input-repName" class="form-control{{ $errors->has('repName') ? ' is-invalid' : '' }}" placeholder="{{ __('Representative Name') }}" required autofocus>
        
                                        @include('alerts.feedback', ['field' => 'repName'])
                                    </div>
                                    <div class="form-group{{ $errors->has('repEmail') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-repEmail"><i class="w3-xxlarge fa fa-envelope-o"></i>{{ __('Email of Representative') }}</label>
                                        <input type="email" name="repEmail" id="input-repEmail" class="form-control{{ $errors->has('repEmail') ? ' is-invalid' : '' }}" placeholder="{{ __('Representative Email') }}"  required>
        
                                        @include('alerts.feedback', ['field' => 'repEmail'])
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-default mt-4">{{ __('Upload') }}</button>
                                    </div>
                                </div>
                            </form>
                            <!--<hr class="my-4" />
                            <form method="post" action="{{ route('profile.password') }}">
                                @csrf
        
                                <h6 class="heading-small text-muted mb-4">{{ __('Password') }}</h6>
        
                                @include('alerts.success', ['key' => 'password_status'])
                                @include('alerts.error_self_update', ['key' => 'not_allow_password'])
        
                                <div class="pl-lg-4">
                                    <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-current-password">
                                            <i class="w3-xxlarge fa fa-eye-slash"></i>{{ __('Current Password') }}
                                        </label>
                                        <input type="password" name="old_password" id="input-current-password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" value="" required>
        
                                        @include('alerts.feedback', ['field' => 'old_password'])
                                    </div>
                                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-password">
                                            <i class="w3-xxlarge fa fa-eye-slash"></i>{{ __('New Password') }}
                                        </label>
                                        <input type="password" name="password" id="input-password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required>
        
                                        @include('alerts.feedback', ['field' => 'password'])
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-password-confirmation">
                                            <i class="w3-xxlarge fa fa-eye-slash"></i>{{ __('Confirm New Password') }}
                                        </label>
                                        <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control" placeholder="{{ __('Confirm New Password') }}" value="" required>
                                    </div>
        
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-default mt-4">{{ __('Change password') }}</button>
                                    </div>
                                </div>
                            </form>-->
                        </div>
                    </div>

                    <!--<div class="col-md-4">
                        <div class="card card-user">
                            <div class="card-image">
                                <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="...">
                            </div>
                            <div class="card-body">
                                <div class="author">
                                    <a href="#">
                                        <img class="avatar border-gray" src="{{ asset('light-bootstrap/img/faces/face-3.jpg') }}" alt="...">
                                        <h5 class="title">{{ __('Mike Andrew') }}</h5>
                                    </a>
                                    <p class="description">
                                        {{ __('frankocean2928') }}
                                    </p>
                                </div>
                                <p class="description text-center">
                                {{ __(' "Lamborghini Mercy') }}
                                    <br> {{ __('Your chick she so thirsty') }}
                                    <br> {{ __('I am in that two seat Lambo') }}
                                </p>
                            </div>
                            <hr>
                            <div class="button-container mr-auto ml-auto">
                                <button href="#" class="btn btn-simple btn-link btn-icon">
                                    <i class="fa fa-facebook-square"></i>
                                </button>
                                <button href="#" class="btn btn-simple btn-link btn-icon">
                                    <i class="fa fa-twitter"></i>
                                </button>
                                <button href="#" class="btn btn-simple btn-link btn-icon">
                                    <i class="fa fa-google-plus-square"></i>
                                </button>
                            </div>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
@endsection