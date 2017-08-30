@extends('layouts.master')
@section('content')
<section class="content-header">
	<h1>
		Người dùng cần xác minh
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">User</li>
	</ol>
</section>
<div class="modal fade" id=change_password_modal>
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span></button>
					<h4 class="modal-title">Đổi mật khẩu Người dùng</h4>
				</div>
				<div class="modal-body" id="change_password_body">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary"  id="btn_change_password" >Save changes</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#fa-icons" data-toggle="tab" aria-expanded="true">Nhóm cộng tác viên</a></li>
					<li class=""><a href="#glyphicons" data-toggle="tab" aria-expanded="false">Nhóm nhân viên bán hàng</a></li>
				</ul>
				<div class="tab-content">
					<!-- Font Awesome Icons -->
					<div class="tab-pane active" id="fa-icons">
						<section id="new">
							<div class="row">
								<div class="col-sm-12">
									<div class="box">
										<div class="box-header">
											<h3 class="box-title">Danh sách cần xác minh tài khoản cộng tác viên</h3>
										</div>
										<div class="box-body">
											<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
												<thead>
													<tr></tr>
													<tr role="row">
														<th>ID</th>
														<th>Tên đăng nhập</th>
														<th>Email</th>
														<th>Số điện thoại</th>
														<th>Địa chỉ</th>
														<th>Trạng thái</th>
														<th>Ngày tạo</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													@foreach($user3 as $user)
													<tr>
														<td class="user3_{{$user->id}}">{{$user->id}}</td>
														<td>{{$user->username}}</td>
														<td>{{$user->email}}</td>
														<td>{{$user->phone1}}</td>
														<td>{{$user->address1}}</td>
														<td data-user3_id={{$user->id}} id="show_status_3" data-id3={{$user->status}}><a href="#">{{$user->status==0?"Chưa kích hoạt":"Đã kích hoạt"}}</a></td>
														<td>{{ Carbon\Carbon::parse($user->created_at)->format('d-m-Y')}}</td>
														<td>
															<div class="btn-group">
																<a id="delete_user" data-id={{$user->id}}><i class="fa fa-fw fa-remove"></i></a>
																<a id="change_password" data-id={{$user->id}}><i class="fa fa-unlock-alt"></i></a>
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
					</div>
					<!-- /#fa-icons -->

					<!-- glyphicons-->
					<div class="tab-pane" id="glyphicons">
						<section id="new">
							<div class="row">
								<div class="col-sm-12">
									<div class="box">
										<div class="box-header">
											<h3 class="box-title">Danh sách cần xác minh tài khoản nhân viên bán hàng</h3>
										</div>
										<div class="box-body">
											<table id="example2" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
												<thead>
													<tr></tr>
													<tr role="row">
														<th>ID</th>
														<th>Tên đăng nhập</th>
														<th>Email</th>
														<th>Số điện thoại</th>
														<th>Địa chỉ</th>
														<th>Trạng thái</th>
														<th>Ngày tạo</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													@foreach($user6 as $u6)
													<tr>
														<td class="user6_{{$u6->id}}">{{$u6->id}}</td>
														<td>{{$u6->username}}</td>
														<td>{{$u6->email}}</td>
														<td>{{$u6->phone}}</td>
														<td>{{$u6->address}}</td>
														<td data-user6_id={{$u6->id}} id="show_status_6" data-id6={{$u6->status}}><a href="#">{{$u6->status==0?"Chưa kích hoạt":"Đã kích hoạt"}}</a></td>
														<td>{{ Carbon\Carbon::parse($u6->created_at)->format('d-m-Y')}}</td>
														<td>
															<div class="btn-group">
																<a id="delete_user" data-id={{$u6->id}}><i class="fa fa-fw fa-remove"></i></a>
																<a id="change_password" data-id={{$u6->id}}><i class="fa fa-unlock-alt"></i></a>
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
					</div>
					<!-- /#ion-icons -->

				</div>
				<!-- /.tab-content -->
			</div>
			<!-- /.nav-tabs-custom -->
		</div>
		<!-- /.col -->
	</div>
	<div class="modal fade" id="myModal6">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span></button>
						<h4 class="modal-title">Thông tin </h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-10 col-md-offset-1">
								<p><label>Họ Tên : </label> <span id="uname6"></span></p>
								<p><label>Email : </label> <span id="email6"></span></p>
								<p><label>Số Điện Thoại : </label> <span id="phone6"></span></p>
								<p>
									<div class="form-group row">
										<div class="col-md-3">
											<label>Trạng thái :</label>
										</div>
										<div class="col-md-9">
											<select class="form-control" id="status6">
												<option value="0" >Chưa kích hoạt</option>
												<option value="1" >Đã kích hoạt</option>
											</select>
										</div>
									</div>
								</p>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" data-user6_id='' id="save_change6" >Save changes</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.row -->
		<div class="modal fade" id="myModal3">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span></button>
							<h4 class="modal-title">Thông tin</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-10 col-md-offset-1">
									<p><label>Họ Tên : </label> <span id="uname3"></span></p>
									<p><label>Email : </label> <span id="email3"></span></p>
									<p><label>Số Điện Thoại : </label> <span id="phone3"></span></p>
									<p>
										<div class="form-group row">
											<div class="col-md-3">
												<label>Trạng thái :</label>
											</div>
											<div class="col-md-9">
												<select class="form-control" id="status3">
													<option value="0" >Chưa kích hoạt</option>
													<option value="1" >Đã kích hoạt</option>
												</select>
											</div>
										</div>
									</p>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary" data-user_id3='' id="save_change3" >Save changes</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
		</section>
		<script>
			$('table').on('click', '#show_status_6', function(event) {
				$('select')
				.removeAttr('selected')
				.filter('[value=0]')
				.attr('selected', true)
				$('.loading').fadeIn('400');
				var user_id=$(this).data('user6_id');
				$('#save_change6').data('user6_id',user_id);
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					url: "{{'/admin/ajax/getusernew'}}",
					data:{user_6:user_id},
					type:'GET',
					success: function(data){
						if(data.toString().indexOf("Permission Denied")==-1){
							$('.loading').hide();
							$('#uname6').html(data[0].username);
							$('#email6').html(data[0].email);
							$('#phone6').html(data[0].phone);
							$("#myModal6").modal();
						}
						else
						{
							$('.loading').hide();
							swal("Bạn Không có quyền!","", "error")
						}
					}
				});
			});
			$('#save_change6').click(function(event) {
				if($("#status3").val()==1)
				{
				$('.loading').fadeIn('400');
				var table = $('table').DataTable();
				var user_id=$(this).data('user6_id');
				$.ajax({
					url: '{{ url('/admin/ajax/editnewuser') }} ',
					type: 'POST',
					data: {user_6: user_id,process_id:$('#status6').val()},
					success:function (data) {
					// if(data.process_id=='false')
					// {
					// }
					// else
					// {
						swal({
							title: "Thông báo",
							text: "Update trạng thái thành công",
							type: "success",
							timer: 2000,
							showConfirmButton: false
						});
						table.row( $(".user6_"+user_id).parent('tr')).remove().draw();
						$('.loading').hide();
						$("#myModal6").modal('hide');
					}
				})
				}
				else{
					$("#myModal3").modal('hide');
				}       
			});


//user 3
$('table').on('click', '#show_status_3', function(event) {
	$('select')
	.removeAttr('selected')
	.filter('[value=0]')
	.attr('selected', true)
	$('.loading').fadeIn('400');
	var user_id=$(this).data('user3_id');
	$('#save_change3').data('user3_id',user_id);
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.ajax({
		url: "{{'/admin/ajax/getusernew'}}",
		data:{user_3:user_id},
		type:'GET',
		success: function(data){
			console.log(data);
				$('.loading').hide();
				$('#uname3').html(data[0].username);
				$('#email3').html(data[0].email);
				$('#phone3').html(data[0].phone1);
				$("#myModal3").modal();
		}
	});
});
$('#save_change3').click(function(event) {

	if($("#status3").val()==1)
	{
	$('.loading').fadeIn('400');
	var table = $('table').DataTable();
	var user_id=$(this).data('user3_id');
	$.ajax({
		url: '{{ url('/admin/ajax/editnewuser') }} ',
		type: 'POST',
		data: {user_3: user_id,process_id:$('#status3').val()},
		success:function (data) {
					// if(data.process_id=='false')
					// {
					// }
					// else
					// {
						swal({
							title: "Thông báo",
							text: "Update trạng thái thành công",
							type: "success",
							timer: 2000,
							showConfirmButton: false
						});
						table.row( $(".user3_"+user_id).parent('tr')).remove().draw();
						$('.loading').hide();
						$("#myModal3").modal('hide');
					}
				})
		} 
		else{
			$("#myModal3").modal('hide');
		}      
});

$('table').on('click', '#delete_user', function(event) {
	var table = $('table').DataTable();
	var r = $(this).parents('tr');
	var user_id=$(this).data('id');
	swal({
		title: "Bạn có chắc muốn xóa",
		text: "",
		type: "warning",
		showCancelButton: true,
		closeOnConfirm: false,
		showLoaderOnConfirm: true,
	},
	function(){
		$.ajax({
			url: "{{ url('admin/ajax/postDeleteUser') }} ",
			data:{user_id:user_id},
			type:'POST',
			success: function(data){
				if(data.toString().indexOf("Permission Denied")==-1){
            //$(".order_"+order_id).parent().remove();
            table.row( r ).remove().draw();
            swal("Xóa thành công!", "", "success");
        }
        else
        {
        	swal("Bạn Không có quyền!","", "error")
        }
    },
    error: function() {
    	swal("Xóa thất bại!", "", "error")
    }
});
	});
});
$('table').on('click', '#change_password', function() {
	$('.loading').fadeIn('400');
	var user_id=$(this).data('id');
	$.ajax({
		url: "{{ url('admin/user/ajaxGetChangePassword') }}",
		data:{user_id:user_id},
		type:'GET',
		success: function(data){
			if(data.toString().indexOf("Permission Denied")==-1){
				$('.loading').hide();
				$('#change_password_body').html(data);
				$("#change_password_modal").modal();
			}
			else
			{
				$('.loading').hide();
				swal("Bạn Không có quyền!","", "error");
			}
		}
	});
})	

$('#btn_change_password').click(function () {
	$("#form_change_password").validate({
		rules: {
			password: {
				required: true,
				minlength:6,
				maxlength:30,
			},
			re_password:{
				required: true,
				equalTo: "#password"

			}

		},
		messages: {
			password: {
				required: "Password không được để trống",
				minlength:"Password phải từ 6->30 ký tự",
				maxlength:"Password phải từ 6->30 ký tự"
			},
			re_password:{
				required: "Nhập lại password không được để trống",
				equalTo: "Password không khớp"

			}
		}
	});

	if($("#form_change_password").valid()){
		$.ajax({
			url: "{{ url('admin/user/ajaxPostChangePassword') }}",
			data:$('#form_change_password').serialize(),
			type:'POST',
			success: function(data){
				if(data.toString().indexOf("Permission Denied")==-1){
					swal({
						title: "Sửa thành công!",
						text: "",
						type:'success',
						timer: 1000,
						showConfirmButton: false
					});
					$("#change_password_modal").modal('hide');
				}
				else
				{
					swal("Bạn Không có quyền!","", "error");
				}
			}
		});
	}
})

</script>
@stop