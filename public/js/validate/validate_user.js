$(document).ready(function() {
	jQuery.validator.addMethod("noSpace", function(value, element) { 
		return value.indexOf(" ") < 0 && value != ""; 
	}, "Không được chứa khoảng trắng");
	jQuery.validator.addMethod("email_valid", function(value, element) { 
		return /[A-Z0-9._-]+@[A-Z0-9-]+[.]+[A-Z]{2,4}/gim.test(value); 
	}, "Địa chỉ Email không đúng định dạng");

	$("#register_form").validate({
		rules: {
			passwordconfirm:{
				required: true,
				equalTo: "#password",
				noSpace:true
			},
			fullname:{
				required: true,
			},
			username: {
				remote: {
					url: "/checkUsername",
					type: "get",
					data: {
						username: function() {
							return $( "#username" ).val();
						}
					}
				},
				required: true,
				minlength: 3,
				noSpace:true,
			},
			email: {
				required: true,
				email_valid: true
			},
			password: {
				required: true,
				minlength: 6,
				noSpace:true
			},
			phone: {
				required:true,
				number: true,
				minlength:10,
				maxlength:11,
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
				minlength: "Tên đăng nhập lớn hơn 6 ký tự",
				remote:"Tên đăng nhập đã tồn tại"
			},
			email: {
				required: "Email không được để trống",
				// email: "Định dạng email không chính xác"
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
				number: "Số điện thoại không hợp lệ",
				minlength: "Số điện thoại không hợp lệ",
				maxlength: "Số điện thoại không hợp lệ",
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
				noSpace:true,
				required: true,
				equalTo: "#passworddt",
			},
			fullnamedt:{
				required: true,
			},
			usernamedt: {
				noSpace:true,
				required: true,
				minlength: 3,
				remote: {
					url: "/checkUsername",
					type: "get",
					data: {
						username: function() {
							return $( "#usernamedt" ).val();
						}
					}
				},
			},
			emaildt: {
				required: true,
				email_valid: true
			},
			noSpace:true,
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
				number: true,
				minlength:10,
				maxlength:11,
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
				minlength: "Tên đăng nhập lớn hơn 6 ký tự",
				remote:"Tên đăng nhập đã tồn tại"
			},
			emaildt: {
				required: "Email không được để trống",
				// email: "Định dạng email không chính xác"
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
				number: "Số điện thoại không hợp lệ",
				minlength:"Số điện thoại không hợp lệ",
				maxlength:"Số điện thoại không hợp lệ",
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