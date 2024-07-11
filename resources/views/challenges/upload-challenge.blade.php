@extends('layouts.app', ['activePage' => 'upload-challenge', 'title' => 'Upload Challenges', 'activeButton' => 'laravel'])

@section('content')

<div class="container">
    
    <h2><b>{{ $uploadNewChallenge }}</b></h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
        <label for="excel_file">Challenge Name</label>
        <input type="text" name="challengeName" class="form-control" required>
            <label for="excel_file">Choose Excel File</label>
            <input type="file" name="excel_file" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Import Excel File') }}</button>
    </form>
</div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            // Javascript method's body can be found in assets/js/demos.js
            demo.initDashboardPageCharts();

            demo.showNotification();

        });
    </script>
@endpush