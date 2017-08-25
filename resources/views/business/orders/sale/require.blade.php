
<div class="box box-info">
  <div class="box-header with-border" style="padding: 0px">
    <h3 style="display: flex;justify-content: center;margin: 0px;">Hồ sơ yêu cầu:</h3>
  </div>
  <div class="box-body">
  <section class="content" style="padding: 10px 0px 10px 0px;min-height: initial;">
     <div class="panel-body">
     <div class="row text_center">
         <div class="text">
           <h4>Nhân viên bán hàng</h4>
           <p><i class="fa fa-check" aria-hidden="true"></i>Kiểm tra  chứng minh thư nhân dân khách hàng khi ký hợp đồng và giao hàng.</p>
           <p><i class="fa fa-check" aria-hidden="true"></i>Lưu bản sao chứng minh nhân dân của khách hàng để cung cấp cho Sức Mua Việt.</p>
         </div>
         <div class="text">
          <h4>Khách hàng ký nhận</h4>
          <p><i class="fa fa-check" aria-hidden="true"></i>Hợp đồng mua hàng (02)bản.</p>
          @if ($orders->user->userinfo->exchange_status!=2)
              <p><i class="fa fa-check" aria-hidden="true"></i>Phiếu yêu cầu thanh toán tự động (01 bản). Chú ý: Khách hàng ký nháy từng trang.</p>
           @endif
        </div>
      </div>
    </div>
  </section>
</div>