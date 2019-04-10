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
						<label >Animal Name</label>
						<input type="text" name="name" value="{{$animal->name}}"/>
					</div>
					<div class="col-md-8">
						<label>Animal DOB</label>
						<input type="date" name="dob" />
					</div>
					<div class="col-md-8">
						<label >Animal Description</label>
						<input type="text" name="description" value="{{$animal->description}}" />
					</div>
					<div class="col-md-8">
						<label >Animal Availability</label>
						<input type="text" name="availability" value="{{$animal->availability}}" />
					</div>
					<div class="col-md-8">
						<label>Animal Picture</label>
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