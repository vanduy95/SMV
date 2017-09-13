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
</style>

<!-- List all Product -->
<section class="content-header">
	<h1>
		Quản lý khách hàng
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">User</li>
	</ol>
</section>
<div class="modal fade" id="upload" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tải lên danh sách</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="upload_form" action="" method="post" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="form-group">
						<label class="control-label col-md-3" for="organization">Chọn công ty:</label>
						<div class="col-md-8"> 
							<select name="organization" class="form-control" id="organization" placeholder="Enter password">
								<option value="">Chọn công ty</option>
								@foreach ($organization as $organization)
								<option value="{{$organization->id}}" >{{$organization->name}}</option>
								@endforeach
							</select> 
						</div>
					</div>	
					<div class="form-group">
						<label class="control-label col-md-3">Tải lên danh sách:</label>
						<div class="col-md-8">
							<input name="upExcel" type="file" accept="" class="form-control" >
						</div>
					</div>
					<div class="form-group"> 
						<div class="col-md-offset-3 col-md-9">
							<input type="submit" class="btn btn-primary" id="save" name="save"  value="UpLoad">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box">
				<div class="box-header">
					<div class="col-lg-10">
						@if(Session::has('mess_userinfo'))
							<p class="alert alert-success text-center">{{Session::get('mess_userinfo')}}</p>
						@endif
					</div>
					<div class="col-lg-2 pull-right"> 
						<button class="btn btn-primary" data-toggle="modal" data-target="#upload"><i class="fa fa-upload" aria-hidden="true"></i> Tải lên danh sách</button>
					</div>
					{{-- <div class=" col-lg-offset-2 col-lg-2 pull-right"> 
						<a href="/admin/user/xls"><button type="submit" class="btn btn-primary"/><i class="fa fa-download" aria-hidden="true"></i>Tải về danh sách</button></a>
					</div> --}}
				</div>
				<div class="box-body">
					<div class="table-responsive">
						<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
							<thead>
								<tr></tr>
								<tr role="row">
									<th>Tên Đăng nhập</th>
									<th>Tên</th>
									<th>Số điện thoại</th>
									<th>Địa chỉ</th>
									<th>Lương</th>
									<th>Ngày sinh</th>
									<th>Giới tính</th>
									<th>Số CMND</th>
									<th>Hành động</th>
								</tr>
							</thead>
							<tbody>
								@foreach($userinfo as $usf)
								<tr>
									<td><a href="{{url('admin/user/show',$usf->user_id)}}">{{$usf->user->username}}</a></td>
									<td>{{$usf->fullname}}</td>
									<td>{{$usf->phone1}}</td>
									<td>{{$usf->address1}}</td>
									<td>{{$usf->salary}}</td>
									<td>{{$usf->birthday}}</td>
									<td>
										@if ($usf->sex==1)
										Nữ
										@elseif($usf->sex==2)
										Nam
										@else
										Chưa có
										@endif
										
									</td>
									<td>{{$usf->identitycard}}</td>
									<td>
										<div class="btn-group">
											<a href="{{ route('userinfoshow',$usf->id) }}"><i class="fa fa-fw fa-cog"></i></a>
											<a href="{{ route('destroyuserinfo',$usf->id) }}"><i class="fa fa-fw fa-remove"></i></a>
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
<script type="text/javascript">
	$(document).ready(function() {
		$('#upload_form').validate({
			rules:{
				upExcel:{
					required:true,
				},
				organization:{
					required:true,
				}
			},
			messages:{
				upExcel:{
					required:"Không được để trống trường này",
				},
				organization:{
					required:"Không được để trống trường này",
				}
			}
		});
	});
</script>
<!-- page end-->
@stop