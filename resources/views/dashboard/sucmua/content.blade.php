@extends('sucmua.master')
@section('content')
<div class="background-content content-wraper col-lg-12" style="padding: 0; margin:0">
	<div class="col-lg-12" style="padding-top: 3%">
		<div class="col-lg-offset-7 col-lg-4 margin-div">
			<form action="" class="form-group text-center padding-div" style="background: rgba(236, 236, 236, 0.3); border: 2px solid white">
				<div class="col-lg-12">
					<b class="" style="font-size: 20px;font-family: Arial;">KIỂM TRA SỨC MUA CỦA BẠN</b>
				</div>
				<div class="col-lg-12 margin-div">
					<input class="form-control" type="text" placeholder="Công ty bạn làm việc">
				</div>
				<div class="col-lg-12 margin-div">
					<input class="form-control" type="text" placeholder="Số chứng minh nhân dân">
				</div>
				<div class="col-lg-12 margin-div">
					<input class="form-control" type="text" placeholder="Mã số nhân viên">
				</div>
				<div class="col-lg-12 margin-div padding-div">
					<input class=" btn btn-primary" type="submit" value="KIỂM TRA SỨC MUA CỦA BẠN">
				</div>
			</form>
		</div>
		<div class="clear" style="padding-bottom: 5%"></div>
	</div>
	<div class="col-lg-12" style="padding:0; margin:0">
		<div class="col-lg-offset-5 col-lg-7 padding-div">
		<div class="col-lg-offset-5 col-lg-7">
				<b class="font-size-content" style="margin-top: -30px;color: #e12626;vertical-align: bottom">LÃI SUẤT</b>
				<img src="{{url('img/demo/0.png')}}" alt="">
			</div>
			<div class="col-lg-offset-5 col-lg-5">
				<b class="font-size-content" style="color: #e12626">AN TÂM MUA SẮM</b>
			</div>
			<div class="col-lg-offset-6 col-lg-6">
				<b class="font-size-content" style="color: #e12626">THOẢI MÁI LỰA CHỌN</b>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>
@stop