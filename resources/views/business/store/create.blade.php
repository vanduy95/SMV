@extends('layouts.master')
@section('content')
<section class="content-header">
	<h1>
		User  
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#">User</a></li>
		<li class="active">Add user</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Add User</h3>
				</div>
				<div class="panel-body">
					{!!Form::open(array('class'=>'form-validate form-horizontal','id'=>'register_form','enctype'=>"multipart/form-data"))!!}
					@if(session('notify'))
					<div class="alert bg-teal disabled color-palette">
						{{session('notify')}}
					</div>
					@endif
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10">
							{!!Form::submit('Save',['class'=>'btn btn-primary'])!!}
							<a class="btn btn-default" id="cancel" href="{{url('user/create')}}">Reset</a>
						</div>
					</div>
					{!!Form::close()!!}
				</div>
			</div>
		</div>
	</div>
</section>
@stop
