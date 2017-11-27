@extends('home_page.master')
@section('content')
<section class="container-fluid" style="padding: 0">
	<div class="background-xs col-lg-12 col-xs-12 col-md-12" style="padding: 0">
		<div  class="banner-content col-lg-12 col-md-12 col-xs-12" style="padding: 0">
			<div class="bg-content col-xs-12 col-md-12" style="padding: 0">
				<div id="alert_info" class="container-fluid div-flex col-lg-12 col-xs-12 col-md-12" style="position: absolute; min-height: 100%; background: rgba(0,0,0,0.6);z-index: 999999; display: none;">
					<div class="col-lg-5 col-xs-12 col-md-12">
						<div class="col-lg-12 col-md-12 col-xs-12"  style="background: #170e66">
							<h1 class="text-center" style="color: white">THÔNG TIN HỘI VIÊN</h1>
						</div>
						<div class="pb-md-2 pb-5 col-lg-12 col-md-12 col-xs-12" style="min-width: 100%; background: white">
							<div class="col-lg-12 col-md-12 col-xs-12 text-center">
								<h3><b>Thông tin hội viên chưa được xác thực</b></h3>
							</div>
							<div class="col-lg-12 col-md-12 col-xs-12 text-center">
								<p>Bạn có thể nhập lại thông tin hoặc đăng ký mới. Thông tin</p>
							</div>
							<div class="col-lg-12 col-md-12 col-xs-12 text-center">
								<p>đăng ký mới của bạn sẽ được xác nhận trong 10 phút.</p>
							</div>
							<div class="pb-md-5 pb-5 col-lg-12 col-md-12 col-xs-12 div-flex">
								<input class="col-lg-4 col-md-5 col-xs-9 btn btn-primary" id="btn_retype" type="button" value="Nhập lại thông tin" style="background: #cccccc; border: 1px solid #cccccc">
								<input class="col-lg-3 col-md-5 col-xs-5 col-xs-offset-1 col-md-offset-1 col-lg-offset-1 btn btn-primary" id="btn_new_reg" type="button" value="Đăng ký hội viên" style="background: #170e66" >
							</div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="form-info col-lg-12 col-md-12 col-xs-12">
					<div class="reset-margin-md col-lg-5 col-md-6 col-xs-12 mx-4">
						<div class="col-lg-12 col-md-12 col-xs-12">
						</div>
						<div class="clear"></div>
					</div>
					<div class="pd-left-md pt-5 pt-md-5 col-lg-6 col-md-6 col-xs-12">
						<div class=" pd-left-md title-banner pt-xs-0 pt-md-5 pt-5  mt-5 mt-xs-5 mt-md-5 pl-5 pl-md-5 col-lg-12 col-md-12 col-xs-12">
							<p class="pd-left-md text-resize pd-top-md pt-5 pt-md-5 pl-5 pl-md-5 col-lg-12 col-md-12 col-xs-12" style="color: white; font-size: 24px; padding: 0;font-weight: 700;font-family: Arial">ĐẶC QUYỀN DÀNH CHO HỘI VIÊN</p>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="form-data col-lg-12 col-md-12 col-xs-12">
					<div class="col-lg-offset-1 col-lg-5 col-md-6 col-xs-12">
						<div class=" py-xs-0 py-md-0 py-5 col-lg-12 col-md-12 col-xs-12"></div>
						<div class="data-left col-lg-12 col-md-12 col-xs-12 pull-right pr-2 pr-xs-0 pr-md-2">
							<h1 class="text-right pr-4 pr-xs-0 pr-md-0 col-xs-12 col-md-12" style="margin: 0; font-weight: bold; font-family:  Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;color: white" >AN TÂM MUA SẮM</h1>
							<h3 class="col-xs-12 col-md-12 text-right pr-4 pr-xs-0 pr-md-0" style="margin: 0; font-weight: bold;font-family:  Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;color: white">THOẢI MÁI LỰA CHỌN</h3>
						</div>
						<div class="py-xs-0 py-md-0 py-3 col-lg-12 col-md-12 col-xs-12"></div>
						<div class="data-left-rate-xs col-lg-12 col-md-12 col-xs-12">
							<p class="pull-right" style="color:#feb426; text-shadow: 2px 5px 10px black; font-weight: bold; font-family:Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;margin: 0 ">0% LÃI SUẤT</p>
						</div>
						<div class="data-left-text-xs col-lg-12 col-md-12 col-xs-12">
							<p  class="pull-right" style="margin: 0;font-family:Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif; color: white"><span>&nbsp</span>Áp dụng với tất cả các sản phẩm tại</p>
							<p class="pull-right"  style="font-family:Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif; color: white">toàn bộ hệ thống cửa hàng của Đối tác.</p>
						</div>
						<div class="clear"></div>
					</div>
					<div class="form-search-lg col-lg-6  col-md-6 col-xs-12" style="padding: 0">
						<div class="col-lg-11 col-md-11 col-xs-12" style="padding: 0">
							<form style="padding: 0; display: block; background: rgba(198,197,214,0.85)" action="" id="register_form" class="form-group my-3 col-lg-8 col-md-8 col-xs-12">
								{{csrf_field()}}
								<div class="col-lg-12 col-md-12 col-xs-12" style="background: rgb(0,83,167);display: flex;align-items: center; justify-content: center;">
									<p class="my-3" style="color: white;font-size: 2.1vw; font-weight: 600">KIỂM TRA SỨC MUA CỦA BẠN</p>	
								</div>
								<div class="py-xs-0 py-md-4 py-4 col-lg-12 col-md-12 col-xs-12 form-group"></div>
								<div class=" col-lg-12 col-md-12 col-xs-12 form-group">
