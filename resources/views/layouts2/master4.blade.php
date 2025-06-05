<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<!-- Meta data -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="Shanana Beauty and Bedroom Products" name="description">
		<meta content="Spruko Technologies Private Limited" name="author">
		<meta name="keywords" content="Admin, Admin Template, Dashboard, Responsive, Admin Dashboard, Bootstrap, Bootstrap 4, Clean, Backend, Jquery, Modern, Web App, Admin Panel, Ui, Premium Admin Templates, Flat, Admin Theme, Ui Kit, Bootstrap Admin, Responsive Admin, Application, Template, Admin Themes, Dashboard Template"/>
		@include('layouts2.head')
	</head>

	<body class="light-mode">
		<!---Global-loader-->
		<div id="global-loader" >
			<img src="{{URL::asset('assets2/images/svgs/loader.svg')}}" alt="loader">
		</div>

		<div class="page">
			<div class="page-main">
				@include('layouts2.header')
				@include('layouts2.horizontal-menu')                				
				<div class="app-content page-body">
					<div class="container">
						@yield('page-header')
						@yield('content')
            			@include('layouts2.footer')
		</div><!-- End Page -->
			@include('layouts2.footer-scripts1')	
	</body>
</html>