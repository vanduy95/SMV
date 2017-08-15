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
               <a href="{{ url('admin/exportOrders') }}"><button class="btn btn-primary pull-right">Xuất danh sách</button></a>
            @endif
             
        </div>
        <div class="box-body">
         <div class="table-responsive">
          <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <thead>
              <tr></tr>
              <tr role="row">
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
              <tr>
                <td id="storeInfor" ><a href="#">{{$value->supmarket}}<a></td>
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
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Trạng thái đơn hàng</h4>
        </div>
        <div class="modal-body">
         <div class="row">
          <div class="col-md-10 col-md-offset-1">
           <p><label>Họ Tên : </label> <span id="name"></span></p>
           <p><label>Email : </label> <span id="email"></span></p>
           <p><label>Số Điện Thoại : </label> <span id="phone"></span></p>
           <p>
            <div class="form-group row">
             <div class="col-md-3">
              <label>Trạng thái :</label>
            </div>
            <div class="col-md-9">
              <select class="form-control" id="status">
                @foreach ($ProcessStatus as $status)
                <option value="{{$status->id}}">{{$status->name}}</option>
                @endforeach

              </select>
            </div>
          </div>
        </p>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" data-order_id='' id="save_change" >Save changes</button>
  </div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>

{{-- model edit --}}
<div class="modal fade" id="modal_editorder">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Cập nhập đơn hàng</h4>
        </div>
        <div class="modal-body" id="editorder_body">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary"  id="btn_click" >Save changes</button>
        </div>
      </div>
    </div>
  </div>

  {{-- model edit --}}
  <div class="modal fade" id="modal_store_id">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Thông tin siêu thị</h4>
          </div>
          <div class="modal-body" id="modal_store_id_body">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="UserInforModal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
              <h4 class="modal-title">Chi Tiết Khách Hàng</h4>
            </div>
            <div class="modal-body" id="Infor">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary"  id="save_user" >Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <script type="text/javascript">

       $(document).ready(function() {
        $('table').on('click', '#delete', function(event) {
          var table = $('table').DataTable();
          var r = $(this).parents('tr');
          var order_id=$(this).data('order_id');
          swal({
            title: "Bạn có chắc muốn xóa",
            text: "",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
          },
          function(){
            $.ajax({
              url: "{{ url('admin/ajax/postDeleteOrder') }} ",
              data:{order_id:order_id},
              type:'POST',
              success: function(data){
            //$(".order_"+order_id).parent().remove();
            if(data.toString().indexOf("Permission Denied")==-1){
             table.row( r ).remove().draw();
             swal("Xóa thành công!", "", "success");
           }
           else
           {
             $('.loading').fadeOut('fast');
             swal("Bạn Không có quyền!","", "error")
           }
         },
         error: function() {
           swal("Xóa thất bại!", "", "error")
         }
       });
          });
        });

        $('table').on('click', '#show_editorder', function(event) {
          var order_id=$(this).data('order_id');
          $('.loading').fadeIn('400');
          $.ajax({
            url: "{{ url('admin/ajax/getorderinfor') }}",
            data:{order_id:order_id},
            type:'GET',
            success: function(data){
              if(data.toString().indexOf("Permission Denied")==-1){
                $('#modal_editorder').modal();

                $('#editorder_body').html(data)

                $('.loading').fadeOut('400');
              }
              else
              {
               $('.loading').fadeOut('fast');
               swal("Bạn Không có quyền!","", "error")
             }
           },
           error:function () {
            $('.loading').fadeOut('400');
          }
        });

        });


      });
    </script>


    <script type="text/javascript">
      $(document).ready(function() {
        $.validator.addMethod("check_pre_pay", function (value, element) {
         if($('#pre_pay').val()==''&&$('#select_rate').val()=='')
          return false
        else
          return true

      }, 'phải chọn trả trước hoặc chọn tỷ lệ');

        $.validator.addMethod("min_price", function (value, element) {
         if($('#price').val().replace(".","").replace(".","").replace(".","").replace(".","").replace(".","").replace(".","")>0)
          return true
        else
          return false

      }, 'Giá phải lớn hơn 0');

        $.validator.addMethod("check_pre_pay_percent", function (value, element) {
          var price=$('#price').val().replace(".","").replace(".","").replace(".","").replace(".","").replace(".","");
          var prepay=$('#pre_pay').val().replace(".","").replace(".","").replace(".","").replace(".","").replace(".","");
          if(prepay/price < 0.3)
            return false
          else
            return true

        }, 'Trả trước phải lớn lơn 30% giá trị sản phẩm');


        $('#btn_click').click(function(event) {
          jQuery.validator.setDefaults({
            debug: true,
            success: "valid"
          });
          $("#orders_form").validate({
            rules: {
              product: {
                required: true,
                maxlength:225,
              },
              code_product: {
                required: true,
                maxlength: 50
              },
              price: {
                required: true,
                min_price:true,
              },
              pre_pay:{
                check_pre_pay:true,
                check_pre_pay_percent:true,
              },


              lead_month: {
                required: true,
                number:true,
                min:1,
                max:25,
              },
              market: {
                required:true
              },
              select_city: {
                required:true
              },
              select_dis: {
                required:true
              },
              select_store: {
                required:true
              }
            },
            messages: {
              product: {
                required: "Sản phẩm không được để trống",

                maxlength: "Tên sản phẩm phải từ 4->225 ký tự"
              },
              code_product: {
                required: "Mã sản phẩm không được để trống",

                maxlength: "Mã sản phẩm phải từ 3->50 ký tự",

              },
              price: {
                required: "Giá bán không được để trống",

              },
              pre_pay: {
                required: "Trả Trước không được để trống",
              },
              lead_month: {
                required: "Thời hạn không được để trống",
                number: "Thời hạn phải là số",
                min:"Thời hạn phải từ 1 -> 25",
                max:"Thời hạn phải từ 1 -> 25"
              },
              market: {
                required: "Sản phẩm không được để trống",
              },
              select_city: {
                required: "Thành phố không được để trống",
              },
              select_dis: {
                required: "Quận huyện không được để trống",
              },
              select_store: {
                required: "Cửa hàng không được để trống",
              },

            }
          });
          if($("#orders_form").valid()){

            $('#modal_editorder').modal('hide');
            $('.loading').fadeIn(400);
            $.ajax({
              url: "{{ url('admin/ajax/posteditorder') }}",
              data:$("#orders_form").serialize(),
              type:'POST',

              success: function(data){
                $(".order_"+data.id).parent().find('td').eq(0).html('<a href="#">'+data.supmarket+'</a>');
                $(".order_"+data.id).parent().find('td').eq(2).html(data.product_reg);

                $(".order_"+data.id).parent().find('td').eq(3).html(formatNumber(data.price) +' vnd');
                if(data.prepay==null)
                  $(".order_"+data.id).parent().find('td').eq(4).html(formatNumber(data.select_rate*data.price/100)+' vnd');
                else
                  $(".order_"+data.id).parent().find('td').eq(4).html(formatNumber(data.prepay)+' vnd');
                $(".order_"+data.id).parent().find('td').eq(5).html(data.lead_time+' tháng');
                $('.loading').fadeOut('400');
                swal({
                  title: "Sửa thành công!",
                  text: "",
                  type:'success',
                  timer: 1000,
                  showConfirmButton: false
                });
              },
              error:function () {
                $('.loading').fadeOut('400');
              }
            });
          }
        });

        function formatNumber (num) {
          return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
        }
      });

    </script>


  </section>
  @stop