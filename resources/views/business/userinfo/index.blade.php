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
</style>

<!-- List all Product -->
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
<div class="modal fade" id="progress" role="dialog">
	<div class="modal-dialog">
		
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Modal Header</h4>
			</div>
			<div class="modal-body">
				<div class="progress">
					<div class="progress-bar" id="progressbar" role="progressbar" aria-valuenow="0"
					aria-valuemin="0" aria-valuemax="100" style="width:0%">
					0%
				</div>
			</div>
		</div>
		
	</div>
	
</div>
</div>
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">List User Client</h3>
				</div>
				<div class="box-header">
					<div class="col-lg-8">
						<form class="div-center" action="" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="col-lg-3">
								<label>Tải lên danh sách:</label>
							</div>
							<div class="col-lg-6">
								<div class="input-group">
									<label class="input-group-btn">
										<span class="btn btn-primary">
											Browse&hellip; <input id="btnUpload" name="upExcel" onchange="myFun();" type="file" style="display: none;" multiple>
										</span>
									</label>
									<input id="btnFile" name="name_company" type="text" class="form-control" >
								</div>
							</div>
							<div class="col-lg-2">
								<input type="button" class="btn btn-primary" id="save" name="save"  value="UpLoad">
							</div>
						</form>
					</div>
					<div class=" col-lg-offset-2 col-lg-2"> 
						<a href="admin/user/xls"><input type="submit" class="btn btn-primary" value="Tải về danh sách" /></a>
					</div>
				</div>
				@if(Session::has('mess_userinfo'))
				<p class="alert alert-info">{{ Session::get('mess_userinfo') }}</p>
				@endif
				<div class="box-body">
					<div class="table-responsive">

						<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
							<thead>
								<tr></tr>
								<tr role="row">
									<th>User Name</th>
									<th>Name</th>
									<th>Reviews</th>
									<th>Phone</th>
									<th>Address</th>
									<th>SALARY</th>
									<th>MARITAL</th>
									<th>BIRTH DAY</th>
									<th>SEX</th>
									<th>IDENTITY CARD</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach($userinfo as $usf)
								<tr>
									<td><a href="{{url('admin/user/show',$usf->user_id)}}">{{$usf->user->username}}</a></td>
									<td>{{$usf->fullname}}</td>
									<td>{{$usf->assess->reviews}}</td>
									<td>{{$usf->phone1}}</td>
									<td>{{$usf->address1}}</td>
									<td>{{$usf->salary}}</td>
									<td>{{$usf->maritalstatus}}</td>
									<td>{{$usf->birthday}}</td>
									<td>{{$usf->sex}}</td>
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

	<script type="text/javascript">
		
		$(document).ready(function() {
			$('#save').click(function() {
				
				var formData = new FormData();
				formData.append('upExcel', $('#btnUpload')[0].files[0]);
				$('#progress').modal({backdrop: "static"});
				$.ajax({
					
					xhr: function() {
						var myXhr = $.ajaxSettings.xhr();
						if (myXhr.upload) {
                // For handling the progress of the upload
                myXhr.upload.addEventListener('progress', function(e) {
                	if (e.lengthComputable) {
                		var Percentage = Math.round(e.loaded/e.total)*100;
                		$('#progressbar').attr('aria-valuenow',Percentage).css('width',Percentage+'%').text(Percentage+'%');			
                		
                	}
                } , false);
            }
            return myXhr;
        },
        cache:false,
        url : '{{url('admin/userinfo')}}',
        type : 'POST',
        data : formData,
        processData: false,  
        contentType: false,
        success:function (data) {
        	$('#progress').modal('hide');
        }
    });
			})
		});
	</script>


</section>

<!-- page end-->
@stop