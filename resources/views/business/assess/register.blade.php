@extends('layouts.master')
@section('content')
<section class="content-header">
  <h1>
    Assess 
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Assess</li>
  </ol>
</section>
<!-- list account -->
<section class="content">
 <div class="row">
  <div class="col-sm-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Add New Assess</h3>
      </div>
      <div class="box-body">
        <form class="form-group" action="{{url('home/register')}}" method="POST">
          {{csrf_field()}}
          <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <tr class="form-group ">
              <td><label>Assess Point</label></td>
              <td><input type="text" class="form-control" name="point"></td>
            </tr>
            <tr class="form-group">
              <td><label>Assess Reted</label></td>
              <td><input type="text" class="form-control" name="reted"></td>
            </tr>
            <tr class="form-group">
              <td><label>Assess Review</label></td>
              <td><input type="text" class="form-control" name="review"></td>
            </tr>
            <tr class="form-group">
              <td><label>Assess Create</label></td>
              <td><input type="date" class="form-control" name="create_at"></td>
            </tr>
            <tr class="form-group">
              <td><input class="btn btn-primary" type="submit" name="Send"></td>
              <td><input class="btn btn-primary" type="reset" name="Reset"></td>
            </tr>
          </table>
        </form>
      </div>
    </div>
  </div>
</div>
</section>
@stop
