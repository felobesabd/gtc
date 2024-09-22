<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
		<title>@yield('title', 'dashboard')</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Dashboard" />
		<meta property="og:site_name" content="Dashboard" />
		<link rel="shortcut icon" href="{{url('design/admin')}}/assets/media/logos/favicon.ico" />
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Vendor Stylesheets(used for this page only)-->
		<link href="{{url('design/admin')}}/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="{{url('design/admin')}}/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="{{url('design/admin')}}/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<link href="{{url('design/admin')}}/assets/css/custom.css" rel="stylesheet" type="text/css" />
		<link href="{{url('design/admin')}}/assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
        <link rel = "stylesheet" type = "text/css" href = "https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" />
		<!--end::Global Stylesheets Bundle-->
		@stack('header')
	</head>
	<!--end::Head-->
