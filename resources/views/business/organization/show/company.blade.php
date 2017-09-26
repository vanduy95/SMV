@extends('layouts.master')
@section('content')
<style type="text/css">
  td{
      text-align: center !important;
  }
  th{
    text-align: center !important;
  }
  .form-center-group{
  	display: flex;
  	align-items: center;
  }
  .form-last-group{
  	display: flex;
  	justify-content:center;
  }
  .form-last-group input[type=reset]{
  	margin: 0 0 0 10%;
  }
</style>
<section class="content-header">
  <h1>
    Organization
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Organization</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Sửa Công Ty</h3>
        </div>
        <div class="panel-body">
          <div class="col-lg-12 form-group">
            <form class="col-lg-offset-1 form-group" action="{{url('admin/organization/show/company',$organ->id)}}" id="createform" method="POST">
              {{ csrf_field() }}              
              @if(session('notify'))
              <div class="alert bg-teal disabled color-palette">
               {{session('notify')}}
             </div>
             @endif
             <div class="form-group form-center-group col-lg-12">
               <label class="control-label col-lg-4">Mã công ty</label>
               <div class="col-lg-6">
                 <label class="form-control">{{$organ->ma}}</label> 
               </div>
             </div>

             <div class="form-group form-center-group col-lg-12">
               <label class="control-label col-lg-4">Tên công ty: <label style="color:red">*</label> </label>
               <div class="col-lg-6" >
                 <input class="form-control" type="text" name="name" id="name" value="{{$organ->name}}" />
                 <p style="color: red;">@if($errors->has('name')){{$errors->first('name')}} @endif</p>
               </div>
             </div>
             <div class="form-group form-center-group col-lg-12">
               <label class="control-label col-lg-4">Thành phố: <label style="color:red">*</label> </label>
               <div class="col-lg-6" >
                 <input class="form-control" type="text" value="{{$organ->city}}" name="city" id="city">
                 <p style="color: red;">@if($errors->has('city')){{$errors->first('city')}} @endif</p>
               </div>
             </div>
             <div class="form-group form-center-group col-lg-12">
               <label class="control-label col-lg-4">Địa chỉ: <label style="color:red">*</label> </label>
               <div class="col-lg-6" >
                 <input class="form-control" type="text" value="{{$organ->address }}" name="addr" id="addr">
                 <p style="color: red;">@if($errors->has('addr')){{$errors->first('addr')}} @endif</p>
               </div>
             </div>
             <div class="form-group form-center-group col-lg-12">
               <label class="control-label col-lg-4">Số điện thoại:</label>
               <div class="col-lg-6" >
                 <input class="form-control" class="" type="text" value="{{$organ->phone}}" name="phone" id="phone">
                 <p style="color: red;">@if($errors->has('phone')){{$errors->first('phone')}} @endif</p>
               </div>
             </div>
             <div class="form-group form-center-group col-lg-12">
               <label class="control-label col-lg-4">Ngân hàng: <label style="color:red">*</label> </label>
               <div class="col-lg-6" >
                 <input class="form-control" type="text" value="{{$organ->bank}}" name="bank" id="bank">
                 <p style="color: red;">@if($errors->has('bank')){{$errors->first('bank')}} @endif</p>
               </div>
             </div>
             <div class="form-group form-center-group col-lg-12">
               <label class="control-label col-lg-4">Ngày cập nhật:</label>
               <div class="col-lg-6" >
                 <label>{{date('d-m-Y',strtotime($today))}}</label>
               </div>
             </div>
             <div class="form-group form-center-group col-lg-12">
               <div class="col-lg-6" >
                 <label style="font-size: 13px; font-style: italic; color: red">('Những dòng có dấu * là bắt buộc phải điển')</label>
               </div>
             </div>
             <div class="form-group form-last-group col-lg-12 div-center">
               <input class="col-lg-2 col-xs-2 btn btn-primary" type="submit" name="Save" value="Lưu">
               <input class="col-lg-2 col-xs-2 col-xs-offset-1 btn btn-primary" type="button" id="btn_reset" name="btn_reset" value="Nhập Lại">
             </div>
           </form>
         </div>
       </div>
     </div>
   </div>
 </div>
</section>
<script type="text/javascript">
  $(document).ready(function() {
   $("#createform").validate({
    rules: {
      ma: {
        required: true,
      },
      name: {
        required: true,
        maxlength: 225,
        minlength: 6,
      },
      city: {
        required: true,
        maxlength: 225,
        minlength: 6,

        min_price:true,
      },
      addr:{
        required: true,
        minlength: 6,
        maxlength: 225,
      },

      bank: {
        required: true,
        maxlength: 225,
        minlength: 5,
      },
    },
    messages: {
      ma: {
        required: "Trường không được để trống",
        maxlength: "Trường có độ dài tối đa là 225 ký tự",
        minlength: "Trường có độ dài tối thiêu là 6 ký tự",
      },
      name: {
        required: "Trường không được để trống",
        maxlength: "Trường có độ dài tối đa là 225 ký tự",
        minlength: "Trường có độ dài tối thiêu là 6 ký tự",
      },
      city: {
        required: "Trường không được để trống",
        maxlength: "Trường có độ dài tối đa là 225 ký tự",
        minlength: "Trường có độ dài tối thiêu là 6 ký tự",
      },
      addr: {
        required: "Trường không được để trống",
        maxlength: "Trường có độ dài tối đa là 225 ký tự",
        minlength: "Trường có độ dài tối thiêu là 6 ký tự",

      },
      bank: {
        required: "Trường không được để trống",
        maxlength: "Trường có độ dài tối đa là 225 ký tự",
        minlength: "Trường có độ dài tối thiêu là 5 ký tự",
      },
    }
  });
 });
@stop