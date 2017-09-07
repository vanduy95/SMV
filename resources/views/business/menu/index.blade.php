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
<section class="content" ng-controller = "MenuController">
	<div class="row">
		<div class="col-sm-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Danh sách chức năng</h3>
				</div>
				@if(session('notify'))
				<div class="alert bg-teal disabled color-palette">
					{{session('notify')}}
				</div>
				@endif
				<div class="box-body">
						@include('business.menu.list')
				</div>
			</div>
		</div>
	</div>
</section>
@stop