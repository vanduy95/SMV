@extends('layouts.master')
@section('content')
<style type="text/css">
	th{
		padding-right: 5px!important; 
		text-align: center;
	}
	td{
		text-align: center;
	}
	input[type=checkbox]{
		padding: 0;
		margin: 0;
	}
</style>
<section class="content-header">
	<h1>
		Group Menu 
		<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Group Menu</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Group Menu</h3>
				</div>
				<div class="panel-body">
					<div class="form">
						{!!Form::open(array('class'=>'form-validate form-horizontal','id'=>'register_form','url'=>'admin/groupmenu'))!!}
						<div class="col-sm-12">
							<div class="table-responsive">

								<table  class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
									<thead>
										<tr role="row">
											<th>#</th>
											@foreach($groupuser as $group)
											<th>{{$group->name}}</th>
											@endforeach
										</tr>
									</thead>
									<tbody>
										@foreach($menus as $key => $menu)
										<tr role="row" class="odd">
											<td>{{$menu->name}}</td>
											@foreach($groupuser as $key => $group)
											@if(in_array([$menu->id,$group->id,1],$result)==true)
											<td><input type="checkbox" name="{{$a++}}" value="1" class="checkbox" checked="checked"></td>
											@else
											<td><input type="checkbox" name="{{$a++}}" value="0" class="checkbox" ></td>
											@endif
											@endforeach
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<div class="col-lg-3">
									{!!Form::submit('Save',['id'=>'save','class'=>'btn btn-primary col-sm-8'])!!}
								</div>
								<div class="col-lg-3">
									{!!Form::reset('Reset',['class'=>'btn btn-default col-sm-8','id'=>'reset'])!!}
								</div>
							</div>
						</div>
						{!!Form::close()!!}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@stop