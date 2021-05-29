<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{env('APP_NAME')}} @yield('judul')</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{asset('lte3/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('lte3/dist/css/adminlte.min.css')}}">
	@yield("css")
</head>
<body class="hold-transition sidebar-mini">
	<div class="wrapper"> 
		@include("template.nav")
		@include("template.sidebar")
  		<div class="content-wrapper">
    
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0">@yield('judul')</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active">@yield('judul')</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
			<div class="content">
				<div class="container-fluid">@yield('content')</div>
			</div>
  		</div>
  

  @include("modals.modal")
  <aside class="control-sidebar control-sidebar-dark">
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <footer class="main-footer">
        <div class="float-right d-none d-sm-inline">
            {{ env('APP_NAME',"Kostanku") }}
        </div>
        <strong>Copyright &copy; 2021 <a href="{{route('home')}}">{{env('APP_NAME')}}</a>.</strong> All rights reserved.
    </footer>
</div>
		<script src="{{asset('aset/bower_components/moment/moment.js')}}"></script>
        <script src="{{ asset('lte3/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('lte3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('lte3/dist/js/adminlte.min.js') }}"></script>
		<script src="{{asset('js/app.js')}}"></script>
		<script>
			$(document).ready(()=>{
				window.logot = ()=>{
					$("#logout-form").submit();
				}
				setInterval(() => {
					$("#auth").html(`@csrf`)
				}, 1);
			});
		</script>    
		@yield("jscript")    
    </body>
</html>
