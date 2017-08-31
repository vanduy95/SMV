<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="{{url('img/demo/shortcut-icon.png')}}" rel="shortcut icon" type="image/x-icon" />  
	<title>SỨC MUA VIỆT</title>
	{!!Html::script('theme/plugins/jQuery/jquery-3.2.1.min.js')!!}
	{!!Html::script('theme/plugins/jQuery_Ajax/jquery-ajax.js')!!}
	{!!Html::script('theme/bootstrap/js/bootstrap.min.js')!!}

	{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}
	{!!Html::script('js/custom.js')!!}
	{{-- kendojs --}}
	{!!Html::script('theme/kendo/kendo.all.min.js')!!}
	{!!Html::script('theme/kendo/moment.js')!!}
	{{-- endkendojs --}}
	{{-- kendo css --}}
	{!!Html::style('/theme/kendo/kendo.common-material.min.css')!!}
	{!!Html::style('/theme/kendo/kendo.material.mobile.min.css')!!}
	{!!Html::style('/theme/kendo/kendo.material.min.css')!!}
	{{-- end kendo --}}
	{!!Html::script('theme/bootstrap/js/bootstrap-select.js')!!}
	{!!Html::style('theme/bootstrap/css/bootstrap.min.css')!!}
	{!!Html::style('theme/bootstrap/css/bootstrap-theme.css')!!}
	{!!Html::style('theme/bootstrap/css/bootstrap-select.css')!!}
	{!!Html::style('css/style_home.css')!!}
	{!!Html::style('css/font-awesome.min.css')!!}
	{!!Html::script('js/alert/sweetalert.min.js')!!}
	{!!Html::style('js/alert/sweetalert.css')!!}
	{!!Html::script('theme/plugins/money_format/numeral_money.min.js')!!}
	{!!Html::script('js/validate/jquery.validate.js')!!}

	@yield('style')
	@yield('script')
	<script type="text/javascript">
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		function openNav() {
			document.getElementById("mySidenav").style.width = "70vw";
		}

		function closeNav() {
			document.getElementById("mySidenav").style.width = "0";
		}
		$(document).ready(function(){ 
			$('form').submit(function(event) {
				if($(this).valid())
					$('#loading').show();
			});
			var url=window.location.href;
			$('.content-menu a').each(function () {
				if($(this).attr('href')==url)
				{
					$(this).addClass('active');
				}
			})
			$('.container-fluid').click(function() {
				var cla = "header";
				if($(this).attr('id')!= cla || $(this).attr('id')==null){
					document.getElementById("mySidenav").style.width = "0";
				}
			});
		});
	</script>
	<style>
		.clear{
			clear: both;
		}
		#loading{
			background: url({{ asset('img/loading.gif')}}) center no-repeat rgba(0,0,0,0.5);
			position: fixed;
			left: 0px;
			top: 0px,;
			width: 100%;
			height: 100%;
			z-index: 9999
		}
	</style>
