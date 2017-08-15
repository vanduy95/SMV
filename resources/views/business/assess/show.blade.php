@extends('layouts.master')
@section('content')
<section class="content-header">
	<h1>
		Assess
		<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Assess</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Edit Assess</h3>
				</div>
				<div class="panel-body">
					<div class="form form-group">
						<form class=" form-validate form-horizontal" method="POST">
							{{ csrf_field() }}		          
              @if(session('notify'))
              <div class="alert bg-teal disabled color-palette">
               {{session('notify')}}
             </div>
             @endif
             <div class="col-lg-8 form-group">
               <label class="control-label col-lg-4">Point</label>
               <input type="text" value="{{$edassess->point}}" name="point">
             </div>
             <div class="col-lg-8 form-group">
               <label class="control-label col-lg-4">Reted</label>
               <input type="text" value="{{$edassess->reted}}" name="reted">
             </div>
             <div class="col-lg-8 form-group">
               <label class="control-label col-lg-4">Review</label>
               <input type="text" value="{{$edassess->review}}" name="review">
             </div>

             <div class="col-lg-8 form-group">
               <input type="submit" name="Save">
               <input type="reset" name="Reset">
             </div>
           </form>

         </div>
       </div>
     </div>
   </div>
 </div>
</section>
@stop