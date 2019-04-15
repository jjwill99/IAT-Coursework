@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    Welcome {{$username}}!
                    <br> <br>
                    <a href="{{ route('adopt') }}" class="btn btn-primary">Available Animals</a>
                    <br> <br>
                    <a href="{{ route('requests') }}" class="btn btn-primary">Display Your Requests</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
