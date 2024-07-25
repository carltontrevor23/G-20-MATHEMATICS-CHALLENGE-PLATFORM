@extends('layouts.app', ['activePage' => 'guest-view', 'title' => 'Guest Page', 'navName' => 'Guest View', 'activeButton' => 'laravel'])

@section('content')
<!--Guest view to be accessed by users not logged into the system-->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                           <h4 class="card-title"><b>{{__('Upcoming Challenges') }}</b></h4>
                        </div>
                        <div class="card-body table-full-width table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <td>Challenge Name</td>
                                <td>Start Date</td>
                            </thead>
                            <tbody>
                              <!--Loop for displaying upcoming challenges-->
                              @foreach($upcoming_challenges as $challenge)
                               <tr>
                                 <td>{{ $challenge->challenge_name }}</td>
                                 <td>{{ $challenge->start_date }}</td>
                               </tr>
                              @endforeach
                            </tbody>
                       </table>
                </div>
            </div>
        </div>
        <!--Metrics for registered schools, challenges and participants-->
            <div class="col-md-4">
                       <div class="card text-center custom-card bg-info text-dark" style="border-radius: 0;">
                           <div class="card-header" style="font-size: 1.2rem; font-weight: bold;">
                                {{ __('Registered Schools')  }}
                           </div>
                          <div class="card-body">
                            <h3 style="font-size:2.5rem;">{{ $schoolsCount }}</h3>
                          </div>
                       </div>
            </div>   
            <div class="col-md-4">
                       <div class="card text-center custom-card bg-info text-dark" style="border-radius: 0;">
                          <div class="card-header" style="font-size: 1.2rem; font-weight: bold;">
                                {{ __('Registered Participants')  }}
                          </div>
                          <div class="card-body">
                            <h3 style="font-size:2.5rem;">{{ $participantsCount }}</h3>
                          </div>
                       </div>
            </div>
            <div class="col-md-4">
                       <div class="card text-center custom-card bg-info text-dark" style="">
                          <div class="card-header" style="font-size: 1.2rem; font-weight: bold;">
                                {{ __('Registered Challenges')  }}
                          </div>
                          <div class="card-body">
                            <h3 style="font-size:2.5rem;">{{ $challengesCount }}</h3>
                          </div>
                       </div>
            </div>
            <div class="text-center">
                    <a href="{{ route('welcome') }}" class="btn btn-primary">{{ __('Return To Welcome Page') }}</a>
                </div>
        </div>
    </div>
@endsection