@extends('layouts.master')
@section('content')
<script>
  $(document).ready(function(){
    $("#form_upexcel").validate({
      rules:{
        text_Excel:{
          required: true,
        }
      },
      messages:{
        text_Excel: "Bạn chưa chọn danh sách cần tải lên",
      }
    });
  });
  function myFun(){
    var x= document.getElementById("btnUpload").value.split("\\");
    document.getElementById("btnFile").value = x[2];
  }
</script>
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
          <h3 class="">Danh sách hệ thống</h3>
        </div>
        <div class="col-lg-8">
          <form id="form_upexcel" class="form-group" action="{{url('admin/organization/list/company')}}" method="post" enctype="multipart/form-data">
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
                <input name="text_Excel" type="text" id="btnFile" class="form-control" readonly>
              </div>
              <label style="display: none" id="btnFile-error" class="error" for="btnFile">Bạn chưa chọn danh sách cần tải lên</label>
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
              <th>Mã</th>
              <th>Tên</th>
              <th>Thành phố</th>
              <th>Địa chỉ</th>
              <th>Số điện thoại</th>
              <th>Ngân hàng</th>
              <th>Ngày tạo</th>
              <th>Ngày cập nhật</th>
              <th>Hành động</th>
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
              <td>
                @if($cp->created_at!='') {{date('d-m-Y',strtotime($cp->created_at))}}
                @endif
              </td>
              <td>
                @if($cp->updated_at!='') {{date('d-m-Y',strtotime($cp->updated_at))}}
                @endif
              </td>
              <td>
                <div class="btn-group">
                  <a href="{{ url('admin/organization/show/company',$cp->id) }}" class="confirm" ><i onclick="return confirm('Bạn muốn sửa công ty này???');" class="fa fa-fw fa-cog confirm"></i></a>
                  <a href="{{ url('admin/organization/del/company',$cp->id)}}"><i onclick="return confirm('Bạn muốn xóa công ty này???');"
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
