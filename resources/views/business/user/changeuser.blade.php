@extends('home_page.master')
@section('style')
<style>
	.div-center{
		display: flex;
		justify-content: center;
		align-items: center;
	}
	body{
		min-height: 96.9% !important;
	}
	label,p,span,h1,h2,h3,h4,h5,h6{
		font-family: Arial !important;
	}
	input[type=submit],input[type=reset]{
		font-weight: bold;
	}
	input[type=submit]:hover,input[type=reset]:hover{
		background: rgba(0, 0, 0,0.6);
		color: white;
		font-weight: bold;
		transition: all 0.5s;
	}
	label{
		font-size: 16px;
	}
</style>
@stop
@section('script')
<script>
	$(document).ready(function(){
		var url  = "http://"+document.location.host+"/user/checkuser";
		$('#username').keyup(function(){
			var val = $('#username').val();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				type:"post",
				url:url,
				data:{
					username: val,
				},
				dataType: "json",
				success: function(res){
					if(res.success=='success'){
						$('#error_user').text('');
						$("#click_send").prop('disabled',false);
						$('#success').show();
						
					}
					else{
						$('#success').hide();
						$("#click_send").prop('disabled',true);
						$('#er_request').text('');	
						$('#error_user').text(res);
					}
				},
				error: function(data){
					console.log("Error_username: ");
				},
			});
		});
	});
</script>
@stop
@section('content')
<div class=" background-content" style="position: fixed;width: 100%; min-height: 100%;opacity: 0.8">
</div>
<div class="col-lg-12 form-group">
	<h1 style="text-align: center;">Tạo tài khoản</h1>
</div>
<div class="col-lg-12 div-center form-group">
	<form class="col-lg-6 form-group" method="post" action="/change/user" style="background: rgba(128, 128, 128, 0.3)">
		{{ csrf_field() }}
		<div class="col-lg-12 text-center form-group">
			<h2>Nhập thông tin</h2>
		</div>
		<div class="col-lg-12 form-group">
			<div class="col-lg-12">
				<div class="col-lg-4">
					<label for="">Tên đăng nhập: </label>
				</div>
				<div class="col-lg-7">
					<input id="username" name="username" class="form-control" type="text" autocomplete="off">
					<span id="error_user" style="color: red;"></span>
					<i id="success" style="font-size: 2em;color: #59d30c;margin: 0;display: none" class="fa fa-check-circle-o fa-6" aria-hidden="true"> Tài khoản hợp lệ</i>
					@if($errors->has('username'))<span id="er_request" style="color: red;">{{$errors->first('username')}}</span>@endif
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="col-lg-12 form-group">
			<div class="col-lg-12">
				<div class="col-lg-4">
					<label for="">Mật khẩu: </label>
				</div>
				<div class="col-lg-7">
					<input id="password" name="password" class="form-control" type="text" autocomplete="on">
					@if($errors->has('password'))<span style="color: red;">{{$errors->first('password')}}</span>@endif
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="col-lg-12 form-group">
			<div class="col-lg-12">
				<div class="col-lg-4">
					<label for="">Nhập lại mật khẩu: </label>
				</div>
				<div class="col-lg-7">
					<input id="re_password" name="re_password" class="form-control" type="text" autocomplete="off">
					@if($errors->has('re_password'))<span style="color: red;">{{$errors->first('re_password')}}</span>@endif
					@if(Session::has('mess_re'))
					<span style="color: red">{{ Session::get('mess_re')}}</span>
					@endif
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="col-lg-12 form-group">
			<div class="col-lg-12">
				<div class="col-lg-6 div-center">
					<input id="click_send" type="submit" class="btn btn-primary col-lg-6">
				</div>
				<div class="col-lg-6 div-center">
					<input class="btn btn-primary col-lg-6" type="reset">
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</form>
</div>
<div class="clear"></div>
@stop