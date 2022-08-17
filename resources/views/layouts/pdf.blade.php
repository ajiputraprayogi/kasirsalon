<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('assets/template/backend/img/icon.ico')}}" type="image/x-icon"/>
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
    <link rel="stylesheet" href="{{asset('assets/template/backend/css/bootstrap.min.css')}}">   
	<link rel="stylesheet" href="{{asset('assets/template/backend/css/azzara.min.css')}}">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{asset('assets/template/backend/css/demo.css')}}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('nota/pdf.css') }}" rel="stylesheet">
</head>
@yield('style')
<body>
    <div class="container">
        @yield('content')
    </div>
    @yield('customjs')
</body>
<script type="text/javascript">
    // window.onafterprint = window.close;
    window.print();
</script>
</html>
