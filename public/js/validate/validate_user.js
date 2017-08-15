$(document).ready(function() {
	$("#register_form").validate({
		rules: {
			passwordconfirm:{
				required: true,
				equalTo: "#password",
			},
			fullname:{
				required: true,
			},
			username: {
				required: true,
				minlength: 3
			},
			email: {
				required: true,
				email: true
			},
			password: {
				required: true,
				minlength: 6,
			},
			phone: {
				required:true,
				number: true
			},
			address:{
				required:true,
			}
		},
		messages: {
			fullname:{
				required: "Họ và tên không được để trống",
			},
			username: {
				required: "Tên đăng nhập không được để trống",
				minlength: "Tên đăng nhập lớn hơn 6 ký tự"
			},
			email: {
				required: "Email không được để trống",
				email: "Định dạng email không chính xác"
			},
			password: {
				required: "Mật khẩu không được để trống",
				minlength: "Mật khẩu lớn hơn 6 ký tự"
			},
			select_market: {
				required:"Siêu thị không được để trống",
			},
			select_city: {
				required:"Thành phố không được để trống",
			},
			select_dis: {
				required:"Quận/Huyện không được để trống",
			},
			select_store: {
				required:"Cửa hàng không được để trống",
			},
			phone: {
				required:"Số điện thoại không được để trống",
				number: "Số điện thoại không hợp lệ"
			},
			address:{
				required:"Địa chỉ không được để trống",
			},
			passwordconfirm:{
				required:"Mật khẩu xác minh không được để trống",
				equalTo:"Mật khẩu không khớp"
			}
		}
	});
	$("#dt_form").validate({
		rules: {
			passwordconfirmdt:{
				required: true,
				equalTo: "#passworddt",
			},
			fullnamedt:{
				required: true,
			},
			usernamedt: {
				required: true,
				minlength: 3
			},
			emaildt: {
				required: true,
				email: true
			},
			passworddt: {
				required: true,
				minlength: 6,
			},
			select_market: {
				required:true,
			},
			select_city: {
				required:true,
			},
			select_dis: {
				required:true,
			},
			select_store: {
				required:true,
			},
			phonedt: {
				required:true,
				number: true
			},
			addressdt:{
				required:true,
			}
		},
		messages: {
			fullnamedt:{
				required: "Họ và tên không được để trống",
			},
			usernamedt: {
				required: "Tên đăng nhập không được để trống",
				minlength: "Tên đăng nhập lớn hơn 6 ký tự"
			},
			emaildt: {
				required: "Email không được để trống",
				email: "Định dạng email không chính xác"
			},
			passworddt: {
				required: "Mật khẩu không được để trống",
				minlength: "Mật khẩu lớn hơn 6 ký tự"
			},
			select_market: {
				required:"Siêu thị không được để trống",
			},
			select_city: {
				required:"Thành phố không được để trống",
			},
			select_dis: {
				required:"Quận/Huyện không được để trống",
			},
			select_store: {
				required:"Cửa hàng không được để trống",
			},
			phonedt: {
				required:"Số điện thoại không được để trống",
				number: "Số điện thoại không hợp lệ"
			},
			addressdt:{
				required:"Địa chỉ không được để trống",
			},
			passwordconfirmdt:{
				required:"Mật khẩu xác minh không được để trống",
				equalTo:"Mật khẩu không khớp"
			}
		}
	});
	$('#ctv').submit(function(){
		$('#hidden').val('ctv');
	});
	$('#dt').submit(function(){
		$('#hiddendt').val('dt');
	});
});