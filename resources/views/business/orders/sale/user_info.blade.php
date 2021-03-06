  <!-- /.box-header -->
  <div class="box-body">
    <section class="content" style="background: white; padding: 0px">
     <div class="panel-body">
      <div class="form-horizontal row" id="edit_user_form" >
        <input type="hidden" name="user_id" id="user_id" value="{{$UserInfo['user_id']}}">
        <div class="col-md-6">
          <h3 class="box-title" style="margin-bottom: 20px">Thông tin khách hàng :</h3>
          <div class="form-group">
            <label class="control-label col-sm-4" for="name">Họ tên khách hàng : </label>
            <div class="col-sm-8"> 
              <label class="bg-gray-fix form-control" name="name">{{$UserInfo['fullname']}}</label>
            </div>
            <label class="control-label col-sm-4" for="phone">Số điện thoại : </label>
            <div class="col-sm-8"> 
              <label  name="phone" id="phone" class="bg-gray-fix form-control">{{$UserInfo['phone1']}}</label>
            </div>
            <label class="control-label col-sm-4" for="sex">Giới Tính : </label>
            <div class="col-sm-8"> 
              <label for="" class=" bg-gray-fix form-control">{{$UserInfo->sex==1?"Nam":"Nữ"}}</label>
            </div>
            <label class="control-label col-sm-4" for="birthday">Ngày Sinh : </label>
            <div class=" col-lg-8 col-sm-8">
              <label class="bg-gray-fix form-control">{{date('d-m-Y',strtotime($UserInfo['birthday']))}}</label>
              <span id='error_date' style="color: red"></span>
            </div>
            <label class="control-label col-sm-4"  for="identitycard">Số CMND: </label>
            <div class="col-sm-8"> 
              <label  id="identitycard" class=" bg-gray-fix form-control">
                {{$UserInfo['identitycard']}}
              </label>
            </div>
            <label class="control-label col-sm-4" for="address1">Ngày cấp : </label>
            <div class="col-sm-8"> 
              <label class="bg-gray-fix form-control">
                @if ($UserInfo['type_identifycation']!=null)
                {{date('d-m-Y',strtotime($UserInfo['dateissue_identifycation']))}}
                @else
                {{date('d-m-Y',strtotime($UserInfo['dateissue']))}}
                @endif
              </label>
            </div>
            
            <label class="control-label col-sm-4" for="issuedby">Nơi cấp : </label>
            <div class="col-sm-8"> 
              <label class=" bg-gray-fix form-control">
               @if ($UserInfo['type_identifycation']!=null)
               {{$UserInfo['issuedby_identifycation']}}
               @else
               {{$UserInfo['issuedby']}}
               @endif
             </label>
           </div>
           <label class="control-label col-sm-4">Ảnh CMND :</label>
           <div class="col-sm-8">          
            <label class="bg-gray-fix form-control">
              @foreach (explode("***",$UserInfo->identitycard_image) as $key=>$img)
              @if ($img!='')
              <a class="text-info" href="#" id='show' data-image='{{$img}}'><i class="fa fa-file-image-o" aria-hidden="true"></i> CMND{{++$key}}</a>&nbsp;
              @endif
              @endforeach
            </label>
          </div>
           
        </div>
      </div> 
      <div class="col-md-6">
        <h3 class="box-title" style="margin-bottom: 20px">Thông tin đơn hàng  :</h3>
        <input type="hidden" name="orders_id" value="{{$orders->id}}">
        <div class="form-group">
          <label class="control-label col-sm-3">Tên sản phẩm:</label>
          <div class="col-sm-8">
           <label  name="product" class=" bg-gray-fix form-control">{{$orders->product_reg}}</label>  
         </div>
         <label class="control-label col-sm-3">Mã sản phẩm :</label>
         <div class="col-sm-8">
           <label class="bg-gray-fix form-control">{{$orders->product_code}}</label>
         </div>
         <label class="control-label col-sm-3">Màu sắc:</label>
         <div class="col-sm-8">          
          <label class="bg-gray-fix form-control">{{$orders->color}}</label>
        </div>
        <label class="control-label col-sm-3">Giá bán :</label>
        <div class="col-sm-8">
          <label  name="price" class="bg-gray-fix form-control">{{number_format($orders->price)}} đồng</label>           
        </div>
        <label class="control-label col-sm-3">Số tiền trả trước:</label>
        <div class="col-sm-8">          
          <label  name="prepay" class="bg-gray-fix form-control">{{number_format($orders->prepay)}} đồng</label>
        </div>
        
        <label class="control-label col-sm-3">Số tiền trả chậm :</label>
        <div class="col-sm-8">          
          <label class="bg-gray-fix form-control">
            {{number_format($orders->price-$orders->prepay)}} đồng
          </label>
        </div>
        <label class="control-label col-sm-3">Siêu thị cửa hàng :</label>
        <div class="col-sm-8">          
          <label class="bg-gray-fix form-control">
            {{$orders->store}}
          </label>
        </div>
         <label class="control-label col-sm-3">Công ty hiện tại: </label>
            <div class="col-sm-8"> 
             <label class=" bg-gray-fix form-control">{{$UserInfo->user->organization->name}}</label>
          </div>
      </div>
    </div>
  </div>
</div>
</section>
</div>
<!-- /.box-body -->
<!-- /.box-footer -->
</div>
<div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Ảnh</h4>
            </div>
            <div class="modal-body">
              <img src="" id="image_modal">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
      </div>

      <script type="text/javascript">
        $(document).ready(function() {
        $('body').on('click','#show',function(){
          $("#myModal").modal();
          $("#image_modal").attr('src', '/uploadfile/userinfo/'+$(this).data('image'));
        });
      });
      </script>