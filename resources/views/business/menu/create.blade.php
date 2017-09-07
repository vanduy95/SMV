@extends('layouts.master')
@section('content')
<section class="content-header">
	<h1>
		Quản lý chức năng
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Menu</li>
	</ol>
</section>
<section class="content ">
	<div class="row">
		<div class="col-sm-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Thêm chức năng</h3>
				</div>
				<div class="panel-body">
					<div class="form">
						{!!Form::open(array('class'=>'form-validate form-horizontal','id'=>'register_form','url'=>'admin/menu/create','action'=>['MenuController@getcreate']))!!}
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Tên <span class="required">*</span>',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								{!! Form::text('name','',['class'=>'form-control','placeholder'=>'Tên ']) !!}
								@if($errors->has('name'))<p style="color: red;">{{$errors->first('name')}}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Thuộc menu <span class="required">*</span>',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								<select name="parent_id" class="form-control">
								<option value="0">Thuộc menu</option>
									@foreach($menu as $m)
									<option value="{{$m->id}}" @if(old('parent_id')==$m->parent_id) selected="selected" @endif >{{$m->name}}</option>
									@endforeach
								</select>
								@if($errors->has('parent_id'))<p style="color: red;">{{$errors->first('parent_id')}}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Tên đường dẫn <span class="required">*</span>',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								{!! Form::text('nameroute','',['class'=>'form-control','placeholder'=>'Tên đường dẫn']) !!}
								@if($errors->has('nameroute'))<p style="color: red;">{{$errors->first('nameroute')}}</p>@endif
							</div>
						</div>
						<div class="form-group">
							{!!Html::decode(Form::label('fullname','Thứ tự <span class="required">*</span>',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-4">
								{!! Form::text('order','',['class'=>'form-control','placeholder'=>'Thứ tự']) !!}
								@if($errors->has('order'))<p style="color: red;">{{$errors->first('order')}}</p>@endif
							</div>
							{!!Html::decode(Form::label('fullname','Hiển thị',['class'=>'control-label col-lg-1']))!!}
							<div class="col-lg-4">
								<input type="checkbox" name="display" value="1">
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-offset-2 col-lg-10">
								{!!Form::submit('Lưu',['id'=>'save','class'=>'btn btn-primary'])!!}
								{!!Form::reset('Nhập Lại',['id'=>'reset','class'=>'btn btn-default'])!!}
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