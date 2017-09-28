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
	.div-center{
		display: inline-flex;
		justify-content: center; 
		align-items: center;
	}
	.form-group{
		margin: 0px;
	}
	label.control-label.col-sm-4 {
		text-align: left;
	}
	.clear{
		clear: both;
	}
	.btn_full_size{
		width: 100%;
		justify-content: flex-end;
	}
</style>
{!!Html::script('js/validate/validate_update_order.js')!!}
<section class=" ">
	<div class=" " style="">
		<h2 class="col-lg-10" style="margin-top: 0px">Xét duyệt thông tin</h2>
		<h2 class="col-lg-2" style="margin-top: 0px"><a href="/admin/orderinfor/userinfo/{{$orders->user->userinfo->id}}" class="btn btn-success">In thông tin khách hàng</a></h2>
	</div>
	<ul class="nav nav-pills nav-justified">
		<li class="active"><a data-toggle="pill" href="#home">Thông tin cá nhân</a></li>
		<li><a data-toggle="pill" href="#menu1">Thông tin mua hàng</a></li>
		<li><a data-toggle="pill" href="#menu2">Thông tin thu nhập</a></li>
	</ul>
	<form class="" class="form-group" method="post" id="form_update_order" action="{{url('admin/postApprovalOrder')}}">
		{{csrf_field()}}
		<input type="hidden" name="order_id" value='{{$orders->id}}'>
		<input type="hidden" name="userinfo_id" value='{{$orders->user->userinfo->id}}'>
		<input type="hidden" name="user_id" value='{{$orders->user->id}}'>
		<div class="tab-content" style="background: #fff; padding:0">
			<div id="home" class="tab-pane fade in active">
				@include('business.orders.approval.inforuser')
			</div>
			<div id="menu1" class="tab-pane fade">
				@include('business.orders.approval.orderinfor')
			</div>
			<div id="menu2" class="tab-pane fade">
				@include('business.orders.approval.incomeinfo')
			</div>
			<div class="row ">
				<div class="col-md-12" align="center"><b>Ngày xác thực gần nhất : {{date('d-m-Y',strtotime($UserInfo->updated_at))}}</b></div>
			</div>
			@if($warning_order<1)
			<p class="alert alert-danger text-center">Đơn hàng này đã vượt quá sức mua</p> 
			@endif()
			<div class="row ">
				<div class="col-md-12 pull-right" style="margin-bottom: 20px">
					<script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
					<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
					<form action="{{ url('admin/ajax/uploadImage') }}" method="post" class="dropzone" id="myAwesomeDropzone">
						{{csrf_field()}}
						<input type="hidden" name="order_id" value="{{$orders->id}}">
					</form>
				</div>
			</div>
			<div class="row btn_full_size div-center" style="padding: 0 15px 15px 0;">
				<input type="button" class="btn-full-width btn btn-primary pull-right" data-toggle="modal" data-target="#myModal" value="Yêu cầu cập nhật lại thông tin"/>
				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Lý do yêu cầu cập nhập :</h4>
							</div>
							<div class="modal-body">
								<textarea row col-lg-12 col-xs-12 col-md-12s="12" name="note_update" class="form-control"></textarea>
								<script type="text/javascript">
									CKEDITOR.replace('note_update');
								</script>
							</div>
							<div class="modal-footer">
								<input type="submit" style="margin: 0 5px 0 5px" class="btn-full-width btn btn-primary pull-right" name="update" value="Yêu cầu cập nhật lại thông tin"/>
							</div>
						</div>
					</div>
				</div>
				<input type="button" style="margin: 0 5px 0 5px" class="btn-full-width btn btn-primary pull-right" name="accuracy" value="Yêu cầu xác thực" data-toggle="modal" data-target="#accuracy_modal"/>
				<div class="modal fade" id="accuracy_modal" role="dialog">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Lý do yêu cầu xác thực :</h4>
							</div>
							<div class="modal-body">
								<textarea name="note_accuracy" class="form-control"></textarea>
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
				<input type="submit" style="margin: 0 5px 0 5px" class="btn-full-width   btn btn-primary pull-right" name="deactive" value="Từ chối"/>
				<input type="submit" style="margin: 0 5px 0 5px" class="btn-full-width btn btn-primary pull-right" name="approval" value="Phê duyệt"/>
				<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>
	</form>  
	<div class="clear"></div>
	<script type="text/javascript">
		Dropzone.options.myAwesomeDropzone = {
 	    paramName: "file", // The name that will be used to transfer the file
  		maxFilesize: 2, // MB
  		acceptedFiles:'image/*',
  		addRemoveLinks:true,
  		maxFiles:1,
  		dictDefaultMessage:"Tải lên ủy nhiệm chi",
  		init: function() {
  			this.on("addedfile", function() {
  				if (this.files[1]!=null){
  					this.removeFile(this.files[0]);
  				}
  			});
  		},
  		removedfile:function (file) {
  			var server_file = $(file.previewTemplate).children('.server_file').text();
  			$.post('{{ url('admin/ajax/deleteImage') }}', { id: {{$orders->id}} } );
  			file.previewElement.parentNode.removeChild(file.previewElement);
  		}
  	};

  </script>
</section>
@stop