@extends('layouts.app', ['activePage' => 'upload-schools', 'title' => 'School Upload', 'navName' => 'Upload Schools', 'activeButton' => 'laravel'])

@section('content')
<!--Form for uploading schools into the system-->
    <div class="content">
        <div class="container-fluid">
            <div class="section-image">
                <div class="row">

                    <div class="card col-md-12">
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
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">
                                            <i class="w3-xxlarge fa fa-user"></i>{{ __(' School Name') }}
                                        </label>
                                        <input type="text" name="name" id="input-name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('School Name') }}" required autofocus>
        
                                        @include('alerts.feedback', ['field' => 'name'])
                                    </div>
                                    <div class="form-group{{ $errors->has('district') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-district">
                                            <i class="nc-icon nc-map-big"></i>{{ __(' District') }}
                                        </label>
                                        <input type="text" name="district" id="input-district" class="form-control{{ $errors->has('district') ? ' is-invalid' : '' }}" placeholder="{{ __('District Name') }}" required autofocus>
        
                                        @include('alerts.feedback', ['field' => 'district'])
                                    </div>
                                    <div class="form-group{{ $errors->has('registration_number') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-registration_number">
                                            <i class="nc-icon nc-notes"></i>{{ __(' School Registration Number') }}
                                        </label>
                                        <input type="text" name="registration_number" id="input-registration_number" class="form-control{{ $errors->has('registration_number') ? ' is-invalid' : '' }}" placeholder="{{ __('Registration Number') }}" required autofocus>
        
                                        @include('alerts.feedback', ['field' => 'registration_number'])
                                    </div>
                                    <div class="form-group{{ $errors->has('representative_name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-representative_name">
                                            <i class="nc-icon nc-badge"></i>{{ __(' Name of Representative') }}
                                        </label>
                                        <input type="text" name="representative_name" id="input-representative_name" class="form-control{{ $errors->has('representative_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Representative Name') }}" required autofocus>
        
                                        @include('alerts.feedback', ['field' => 'representative_name'])
                                    </div>
                                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-email">
                                            <i class="w3-xxlarge fa fa-envelope-o"></i>{{ __(' Email of Representative') }}</label>
                                        <input type="email" name="email" id="input-email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Representative Email') }}"  required>
        
                                        @include('alerts.feedback', ['field' => 'email'])
                                    </div>
                                    <div class="form-group{{ $errors->has('representative_password') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-representative_password">
                                            <i class="nc-icon nc-tag-content"></i>{{ __(' Representative Password') }}</label>
                                        <input type="text" name="representative_password" id="input-representative_password" class="form-control{{ $errors->has('representative_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Representative Password') }}"  required>
        
                                        @include('alerts.feedback', ['field' => 'representative_password'])
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-default mt-4">{{ __('Upload') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection