@extends('layouts.master')
@section('content')
<section class="content-header">
	<h1>
		Process Status   
		<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Process Status</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">List Process Status</h3>
				</div>
				@if(session('notify'))
				<div class="alert bg-teal disabled color-palette">
					{{session('notify')}}
				</div>
				@endif
				<div class="box-body">
					<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
						<thead>
							<tr role="row">
								<th>ID</th>
								<th>Name</th>
								<th>Value</th>
								<th>Create date</th>
								<th>Update date</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($processstatus as $pst)
							<tr>
								<td>{{$pst->id}}</td>
								<td>{{$pst->name}}</td>
								<td>{{$pst->value}}</td>
								<td>{{$pst->created_at}}</td>
								<td>{{$pst->updated_at}}</td>
								<td>
									<div class="btn-group">
										<a href="{{ route('processshow',$pst->id) }}"><i class="fa fa-fw fa-cog"></i></a>
										<a href="{{ route('processdestroy',$pst->id) }}"><i class="fa fa-fw fa-remove"></i></a>
									</div>
								</td>
							</tr> 
							@endforeach   
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
@stop