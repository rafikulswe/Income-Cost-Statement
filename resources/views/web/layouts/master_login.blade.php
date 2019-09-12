<!doctype html>
<html class="fixed" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>{{ config('app.name', 'MYBANK') }}</title>
		<link rel="icon" type="image/png" href="{{asset('public/contents/img/admin-favicon.png')}}">
		<!-- CSRF Token -->
	    <meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="keywords" content="Income-Cost Statement" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

		<meta name="description" content="Income-Cost Statement - Keep Record of Your Earning and Expense.">
		<meta name="author" content="okler.net">
		<meta name="author" content="JSOFT.net">

		{{-- og Property --}}
		<meta property="og:title" content="Income-Cost Statement">
		<meta property="og:description" content="Keep Record of Your Earning and Expense.">
		<meta property="og:image" content="{{asset('public/authContents/images/mybanklogo.png')}}">
		<meta property="og:url" content="https://amaruparjon.com/">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{ asset('public/authContents/vendor/bootstrap/css/bootstrap.css') }}" />
		<link rel="stylesheet" href="{{ asset('public/authContents/vendor/font-awesome/css/font-awesome.css') }}" />
		<link rel="stylesheet" href="{{ asset('public/authContents/vendor/magnific-popup/magnific-popup.css') }}" />
		<link rel="stylesheet" href="{{ asset('public/authContents/vendor/bootstrap-datepicker/css/datepicker3.css') }}" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{ asset('public/authContents/stylesheets/theme.css') }}" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="{{ asset('public/authContents/stylesheets/skins/default.css') }}" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{ asset('public/authContents/stylesheets/theme-custom.css') }}">

		<!-- Head Libs -->
		<script src="{{ asset('public/authContents/vendor/modernizr/modernizr.js') }}"></script>

	</head>
	<body>
		@yield('content')


		<!-- Vendor -->
		<script src="{{ asset('public/authContents/vendor/jquery/jquery.js') }}"></script>
		<script src="{{ asset('public/authContents/vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
		<script src="{{ asset('public/authContents/vendor/bootstrap/js/bootstrap.js') }}"></script>
		<script src="{{ asset('public/authContents/vendor/nanoscroller/nanoscroller.js') }}"></script>
		<script src="{{ asset('public/authContents/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
		<script src="{{ asset('public/authContents/vendor/magnific-popup/magnific-popup.js') }}"></script>
		<script src="{{ asset('public/authContents/vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>
		
		<!-- Specific Page Vendor -->
		<script src="{{ asset('public/authContents/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js') }}"></script>
		<script src="{{ asset('public/authContents/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js') }}"></script>
		<script src="{{ asset('public/authContents/vendor/jquery-appear/jquery.appear.js') }}"></script>
		<script src="{{ asset('public/authContents/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
		<script src="{{ asset('public/authContents/vendor/jquery-easypiechart/jquery.easypiechart.js') }}"></script>
		<script src="{{ asset('public/authContents/vendor/flot/jquery.flot.js') }}"></script>
		<script src="{{ asset('public/authContents/vendor/flot-tooltip/jquery.flot.tooltip.js') }}"></script>
		<script src="{{ asset('public/authContents/vendor/flot/jquery.flot.pie.js') }}"></script>
		<script src="{{ asset('public/authContents/vendor/flot/jquery.flot.categories.js') }}"></script>
		<script src="{{ asset('public/authContents/vendor/flot/jquery.flot.resize.js') }}"></script>
		<script src="{{ asset('public/authContents/vendor/jquery-sparkline/jquery.sparkline.js') }}"></script>
		<script src="{{ asset('public/authContents/vendor/raphael/raphael.js') }}"></script>
		<script src="{{ asset('public/authContents/vendor/morris/morris.js') }}"></script>
		<script src="{{ asset('public/authContents/vendor/gauge/gauge.js') }}"></script>
		<script src="{{ asset('public/authContents/vendor/snap-svg/snap.svg.js') }}"></script>
		<script src="{{ asset('public/authContents/vendor/liquid-meter/liquid.meter.js') }}"></script>
		<script src="{{ asset('public/authContents/vendor/jqvmap/jquery.vmap.js') }}"></script>
		<script src="{{ asset('public/authContents/vendor/jqvmap/data/jquery.vmap.sampledata.js') }}"></script>
		<script src="{{ asset('public/authContents/vendor/jqvmap/maps/jquery.vmap.world.js') }}"></script>
		<script src="{{ asset('public/authContents/vendor/jqvmap/maps/continents/jquery.vmap.africa.js') }}"></script>
		<script src="{{ asset('public/authContents/vendor/jqvmap/maps/continents/jquery.vmap.asia.js') }}"></script>
		<script src="{{ asset('public/authContents/vendor/jqvmap/maps/continents/jquery.vmap.australia.js') }}"></script>
		<script src="{{ asset('public/authContents/vendor/jqvmap/maps/continents/jquery.vmap.europe.js') }}"></script>
		<script src="{{ asset('public/authContents/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js') }}"></script>
		<script src="{{ asset('public/authContents/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js') }}"></script>

		<!-- Theme Base, Components and Settings -->
		<script src="{{ asset('public/authContents/javascripts/theme.js') }}"></script>
		
		<!-- Theme Custom -->
		<script src="{{ asset('public/authContents/javascripts/theme.custom.js') }}"></script>
		
		<!-- Theme Initialization Files -->
		<script src="{{ asset('public/authContents/javascripts/theme.init.js') }}"></script>

		<!-- Examples -->
		<script src="{{ asset('public/authContents/javascripts/dashboard/examples.dashboard.js') }}"></script>

	</body>
</html>