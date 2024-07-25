@extends('layouts.app', ['activePage' => 'schools', 'title' => 'Schools', 'navName' => 'Schools', 'activeButton' => 'laravel'])

@section('content')
<!--Displays schools registered in the system-->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header ">
                            <h4 class="card-title">Schools</h4>
                            <p class="card-category">These are the schools currently registered in the system.</p>
                        </div>
                        <div class="card-body table-full-width table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th>School Name</th>
                                    <th>District</th>
                                    <th>School Registration Number</th>
                                </thead>
                                <tbody>
                                    <!--if statement that displays message if schools are not found-->
                                @if($schools->isEmpty())
                                   <p>No schools found</p>
                                @else
                                   <!--foreach loop that displays schools registered in the system-->
                                   @foreach($schools as $school)
                                       <tr>
                                       <td>{{ $school->name  }}</td>
                                       <td>{{ $school->district  }}</td>
                                       <td>{{ $school->registration_number  }}</td>
                                    </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--Link for uploading new schools-->
                <div class="text-center">
                    <a href="{{ route('school.index') }}" class="btn btn-primary">{{ __('Upload New School') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection