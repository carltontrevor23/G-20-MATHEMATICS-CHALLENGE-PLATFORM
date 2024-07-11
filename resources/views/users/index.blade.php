@extends('layouts.app', ['activePage' => 'index', 'title' => 'Representatives', 'navName' => 'Table List', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header ">
                            <h4 class="card-title">Representatives</h4>
                            <p class="card-category">These are the representatives currently registered in the system.</p>
                        </div>
                        <div class="card-body table-full-width table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>School</th>
                                    <th>Date Registered</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Naddenge Alice</td>
                                        <td>Kikoni Boys' Primary School</td>
                                        <td>alicenadde@icloud.com</td>
                                        <td>09-07-2024</td>
                                    </tr>
                                    <tr>
                                        <td>Akira Alexis</td>
                                        <td>Sango Bay Junior School</td>
                                        <td>akira999@gmail.com</td>
                                        <td>29-06-2024</td>
                                    </tr>
                                    <tr>
                                        <td>Pande Hamilton</td>
                                        <td>Light Academy</td>
                                        <td>hpande@lightacademy.co.ug</td>
                                        <td>01-07-2024</td>
                                    </tr>
                                    <tr>
                                        <td>Omukunda Lillian</td>
                                        <td>Brainstone Academy</td>
                                        <td>lilianomuk23@gmail.com</td>
                                        <td>20-08-2024</td>
                                    </tr>
                                    <tr>
                                        <td>Jjango Jeremiah</td>
                                        <td>Starlight Primary School</td>
                                        <td>jjmath@yahoo.com</td>
                                        <td>27-06-2024</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <a href="{{ route('upload.index') }}" class="btn btn-primary">{{ __('Upload New Representative') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection