@extends('home_page.master')
@section('style')
<style>
  body{
    min-height: 100%;
    padding: 0 !important;
  }
  @media only screen and (min-width: 302px) and (max-width: 1171px) {
    header{
      height: 20px;
    }
    div{
      display: block;
    }
    img{
      display: none !important
    }
  }
  #btn_selected:hover{
    transition: all 1s;
    background: rgba(23,14,102,0.8) !important;
  }
  #img{
    height: 200px;
  }
  .div-center{
    display: flex; 
    justify-content: center;
    align-items: center;
  }
  .clear{
    clear: both;
  }
  .div-popup-upload{
    width: 100%;
    background: rgba(0,84,166,0.3);
    min-height: 100% !important;
    z-index: 999;
  }
  #btn_select{
    transition: all 1s;
    font-weight: bold;
    /*border: 2px solid*/
  }
  #btn_select:hover{
    color: black;
    font-weight: bold;
    background: rgba(0,0,0,0.1);
  }
  label{
    color: black !important;
  }
</style>
@stop
@section('script')
<script>
  function myFun(){
    var x = $("#btnUpload").val().split("\\");
    $("#btnFile").val(x[2]);
    $('#send_data').prop('disabled',false);
    $('#error_img').html("");
  }
  $(document).ready(function(){
    $('#select_list').show();
    $('#img').hide();
    $('#btnUpload').click(function(){
      $("#img").fadeIn("slow").attr('src','../img/noimage.gif');
    });
    $('#btnUpload').change(function(e){
      $('#img').show();
      $("#img").fadeIn("slow").attr('src',URL.createObjectURL(event.target.files[0]));
    });
  });
  $(document).ready(function(){
    $('#row-data').hide();
    $('#btn_selected').click(function(){
      var market = $('#select_market').val();
      var city = $('#select_city').val();
      var dis = $('#select_dis').val();
      var store = $('#select_store').val();
      if(market=="" || city=="" || dis=="" || store==""){
        $('#er_data').show();
        $('#er_data').html('Chưa chọn đầy đủ thống tin. Bạn vui lòng chọn lại!!!');
      }
      else{
        $('#lb_market').val($('#select_market').val());
        $('#lb_city').val($('#select_city').val());
        $('#lb_dis').val($('#select_dis').val());
        $('#lb_store').val($('#select_store').val());
        $('#select_list').hide();
        $('#row-data').fadeIn();
      }
    });
    $('#btn_show').click(function(){
      $('#er_data').html("");
      $('#select_list').show();
      $('#row-data').hide();
    });
    $('#send_data').mouseover(function(){
      var path = $('#btnFile').val();
      if(path==""){
        $('#send_data').prop('disabled',true);
        $('#error_img').html("Ảnh không được để trống");
      }
    });
  });
</script>
@stop
@section('content')
<style>
  .form-control[readonly]{
    background: white;
    border-radius: 0;
    border: 1px solid #a3a3a3;
  }
