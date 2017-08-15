@extends('layouts.master')
@section('content')
<section class="content-header">
	<h1>
		Hệ thống bán lẻ  
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Store</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title"></h3>
				</div>
				<div class="box-body">
					<div class="table-responsive">
						<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
							<thead>
								<tr></tr>
								<tr role="row">
									<th>Hệ thống bán lẻ</th>
									<th>Lãi suất</th>
								</tr>
							</thead>
							<tbody>
								@foreach($collection as $dt)
								<tr>
									<td>{{$dt['nameretail']}}</td>
									<td>{{$dt['interest']*100}} %</td>
									<td>
										<div class="btn-group">
											<a href="{{route('updateinterest',$dt['nameretail'])}}"><i class="fa fa-fw fa-cog"></i></a>
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
	</div>
</div>
</section>
@stop