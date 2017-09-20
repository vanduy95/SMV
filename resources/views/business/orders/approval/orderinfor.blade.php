<section class="content" style="padding: 0">
 <div class="panel-body" style="margin: 0">
   <form class="form-horizontal" action="" id="orders_form">
    <div class="row">
      <div class="col-md-6">
        <input type="hidden" name="orders_id" value="{{$orders->id}}">
        <div class="form-group">
          <label class="control-label col-sm-4">Sản phẩm:</label>
          <div class="col-sm-8">
           <label  name="product" class=" bg-gray-fix form-control">{{$orders->product_reg}}</label>  
         </div>
         <div class="clear"></div>
       </div>
       <div class="form-group">
        <label class="control-label col-sm-4">Mã sản phẩm :</label>
        <div class="col-sm-8">
         <label class="bg-gray-fix form-control">{{$orders->product_code}}</label>
       </div>
       <div class="clear"></div>
     </div>
     <div class="form-group">
      <label class="control-label col-sm-4">Màu sắc:</label>
      <div class="col-sm-8">          
        <label class="bg-gray-fix form-control">{{$orders->color}}</label>
      </div>
      <div class="clear"></div>
    </div> 
       <div class="form-group">
        <label class="control-label col-sm-4">Giá bán :</label>
        <div class="col-sm-8">
          <label  name="price" class="bg-gray-fix form-control">{{str_replace(',','.',number_format($orders->price))}} đồng</label>           
        </div>
        <div class="clear"></div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4">Trả trước:</label>
        <div class="col-sm-8">          
          <label  name="prepay" class="bg-gray-fix form-control">{{str_replace(',','.',number_format($orders->prepay))}} đồng</label>
        </div>
        <div class="clear"></div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4">Tỷ lệ trả trước :</label>
        <div class="col-sm-8">          
          <label class="bg-gray-fix form-control">
            @if(!empty($orders->select_rate))
            @if($orders->select_rate==0.3){{"30%"}} @elseif($orders->select_rate==0.4){{"40%"}} @elseif($orders->select_rate==0.5){{"50%"}} @elseif($orders->select_rate==0.6) {{"60%"}} @else {{"70%"}} @endif @endif
          </label>
        </div>
        <div class="clear"></div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4">Số tiền trả chậm:</label>
        <div class="col-sm-8">          
          <label class="bg-gray-fix form-control">{{str_replace(',','.',number_format($orders->price-$orders->prepay))}} đồng</label>
        </div>
        <div class="clear"></div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4">Thời hạn :</label>
        <div class="col-sm-8">          
          <label class="bg-gray-fix form-control">{{$orders->lead_time}}</label>
        </div>
        <div class="clear"></div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4">Số tiền thanh toán hàng tháng:</label>
        <div class="col-sm-8">          
          <label class="bg-gray-fix form-control">{{str_replace(',','.',number_format(($orders->retailSystem->interest_rate/100*((double)$orders->price-(double)$orders->prepay)+((double)$orders->price-(double)$orders->prepay)/$orders->lead_time)+11000))}} đồng</label>
        </div>
        <div class="clear"></div>
      </div>
       <div class="form-group">
        <label class="control-label col-sm-4">Ngày thanh toán hàng tháng:</label>
        <div class="col-sm-8">          
          <label class="form-control bg-gray-fix" >{{$day->day}}</label>
        </div>
        <div class="clear"></div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4">Ngày thanh toán đầu tiên:</label>
        <div class="col-sm-8">          
          <label class="bg-gray-fix form-control">{{date('d-m-Y',strtotime($day))}}</label>
        </div>
        <div class="clear"></div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4">Ngày thanh toán cuối cùng:</label>
        <div class="col-sm-8">          
          <label for="" class="form-control bg-gray-fix" >{{date('d-m-Y',strtotime($day->addMonths($orders->lead_time-1)))}}</label>
        </div>
        <div class="clear"></div>
      </div>
 </div>
 <div class="col-md-6">

   <div class="form-group">
    <label class="control-label col-sm-4">Hệ thống bán lẻ:</label>
    <div class="col-sm-8">          
      <label class="bg-gray-fix form-control">{{$orders->supmarket}}</label>
    </div>
    <div class="clear"></div>
  </div>
<div class="form-group">
  <label class="control-label col-sm-4">Thành phố:</label>
  <div class="col-sm-8">          
   <label class="bg-gray-fix form-control">{{$orders->city}}</label>
 </div>
 <div class="clear"></div>
</div>
<div class="form-group">
  <label class="control-label col-sm-4">Quận/Huyện:</label>
  <div class="col-sm-8">          
    <label class="bg-gray-fix form-control">{{$orders->district}}</label>
  </div>
  <div class="clear"></div>
</div>
<div class="form-group">
  <label class="control-label col-sm-4">Điểm bán lẻ:</label>
  <div class="col-sm-8">          
   <label class="bg-gray-fix form-control">{{$orders->store}}</label>
 </div>
 <div class="clear"></div>
</div>
  <div class="form-group">
      <label class="control-label col-sm-4">Tên nhân viên bán hàng:</label>
      <div class="col-sm-8">          
       <label class="bg-gray-fix form-control">{{$orders->salesman}}</label>
     </div>
     <div class="clear"></div>
   </div>
<div class="form-group">
  <label class="control-label col-sm-4">Số điện thoại nhân viên bán hàng:</label>
  <div class="col-sm-8">          
    <label class="bg-gray-fix form-control">{{$orders->phonesale}}</label>
  </div>
  <div class="clear"></div>
</div>
</div>
</div>
</form> 
</div>
</section>