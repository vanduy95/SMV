@extends('home_page.master')
@section('style')
<style>
	.div-center{
		display: flex !important;
		align-items: center;
		justify-content: center;
	}
	ul.nav.nav-tabs{
		display: flex;
		justify-content: center;
	}
	.div-comment{
		color: red;
		font-style: italic;
	}
	.error{
		color:red;
	}
	.center-label{
		display: flex;
		align-items: center;
		justify-content: right;
	}
	.background-content{
		background: none !important;
		text-align: center;
	}
	.form-top{
		margin-top: 15px;
	}
	.form-group{
		margin-bottom: 5px!important;
	}
	.error{
		margin-bottom: 0px;
	}
	a{
		border: 0px!important;
	}
	li{
		margin-right: 10px;
	}
	.nav-tabs {
		border-bottom: 0px!important;
	}
	.nav-tabs>li{
		border-bottom: 4px solid;
		font-size: 20px;
		font-weight: bold;
	}
	.nav-tabs>li.active>a{
		color: #337ab7;
		background: none!important;
	}
	.nav>li>a:hover {
		background: none!important;
	}	
</style>
{!!Html::script('js/validate/validate_user.js')!!}
@stop
@section('content')
<div class="col-lg-12" style="background: url('../img/home_page/accountant.png') no-repeat; background-size: 100% 100%;padding: 0">
	<div class="pb-5 col-lg-12 div-center" style="background: rgba(255,255,255,0.7);">
		<div class="my-5 col-lg-6 " style="padding: 0;background: rgba(255,255,255,0.8); top: 10px">
			<div class="col-lg-12 " style="padding: 0;margin-top: 25px;">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#ctv">Dành cho cộng tác viên</a></li>
					<li><a data-toggle="tab" href="#dt">Dành cho đối tác</a></li>
				</ul>
			</div>
			<div class="tab-content" >
				<div id="ctv" class="tab-pane fade in active">
					<form action="{{route('accountcreate')}}" method="post" class="form-validate form-horizontal" id="register_form">
						{{csrf_field()}}
						<div class="pb-5 col-lg-12" >
							<input type="hidden" name="ctv" id="hidden">
							<div class="form-group form-top ">
								{!!Html::decode(Form::label('fullname','Tên đăng nhập ',['class'=>'control-label col-lg-4']))!!}
								<div class="col-lg-6">
									{!! Form::text('username','',['class'=>'form-control']) !!}
									@if($errors->has('username'))<p style="color: red;">{{$errors->first('username')}}</p>@endif
								</div>
							</div>
							<div class="form-group ">
								{!!Html::decode(Form::label('fullname','Địa chỉ email',['class'=>'control-label col-lg-4']))!!}
								<div class="col-lg-6">
									{!! Form::text('email','',['class'=>'form-control','placeholder'=>' ']) !!}
									@if($errors->has('email'))<p style="color: red;">{{$errors->first('email')}}</p>@endif
								</div>
							</div>
							<div class="form-group ">
								{!!Html::decode(Form::label('fullname','Họ và tên ',['class'=>'control-label col-lg-4']))!!}
								<div class="col-lg-6">
									{!! Form::text('fullname','',['class'=>'form-control','placeholder'=>' ']) !!}
									@if($errors->has('fullname'))<p style="color: red;">{{$errors->first('fullname')}}</p>@endif
								</div>
							</div>
							<div class="form-group ">
								{!!Html::decode(Form::label('fullname','Số điện thoại ',['class'=>'control-label col-lg-4']))!!}
								<div class="col-lg-6">
									{!! Form::text('phone','',['class'=>'form-control','placeholder'=>' ']) !!}
									@if($errors->has('phone'))<p style="color: red;">{{$errors->first('phone')}}</p>@endif
								</div>
							</div>
							<div class="form-group ">
								{!!Html::decode(Form::label('fullname','Địa chỉ ',['class'=>'control-label col-lg-4']))!!}
								<div class="col-lg-6">
									{!! Form::text('address','',['class'=>'form-control','placeholder'=>' ']) !!}
									@if($errors->has('address'))<p style="color: red;">{{$errors->first('address')}}</p>@endif
								</div>
							</div>
							<div class="form-group ">
								{!!Html::decode(Form::label('fullname','Mật khẩu ',['class'=>'control-label col-lg-4']))!!}
								<div class="col-lg-6">
									<input type="password" name="password" id="password" class="form-control" autocomplete="off">
									@if($errors->has('password'))<p style="color: red;">{{$errors->first('password')}}</p>@endif
								</div>
							</div>
							<div class="form-group ">
								{!!Html::decode(Form::label('fullname','Xác nhận mật khẩu ',['class'=>'control-label col-lg-4']))!!}
								<div class="col-lg-6">
									<input type="password" name="passwordconfirm" id="passwordconfirm" class="form-control" autocomplete="off">
									@if($errors->has('passwordconfirm'))<p style="color: red;">{{$errors->first('passwordconfirm')}}</p>@endif
								</div>
							</div>
							<div class=" col-lg-12 col-xs-18 col-md-12 form-group div-center">
								<input class="btn btn-primary col-lg-2 col-md-4 col-xs-9" style="background: #160d65" type="submit" value="Đăng ký">
							</div>
						</div>
					</form>
				</div>
				<div id="dt" class="tab-pane fade">
					<form action="{{route('accountcreate')}}" method="post" class="form-validate form-horizontal" id="dt_form">
						{{csrf_field()}}
						<div class="pb-5 col-lg-12" >
							<input type="hidden" name="dt" id="hiddendt">
							<div class="form-group form-top ">
								<label for="" class="control-label col-lg-4">Hệ thống siêu thị:</label>
								<div class="col-lg-6">
									<select name="select_market" id="select_market" class="form-control" >
										<option>Hệ thống siêu thị</option>
										@foreach ($name as $n)
										<option value="{{$n}}">{{$n}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group ">
								<label for="" class="control-label col-lg-4">Thành phố:</label>
								<div class="col-lg-6">
									<select  name="select_city" id="select_city" class="form-control">
										<optgroup style="height: 65px;">
											<option value="">Chọn thành phố</option>
											@foreach ($city as $c)
											<option value="{{$c}}">{{$c}}</option>
											@endforeach
										</optgroup>
									</select>
									<div class="clear"></div>
								</div>
							</div>
							<div class="form-group">
								<label for="" class="control-label col-lg-4">Quận/Huyện</label>
								<div class="col-lg-6 padding-div">
									<select name="select_dis" id="select_dis" class="form-control">
										<option value="">Chọn Quận</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								{!!Form::label('fullname','Cửa hàng',['class'=>'control-label col-lg-4 '])!!}
								<div class="col-lg-6 padding-div">
									<select name="select_store" id="select_store" class="form-control">
										<option value="">Chọn cửa hàng</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								{!!Html::decode(Form::label('fullname','Tên đăng nhập ',['class'=>'control-label col-lg-4']))!!}
								<div class="col-lg-6">
									{!! Form::text('usernamedt','',['class'=>'form-control','placeholder'=>' ']) !!}
									@if($errors->has('usernamedt'))<p style="color: red;">{{$errors->first('usernamedt')}}</p>@endif
								</div>
							</div>
							<div class="form-group ">
								{!!Html::decode(Form::label('fullname','Địa chỉ email',['class'=>'control-label col-lg-4']))!!}
								<div class="col-lg-6">
									{!! Form::text('emaildt','',['class'=>'form-control','placeholder'=>' ']) !!}
									@if($errors->has('emaildt'))<p style="color: red;">{{$errors->first('emaildt')}}</p>@endif
								</div>
							</div>
							<div class="form-group ">
								{!!Html::decode(Form::label('fullname','Họ và tên ',['class'=>'control-label col-lg-4']))!!}
								<div class="col-lg-6">
									{!! Form::text('fullnamedt','',['class'=>'form-control','placeholder'=>' ']) !!}
									@if($errors->has('fullnamedt'))<p style="color: red;">{{$errors->first('fullnamedt')}}</p>@endif
								</div>
							</div>
							<div class="form-group ">
								{!!Html::decode(Form::label('fullname','Số điện thoại ',['class'=>'control-label col-lg-4']))!!}
								<div class="col-lg-6">
									{!! Form::text('phonedt','',['class'=>'form-control','placeholder'=>' ']) !!}
									@if($errors->has('phonedt'))<p style="color: red;">{{$errors->first('phonedt')}}</p>@endif
								</div>
							</div>
							<div class="form-group ">
								{!!Html::decode(Form::label('fullname','Địa chỉ ',['class'=>'control-label col-lg-4']))!!}
								<div class="col-lg-6">
									{!! Form::text('addressdt','',['class'=>'form-control','placeholder'=>' ']) !!}
									@if($errors->has('addressdt'))<p style="color: red;">{{$errors->first('addressdt')}}</p>@endif
								</div>
							</div>
							<div class="form-group ">
								{!!Html::decode(Form::label('fullname','Mật khẩu ',['class'=>'control-label col-lg-4']))!!}
								<div class="col-lg-6">
									<input type="password" name="passworddt" id="passworddt" class="form-control" autocomplete="off">
									@if($errors->has('passworddt'))<p style="color: red;">{{$errors->first('passworddt')}}</p>@endif
								</div>
							</div>
							<div class="form-group ">
								{!!Html::decode(Form::label('fullname','Xác nhận mật khẩu ',['class'=>'control-label col-lg-4']))!!}
								<div class="col-lg-6">
									<input type="password" name="passwordconfirmdt" id="passwordconfirmdt" class="form-control" autocomplete="off">
									@if($errors->has('passwordconfirmdt'))<p style="color: red;">{{$errors->first('passwordconfirmdt')}}</p>@endif
								</div>
							</div>

							<div class=" col-lg-12 col-xs-18 col-md-12 form-group div-center">
								<input class="btn btn-primary col-lg-2 col-md-4 col-xs-9" style="background: #160d65" type="submit" value="Đăng ký">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@stop