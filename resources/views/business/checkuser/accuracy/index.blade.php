@extends('layouts.master')
@section('content')
<section class="content">
	<script type="text/javascript">
		$(document).ready(function() {
			$("#dateissue").kendoDatePicker({
				format: "dd/MM/yyyy"
			});
			$("#dateissue1").kendoDatePicker({
				format: "dd/MM/yyyy"
			});
			var savg = $('#salary_avg').val().replace(/[ đồng,.]/g,'');
			if(savg){
				$('#salary_avg').val(numeral(savg).format('0,0').replace(/,/g,'.')+" đồng");
			}
		});
	</script>
	<style>
		.error{
			color: red;
		}
		.form-group{
			margin-bottom: 0px;
		}
		.form-control{
			margin-bottom: 3px;
		}
		label.control-label.col-sm-4 {
			text-align: left;
		}
	</style>
	{!!Html::script('js/validate/validate_accuracy_order.js')!!}
	<h2 style="margin-top: 0px;">Xác thực thông tin</h2>
	@if ($user->note!=null)
	<div class="alert alert-warning alert-dismissible">
		<h4><i class="icon fa fa-warning"></i> Note!</h4>
		{!!$user->note!!}
	</div>
	@endif
	<ul class="nav nav-pills nav-justified">
		<li class="active"><a data-toggle="pill" href="#home">Thông tin thu nhập</a></li>
		<li><a data-toggle="pill" href="#menu1">Thông tin cá nhân</a></li>
	</ul>
	<form class="form-horizontal" style="background: white" method="post" id="form_accuracy_order" action="{{url('admin/checkuser/accuracy')}}">
		{{csrf_field()}}
		<div class="tab-content">
			<div id="home" class="tab-pane fade in active">
				@include('business.checkuser.accuracy.incomeinfo')
			</div>
			<div id="menu1" class="tab-pane fade ">
				@include('business.checkuser.accuracy.infouser')
			</div>
			<div class="form-group">
				<input id="btn_accuracy" name="btn_accuracy" type="submit" class="col-lg-2 col-lg-offset-9 col-md-2 col-md-offset-9 btn btn-primary" value="Xác thực thông tin"/>
				{{-- <input type="submit" name="btn_update" class="btn btn-primary col-lg-2 col-lg-offset-1 col-md-2 col-md-offset-1" value="Cập nhật thông tin"> --}}
			</div>
		</div>
	</form>
</section>
@stop