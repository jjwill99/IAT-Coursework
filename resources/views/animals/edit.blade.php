@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 ">
			<div class="card">
				<div class="card-header">Edit and update the animal</div>
				@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div><br />
				@endif
				@if (\Session::has('success'))
				<div class="alert alert-success">
					<p>{{ \Session::get('success') }}</p>
				</div><br />
				@endif
				<div class="card-body">
					<form class="form-horizontal" method="POST" action="{{ action('AnimalController@update',
					$animal['id']) }} " enctype="multipart/form-data" >
					<!-- @method('PATCH') -->
					{!! method_field('patch') !!}
					<!-- @csrf -->
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="col-md-8">
						<label >Name</label>
						<input type="text" name="name" value="{{$animal->name}}"/>
					</div>
					<div class="col-md-8">
						<label>Date Of Birth</label>
						<input type="date" name="dob" value="{{$animal->dob}}" />
					</div>
					<div class="col-md-8">
						<label>Animal Type</label>
						<select name="type">
							<option value="Dog">Dog</option>
							<option value="Cat">Cat</option>
							<option value="Rabbit">Rabbit</option>
							<option value="Bird">Bird</option>
							<option value="Reptile">Reptile</option>
							<option value="Fish">Fish</option>
							<option value="Amphibian">Amphibian</option>
						</select>
					</div>
					<div class="col-md-8">
						<label >Description</label>
						<input type="text" name="description" value="{{$animal->description}}" />
					</div>
					<div class="col-md-8">
						<label >Availability</label>
						<select name="availability">
							<option value="Available">Available</option>
							<option value="Unavailable">Unavailable</option>
						</select>
					</div>
					<div class="col-md-8">
						<label>Add Picture</label>
						<input type="file" name="picture" />
					</div>
					<div class="col-md-6 col-md-offset-4">
						<input type="submit" class="btn btn-primary" />
						<input type="reset" class="btn btn-primary" />
					</a>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
</div>
@endsection