</style>
<section class="content col-lg-12" style="padding: 0;background: url('../img/home_page/accountant.png'); background-size: 100% 100%">
  <div id="select_list" class=" div-popup-upload col-lg-12 div-center"  style="position: relative;display: none;background: rgba(255,255,255,0.5)">
    <div class="col-lg-5 my-5" style="background: rgba(255,255,255,0.8);border-radius: 5px;padding: 0">
      <div class="col-lg-12 pb-2" style="background: #1c1c70">
        <h3 class="text-center" style="color: white">Chọn hệ thống bán lẻ</h3>
      </div>
      {!! Form::open(['class'=>'col-lg-12 mt-5','id'=>'form_data','style'=>'padding-top: 10px;']) !!}
      <span class="form-group text-center" style="display: none; color:red" id="er_data"></span>
      <div class="col-lg-12 form-group">
          <label class="control-label col-lg-4">Siêu thị</label>
        <div class="col-lg-8">
          <select name="" id="select_market" class="form-control" >
            <option value="" selected="">Lựa Chọn</option>
            @foreach ($name as $n)
            <option value="{{$n}}">{{$n}}</option>
            @endforeach
          </select>
        </div>
        <div class="clear"></div>
      </div>
      <div class="col-lg-12 form-group">
          <label class="control-label col-lg-4">Thành phố:</label>
        <div class="col-lg-8">
          <select  name="" id="select_city" class="form-control">
            <optgroup style="height: 65px;">
              <option value="">Lựa Chọn</option>
              @foreach ($city as $c)
              <option value="{{$c}}">{{$c}}</option>
              @endforeach
            </optgroup>
          </select>
        </div>
        <div class="clear"></div>
      </div>
      <div class="col-lg-12 form-group">
          <label class="control-label col-lg-4">Quận/Huyện:</label>
        <div class="col-lg-8">
          <select name="" id="select_dis" class="form-control">
            <option value="">Lựa Chọn</option>
          </select>
        </div>
        <div class="clear"></div>
      </div>
      <div class="col-lg-12 form-group">
          <label class="control-label col-lg-4"> Cửa hàng:</label>
        <div class="col-lg-8">
          <select name="" id="select_store" class="form-control">
            <option value="">Lựa Chọn</option>
          </select>
        </div>
        <div class="clear"></div>
      </div>
      <div class="col-lg-12 form-group">
        <div class="col-lg-12 div-center">
          <input id="btn_selected" type="button" style="background: #170e66" class="btn btn-primary col-lg-3" value="TIẾP TỤC" name="">
        </div>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
  <div id="row-data" class="py-5 row col-lg-12 div-center" style="margin:0;position: relative; min-height: 70%; ">
    <div class="col-sm-10 col-lg-5 pb-5" style="text-align: center; background: rgba(255, 255, 255,0.7); padding: 0">
      <div class="box-header with-border" style="background: #1c1c70">
       <h3 class="py-5" style="margin: 0;color: white">TẢI ĐĂNG KÝ ĐƠN HÀNG</h3>
     </div>
     <div id="data-upload-img"  style="display: block;padding: 0 " class="box mt-5 pb-5">
         {!! Form::open(['action'=>['OrdersController@postupload',$user->id],'method'=>'post','enctype'=>"multipart/form-data",'class'=>'']) !!}
         <div class=" col-lg-12 form-group ">
           <div class="col-lg-12">
             <div class="col-lg-4">
               <label  class=" " for="">Hệ thống siêu thị</label>
             </div>
             <div class="col-lg-8">
              <input type="text" name="lb_market" id="lb_market" readonly="" class="form-control">
            </div>
          </div>
        </div>
        <div class=" col-lg-12 form-group ">
          <div class="col-lg-12">
           <div class="col-lg-4">
             <label  class="" for="">Quận Huyện</label>
           </div>
           <div class="col-lg-8">
            <input type="text" name="lb_dis" id="lb_dis" class="form-control" readonly>
          </div>
        </div>
      </div>
      <div class=" col-lg-12 form-group ">
       <div class="col-lg-12">
         <div class="col-lg-4">
           <label  class=" " for="">Thành phố</label>
         </div>
         <div class="col-lg-8">
           <input type="text" name="lb_city" id="lb_city" class="form-control" readonly>
         </div>
       </div>
     </div>
     <div class=" col-lg-12 form-group ">
       <div class="col-lg-12">
         <div class="col-lg-4">
           <label  class=" " for="">Cửa hàng</label>
         </div>
         <div class="col-lg-8">
           <input type="text" name="lb_store" id="lb_store" class="form-control" readonly>
         </div>
       </div>
     </div>
     <div class="col-lg-12 form-group ">
       <div class="col-lg-12">
        <div class="col-lg-4">
          <label class=" " >Chọn phiếu đăng ký</label>
        </div>
        <div class="col-lg-8">
          <div class="input-group">
            <label class="input-group-btn">
              <span class="btn btn-primary" style="background: #cccccc; border: 1px solid #a3a3a3; color: #373737">
                Browse<input id="btnUpload" accept="image/*" name="filename" onchange="myFun();" type="file" accept="" style="display: none; border: 1px solid #a3a3a3" multiple >
              </span>
            </label>
            <input id="btnFile" type="text" class="form-control" readonly>
          </div>
          <p style="color: red;" id="error_img"></p>
        </div>
      </div>
      <div class="clear"></div>
    </div>
    <div class="col-lg-12">
     <div class="col-lg-12 div-center">
      {!! Form::submit('Gửi phiếu đăng ký', ['class'=>' btn btn-primary col-lg-5 col-xs-7 col-md-6','id'=>'send_data','style'=>'background: #170e66;font-size: 20px;']) !!}
      <input type="button" id="btn_show"  style="background: #cccccc; border: 1px solid #cccccc;color: #373737;font-size: 20px;" class="col-lg-offset-1 col-xs-offset-1 col-md-offset-1 col-lg-3 col-xs-4 col-md-4 btn btn-primary" value="Chọn lại ">
    </div>
    <div class="clear"></div>
  </div>
  {!! Form::close() !!}
</div>
</div>
</div>
<div class="clear"></div>
</section>
@stop