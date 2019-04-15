<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{config('app.name')}}</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/navbar.css') }}"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/index.css') }}"/>

</head>
<body>

	@include('layouts.app')

	<div class="main">

		<h1><center>Welcome to Aston Animal Sanctuary!</center></h1>

		<div class="picture">
			<center>
				<img class="picture" src="{{ asset('Images/catAndDog.jpg') }}" />
			</center>
		</div>

		<br>

		<div class="message">
			<center>Here at Aston Animal Sanctuary, we aim to give our animals the second chance they deserve for a better quality of life.
			<br><br>
			Apply NOW to adopt the animal that calls you!</center>
		</div>

	</div>
</body>
</html>