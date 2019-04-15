@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Pending adoption requests</div>

                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Animal Name</th>
                                <th>Username </th>
                                <th>Status</th>
                                <th>Change Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($adoptions as $adoption)
                            @if($adoption->status == "Pending")
                            <tr>
                                <?php
                                    $animal = $animals->where("id", "=", $adoption->animalId)->first();
                                    $user = $users->where("id", "=", $adoption->userId)->first();
                                ?>
                                <td> {{$animal->name}} </td>
                                <td> {{$user->username}} </td>
                                <td> {{$adoption->status}} </td>
                                <td>
                                    <form method="POST" class="form-horizontal" action="{{ action('ReviewController@update',
                                    $adoption->id) }}" enctype="multipart/form-data">
                                        {!! method_field('patch') !!}
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <select name="status">
                                            <option value="pending">Pending</option>
                                            <option value="accepted">Accepted</option>
                                            <option value="rejected">Rejected</option>
                                        </select>
                                        <input type="submit" class="btn btn-primary" value="Submit" />
                                    </form>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