<!-- 									<input name="name" id="text-input" class="form-control text-padding-input" style="border-radius: 0; height: 4.5rem;position: relative;" type="text" placeholder="Nhập tên công ty" autocomplete="off">
									<input type="hidden" id="id_company" />
									<div id="data-company" style="height: 200px; position: absolute;z-index: 999999 ;background: white;overflow-y: scroll;padding: 0" class="col-lg-11 col-md-11 col-xs-17">
										@foreach ($company as $c)
										<option value="{{$c->id}}">{{$c->name}}</option>
										@endforeach
									</div>  -->
<!-- 									<select id="id_company" name="selectpicker_lg" class="col-xs-10 col-md-12 form-control selectpicker"  data-id='selectpicker_lg' data-show-subtext="true" data-live-search="true">
										<option value="">Chọn công ty</option>
										@foreach ($company as $c)
										<option value="{{$c->id}}">{{$c->name}}</option>
										@endforeach
									</select>
									<p class="text-center error" id="error_com"></p> -->
								</div>
								<div class=" col-lg-12 col-md-12 col-xs-12 form-group">
									<input  autocomplete="off" id="txt_cmt" name="txt_cmt" class="form-control text-padding-input" style="border-radius: 0; height: 4.5rem" type="text" placeholder="Nhập số chứng minh nhân dân">
									<p class="text-center error" id="error_cmt"></p>
								</div>
								<!-- <div class=" col-lg-12 col-md-12 col-xs-12 form-group">
									<input autocomplete="off" id="txt_code" name="txt_code" class="form-control text-padding-input" style="border-radius: 0; height: 4.5rem" type="text" placeholder="Nhập mã nhân viên">
									<p class="text-center error" id="error_code"></p>
								</div> -->
								<div class=" col-lg-12 col-md-12 col-xs-12 div-flex  form-group" style="display: flex; justify-content: space-around;">
									<input class="div-flex my-3 btn-submit-form col-lg-5 col-md-5" type="button" name="submit_search" id="submit_search" value="Kiểm tra sức mua">
									<input class="div-flex my-3 btn-submit-form col-lg-5 col-md-5" 
									id="btn_new_reg_show" name="btn_new_reg_show" type="button" value="Đăng ký hội viên">
								</div>
								<div class="clear"></div>
							</form>
							<form style="padding: 0; display: none;background: rgba(198,197,214,0.85)" action="/orders/show" id="data_form" method="post" class="form-group my-3 col-lg-8 col-md-8 col-xs-12">
								{{csrf_field()}}
								<div class="col-lg-12 col-md-12 col-xs-12" style="background: rgb(0,83,167);display: flex;align-items: center; justify-content: center;">
									<p class="my-3" style="color: white;font-size: 2.1vw; font-weight: 600">THÔNG TIN KHÁCH HÀNG</p>	
								</div>
								<div class="py-0 col-lg-12 col-md-12 col-xs-12 form-group"></div>
								<div class=" col-lg-12 col-md-12 col-xs-12 form-group">
									<label for="">Tên khách hàng</label>
									<input name="u_name" id="u_name" class="form-control text-padding-input" style="border-radius: 0; height: 4.5rem;position: relative;" type="text" placeholder="Nhập tên công ty" autocomplete="off" readonly />
									<input type="hidden" id="id_user" />
								</div>
								<div class=" col-lg-12 col-md-12 col-xs-12 form-group">
									<label for="">Tổng sức mua</label>
									<input  class="form-control text-padding-input"  id="sum_buy" name="sum_buy" style="border-radius: 0; height: 4.5rem" type="text" placeholder="Nhập số chứng minh nhân dân" readonly="">
								</div>
								<div class=" col-lg-12 col-md-12 col-xs-12 form-group">
									<label for="">Sức mua đã sử dụng</label>
									<input class="form-control text-padding-input" id="buy_use" name="buy_use" style="border-radius: 0; height: 4.5rem" type="text" placeholder="Nhập mã nhân viên" readonly="">
								</div>
								<div class=" col-lg-12 col-md-12 col-xs-12 form-group">
									<label for="">Sức mua còn lại</label>
									<input id="rest" name="rest" class="form-control text-padding-input" style="border-radius: 0; height: 4.5rem" type="text" readonly="">
								</div>
								<div id="next_register" class=" col-lg-12 col-md-12 div-flex form-group">
									<div class="col-lg-4 col-md-4" style="padding: 2px">
										<input class="col-lg-12 col-md-12 col-xs-12 btn btn-primary" name="btn_orders"  style="font-size: 9pt !important;padding-left: 0;padding-right: 0" type="submit" value="Đăng kí mua hàng">
									</div>
									<div class="col-lg-4 col-md-4" style="padding: 2px">
										<input class="col-lg-12 col-xs-12 col-md-12 btn btn-primary" type="submit" name="btn_upload"  style="font-size: 9pt !important;padding-left: 0;padding-right: 0" id="upload" value="Tải phiếu đăng ký">
									</div>
									<div class="col-lg-4 col-md-4" style="padding: 2px">
										<input class="col-lg-12 col-xs-12 col-md-12 btn btn-primary" type="submit" name="btn_update_info" id="btn_update_info" style="font-size: 9pt !important;padding-left: 0;padding-right: 0" value="Cập nhật hồ sơ cá nhân">
									</div>
								</div>
								<div class="col-lg-12" id="dont_next" style="display: none">
									<div class="col-lg-12">
										<p id="notify" class="text-center" style="color: red; margin: 0">Sức mua hiện tại của bạn không đủ thực hiện giao dịch. Liên hệ với chúng tôi để được hỗ trợ.</p>
										<p id="hotline" class="text-center"><span class="text-center" style="color: red" id="phone"></span></p>
									</div>
									<div class="mb-2 col-lg-12 div-flex">
										<a href="#" id="return_local" style="max-width: 100%;" class="btn btn-primary col-lg-6">Quay về trang chủ</a>
									</div>
									<div class="clear"></div>
								</div>
								<div class="clear"></div>
							</form>
						</div>
					</div>
					<div class="py-xs-0 py-md-0 py-4 col-lg-12 col-md-12 col-xs-12"></div>		
					<div class="clear"></div>
				</div>
			</div>
		</div>
		<div class="div-partner col-lg-12 col-md-12 col-xs-12" style="padding: 0">
			<div class="col-lg-12 col-md-12 col-xs-12 text-center" style="padding-top: 20px;">
				<p style="font-weight: bold; color: #4c4c4c; font-size: 25px;">ĐỐI TÁC CỦA CHÚNG TÔI</p>
			</div>
			<div class="mb-5 col-lg-12 col-md-12 col-xs-12 div-flex">
				<div class="border-partner-xs col-lg-1 col-md-1 col-xs-2" style="border: 4px solid #4c4c4c;background: #4c4c4c"></div>
			</div>
			<div class="col-lg-12 pb-5 col-md-12 col-xs-12 div-flex">
				<div class="col-lg-3 col-md-12 col-xs-9 mr-5">
					<img style="width: 100%" src="../img/home_page/mediamart.png" alt="">
				</div>
				<div class="col-lg-3 ml-5 col-md-12 col-xs-9 mr-5">
					<img style="width: 100%" src="../img/home_page/digiCity.png" alt="">
				</div>
				<div class="col-lg-3 ml-5 col-md-12 col-xs-9">
					<img style="width: 100%" src="../img/home_page/doangia.png" alt="">
				</div>
			</div>
			{{-- <div class="col-lg-10 py-3">
			<p class="text-right"><b>+51 trung tâm</b></p>
		</div> --}}
		<div class="clear"></div>
	</div>
	<div class="form-search-xs col-lg-12 col-md-12 col-xs-12 " style="display: none; padding: 0">
		<div id="alert_info_xs" class="container-fluid div-flex col-lg-12 col-xs-12 col-md-12" style="position: absolute; min-height: 100%; background: rgba(0,0,0,0.8);z-index: 999999; display: none;width: 100%;">
			<div class="col-lg-5 col-xs-12 col-md-12" style="padding: 0">
				<div class="col-lg-12 col-md-12 col-xs-12"  style="background: #170e66">
					<h1 class="text-center py-2" style="color: white;font-size: 5vw;margin: 0">THÔNG TIN HỘI VIÊN</h1>
				</div>
				<div class="pb-md-2 pb-5 col-lg-12 col-md-12 col-xs-12" style="min-width: 100%; background: white">
					<div class="py-2 col-lg-12 col-md-12 col-xs-12 text-center">
						<h5 class="text-vw-3" style="margin: 0;"><b>Thông tin hội viên chưa được xác thực</b></h5>
					</div>
					<div class="col-lg-12 col-md-12 col-xs-12 text-center">
						<p  class="text-vw-3">Bạn có thể nhập lại thông tin hoặc đăng ký mới. Thông tin</p>
					</div>
					<div class="col-lg-12 col-md-12 col-xs-12 text-center">
						<p  class="text-vw-3">đăng ký mới của bạn sẽ được xác nhận trong 10 phút.</p>
					</div>
					<div class="col-lg-12 col-md-12 col-xs-12 div-flex">
						<input class="col-lg-4 col-md-5 col-xs-6 btn btn-primary" id="btn_retype_xs" type="button" value="Nhập lại thông tin" style="background: #cccccc; border: 1px solid #cccccc; font-size: 3vw">
						<input class="col-lg-3 col-md-4 col-xs-5 col-lg-offset-1 col-xs-offset-1 col-md-offset-1 btn btn-primary" id="btn_new_reg_xs" type="button" value="Đăng ký hội viên" style="background: #170e66; font-size: 3vw" >
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class=" col-md-12 col-xs-12" style="padding: 0">
			<div class="title-banner-xs col-lg-12 col-md-12 col-xs-12">
				<p class="text-vw-5	 col-lg-12 col-md-12 col-xs-12">ĐẶC QUYỀN DÀNH CHO HỘI VIÊN</p>
			</div>
			<div class="col-md-12 col-xs-12 div-flex" style="padding: 0;">
				<form id="register_form_xs" class="form-banner-xs col-md-12 col-xs-12" style="padding: 0;" action="">
					{{csrf_field()}}
					<div class="col-md-12 col-xs-12" style="background: rgb(0,83,167);">
						<p class="text-vw-5 py-xs-0 py-md-3" style="color: white; font-weight: 600;padding: 5px;">Kiểm tra sức mua của bạn</p>	
					</div>
					<div class="col-md-12 col-xs-12" style="padding:0">
						<!-- <div class="text-center col-md-12 col-xs-12 form-group">
							<label for="">Tên công ty</label>
							<div class="col-md-12 col-xs-12">
								<div class="col-xs-12 div-flex" style="padding:0">
									<select id="selectpicker_xs" name="selectpicker_xs" class="col-xs-12 col-md-12 form-control selectpicker" data-idxs='selectpicker_xs'  data-show-subtext="true" data-live-search="true">
										<option style="font-size: 3.2vw;color: black" value="">Chọn công ty</option>
										@foreach ($company as $c)
										<option style="font-size: 3.2vw;color: black" value="{{$c->id}}">{{$c->name}}</option>
										@endforeach
									</select>
								</div>
								<p  class="error" id="error_com_xs"></p>
							</div>
						</div> -->
						<div class="text-center col-md-12 col-xs-12">
							<label for="">Chứng minh nhân dân</label>
							<div class="col-md-12 col-xs-12">
								<div class="col-xs-12 div-flex" style="padding:0">
									<input id="number_iden" class="form-control col-xs-10" name="number_iden" type="text">
								</div>
								<p class="error"  id="error_cmt_xs"></p>
							</div>
						</div>
						<!-- <div class="text-center col-md-12 col-xs-12">
							<label for="">Mã số nhân viên</label>
							<div class="col-md-12 col-xs-12">
								<div class="col-xs-12 div-flex" style="padding:0">
									<input id="code_employ" class="form-control col-xs-10" name="code_employ" type="text">
								</div>
								<p class="error"  id="error_code_xs"></p>
							</div>
						</div> -->
						<div class="col-md-12 col-xs-12 py-2">
							<div class="col-md-12 col-xs-12 py-2">
								<div class="col-md-12 col-xs-12 div-flex py-2" style="padding:0">
									<input id="btn_search_xs" class="  col-md-4 col-xs-5 btn btn-primary" type="button" style="background: #170e66; border-radius: 10px;align-items: center !important; font-size: 3.3vw;" value="Kiểm tra">
									<input class="col-xs-offset-1 col-md-4 col-xs-5 btn btn-primary" 
									id="btn_new_reg_xs_show" name="btn_new_reg_xs_show" type="button" style="background: #170e66; border-radius: 10px;align-items: center !important; font-size: 3.3vw;" value="Đăng ký hội viên">
								</div>
							</div>
						</div>
						<div class="clear"></div>
					</form>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="col-md-12 col-xs-12 div-flex" style="padding: 0;">
				<form id="data_form_xs" class="form-banner-xs col-md-12 col-xs-12" style="padding: 0; display: none" action="/orders/show" method="post">
					{{csrf_field()}}
					<div class="col-md-12 col-xs-12" style="background: rgb(0,83,167);">
						<p class="" style="color: white;font-size: 6vw; font-weight: 600;padding: 0px;margin:0">Thông tin khách hàng</p>	
					</div>
					<div class="col-md-12 col-xs-12">
						<div class="text-center col-md-12 col-xs-12">
							<label for="">Họ tên</label>
							<div class="col-md-12 col-xs-12">
								<div class="col-xs-12 div-flex">
									<input id="u_name_xs" class="form-control" readonly="" type="text">
									<input id="id_user_xs" type="hidden" style="display: none">
								</div>
								<p></p>
							</div>
						</div>
						<div class="text-center col-md-12 col-xs-12">
							<label for="">Tổng sức mua</label>
							<div class="col-md-12 col-xs-12">
								<div class="col-xs-12 div-flex">
									<input id="sum_buy_xs" class="form-control col-xs-10"  readonly="" name="" type="text">
								</div>
								<p></p>
							</div>
						</div>
						<div class="text-center col-md-12 col-xs-12">
							<label for="">Sức mua đã sử dụng</label>
							<div class="col-md-12 col-xs-12">
								<div class="col-xs-12 div-flex">
									<input id="buy_use_xs" class="form-control col-xs-10" readonly=""  name="" type="text">
								</div>
							</div>
						</div>
						<div class="text-center col-md-12 col-xs-12">
							<label for="">Sức mua còn lại</label>
							<div class="col-md-12 col-xs-12">
								<div class="col-xs-12 div-flex">
									<input id="rest_xs" class="form-control col-xs-10"  readonly="" name="" type="text">
								</div>
							</div>
						</div>
						<div id="next_register_xs" class="col-md-12 col-xs-12 py-2" style="padding: 0">
							<div class="col-md-12 col-xs-12 py-2" style="padding: 0">
								<div class="col-xs-12 div-flex py-2" style="padding: 0">
									<input id="btn_orders_xs" name="btn_orders_xs" class="col-xs-3 col-xs  btn btn-primary" type="submit" style="background: #170e66; border-radius: 10px;font-size: 10px;" value="Đăng ký mua hàng">
									<input id="" name="" class="col-xs-offset-1  col-xs-3 col-xs  btn btn-primary" type="submit" style="background: #170e66; border-radius: 10px;font-size: 10px;" value="Cập nhật hồ sơ cá nhân">
									<input id="btn_upload_xs" name="btn_upload_xs" class="col-xs-offset-1  col-xs-3 col-xs  btn btn-primary" type="submit" style="background: #170e66; border-radius: 10px;font-size: 10px;" value="Tải phiếu đăng ký">
								</div>
							</div>
						</div>
						<div class="col-lg-12" id="dont_next_xs" style="display: none">
							<div class="col-lg-12">
								<p id="notify_xs" class="text-center" style="color: red; margin: 0">Sức mua hiện tại của bạn không đủ thực hiện giao dịch. Liên hệ với chúng tôi để được hỗ trợ.</p>
								<p id="hotline" class="text-center"><span class="text-center" style="color: red" id="phone"></span></p>
							</div>
							<div class="mb-2 col-lg-12 div-flex">
								<a href="#" id="return_local_xs" style="max-width: 100%;" class="btn btn-primary col-lg-6">Quay về trang chủ</a>
							</div>
							<div class="clear"></div>
						</div>
						<div class="clear"></div>
					</form>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>	
		<div class="div-partner-xs col-lg-12 col-md-12 col-xs-12" style="padding: 0">
			<div class="div-partner-xs col-lg-12 col-md-12 col-xs-12 text-center">
				<p class="text-vw-3" style="font-weight: bold; color: #4c4c4c;">ĐỐI TÁC CỦA CHÚNG TÔI</p>
			</div>
			<div class="col-lg-12 col-md-12 col-xs-12 div-flex">
				<div class="border-partner-xs col-lg-1 col-md-1 col-xs-2" style="border: 4px solid #4c4c4c"></div>
			</div>
			<div class="partner-img">
				<div class="py-5 py-xs-0 py-md-5 col-lg-12 col-md-12 col-xs-12 div-flex">
					<div class="col-lg-3 col-md-12 col-xs-6 mr-5">
						<img style="width: 100%" src="../img/home_page/mediamart.png" alt="">
					</div>
					<div class="col-lg-3 ml-5 col-md-12 col-xs-6">
						<img style="width: 100%" src="../img/home_page/digiCity.png" alt="">
					</div>
					<div class="col-lg-3 ml-5 col-md-12 col-xs-6">
						<img style="width: 100%" src="../img/home_page/doangia.png" alt="">
					</div>
				</div>
				{{-- <p class="col-xs-12 col-md-12" style="text-align: right;"><b>+51 trung tâm</b></p> --}}
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="info-content-xs col-md-12 col-xs-12">
			<div class="row-info-content col-md-6 col-xs-6">
				<h1>200 000+</h1>
				<p>Sức mua được cung cấp</p>
			</div>
			<div class="row-info-content col-md-6 col-xs-6">
				<h1>100+</h1>
				<p>Siêu thị bán lẻ áp dụng</p>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>	
	</div>
