<section class="content" style="background: white">
  <div class="panel-body">
    <div class="form-horizontal row" id="edit_user_form" style="background: white; display: flex;justify-content: center;">
      <input type="hidden" name="user_id" id="user_id" value="{{$user->userinfo->user_id}}">
      <div class="col-md-9" >
        <div class="form-group">
          <label class="control-label col-sm-4" for="name">Tên khách hàng : </label>
          <div class="col-sm-8"> 
            <label class="form-control bg-gray-fix" name="name">{{$user->userinfo->fullname}}</label>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-4" for="">Số CMND : </label>
          <div class="col-sm-8"> 
            <label   name="" class="bg-gray-fix form-control">{{$user->userinfo->identitycard}}</label>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-4" for="">Ngày cấp : </label>
          <div class="col-sm-8"> 
            <label   name="" class="bg-gray-fix form-control">{{ Carbon\Carbon::parse($user->userinfo->dateissue)->format('d-m-Y')}}</label>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-4" for=" issuedby">Nơi cấp : </label>
          <div class="col-sm-8"> 
            <label   name="" class="bg-gray-fix form-control">{{$user->userinfo->issuedby}}</label>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-4" for="phone">Số điện thoại liên hệ : </label>
          <div class="col-sm-8"> 
            <input disabled type="text" name="phone" value="{{$user->userinfo->phone1}}" class="form-control">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-4" for="">Sức mua đã được cấp : </label>
          <div class="col-sm-8"> 
            <label   name="" class="bg-gray-fix form-control">{{str_replace(',','.',number_format($user->userinfo->salary*2.5))." đồng"}}</label>
          </div>
        </div>
        <h3 style="text-align: center;">THÔNG TIN CẦN XÁC THỰC</h3>
        <div class="form-group">
          <label class="control-label col-sm-4" for="phone2">Số điện thoại khác(nếu có): </label>
          <div class="col-sm-8"> 
            <input type="text" name="phone2" id="phone2" value="" class="form-control"/>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-4" for="time_work">Thời gian làm việc ở cty hiện tại *: </label>
          <div class="col-sm-8"> 
            <select class="form-control" name="time_work">
              <option value="">chọn</option>
              <option value="Dưới 6 tháng" >Dưới 6 tháng</option>
              <option value="Trên 6 tháng" >Trên 6 tháng</option>
              <option value="Đã nghỉ việc" >Đã nghỉ việc</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-4" for="exchange_status">Giao dịch trả lương qua tài khoản *: </label>
          <div class="col-sm-8"> 
            <select tabindex="7" class="form-control" name="exchange_status" id="exchange_status">
              <option  value="">chọn</option>
              <option value="0">Có phát sinh trong 3 tháng liền kề </option>
              <option  value="1">Có phát sinh trong 6 tháng liền kề </option>
              <option  value="2">Không phát sinh hoặc phát sinh dưới 3 tháng liền kề</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-4" for="">Lương trung bình 3 tháng liền kề: </label>
          <div class="col-sm-8"> 
            <input type="text" name="salary_avg" onchange="ChangeSalary_avg()" required id="salary_avg" value="" class="form-control" >
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-4" for="">Ngày trả lương hàng tháng: </label>
          <div class="col-sm-8"> 
            <input type="text" name="salary_day" id="salary_day" required value="" class="form-control">
          </div>
        </div>
        <div class="form-group" >
          <label class="control-label col-sm-4" for="number_acc">Số tài khoản : </label>
          <div class="col-sm-8"> 
            <input type="text" id="number_account" name="number_account" value="" class="form-control" >
          </div>
        </div>
        <div class="form-group" >
          <label class="control-label col-sm-4" for="bank">Ngân hàng: </label>
          <div class="col-sm-8"> 
            <select class="form-control" id="bank_name" required name="bank_name" tabindex="6">
              <option value="">Chọn ngân hàng</option>
              <option value="Techcombank" >Techcombank</option>
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12" align="center"><b>Ngày xác thực gần nhất : {{date('d-m-Y',strtotime($user->userinfo->updated_at))}}</b></div>
    </div>
    <div class="clear"></div>
  </section>