@extends('layouts.master')
@section('content')
<section class="content-header">
	<h1>
		Hệ thống bán lẻ  
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">store</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Edit Store</h3>
				</div>
				<div class="panel-body">
					<div class="form">
						{!!Form::open(array('class'=>'form-validate form-horizontal','id'=>'register_form','action'=>['StoreController@update',$store->id]))!!}
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Hệ thống *',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								<select class="form-control" name="store">
									@foreach($retaisystem as $gu)
									<option value="{{$gu}}" @if($gu == $store->nameretail) selected="selected" @endif >{{$gu}}</option>
									@endforeach
								</select>
								@if($errors->has('retaisystem'))<p style="color: red;">{!!$errors->first('retaisystem')!!}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Thành phố *',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								{!!Form::text('retailcity',$store->retailcity,['class'=>'form-control','placeholder'=>''])!!}
								@if($errors->has('nameretail'))<p style="color: red;">{!!$errors->first('nameretail')!!}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Quận/Huyện *',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								{!!Form::text('retaildistrict',$store->retaildistrict,['class'=>'form-control','placeholder'=>''])!!}
								@if($errors->has('nameretail'))<p style="color: red;">{!!$errors->first('nameretail')!!}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Tên chi nhánh *',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								{!!Form::text('name_center',$store->name_center,['class'=>'form-control'])!!}
								@if($errors->has('nameretail'))<p style="color: red;">{!!$errors->first('nameretail')!!}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Địa chỉ *',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								{!!Form::text('storeaddress',$store->storeaddress,['class'=>'form-control'])!!}
								@if($errors->has('nameretail'))<p style="color: red;">{!!$errors->first('nameretail')!!}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Số điện thoại *',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								{!!Form::text('phonecontact',str_replace(' ','',$store->phonecontact),['class'=>'form-control'])!!}
								@if($errors->has('nameretail'))<p style="color: red;">{!!$errors->first('nameretail')!!}</p>@endif
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-offset-2 col-lg-10">
								{!!Form::submit('Lưu',['class'=>'btn btn-primary col-lg-2'])!!}
							</div>
						</div>
						{!!Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@stop
@section('script')
<script type="text/javascript">
	$(document).ready(function() {
		$("#register_form").validate({
			rules:{
				store:{
					required:true,
				},
				retailcity:{
					required:true,
					normalizer: function( value ) {
						return $.trim( value );
					},
					minlength:6,
					maxlength:255,
				},
				retaildistrict:{
					required:true,
					normalizer: function( value ) {
						return $.trim( value );
					},
					minlength:6,
					maxlength:255,
				},
				name_center:{
					required:true,
					normalizer: function( value ) {
						return $.trim( value );
					},
					minlength:6,
					maxlength:255,
				},
				storeaddress:{
					required:true,
					normalizer: function( value ) {
						return $.trim( value );
					},
					minlength:6,
					maxlength:255,
				},
				phonecontact:{
					required:true,
					number:true,
					minlength:10,
					maxlength:11,
				},
			},
			messages: {
				store:{
					required: "Bạn chưa chọn hệ thống",
				},
				retailcity:{
					required: "Bạn chưa nhập thành phố, không có khoảng trống ở đầu",
					minlength:"Tên thành phố phải nhiều hơn 6 ký tự",
					maxlength:"Bạn phải nhập ít hơn 225 ký tự",
				},
				retaildistrict:{
					required: "Bạn chưa nhập quận huyện, không có khoảng trống ở đầu",
					minlength:"Yêu cầu phải nhập nhiều hơn 6 ký tự",
					maxlength:"Bạn phải nhập ít hơn 225 ký tự",
				},
				name_center:{
					required: "bạn chưa nhập tên chi nhánh, không có khoảng trống ở đầu",
					minlength:"Tên chi nhánh phải nhiều hơn 6 ký tự",
					maxlength:"Bạn phải nhập ít hơn 225 ký tự",
				},
				storeaddress:{
					required: "Bạn chưa nhập địa chỉ chi nhánh, không có khoảng trống ở đầu",
					minlength:"Địa chỉ phải nhiều hơn 6 ký tự",
					maxlength:"Bạn phải nhập ít hơn 225 ký tự",
				},
				phonecontact:{
					number: "Trường này là số",
					required: "Trường này không được để trống, không có khoảng trống ở đầu",
					minlength:"Không đúng định dạng số điện thoại",
					maxlength:"Không đúng định dạng số điện thoại"
				},
			}
		});
	});
</script>
@stop