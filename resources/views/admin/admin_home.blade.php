@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <!-- Page Information -->
                <div class="panel-heading">Admin Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-- Welcome Message -->
                    Welcome to the admin page!
                    <br> <br>
                    <!-- Button to take user to a view of all the animals in the database -->
                    <a href="{{ route('animal') }}" class="btn btn-primary">Display Animals</a>
                    <br> <br>
                    <!-- Button to take user to a view showing all the pending adoption requests -->
                    <a href="{{ route('review') }}" class="btn btn-primary">Display Pending Requests</a>
                    <br> <br>
                    <!-- Button to take user to a view showing all the requests made for animals in the database,
                        and whether they were accepted or rejected (or still pending) -->
                    <a href="{{ route('reviewAll') }}" class="btn btn-primary">Display All Requests</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
