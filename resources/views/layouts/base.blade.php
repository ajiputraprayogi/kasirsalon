<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
    @yield('token')
    @php
    $websetting = DB::table('settings')->orderby('id','desc')->limit(1)->get();
    @endphp
    @foreach($websetting as $row_websetting)
    <title>{{$row_websetting->singkatan_nama_program}} | @yield('title')</title>
    @endforeach
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{asset('assets/template/backend/img/icon.ico')}}" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="{{asset('assets/template/backend/js/plugin/webfont/webfont.min.js')}}"></script>
	<script>
		WebFont.load({
			google: {"families":["Open+Sans:300,400,600,700"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ["{{asset('assets/template/backend/css/fonts.css')}}"]},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{asset('assets/template/backend/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/template/backend/css/azzara.min.css')}}">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{asset('assets/template/backend/css/demo.css')}}">
    @yield('customcss')
</head>
<body>
	<div class="wrapper">
        <div class="main-header" data-background-color="purple">
            <div class="logo-header">
				<a href="{{url('backend/home')}}" class="logo">
					<img src="{{asset('assets/template/backend/img/logoazzara.svg')}}" alt="navbar brand" class="navbar-brand">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="fa fa-bars"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
				<div class="navbar-minimize">
					<button class="btn btn-minimize btn-rounded">
						<i class="fa fa-bars"></i>
					</button>
				</div>
			</div>
            <nav class="navbar navbar-header navbar-expand-lg">
                @include('layouts.navbar')
            </nav>
        </div>
        <div class="sidebar">
			@include('layouts.sidebar')
		</div>
		@yield('content')
	</div>
</div>
<!--   Core JS Files   -->
<script src="{{asset('assets/template/backend/js/core/jquery.3.2.1.min.js')}}"></script>
<script src="{{asset('assets/template/backend/js/core/popper.min.js')}}"></script>
<script src="{{asset('assets/template/backend/js/core/bootstrap.min.js')}}"></script>

<!-- jQuery UI -->
<script src="{{asset('assets/template/backend/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/template/backend/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>

<!-- jQuery Scrollbar -->
<script src="{{asset('assets/template/backend/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>

<!-- Moment JS -->
<script src="{{asset('assets/template/backend/js/plugin/moment/moment.min.js')}}"></script>

<!-- Chart JS -->
<script src="{{asset('assets/template/backend/js/plugin/chart.js/chart.min.js')}}"></script>

<!-- jQuery Sparkline -->
<script src="{{asset('assets/template/backend/js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>

<!-- Chart Circle -->
<script src="{{asset('assets/template/backend/js/plugin/chart-circle/circles.min.js')}}"></script>

<!-- Datatables -->
<script src="{{asset('assets/template/backend/js/plugin/datatables/datatables.min.js')}}"></script>

<!-- Bootstrap Notify -->
<script src="{{asset('assets/template/backend/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

<!-- Bootstrap Toggle -->
<script src="{{asset('assets/template/backend/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js')}}"></script>

<!-- jQuery Vector Maps -->
<script src="{{asset('assets/template/backend/js/plugin/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('assets/template/backend/js/plugin/jqvmap/maps/jquery.vmap.world.js')}}"></script>

<!-- Google Maps Plugin -->
<script src="{{asset('assets/template/backend/js/plugin/gmaps/gmaps.js')}}"></script>

<!-- Sweet Alert -->
<script src="{{asset('assets/template/backend/js/plugin/sweetalert/sweetalert.min.js')}}"></script>

<!-- Azzara JS -->
<script src="{{asset('assets/template/backend/js/ready.min.js')}}"></script>

<!-- Azzara DEMO methods, don't include it in your project! -->
<script src="{{asset('assets/template/backend/js/setting-demo.js')}}"></script>
<script src="{{asset('assets/template/backend/js/demo.js')}}"></script>
@yield('customjs')
</body>
</html>