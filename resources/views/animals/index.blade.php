@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Display all animals</div>
				<div class="panel-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Name</th>
								<th>DOB</th>
								<th>Type</th>
								<th>Description</th>
								<th>Availability</th>
								<th>Adopted by:</th>
								<th colspan="3">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($animals as $animal)
							<tr>
								<td>{{$animal->name}}</td>
								<td>{{$animal->dob}}</td>
								<td>{{$animal->type}}</td>
								<td>{{$animal->description}}</td>
								<td>{{$animal->availability}}</td>

								<?php 
								$username ="";
								$adoption = $adoptions->where('animalId', '=', $animal->id)->where('status', '=', 'Accepted')->first();
								if ($adoption != null) {
									$userId = $adoption->userId;
									$user = $users->where('id', '=', $userId)->first();
									$username = $user->username;
								}
								?>

								@if($username != "")
								<td><a href="{{action('UserController@show', $user->id)}}" class="btn
									btn- primary">{{ $username }}</a></td>
									@else
									<td>No owner</td>
									@endif

									<td><a href="{{action('AnimalController@show', $animal['id'])}}" class="btn
										btn- primary">Details</a></td>
										<td><a href="{{action('AnimalController@edit', $animal['id'])}}" class="btn
											btn- warning">Edit</a></td>
											<td>
												<form action="{{action('AnimalController@destroy', $animal['id'])}}"
												method="post">
												<!-- @csrf -->
												<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<input name="_method" type="hidden" value="DELETE">
												<button class="btn btn-danger" type="submit"> Delete</button>
											</form>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							<a href="{{action('AnimalController@create')}}" class="btn btn-primary">Add Animal</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endsection