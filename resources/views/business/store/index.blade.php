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
	<div class="col-lg-3">
		@if(Session::has('mess_excel'))
		<p class="alert alert-info">{{ Session::get('mess_excel') }}</p>
		@endif
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="box">
				<div class="box-body">
					<div class="table-responsive">

						<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
							<thead>
								<tr></tr>
								<tr role="row">
									<th>Hệ thống bán lẻ</th>
									<th>Thành phố</th>
									<th>Quận Huyện</th>
									<th>Tên trung tâm / Cửa hàng</th>
									<th>Địa chi trung tâm / Cửa hàng</th>
									<th>Số điện thoại liên hệ</th>
									{{-- <th>Username</th> --}}
									<th>Hoạt Động</th>		
								</tr>
							</thead>
							<tbody>
								@foreach($data as $dt)
								<tr>
									<td>{{$dt->nameretail}}</td>
									<td>{{$dt->retailcity}}</td>
									<td>{{$dt->retaildistrict}}</td>
									<td>{{$dt->name_center}}</td>
									<td>{{$dt->storeaddress}}</td>
									<td>{{$dt->phonecontact}}</td>
									{{-- <td>{{$dt->user->username}}</td> --}}
									<td>
										<div class="btn-group">
											<a href="{{ route('storeshow',$dt->id) }}"><i class="fa fa-fw fa-cog"></i></a>
											<a id="delete_store" data-id={{$dt->id}}><i class="fa fa-fw fa-remove"></i></a>
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
<script type="text/javascript">
	$('table').on('click', '#delete_store', function(event) {
		var table = $('table').DataTable();
		var r = $(this).parents('tr');
		var store_id=$(this).data('id');
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
				url: "{{ url('admin/ajax/postDeleteStore') }} ",
				data:{store_id:store_id},
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
</script>
</section>
@stop