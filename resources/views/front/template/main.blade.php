<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title', 'Home') | Red Social </title>
	<link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/cerulean/bootstrap.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/general.css') }}">
	<link rel="stylesheet" href="{{ asset('css/fontawesome-all.css')}}">
	<link rel="stylesheet" href="{{ asset('plugins/chosen/chosen.css') }}">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-blue.min.css">


</head>
<body>
	@include('front.template.partials.nav')
	@include('front.template.partials.errors')
	<section class="page-content">
		@include('flash::message')

		@yield('content')
	</section>

	<footer class="page-footer">
		<hr>
		Todos los derechos reservados &copy {{ date('Y')}}
		<div class="float-right">Red Social</div>
	</footer>

	<script src="{{ asset('plugins/popper/popper.js')}}"></script>
	<script src="{{ asset('plugins/jquery/js/jquery-3.3.1.js')}}"></script>
	<script src="{{ asset('plugins/bootstrap/js/bootstrap.js')}}"></script>
	<script src="{{ asset('plugins/chosen/chosen.jquery.js') }}"></script>
	<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
	@yield('js')
</body>
</html>