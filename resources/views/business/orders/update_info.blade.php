@extends('home_page.master')
@section('content')
<script type="text/javascript">
	function funIden(){
		var len = $("#btnUploadIden")[0].files;
		var temp="";
		for(let i=0;i<len.length;i++){
			temp+=len[i].name+" ";
		}
		$("#btnFileIden").val(temp);
 	}
 	function funHome(){
		var len = $("#_btnUploadHome")[0].files;
		var temp="";
		for(let i=0;i<len.length;i++){
			temp+=len[i].name+" ";
		}
		$("#btnFileHome").val(temp);
 	}
 	function funBill(){
		var len = $("#_btnUploadBill")[0].files;
		var temp="";
		for(let i=0;i<len.length;i++){
			temp+=len[i].name+" ";
		}
		$("#btnFileBill").val(temp);
 	}
 	function funOther(){
		var len = $("#_btnUploadOther")[0].files;
		var temp="";
		for(let i=0;i<len.length;i++){
			temp+=len[i].name+" ";
		}
		$("#btnFileOther").val(temp);
 	}
 	$(document).ready(function() {
	 	$("#btn_new_reg_other").click(function(){
	 		console.log('click');
	 		if($("#userinfo_addOther").valid()){
	 			$("#userinfo_addOther").submit();
	 		}
	 	});
	 	$.validator.addMethod("check_form", function (value, element) {	
	 	if($("#btnUploadIden").val()=="" && $("#btnUploadIden").val()=="" 
	 		&& $("#btnUploadIden").val()=="" && $("#btnUploadIden").val()==""){
	 		return false;
	 	}else{
	 		return true;
	 	}
			},'Bạn chưa tải lên bất kỳ ảnh nào, vui lòng chọn ảnh!');
	 	$("#userinfo_addOther").validate({
		      rules: {
		        checkform: {
		          check_form: true,
		        },
		      },
		      messages: {
			}
	    });
	});
</script>
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
			margin-top: 10px;
			margin-bottom: 10px;
		}
	</style>
	<div class="col-lg-8 col-xs-12">
		<form class="col-lg-12 col-xs-12" id="userinfo_addOther" action="{{url('userinfo/register')}}" method="POST" enctype="multipart/form-data">
			{{csrf_field()}}
			<div class="col-lg-12 col-md-12 col-xs-12 div-flex" style="background: rgb(0,83,167);display: flex;align-items: center; justify-content: center;">
				<p class="my-3" style="color: white;font-size: 2.1vw; font-weight: 600">THÔNG TIN KHÁCH HÀNG</p>
				<input type="hidden" name="_user" value="{{session('customer_id')}}">
			</div>
			<div class="col-lg-12 col-md-12 col-xs-12 mgb">
				<div class="font-size-xs col-lg-4 col-md-4 col-xs-4">
					Chứng minh nhân dân
				</div>
				<div class="col-lg-8 col-md-8 col-xs-8">
		            <div class="input-group">
		                <label class="input-group-btn">
		                  <span class="btn btn-primary">
		                    Browse&hellip; <input id="btnUploadIden" accept="image/*" multiple='true' name="upIden[]" onchange="funIden();" type="file" style="display: none;" >
		                  </span>
		                </label>
		                <input name="text_Excel" type="text" id="btnFileIden" class="form-control" readonly>
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
		                    Browse&hellip; <input id="_btnUploadHome" accept="image/*" name="_upHome[]" onchange="funHome();" type="file" style="display: none;" multiple>
		                  </span>
		                </label>
		                <input name="text_Excel" type="text" id="btnFileHome" class="form-control" readonly>
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
		                    Browse&hellip; <input id="_btnUploadBill" accept="image/*" name="_upBill[]" onchange="funBill();" type="file" multiple style="display: none;">
		                  </span>
		                </label>
		                <input name="text_Excel" type="text" id="btnFileBill" class="form-control" readonly>
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
		                    Browse&hellip; <input id="_btnUploadOther" accept="image/*" name="_upOther[]" onchange="funOther();" multiple type="file" style="display: none;">
		                  </span>
		                </label>
		                <input name="text_Excel" type="text" id="btnFileOther" class="form-control" readonly>
		              </div>
		              <label style="display: none" id="btnFile-error" class="error" for="btnFile">Bạn chưa chọn danh sách cần tải lên</label>
		        </div>
			</div>
			<div class="col-lg-12">
				<input type="hidden" name="checkform">
			</div>
			<div class="col-lg-12 col-md-12 col-xs-12 div-flex">
				<input class="col-lg-3 col-xs-4 btn btn-primary" id="btn_new_reg_other" type="submit" value="Gửi hồ sơ" style="background: #170e66;" >
			</div>
		</form>
	</div>
</div>
@endsection
