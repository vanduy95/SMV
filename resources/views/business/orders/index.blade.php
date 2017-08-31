@extends('layouts.master')
@section('content')
<style rel="stylesheet">
 .error{
  color:red;
}
</style>
<section class="content-header">
  <h1>
    Đơn hàng
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"></li>
  </ol>
</section>
<section class="content">
  @if(Session::has('success_accruracy'))<p class="alert alert-info">{{Session::get('success_accruracy')}}</p>@endif
  @if(Session::has('success_approval'))<p class="alert alert-info">{{Session::get('success_approval')}}</p>@endif
  <div class="row">
    <div class="col-sm-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Danh sách đơn hàng</h3>
            @if (Auth::user()->groupuser_id==6||Auth::user()->groupuser_id==7||Auth::user()->groupuser_id==8)
            <form class="form-inline pull-right" action="{{ url('admin/exportOrders') }}" method="post">
            {{csrf_field()}}
              <div class="form-group">
                <label for="date1">Từ:</label>
                <input type="date" class="form-control" name="date1" id="date1">
              </div>
              <div class="form-group">
                <label for="date2">đến:</label>
                <input type="date" class="form-control" name="date2" id="date2">
              </div>
              <button type="submit" class="btn btn-primary">Xuất danh sách</button>
            </form>
            @endif 
        </div>
        <div class="box-body">
         <div class="table-responsive">
          <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <thead>
              <tr></tr>
              <tr role="row">
                <th style="display: none">id</th>
                <th>Mã hóa đơn</th>
                <th>Siêu thị</th>
                <th>Khách hàng</th>
                <th>Sản phẩm</th>
                <th>Giá bán</th>
                <th>Trả trước</th>
                <th>Thời hạn</th>
                <th>Trạng thái đơn hàng</th>
                <th>Thời gian gửi yêu cầu</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($order as $value) 
                <tr class="tr" id="{{$value->id}}">
                <td  style="display: none">{{$value->id}}</td>
                <td>{{orderId($value->retailsystem_id,$value->id)}}</td>
                <td id="storeInfor"><a href="#">{{$value->supmarket}}<a></td>
                <td id="UserInfor"><a href="#">{{$value->user->userinfo->fullname}}</a></td>
                <td>{{$value->product_reg}}</td>
                <td>{{number_format($value->price)}} vnđ</td>
                <td>
                  @if($value->prepay != null)
                  {{number_format($value->prepay)}} vnđ
                  @else
                  {{number_format($value->select_rate*$value->price)}} vnđ
                </td>
                @endif
                <td>{{$value->lead_time}} tháng</td>
                <td data-user_id={{$value->user_id}} data-order_id={{$value->id}} id="show_status" class="order_{{$value->id}}" data-id={{$value->processstatus->id}}><a href="{{ url('admin/order_info') }}/{{$value->id}}">{{$value->processstatus->name}}</a></td>
                <td>{{Carbon\Carbon::parse($value->created_at)->format('H:i d-m-Y')}}</td>
                <td>
                 <div class="btn-group">
                  <a href="{{ url('admin/order_info') }}/{{$value->id}}" title="Thông tin đơn hàng"><i class="fa fa-fw fa-cog"></i></a>
                  {{--  <a id="delete" data-order_id={{$value->id}}><i class="fa fa-fw fa-remove"></i></a> --}}
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
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
  </section>
  <script type="text/javascript">
    $(document).ready(function() {
      $('table').on('click', '.tr',function(){
        window.location.href="{{ url('admin/order_info') }}/"+$(this).attr('id');
      });
    });
  </script>
  @stop