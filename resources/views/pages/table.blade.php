@extends('layouts.app', ['activePage' => 'table', 'title' => 'Challenges', 'navName' => 'Table List', 'activeButton' => 'laravel'])

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
                                    <th>ChallengeID</th>
                                    <th>Name</th>
                                    <th>Time Allowed</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Elementary Algebra</td>
                                        <td>10 minutes</td>
                                        <td>06-08-2024</td>
                                        <td>09-08-2024</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Advanced Algebra</td>
                                        <td>20 minutes</td>
                                        <td>11-08-2024</td>
                                        <td>14-08-2024</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Area and Volume</td>
                                        <td>15 minutes</td>
                                        <td>12-08-2024</td>
                                        <td>14-08-2024</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Division And Multiplication</td>
                                        <td>10 minutes</td>
                                        <td>18-08-2024</td>
                                        <td>20-08-2024</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Mathematical Formulae</td>
                                        <td>10 minutes</td>
                                        <td>24-08-2024</td>
                                        <td>27-08-2024</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <a href="{{ route('upload.index') }}" class="btn btn-primary">{{ __('Link for Uploading New Challenges') }}</a>
                </div>
                <div class="col-md-12">
                    <div class="card card-plain table-plain-bg">
                        <div class="card-header ">
                            <h4 class="card-title"><b>Best Performing Students</b></h4>
                            <p class="card-category">These are the best 2 performing students for each challenge</p>
                        </div>
                        <div class="card-body table-full-width table-responsive">
                            <h5><b>Challenge 1</b></h5>
                            <table class="table table-hover">
                                <thead>
                                    <th>Position</th>
                                    <th>Participant Name</th>
                                    <th>Score</th>
                                    <th>Percentage</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Alisenghaha Geoffrey</td>
                                        <td>19/20</td>
                                        <td>95%</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Denesi Mike</td>
                                        <td>18/20</td>
                                        <td>90%</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h5><b>Challenge 2</b></h5>
                            <table class="table table-hover">
                                <thead>
                                    <th>Position</th>
                                    <th>Participant Name</th>
                                    <th>Score</th>
                                    <th>Percentage</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Sala Denise</td>
                                        <td>11/15</td>
                                        <td>72%</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Marafiki Shanice</td>
                                        <td>10/15</td>
                                        <td>68%</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h5><b>Challenge 3</b></h5>
                            <table class="table table-hover">
                                <thead>
                                    <th>Position</th>
                                    <th>Participant Name</th>
                                    <th>Score</th>
                                    <th>Percentage</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Dakota Johnson</td>
                                        <td>9/10</td>
                                        <td>90%</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Lucerys Targaryen</td>
                                        <td>9/10</td>
                                        <td>90%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection