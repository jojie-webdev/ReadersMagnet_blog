<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
	<!-- assets laravel command -->
    <!-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet"> -->

	<!-- direct assets -->
	<link href="{{ url('/public/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ url('/public/css/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ url('/public/css/datepicker3.css') }}" rel="stylesheet">
	<link href="{{ url('/public/css/styles.css') }}" rel="stylesheet">
	<link href="{{ url('/public/css/styles.css') }}" rel="stylesheet">

	<!-- Datatables -->
	<link href="https://datatables.yajrabox.com/css/datatables.bootstrap.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
</head>
<body>
	
		<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span></button>
					<a class="navbar-brand" href="#"><span>Lumino</span>Admin</a>
				</div>
			</div>
		</nav>
		<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
			<div class="profile-sidebar">
				<div class="profile-userpic">
					<img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
				</div>
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">Username</div>
					<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="divider"></div>
			<form role="search">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Search">
				</div>
			</form>
			<ul class="nav menu">
				<li><a href="{{ route('home') }}"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
				<!-- Authentication Links -->
				@guest
					<li class="nav-item">
						<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
					</li>
					@if (Route::has('register'))
						<li class="nav-item">
							<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
						</li>
					@endif
				@else
                    <li>
                        <a  href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"
                        >
                            <em class="fa fa-power-off">&nbsp;</em> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
				@endguest
			</ul>
		</div><!--/.sidebar-->
			
		<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
			@include('layouts.errors')
			@yield('content')
		</div><!--/.main-->
		@yield('footer')
	
		<script src="https://datatables.yajrabox.com/js/jquery.min.js"></script>
		<script src="https://datatables.yajrabox.com/js/bootstrap.min.js"></script>
		<script src="https://datatables.yajrabox.com/js/jquery.dataTables.min.js"></script>
		<script src="https://datatables.yajrabox.com/js/datatables.bootstrap.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
		<script src="{{asset('js/app.js')}}"></script>
	
</body>
</html>
