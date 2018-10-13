<html>
	<head>
		<meta>
		<link rel="shortcut icon" href="/images/icon.ico" />
		<title>@yield('title')</title>

		<link rel="stylesheet" href="{{ asset('plugins/bootstrap4/css/bootstrap.css')}}">	
		<link rel="stylesheet" href="{{ asset('plugins/chosen/chosen.css')}}">
		<link rel="stylesheet" href="{{ asset('plugins/trumbowyg/dist/ui/trumbowyg.css')}}">
		<link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.css')}}">
		<meta name="csrf-token" content="{{ csrf_token() }}">
	</head>
	<body>
		
		@include('admin.template.partials.nav')
		<br>
		@include('flash::message')
		<section>
			@yield('content')
			

		</section>
		<script src="{{asset('plugins/jquery/jquery.js')}}"></script>
		<script src="{{asset('plugins/bootstrap4/js/bootstrap.js')}}"></script>
		<script src="{{asset('plugins/chosen/chosen.jquery.js')}}"></script>
		<script src="{{asset('plugins/trumbowyg/dist/trumbowyg.js')}}"></script>
		<script src="{{asset('plugins/fontawesome/js/all.js')}}"></script>
		@yield('js')
	</body>

</html>