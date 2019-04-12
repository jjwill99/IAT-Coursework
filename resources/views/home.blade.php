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

                    Available animals:

                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Name</th><th>DOB</th>
                                <th>Description </th><th>Picture</th>
                                <th>Request an adoption</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($animals as $animal)
                            <?php $requested = false; ?>
                            @if($animal->availability == "Available")
                            <tr>
                                <td> {{$animal->name}} </td>
                                <td> {{$animal->dob}} </td>
                                <td> {{$animal->description}} </td>
                                <td><center><img style="width:50%;height:50%" src="{{asset('storage/images/'.$animal->picture)}}"></center></td>
                                <td>
                                @foreach($adoptions as $adoption)
                                @if($adoption->userId == $userId && $adoption->animalId == $animal->id)
                                Request is being processed...
                                <?php $requested = true; ?>
                                @endif                               
                                @endforeach
                                @if($requested == false)
                                <form method="POST" class="form-horizontal" action="{{url('adoptions')}}" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="userId" value="{{ $userId }}" />
                                    <input type="hidden" name="animalId" value="{{ $animal->id }}" />
                                    <input type="submit" class="btn btn-primary" value="Adopt this animal" />
                                </form>
                                @endif
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
