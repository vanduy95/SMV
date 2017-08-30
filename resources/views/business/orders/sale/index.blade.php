@extends('layouts.master')
@section('content')
<script type="text/javascript">
	$(document).ready(function() {
		$("#dateissue_identifycation").kendoDatePicker({
			format: "dd/MM/yyyy"
		});
		$("#birthday").kendoDatePicker({
			format: "dd/MM/yyyy"
		});
		$("#dateissue").kendoDatePicker({
			format: "dd/MM/yyyy"
		});
	});
</script>
<style type="text/css">
	.error{
		color: red
	}
	.box-body {
		padding: 0px;
	}
	h3.box-title, .text_center {
		margin: 0px;
		display: flex;
		justify-content: center;
	}
	.col-md-6 {
		padding: 4px;
	}
	.form-group {
		margin: 0px;
	}
	.panel-body {
		padding: 3px 10px 0px;
	}
	h4 {
		margin: 0px;
		font-size: 24px
	}
	p {
		margin: 0px 0px 0px 8px;
		font-size: 15px;
	}
	.text{
		width: 50%;
	}
	.fa-check{
		color: red;
	}
	.form-control{
		margin-bottom: 1px;
	}
</style>
{!!Html::script('js/validate/validate_update_order.js')!!}
<section class="content">
	<ul class="nav nav-pills nav-justified">
		<li class="active"><a data-toggle="pill" href="#home">
			@if ($orders->process_id==4)
			Thông tin đơn hàng đã được duyệt
			@elseif($orders->process_id==6)
				Thông tin đơn hàng không được duyệt
			@else
			  	Đã giao hàng
			@endif
		</a></li>
	</ul>
	<form class="form-horizontal" method="post" id="form_update_order" action="{{url('admin/postsaleorder')}}">
		{{csrf_field()}}
		<input type="hidden" name="order_id" value='{{$orders->id}}'>
		<input type="hidden" name="userinfo_id" value='{{$orders->user->userinfo->id}}'>
		<input type="hidden" name="user_id" value='{{$orders->user->id}}'>
		<div class="tab-content" style="background: #fff">
			<div id="home" class="tab-pane fade in active" >
				@include('business.orders.sale.user_info')
			<div class="row">
				<div class="col-md-12" align="center"><b>Ngày phê duyệt : {{date('d-m-Y',strtotime($UserInfo['updated_at']))}}</b></div>
			</div>
				@include('business.orders.sale.require')
			</div>
			<div class="row" style="padding-bottom: 10px">
				<div class="col-md-2"></div>
				<div class="col-md-10">
				@if($orders->process_id==4||$orders->process_id==5)
					<div class="col-md-3">
						<input type="submit" class="btn btn-primary col-md-12" name="print_pay" value="In chứng từ thanh toán"/>
					</div>
					<div class="col-md-2">
						<input type="submit" class="btn btn-primary col-md-12" name="print_notification" value="In thông báo"/>
					</div>
					<div class="col-md-2">
						<input type="submit" class="btn btn-primary col-md-12" name="print_contract" value="In hợp đồng"/>
					</div>
					@if ($orders->user->userinfo->exchange_status!=2)
					<div class="col-md-3">
						<input type="submit" class="btn btn-primary col-md-12" name="print_auto_pay" value="In yêu cầu thanh toán tự động"/>
					</div>	
					@endif
					
				@if ($orders->process_id==4)
					<div class="col-md-2">
						<input type="submit" class="btn btn-primary col-md-12" name="ship" value="Giao hàng"/>
					</div>
				@else
					<div class="col-md-2">
						<input type="submit" class="btn btn-primary col-md-12 pull-right" name="back" value="Quay lại"/>
					</div>
				@endif
					
				@else
					<div class="col-md-2">
						<input type="submit" class="btn btn-primary col-md-12" name="back" value="Quay lại"/>
					</div>
					
					@endif 
				</div>	
			</div>
			</div>
		</form>

	</section>
	@stop