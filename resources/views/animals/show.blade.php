@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 ">
			<div class="card">
				<div class="card-header">Display all animals</div>
				<div class="card-body">
					<table class="table table-striped" border="1" >
						<tr> <td> <b>Name </th> <td> {{$animal->name}}</td></tr>
							<tr> <th>DOB </th> <td>{{$animal->dob}}</td></tr>
							<tr> <th>Description </th> <td>{{$animal->description}}</td></tr>
							<tr> <td>Availability </th> <td>{{$animal->availability}}</td></tr>
							<tr> <td>Picture </th> <td>{{$animal->picture}}</td></tr>
							<tr> <td colspan='2' ><img style="width:100%;height:100%"
								src="{{ asset('storage/images/'.$animal->picture)}}"></td></tr>
							</table>
							<table><tr>
								<td><a href="/animals" class="btn btn-primary" role="button">Back to the list</a></td>
								<td><a href="{{action('AnimalController@edit', $animal['id'])}}" class="btn
									btn- warning">Edit</a></td>
									<td><form action="{{action('AnimalController@destroy', $animal['id'])}}"
										method="post">
										<!-- @csrf -->
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input name="_method" type="hidden" value="DELETE">
										<button class="btn btn-danger" type="submit">Delete</button>
									</form></td>
								</tr></table>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endsection