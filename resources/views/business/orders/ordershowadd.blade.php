@extends('home_page.master')
@section('script')
  {!!Html::script('js/validate/validate_add_order.js')!!}
@endsection
@section('content')
<style rel="stylesheet">
 .form-group{
  margin-bottom: 5px !important;
}
.div-comment{
 color: red;
 font-style: italic;
}
.center-label{
  display: flex;
  align-items: center;
  justify-content: right;
}
#error_date{
  color:red;
}
label{
  margin: 0;
}
.background-content{
  background: none !important;
}
label.control-label.col-lg-4 {
    text-align: right;
}
</style>
{{-- start register --}}
<div id="success_register" class="col-lg-12 col-xs-18 col-md-12" style="background: url('../img/home_page/accountant.png') no-repeat; background-size: 100% 100%;padding: 0; display: none">
  <div class="pb-5 col-lg-12 col-md-12 col-xs-18  div-center"  style=" padding: 0; background:  rgba(255,255,255,0.7);">
    <div class="py-5 my-5 col-lg-6 col-md-10 col-xs-18">
      <div class="col-lg-12 col-md-12 col-xs-18" style="padding: 0">
        <h1 class="py-4 text-center" style="color: white; background: #1c1c70;margin: 0">THÔNG BÁO</h1>
      </div>
      <div class="pb-5 col-lg-12 col-md-12 col-xs-18" style="padding: 0;background: rgba(255,255,255,0.8); ">
        <div class="pt-5 col-lg-12 col-xs-18 col-md-12 form-group">
          <h3 class="text-center">QUÝ KHÁCH ĐÃ ĐĂNG KÝ THÀNH CÔNG</h3>
        </div>
        <div class="pt-3 col-lg-12 col-xs-18 col-md-12 form-group">
          <h4 class="text-center">Bạn có muốn tạo đơn hàng ngay</h4>
        </div>
        <div class="pt-3 pb-5 col-lg-12 col-xs-18 col-md-12 form-group div-center">
          <input type="button" id="btn_suc_reg" class="col-lg-2 col-md-3 col-xs-8 btn btn-primary" style="background: #1c1c70;color: white" value="Có">
          <a type="button" id="btn_dont_reg" class="col-lg-offset-1 col-lg-2 col-md-3 col-xs-8 btn btn-primary" style="background: #cccccc;color: white; border: 1px solid #cccccc" value="Không" href="{{route('getsearch')}}">Không</a>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="register_user" class="col-lg-12 " style="background: url('../img/home_page/accountant.png') no-repeat; background-size: 100% 100%;padding: 0; display: block">
  <div class="pb-5 col-lg-12 div-center" style="background: rgba(255,255,255,0.7);">
    <div class="my-5 pb-5 col-lg-7">
      <div class="col-lg-12" style="padding: 0">
        <h1 class="py-4 text-center text-sm" style="color: white; background: #1c1c70;margin: 0">ĐĂNG KÝ SỨC MUA VÀ ĐƠN HÀNG</h1>
      </div>
      <form action="postAjaxNewUserOrder" method="post" id="userifo_form">
        {{csrf_field()}}
        <div class="pb-5 col-lg-12 col-xs-12 col-md-12 " style="padding: 0;background: rgba(255,255,255,0.8); ">
          <div class="py-3 col-lg-12 col-md-12 col-xs-12 div-center" style="padding: 0">
            <div class="col-lg-4 col-md-4 col-xs-4" style="border: 1px solid black;margin: 0;padding:0;"></div>
            <div class="col-lg-4 col-md-4 col-xs-4"><span style="font-size: 2.1vw;" class="text-infoo">Thông tin cá nhân</span></div>
            <div class="col-lg-4 col-md-4 col-xs-4" style="border: 1px solid black;margin: 0;padding:0;"></div>
          </div>
          <div class="col-lg-12 form-group">
              <label class="control-label col-lg-4">Chọn công ty đang làm việc</label>
            <div class="col-lg-6" style="padding: 0">
              <select class="form-control" name="company" id="company">
                <option value="">Lựa chọn</option>
                @foreach ($company as $c)
                <option value="{{$c->id}}">{{$c->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-lg-12 form-group">
              <label class="control-label col-lg-4">Họ tên bạn</label>
            <div class="col-lg-6" style="padding: 0">
              <input type="text" name="name_user" id="name_user" class="form-control">
            </div>
          </div>
          <div class="col-lg-12 form-group">
              <label class="control-label col-lg-4">Mức lương</label>
            <div class="col-lg-6" style="padding: 0">
              <input type="text" id="salary_user" name="salary_user" class="form-control">
            </div>
          </div>
          <div class="col-lg-12 form-group">
              <label class="control-label col-lg-4">Số điện thoại</label>
            <div class="col-lg-6" style="padding: 0">
              <input type="text" name="phone_user" id="phone_user" class="form-control">
            </div>
          </div>
          <div class="col-lg-12 form-group">
              <label class="control-label col-lg-4">Địa chỉ thường trú</label>
            <div class="col-lg-6" style="padding: 0">
              <input type="text" name="address_user" id="address_user" class="form-control">
            </div>
          </div>
          <div class="col-lg-12 form-group">
              <label class="control-label col-lg-4">Số CMND</label>
            <div class="col-lg-6" style="padding: 0">
              <input type="text" name="number_issue" id="number_issue" class="form-control">
            </div>
          </div>
          <div class="col-lg-12 form-group">
              <label class="control-label col-lg-4">Ngày cấp</label>
            <div class="col-lg-6" style="padding: 0">
              <input id="date_issue_reg" name="date_issue" type="text" class="form-control">
              <label style="display: none;" id="date_issue_reg-error" class="error" for="date_issue_reg">Sản phẩm không được để trống</label>
            </div>
          </div>
          <div class="col-lg-12 form-group">
              <label class="control-label col-lg-4">Nơi cấp</label>
            <div class="col-lg-6" style="padding: 0">
              <input type="text" name="addr_issue" id="addr_issue" class="form-control">
            </div>
          </div>
          <div class="my-5 col-lg-12 col-md-12 col-xs-12 form-group div-center">
            <input type="button" id="btn_register" name="btn_register" value="Đăng ký sức mua" class="btn btn-primary col-lg-2 col-md-2 col-xs-3  div-center btn_font_xs" style="background: #160d65;font-size: 1vw;" />
            <input type="button" id="btn_new_orders" name="btn_new_orders" value="Nhập đơn hàng" class=" div-center col-lg-offset-1 btn btn-primary col-lg-2  col-md-2 col-xs-3 col-md-offset-1 col-xs-offset-1 div-center btn_font_xs " style="background: #160d65;font-size: 1vw;">
            <input type="submit" id="btn_upload" name="btn_upload" value="Tải phiếu đăng ký" class=" div-center col-lg-offset-1 btn btn-primary col-lg-2 col-md-2 col-xs-3 col-md-offset-1 col-xs-offset-1  div-center btn_font_xs " style="background: #160d65;font-size: 1vw;">
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
{{-- end register --}}
{{-- start create order --}}
<div id="success_order" class="col-lg-12 col-xs-18 col-md-12" style="background: url('../img/home_page/accountant.png') no-repeat; background-size: 100% 100%;padding: 0; display: none">
  <div class="pb-5 col-lg-12  div-center"  style=" padding: 0; background:  rgba(255,255,255,0.7);">
    <div class="py-5 my-5 col-lg-6 col-md-10 col-xs-18">
      <div class="col-lg-12 col-md-12 col-xs-18" style="padding: 0">
        <h1 class="py-4 text-center" style="color: white; background: #1c1c70;margin: 0">THÔNG BÁO</h1>
      </div>
      <div class="pb-5 col-lg-12 col-md-12 col-xs-18" style="padding: 0;background: rgba(255,255,255,0.8); ">
        <div class="pt-5 col-lg-12 col-xs-18 col-md-12 form-group">
          <h3 class="text-center">QUÝ KHÁCH ĐÃ ĐĂNG KÝ THÀNH CÔNG</h3>
        </div>
        <div class="pt-3 col-lg-12 col-xs-18 col-md-12 form-group">
          <h4 class="text-center">Tổng đài viên của Sức Mua Việt sẽ liên hệ</h4>
          <h4 class="text-center">với quý khách trong vòng 5 phút.</h4>
          <h4 class="text-center">Xin cảm ơn !</h4>
        </div>
        <div class="pt-3 pb-5 col-lg-12 col-xs-18 col-md-12 form-group div-center">
          <input type="button" id="btn_success_redirect" class="col-lg-2 col-md-3 col-xs-8 btn btn-primary" style="background: #1c1c70;color: white" value="OK">
        </div>
      </div>
    </div>
  </div>
</div>
<div id="create_order" class="col-lg-12" style="background: url('../img/home_page/accountant.png') no-repeat; background-size: 100% 100%;padding: 0; display: none">
  <div class="pb-5 col-lg-12 div-center" style="background: rgba(255,255,255,0.7);">
    <div class="my-5 pb-5 col-lg-8">
      <div class="col-lg-12" style="padding: 0">
        <h1 class="py-4 text-center text-sm" style="color: white; background: #1c1c70;margin: 0">ĐĂNG KÝ SỨC MUA VÀ ĐƠN HÀNG</h1>
      </div>
      <form action="postAjaxNewUserOrder" method="post" id="orders_form">
        {{csrf_field()}}
        <div class="pb-5 col-lg-12" style="padding: 0;background: rgba(255,255,255,0.8); ">
          <div class="py-3 col-lg-12 div-center" style="padding: 0">
            <div class="col-lg-4" style="border: 1px solid black"></div>
            <div class="col-lg-4" style="padding: 0"><span style="font-size: 35px;" class="text-infoo">Thông tin đơn hàng</span></div>
            <div class="col-lg-4" style="border: 1px solid black"></div>
          </div>
          <div class="pt-5 col-lg-12 form-groupabel">
              <label class="control-label col-lg-4">Tên khách hàng</label>
            <div class="col-lg-6 col-md-7 col-xs-18">
              <input name="name" id="fullname" readonly="" value="" type="text" class="form-control">
              <input type="hidden" id="user_id" name="user_id" value="">
              <input type="hidden" name="buytxt" value="" id="buytxt">
            </div>
          </div>
          <div class=" col-lg-12 form-group">
              <label class="control-label col-lg-4">Tên sản phẩm</label>
            <div class="col-lg-6 col-md-7 col-xs-18">
              <input name="product" id="product" autocomplete="off" type="text" class="form-control">
            </div>
          </div>
          <div class="col-lg-12 form-group cente">
              <label class="control-label col-lg-4">Mã sản phẩm</label>
            <div class="col-lg-6 col-md-7 col-xs-18">
              <input name="code_product" id="code_product" autocomplete="off" type="text" class="form-control">
            </div>
          </div>
          <div class=" col-lg-12 form-group">
              <label class="control-label col-lg-4">Màu sắc</label>
            <div class="col-lg-6 col-md-7 col-xs-18">
              <input name="color" id="color" autocomplete="off" type="text" class="form-control">
            </div>
          </div>
          <div class=" col-lg-12 form-group">
              <label class="control-label col-lg-4">Giá bán</label>
            <div class="col-lg-6 col-md-7 col-xs-18">
              <input id="price" onchange="ChangePrice();" autocomplete="off" name="price" type="text" class="form-control">
            </div>
          </div>
          <div class=" col-lg-12 form-group">
              <label class="control-label col-lg-4">Tỉ lệ trả trước</label>
            <div class="col-lg-6 col-md-7 col-xs-18">
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
          <div class=" col-lg-12 form-group">
              <label class="control-label col-lg-4">Hoặc nhập số tiền trả trước</label>
            <div class="col-lg-6 col-md-7 col-xs-18">
              <input type="text" name="pre_pay" autocomplete="off" onchange="ChangePP();" class="form-control" id="pre_pay">
            </div>
          </div>
          <div class=" col-lg-12 form-group">
              <label class="control-label col-lg-4">Chọn thời hạn</label>
            <div class="col-lg-6 col-md-7 col-xs-18">
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
          <div class=" col-lg-12 form-group">
              <label class="control-label col-lg-4">Chọn hệ thống bán hàng</label>
            <div class="col-lg-6 col-md-7 col-xs-18">
              <select name="market" class="form-control"  id="select_market">
                <option value="">Lựa Chọn</option>
                @foreach ($name as $m)
                <option value="{{$m}}">{{$m}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class=" col-lg-12 form-group">
              <label class="control-label col-lg-4">Chọn thành phố</label>
            <div class="col-lg-6 col-md-7 col-xs-18">
              <select id="select_city" name="select_city" class="form-control"  >
                <option value=""></option>
              </select>
            </div>
          </div>
          <div class=" col-lg-12 form-group">
              <label class="control-label col-lg-4">Chọn Quận Huyện</label>
            <div class="col-lg-6 col-md-7 col-xs-18">
              <select id="select_dis" name="select_dis" class="form-control"  >
                <option value=""></option>
              </select>
            </div>
          </div>
          <div class=" col-lg-12 form-group">
              <label class="control-label col-lg-4">Chọn cửa hàng</label>
            <div class="col-lg-6 col-md-7 col-xs-18">
              <select id="select_store" name="select_store" class="form-control"  >
                <option value=""></option>
              </select>
            </div>
          </div>
          <div class=" col-lg-12 form-group">
              <label class="control-label col-lg-4">Tên nhân viên bán hàng</label>
            <div class="col-lg-6 col-md-7 col-xs-18">
              <input type="text" id="name_sale" name="name_sale" autocomplete="off"  class="form-control">
            </div>
          </div>
          <div class=" col-lg-12 form-group">
              <label class="control-label col-lg-4">SĐT nhân viên bán hàng</label>
            <div class="col-lg-6 col-md-7 col-xs-18">
              <input type="text" id="phone_sale" name="phone_sale" autocomplete="off" class="form-control">
            </div>
          </div>
          <div class="my-5 col-lg-12 form-group div-center">
            <input type="button" id="btn_order_apply" value="ĐĂNG KÝ" class="btn btn-primary col-lg-2 col-md-4 col-xs-9" style="background: #160d65">
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
{{-- end create order  --}}
@stop