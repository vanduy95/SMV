@extends('layouts.master')
@section('content')
<section class="content-header">
<style type="text/css">
	.error{
		color:red;
	}
</style>
	<h1>
		Change password  
		<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Change password</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Change password</h3>
				</div>
				<div class="panel-body">
					<div class="form">
						{!!Form::open(array('class'=>'form-validate form-horizontal','id'=>'register_form','action'=>['ChangePasswordController@update',$user->id]))!!}
						@if(session('error'))
						<div class="alert alert-danger alert-dismissible">
							{{session('error')}}
						</div>
						@endif
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Old password  <span class="required">*</span>',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								{!! Form::password('passwordold',['class'=>'form-control','placeholder'=>'Mật khẩu cũ']) !!}
								@if($errors->has('passwordold'))<p style="color: red;">{{$errors->first('passwordold')}}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','New password  <span class="required">*</span>',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								{!! Form::password('passwordnew',['class'=>'form-control','placeholder'=>'Mật khẩu mới','id'=>'passwordnew']) !!}
								@if($errors->has('passwordnew'))<p style="color: red;">{{$errors->first('passwordnew')}}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Confirm password  <span class="required">*</span>',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								{!! Form::password('password_confirmation',['class'=>'form-control','placeholder'=>'Mật khẩu xác minh']) !!}
								@if($errors->has('password_confirmation'))<p style="color: red;">{{$errors->first('password_confirmation')}}</p>@endif
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-offset-2 col-lg-10">
								{!!Form::submit('Save',['id'=>'save','class'=>'btn btn-primary'])!!}
								{!!Form::reset('Reset',['id'=>'reset','class'=>'btn btn-default'])!!}
							</div>
						</div>
						{!!Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#register_form').validate({
				rules:{
					passwordold:{
						required:true,
						minlength:6,
						maxlength:30
					},
					passwordnew:{
						required:true,
						minlength:6,
						maxlength:30
					},
					password_confirmation:{
						required:true,
						minlength:6,
						maxlength:30,
						equalTo: "#passwordnew"
					}
				},
				messages:{
					passwordold:{
						required:'Mật khẩu cũ không được để trống',
						minlength:'Mật khẩu cũ phải từ 6->30 kí tự',
						maxlength:'Mật khẩu cũ phải từ 6->30 kí tự'
					},
					passwordnew:{
						required:'Mật khẩu mới không được để trống',
						minlength:'Mật khẩu mới phải từ 6->30 kí tự',
						maxlength:'Mật khẩu mới phải từ 6->30 kí tự'
					},
					password_confirmation:{
						required:'Xác nhận mật khẩu không được để trống',
						minlength:'Xác nhận mật khẩu phải từ 6->30 kí tự',
						maxlength:'Xác nhận mật khẩu từ 6->30 kí tự',
						equalTo: 'Mật khẩu không khớp'
					}
				}
			});
		});
	</script>
</section>
@stop