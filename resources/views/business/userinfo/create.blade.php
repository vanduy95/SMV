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
					{!!Form::open(array('class'=>'form-validate form-horizontal','id'=>'register_form','enctype'=>"multipart/form-data",'action'=>['UserInfoController@postcreate']))!!}
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
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Full Name *',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								{!!Form::text('fullname',old('fullname'),['class'=>'form-control','placeholder'=>'Họ tên khách hàng '])!!}
								@if($errors->has('fullname'))<p style="color: red;">{!!$errors->first('fullname')!!}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Employee ID *',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								{!!Form::text('employee_id',old('employee_id'),['class'=>'form-control','placeholder'=>'Mã nhân viên'])!!}
								@if($errors->has('employee_id'))<p style="color: red;">{!!$errors->first('employee_id')!!}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Salary *',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								{!!Form::text('salary',old('salary'),['class'=>'form-control','placeholder'=>'Lương ','id'=>'salary'])!!}
								@if($errors->has('salary'))<p style="color: red;">{!!$errors->first('salary')!!}</p>@endif
							</div>
						</div>
						<div class="form-group">
							{!!Html::decode(Form::label('fullname','Identity Card *',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-3">
								{!!Form::number('identitycard',old('identitycard'),['class'=>'form-control','placeholder'=>'Số chứng minh nhân dân', 'maxlength'=>'12','min'=>'0'])!!}
								@if($errors->has('identitycard'))<p style="color: red;">{!!$errors->first('identitycard')!!}</p>@endif
							</div>
							<div class="col-lg-3">
								{!!Form::text('issuedby',old('issuedby'),['class'=>'form-control','placeholder'=>'Nơi cấp'])!!}
								@if($errors->has('issuedby'))<p style="color: red;">{!!$errors->first('issuedby')!!}</p>@endif
							</div>
							<div class="col-lg-2">
								<input type="text" name="dateissue" class="form-control pull-right" id="datepicker" placeholder="Ngày cấp" >
								@if($errors->has('dateissue'))<p style="color: red;">{!!$errors->first('dateissue')!!}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('assess','Reviews *',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-4">
								{!!Form::text('assess',old('assess'),['class'=>'form-control','placeholder'=>'Điểm khách hàng thang điểm 100'])!!}
								@if($errors->has('assess'))<p style="color: red;">{!!$errors->first('assess')!!}</p>@endif
							</div>
							<div class="col-lg-4">
								<select class="form-control" name="marital">
									<option value="">Tình trạng hôn nhân</option>
									<option value="1" @if(old('marital')=='1') selected="selected" @endif>Đã kết hôn</option>
									<option value="2" @if(old('marital')=='2') selected="selected" @endif>Chưa kết hôn</option>
								</select>
								@if($errors->has('marital'))<p style="color: red;">{!!$errors->first('marital')!!}</p>@endif
							</div>
						</div>
						<div class="form-group">
							{!!Html::decode(Form::label('fullname','Birth Day *',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-4 date">
								<input type="text" name="birthday" class="form-control pull-right" id="datepicker1" placeholder="Ngày sinh" >
								@if($errors->has('birthday'))<p style="color: red;">{!!$errors->first('birthday')!!}</p>@endif
							</div>
							<div class="col-lg-4">
								<select class="form-control" name="sex">
									<option value="">Giới tính</option>
									<option value="1" @if(old('sex')=='1') selected="selected" @endif>Nam</option>
									<option value="2" @if(old('sex')=='2') selected="selected" @endif>Nữ</option>
									<option value="0" @if(old('sex')=='0') selected="selected" @endif>KXD</option>
								</select>
								@if($errors->has('sex'))<p style="color: red;">{!!$errors->first('sex')!!}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('assess','Phone *',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-4">
								<input type="text" class="form-control" name="phone1"  placeholder="Điện thoại di động" data-inputmask='"mask": "(999) 999-9999"' data-mask>
								@if($errors->has('phone1'))<p style="color: red;">{!!$errors->first('phone1')!!}</p>@endif
							</div>
							<div class="col-lg-4">
								<input type="text" class="form-control" name="phone2"  placeholder="Điện thoại di động" data-inputmask='"mask": "(999) 999-9999"' data-mask>
								@if($errors->has('phone2'))<p style="color: red;">{!!$errors->first('phone2')!!}</p>@endif
							</div>
						</div>

						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Permanent address ',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-4">
								{!!Form::text('address1',old('address1'),['class'=>'form-control','placeholder'=>'Địa chỉ thường trú'])!!}
								@if($errors->has('address'))<p style="color: red;">{!!$errors->first('address')!!}</p>@endif
							</div>
							<div class="col-lg-4">
								<input type="text" class="form-control" name="phone3"  placeholder="Điện thoại cố định" data-inputmask='"mask": "(999) 999-9999"' data-mask>
								@if($errors->has('phone3'))<p style="color: red;">{!!$errors->first('phone3')!!}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Temporary address ',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-4">
								{!!Form::text('address2',old('address2'),['class'=>'form-control','placeholder'=>'Địa chỉ tạm trú'])!!}
								@if($errors->has('address'))<p style="color: red;">{!!$errors->first('address')!!}</p>@endif
							</div>
							<div class="col-lg-4">
								<input type="text" class="form-control" name="phone4"  placeholder="Điện thoại cố định" data-inputmask='"mask": "(999) 999-9999"' data-mask>
								@if($errors->has('phone4'))<p style="color: red;">{!!$errors->first('phone4')!!}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Form::label('fullname','Chữ ký khách hàng ',['class'=>'control-label col-lg-2'])!!}
							<div class="col-lg-8">
							{!!Form::file('filename1',['class'=>'form-control',])!!}
								@if($errors->has('filename1'))<p style="color: red;">{{$errors->first('filename1')}}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Form::label('fullname','Ảnh chụp khách hàng ',['class'=>'control-label col-lg-2'])!!}
							<div class="col-lg-8">
								{!!Form::file('filename2',['class'=>'form-control'])!!}
								@if($errors->has('filename2'))<p style="color: red;">{{$errors->first('filename2')}}</p>@endif
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
		$('#datepicker1').datepicker({ dateFormat: 'dd-mm-yy' }).val();

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