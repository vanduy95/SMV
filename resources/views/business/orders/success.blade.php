@extends('sucmua.master')
@section('style')
<style>
  body{
    min-height: 96.9%;
  }
  header,.header{
      display: none !important;
    }
    p,span,h1,h2,h3,h4,h5,h6{
      font-family: Arial;
    }
</style>
@stop
@section('content')
<!-- Content Header (Page header) -->
<!-- Main content -->
<div class="col-lg-12 div-flex" style="min-height: 100%;background: url({{url('../img/success.jpg')}});background-size: 100% 100%;width: 100%; padding: 0;margin:0;position: fixed;">
  <div class=" col-lg-6 text-center" style="background:rgba(255, 255, 255,0.94);">
    <div class="col-lg-12" style="margin: 30px 0 30px 0">
      <img src="{{url('img/ok.png')}}" alt="">
    </div>
    <div class="col-lg-12">
      <p>Quý khách đã đăng kí thành công</p>
      <span style="font-style: italic;"><p>Tổng đài viên của <b>SỨC MUA VIỆT</b> sẽ liên hệ đến quý khách trong vòng 5 phút</p>
        <p>Xin cảm ơn quý khách đã cho chúng tôi được phục vụ!</p>
      </span>
    </div>
    <div class="col-lg-12" style="border: 1px solid gray;"></div>
    <div class="col-lg-12" style="margin: 20px 0 20px 0">
      <a href="/" class="btn btn-primary">Quay lại trang chủ</a>
    </div>
  </div>
  <div class="clear"></div>
</div>
<div class="clear"></div>
@stop