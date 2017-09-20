

<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="panel-body">
				<div class="form">
					{!!Form::open(array('class'=>'form-validate form-horizontal','id'=>'form_edit_user','action'=>['UserController@show',$user->id]))!!}
					<input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
					@if(session('notify'))
					<div class="alert bg-teal disabled color-palette">
						{{session('notify')}}
					</div>
					@endif
					<div class="form-group ">
						{!!Html::decode(Form::label('fullname','Tên đăng nhập <span class="required">*</span>',['class'=>'control-label col-lg-2']))!!}
						<div class="col-lg-8">
							{!!Form::text('username',$user->username,['class'=>'form-control','placeholder'=>'Tên người dùng ','id'=>'username'])!!}
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
								{!!Form::text('email',$user->email,['class'=>'form-control','placeholder'=>'Email ','id'=>'email'])!!}
								@if($errors->has('email'))<p style="color: red;">{!!$errors->first('email')!!}</p>@endif
								<label id="email_er" style="color: red" for="email">Email đã tồn tại</label>
							</div>
						</div>

						<div class="form-group ">
							{!!Html::decode(Form::label('status','Trạng thái <span class="required">*</span>',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-4">
								<select class="form-control" name="status">
									<option value="">Trạng thái tài khoản</option>
									<option value="1" @if(old('status')=='1') selected="selected" @endif @if($user->status==1){{"selected"}}@endif >Kích hoạt</option>
									<option value="0" @if(old('status')=='0') selected="selected" @endif @if($user->status==0){{"selected"}}@endif>Không kích hoạt</option>
								</select>
								@if($errors->has('status'))<p style="color: red;">{!!$errors->first('status')!!}</p>@endif
							</div>
						</div>
						{!!Form::close()!!}
					</div>
				</div>
			</div>
		</div>
	</section>
	<script>
		$(function(){
			if ($('#syslock').is(':checked') == true && $('#syslock').val()==1) {
				$('#hidden').removeClass('hidden');
				$('#grouphidden').removeClass('hidden');
			}
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
		$('#datepicker').datepicker();
		$(document).ready(function() {
			$('#email_er').hide();
		});
	</script>