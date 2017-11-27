@extends('home_page.master')
@section('content')
<div class="col-lg-12 div-flex col-xs-12 row_update">
	<style>
		.row_update{
			background: rgba(0,0,0,0.1);
			padding: 10px 0;
			margin: 0;
		}
		.font-size-xs{
			font-size: 15px;
			text-align: center;
		}
		.mgb{
			margin-bottom: 10px;
		}
	</style>
	<div class="col-lg-8 col-xs-12">
		<form class="col-lg-12 col-xs-12" action="">
			<div class="col-lg-12 col-md-12 col-xs-12 div-flex" style="background: rgb(0,83,167);display: flex;align-items: center; justify-content: center;">
				<p class="my-3" style="color: white;font-size: 2.1vw; font-weight: 600">THÔNG TIN KHÁCH HÀNG</p>
			</div>
			<div class="col-lg-12 col-md-12 col-xs-12 mgb">
				<div class="font-size-xs col-lg-4 col-md-4 col-xs-4">
					Chứng minh nhân dân
				</div>
				<div class="col-lg-8 col-md-8 col-xs-8">
		            <div class="input-group">
		                <label class="input-group-btn">
		                  <span class="btn btn-primary">
		                    Browse&hellip; <input id="btnUpload" name="upExcel" onchange="myFun();" type="file" style="display: none;">
		                  </span>
		                </label>
		                <input name="text_Excel" type="text" id="btnFile" class="form-control" readonly>
		              </div>
		              <label style="display: none" id="btnFile-error" class="error" for="btnFile">Bạn chưa chọn danh sách cần tải lên</label>
		        </div>
			</div>
			<div class="col-lg-12 col-md-12 col-xs-12 mgb">
				<div class="font-size-xs col-lg-4 col-md-4 col-xs-4">
					Sổ hộ khẩu
				</div>
				<div class="col-lg-8 col-md-8 col-xs-8">
		            <div class="input-group">
		                <label class="input-group-btn">
		                  <span class="btn btn-primary">
		                    Browse&hellip; <input id="btnUpload" name="upExcel" onchange="myFun();" type="file" style="display: none;">
		                  </span>
		                </label>
		                <input name="text_Excel" type="text" id="btnFile" class="form-control" readonly>
		              </div>
		              <label style="display: none" id="btnFile-error" class="error" for="btnFile">Bạn chưa chọn danh sách cần tải lên</label>
		        </div>
			</div>
			<div class="col-lg-12 col-md-12 col-xs-12 mgb">
				<div class="font-size-xs col-lg-4 col-md-4 col-xs-4">
					Hóa đơn điện, nước, điện thoại nơi bạn đang ở.
				</div>
				<div class="col-lg-8 col-md-8 col-xs-8">
		            <div class="input-group">
		                <label class="input-group-btn">
		                  <span class="btn btn-primary">
		                    Browse&hellip; <input id="btnUpload" name="upExcel" onchange="myFun();" type="file" style="display: none;">
		                  </span>
		                </label>
		                <input name="text_Excel" type="text" id="btnFile" class="form-control" readonly>
		              </div>
		              <label style="display: none" id="btnFile-error" class="error" for="btnFile">Bạn chưa chọn danh sách cần tải lên</label>
		        </div>
			</div>
			<div class="col-lg-12 col-md-12 col-xs-12 mgb">
				<div class="font-size-xs col-lg-4 col-md-4 col-xs-4">
					Giấy tờ thể hiện nơi làm việc của bạn: hợp đồng lao động, thẻ nhân viên, giấy tờ khác
				</div>
				<div class="col-lg-8 col-md-8 col-xs-8">
		            <div class="input-group">
		                <label class="input-group-btn">
		                  <span class="btn btn-primary">
		                    Browse&hellip; <input id="btnUpload" name="upExcel" onchange="myFun();" type="file" style="display: none;">
		                  </span>
		                </label>
		                <input name="text_Excel" type="text" id="btnFile" class="form-control" readonly>
		              </div>
		              <label style="display: none" id="btnFile-error" class="error" for="btnFile">Bạn chưa chọn danh sách cần tải lên</label>
		        </div>
			</div>
			<div class="col-lg-12 col-md-12 col-xs-12 div-flex">
				<input class="col-lg-3 col-xs-4 btn btn-primary" id="btn_new_reg_xs" type="button" value="Gửi hồ sơ" style="background: #170e66;" >
			</div>
		</form>
	</div>
</div>
@endsection
