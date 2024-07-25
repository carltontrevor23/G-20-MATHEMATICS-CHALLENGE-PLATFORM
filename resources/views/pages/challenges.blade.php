@extends('layouts.app', ['activePage' => 'challenges', 'title' => 'Challenges', 'navName' => 'Challenges', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header ">
                            <h4 class="card-title"><b>Challenges</b></h4>
                            <p class="card-category">Below are the challenges currently available on the website</p>
                        </div>
                        <div class="card-body table-full-width table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th>Challenge Name</th>
                                    <th>Time Allowed</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                </thead>
                                <tbody>
                                @if($challenges->isEmpty())
                                   <p>No Challenges Found</p>
                                @else
                                   @foreach($challenges as $challenge)
                                       <tr>
                                       <td>{{ $challenge->challenge_name  }}</td>
                                       <td>{{ $challenge->duration  }}</td>
                                       <td>{{ $challenge->start_date  }}</td>
                                       <td>{{ $challenge->end_date  }}</td>
                                    </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <a href="{{ route('upload.index') }}" class="btn btn-primary">{{ __('Upload New Challenges') }}</a>
                </div>
                <div class="col-md-12">
                    <div class="card card-plain table-plain-bg">
                        <div class="card-header ">
                            <h4 class="card-title"><b>Best Performing Students</b></h4>
                            <p class="card-category">These are the best 2 performing students for each challenge</p>
                        </div>
                        <div class="card-body table-full-width table-responsive">
                            @foreach ($challengeBestParticipants as $data)
                            <h5><b>{{ $data['challenge']->challenge_name}}</b></h5>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Position</th>
                                        <th>Username</th>
                                        <th>Score</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['participants'] as $participant)
                                    <tr>
                                        <td>{{ $participant->position}}</td>
                                        <td>{{ $participant->username}}</td>
                                        <td>{{ $participant->score}}</td>
                                    </tr>
                                    @endforeach
                                     </tbody>
                                  </table>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection