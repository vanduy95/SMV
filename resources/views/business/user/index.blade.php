@extends('layouts.master')
@section('content')
<script>
	function myFun(){
		var x= document.getElementById("btnUpload").value.split("\\");
		document.getElementById("btnFile").value = x[2];
	}
</script>
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
		User  
		<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">User</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">List User</h3>
				</div>
				<div class="box-body">
					<div class="table-responsive">

						<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
							<thead>
								<tr></tr>
								<tr role="row">
									<th>ID</th>
									<th>Group</th>
									<th>User Name</th>
									<th>Email</th>
									<th>Status</th>
									<th>Create date</th>
									<th>Update date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($user as $u)
								<tr>
									<td class="user_{{$u->id}}">{{$u->id}}</td>
									<td>{{$u->groupuser->name}}</td>
									<td>{{$u->username}}</td>
									<td>{{$u->email}}</td>
									<td>
										@if($u->status == 1)
										Kích hoạt
										@else
										Không kích hoạt
										@endif
									</td>
									<td>{{ Carbon\Carbon::parse($u->created_at)->format('d-m-Y')}}</td>
									<td>{{ Carbon\Carbon::parse($u->updated_at)->format('d-m-Y')}}</td>
									<td>
										<div class="btn-group">
											<a id="show_edit_user" data-id={{$u->id}}><i class="fa fa-fw fa-cog"></i></a>
											<a id="delete_user" data-id={{$u->id}}><i class="fa fa-fw fa-remove"></i></a>
											<a id="change_password" data-id={{$u->id}}><i class="fa fa-unlock-alt"></i></a>
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

	<div class="modal fade" id="edit_user_modal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span></button>
						<h4 class="modal-title">Sửa Người dùng</h4>
					</div>
					<div class="modal-body" id="edit_user">

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary"  id="btn_click" >Save changes</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>

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


			<script type="text/javascript">
				$(document).ready(function() {
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
					
					$('table').on('click', '#show_edit_user',function (event) {
						$('.loading').fadeIn('400');
						var user_id=$(this).data('id');
						$.ajax({
							url: "{{ url('admin/user/show') }}",
							data:{user_id:user_id},
							type:'GET',
							success: function(data){
								if(data.toString().indexOf("Permission Denied")==-1){
									$('.loading').hide();
									$('#edit_user').html(data);
									$("#edit_user_modal").modal();
								}
								else
								{
									$('.loading').hide();
									swal("Bạn Không có quyền!","", "error");
								}
							}
						});
					})

					$('#btn_click').click(function(event) {
						var temp='false';
						$.ajax({
							url: '{{ url('admin/ajax/checkEmail') }}',
							type: 'GET',
							async:false,
							data: {email: $('#email').val(),user_id:$('#user_id').val()},
							success:function (data) {
								
								temp=data;
								if(temp=='false')
								{
									$('#email_er').show();
								}
								else
								{
									$('#email_er').hide();
								}
							}
						});
						
						
						
		// jQuery.validator.addMethod("special_character", function(value, element) {
		// 	return  /[a-zA-Z0-9]+$/.test(value);
		// });
		// jQuery.validator.addMethod("email_validate", function(value) {
		// 	var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,10}$/i);
		// 	return pattern.test(value);
		// });
		$("#form_edit_user").validate({
			rules: {
				groupuser_id: {
					required: true,
				},
				username: {
					//special_character:true,
					required: true,
					minlength: 5,
					maxlength:225,
					remote: 
					{
						async:false,
						url: "{{ url('admin/ajax/checkUsername') }}",
						type: "get",
						data: {
							username:  function() {
								return $( "#username" ).val();
							},
							user_id:  function() {
								return $( "#user_id" ).val();
							},
						},
						
					}
				},
				email: {
					required: true,
					email:true,
				},
				status:{
					required:true,
				},
				syslock: {
					number:true,
				},
				organization:{
					required:true,
				},
			},
			messages: {
				groupuser_id: {
					required: "Group user không được để trống",
				},
				email: {
					required: "Email không được để trống",
					email: "Phải đúng định dạng email",
					remote:"email đã tồn tại"
				},
				username: {
					required: "Username không được để trống",
					minlength: "Username phải từ 5->255 ki tự",
					maxlength: "Username phải từ 5->255 ki tự",
					remote: "Đã tồn tại username này",
					special_character:"Username không được chứa ký tự đặc biệt"
				},
				status:{
					required:"Trạng thái không được để trống",
				},
				syslock: {
					number:"Phải là khiểu số",
				},
				organization:{
					required:'Cơ quan/Tổ chức không được để trống',
				},

			},

		});
		
		
		
		if($("#form_edit_user").valid() && temp=='true'){
			$('.loading').fadeIn('400');
			$.ajax({
				url: "{{ url('admin/user/show') }}",
				data:$('#form_edit_user').serialize(),
				type:'POST',
				success: function(data){
					$('.loading').hide();
					$("#edit_user_modal").modal('hide');
					$(".user_"+data.user.id).parent().find('td').eq(1).html(data.groupuser.name);
					$(".user_"+data.user.id).parent().find('td').eq(2).html(data.user.username);
					$(".user_"+data.user.id).parent().find('td').eq(3).html(data.user.email);
					if(data.user.status==1)
						$(".user_"+data.user.id).parent().find('td').eq(4).html('Kích hoạt');
					else
						$(".user_"+data.user.id).parent().find('td').eq(4).html('Không kích hoạt');
					$(".user_"+data.user.id).parent().find('td').eq(5).html(data.organization.name);
					swal({
						title: "Sửa thành công!",
						text: "",
						type:'success',
						timer: 1000,
						showConfirmButton: false
					});
				}
			});
		}

	})
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
				});
			</script>

		</section>
		@stop