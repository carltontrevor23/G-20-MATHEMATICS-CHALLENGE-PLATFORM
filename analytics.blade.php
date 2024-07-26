@extends('layouts.app', ['activePage' => 'analytics', 'title' => 'Analytics', 'navName' => 'Analytics', 'activeButton' => 'laravel'])

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('School Rankings') }}</h4>
                        <p class="card-category">{{ __('See Who Leads the Pack') }}</p>
                    </div>
                    <div class="card-body ">
                        {{-- <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div> --}}
                        <div class="legend">
                            <table border="1" class="table table-striped table-bordered table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>School Name</th>
                                        <th>District</th>
                                        <th>Score</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rankedSchools as $index => $school)
                                    <tr>
                                        <td>{{ $index +1 }}</td> <!--Display rank-->
                                        <td>{{ $school['school_name'] }}</td><!--Display school name-->
                                        <td>{{ $school['district']}}</td><!--Display district-->
                                        <td>{{ $school['total_score']}}</td><!--Display performance score-->
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <i class="fa fa-circle text-info"></i> {{ __('Open') }}
                            <i class="fa fa-circle text-danger"></i> {{ __('Bounce') }}
                            <i class="fa fa-circle text-warning"></i> {{ __('Unsubscribe') }} --}}
                        </div>
                        <hr>
                        <div class="stats">
                            <i></i> {{ __('Ranked To Success') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">{{ __('Most Correctly Answered Questions') }}</h4>
                        <p class="card-category">{{ __('Peak Performance') }}</p>                        
                    </div>
                    <div class="card-body ">
                        {{-- <div id="chartHours" class="ct-chart"></div> --}}
                        <table class="table table-striped table-bordered table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th>Question</th>
                                    <th>Correct Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mostCorrectlyAnsweredQuestions as $question)
                                <tr>
                                    <td>{{ $question->question }}</td>
                                    <td>{{ $question->correct_count}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer ">
                        {{-- <div class="legend">
                            <i class="fa fa-circle text-info"></i> {{ __('Open') }}
                            <i class="fa fa-circle text-danger"></i> {{ __('Click') }}
                            <i class="fa fa-circle text-warning"></i> {{ __('Click Second Time') }}
                        </div> --}}
                        <hr>
                        <div class="stats">
                            <i></i> {{ __('Precision at its Best') }}
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <div class="row h-100" >
            <div class="col-md-6">
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">{{ __('Schools and Participants Performances') }}</h4>
                        <p class="card-category">{{ __('Success Visualised') }}</p>
                    </div>
                    <div class="card-body "><br>
                        <h5>Schools' Performance Over Years and Time</h5>
                        <canvas id="schoolPerformanceChart"></canvas> <br>
                        <br>
                        <h5>Participants' Performance Over Years and Time</h5>
                        <canvas id="participantPerformanceChart"></canvas>
                        
                        @push('scripts')
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                            //prepare data for school perfromance chart
                            const schoolPerformanceLabels = {!!json_encode($schoolPerformanceOverTime->pluck('year')->unique()) !!};
                            const schoolPerformanceData = {!! json_encode($schoolPerformanceOverTime->groupBy('name')->map->pluck('total_score')) !!};

                            //prepare data for participant performance chart
                            const participantPerformanceLabels = {!! json_encode($participantPerformanceOverTime->pluck('year')->unique()) !!};
                            const participantPerformanceData = {!! json_encode($participantPerformanceOverTime->groupBy('username')->map->pluck('total_score')) !!};

                            //school performance chart
                            const ctxSchool = document.getElementById('schoolPerformanceChart').getContext('2d');
                            const schoolPerformanceChart = new Chart(ctxSchool, {
                                type: 'bar',
                                data: {
                                    labels: schoolPerformanceLabels,
                                    datasets: Object.keys(schoolPerformanceData).map(school => ({
                                        label: school,
                                        data: schoolPerformanceData[school],
                                        fill: false,
                                        borderColor: 'random color',
                                        tension: 0.1
                                    }))
                                }
                            });

                             //participant performance chart
                             const ctxParticipant = document.getElementById('participantPerformanceChart').getContext('2d');
                            const participantPerformanceChart = new Chart(ctxParticipant, {
                                type: 'bar',
                                data: {
                                    labels: participantPerformanceLabels,
                                    datasets: Object.keys(participantPerformanceData).map(participant => ({
                                        label: participant,
                                        data: participantPerformanceData[participant],
                                        fill: false,
                                        borderColor: 'random color',
                                        tension: 0.1
                                    }))
                                }
                            });
                            


                        </script>
                        @endpush


                        {{-- <div id="chartActivity" class="ct-chart"></div> --}}
                    </div>
                    <div class="card-footer ">
                        <div class="legend">
                            {{-- <i class="fa fa-circle text-info"></i> {{ __('Tesla Model S') }}
                            <i class="fa fa-circle text-danger"></i> {{ __('BMW 5 Series') }} --}}
                        </div>
                        <hr>
                        <div class="stats">
                            <i></i> {{ __('Graphs Tell The Story') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 h-100">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Question Repetition Percentage for Participants') }}</h4>
                        <p class="card-category">{{ __('Repeat Metrics') }}</p>
                    </div>
                    <div class="card-body ">
                        {{-- <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div> --}}
                        <div class="legend">
                            <table border="1" class="table table-striped table-bordered table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th>Participant ID</th>
                                        <th>Username</th>
                                        <th>Repetition Percentage</th>
                                        {{-- <th>Score</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($participantRepetitions as $participant)
                                    <tr>
                                        <td>{{ $participant['participant_id'] }}</td>
                                        <td>{{ $participant['username'] }}</td>
                                        <td>{{ number_format($participant['repetition_percentage'], 2) }}%</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <i class="fa fa-circle text-info"></i> {{ __('Open') }}
                            <i class="fa fa-circle text-danger"></i> {{ __('Bounce') }}
                            <i class="fa fa-circle text-warning"></i> {{ __('Unsubscribe') }} --}}
                        </div>
                        <hr>
                        <div class="stats">
                            <i></i> {{ __('Your Path To Better Prep') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Worst Performing Schools') }}</h4>
                        <h3 class="card-title">{{ $challengeName }}</h3>
                        <p class="card-category">{{ __('Ranked to Success') }}</p>
                    </div>
                    <div class="card-body ">
                        {{-- <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div> --}}
                        <div class="legend">
                            @if (count($challengeScore) > 0)                                
                            <table border="1" class="table table-striped table-bordered table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th>School Name</th>
                                        <th>District</th>
                                        <th>Total Score</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($challengeScore as $school)
                                    <tr>
                                        <td>{{ $school->name }}</td>
                                        <td>{{ $school->district }}</td>
                                        <td>{{ $school->total_score }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <section>
                                <h4>No Data for the Selected Challenge</h4>
                                <p>No Data available for the selected challenge or no challenge specified.</p>
                            </section>
                            @endif
                        </div>
                        <hr>
                        <div class="stats">
                            <i></i> {{ __('See Who Leads the Pack') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
            <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">{{ __('Best Performing Schools for All Challenges') }}</h4>
                        <p class="card-category">{{ __('Peak Performance') }}</p>                        
                    </div>
                    <div class="card-body ">
                        {{-- <div id="chartHours" class="ct-chart"></div> --}}
                        <table class="table table-striped table-bordered table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th>Challenge</th>
                                    <th>School Name</th>
                                    <th>Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bestSchoolsForAllCha as $score)
                                <tr>
                                    <td>{{ $score->challenge_name }}</td>
                                    <td>{{ $score->school_name}}</td>
                                    <td>{{ $score->total_score}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer ">
                        {{-- <div class="legend">
                            <i class="fa fa-circle text-info"></i> {{ __('Open') }}
                            <i class="fa fa-circle text-danger"></i> {{ __('Click') }}
                            <i class="fa fa-circle text-warning"></i> {{ __('Click Second Time') }}
                        </div> --}}
                        <hr>
                        <div class="stats">
                            <i></i> {{ __('Precision at its Best') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-md-8">
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">{{ __('Participants With Incomplete Challenges') }}</h4>
                        <p class="card-category">{{ __('Every Effort Counts') }}</p>                        
                    </div>
                    <div class="card-body ">
                        {{-- <div id="chartHours" class="ct-chart"></div> --}}
                        <table class="table table-striped table-bordered table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th>Participant ID</th>
                                    <th>Username</th>
                                    <th>Challenge Name</th>
                                    <th>Questions Attempted</th>
                                    <th>Total Questions</th>
                               </tr>
                            </thead>
                            <tbody>
                                @foreach($incompleteParticipants as $participant)
                                <tr>
                                    <td>{{ $participant->id }}</td>
                                    <td>{{ $participant->username}}</td>
                                    <td>{{ $participant->challenge_name}}</td>
                                    <td>{{ $participant->questions_attempted_count}}</td>
                                    <td>{{ $participant->number_of_questions}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer ">
                        {{-- <div class="legend">
                            <i class="fa fa-circle text-info"></i> {{ __('Open') }}
                            <i class="fa fa-circle text-danger"></i> {{ __('Click') }}
                            <i class="fa fa-circle text-warning"></i> {{ __('Click Second Time') }}
                        </div> --}}
                        <hr>
                        <div class="stats">
                            <i></i> {{ __('Precision at its Best') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>




        </div>
    </div>

@endsection

@push('js')
<script type="text/javascript">
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

    });
</script>
@endpush
            
