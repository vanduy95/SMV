@extends('layouts.master')
@section('style')
<style type="text/css">
	.error{
		color:red;
	}
</style>
@stop
@section('content')
<section class="content-header">
	<h1>
		Hệ thống bán lẻ  
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Store</li>
	</ol>
</section>
<section class="content ">
	<div class="row">
		<div class="col-sm-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title"></h3>
				</div>
				<div class="panel-body">
					<div class="form">
						{!!Form::open(array('class'=>'form-validate form-horizontal','id'=>'register_form'))!!}
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Tên hệ thống',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								{!! Form::text('name',$collection['nameretail'],['class'=>'form-control','placeholder'=>'Tên ','readonly']) !!}
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Lãi suất cũ ',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								<input type="text" readonly="" name="" class="form-control" value="{{$collection['interest']*100}} %">
							</div>
						</div>
						<div class="form-group">
							{!!Html::decode(Form::label('fullname','Lãi suất mới <span class="required">*</span>',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-4">
								{!! Form::text('newinterest','',['class'=>'form-control','placeholder'=>'lãi suất mới','id'=>'newinterest']) !!}
								@if($errors->has('newinterest'))<p style="color: red;">{{$errors->first('newinterest')}}</p>@endif
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-offset-2 col-lg-10">
								{!!Form::submit('Lưu',['id'=>'save','class'=>'btn btn-primary'])!!}
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
			newinterest:{
				required:true,
				number:true,
				min:0,
				max:100
			}
		},
		messages: {
			newinterest:{
				number: "Trường này là số",
				required: "Trường này không được để trống",
				min:"Trường này không hợp lệ",
				max:"Trường này không hợp lệ"
			}
		}
	});
});
</script>
@stop