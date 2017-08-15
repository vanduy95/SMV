
  <form class="form-horizontal" action='' id="form_change_password">
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">New-Password:</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" id="password" placeholder="Nhập vào password mới" name="password">
        <input type="hidden" name="user_id" value="{{$user_id}}">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Re-Password:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="re_password" placeholder="Nhập lại password" name="re_password">
      </div>
    </div>
  </form>
