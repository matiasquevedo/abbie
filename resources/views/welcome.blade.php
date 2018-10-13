<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="/images/icon.ico" />
		<link href="https://portal.todopago.com.ar/app/css/boton.css" rel="stylesheet">
		<title>@yield('title')</title>

		<link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/full-width-pics.css')}}">	
		<link rel="stylesheet" href="{{ asset('plugins/bootstrap4/css/bootstrap.css')}}">
		<link rel="stylesheet" href="{{ asset('plugins/chosen/chosen.css')}}">
		<link rel="stylesheet" href="{{ asset('plugins/trumbowyg/dist/ui/trumbowyg.css')}}">
		<link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.css')}}">
		<link rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css')}}">
		
	</head>
	<body class="backHome">
		@include('nav')
		@include('flash::message')
		@yield('header')
		<section class="section-home">
			@yield('content')
			

		</section>
		<script src="{{asset('plugins/jquery/jquery.js')}}"></script>
		<script src="{{asset('plugins/bootstrap4/js/bootstrap.js')}}"></script>
		<script src="{{asset('plugins/chosen/chosen.jquery.js')}}"></script>
		<script src="{{asset('plugins/trumbowyg/dist/trumbowyg.js')}}"></script>
		<script src="{{asset('plugins/fontawesome/js/all.js')}}"></script>
		<script src="{{asset('plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>
		@yield('js')
	</body>

</html>