</head>
<body >
	<div id="mySidenav" class="sidenav">
		<div class="header-menu">
			<a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="fa fa-times" aria-hidden="true"></i></a>
		</div>
		<div class="content-menu" >
			<a href="{{route('getsearch')}}/" class="home">Trang chủ<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
			<a href="{{route('aboutus')}}" class="nb">Giới thiệu<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
			<a href="{{route('getlogin')}}" class="login ">Đăng nhập<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
			<a href="{{route('accountcreate')}}" class="register">Đăng ký<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
		</div>
	</div>
	<div class="loading" id="loading" style="display: none"></div>
	<header class="container-fluid" id="header">
		<div class="container header-mobile">
			<div class="row-menu-mobile">
				<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
				
			</div>
			<div class="row-logo-mobile">
				<a href="{{route('getsearch')}}"><img src="../img/home_page/logo.jpg"></a>
			</div>
			<div class="row-search-mobile">
				<div class="input-group stylish-input-group">
					<i class="fa fa-search" aria-hidden="true"></i>
				</div>
			</div>
		</div>
		<div class="container header-desktop">
			<div class="row row-logo">
				<div class="col-lg-4" style="padding: 0;">
					<a href="{{route('getsearch')}}"><img src="../img/home_page/logo.jpg"></a>
				</div>
				<div class="Hotline-logo col-lg-3">
					<p style="font-size: 1.7vw;"><i class="fa fa-phone" aria-hidden="true" style="margin-right: 1vw;"></i><span style="font-size: 1.5vw">Hotline</span></p>
					<p style="padding-left: 3.5vw;"><span style="font-size: 1.5vw">024.6655.2428</span><span style="padding-left: 2vw;font-size: 1.5vw">0904.633.568</span></p>
				</div>
			</div>
			<div class="row row-menu">
				<nav class="navbar navbar-default">
					<div class="container-fluid">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav navbar-right">
								<li><a href="{{route('getsearch')}}" class="home active">TRANG CHỦ</a><hr class="hr-home"></li>
								<li><a href="{{route('aboutus')}}" class="menu">GIỚI THIỆU</a></li>
								<li><a href="{{route('getlogin')}}" class="menu">ĐĂNG NHẬP</a></li>
								<li><a href="{{route('accountcreate')}}" class="menu">ĐĂNG KÝ</a></li>
							</ul>
						</div><!-- /.navbar-collapse -->
					</div><!-- /.container-fluid -->
				</nav>
			</div>
		</div>
	</header>
	@yield('content')
	<footer class="container-fluid col-lg-12 col-md-12 col-xs-12">
		<div class="footer-desktop">
			<div class="row footer-logo">
				<a href="{{route('getsearch')}}"><img src="../img/home_page/logo_footer.png"></a>
			</div>
			<div class="row footer-menu">
				<span class="short-menu line"><a href="">Mua hàng trả góp</a></span>
				<span class="short-menu line"><a href="">Trang nội bộ</a></span>
				<span class="short-menu"><a href="{{route('aboutus')}}">Giới thiệu</a></span>
			</div>
			<div class="row footer-contact">
				<h2>CÔNG TY TNHH PHÁT TRIỂN  SỨC MUA VIỆT</h2>
				<p>Địa chỉ: 302, Tầng 3 tòa nhà Fafilm Việt Nam - 19 Nguyễn Trãi - Thanh Xuân - Hà Nội</p>
				<p>Mã số doanh nghiệp: 107761776</p>
				<p>Nơi cấp: Sở kế hoạch đầu tư thành phố Hà Nội</p>
			</div>
			<div class="row footer-social-icon">
				<a href="" class="f-social-icon"><i class="fa fa-facebook" aria-hidden="true"></i></a>
				<a href="" class="f-social-icon"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
				<a href="" class="f-social-icon"><i class="fa fa-twitter" aria-hidden="true"></i></a>
			</div>
			<div class="container">
				<div class="row footer-copyright">
					<span>&#169 2017 Sucmuaviet. All rights reserved</span>
				</div>
			</div>
		</div>
		<div class="footer-mobile">
			<div class="footer-social-icon" style="width: 100%;">
				<a href="" class="f-social-icon"><i class="fa fa-facebook" aria-hidden="true"></i></a>
				<a href="" class="f-social-icon"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
				<a href="" class="f-social-icon"><i class="fa fa-twitter" aria-hidden="true"></i></a>
				<div class="clear"></div>
			</div>
			<div class="row footer-contact">
				<h2>CÔNG TY TNHH PHÁT TRIỂN  SỨC MUA VIỆT</h2>
				<p>Địa chỉ: 302, Tầng 3 tòa nhà Fafilm Việt Nam - 19 Nguyễn Trãi - Thanh Xuân - Hà Nội</p>
				<p>Mã số doanh nghiệp: 107761776</p>
				<p>Nơi cấp: Sở kế hoạch đầu tư thành phố Hà Nội</p>
			</div>
			<div class="row footer-hotline">
				<span>HOTLINE : 0904 633 568</span>
			</div>
			<div class="clear"></div>
		</div>
	</footer>
	@yield('script')
</body>
</html>
