@extends('sucmua.master')
@section('style')
<style rel="stylesheet">
	header{
		display: none !important;
	}
	p,span,a{
		font-size: 15px;
		font-family: Arial;
	}
	.text-center p:nth-child(1){
		font-weight: bold !important;
		font-size: 25px !important;
	}
	a:hover,a:focus{
		color: #170e66 !important;
		font-size: 30px !important;
		transition: all 1s;
		text-decoration: none !important;
		cursor: pointer;
	}
	h1{
		font-size: 100px !important;
	}
	.margin-div{
		padding: 2% !important;
	}
</style>
@stop
@section('content')
<div class="div-flex" style="z-index: 1;position: fixed;padding: 0;margin: 0; min-height: 100%; width: 100%">
	<div class="col-lg-6" style="background: rgba(255, 255, 255,0.8);">
		<h1 class="text-center">404</h1>
		<div class="text-center">
			<p>Có vẻ như bạn đã truy cập sai hướng.</p> 
			<p>Trang web mà bạn đang tìm kiếm không có. </p>
			<a href="{{url('/')}}">Trang chủ</a>
		</div>
		<div class="clear margin-div"></div>
	</div>
	<div class="clear"></div>
</div>
<div class="col-lg-12 div-flex" style="padding: 0;margin: 0;background: url('{{ url('img/404.jpg') }}');min-height: 100%;position: fixed; background-size:  100% 100%;">
</div>
@stop