
<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title"><b>Thông tin đơn hàng  :</b></h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
   <section class="content">
     <div class="panel-body">
       <div class="form-horizontal" action="" id="orders_form">
        <div class="row">
          <div class="col-md-6">
            <input type="hidden" name="orders_id" value="{{$orders->id}}">
            <div class="form-group">
              <label class="control-label col-sm-4">Tên sản phẩm:</label>
              <div class="col-sm-8">
               <label  name="product" class=" bg-gray-fix form-control">{{$orders->product_reg}}</label>  
             </div>
           </div>
           <div class="form-group">
            <label class="control-label col-sm-4">Màu sắc:</label>
            <div class="col-sm-8">          
              <label class="bg-gray-fix form-control">{{$orders->color}}</label>
            </div>
          </div> 
          <div class="form-group">
            <label class="control-label col-sm-4">Số tiền trả trước:</label>
            <div class="col-sm-8">          
              <label  name="prepay" class="bg-gray-fix form-control">{{number_format($orders->prepay)}} đồng</label>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-sm-4">Mã sản phẩm :</label>
            <div class="col-sm-8">
             <label class="bg-gray-fix form-control">{{$orders->product_code}}</label>
           </div>
         </div>

         <div class="form-group">
          <label class="control-label col-sm-4">Giá bán :</label>
          <div class="col-sm-8">
            <label  name="price" class="bg-gray-fix form-control">{{number_format($orders->price)}} đồng</label>           
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-4">Tỷ lệ trả trước :</label>
          <div class="col-sm-8">          
            <label class="bg-gray-fix form-control">
              @if(!empty($orders->select_rate))
                @if($orders->select_rate==0.3){{"30%"}} @elseif($orders->select_rate==0.4){{"40%"}} @elseif($orders->select_rate==0.5){{"50%"}} @elseif($orders->select_rate==0.6) {{"60%"}} @else {{"70%"}} @endif @endif
            </label>
          </div>
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