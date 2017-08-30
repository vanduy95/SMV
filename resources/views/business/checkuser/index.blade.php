@extends('layouts.master')
@section('content')
<style type="text/css">
	.div-center{
		display: flex;
		align-items: center;
	}
	th{
		text-align: center !important;
		vertical-align: middle !important;
	}
	.error{
		color:red;
	}
</style>

<section class="content-header">
	<h1>
		<small></small>
	</h1>	
	<ol class="breadcrumb">
		<li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">User</li>
	</ol>
</section>
<section class="content">
@if(Session::has('notify'))<p class="alert alert-info">{{Session::get('notify')}}</p>@endif
	<div class="row">
		<div class="col-sm-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Danh sách khách hàng chờ duyệt</h3>
				</div>
				<div class="box-body">
					<div class="table-responsive">

						<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
							<thead>
								<tr></tr>
								<tr role="row">
									<th>id</th>
									<th>Họ Tên</th>
									<th>Mức lương</th>
									<th>Số điện Thoại</th>
									<th>Số CMDN</th>
									<th>Trạng thái</th>
									<th>Ngày đăng ký</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($user as $u)
								<tr>
								<td align="center">{{$u->id}}</td>
									<td align="center">{{$u->userinfo->fullname}}</td>
									<td align="center">{{number_format($u->userinfo->salary)}} Đồng</td>
									<td align="center">{{$u->userinfo->phone1}}</td>
									<td align="center">{{$u->userinfo->identitycard}}</td>
									<td align="center">
									<a href="{{ url('admin/checkuser/show') }}/{{$u->id}}">
										@if($u->status == 1)
											Kích hoạt
										@elseif($u->status == 2)
											Chờ duyệt
										@elseif($u->status == 3)
											Chờ xác thực
										@elseif($u->status == 4)
											Chờ cập nhập
										@endif
									</a>
									</td>
									<td align="center">{{ Carbon\Carbon::parse($u->created_at)->format('h:i d-m-Y')}}</td>
									<td align="center">
										<div class="btn-group">
											<a href="{{ url('admin/checkuser/show') }}/{{$u->id}}"><i class="fa fa-fw fa-cog"></i></a>
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
		</section>
		@stop