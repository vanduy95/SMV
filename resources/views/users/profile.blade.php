@extends('layouts.master')
@section('content')
<section class="content-header">
	<h1>
		Profile
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">profile</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-3">
			<!-- Profile Image -->
			<div class="box box-primary">
				<div class="box-body box-profile">
					<img class="profile-user-img img-responsive img-circle" src="/theme/dist/img/profile.png" alt="User profile picture">

					<h3 class="profile-username text-center">{{$user->username}}</h3>

					<p class="text-muted text-center"><br></p>

					<ul class="list-group list-group-unbordered">
						<li class="list-group-item">
							<b>Group user</b> <a class="pull-right">{{$user->groupuser->name}}</a>
						</li>
						<li class="list-group-item">
							<b>Email</b> <a class="pull-right">{{$user->email}}</a>
						</li>
						<li class="list-group-item">
							<b>Amount</b> <a class="pull-right">13,287</a>
						</li>
					</ul>

					<a href="#" class="btn btn-primary btn-block"><b>Contact Admin</b></a>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
		<!-- /.col -->
		<div class="col-md-9">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#activity" data-toggle="tab">Profile</a></li>
				</ul>
				<div class="tab-content">
					<div class="active tab-pane" id="activity">
						<div class="content">
							{!!Form::open(array('class'=>'','id'=>'register_form'))!!}
							<div class="row">
								<div class="col-md-5">
									<div class="form-group">
										{!!Form::label('','Username',['class'=>''])!!}
										{!!Form::text('username',$user->username,['class'=>'form-control','placeholder'=>'Tên người dùng ','disabled'])!!}
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										{!!Form::label('','Group user',['class'=>''])!!}
										{!!Form::text('Group user',$user->groupuser->name,['class'=>'form-control border-input','placeholder'=>'Group user','disabled'])!!}
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										{!!Form::label('','Email address')!!}
										{!!Form::text('email',$user->email,['class'=>'form-control border-input','placeholder'=>'Email address'])!!}
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										{!!Form::label('','Password',['class'=>''])!!}
										<input type="password" class="form-control border-input" disabled="" value="{{$user->password}}">
										<span><a href="{{url('admin/profile/changepassword')}}">Change password</a></span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="text-center">
									<button type="submit" class="btn btn-primary">Update Profile</button>
								</div>
								<div class="clearfix"></div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@stop