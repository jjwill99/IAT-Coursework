@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <!-- Page Information -->
                <div class="panel-heading">Requested animals</div>

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
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Goes through each record in the adoptions database -->
                            @foreach($adoptions as $adoption)
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
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
