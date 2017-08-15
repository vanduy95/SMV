@extends('sucmua.master')
<style>
	.select_company option:hover{
		background: rgba(29, 33, 41,0.3);
		cursor: pointer;
		border-radius: none;
	}
	body{
		padding: 0 !important;
		margin: 0;
	}
	.swal-center{
		display: flex;
		justify-content: center;
		align-items: center;
	}
	.select_company option{
		font-size: 15px;
		color: black !important;
		border:0;
	}
	.select_company{
		background: white;
		overflow-y: scroll;
		height: 200px;
		border: 1px solid #bccccd;
		text-align: left;
		padding:0;
		z-index: 99999999;
	}
	#btn_click:hover{
		color: black;
		font-weight: bold;
		font-family: Arial;
	}
	#btn_click{
		transition: all 1s;
		font-weight: bold;
		font-family: Arial;
	}
	.sweet-alert{
		width: 600px !important;
	}
	.sweet-alert p{
		color: black !important;
	}
	.sweet-alert,h1,h2,h3,h4,h5,h6{
		font-family: Arial !important;
	}
</style>
@section('content')
<script>
	$(document).ready(function(){
		$('.sweet-alert button.cancel').html('Nhập lại thông tin');
		$('.sa-confirm-button-container button.confirm').html('Cập nhật thông tin và đơn hàng');
	});
</script>
<div class="background-content content-wraper col-lg-12" style="padding: 0; margin:0; border-bottom: 1px solid #9dacb7">
	<div class="col-lg-12" style="background: rgba(71, 101, 127, 0.5); min-height: 86%">
		<div class="col-lg-12" style="padding-top: 3%" style="display: block">
			<div class="col-lg-6" style="padding:0; margin:0">
				<div class=" col-lg-12">
					<b class="font-size-content" style="color: white; font-size: 40px; font-family: Arial;">AN TÂM MUA SẮM.</b>
				</div>
				<div class="col-lg-offset-1 col-lg-11">
					<b class="font-size-content" style="color: white;font-size: 40px; font-family: Arial;">THOẢI MÁI LỰA CHỌN.</b>
				</div>
			</div>
			<div class=" col-lg-4 margin-div">
				{!!Form::open(array('class'=>'form-validate form-group text-center form-horizontal','id'=>'register_form','style'=>'background: rgba(236, 236, 236, 1); border: 2px solid white; display:  block'))!!}
				<div class="col-lg-12 padding-div margin-div">
					<b class="" style="font-size: 20px;font-family: Arial;">KIỂM TRA SỨC MUA CỦA BẠN</b>
				</div>
				<div class="padding-div">
					<div class="col-lg-12">
						{!! Form::text('','',['class'=>'form-control','id'=>'input_company','placeholder'=>'Nhấn vào để chọn công ty','autocomplete'=>'off']) !!}
						{!! Form::text('id_comp','', ['style'=>'display:none','id'=>'id_comp']) !!}
					</div>
					<div class="col-lg-12" style="position: absolute !important;">
						<div id="select_company" class="col-lg-11 select_company" name="company" style="padding: 0">
							@foreach ($company as $cp)
							<option id="item_com" class="form-control" value="{{$cp->id}}">{{$cp->name}}</option>
							@endforeach
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="col-lg-12">
					<p id="error_com" style="color: red"></p>
					<p id="error_com" style="color: red"></p>
				</div>
				<div class="col-lg-12 padding-div">
					<input id="txt_cmt" class="form-control" type="text" placeholder="Số chứng minh nhân dân">
				</div>
				<div class="col-lg-12">
					<p id="error_cmt" style="color: red"></p>
				</div>
				<div class="col-lg-12 padding-div">
					<input id="txt_code" class="form-control" type="text" placeholder="Mã số nhân viên">
				</div>
				<div class="col-lg-12">
					<p id="error_code" style="color: red"></p>
				</div>
				<div class="col-lg-12" >
					<p id="error"></p>
				</div>
				<div class="col-lg-12 padding-div">
					<input id="btn_click" class=" btn btn-primary" type="button" value="KIỂM TRA SỨC MUA CỦA BẠN">
				</div>
				<div class="clear"></div>
				{!!Form::close() !!}
				{{-- data_form --}}
				{!!Form::open(array('class'=>'form-validate form-group text-center padding-div form-horizontal','id'=>'data_form','style'=>'background: rgba(236, 236, 236, 1); border: 2px solid white; display: none','action'=>['PurchaseinfoController@postsearch']))!!}
				<div class="col-lg-12 padding-div margin-div">
					<b class="" style="font-size: 20px;font-family: Arial;">THÔNG TIN KHÁCH HÀNG</b>
				</div>
				<div class="col-lg-12 text-left">
					{!! Form::label('','Tên khách hàng', ['class'=>'form-label col-lg-6']) !!}
					{!! Form::text('u_name','',['class'=>'form-control col-lg-6','id'=>'u_name','readonly']) !!}
					{!! Form::text('id_user','', ['style'=>'display:none','id'=>'id_user']) !!}
					<div class="clear"></div>
				</div>
				<div class="col-lg-12  text-left">
					{!! Form::label('','Tổng sức mua', ['class'=>'form-label col-lg-6']) !!}
					{!! Form::text('sum_buy','',['class'=>'form-control col-lg-6','id'=>'sum_buy','readonly']) !!}
					<div class="clear"></div>
				</div>
				<div class="col-lg-12  text-left">
					{!! Form::label('','Sức mua sử dụng', ['class'=>'form-label col-lg-6']) !!}
					<input name="buy_use" id="buy_use" class="form-control col-lg-6" readonly type="text" />
					<div class="clear"></div>
				</div>
				<div class="col-lg-12  text-left">
					{!! Form::label('','Sức mua còn lại', ['class'=>'form-label col-lg-6']) !!}
					<input id="rest" name="rest" class="form-control col-lg-6" readonly type="text" />
					<div class="clear"></div>
				</div>
				<div class="col-lg-12 text-left">
					<p id="error" style="display: none"></p>
				</div>
				<div class="col-lg-12" id="next_register" style="display: none">
					<div class="col-lg-6 margin-div">
						{!! Form::submit('Đăng ký mua hàng', ['class'=>'btn  btn-primary form-control','style'=>'max-width: 100%','name'=>'btn_orders']) !!}
					</div>
					<div class="col-lg-6 margin-div">
						{!! Form::submit('Tải phiếu đăng ký', ['class'=>'btn  btn-primary form-control','style'=>'max-width: 100%','name'=>'btn_upload']) !!}
					</div>
					<div class="clear"></div>
				</div>
				<div class="col-lg-12" id="dont_next" style="display: none">
					<div class="col-lg-12">
						<p id="notify" style="color: red; margin: 0">Sức mua hiện tại của bạn không đủ thực hiện giao dịch. Liên hệ với chúng tôi để được hỗ trợ.</p>
						<p id="hotline"><span style="color: red" id="phone"></span></p>
					</div>
					<div class="col-lg-12 div-flex">
						<a href="#" id="return_local" style="max-width: 100%;" class="btn btn-primary col-lg-6">Quay về trang chủ</a>
					</div>
					<div class="clear"></div>
				</div>
				{!!Form::close() !!}
			</div>
			{{-- <div class="clear" style="padding-bottom: 5%"></div> --}}
		</div>

		<div class="clear"></div>
	</div>
</div>
@stop