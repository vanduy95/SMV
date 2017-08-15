@extends('layouts.master')
@section('content')
<style rel="stylesheet">
 .error{
  color:red;
}
img{
  width: 100%;
  height: 200px;
}
.vertical-center{
  vertical-align: middle !important;
}
.fade_img{
  z-index: 1050;
  display: flex;
  height: 100%;
  background: rgba(34, 45, 50, 0.9);
  top: 0px !important;
  position: fixed !important;
  align-items: center;
  justify-content: center;
}
</style>
<script>
 $(document).ready(function(){
  $('table').on('click','#click_img',function(){
   var img = $(this).attr('src');
   $('#content_img').fadeIn('slow');
   $('#data_img').attr('src',img);
 });
  $('#close_img').click(function(){
    $('#content_img').fadeOut('slow');
    $('#data_img').attr('src',"");
  });
});
</script>
<section class="content-header">
  <h1>
    Phiếu Hóa Đơn
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"></li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Phiếu đăng ký</h3>
        </div>
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <thead>
              <tr></tr>
              <tr role="row">
                <th class="col-lg-3 text-center">Tên khách hàng</th>
                <th class="col-lg-3 text-center">Phiếu hóa đơn</th>
                <th class="col-lg-3 text-center">Ngày tạo</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $d)
              <tr id="tr_img">
                <td class="vertical-center text-center col-lg-1">{{$d->fullname}}</td>
                <td class="vertical-center text-center col-lg-2"><img id="click_img" src="{{ asset('/uploadfile/orders/')}}/{{$d->path}}" alt=""></td>
                <td class="vertical-center text-center col-lg-3">{{date('d-m-Y',strtotime($d->created_at))}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
<div  id="content_img" style="display: none">
  <div class="fade_img container">
    <div class="col-lg-12" style="width: 90%">
      <i id="close_img" class="fa fa-times" style="font-size: 50px; position: absolute; right: 10px" aria-hidden="true"></i>
      <img src="#" id="data_img" alt="" style="height: 500px; width: 1000px">
    </div>
  </div>
</div>
</div>
</section>
@stop
