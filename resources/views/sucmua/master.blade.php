<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="{{url('img/demo/shortcut-icon.png')}}" rel="shortcut icon" type="image/x-icon" />  
	<title>LOS</title>
	@yield('style')
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	{!!Html::style('css/style_demo.css')!!}
	<!-- Bootstrap CSS -->
	{!!Html::style('css/bootstrap.min.css')!!}    
	<!-- bootstrap theme -->
	{!!Html::style('css/bootstrap-theme.css')!!} 
	<!--external css-->
	<!-- font icon -->
	{!!Html::style('css/elegant-icons-style.css')!!} 
	{!!Html::style('css/font-awesome.css')!!}
	{!!Html::style('css/font-awesome.min.css')!!} 
	{!!Html::style('js/alert/sweetalert.css')!!}
	{!!Html::script('theme/plugins/jQuery/jquery-3.2.1.min.js')!!}
	{!!Html::script('theme/plugins/jQuery_Ajax/jquery-ajax.js')!!}
	{{-- kendojs --}}
	{!!Html::script('theme/kendo/kendo.all.min.js')!!}
	{!!Html::script('theme/kendo/moment.js')!!}
	{{-- endkendojs --}}
	{!!Html::script('theme/plugins/money_format/numeral_money.min.js')!!}
	{!!Html::script('js/alert/sweetalert.min.js')!!}

	<!-- bootstrap wysihtml5 - text editor -->
	{!!Html::style('/theme/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')!!}
	{{-- kendo css --}}
	{!!Html::style('/theme/kendo/kendo.common-material.min.css')!!}
	{!!Html::style('/theme/kendo/kendo.material.mobile.min.css')!!}
	{!!Html::style('/theme/kendo/kendo.material.min.css')!!}
	{{-- end kendo --}}
	{!!Html::style('css/style.css')!!}
	{!!Html::style('theme/plugins/datatables/dataTables.bootstrap.css')!!}
	<!-- Bootstrap 3.3.6 -->
	{!!Html::script('theme/bootstrap/js/bootstrap.min.js')!!}
	{!!Html::script('js/validate/jquery.validate.js')!!}
	@yield('script')
	<script type="text/javascript">
		var table = $('#example').DataTable();
		table
		.order( [ 0, 'desc' ] )
		.draw();
	</script>
	<style>
		html{
			height: 100%;
		}
		body{
			padding: 0 !important;
		}
	</style>
</head>
<body class="col-lg-12">
	<header class="main-header">
		@include('sucmua.header')
	</header>
	<section class="main-section">
		@yield('content')
		<div class="clear"></div>
	</section>
	<div class="clear"></div>
{{-- 	<footer>
		@include('sucmua.footer')
	</footer> --}}

</body>
</html>