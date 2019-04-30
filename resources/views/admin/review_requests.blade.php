@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <!-- Page Information -->
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
                                <!-- Column Titles -->
                                <th>Animal Name</th>
                                <th>Username </th>
                                <th>Status</th>
                                <th>Change Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Goes through each record in the adoptions database -->
                            @foreach($adoptions as $adoption)
                            <!-- Runs the below code if the status of $adoption is "Pending" -->
                            @if($adoption->status == "Pending")
                            <tr>
                                <!-- Gets the specific animal and user related to $adoption -->
                                <?php
                                    $animal = $animals->where("id", "=", $adoption->animalId)->first();
                                    $user = $users->where("id", "=", $adoption->userId)->first();
                                ?>
                                <!-- Fills the rows with the corresponding information -->
                                <td> {{$animal->name}} </td>
                                <td> {{$user->username}} </td>
                                <td> {{$adoption->status}} </td>
                                <td>
                                    <!-- A form to allow the user to set the status of the request -->
                                    <form method="POST" class="form-horizontal" action="{{ action('ReviewController@update',
                                    $adoption->id) }}" enctype="multipart/form-data">
                                        {!! method_field('patch') !!}
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <select name="status">
                                            <option value="Pending">Pending</option>
                                            <option value="Accepted">Accepted</option>
                                            <option value="Rejected">Rejected</option>
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