</section>
<section class="info-content container-fluid" style="padding: 0 ;border-bottom: 5px solid white">
	<div class="py-2 py-xs-0 py-md-4 col-lg-12 col-xs-12 col-md-12 div-flex display-none" style="background: #464646;padding: 0">
		<div class="col-lg-6 col-md-12 col-xs-12" style="border-right: 4px solid white">
			<div class="col-lg-offset-6 col-lg-5">
				<h1 class="text-center" style="color: white;font-size: 2.5vw;">200 000+</h1>
				<p class="text-center" style="color: white;font-size: 1.5vw;">đã được cung cấp sức mua</p>
			</div>
		</div>
		<div class="col-lg-6 col-md-12 col-xs-12" style="padding: 0">
			<div class="col-lg-offset-1 col-lg-5" style="padding: 0;"> 
				<h1 class="text-center" style="color: white;font-size: 2.5vw;">100+</h1>
				<p class="text-center" style="color: white;font-size: 1.5vw;">Siêu thị bán lẻ áp dụng</p>
			</div>
		</div>
	</div>
</section>
<section class="step-buy-product container-fluid" style="display: none;padding: 0; margin: 0; border-bottom: 10px solid rgba(127,127,127,0.1)">
	<div class="col-lg-12 col-xs-12 col-md-12" style="background: url('../img/home_page/contant.png') no-repeat;background-size: 100%; padding: 0;">
		<div class="col-lg-12 col-md-12 col-xs-12" style="background: rgba(127,127,127,0.5); padding: 0">
			<div class="py-xs-0 py-md-4 py-4 col-lg-12 col-xs-12 col-md-12" style="background: rgba(41,37,100,0.6)">
				<div class="col-lg-12 col-xs-12 col-md-12 text-center" style="text-align: center;">
					<h1 class="text-center" style="color: white;font-weight: bold">CÁC BƯỚC ĐỂ MUA HÀNG</h1>
				</div>
				<div class="pb-md-5 pb-5 div-flex col-lg-12 col-md-12 col-xs-12">
					<div class="col-lg-1" style="border: 3px solid white;background: white"></div>
				</div>
			</div>
			<div class="pt-xs-0 pt-md-5 pt-5 col-lg-12 col-md-12 col-xs-12 div-flex">
				<div class="col-lg-8 col-xs-8 col-md-12">
					<div class="col-lg-12 col-xs-12 col-md-12 div-flex">
						<div class="col-lg-3 col-md-2 col-xs-3">
							<img width="100%" src="../img/home_page/b1.png" alt="">
						</div>
						<div class="col-lg-3 col-md-2 col-xs-3">
							<img  width="100%" src="../img/home_page/b2.png" alt="">
						</div>
						<div class="col-lg-3 col-md-3 col-xs-5">
							<img width="100%"  src="../img/home_page/b3.png" alt="">
						</div>
						<div class="col-lg-3 col-md-2 col-xs-3">
							<img width="100%"  src="../img/home_page/b4.png" alt="">
						</div>
					</div>
					<div class="col-lg-12 col-xs-12 col-md-12 div-flex">
						<div class="col-lg-12 col-md-12 col-xs-12" style="border: 2px solid white;position: absolute;"></div>
						<div class="col-lg-3 col-md-2 col-xs-3 div-flex">
							<span class="px-5 py-3 py-xs-0 py-md-3" style="border-radius: 100%;background: rgba(127,127,127,0.7) ;font-size: 40px; color: white">1</span>
						</div>
						<div class="col-lg-3 col-md-2 col-xs-3 div-flex">
							<span class="px-5 py-3 py-xs-0 py-md-3" style="border-radius: 100%;background: rgba(127,127,127,0.7) ;font-size: 40px; color: white">2</span>
						</div>
						<div class="col-lg-3 col-md-3 col-xs-5 div-flex">
							<span class="px-5 py-3 py-xs-0 py-md-3" style="border-radius: 100%;background: rgba(127,127,127,0.7) ;font-size: 40px; color: white">3</span>
						</div>
						<div class="col-lg-3 col-md-2 col-xs-3 div-flex">
							<span class="px-5 py-3 py-xs-0 py-md-3" style="border-radius: 100%;background: rgba(127,127,127,0.7) ;font-size: 40px; color: white">4</span>
						</div>
					</div>
					<div class="pt-xs-0 pt-md-5 pt-5 col-lg-12 col-xs-12 col-md-12 div-flex">
						<div id="hoverb1" class="mx-4 col-lg-3 col-md-2 col-xs-3 div-flex background-step">
							<p  class="" style="font-family: Calibri;">Kiểm tra sức mua</p>
						</div>
						<div  id="hoverb2"  class="mx-4 col-lg-3 col-md-2 col-xs-3 div-flex background-step">
							<p  class="" style="font-family: Calibri;">Lựa chọn sản phẩm</p>
						</div>
						<div id="hoverb3" class="mx-4 col-lg-3 col-md-3 col-xs-5 div-flex background-step">
							<p    class="" style="font-family: Calibri;">Nhận hàng</p>
						</div>
						<div  id="hoverb4"  class="mx-4 col-lg-3 col-md-2 col-xs-3 div-flex background-step">
							<p   class="" style="font-family: Calibri;">Thanh toán</p>
						</div>
					</div>
					<div  class="py-xs-0 py-md-4 py-4 col-lg-12 col-xs-12 col-md-12 div-flex" style="z-index: 999999">
						<div id="b1">
							<div class="mt-2 col-lg-12 arrow_box col-md-12 col-xs-12 div-flex">
								<span class=" col-lg-5 col-md-5 col-xs-5 font-next-step">
									Cách 1: Kiểm tra sức mua đã được cấp.
								</span>
								<span class=" col-lg-1  col-md-1 col-xs-1 font-next-step">
									<img src="../img/home_page/arrow.png" alt="">
								</span>
								<span class=" col-lg-5 col-md-5 col-xs-5 font-next-step">
									Đăng ký hội viên bằng cách nhập thông tin đăng ký và Cập nhật hồ sơ cá nhân của bạn theo hướng dẫn của nhân viên tư vấn.
								</span>
							</div>
						</div>
						<div id="b2">
						</style>
						<div class="col-lg-12 arrow_box col-md-12 col-xs-12 div-flex">
							<span class="col-lg-5 col-md-5 col-xs-5 font-next-step">
								Cách 1: Đến hệ thống siêu thị liên kết, lựa chọn sản phẩm. Nhân viên siêu thị sẽ cập nhật đơn hàng của bạn.
							</span>
							<span class="col-lg-1 col-md-1 col-xs-1  font-next-step">
								<img src="../img/home_page/arrow.png" alt="">
							</span>
							<span class="col-lg-5 col-md-5 col-xs-5 font-next-step">
								Cách 2: Tự đăng ký đơn hàng . Sau khi có thông báo đơn hàng thành công. Đến siêu thị nhận hàng.
							</span>
						</div>
					</div>
					<div id="b3" class="col-lg-12 col-md-12 col-xs-12" style="padding: 0;">
						<div class="py-5 py-xs-0 py-md-5 col-lg-12 arrow_box col-md-12 col-xs-12">
							<span class="col-lg-5 col-md-5 col-xs-5 font-next-step">
								Mang theo chứng minh thư đến siêu thị 
							</span>
							<span class="col-lg-1 col-md-1 col-xs-1  font-next-step">
								<img src="../img/home_page/arrow.png" alt="">
							</span>
							<span class="col-lg-6 col-md-6 col-xs-6 font-next-step">
								Ký hợp đồng, trả trước một phần và nhận hàng. 
							</span>
						</div>
					</div>
					<div id="b4" class="col-lg-12 col-md-12 col-xs-12" style="padding: 0;">
						<div class="py-5 py-xs-0 py-md-5 col-lg-12 arrow_box col-md-12 col-xs-12 div-flex">
							<span class="text-center col-lg-12 col-md-12 col-xs-12 font-next-step">
								Trả chậm trong 6 tháng theo hình thức trích lương hàng tháng.  
							</span>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="py-5 py-xs-0 py-md-5 my-5 col-lg-12 col-xs-12 col-md-12"></div>
		<div class="clear"></div>
	</div>
