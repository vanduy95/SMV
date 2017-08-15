@extends('layouts.master')
@section('content')
<section class="content-header">
	<h1>
		Permission Denied!
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box">
				<div class="box-header with-border">
					<i class="fa fa-info-circle"></i>
					<h3 class="box-title">Permission Denied</h3>
				</div>
				<div class="panel-body">
					<div class="form">
						{!!Form::open(array('class'=>'form-validate form-horizontal','id'=>'register_form'))!!}
						<div class="col-sm-12">
							<p style="text-align: center; font-size: 20px">You do not have permission to access this page, please refer to your system administrator</p>
							<p style="text-align: center; font-size: 17px">Bạn không có quyền truy cập vào trang này, hãy tham khảo ý kiến của người quản trị hệ thống</p>
						</div>
						{!!Form::close()!!}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@stop