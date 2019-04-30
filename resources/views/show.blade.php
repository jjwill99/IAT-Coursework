@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 ">
			<div class="card">
				<div class="card-header">Additional Information</div>
				<div class="card-body">
					<table class="table table-striped" border="1" >
						<tr> <td> <b>Name </th> <td> {{$animal->name}}</td></tr>
							<tr> <th>DOB </th> <td>{{$animal->dob}}</td></tr>
							<tr> <th>Type </th> <td>{{$animal->type}}</td></tr>
							<tr> <th>Description </th> <td>{{$animal->description}}</td></tr>
							<tr> <td>Availability </th> <td>{{$animal->availability}}</td></tr>
							@foreach($pictures as $picture)
							<tr> <td colspan='2' ><center><img style="width:50%;height:50%"
								src="{{ asset('storage/images/'.$picture->picture)}}"></center></td></tr>
							@endforeach
							</table>
							<table><tr>
								<td><a href="{{ route('adopt') }}" class="btn btn-primary" role="button">Back to the list</a></td>
								</tr></table>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endsection