@extends('layouts.master')
@section('content')
<style type="text/css">
	.error{
		color: red;
	}
</style>
<section class="content-header">
	<h1>
		User  
		<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#">User</a></li>
		<li class="active">Add user</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Add User</h3>
				</div>
				<div class="panel-body">
					{!!Form::open(array('class'=>'form-validate form-horizontal','id'=>'register_form','enctype'=>"multipart/form-data"))!!}
					@if(session('notify'))
					<div class="alert bg-teal disabled color-palette">
						{{session('notify')}}
					</div>
					@endif
					<div class="form-group ">
						{!!Html::decode(Form::label('fullname','User name *',['class'=>'control-label col-lg-2']))!!}
						<div class="col-lg-8">
							{!!Form::text('username',old('username'),['class'=>'form-control','placeholder'=>'Tên người dùng ','id'=>'username'])!!}
							@if($errors->has('username'))<p style="color: red;">{!!$errors->first('username')!!}</p>@endif
						</div>
					</div>
					<div class="form-group ">
						{!!Html::decode(Form::label('fullname','Store *',['class'=>'control-label col-lg-2']))!!}
						<div class="col-lg-8">
							<select class="form-control" name="store">
								<option value="">Hệ thống bán lẻ</option>
								@foreach($store as $gu)
								<option value="{{$gu}}" >{{$gu}}</option>
								@endforeach
							</select>
							@if($errors->has('store'))<p style="color: red;">{!!$errors->first('store')!!}</p>@endif
						</div>
					</div>
					<div class="form-group ">
						{!!Html::decode(Form::label('fullname','Email *',['class'=>'control-label col-lg-2']))!!}
						<div class="col-lg-8">
							{!!Form::email('email',old('email'),['class'=>'form-control','placeholder'=>'Email ','id'=>'email'])!!}
							@if($errors->has('email'))<p style="color: red;">{!!$errors->first('email')!!}</p>@endif
						</div>
					</div>
					<div class="form-group ">
						{!!Html::decode(Form::label('fullname','Password *',['class'=>'control-label col-lg-2']))!!}
						<div class="col-lg-8">
							{!!Form::password('password',['class'=>'form-control','placeholder'=>'Mật khẩu','id'=>'password'])!!}
							@if($errors->has('password'))<p style="color: red;">{!!$errors->first('password')!!}</p>@endif
						</div>
					</div>
					<div class="form-group ">
						{!!Html::decode(Form::label('fullname','Password Confirm *',['class'=>'control-label col-lg-2']))!!}
						<div class="col-lg-8">
							{!!Form::password('password_confirmation',['class'=>'form-control','placeholder'=>'Mật khẩu xác minh '])!!}
							@if($errors->has('password_confirmation'))<p style="color: red;">{!!$errors->first('password_confirmation')!!}</p>@endif
						</div>
					</div>
					<div class="form-group ">
						{!!Html::decode(Form::label('fullname','Status*',['class'=>'control-label col-lg-2']))!!}
						<div class="col-lg-4">
							<select class="form-control" name="status">
								<option value="">Trạng thái tài khoản</option>
								<option value="1" @if(old('status')=='1') selected="selected" @endif >Kích hoạt</option>
								<option value="0" @if(old('status')=='0') selected="selected" @endif >Không kích hoạt</option>
							</select>
							@if($errors->has('status'))<p style="color: red;">{!!$errors->first('status')!!}</p>@endif
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10">
							{!!Form::submit('Save',['class'=>'btn btn-primary'])!!}
							<a class="btn btn-default" id="cancel" href="{{url('user/create')}}">Reset</a>
						</div>
					</div>
					{!!Form::close()!!}
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	$('#register_form').validate({
		rules:{
			username:{
				minlength:3,
				maxlength:100,
				required:true,
				remote: {
					url: "{{url('admin/ajax/checkUsername')}}",
					type: "get",
					data: {
						username: function() {
							return $( "#username" ).val();
						}
					}
				},
			},
			store:{
				required:true,
			},
			email:{
				required:true,
				remote: {
					url: "{{url('admin/ajax/checkEmail')}}",
					type: "get",
					data: {
						email: function() {
							return $( "#email" ).val();
						}
					}
				},
			},
			password:{
				required:true,
				minlength:6,
				maxlength:30,
			},
			password_confirmation:{
				required:true,
				equalTo: "#password"
			},
			status:{
				required:true,
			}
		},
		messages:{
			username:{
				minlength:"Tên đăng nhập quá ngắn",
				maxlength:"Tên đăng nhập quá dài",
				required:"Tên đăng nhập không được để trống",
				remote:"Tên đăng nhập đã tồn tại",
			},
			email:{
				required:"email không được để trống",
				remote:"email đã tồn tại",
				email:"Không đúng định dạng email"
			},
			store:{
				required:"store không được để trống",
			},
			password:{
				required:"Mật khẩu không khớp không được để trống",
				minlength:"mật khẩu phải từ 6->30 ký tự",
				maxlength:"mật khẩu phải từ 6->30 ký tự",
			},
			password_confirmation:{
				required:"nhập lại không được để trống",
				equalTo:"Mật khẩu không khớp"
			},
			status:{
				required:"trạng thái không được để trống",
			}
		}
	});
</script>
@stop