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
		// var savg = $('#buytxt').val().replace(/[ đồng,.]/g,'');
		// if(savg){
		// 	$('#buytxt').val(numeral(savg).format('0,0').replace(/,/g,'.')+" đồng");
		// }
		// var pre_pay1 = $('#pre_pay1').val().replace(/[ đồng,.]/g,'');
		// if(pre_pay1){
		// 	$('#pre_pay1').val(numeral(pre_pay1).format('0,0').replace(/,/g,'.')+" đồng");
		// }
		// var buy_use = $('#buy_use').val().replace(/[ đồng,.]/g,'');
		// if(buy_use){
		// 	$('#buy_use').val(numeral(buy_use).format('0,0').replace(/,/g,'.')+" đồng");
		// }
		// var pre_pay = $('#pre_pay').val().replace(/[ đồng,.]/g,'');
		// if(pre_pay){
		// 	$('#pre_pay').val(numeral(pre_pay).format('0,0').replace(/,/g,'.')+" đồng");
		// }
		// var price = $('#price').val().replace(/[ đồng,.]/g,'');
		// if(price){
		// 	$('#price').val(numeral(price).format('0,0').replace(/,/g,'.')+" đồng");
		// }
		// var amount_slow = $('#amount_slow').val().replace(/[ đồng,.]/g,'');
		// if(amount_slow){
		// 	$('#amount_slow').val(numeral(amount_slow).format('0,0').replace(/,/g,'.')+" đồng");
		// }
		// var slow_month = $('#slow_month').val().replace(/[ đồng,.]/g,'');
		// if(slow_month){
		// 	$('#slow_month').val(numeral(slow_month).format('0,0').replace(/,/g,'.')+" đồng");
		// }
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
{!!Html::script('js/validate/validate_update_user.js')!!}
<section class="content">
	<h3 style="margin-top: 0px;">Cập nhập thông tin cá nhân</h3>
	@if ($user->note!=null)
	<div class="alert alert-warning alert-dismissible">
		<h4><i class="icon fa fa-warning"></i> Note!</h4>
		{!!$user->note!!}
	</div>
	@endif
	<ul class="nav nav-pills nav-justified">
		<li class="active"><a data-toggle="pill" href="#home">Thông tin cá nhân</a></li>
	</ul>
	<form class="form-horizontal" method="post" id="form_update_order" action="{{url('admin/checkuser/update')}}">
		<input type="hidden" name="userinfo_id" id="userinfo_id" value={{$user->userinfo->id}}>
		<input type="hidden" name="user_id" value={{$user->id}}>
		<input type="hidden" name="organization_id" value={{$user->organization_id}} id="organization_id">
		{{csrf_field()}}
		<div class="tab-content" style="background: #fff">
			<div id="home" class="tab-pane fade in active">
				@include('business.checkuser.update.infouser')
			</div>
			<div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Xác nhận</h4>
						</div>
						<div class="modal-body">
							<p>Bạn có muôn xóa Khách hàng này không?</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<input formnovalidate="formnovalidate" type="submit" class="btn btn-warning" name="delete" value="Xóa khách hàng"/>
						</div>
					</div>

				</div>
			</div>
			<div class="row" style="padding-bottom: 10px">
				<div class="col-md-6"></div>
				<div class="col-md-6">
					<div class="col-md-4">
						<input type="button" id="approval" class="btn btn-primary" name="approval" value="Chuyển phê duyệt"/>
					</div>
					<div class="col-md-4">
						<input type="button" id="accuracy" class="btn btn-success" name="accuracy" value="Yêu cầu xác thực"/>
					</div>
					<div class="col-md-4">
						<input type="button" data-toggle="modal" data-target="#myModal" class="btn btn-warning"  value="Xóa khách hàng"/>
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
			$('#form_update_order').on('keyup keypress', function(e) {
				var keyCode = e.keyCode || e.which;
				if (keyCode === 13) { 
					e.preventDefault();
					return false;
				}
			});
		});
	</script>
</section>
@stop