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
		$("#dateissueuserinfo").kendoDatePicker({
			format: "dd/MM/yyyy"
		});
		var savg = $('#buytxt').val().replace(/[ đồng,.]/g,'');
		if(savg){
			$('#buytxt').val(numeral(savg).format('0,0').replace(/,/g,'.')+" đồng");
		}
		var pre_pay1 = $('#pre_pay1').val().replace(/[ đồng,.]/g,'');
		if(pre_pay1){
			$('#pre_pay1').val(numeral(pre_pay1).format('0,0').replace(/,/g,'.')+" đồng");
		}
		var buy_use = $('#buy_use').val().replace(/[ đồng,.]/g,'');
		if(buy_use){
			$('#buy_use').val(numeral(buy_use).format('0,0').replace(/,/g,'.')+" đồng");
		}
		var pre_pay = $('#pre_pay').val().replace(/[ đồng,.]/g,'');
		if(pre_pay){
			$('#pre_pay').val(numeral(pre_pay).format('0,0').replace(/,/g,'.')+" đồng");
		}
		var price = $('#price').val().replace(/[ đồng,.]/g,'');
		if(price){
			$('#price').val(numeral(price).format('0,0').replace(/,/g,'.')+" đồng");
		}
		var amount_slow = $('#amount_slow').val().replace(/[ đồng,.]/g,'');
		if(amount_slow){
			$('#amount_slow').val(numeral(amount_slow).format('0,0').replace(/,/g,'.')+" đồng");
		}
		var slow_month = $('#slow_month').val().replace(/[ đồng,.]/g,'');
		if(slow_month){
			$('#slow_month').val(numeral(slow_month).format('0,0').replace(/,/g,'.')+" đồng");
		}
		var salary_info = $('#salary_info').val().replace(/[ đồng,.]/g,'');
		if(salary_info){
			$('#salary_info').val(numeral(salary_info).format('0,0').replace(/,/g,'.')+" đồng");
		}

		$('#salary_info').change(function(event) {
			var salary_info = numeral($('#salary_info').val().replace(/[ đồng.,]/g,'')).format('0,0');
			if(salary_info){
				$('#salary_info').val(salary_info.replace(/,/g,'.')+" đồng");
			}
		});
	});
</script>
<style type="text/css">
	.error{
		color: red
	}
	.form-group{
		margin: 2px;
	}
	label.control-label.col-sm-4 {
		text-align: left;
	}
</style>
{!!Html::script('js/validate/validate_update_order.js')!!}
<section class="content">
	<h3 style="margin-top: 0px;">Cập nhập thông tin</h3>
	@if ($orders->note!=null)
		<div class="alert alert-warning alert-dismissible">
			<h4><i class="icon fa fa-warning"></i> Note!</h4>
			{!!$orders->note!!}
		</div>
	@endif
	<ul class="nav nav-pills nav-justified">
		<li class="active"><a data-toggle="pill" href="#home">Thông tin cá nhân</a></li>
		<li><a data-toggle="pill" href="#menu1">Thông tin mua hàng</a></li>
		<li><a data-toggle="pill" href="#menu2">Thông tin thu nhập</a></li>
	</ul>
	<form class="form-horizontal" method="post" id="form_update_order" action="{{url('admin/postupdateorder')}}">
		{{csrf_field()}}
		<input type="hidden" name="order_id" value='{{$orders->id}}'>
		<input type="hidden" name="user_id" value='{{$orders->user->id}}'>
		<input type="hidden" name="userinfo_id" id="userinfo_id" value='{{$orders->user->userinfo->id}}'>
		<input type="hidden" name="user_id" value='{{$orders->user->id}}'>
		<div class="tab-content" style="background: #fff">
			<div id="home" class="tab-pane fade in active">
				@include('business.orders.update.inforuser')
			</div>
			<div id="menu1" class="tab-pane fade">
				@include('business.orders.update.orderinfor')
			</div>
			<div id="menu2" class="tab-pane fade">
				@include('business.orders.update.incomeinfo')
			</div>
			
			@if($warning_order<1)
			<p class="alert alert-danger text-center">Đơn hàng này đã vượt quá sức mua</p> 
			@endif()
			
			@if(count($orders->uploadfile))
			<div class="row">
				<label class="col-md-6 offset-md-3">Ảnh Phiếu đăng ký mua hàng:</label>
				<div class="col-md-12">
					<div class="box">
						<img class="img-responsive" src={{ asset('/uploadfile/orders/')}}/{{$orders->uploadfile->where('type',1)->first()->path}}>
					</div>
				</div>
			</div>
			@endif
			<!-- Modal -->
			<div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Xác nhận</h4>
						</div>
						<div class="modal-body">
							<p>Bạn có muôn xóa đơn hàng này không?</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<input formnovalidate="formnovalidate" type="submit" class="btn btn-warning" name="delete" value="Hủy đơn hàng"/>
						</div>
					</div>

				</div>
			</div>
			<div class="row" style="padding-bottom: 10px">
				<div class="col-md-6 pull-right">
					<div class="col-md-4">
						<input type="button" id="approval" class="btn btn-primary" name="approval" value="Chuyển phê duyệt"/>
					</div>
					<div class="col-md-4">
						<input type="button" id="accuracy" class="btn btn-success" name="accuracy" value="Yêu cầu xác thực"/>
					</div>
					<div class="col-md-4">
						<input data-toggle="modal" data-target="#myModal" type="button" class="btn btn-warning" value="Hủy đơn hàng"/>
					</div>
				</div>
			</div>
		</div>
		<input type="hidden" name="type" id="type">
	</form>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#approval').click(function(){
				$('#type').val('approval');
				$('form').submit();
			});
			$('#accuracy').click(function(){
				$('#type').val('accuracy');
				$('form').submit();
			});
		});
		$('#form_update_order').on('keyup keypress', function(e) {
			var keyCode = e.keyCode || e.which;
			if (keyCode === 13) { 
				e.preventDefault();
				return false;
			}
		});
	</script>
</section>
@stop