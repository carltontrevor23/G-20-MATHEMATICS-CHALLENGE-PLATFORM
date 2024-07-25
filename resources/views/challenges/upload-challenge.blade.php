@extends('layouts.app', ['activePage' => 'upload-challenge', 'title' => 'Upload Challenges', 'navName'=> 'Challenge Upload', 'activeButton' => 'laravel'])

@section('content')

<div class="container">
    
    <h2><b>{{ __('Upload New Challenge') }}</b></h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li> {{  $error  }}</li>
            @endforeach
        </ul>
    </div>
    @endif

<div class="container">
    <!--Form for uploading Challenge parameters-->
    <form method="POST" enctype="multipart/form-data" action="{{ route('challenge.store') }}">
        @csrf
        <div class="form-group">
            <h4>Challenge Details</h4>
          <label for="challenge_name">Challenge Name</label>
          <input type="text" name="challenge_name" class="form-control" required>
          <label for="start_date">Challenge Start Date</label>
          <input type="date" name="start_date" class="form-control" required>
          <label for="end_date">Challenge End Date</label>
          <input type="date" name="end_date" class="form-control" required>
          <label for="duration">Challenge Duration</label>
          <input type="text" name="duration" class="form-control" required>
          <label for="number_of_questions">Number of Questions to be Displayed</label>
          <input type="number" name="number_of_questions" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Create Challenge') }}</button>
    </form>

    <!--Form for uploading Excel files for challenges-->
    <form method="POST" enctype="multipart/form-data" action="{{ route('questions.upload') }}">
        @csrf
        <div class="form-group">
        <h4>Challenge Files</h4>
          <label for="question_file">Select Question File</label>
          <input type="file" name="question_file" id="question_file" class="form-control" required accept=".xlsx, .xls">
          <label for="answer_file">Select Answer File</label>
          <input type="file" name="answer_file" id="amswers_file" class="form-control" required accept=".xlsx, .xls">
        <button type="submit" class="btn btn-primary">{{ __('Upload Challenge Files') }}</button>
    </form>
</div>
@endsection
