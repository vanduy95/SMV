<section class="content">
 <div class="panel-body" style="padding-top: 0px;">
  <div class="form-horizontal row" style="display: flex;justify-content: center;">
    <div class="col-md-9">
      <div class="form-group">
        <label class="control-label col-sm-4" for="name">Tên khách hàng : </label>
        <div class="col-sm-8"> 
          <input type="text" class="form-control" readonly value="{{$UserInfo['fullname']}}">
        </div>
      </div>
      
      <div class="form-group">
        <label class="control-label col-sm-4" for="identitycard">Số CMND *: </label>
        <div class="col-sm-8"> 
         <input readonly type="text" tabindex="1" id="identitycard" class="form-control" value="{{$UserInfo['identitycard']}}">
       </div>
     </div>
     <div class="form-group">
      <label class="control-label col-sm-4" for="">Ngày cấp * : </label>
      <div class="col-sm-8"> 
        <input readonly style="width: 100%" tabindex="2" type="text" id="" class="form-control" value="{{date('d-m-Y', strtotime($UserInfo['dateissue']))}}">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4" for="">Nơi cấp : </label>
      <div class="col-sm-8"> 
        <input readonly type="text" tabindex="3" class="form-control" value="{{$UserInfo['issuedby']}}">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4" for="phone">Số điện thoại liên hệ : </label>
      <div class="col-sm-8"> 
        <input readonly type="tel" id="phone" value="{{$UserInfo['phone1']}}" class="form-control">
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-4" for="birthday">Sức mua đã được cấp : </label>
      <div class="col-sm-8"> 
        <input type="text" class="form-control" id="pre_pay1" value="{{number_format($total_buy)}}" readonly>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4" for="">Sức mua đã sử dụng:</label>
      <div class="col-sm-8"> 
        <input type="text" id="buy_use" readonly class="form-control" value="{{number_format($buys)}}">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4" for="birthday">Sức mua còn lại : </label>
      <div class="col-sm-8"> 
        <input type="text"  id="buytxt" class="form-control" value="{{number_format($buy)}}" readonly>
      </div>
    </div>
    <h3 style="text-align: center;">THÔNG TIN CẦN XÁC THỰC</h3>
    <div class="form-group">
      <label class="control-label col-sm-4" for="phone2">Số điện thoại khác: </label>
      <div class="col-sm-8"> 
        <input readonly type="text" tabindex="5" class="form-control" value="{{$UserInfo['phone2']}}">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4" for="time_work">Thời gian làm việc ở cty hiện tại : </label>
      <div class="col-sm-8"> 
        <input readonly type="text" tabindex="5"  class="form-control" value="{{$UserInfo['time_worked']}}">
      </select>
    </div>
  </div>
  
  <div class="form-group">
    <label class="control-label col-sm-4" for="exchange_status">Giao dịch trả lương qua tài khoản : </label>
    <div class="col-sm-8"> 
      <input readonly tabindex="9" type="text"
          @if($UserInfo['exchange_status']==null)
            
          @elseif ($UserInfo['exchange_status']==0)
           value="Liên tục 3 tháng liền kề" 
          @elseif($UserInfo['exchange_status']==1)
             value="Liên tục 6 tháng liền kề"
          @elseif($UserInfo['exchange_status']==2)
            value="Không, hoặc không liên tục"
          @endif" id="" class="form-control">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-4" for="salary_avg">Lương trung bình 3 tháng liền kề : </label>
    <div class="col-sm-8"> 
      <input readonly tabindex="9" type="text" id="" class="form-control" 
      @if ($UserInfo['salary_avg'])
         value="{{number_format($UserInfo['salary_avg'],0,".",".")}} đồng"
      @endif
    >
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-4" for="salary_day">Ngày trả lương hàng tháng : </label>
    <div class="col-sm-8"> 
      <input readonly type="text"  id="salary_day"  value="{{$UserInfo['salary_day']}}" class="form-control">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-4" for="number_account">Số tài khoản : </label>
    <div class="col-sm-8"> 
      <input readonly type="text" tabindex="5"  class="form-control" value="{{$UserInfo['number_account']}}">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-4" for="bank_name">Ngân hàng : </label>
    <div class="col-sm-8"> 
      <input type="text" readonly value="{{$UserInfo['bank_name']}}" class="form-control" name="bank_name">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-4" for="">Ngày xác thực gần nhất: </label>
    <div class="col-sm-8"> 
      <input readonly type="text" id="updated_at" class="form-control" value="{{date('d-m-Y',strtotime($UserInfo['updated_at']))}}">
    </div>
  </div>
</div> 
</div>
</div>
</section>