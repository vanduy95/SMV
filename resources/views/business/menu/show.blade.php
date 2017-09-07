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
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Sửa chức năng</h3>
				</div>
				<div class="panel-body">
					<div class="form">
						{!!Form::open(array('class'=>'form-validate form-horizontal','id'=>'register_form','action'=>['MenuController@show',$menu->id]))!!}
						@if(session('notify'))
						<div class="alert bg-teal disabled color-palette">
							{{session('notify')}}
						</div>
						@endif
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Tên <span class="required">*</span>',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								{!! Form::text('name',$menu->name,['class'=>'form-control','placeholder'=>'Tên ']) !!}
								@if($errors->has('name'))<p style="color: red;">{{$errors->first('name')}}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Thuộc menu <span class="required">*</span>',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								<select class=" form-control" name="parent_id">
									<option value="0">Thuộc menu </option>
									@foreach($allmenu as $m)
									<option @if($menu->parent_id == $m->id){{"selected"}} @endif value="{{$m->id}}">{{$m->name}}</option>
									@endforeach
								</select>
								@if($errors->has('parent_id'))<p style="color: red;">{{$errors->first('parent_id')}}</p>@endif
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Tên đường dẫn <span class="required">*</span>',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-8">
								{!! Form::text('nameroute',$menu->nameroute,['class'=>'form-control','placeholder'=>'Name route']) !!}
								@if($errors->has('nameroute'))<p style="color: red;">{{$errors->first('nameroute')}}</p>@endif
							</div>
						</div>
						<div class="form-group">
							{!!Html::decode(Form::label('fullname','Thứ tự <span class="required">*</span>',['class'=>'control-label col-lg-2']))!!}
							<div class="col-lg-4">
								{!! Form::text('order',$menu->order,['class'=>'form-control','placeholder'=>'Thứ tự']) !!}
								@if($errors->has('order'))<p style="color: red;">{{$errors->first('order')}}</p>@endif
							</div>
							{!!Html::decode(Form::label('fullname','Hiện thị',['class'=>'control-label col-lg-1']))!!}
							<div class="col-lg-4">
								<input type="checkbox" name="display" @if($menugroup->display==1) checked @endif value="1">
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-offset-2 col-lg-10">
								{!!Form::submit('Save',['id'=>'save','class'=>'btn btn-primary'])!!}
								{!!Form::reset('Reset',['id'=>'reset','class'=>'btn btn-default'])!!}
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