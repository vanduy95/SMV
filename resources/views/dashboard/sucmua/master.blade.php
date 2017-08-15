<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link href="{{url('img/demo/logo.png')}}" rel="shortcut icon" type="image/x-icon" />  
	<title>LOS</title>
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
</head>
<body class="col-lg-12" style="padding:0; margin:0">
	<head class="main-header content">
		@include('sucmua.header')
	</head>
	<section class="main-section">
		@include('sucmua.content')
	</section>
	<footer>
		@include('sucmua.footer')
	</footer>
</body>