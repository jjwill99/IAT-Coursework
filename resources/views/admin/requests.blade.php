@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
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
                                <th>Animal Name</th>
                                <th>Username </th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($adoptions as $adoption)
                            <tr>
                                <?php
                                    $animal = $animals->where("id", "=", $adoption->animalId)->first();
                                    $user = $users->where("id", "=", $adoption->userId)->first();
                                ?>
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
