<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{csrf_token()}}">
	<title>SỨC MUA VIỆT</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	{!!Html::style('theme/bootstrap/css/bootstrap.min.css')!!}
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
	{!!Html::style('theme/dist/css/AdminLTE.min.css')!!}
	{!!Html::style('js/validate/screen.css')!!}
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  folder instead of downloading all of them to reduce the load. -->
  {!!Html::style('theme/dist/css/skins/_all-skins.min.css')!!}
  <!-- jQuery 2.2.3 -->
  {{-- {!!Html::script('theme/plugins/jQuery/jquery-2.2.3.min.js')!!} --}}
  {!!Html::script('theme/plugins/jQuery/jquery-3.2.1.min.js')!!}
  {!!Html::script('theme/plugins/money_format/numeral_money.min.js')!!}
  {!!Html::script('theme/plugins/jQuery_Ajax/jquery-ajax.js')!!}
  {!!Html::style('theme/plugins/queryLoader/queryLoader.css')!!}
  {!!Html::script('theme/plugins/queryLoader/queryLoader.js')!!}
 	{!!Html::script('js/validate/jquery.validate.js')!!}

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  @yield('style')
  <style>
  	.background-div{
  		background: none;
  		display: flex; align-items: center;
  	}
  	.fadeOut{
  		display: block;
  		max-width: 100%;
  		min-width: 100%;
  		height: 100%;
  		position: absolute;
  		z-index: 999999999999;
  		background: url({{url('img/ajax-loader.gif')}}) center center no-repeat #000;
  		display: flex;
  		justify-content: center;
  		align-items: center;
  	}
  </style>
  <script>
  	$(document).ready(function(){
  		// $('.fadeOutGif').fadeOut(3000);
  		$('.fadeOut').fadeOut(2000);
  	});
  </script>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="col-lg-12 hold-transition skin-blue layout-top-nav" style="padding:0;background: url({{url('img/bg-2.jpg')}})  no-repeat; background-size: 100% 100%;">
	<div class="fadeOut col-lg-12">
	</div>
	<div class="wrapper" style="background: none">
		<header class="main-header">
			<nav class="navbar navbar-static-top" style="background-color: rgba(60, 141, 188,0.7);">
				<div class="navbar-header" style="float: left" >
					<a href="{{route('getsearch')}}" class="navbar-brand"><b>SỨC MUA VIỆT</b></a>
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
						<i class="fa fa-bars"></i>
					</button>
				</div>
				<div class="container col-gl-12"  >
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div style="float: right !important;"  class="collapse navbar-collapse pull-left" id="navbar-collapse">
						<form class="navbar-form navbar-left" role="search">
							<div class="form-group">
								<input type="text" class="form-control" id="navbar-search-input" placeholder="Tìm kiếm">
							</div>
						</form>
						<ul class="nav navbar-nav">
							{{-- 	<li class="active"><a href="{{route('getsearch')}}"><span>KIỂM TRA MỨC HẠN MUA CỦA BẠN</span></a></li> --}}
							<li><a href="{{route('getlogin')}}">Đăng nhập</a></li>
							<li><a href="#">Giới thiệu</a></li>
						</ul>
						
					</div>
					<!-- /.navbar-collapse -->
					<!-- Navbar Right Menu -->
					<!-- /.navbar-custom-menu -->
				</div>
				<!-- /.container-fluid -->
			</nav>
		</header>
		<!-- Full Width Column -->
		<div class="content-wrapper background-div">
			<div class="container">
				<!-- Content Header (Page header) -->
				@yield('content')
				<!-- /.content -->
			</div>
			<!-- /.container -->
		</div>
		<!-- /.content-wrapper -->
		<footer class="main-footer" style="background: rgba(60, 141, 188,0.3);">
			<div class="container">
				<div class="pull-right hidden-xs">
				</div>
				<strong><a href="http://globalflow.com.vn" style="color: white; font-size: 18px;">Developed By Global Flow</a></strong>
			</div>
			<!-- /.container -->
		</footer>
	</div>
	<!-- ./wrapper -->


	<!-- Bootstrap 3.3.6 -->
	{!!Html::script('theme/bootstrap/js/bootstrap.min.js')!!}
	<!-- SlimScroll -->
	{!!Html::script('theme/plugins/slimScroll/jquery.slimscroll.min.js')!!}
	<!-- FastClick -->
	{!!Html::script('theme/plugins/fastclick/fastclick.js')!!}
	<!-- AdminLTE App -->
	{!!Html::script('theme/dist/js/app.min.js')!!}
	<!-- AdminLTE for demo purposes -->
	{!!Html::script('theme/dist/js/demo.js')!!}

</body>
</html>
