<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ReadersMagnet Authors' Lounge </title>
	<!-- assets laravel command -->
	<link rel="icon" type="image/png" href="http://www.elink.com.ph/wp-content/uploads/2016/01/elink-logo-site.png">
    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('public/images/sort_both.png') }}" rel="stylesheet">
    <link href="{{ asset('public/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/styles.css') }}" rel="stylesheet">

	<!-- direct assets -->
	<!-- <link href="{{ url('/public/css/bootstrap.min.css') }}" rel="stylesheet"> -->
	<!-- <link href="{{ asset('/public/css/font-awesome.min.css') }}" rel="stylesheet"> -->
	<!-- <link href="{{ url('/public/css/datepicker3.css') }}" rel="stylesheet"> -->
	<link href="{{ asset('public/css/jquery.dataTables.css')}}" rel="stylesheet" type="text/css">
	<!-- <link href="{{ asset('/public/css/styles.css') }}" rel="stylesheet"> -->
	
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"  type="text/css">

	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>

    <!-- Styles -->
	<!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
	<style>
		a {
			color: #4b4e50!important;
			text-decoration: none!important;
		}
		.modal-backdrop {
			position: fixed;
			top: 0;
			right: 0;
			bottom: 0;
			left: 0;
			z-index: 1040;
			background-color: #0000;
		}
	</style>
</head>
<body>
	
		<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span></button>
					<a class="navbar-brand" style="color: #fff!important;" href="#"><span>ReadersMagnet</span>Authors' Lounge</a>
				</div>
			</div>
		</nav>
		<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
			<div class="profile-sidebar">
				<div class="profile-userpic">
				
				@if (File::exists(public_path("assets/uploads/".Auth::user()->filename)))
					<img src="{{ asset('public/uploads/'.Auth::user()->filename)  }}" class="img-circle master" alt="User Image">
				@else 
					<img src="{{ asset('public/uploads/Dummy-image.jpg')}}">
				@endif
				</div>
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">{{{ isset(Auth::user()->username) ? Auth::user()->username : Auth::user()->email }}}</div>
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
				<li><a href="{{ url('posts/guide') }}"><em class="fa fa-circle-o">&nbsp;</em> Guidelines</a></li>
				<li><a href="{{ url('users/{user}/edit') }}"><em class="fa fa-user">&nbsp;</em> Profile</a></li>
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

		<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script src="{{asset('public/js/app.js')}}"></script>
	
</body>
</html>
