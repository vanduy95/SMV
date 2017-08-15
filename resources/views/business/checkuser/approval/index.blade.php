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
	.form-group{
		margin: 0px;
	}
	label.control-label.col-sm-4 {
		text-align: left;
	}
</style>
{!!Html::script('js/validate/validate_update_order.js')!!}
<section class="content">
<div class="row" style="">
		<h2 class="col-lg-10" style="margin-top: 0px">Xét duyệt thông tin khách hàng</h2>
	</div>
	<ul class="nav nav-pills nav-justified">
		<li class="active"><a data-toggle="pill" href="#home">Thông tin cá nhân</a></li>
		<li><a data-toggle="pill" href="#menu2">Thông tin thu nhập</a></li>
	</ul>
	<form class="form-group" method="post" id="form_update_order" action="{{url('admin/checkuser/approval')}}">
		{{csrf_field()}}
		<input type="hidden" name="userinfo_id" value='{{$user->userinfo->id}}'>
		<input type="hidden" name="user_id" value='{{$user->id}}'>
		<div class="tab-content" style="background: #fff; padding:0">
			<div id="home" class="tab-pane fade in active">
				@include('business.checkuser.approval.infouser')
			</div>
			<div id="menu2" class="tab-pane fade">
				@include('business.checkuser.approval.incomeinfo')
			</div>
			<div class="row" style="margin-bottom:20px ">
				<div class="col-md-12" align="center"><b>Ngày xác thực gần nhất : {{date('d-m-Y',strtotime($user->userinfo->updated_at))}}</b></div>
			</div>
			<div class="" style="padding: 0 15px 15px 0">
				
				<input type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal" value="Yêu cầu cập nhật lại thông tin"/>
				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Lý do yêu cầu cập nhập :</h4>
							</div>
							<div class="modal-body">
								<textarea rows="12" name="note_update" class="form-control"></textarea>
								<script type="text/javascript">
									CKEDITOR.replace('note_update');
								</script>
							</div>
							<div class="modal-footer">
								<input type="submit" style="margin: 0 5px 0 5px" class=" btn btn-primary pull-right" name="update" value="Yêu cầu cập nhật lại thông tin"/>
							</div>
						</div>
					</div>
				</div>


				<input type="button" style="margin: 0 5px 0 5px" class=" btn btn-primary pull-right" name="accuracy" value="Yêu cầu xác thực" data-toggle="modal" data-target="#accuracy_modal"/>
				<div class="modal fade" id="accuracy_modal" role="dialog">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Lý do yêu cầu xác thực :</h4>
							</div>
							<div class="modal-body">
								<textarea name="note_accuracy" rows="12" class="form-control"></textarea>
								<script type="text/javascript">
									CKEDITOR.replace('note_accuracy');
								</script>
							</div>
							<div class="modal-footer">
								<input type="submit" style="margin: 0 5px 0 5px" class=" btn btn-primary pull-right" name="accuracy" value="Yêu cầu xác thực"/>
							</div>
						</div>
					</div>
				</div>
				<input type="submit" style="margin: 0 5px 0 5px" class="  btn btn-primary pull-right" name="deactive" value="Từ chối"/>
				<input type="submit" style="margin: 0 5px 0 5px" class="btn btn-primary pull-right" name="approval" value="Phê duyệt"/>
				<div class="clear"></div>
			</div>
		</div>
	</form>
  </script>
</section>
@stop