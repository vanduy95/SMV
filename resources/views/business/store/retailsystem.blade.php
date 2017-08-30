@extends('layouts.master')
@section('content')
<section class="content-header">
	<h1>
		Hệ thống bán lẻ  
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">store</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box">
				<div class="box-header with-border">
					@if(session('notify'))
					<div class="alert bg-teal disabled color-palette">
						{{session('notify')}}
					</div>
					@endif
				</div>
				<div class="panel-body">
					<div class="form">
						{!!Form::open(array('class'=>'form-validate form-horizontal','id'=>'register_form','action'=>['StoreController@getretailcreate']))!!}
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Tên hệ thống *',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								{!!Form::text('nameretail','',['class'=>'form-control','placeholder'=>''])!!}
								@if($errors->has('nameretail'))<p style="color: red;">{!!$errors->first('nameretail')!!}</p>@endif
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-offset-2 col-lg-10">
								{!!Form::submit('Lưu',['class'=>'btn btn-primary col-lg-2'])!!}
							</div>
						</div>
						{!!Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@stop
@section('script')
<script type="text/javascript">
	$(document).ready(function() {
		jQuery.validator.addMethod("special_character", function(value, element) {
			return  /[a-zA-Z0-9]+$/.test(value);
		});
		$("#register_form").validate({
			rules:{
				nameretail:{
					required:true,
					special_character:true,
					maxlength:255
				},
			},
			messages: {
				nameretail:{
					required: "Trường này không được để trống",
					special_character:"Không được chứa ký tự đặc biệt",
					maxlength:"Tên quá dài"
				},
			}
		});
	});
</script>
@stop
