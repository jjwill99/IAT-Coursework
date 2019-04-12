@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 ">
			<div class="card">
				<div class="card-header">Display Adopter</div>
				<div class="card-body">
					<table class="table table-striped" border="1" >
						<tr> <td> <b>Username </th> <td> {{$user->username}}</td></tr>
							<tr> <th>First Name </th> <td>{{$user->firstname}}</td></tr>
							<tr> <th>Last Name </th> <td>{{$user->lastname}}</td></tr>
							<tr> <td>E-mail </th> <td>{{$user->email}}</td></tr>
							<tr> <td>Address </th> <td>{{$user->address}}, {{$user->postcode}}</td></tr>
							</table>
							<table><tr>
								<td><a href="/animal" class="btn btn-primary" role="button">Back to the list</a></td>
								</tr></table>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endsection