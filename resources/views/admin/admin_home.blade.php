@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Admin Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Welcome to the admin page!
                    <br> <br>
                    <a href="{{ route('animal') }}" class="btn btn-primary">Display Animals</a>
                    <br> <br>
                    <a href="{{ route('review') }}" class="btn btn-primary">Display Pending Requests</a>
                    <br> <br>
                    <a href="{{ route('reviewAll') }}" class="btn btn-primary">Display All Requests</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
