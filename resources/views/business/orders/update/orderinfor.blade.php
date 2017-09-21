
{!!Html::script('theme/plugins/jQuery_Ajax/jquery-ajax.js')!!}
{!!Html::script('theme/plugins/money_format/numeral_money.min.js')!!}
<section class="content">
       <div class="panel-body">
       <div class="form-horizontal" action="" id="orders_form">
          <div class="row">
            <div class="col-md-6">
              <input type="hidden" name="orders_id" value="{{$orders->id}}">
              <input type="hidden" id="interest_rate" value="{{$orders->retailSystem->interest_rate}}">
                <div class="form-group">
                  <label class="control-label col-sm-4">Sản phẩm *:</label>
                  <div class="col-sm-8">          
                    <input type="text" tabindex="1" class="form-control" value="{{$orders->product_reg}}" name="product">
                  </div>
                </div>
                 <div class="form-group">
                  <label class="control-label col-sm-4">Mã sản phẩm *:</label>
                  <div class="col-sm-8">          
                    <input type="text" tabindex="2" class="form-control" value="{{$orders->product_code}}" name="code_product">
                  </div>
                </div>
                 <div class="form-group">
                  <label class="control-label col-sm-4">Màu sắc:</label>
                  <div class="col-sm-8">          
                    <input type="text" tabindex="3" class="form-control" value="{{$orders->color}}" name="color">
                  </div>
                </div> 
                 <div class="form-group">
                  <label class="control-label col-sm-4">Giá bán *:</label>
                  <div class="col-sm-8">          
                    <input type="text" tabindex="4" onchange="ChangePrice();" id="price" class="form-control" placeholder="0 đồng" autocomplete="false" value="{{$orders->price}}" name="price">
                  </div>
                </div>
                 <div class="form-group">
                  <label class="control-label col-sm-4">Trả trước *:</label>
                  <div class="col-sm-8">          
                    <input type="text" tabindex="5" autocomplete="false" onchange="ChangePP()" class="form-control" value="{{ceil($orders->prepay)}}" name="pre_pay" id="pre_pay">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-4">Tỷ lệ trả trước :</label>
                  <div class="col-sm-8">          
                    <select name="select_rate" tabindex="6" id="select_rate" class="form-control" >
                    <option value="">Lựa chọn</option>
                      <option {{$orders->select_rate==0.3?"selected":""}} value="0.3">30%</option>
                      <option {{$orders->select_rate==0.4?"selected":""}} value="0.4">40%</option>
                      <option {{$orders->select_rate==0.5?"selected":""}} value="0.5">50%</option>
                      <option {{$orders->select_rate==0.6?"selected":""}} value="0.6">60%</option>
                      <option {{$orders->select_rate==0.7?"selected":""}} value="0.7">70%</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-4">Số tiền trả chậm:</label>
                  <div class="col-sm-8">          
                    <input type="text" tabindex="7" id="amount_slow" name="amount_slow" class="form-control" readonly value="{{number_format((double)$orders->price-(double)$orders->prepay)}}">
                  </div>
                </div>
                  <div class="form-group">
                  <label class="control-label col-sm-4">Thời hạn *:</label>
                  <div class="col-sm-8">          
                    <select tabindex="8" id="lead_month" name="lead_month" class="form-control">
                      <option value="">Chọn thời hạn</option>
                      <option {{$orders->lead_time==3?"selected":""}} value="3">3 tháng</option>
                      <option {{$orders->lead_time==4?"selected":""}} value="4">4 tháng</option>
                      <option {{$orders->lead_time==5?"selected":""}} value="5">5 tháng</option>
                      <option {{$orders->lead_time==6?"selected":""}} value="6">6 tháng</option>
                    </select>
                  </div>
                </div>
                 <div class="form-group">
                  <label class="control-label col-sm-4">Số tiền thanh toán hàng tháng: </label>
                  <div class="col-sm-8">        
                    <input type="text" tabindex="9" readonly autocomplete="off" id="slow_month" class="form-control" 
                    @if ($orders->lead_time)
                      value="{{number_format((($orders->retailSystem->interest_rate)*((double)$orders->price-(double)$orders->prepay)+((double)$orders->price-(double)$orders->prepay)/$orders->lead_time)+11000)}}"
                    @endif>
                  </div>
                </div>
                
            </div>
            <div class="col-md-6">
                {{--  <div class="form-group" style="padding-bottom: 45px">
                  <label class="control-label col-sm-4"></label>
                  <div class="col-sm-8">          
                    
                  </div>
                </div> --}}
                 <div class="form-group">
                  <label class="control-label col-sm-4">Hệ thống bán lẻ *:</label>
                  <div class="col-sm-8">          
                   <select name="admarket" tabindex="10" id="admarket" class="form-control">
                   <option value="">Chọn List</option>
                   @foreach ($retailsystem as $rs)
                     <option {{$orders->supmarket==$rs?"selected":""}} value="{{$rs}}">{{$rs}}</option>
                   @endforeach
                   </select>
                  </div>
                </div>
                  <div class="form-group">
                  <label class="control-label col-sm-4">Thành phố *:</label>
                  <div class="col-sm-8">          
                   <select name="adcity" tabindex="11" id="adcity" class="form-control">
                   <option value="{{$orders->city}}">{{$orders->city}}</option>
                   </select>
                  </div>
                </div>
                 <div class="form-group">
                  <label class="control-label col-sm-4">Quận/Huyện *:</label>
                  <div class="col-sm-8">          
                   <select name="addis" tabindex="12" id="addis" class="form-control">
                     <option value="{{$orders->district}}">{{$orders->district}}</option>
                   </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-4">Điểm bán lẻ *:</label>
                  <div class="col-sm-8">          
                   <select name="adstore" tabindex="13" id="adstore" class="form-control">
                     <option value="{{$orders->store}}">{{$orders->store}}</option>
                   </select>
                  </div>
                </div>
                  <div class="form-group">
                  <label class="control-label col-sm-4">Tên nhân viên bán hàng:</label>
                  <div class="col-sm-8">          
                   <input type="text" tabindex="14" value="{{$orders->salesman}}" class="form-control" name="salesman">
                  </div>
                </div>
                 <div class="form-group">
                  <label class="control-label col-sm-4">Số điện thoại nhân viên bán hàng:</label>
                  <div class="col-sm-8">          
                   <input type="number" tabindex="15" value="{{$orders->phonesale}}" class="form-control" name="phonesale">
                  </div>
                </div>

            </div>
          </div>
      </div>
        
     </div>




</section>