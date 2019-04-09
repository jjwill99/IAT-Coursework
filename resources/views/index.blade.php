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

			<h1><center>Welcome to Aston Animal Santcuary!</center></h1>

			<!-- Slideshow container -->
			<div class="slideshow-container">

				<!-- Full-width images with number and caption text -->
				<div class="mySlides fade">
			    	<img src="{{ asset('Images/dog.jpg') }}">
			    	<div class="text" id="dog">Adopt a happy dog</div>
			  	</div>

			  	<div class="mySlides fade">
			    	<img src="{{ asset('Images/snake.jpg') }}">
			    	<div class="text" id="snake">Adopt a 6 foot snake</div>
			  	</div>

			  	<div class="mySlides fade">
			    	<img src="{{ asset('Images/lizard.png') }}">
			    	<div class="text" id="lizard">Adopt a curious lizard</div>
			  	</div>

			  	<!-- Next and previous buttons -->
			  	<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
			  	<a class="next" onclick="plusSlides(1)">&#10095;</a>
			</div>
			<br>

			<!-- The dots/circles -->
			<div style="text-align:center">
				<span class="dot" onclick="currentSlide(1)"></span> 
				<span class="dot" onclick="currentSlide(2)"></span> 
				<span class="dot" onclick="currentSlide(3)"></span> 
			</div>

			<script src="{{ asset('js/slideshow.js') }}"></script>
		</div>
	</body>
</html>