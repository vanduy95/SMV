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
							<form>
								<div class="row">
									<div class="col-md-5">
										<div class="form-group">
											<label>Company</label>
											<input type="text" class="form-control border-input" disabled="" placeholder="Company" value="Creative Code Inc.">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Username</label>
											<input type="text" class="form-control border-input" placeholder="Username" value="michael23">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="exampleInputEmail1">Email address</label>
											<input type="email" class="form-control border-input" placeholder="Email">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>First Name</label>
											<input type="text" class="form-control border-input" placeholder="Company" value="Chet">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Last Name</label>
											<input type="text" class="form-control border-input" placeholder="Last Name" value="Faker">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Address</label>
											<input type="text" class="form-control border-input" placeholder="Home Address" value="Melbourne, Australia">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>City</label>
											<input type="text" class="form-control border-input" placeholder="City" value="Melbourne">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Country</label>
											<input type="text" class="form-control border-input" placeholder="Country" value="Australia">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Postal Code</label>
											<input type="number" class="form-control border-input" placeholder="ZIP Code">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>About Me</label>
											<textarea rows="5" class="form-control border-input" placeholder="Here can be your description" value="Mike">Oh so, your weak rhyme
											</textarea>
										</div>
									</div>
								</div>
								<div class="text-center">
									<button type="submit" class="btn btn-info btn-fill btn-wd">Update Profile</button>
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