</section>
<section class="step-buy-product-xs">
	<div class="title-next-step col-md-12 col-xs-12">
		<h1>Các bước để mua hàng</h1>
	</div>
	<div style="background: #cccccc">
		<div class="content-step col-md-12 col-xs-12 div-flex" style="background: #cccccc;"">
			<div class="col-md-12 col-xs-11 div-flex">
				<div  id="step-click-1" class="white-space step-click-bg col-md-10 col-xs-10 div-flex" style="padding: 0">
					<p>Kiểm tra sức mua</p>
				</div>
				<div class="step-click col-md-2 col-xs-2 div-flex">
					<img src="../img/home_page/arrow_b.png" alt="">
				</div>
				<div id="step-click-2" class="white-space step-click-bg  col-md-10 col-xs-10 div-flex" style="padding: 0">
					<p>Lựa chọn sản phẩm</p>
				</div>
				<div class=" step-click col-md-2 col-xs-2 div-flex">
					<img src="../img/home_page/arrow_b.png" alt="">
				</div>
				<div  id="step-click-3" class="white-space step-click-bg col-md-10 col-xs-10 div-flex" style="padding: 0">
					<p>Nhận hàng</p>
				</div>
				<div class=" step-click col-md-2 col-xs-2 div-flex">
					<img src="../img/home_page/arrow_b.png" alt="">
				</div>
				<div id="step-click-4" class="white-space step-click-bg col-md-12 col-xs-12 div-flex" style="padding: 0">
					<p>Thanh toán</p>
				</div>
			</div>
		</div>
		<div class="col-md-12 col-xs-12" style="background: #cccccc;padding: 0">
			<div class="col-md-12 col-xs-12 div-flex">
				<div id="data-step-xs-1"  class="data-step-xs data-step-xs-1 col-md-9 col-xs-11">
					<p>1. Kiểm tra sức mua đã được cấp.</p>
					<p>Đăng ký hội viên bằng cách nhập thông tin đăng ký và Cập nhật hồ sơ cá nhân của bạn theo hướng dẫn của nhân viên tư vấn.</p>
				</div>
				<div  id="data-step-xs-2"  class="data-step-xs  col-md-9 col-xs-11" style="display: none">
					<p>1. Đến hệ thống siêu thị liên kết, lựa chọn sản phẩm. Nhân viên siêu thị sẽ cập nhật đơn hàng của bạn.</p>
					<p>2. Tự đăng ký đơn hàng . Sau khi có thông báo đơn hàng thành công. Đến siêu thị nhận hàng.</p>
				</div>
				<div  id="data-step-xs-3"  class="data-step-xs data-step-xs-3 col-md-9 col-xs-11" style="display: none">
					<p>1. Mang theo chứng minh thư đến siêu thị.</p>
					<p>2. Ký hợp đồng, trả trước một phần và nhận hàng.</p>
				</div>
				<div  id="data-step-xs-4"  class="data-step-xs data-step-xs-4 col-md-9 col-xs-11" style="display: none">
					<p>1. Trả chậm trong 6 tháng theo hình thức trích lương hàng tháng.</p>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</section>
