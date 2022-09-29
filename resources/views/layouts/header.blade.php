<!DOCTYPE html>
<html lang="en">

<head>
	<title>{{ config('app.name', 'Laravel') }}</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<link href="{{asset('theme/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet"
		type="text/css" />
	<link href="{{asset('theme/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('theme/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('theme/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('css/custom.css')}}" rel="stylesheet" type="text/css" />
	@yield('pagespecificstyles')
	<!-- Fonts -->
	{{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
	<!-- Styles -->
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
	<link href="{{ asset('vendor/laravel_backup_panel/app.css') }}" rel="stylesheet">
	@livewireStyles
	<script>
		var config = {
                data: {
                    csrf:"{{csrf_token()}}",
                    base_url:"{{  url('') }}"
                }
            };
	</script>
</head>

<body id="kt_body"
	class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed"
	style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">