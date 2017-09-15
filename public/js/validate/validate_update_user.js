$(document).ready(function() {
	// if ($('#exchange_status').val()==2) {
	// 		$('#bank_name').removeAttr('required');
	// 		$('#salary_avg').removeAttr('required');
	// 		$('#salary_day').removeAttr('required');
	// }
	// else
	// {
	// 		$('#bank_name').attr('required','true');
	// 		$('#salary_avg').attr('required','true');
	// 		$('#salary_day').attr('required','true');
	// }

	// $('#exchange_status').change(function(event) {
	// 	if($(this).val()==2)
	// 	{
	// 		$('#bank_name').removeAttr('required');
	// 		$('#salary_avg').removeAttr('required');
	// 		$('#salary_day').removeAttr('required');
	// 		$('#bank_name-error').hide();
	// 		$('#salary_day-error').hide();
	// 	}
	// 	else
	// 	{

	// 		$('#bank_name').attr('required','true');
	// 		$('#salary_avg').attr('required','true');
	// 		$('#salary_day').attr('required','true');
	// 	}
	// });
	$('#phone1').change(function () {
		$('#phone').val($('#phone1').val());
	});
	$.validator.addMethod("min_salary_user", function (value, element) {
		if(value.replace(/[ đồng,.]/g,'')>=3000000)
			return true
		else
			return false

	}, 'Lương phải lớn hơn hoặc bằng 3 triệu');
	jQuery.validator.addMethod("checkDate", function(value, element) {
		var today = Date.now();
		var birthday = value.split("/");
		var f = new Date(birthday[2], birthday[1] - 1, birthday[0],23,59,59);
		return today > f;
	}, "Ngày sinh phải nhỏ hơn ngày hiện tại");

	jQuery.validator.addMethod("checkdateissue", function(value, element) {
		var today = Date.now();
		var dateissue = value.split("/");
		var f = new Date(dateissue[2], dateissue[1] - 1, dateissue[0],23,59,59);
		return today > f;
	}, "Ngày cấp phải nhỏ hơn ngày hiện tại");

	jQuery.validator.addMethod("validDate", function(value, element) {
		return this.optional(element) || moment(value,"DD/MM/YYYY").isValid();
	}, "Không đúng định dạng ngày tháng");
	$.validator.addMethod("max_salary", function (value, element) {
		if($('#salary_info').val().replace(/[ đồng,.]/g,'')<100000000)
			return true
		else
			return false

	}, 'Lương của bạn phải nhỏ hơn 100 triệu');
	$("#form_update_order").validate({
		ignore: "",
		rules:{
			name:{
				required:true,
				maxlength:255,
				minlength:3
			},
			employee_id:{
				maxlength:255,
				normalizer: function( value ) {
					return $.trim( value );
				},
				remote: {
					url: "/checkEmployee_id",
					type: "post",
					data: {
						identitycard: function() {
							return $( "#identitycard").val();
						},
						userinfo_id: function() {
							return $( "#userinfo_id").val();
						},
						organization_id:function() {
							return $( "#organization_id").val();
						},
					}
				}
			},
			birthday:{
				required:true,
				validDate:true,
				checkDate:true
			},
			phone1:{
				required:true,
				number:true,
				minlength:10,
				maxlength:12
			},
			address1:{
				required:true,
				minlength:3,
				maxlength:255
			},
			address2:{
				required:true,
				minlength:3,
				maxlength:255
			},
			position:{
				required:true,
				maxlength:255
			},
			sex:{
				required:true,
			},
			salary:{
				required:true,
				max_salary:true,
				min_salary_user:true
			},
			department:{
				required:true,
				maxlength:255
			},
			product: {
				required: true,
				maxlength:225,
			},
			code_product: {
				required: true,
				maxlength: 50
			},
			identitycard:{
				maxlength:12,
				minlength:9,
				required:true,
				number:true,
				remote: {
					url: "/checkidentitycard",
					type: "post",
					data: {
						identitycard: function() {
							return $( "#identitycard").val();
						},
						userinfo_id: function() {
							return $( "#userinfo_id").val();
						},
					}
				}
			},
			dateissue:{
				required:true,
				validDate:true,
				checkdateissue: true,
			},
			issuedby:{
				required:true,
				maxlength:255,
			},
			number_account:{
				required:true,
				maxlength:255,
			},
			exchange_status:{
				required:true,
			},
			bank_name:{
				maxlength:255,
			},
			salary_day:{
				number:true,
				max:31,
				min:1,
			},
			time_work:{
				required:true,
			},
		},
		messages:{
			time_work:{
				required:"Chọn thời gian làm việc",
			},
			name:{
				required:"Tên khách hàng không được để trống",
				maxlength:"Tên khách hàng phải từ 3->255 ký tự",
				minlength:"Tên khách hàng phải từ 3->255 ký tự"
			},
			employee_id:{
				maxlength:"Mã nhân viên quá dài",
				remote:'Mã nhân viên này đã tồn tại'
			},
			birthday:{
				required:"Ngày sinh không được để trống",
				validDate:"Ngày sinh phải là ngày tháng",
			},
			phone1:{
				required:"Số điện thoại không được để trống",
				number:"Số điện thoại phải là dạng số",
				minlength:"Đây không phải là số điện thoại",
				maxlength:"Đây không phải là số điện thoại"
			},
			address1:{
				required:"Địa chỉ thường trú không được để trống",
				minlength:"Địa chỉ thường trú phải từ 3->255 ký tự",
				maxlength:"Địa chỉ thường trú phải từ 3->255 ký tự"
			},
			address2:{
				required:"Nơi ở hiện nay không được để trống",
				minlength:"Nơi ở hiện nay phải từ 3->255 ký tự",
				maxlength:"Nơi ở hiện nay phải từ 3->255 ký tự"
			},
			position:{
				required:"Chức vụ không được để trống",
				maxlength:"Chức vụ phải từ 1->255 ký tự"
			},
			sex:{
				required:"Giới tính không được để trống"
			},
			salary:{
				required:"Lương không được để trống",
				max_salary:"Vui lòng nhập dưới 100 triệu"
			},
			department:{
				required:"Phòng ban không được để trống",
				maxlength:"Phòng ban phải từ 1->255 ký tự",
			},
			identitycard:{
				minlength:"Số chứng minh nhân dân không hợp lệ",
				maxlength:"Số chứng minh nhân dân không hợp lệ",
				required:"Số CMT không được để trống",
				number:"Phải nhập số",
				remote:"Đã tồn tại số chứng minh nhân dân này",
			},
			dateissue:{
				required:"Ngày cấp không được để trống",
				validDate:"Phải đúng định dạng ngày tháng",
			},
			issuedby:{
				required:'Nơi cấp không được để trống',
				minlength:"Ngày cấp không hợp lệ",
				maxlength:"Ngày cấp không hợp lệ",
			},
		},
	});
});

