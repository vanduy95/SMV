@extends('layouts.master')
@section('content')
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
							{!!Form::text('username',old('username'),['class'=>'form-control','placeholder'=>'Tên người dùng '])!!}
							@if($errors->has('username'))<p style="color: red;">{!!$errors->first('username')!!}</p>@endif
						</div>
					</div>
					<div class="form-group ">
						{!!Html::decode(Form::label('fullname','Group User *',['class'=>'control-label col-lg-2']))!!}
						<div class="col-lg-8">
							<select class="form-control" name="groupuser_id">
								<option value="">Nhóm user</option>
								@foreach($groupuser as $gu)
								<option value="{{$gu->id}}" @if(old('groupuser_id')==$gu->id) selected="selected" @endif >{{$gu->name}}</option>
								@endforeach
							</select>
							@if($errors->has('groupuser_id'))<p style="color: red;">{!!$errors->first('groupuser_id')!!}</p>@endif
						</div>
					</div>
					<div class="form-group ">
						{!!Html::decode(Form::label('fullname','Email *',['class'=>'control-label col-lg-2']))!!}
						<div class="col-lg-8">
							{!!Form::text('email',old('email'),['class'=>'form-control','placeholder'=>'Email '])!!}
							@if($errors->has('email'))<p style="color: red;">{!!$errors->first('email')!!}</p>@endif
						</div>
					</div>
					<div class="form-group ">
						{!!Html::decode(Form::label('fullname','Password *',['class'=>'control-label col-lg-2']))!!}
						<div class="col-lg-8">
							{!!Form::password('password',['class'=>'form-control','placeholder'=>'Mật khẩu'])!!}
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
						{!!Html::decode(Form::label('fullname','Công ty/Chi nhánh *',['class'=>'control-label col-lg-2']))!!}
						<div class="col-lg-4">
							<select class="form-control" name="organization">
								<option value="">Tổ chức</option>
								@foreach($organization as $organ)
								<option value="{{$organ->id}}" @if(old('organization')==$organ->id) selected="selected" @endif >{{$organ->name}}</option>
								@endforeach
							</select>
							@if($errors->has('organization'))<p style="color: red;">{!!$errors->first('organization')!!}</p>@endif
						</div>
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
							{!!Form::reset('Nhập lại',['class'=>'btn btn-primary'])!!}
						</div>
					</div>
					{!!Form::close()!!}
				</div>
			</div>
		</div>
	</div>
</section>
@stop
@section('script')
<!-- bootstrap color picker -->
{!!Html::script('/theme/plugins/colorpicker/bootstrap-colorpicker.min.js')!!}
{!!Html::script('theme/plugins/input-mask/jquery.inputmask.js')!!}
{!!Html::script('theme/plugins/input-mask/jquery.inputmask.date.extensions.js')!!}
{!!Html::script('theme/plugins/input-mask/jquery.inputmask.extensions.js')!!}
<script>
	$(function(){
		$("[data-mask]").inputmask();
		if ($('#syslock').is(':checked') == true && $('#syslock').val()==1) {
			$('#hidden').removeClass('hidden');
			$('#grouphidden').removeClass('hidden');
		}
		$('#datepicker').datepicker({ dateFormat: 'dd-mm-yy' }).val();
	});
	$('#syslock').change(function() {
		if ($('#syslock').is(':checked') == true) {
			$('#hidden').removeClass('hidden');
			$('#grouphidden').removeClass('hidden');
		} else {
			$('#hidden').addClass('hidden');
			$('#grouphidden').addClass('hidden');
		}

	});
	$('#salary').keyup(function() {
		var val = this.value.replace(/\D/g, '');
		var newVal = '';
		while (val.length > 3) {
			newVal += val.substr(0, 3) + ' ';
			val = val.substr(3);
		}
		newVal += val;
		this.value = newVal;
	});
</script>
@stop