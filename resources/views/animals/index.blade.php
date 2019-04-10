@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 ">
			<div class="card">
				<div class="card-header">Display all vehicles</div>
				<div class="card-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Name</th>
								<th>DOB</th>
								<th>Description</th>
								<th>Availability</th>
								<th>Picture</th>
								<th colspan="3">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($animals as $animal)
							<tr>
								<td>{{$animal['name']}}</td>
								<td>{{$animal['dob']}}</td>
								<td>{{$animal['description']}}</td>
								<td>{{$animal['availability']}}</td>
								<td>{{$animal['picture']}}</td>
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
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection