@extends('layouts.master')
@section('content')
<section class="content-header">
	<h1>
		Quản lý khách hàng
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#">User</a></li>
		<li class="active">Edit user</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Sửa khách hàng</h3>
				</div>
				<div class="panel-body">
					{!!Form::open(array('class'=>'form-validate form-horizontal','id'=>'register_form','enctype'=>"multipart/form-data",'action'=>['UserInfoController@show',$userinfo->id]))!!}
					@if(session('notify'))
					<div class="alert bg-teal disabled color-palette">
						{{session('notify')}}
					</div>
					@endif
					<div class="form-group ">
						{!!Html::decode(Form::label('fullname','Tên đăng nhập <span class="required">*</span>',['class'=>'control-label col-lg-2']))!!}
						<div class="col-lg-8">
							{!!Form::text('username',$user->username,['class'=>'form-control','placeholder'=>'Tên người dùng '])!!}
							@if($errors->has('username'))<p style="color: red;">{!!$errors->first('username')!!}</p>@endif
						</div>
					</div>
					<div class="form-group ">
						{!!Html::decode(Form::label('fullname','Nhóm <span class="required">*</span>',['class'=>'control-label col-lg-2']))!!}
						<div class="col-lg-8">
							<select class="form-control" name="groupuser_id">
								<option value="">Nhóm user</option>
								@foreach($groupuser as $gu)
								<option @if($gu->id == $user->groupuser_id)
									{{"selected"}}
									@endif
									value="{{$gu->id}}">{{$gu->name}}</option>
									@endforeach
								</select>
								@if($errors->has('groupuser_id'))<p style="color: red;">{!!$errors->first('groupuser_id')!!}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Email <span class="required">*</span>',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								{!!Form::text('email',$user->email,['class'=>'form-control','placeholder'=>'Email '])!!}
								@if($errors->has('email'))<p style="color: red;">{!!$errors->first('email')!!}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Mật khẩu <span class="required">*</span>',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								<input type="password" name="password" value="{{$user->password}}" class="form-control" readonly="">
								<span><a href="{{url('changepassword',$user->id) }}">Change password</a></span>
								@if($errors->has('password'))<p style="color: red;">{!!$errors->first('password')!!}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Công ty/Chi nhánh *',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-4">
								<select class="form-control" name="organization">
									<option value="">Tổ chức</option>
									@foreach($organization as $organ)
									<option value="{{$organ->id}}" @if(old('organization')==$organ->id) selected="selected" @endif @if($user->organization_id==$organ->id){{"selected"}}@endif>{{$organ->name}}</option>
									@endforeach
								</select>
								@if($errors->has('organization'))<p style="color: red;">{!!$errors->first('organization')!!}</p>@endif
							</div>
							<div class="col-lg-4">
								<select class="form-control" name="status">
									<option value="">Trạng thái tài khoản</option>
									<option value="1" @if(old('status')=='1') selected="selected" @endif @if($user->status==1){{"selected"}}@endif >Kích hoạt</option>
									<option value="0" @if(old('status')=='0') selected="selected" @endif @if($user->status==0){{"selected"}}@endif>Không kích hoạt</option>
								</select>
								@if($errors->has('status'))<p style="color: red;">{!!$errors->first('status')!!}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Họ tên *',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								{!!Form::text('fullname',$userinfo->fullname,['class'=>'form-control','placeholder'=>'Họ tên khách hàng '])!!}
								@if($errors->has('fullname'))<p style="color: red;">{!!$errors->first('fullname')!!}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Mã nhân viên *',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								{!!Form::text('employee_id',$userinfo->employee_id,['class'=>'form-control','placeholder'=>'Mã nhân viên'])!!}
								@if($errors->has('employee_id'))<p style="color: red;">{!!$errors->first('employee_id')!!}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Lương *',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								{!!Form::text('salary',$userinfo->salary,['class'=>'form-control','placeholder'=>'Lương ','id'=>'salary'])!!}
								@if($errors->has('salary'))<p style="color: red;">{!!$errors->first('salary')!!}</p>@endif
							</div>
						</div>
						<div class="form-group">
							{!!Html::decode(Form::label('fullname','Số chứng minh nhân dân *',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-3">
								{!!Form::number('identitycard',$userinfo->identitycard,['class'=>'form-control','placeholder'=>'Số chứng minh nhân dân', 'maxlength'=>'12','min'=>'0'])!!}
								@if($errors->has('identitycard'))<p style="color: red;">{!!$errors->first('identitycard')!!}</p>@endif
							</div>
							<div class="col-lg-3">
								{!!Form::text('issuedby',$userinfo->issuedby,['class'=>'form-control','placeholder'=>'Nơi cấp'])!!}
								@if($errors->has('issuedby'))<p style="color: red;">{!!$errors->first('issuedby')!!}</p>@endif
							</div>
							<div class="col-lg-2 date">
								<input type="text" name="dateissue" class="form-control pull-right" id="datepicker" placeholder="Ngày cấp" value="{{$userinfo->dateissue}}" >
								@if($errors->has('dateissue'))<p style="color: red;">{!!$errors->first('dateissue')!!}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('assess','Điểm khách hàng *',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-4">
								<select class="form-control" name="assess">
									<option value="">Điểm khách hàng</option>
									@foreach($assess as $asse)
									<option @if($asse->id == $userinfo->assess_id)
										{{"selected"}}
										@endif
										value="{{$asse->id}}">{{$asse->reted."-".$asse->reviews}}</option>
										@endforeach
									</select>
									@if($errors->has('assess'))<p style="color: red;">{!!$errors->first('assess')!!}</p>@endif
								</div>
								<div class="col-lg-4">
									<select class="form-control" name="marital">
										<option value="">Tình trạng hôn nhân</option>
										<option value="1" @if($userinfo->maritalstatus =='1') selected="selected" @endif>Đã kết hôn</option>
										<option value="2" @if($userinfo->maritalstatus =='2') selected="selected" @endif>Chưa kết hôn</option>
									</select>
									@if($errors->has('marital'))<p style="color: red;">{!!$errors->first('marital')!!}</p>@endif
								</div>
							</div>
							<div class="form-group">
								{!!Html::decode(Form::label('fullname','Ngày sinh *',['class'=>'control-label col-lg-2']))!!}
								<div class="col-lg-4 date">
									<input type="text" name="birthday" class="form-control pull-right" id="datepicker1" placeholder="Ngày sinh" value="{{$userinfo->birthday}}" >
									@if($errors->has('birthday'))<p style="color: red;">{!!$errors->first('birthday')!!}</p>@endif
								</div>
								<div class="col-lg-4">
									<select class="form-control" name="sex">
										<option value="">Giới tính</option>
										<option value="1" @if($userinfo->sex=='1') selected="selected" @endif>Nam</option>
										<option value="2" @if($userinfo->sex=='2') selected="selected" @endif>Nữ</option>
										<option value="0" @if($userinfo->sex=='0') selected="selected" @endif>KXD</option>
									</select>
									@if($errors->has('sex'))<p style="color: red;">{!!$errors->first('sex')!!}</p>@endif
								</div>
							</div>
							<div class="form-group ">
								{!!Html::decode(Form::label('assess','Số điện thoại *',['class'=>'control-label col-lg-2']))!!}
								<div class="col-lg-4">
									<input type="text" class="form-control" name="phone1"  placeholder="Điện thoại di động" data-inputmask='"mask": "(999) 999-9999"' data-mask value="{{$userinfo->phone1}}">
									@if($errors->has('phone1'))<p style="color: red;">{!!$errors->first('phone1')!!}</p>@endif
								</div>
								<div class="col-lg-4">
									<input type="text" class="form-control" name="phone2"  placeholder="Điện thoại di động" data-inputmask='"mask": "(999) 999-9999"' data-mask value="{{$userinfo->phone2}}">
									@if($errors->has('phone2'))<p style="color: red;">{!!$errors->first('phone2')!!}</p>@endif
								</div>
							</div>

							<div class="form-group ">
								{!!Html::decode(Form::label('fullname','Địa chỉ thường trú ',['class'=>'control-label col-lg-2']))!!}
								<div class="col-lg-4">
									{!!Form::text('address1',$userinfo->address1,['class'=>'form-control','placeholder'=>'Địa chỉ thường trú'])!!}
									@if($errors->has('address'))<p style="color: red;">{!!$errors->first('address')!!}</p>@endif
								</div>
								<div class="col-lg-4">
									<input type="text" class="form-control" name="phone3"  placeholder="Điện thoại cố định" data-inputmask='"mask": "(999) 999-9999"' data-mask value="{{$userinfo->phone3}}">
									@if($errors->has('phone3'))<p style="color: red;">{!!$errors->first('phone3')!!}</p>@endif
								</div>
							</div>
							<div class="form-group ">
								{!!Html::decode(Form::label('fullname','Địa chỉ tạm trú ',['class'=>'control-label col-lg-2']))!!}
								<div class="col-lg-4">
									{!!Form::text('address2',$userinfo->address2,['class'=>'form-control','placeholder'=>'Địa chỉ tạm trú'])!!}
									@if($errors->has('address'))<p style="color: red;">{!!$errors->first('address')!!}</p>@endif
								</div>
								<div class="col-lg-4">
									<input type="text" class="form-control" name="phone4"  placeholder="Điện thoại cố định" data-inputmask='"mask": "(999) 999-9999"' data-mask value="{{$userinfo->phone4}}">
									@if($errors->has('phone4'))<p style="color: red;">{!!$errors->first('phone4')!!}</p>@endif
								</div>
							</div>
							<div class="form-group ">
								{!!Form::label('fullname','Chữ ký khách hàng ',['class'=>'control-label col-lg-2'])!!}
								<div class="col-lg-8">
										<p><img width="200px" height="100px" src="{{url('/uploadfile/'.$userinfo->image1)}}"></p>
										{!!Form::file('filename1',['class'=>'form-control'])!!}
										@if($errors->has('filename1'))<p style="color: red;">{{$errors->first('filename1')}}</p>@endif
								</div>
							</div>
							<div class="form-group ">
								{!!Form::label('fullname','Ảnh chụp khách hàng ',['class'=>'control-label col-lg-2'])!!}
								<div class="col-lg-8">
									<p><img width="200px" height="100px" src="{{url('/uploadfile/'.$userinfo->image2)}}"></p>
										{!!Form::file('filename2',['class'=>'form-control'])!!}
										@if($errors->has('filename2'))<p style="color: red;">{{$errors->first('filename2')}}</p>@endif
								</div>
							</div>
							<div class="form-group ">
								{!!Form::label('fullname','Ảnh chứng minh thư :',['class'=>'control-label col-lg-2'])!!}
								<div class="col-lg-8">
									<p>
										@foreach (explode("***",$userinfo->identitycard_image) as $img)
										@if ($img!='')
											<img width="400px" height="300px" src="{{url('/uploadfile/userinfo/'.$img)}}">
											@endif
										@endforeach
										
									</p>
								</div>
							</div>
							<div class="form-group ">
								{!!Form::label('fullname','Ảnh sổ hộ khẩu :',['class'=>'control-label col-lg-2'])!!}
								<div class="col-lg-8">
									<p>
										@foreach (explode("***",$userinfo->household_image) as $img)
										@if ($img!='')
											<img width="400px" height="300px" src="{{url('/uploadfile/userinfo/'.$img)}}">
											@endif
										@endforeach
									</p>
								</div>
							</div>
							<div class="form-group ">
								{!!Form::label('fullname','Ảnh hóa đơn điện, nước, điện thoại : ',['class'=>'control-label col-lg-2'])!!}
								<div class="col-lg-8">
									<p>
										@foreach (explode("***",$userinfo->bill_image) as $img)
										@if ($img!='')
											<img width="400px" height="300px" src="{{url('/uploadfile/userinfo/'.$img)}}">
											@endif
										@endforeach
									</p>
								</div>
							</div>
							<div class="form-group ">
								{!!Form::label('fullname','Ảnh giấy tờ thể hiện nơi làm việc :',['class'=>'control-label col-lg-2'])!!}
								<div class="col-lg-8">
									<p>
										@foreach (explode("***",$userinfo->other_image) as $img)
										@if ($img!='')
											<img width="400px" height="300px" src="{{url('/uploadfile/userinfo/'.$img)}}">
											@endif
										@endforeach
									</p>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									{!!Form::submit('Save',['class'=>'btn btn-primary'])!!}
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
				$('#datepicker').datepicker({ format: 'yyyy-mm-dd' }).val();
				$('#datepicker1').datepicker({ dateFormat: 'yyyy-mm-dd' }).val();

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