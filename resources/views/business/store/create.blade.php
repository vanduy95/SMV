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
				</div>
				<div class="panel-body">
					<div class="form">
						{!!Form::open(array('class'=>'form-validate form-horizontal','id'=>'register_form','action'=>['StoreController@postcreate']))!!}
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Hệ thống *',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								<select class="form-control" name="store">
									<option value="">Hệ thống bán lẻ</option>
									@foreach($retaisystem as $gu)
									<option value="{{$gu}}" >{{$gu}}</option>
									@endforeach
								</select>
								@if($errors->has('retaisystem'))<p style="color: red;">{!!$errors->first('retaisystem')!!}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Thành phố *',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								{!!Form::text('retailcity','',['class'=>'form-control','placeholder'=>''])!!}
								@if($errors->has('nameretail'))<p style="color: red;">{!!$errors->first('nameretail')!!}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Quận/Huyện *',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								{!!Form::text('retaildistrict','',['class'=>'form-control','placeholder'=>''])!!}
								@if($errors->has('nameretail'))<p style="color: red;">{!!$errors->first('nameretail')!!}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Tên chi nhánh *',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								{!!Form::text('name_center','',['class'=>'form-control'])!!}
								@if($errors->has('nameretail'))<p style="color: red;">{!!$errors->first('nameretail')!!}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Địa chỉ *',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								{!!Form::text('storeaddress','',['class'=>'form-control'])!!}
								@if($errors->has('nameretail'))<p style="color: red;">{!!$errors->first('nameretail')!!}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Số điện thoại',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								{!!Form::text('phonecontact','',['class'=>'form-control'])!!}
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
				},
				retaildistrict:{
					required:true,
				},
				name_center:{
					required:true,
				},
				storeaddress:{
					required:true,
				},
				phonecontact:{
					required:true,
					number:true,
				},
			},
			messages: {
				store:{
					required: "Trường này không được để trống",
				},
				retailcity:{
					required: "Trường này không được để trống",
				},
				retaildistrict:{
					required: "Trường này không được để trống",
				},
				name_center:{
					required: "Trường này không được để trống",
				},
				storeaddress:{
					required: "Trường này không được để trống",
				},
				phonecontact:{
					number: "Trường này là số",
					required: "Trường này không được để trống",
				},
			}
		});
	});
</script>
@stop
