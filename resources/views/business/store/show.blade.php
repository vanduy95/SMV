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
					<h3 class="box-title">Edit Store</h3>
				</div>
				<div class="panel-body">
					<div class="form">
						{!!Form::open(array('class'=>'form-validate form-horizontal','id'=>'register_form','action'=>['StoreController@show',$store->id]))!!}
						@if(session('notify'))
							<div class="alert bg-teal disabled color-palette">
						{{session('notify')}}
						</div>
						@endif
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Hệ thống bán lẻ *',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								{!!Form::text('nameretail',$store->nameretail,['class'=>'form-control','placeholder'=>'Tên người dùng '])!!}
								@if($errors->has('nameretail'))<p style="color: red;">{!!$errors->first('nameretail')!!}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Hệ thống bán lẻ *',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								{!!Form::text('nameretail',$store->nameretail,['class'=>'form-control','placeholder'=>'Tên người dùng '])!!}
								@if($errors->has('nameretail'))<p style="color: red;">{!!$errors->first('nameretail')!!}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Hệ thống bán lẻ *',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								{!!Form::text('nameretail',$store->nameretail,['class'=>'form-control','placeholder'=>'Tên người dùng '])!!}
								@if($errors->has('nameretail'))<p style="color: red;">{!!$errors->first('nameretail')!!}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Hệ thống bán lẻ *',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								{!!Form::text('nameretail',$store->nameretail,['class'=>'form-control','placeholder'=>'Tên người dùng '])!!}
								@if($errors->has('nameretail'))<p style="color: red;">{!!$errors->first('nameretail')!!}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Hệ thống bán lẻ *',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								{!!Form::text('nameretail',$store->nameretail,['class'=>'form-control','placeholder'=>'Tên người dùng '])!!}
								@if($errors->has('nameretail'))<p style="color: red;">{!!$errors->first('nameretail')!!}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Hệ thống bán lẻ *',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								{!!Form::text('nameretail',$store->nameretail,['class'=>'form-control','placeholder'=>'Tên người dùng '])!!}
								@if($errors->has('nameretail'))<p style="color: red;">{!!$errors->first('nameretail')!!}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Hệ thống bán lẻ *',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								{!!Form::text('nameretail',$store->nameretail,['class'=>'form-control','placeholder'=>'Tên người dùng '])!!}
								@if($errors->has('nameretail'))<p style="color: red;">{!!$errors->first('nameretail')!!}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Hệ thống bán lẻ *',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								{!!Form::text('nameretail',$store->nameretail,['class'=>'form-control','placeholder'=>'Tên người dùng '])!!}
								@if($errors->has('nameretail'))<p style="color: red;">{!!$errors->first('nameretail')!!}</p>@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	@stop
	@section('script')
	<script>
		$(function(){
			if ($('#syslock').is(':checked') == true && $('#syslock').val()==1) {
				$('#hidden').removeClass('hidden');
				$('#grouphidden').removeClass('hidden');
			}
		});
		$('#syslock').change(function() {
			if ($('#syslock').is(':checked') == true) {
				$('#hidden').removeClass('hidden');
				$('#grouphidden').removeClass('hidden');
			} else {
				$('#hidden').addClass('hidden');
				$('#grouphidden').addClass('hidden');
			}
		});
		$('#datepicker').datepicker();
	</script>
	@stop