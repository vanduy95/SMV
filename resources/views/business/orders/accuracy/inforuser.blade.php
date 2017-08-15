<section class="content" style="background: white">
 <div class="panel-body">
  <div class="form-horizontal row" id="edit_user_form" >
    <input type="hidden" name="user_id" id="user_id" value="{{$UserInfo['user_id']}}">
    <div class="col-md-6">
      <div class="form-group">
        <label class=" control-label col-sm-4" for="name">Tên khách hàng : </label>
        <div class="col-sm-8"> 
          <label class="bg-gray-fix form-control" name="name">{{$UserInfo['fullname']}}</label>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="birthday">Ngày Sinh : </label>
        <div class=" col-lg-8 col-sm-8">
          <label class="bg-gray-fix form-control">{{date('d-m-Y',strtotime($UserInfo['birthday']))}}</label>
          <span id='er_brithday' style="color: red"></span>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="identitycard">Số CMND : </label>
        <div class="col-sm-8"> 
          <label class="bg-gray-fix form-control" name="name">{{$UserInfo['identitycard']}}</label>
       </div>
     </div>
     <div class="form-group">
      <label class="control-label col-sm-4">Ngày cấp : </label>
      <div class="col-sm-8"> 
          <label class="bg-gray-fix form-control">{{date('d-m-Y',strtotime($UserInfo['dateissue']))}}</label>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4" for="issuedby">Nơi cấp : </label>
      <div class="col-sm-8"> 
          <label class="bg-gray-fix form-control">{{$UserInfo['issuedby']}}</label>
      </div>
    </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="employee_id">Mã nhân viên:</label>
        <div class="col-sm-8"> 
          <label class="bg-gray-fix form-control">{{$UserInfo['employee_id']}}</label>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="address2">Chức vụ: </label>
        <div class="col-sm-8"> 
          <label  name="timework" class="bg-gray-fix form-control">{{$UserInfo['position']}}</label>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="phone3">Phòng ban: </label>
        <div class="col-sm-8"> 
          <label name="identitycard" class=" bg-gray-fix form-control">{{$UserInfo['department']}}</label>
        </div>
      </div>
      <div class="form-group">
        <label class=" text-center col-sm-4 " for="address2">Thời gian làm việc ở cty hiện tại : </label>
        <div class="col-sm-8"> 
          <label  name="timework" class=" bg-gray-fix form-control">{{$UserInfo['time_worked']}}</label>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="phone3">Mức lương hiện tại: </label>
        <div class="col-sm-8"> 
          <label  name="salary" id="salary_info_accuary" class=" bg-gray-fix form-control">{{str_replace(',','.',number_format($UserInfo['salary']))." đồng"}}</label>
        </div>
      </div>
    </div>
      
    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label col-sm-4" for="sex">Giới Tính : </label>
        <div class="col-sm-8"> 
          {{-- <select class="form-control" name="sex">
            <option {{$UserInfo->sex==1?"selected":""}} value="1">Nam</option>
            <option {{$UserInfo->sex==0?"selected":""}} value="0">Nữ</option>
          </select> --}}
          <label for="" class=" bg-gray-fix form-control">{{$UserInfo->sex==1?"Nam":"Nữ"}}</label>
        </div>
      </div>   
      <div class="form-group">
        <label class="control-label col-sm-4" for="phone">Số điện thoại di động : </label>
        <div class="col-sm-8"> 
          <label  name="phone" id="phone" class="bg-gray-fix form-control">{{$UserInfo['phone1']}}</label>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="phone2">Số điện thoại khác : </label>
        <div class="col-sm-8"> 
          <label name="phone2" class="bg-gray-fix form-control">{{$UserInfo['phone2']}}</label>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="phone3">Điện thoại nhà riêng: </label>
        <div class="col-sm-8"> 
          <label name="identitycard" class=" bg-gray-fix form-control">{{$UserInfo['phone3']}}</label>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="address1">Địa chỉ thường trú : </label>
        <div class="col-sm-8"> 
          <label  name="address1" class="bg-gray-fix form-control"> {{$UserInfo['address1']}}</label>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="address2">Nơi ở hiện nay : </label>
        <div class="col-sm-8"> 
          <label  name="address2" class="bg-gray-fix form-control">{{$UserInfo['address2']}}</label>
        </div>
      </div>    
      <div class="form-group">
        <label class="control-label col-sm-4" for="address2">Ghi chú 1: </label>
        <div class="col-sm-8"> 
          <label name="note1" class="bg-gray-fix form-control">{{$UserInfo['note1']}}</label>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="address2">Ghi chú 2: </label>
        <div class="col-sm-8"> 
          <label name="note2" class="bg-gray-fix form-control">{{$UserInfo['note2']}}</label>
        </div>
      </div>
    </div> 
  </div>
</div>
<div class="clear"></div>
</section>