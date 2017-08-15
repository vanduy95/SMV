@extends('home_page.master')
@section('script')
  {!!Html::script('js/validate/validate_create_orders.js')!!}
@endsection
@section('content')
<style>
 .div-center{
   display: flex !important;
   align-items: center;
   justify-content: center;
 }
 .div-comment{
   color: red;
   font-style: italic;
 }
 .error{
  color:red;
}
.{
  display: flex;
  align-items: center;
  justify-content: right;
}
.background-content{
  background: none !important;
  text-align: center;
}
.form-group{
  margin-bottom: 3px;
}
label.control-label.col-lg-4 {
    text-align: right;
}
h1.register-order {
    font-size: 3vw;
}
@media screen and (max-width: 768px)
body{
  .register-order{
    font-size: 5vw;
  }
}
</style>
<script type="text/javascript">
  $(document).ready(function() {
    $("#lead_time").kendoDatePicker({
      format: "dd/MM/yyyy"
    });
  });
</script>
<div class="col-lg-12 " style="background: url('../img/home_page/accountant.png') no-repeat; background-size: 100% 100%;padding: 0">
  <div class="pb-5 col-lg-12  div-center" style="background: rgba(255,255,255,0.7);">
    <div class="my-5 pb-5 col-lg-8 ">
      <div class="col-lg-12 " style="padding: 0">
        <h1 class="py-4 text-center register-order text-sm" style="color: white; background: #1c1c70;margin: 0">ĐĂNG KÝ ĐƠN HÀNG</h1>
      </div>
      <form action="/orders/create" method="post" id="orders_form">
        {{csrf_field()}}
        <div class="pb-5 col-lg-12 " style="padding: 0;background: rgba(255,255,255,0.8); ">
          <div class="pt-5 col-lg-12  form-group ">
              <label class="control-label col-lg-4" for="">Tên khách hàng</label>
            <div class="col-lg-6 ">
              <input name="name" readonly="" value="{{$user->fullname}}" type="text" class="form-control">
              <input type="hidden" name="user_id" value="{{$user->user_id}}">
              <input type="hidden" name="buytxt" value="{{$buy}}" id="buytxt">
            </div>
          </div>
          <div class=" col-lg-12  form-group ">
              <label class="control-label col-lg-4" for="">Tên sản phẩm</label>
            <div class="col-lg-6 ">
              <input name="product" id="product" autocomplete="off" type="text" class="form-control">
            </div>
          </div>
          <div class="col-lg-12  form-group ">
              <label class="control-label col-lg-4" for="">Mã sản phẩm</label>
            <div class="col-lg-6 ">
              <input name="code_product" id="code_product" autocomplete="off" type="text" class="form-control">
            </div>
          </div>
          <div class=" col-lg-12  form-group ">
              <label class="control-label col-lg-4" for="">Màu sắc</label>
            <div class="col-lg-6 ">
              <input name="color" id="color" autocomplete="off" type="text" class="form-control">
            </div>
          </div>
          <div class=" col-lg-12  form-group ">
              <label class="control-label col-lg-4" for="">Giá bán</label>
            <div class="col-lg-6 ">
              <input id="price" onchange="ChangePrice();" autocomplete="off" name="price" type="text" class="form-control">
            </div>
          </div>
          <div class=" col-lg-12  form-group ">
              <label class="control-label col-lg-4" for="">Tỉ lệ trả trước</label>
            <div class="col-lg-6 ">
              <select class="form-control" name="select_rate" id="select_rate">
                <option value="">Lựa Chọn</option>
                <option value="0.3">30%</option>
                <option value="0.4">40%</option>
                <option value="0.5">50%</option>
                <option value="0.6">60%</option>
                <option value="0.7">70%</option>
              </select>
            </div>
          </div>
          <div class=" col-lg-12  form-group ">
              <label class="control-label col-lg-4" for="">Hoặc nhập số tiền trả trước</label>
            <div class="col-lg-6 ">
              <input type="text" name="pre_pay" autocomplete="off" onchange="ChangePP();" class="form-control" id="pre_pay">
            </div>
          </div>
          <div class=" col-lg-12  form-group ">
              <label class="control-label col-lg-4" for="">Chọn thời hạn</label>
            <div class="col-lg-6 ">
              {{-- <input type="text" id="lead_time" class="form-control" placeholder="Vd: 25/11/2018"> --}}
              <select class="form-control" name="lead_month" id="lead_month">
                <option value="">Lựa Chọn</option>
                <option value="3">3 tháng</option>
                <option value="4">4 tháng</option>
                <option value="5">5 tháng</option>
                <option value="6">6 tháng</option>
              </select>
            </div>
          </div>
          <div class=" col-lg-12  form-group ">
              <label class="control-label col-lg-4" for="">Chọn hệ thống bán hàng</label>
            <div class="col-lg-6 ">
              <select name="market" class="form-control"  id="select_market">
                <option value="">Lựa Chọn</option>
                @foreach ($name as $m)
                <option value="{{$m}}">{{$m}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class=" col-lg-12  form-group ">
              <label class="control-label col-lg-4" for="">Chọn thành phố</label>
            <div class="col-lg-6 ">
              <select id="select_city" name="select_city" class="form-control"  >
                <option value=""></option>
              </select>
            </div>
          </div>
          <div class=" col-lg-12  form-group ">
              <label class="control-label col-lg-4" for="">Chọn Quận Huyện</label>
            <div class="col-lg-6 ">
              <select id="select_dis" name="select_dis" class="form-control"  >
                <option value=""></option>
              </select>
            </div>
          </div>
          <div class=" col-lg-12  form-group ">
              <label class="control-label col-lg-4" for="">Chọn cửa hàng</label>
            <div class="col-lg-6 ">
              <select id="select_store" name="select_store" class="form-control"  >
                <option value=""></option>
              </select>
            </div>
          </div>
          <div class=" col-lg-12  form-group ">
              <label class="control-label col-lg-4" for="">Tên nhân viên bán hàng</label>
            <div class="col-lg-6 ">
              <input type="text" name="name_sale" autocomplete="off"  class="form-control">
            </div>
          </div>
          <div class=" col-lg-12  form-group ">
              <label class="control-label col-lg-4" for="">SĐT nhân viên bán hàng</label>
            <div class="col-lg-6 ">
              <input type="text" name="phone_sale" autocomplete="off" class="form-control">
            </div>
          </div>
          <div class="my-5 col-lg-12  form-group div-center">
            <input type="submit" value="ĐĂNG KÝ" class="btn btn-primary col-lg-2 col-md-4 col-xs-9" style="background: #160d65">
          </div>
        </div>
      </div>
    </div>
  </form>
 {{--  <script type="text/javascript">
    $(document).ready(function() {
     $.validator.addMethod("min_price", function (value, element) {
      if($('#price').val().replace('.','').replace('.','').replace('.','').replace('.','').replace('.','').replace(' đồng','')>0){
        //$('#price-error').remove();
        return true;
      }
      else
        return false

    }, 'Giá phải lớn hơn 0');
     $.validator.addMethod("check_pre_pay", function (value, element) {
       if($('#pre_pay').val()==''&&$('#select_rate').val()=='')
        return false
      else
        return true
    }, 'Phải nhập giá trả trước hoặc chọn tỷ lệ');
     $.validator.addMethod("check_pre_pay_percent", function (value, element) {
      var price=$('#price').val().replace('.','').replace('.','').replace('.','').replace('.','').replace('.','').replace('đồng','').replace(' ','');
      var prepay=$('#pre_pay').val().replace('.','').replace('.','').replace('.','').replace('.','').replace('.','').replace('đồng','').replace(' ','');
      if((parseInt(prepay)/parseInt(price)<0.3))
        return false
      else
        return true

    }, 'Trả trước phải lớn lơn 30% giá trị sản phẩm');
     $.validator.addMethod("check_pre_pay_vs_price", function (value, element) {
      var price=$('#price').val().replace('.','').replace('.','').replace('.','').replace('.','').replace('.','').replace(' đồng','');
      var prepay=$('#pre_pay').val().replace('.','').replace('.','').replace('.','').replace('.','').replace('.','').replace(' đồng','');
      if(parseInt(prepay)>parseInt(price))
        return false
      else
        return true

    }, 'Trả trước phải nhỏ hơn giá trị sản phẩm');

     $.validator.addMethod("check_price_vs_buy", function (value, element) {
      var price=$('#price').val().replace(/[ đồng,.]/g,'');
      var prepay=$('#pre_pay').val().replace(/[ đồng,.]/g,'');
      var buytxt=$('#buytxt').val().replace(/[ đồng,.]/g,'');
      alert(buytxt);
      if(parseInt(buytxt)<parseInt(price-prepay))
        return false
      else
        return true
    }, 'Bạn không đủ sức mua ');

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
          check_price_vs_buy:true,
        },
        pre_pay:{
          check_pre_pay:true,
          check_pre_pay_percent:true,
          check_pre_pay_vs_price:true,
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
          required: "Bạn chưa chọn hệ thống bán hàng",
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

   });
 </script> --}}
</div>
@stop