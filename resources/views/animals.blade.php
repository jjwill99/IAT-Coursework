@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Available animals at our sanctuary</div>

                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="GET" action="{{action('HomeController@animals')}}">
                        <div align="right">
                            <label >Filter by type:</label>
                            <select name="filter">
                                <option value="">All Types</option>
                                <option value="Dog">Dog</option>
                                <option value="Cat">Cat</option>
                                <option value="Rabbit">Rabbit</option>
                                <option value="Bird">Bird</option>
                                <option value="Reptile">Reptile</option>
                                <option value="Fish">Fish</option>
                                <option value="Amphibian">Amphibian</option>
                            </select>
                            <input type="submit" name="submit" value="Filter">
                        </div>
                    </form>

                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Name</th><th>DOB</th><th>Type</th>
                                <th>Description </th><th>Picture</th>
                                <th>Request an adoption {{$filter}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($animals as $animal)
                            <?php $requested = false; ?>
                            @if($animal->availability == "Available" && ($animal->type == $filter || $filter == ""))
                            <tr>
                                <td><a href="{{action('HomeController@showAnimal', $animal->id)}}" class="btn
                                    btn- primary">{{ $animal->name }}</a></td>
                                <td> {{$animal->dob}} </td>
                                <td> {{$animal->type}} </td>
                                <td> {{$animal->description}} </td>
                                <?php
                                    $picture = $images->where("animalId", "=", $animal->id)->first();
                                ?>
                                <td><center><img style="width:50%;height:50%" src="{{asset('storage/images/'.$picture->picture)}}"></center></td>
                                <td>
                                    @foreach($adoptions as $adoption)
                                    @if($adoption->userId == $userId && $adoption->animalId == $animal->id)
                                    Request is being processed...
                                    <?php $requested = true; ?>
                                    @endif                               
                                    @endforeach
                                    @if($requested == false)
                                    <form method="POST" class="form-horizontal" action="{{url('home')}}" enctype="multipart/form-data">
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