<section class="conddtion-desktop py-2 container-fluid col-lg-12 col-md-12 col-xs-12">
	<div class="row condition col-lg-12 col-md-12 col-xs-12">
		<h2 class="text-vw-5 h2-condition">ĐIỀU KIỆN TRỞ THÀNH HỘI VIÊN</h2>
		<h4 class="text-vw-2">Để tận hưởng chính sách mua sắm đặc quyền</h4>
		<hr class="hr-style">
	</div>
	<div class="col-lg-12 col-md-12 col-xs-12 div-flex" style="padding: 0">
		<div class="col-lg-4 col-md-4 col-xs-5  conddtion-member" style="padding-bottom: 2rem">
			<p class="">Bạn đang làm việc chính thức tại một doanh nghiệp và có mức thu nhập từ 3 triệu đồng trở lên.</p>
			<!-- <img  src="{{url('img/home_page/tick.png')}}"/> -->
		</div>
		<!-- <div class="col-lg-offset-1 col-xs-offset-1 col-md-offset-1 col-lg-4 col-md-4 col-xs-5 conddtion-member">
			<p class="" >2. Bạn đã ký hợp đồng chính thức với doanh nghiệp </p>
			<img  src="{{url('img/home_page/tick.png')}}"/>
		</div> -->
	</div>
	<div class="clear"></div>
</section>
<section class="conddtion-xs container-fluid col-lg-12 col-md-12 col-xs-12" >
	<div class="col-lg-12 col-md-12 col-xs-12">
		<h2 class="text-vw-5">ĐIỀU KIỆN TRỞ THÀNH HỘI VIÊN</h2>
		<h4 class="text-vw-2">Để tận hưởng chính sách mua sắm đặc quyền</h4>
		<hr class="hr-style">
	</div>
	<div class="col-lg-12 col-md-12 col-xs-12" style="padding: 0">
		<div class="col-lg-12 col-md-12 col-xs-12  conddtion-member" style="padding-bottom: 1rem">
			<p class="text-vw-4">Bạn đang làm việc chính thức tại một doanh nghiệp và có mức thu nhập từ 3 triệu đồng trở lên.</p>
		</div>
		<!-- <div class=" col-lg-12 col-md-12 col-xs-12 conddtion-member member-botton">
			<p class="text-vw-4" >2. Bạn đã ký hợp đồng chính thức với doanh nghiệp </p>
		</div> -->
	</div>
	<div class="clear"></div>
</section>
@stop
