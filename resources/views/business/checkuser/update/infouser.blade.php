
<section class="content">
 <div class="panel-body">
  <div class="form-horizontal row">
    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label col-sm-4" for="name">Tên khách hàng *: </label>
        <div class="col-sm-8"> 
          <input type="text" class="form-control" tabindex="1" required name="name" value="{{$user->userinfo->fullname}}">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="birthday">Ngày Sinh *: </label>
        <div class="col-sm-8"> 
          <input type="date" style="width: 100%" tabindex="2" id="birthday" name="birthday" class="form-control" value="{{$user->userinfo->birthday}}">
          <label id="birthday-error" class="error" for="birthday" style="display: none"></label>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="identitycard">Số CMND *: </label>
        <div class="col-sm-8"> 
         <input type="text" name="identitycard" tabindex="3" id="identitycard" class="form-control" value="{{$user->userinfo->identitycard}}">
         <label id="identitycard-error" style="display: none" class="error" for="identitycard"></label>
       </div>
     </div>
     <div class="form-group">
      <label class="control-label col-sm-4" for="birthday">Ngày cấp * : </label>
      <div class="col-sm-8"> 
        <input style="width: 100%" tabindex="4" type="date" name="dateissue" id="dateissue" class="form-control" value="{{$user->userinfo->dateissue}}">
        <label id="dateissue-error" style="display: none" class="error" for="dateissue"></label>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4" for="issuedby">Nơi cấp : </label>
      <div class="col-sm-8"> 
        <input type="text" tabindex="5" name="issuedby" class="form-control" value="{{$user->userinfo->issuedby}}">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4" for="organization_id">Công ty hiện tại: </label>
      <div class="col-sm-8"> 
        <select class="form-control" name="organization_id">
          @foreach ($organization as $value)
          <option 
          @if ($value->id==$user->organization_id)
          selected
          @endif value="{{$value->id}}">{{$value->name}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4" for="employee_id">Mã nhân viên*:</label>
      <div class="col-sm-8"> 
        <input type="text" tabindex="6" class="form-control" id="employee_id" name="employee_id" value="{{$user->userinfo->employee_id}}">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4" for="position">Chức vụ *: </label>
      <div class="col-sm-8"> 
        <input type="text" name="position" tabindex="7" class="form-control" value="{{$user->userinfo->position}}">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4" for="department">Phòng ban *: </label>
      <div class="col-sm-8"> 
        <input type="text" name="department" tabindex="8" class="form-control" value="{{$user->userinfo->department}}">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4" for="time_work">Thời gian làm việc ở cty hiện tại *: </label>
      <div class="col-sm-8"> 
        <select class="form-control" name="time_work" tabindex="9">
          <option value="">chọn</option>
          <option value="Dưới 6 tháng" {{($user->userinfo->time_worked=='Dưới 6 tháng')?"selected":""}}>Dưới 6 tháng</option>
          <option value="Trên 6 tháng" {{($user->userinfo->time_worked=='Trên 6 tháng')?"selected":""}}>Trên 6 tháng</option>
          <option value="Đã nghỉ việc" {{($user->userinfo->time_worked=='Đã nghỉ việc')?"selected":""}}>Đã nghỉ việc</option>
          <option value="Không có thông tin" {{($user->userinfo->time_worked=='Không có thông tin')?"selected":""}}>Không có thông tin</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4" for="salary">Mức lương hiện tại *: </label>
      <div class="col-sm-8"> 
        <input type="text" tabindex="10" name="salary" id="salary_info" class="form-control" value="{{number_format($user->userinfo->salary)}}">
      </div>
    </div>
    

  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="control-label col-sm-4" for="sex">Giới Tính *: </label>
      <div class="col-sm-8"> 
        <select tabindex="11" class="form-control" name="sex">

          <option value="">Chọn giới tính</option>
          <option value="1" {{$user->userinfo->sex==1?"selected":""}}>Nam</option>
          <option value="2" {{$user->userinfo->sex==2?"selected":""}}>Nữ</option>
        </select>
      </div>
    </div>       
    <div class="form-group">
      <label class="control-label col-sm-4" for="phone">Số điện thoại di động *: </label>
      <div class="col-sm-8"> 
        <input type="tel" tabindex="12" name="phone1" id="phone1" class="form-control" value="{{$user->userinfo->phone1}}">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4" for="phone2">Số điện thoại khác : </label>
      <div class="col-sm-8"> 
        <input type="tel" tabindex="13" name="phone2" class="form-control" value="{{$user->userinfo->phone2}}">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4" for="phone3">Điện thoại nhà riêng: </label>
      <div class="col-sm-8"> 
        <input type="text" tabindex="14" name="phone3" class="form-control" value="{{$user->userinfo->phone3}}">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4"  for="address1">Địa chỉ thường trú *: </label>
      <div class="col-sm-8"> 
        <input type="text" name="address1" tabindex="15" class="form-control" value="{{$user->userinfo->address1}}">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4" for="address2">Nơi ở hiện nay * : </label>
      <div class="col-sm-8"> 
        <input type="text" name="address2" tabindex="16" class="form-control" value="{{$user->userinfo->address2}}">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4" for="note1">Ghi chú 1: </label>
      <div class="col-sm-8"> 
        <textarea name="note1" tabindex="17" class="form-control">{{$user->userinfo->note1}}</textarea>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4" for="note2">Ghi chú 2: </label>
      <div class="col-sm-8"> 
        <textarea name="note2" tabindex="18" class="form-control">{{$user->userinfo->note2}}</textarea>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4" for="phone4">Số điện thoại bổ sung trong quá trình xác thực: </label>
      <div class="col-sm-8"> 
        <input readonly type="text" tabindex="14" name="phone4" class="form-control" value="{{$user->userinfo->phone4}}">
      </div>
    </div>
  </div> 
</div>
</div>
</section>