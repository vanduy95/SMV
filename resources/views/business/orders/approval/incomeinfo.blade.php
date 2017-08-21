<section class="content">
 <div class="panel-body" style="padding: 0">
  <div class="form-horizontal row" id="edit_user_form" style="display: flex;justify-content: center;">
    <input type="hidden" name="user_id" id="user_id" value="{{$UserInfo['user_id']}}">
    <div class="col-md-9">
      <div class="form-group">
        <label class="control-label col-sm-4" for="name">Tên khách hàng : </label>
        <div class="col-sm-8"> 
           <label class="bg-gray-fix form-control">{{$UserInfo['fullname']}}</label>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="birthday">Số CMND : </label>
        <div class="col-sm-8"> 
        <label class="bg-gray-fix form-control">{{$UserInfo['identitycard']}}</label>
       </div>
     </div>
     <div class="form-group">
      <label class="control-label col-sm-4" for="birthday">Ngày cấp : </label>
      <div class="col-sm-8"> 
       <label class="bg-gray-fix form-control">{{date('d-m-Y', strtotime($UserInfo['dateissue']))}}</label>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4" for="issuedby">Nơi cấp : </label>
      <div class="col-sm-8"> 
        <label class="bg-gray-fix form-control">{{$UserInfo['issuedby']}}</label>
      </div>
    </div>
     <div class="form-group">
      <label class="control-label col-sm-4" for="phone">Số điện thoại liên hệ : </label>
      <div class="col-sm-8"> 
       <label class="bg-gray-fix form-control">{{$UserInfo['phone1']}}</label>
      </div>
    </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="birthday">Sức mua đã được cấp : </label>
        <div class="col-sm-8"> 
         <label class="bg-gray-fix form-control">{{number_format($total_buy)}} đồng</label>
        </div>
      </div>
      <div class="form-group">
      <label class="control-label col-sm-4" for="">Sức mua đã sử dụng:</label>
      <div class="col-sm-8"> 
         <label class="bg-gray-fix form-control">{{number_format($buys)}} đồng</label>
      </div>
    </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="birthday">Sức mua còn lại : </label>
        <div class="col-sm-8"> 
         <label class="bg-gray-fix form-control">{{number_format($buy)}} đồng</label>
        </div>
      </div>
      <h3 style="text-align: center;">THÔNG TIN CẦN XÁC THỰC</h3>
    <div class="form-group">
      <label class="control-label col-sm-4" for="phone2">Số điện thoại khác(nếu có): </label>
      <div class="col-sm-8"> 
        <input readonly type="text" tabindex="5" class="form-control" value="{{$UserInfo['phone2']}}">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4" for="time_work">Thời gian làm việc ở cty hiện tại *: </label>
      <div class="col-sm-8"> 
        <input readonly type="text" tabindex="5"  class="form-control" value="{{$UserInfo['time_worked']}}">
      </select>
    </div>
  </div>
   <div class="form-group">
      <label class="control-label col-sm-4" for="">Giao dịch trả lương qua tài khoản: </label>
      <div class="col-sm-8"> 
        <label class="bg-gray-fix form-control">
          @if ($UserInfo['exchange_status']==0)
            Liên tục 3 tháng liền kề 
          @elseif($UserInfo['exchange_status']==1)
            Liên tục 6 tháng liền kề 
          @elseif($UserInfo['exchange_status']==2)
            Không, hoặc không liên tục
          @endif
        </label>
      </div>
    </div>
    <div class="form-group">
    <input type="hidden" name="salary_avg" value="{{$UserInfo['salary_avg']}}">
      <label class="control-label col-sm-4" for="">Lương trung bình 3 tháng liền kề: </label>
      <div class="col-sm-8"> 
        <label class="bg-gray-fix form-control">
          @if ($UserInfo['salary_avg']!=null)
            {{str_replace(',','.',number_format($UserInfo['salary_avg']))}} đồng
          @endif
          
        </label>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4" for="">Ngày trả lương hàng tháng: </label>
      <div class="col-sm-8"> 
        <label class="bg-gray-fix form-control">{{$UserInfo['salary_day']}}</label>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4" for="number_acc">Số tài khoản : </label>
      <div class="col-sm-8"> 
       <label class="bg-gray-fix form-control">{{$UserInfo['number_account']}}</label>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4" for="bank">Ngân hàng: </label>
      <div class="col-sm-8"> 
      <label class="bg-gray-fix form-control">{{$UserInfo['bank_name']}}</label>
      </div>
    </div>
  </div> 
</div>
</div>
</section>