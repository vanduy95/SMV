@extends('layouts.master')
@section('content')
<script>
  $(document).ready(function(){
    $('#btn_reset').click(function(){
        $('input[type="text"]').val('');
    });
  });
</script>
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
          <h3 class="box-title">Edit Company</h3>
        </div>
        <div class="panel-body">
          <div class="col-lg-12 form-group">
            <form class="col-lg-offset-1 form-group" action="{{url('admin/organization/show/company',$organ->id)}}" method="POST">
              {{ csrf_field() }}              
              @if(session('notify'))
              <div class="alert bg-teal disabled color-palette">
               {{session('notify')}}
             </div>
             @endif
             <div class="form-group form-center-group col-lg-12">
               <label class="control-label col-lg-4">Code</label>
               <div class="col-lg-6">
                 <label class="form-control">{{$organ->ma}}</label> 
               </div>
             </div>

             <div class="form-group form-center-group col-lg-12">
               <label class="control-label col-lg-4">Name: <label style="color:red">*</label> </label>
               <div class="col-lg-6" >
                 <input class="form-control" type="text" name="name" value="{{$organ->name}}" />
                 <p style="color: red;">@if($errors->has('name')){{$errors->first('name')}} @endif</p>
               </div>
             </div>
             <div class="form-group form-center-group col-lg-12">
               <label class="control-label col-lg-4">City: <label style="color:red">*</label> </label>
               <div class="col-lg-6" >
                 <input class="form-control" type="text" value="{{$organ->city}}" name="city">
                 <p style="color: red;">@if($errors->has('city')){{$errors->first('city')}} @endif</p>
               </div>
             </div>
             <div class="form-group form-center-group col-lg-12">
               <label class="control-label col-lg-4">Address: <label style="color:red">*</label> </label>
               <div class="col-lg-6" >
                 <input class="form-control" type="text" value="{{$organ->address }}" name="addr">
                 <p style="color: red;">@if($errors->has('addr')){{$errors->first('addr')}} @endif</p>
               </div>
             </div>
             <div class="form-group form-center-group col-lg-12">
               <label class="control-label col-lg-4">Phone: <label style="color:red">*</label> </label>
               <div class="col-lg-6" >
                 <input class="form-control" class="" type="text" value="{{$organ->phone}}"  name="phone">
                 <p style="color: red;">@if($errors->has('phone')){{$errors->first('phone')}} @endif</p>
               </div>
             </div>
             <div class="form-group form-center-group col-lg-12">
               <label class="control-label col-lg-4">Bank: <label style="color:red">*</label> </label>
               <div class="col-lg-6" >
                 <input class="form-control" type="text" value="{{$organ->bank}}" name="bank">
                 <p style="color: red;">@if($errors->has('bank')){{$errors->first('bank')}} @endif</p>
               </div>
             </div>
             <div class="form-group form-center-group col-lg-12">
               <label class="control-label col-lg-4">Update At:</label>
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
@stop