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

                    Requested animals:

                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description </th><th>Picture</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($adoptions as $adoption)
                            @if($adoption->userId == $userId)
                            <tr>
                                <td> {{$animals[$adoption->animalId - 1]->name}} </td>
                                <td> {{$animals[$adoption->animalId - 1]->description}} </td>
                                <td><center><img style="width:50%;height:50%" src="{{asset('storage/images/'.$animals[$adoption->animalId - 1]->picture)}}"></center></td>
                                <td> {{$adoption->status}} </td>
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
