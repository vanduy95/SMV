@extends('dashboard.sucmua.layouts')
@section('content')
<!-- Main content -->
{{-- login --}}
<section class="content col-lg-12 div-index" >
	<div class="col-lg-offset-2 col-sm-8 col-lg-8" > 
		<div class="col-lg-12 col-sm-12" style="text-align: center;">
			<div class="box " style="background: rgba(255, 255, 255,0.5)">
				<div class="box-header with-border">
					<h2>
						THÔNG TIN SỨC MUA
					</h2>
				</div>
				<div class="panel-body">
					<div class="form">
						{!!Form::open(array('class'=>'form-validate form-horizontal','id'=>'register_form'))!!}
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Tên khách hàng',['class'=>'control-label col-lg-3']))!!}
							<div class="col-lg-8">
								{!!Form::text('fullname',$fullname,['class'=>'form-control','id'=>'fullname'])!!}
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Tổng sức mua',['class'=>'control-label col-lg-3']))!!}
							<div class="col-lg-8">
								{!!Form::text('purchasingpower',$purchasingpower,['class'=>'form-control','id'=>'employee'])!!}
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Sức mua đã sử dụng',['class'=>'control-label col-lg-3']))!!}
							<div class="col-lg-8">
								{!!Form::text('result',$result,['class'=>'form-control','id'=>'employee'])!!}
							</div>
						</div>
						<div class="form-group ">
							{!!Html::decode(Form::label('fullname','Sức mua còn lại',['class'=>'control-label col-lg-3']))!!}
							<div class="col-lg-8">
								{!!Form::text('rest',$rest,['class'=>'form-control','id'=>'employee'])!!}
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-offset-2 col-lg-8">
								<a href="{{ url('orders',$user_id) }}"><i class="btn btn-primary">Đăng ký mua hàng</i></a>
								<a href="{{ url('orders/upload',$user_id) }}"><i class="btn btn-primary">Tải phiếu đăng ký</i></a>
							</div>
						</div>
						{!!Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@stop