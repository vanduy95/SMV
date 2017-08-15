@extends('layouts.master')
@section('content')
<style type="text/css">
  th{
    vertical-align: middle !important;
    text-align: center;
  }
  td{
    text-align: center !important;
    padding-right: 10px;
  }
  .form-excel{
    min-height: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>
<script>
  function myFun(){
    var x= document.getElementById("btnUpload").value.split("\\");
    document.getElementById("btnFile").value = x[2];
  }
</script>
<section class="content-header">
  <h1>
    Organization 
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/organization/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Organization</li>
  </ol>
</section>
<!-- list account -->
<section class="content">
 <div class="row">
  <div class="col-sm-12">
    <div class="box">
      <div class="box-header">
        <div class="col-lg-4">
          <h3 class="">List System</h3>
        </div>
        <div class="col-lg-8">
          <form class="form-group" action="{{url('admin/organization/list/company')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div>
              <label for="">Tệp tin Excel</label>
            </div>
            <div class="col-lg-6 col-sm-6 col-12">
              <div class="input-group">
                <label class="input-group-btn">
                  <span class="btn btn-primary">
                    Browse&hellip; <input id="btnUpload" name="upExcel" onchange="myFun();" type="file" style="display: none;">
                  </span>
                </label>
                <input type="text" id="btnFile" class="form-control" readonly>
              </div>
            </div>
            <div class="col-lg-6">
              <input type="submit" class="btn btn-primary col-lg-5" name="save"  value="Tải lên">
              <a href="company/excel/xls" class="btn btn-primary col-lg-offset-1 col-lg-5">Tải về danh sách</a>
            </div>
          </form>
        </div>
      </div>
      <div class="box-body">
       <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
          <thead>
            <tr role="row">
              <th>Ma</th>
              <th>Name</th>
              <th>City</th>
              <th>Address</th>
              <th>Phone</th>
              <th>Bank</th>
              <th>Cearted At</th>
              <th>Update At</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($company as $cp)
            <tr role="row" class="odd"> 
              <td>{{$cp->ma}}</td>
              <td>{{$cp->name}}</td>
              <td>{{$cp->city}}</td>
              <td>{{$cp->address}}</td>
              <td>{{$cp->phone}}</td>
              <td>{{$cp->bank}}</td>
              <td>{{date('d-m-Y',strtotime($cp->created_at))}}</td>
              <td>
                @if($cp->updated_at!='') {{date('d-m-Y',strtotime($cp->updated_at))}}
                @endif
              </td>
              <td>
                <div class="btn-group">
                  <a href="{{ url('admin/organization/show/company',$cp->id) }}" class="confirm" ><i onclick="return confirm('Are you sure??');" class="fa fa-fw fa-cog confirm"></i></a>
                  <a href="{{ url('admin/organization/del/company',$cp->id)}}"><i onclick="return confirm('Are you sure??');"
                    class="fa fa-fw fa-remove"></i></a> 
                  </div>
                </td>
              </tr>
              @endforeach
            </table>
            </div>
            @if(Session::has('message'))
            <p class="alert alert-info">{{ Session::get('message') }}</p>
            @endif
            @if(Session::has('mess_del'))
            <p class="alert alert-info">{{ Session::get('mess_del') }}</p>
            @endif
            @if(Session::has('mess_cexel'))
            <p class="alert alert-info">{{ Session::get('mess_cexel') }}</p>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>
  @stop