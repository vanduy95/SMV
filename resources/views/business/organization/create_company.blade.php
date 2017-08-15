@extends('layouts.master')
@section('content')
<style type="text/css">
  td{
      text-align: center !important;
  }
  th{
    text-align: center !important;
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
					<h3 class="box-title">Create Company</h3>
				</div>
				<div class="panel-body">
					<div class="col-lg-12 form-group">
						<form class="col-lg-offset-1 form-group" action="{{url('admin/organization/create/company')}}" method="POST">
							{{ csrf_field() }}		          
              @if(session('notify'))
              <div class="alert bg-teal disabled color-palette">
               {{session('notify')}}
             </div>
             @endif
             <div class="form-group col-lg-12">
               <label class="control-label col-lg-4">Code <label style="color:red">*</label></label>
               <div class="col-lg-6">
                 <input class="form-control" type="text"   name="ma" placeholder="Nhập vào mã công ty ở đây">
                 <p style="color: red;">@if($errors->has('ma')){{$errors->first('ma')}}@endif</p>
               </div>
             </div>

             <div class="form-group col-lg-12">
               <label class="control-label col-lg-4">Name: <label style="color:red">*</label></label>
               <div class="col-lg-6" >
                 <input class="form-control" type="text" name="name" placeholder="Nhập vào tên công ty ở đây" />
                 <p  style="color: red;">@if($errors->has('name')){{$errors->first('name')}}@endif</p>
               </div>
             </div>
             <div class="form-group col-lg-12">
               <label class="control-label col-lg-4">City: <label style="color:red">*</label></label>
               <div class="col-lg-6" >
                 <input class="form-control" type="text" name="city" placeholder="Nhập vào tên thành phố">
                 <p style="color: red;">@if($errors->has('city')){{$errors->first('city')}}@endif</p>
               </div>
             </div>
             <div class="form-group col-lg-12">
               <label class="control-label col-lg-4">Address: <label style="color:red">*</label></label>
               <div class="col-lg-6" >
                 <input class="form-control" type="text" name="addr" placeholder="Nhập vào địa chỉ công ty">
                 <p style="color: red;">@if($errors->has('addr')){{$errors->first('addr')}}@endif</p>
               </div>
             </div>
             <div class="form-group col-lg-12">
               <label class="control-label col-lg-4">Noted: </label>
               <div class="col-lg-6" >
                 <input class="form-control" type="text" placeholder="Điền vào ghi chú về công ty"  name="noted">
               </div>
             </div>
             <div class="form-group col-lg-12">
               <label class="control-label col-lg-4">Phone: <label style="color:red">*</label></label>
               <div class="col-lg-6" >
                 <input class="form-control" class="" type="text"  name="phone" placeholder="Nhập vào số điện thoại công ty"> 
                 <p style="color: red;">@if($errors->has('phone')){{$errors->first('phone')}}@endif</p>
               </div>
             </div>
             <div class="form-group col-lg-12">
               <label class="control-label col-lg-4">Bank: <label style="color:red">*</label></label>
               <div class="col-lg-6" >
                 <input class="form-control" type="text" name="bank" placeholder="Điền vào tên ngân hàng trả lương">
                 <p style="color: red;">@if($errors->has('bank')){{$errors->first('bank')}}@endif</p>
               </div>
             </div>
             <div class="form-group col-lg-12">
               <label class="control-label col-lg-4">Bank Branch:</label>
               <div class="col-lg-6" >
                 <input class="form-control" type="text" name="bbranch" placeholder="Điền vào tên chi nhánh ngân hàng">
               </div>
             <div class="form-group col-lg-12">
               <div class="col-lg-6" >
                 <label style="font-size: 13px; font-style: italic; color: red">('Những dòng có dấu * là bắt buộc phải điển')</label>
               </div>
             </div>
             <div class="form-group col-lg-12">
               <input class="btn btn-primary" type="submit" name="Save">
               <input class="btn btn-primary" type="reset" name="Reset">
             </div>
           </form>
         </div>
       </div>
     </div>
   </div>
 </div>
</section>
@stop