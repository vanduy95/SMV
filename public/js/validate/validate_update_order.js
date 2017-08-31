$(document).ready(function() {
	$('#amount_slow').bind('input propertychange', function() {
    	if($(this).val().replace(/[ đồng.]/g,'')>3000000)
		{
			$('#price-error').hide();
		}
	});
	// $('#amount_slow').change(function(event) {
	// 	alert('ok');
	// 	if($(this).val().replace(/[ đồng.]/g,'')>3000000)
	// 	{
	// 		$('#price-error').hide();
	// 	}
	// });
	// $('#amount_slow').trigger('change');
	
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
	jQuery.validator.addMethod("checkDate", function(value, element) {
            var today = Date.now();
            var birthday = value.split("/");
			var f = new Date(birthday[2], birthday[1] - 1, birthday[0]);
            return today > f;
        }, "Ngày sinh phải nhỏ hơn ngày hiện tại");

	jQuery.validator.addMethod("checkdateissue", function(value, element) {
            var today = Date.now();
            var dateissue = value.split("/");
			var f = new Date(dateissue[2], dateissue[1] - 1, dateissue[0]);
            return today > f;
        }, "Ngày cấp phải nhỏ hơn ngày hiện tại");

	jQuery.validator.addMethod("validDate", function(value, element) {
        return this.optional(element) || moment(value,"DD/MM/YYYY").isValid();
    }, "Không đúng định dạng ngày tháng");

	$.validator.addMethod("min_price", function (value, element) {
		if($('#amount_slow').val().replace('.','').replace('.','').replace('.','').replace('.','').replace('.','').replace('đồng','').replace(' ','')>=3000000)
			return true
		else
			return false

	}, 'Hợp đồng trả góp phải có giá trị trên 3 triệu');


	$.validator.addMethod("check_pre_pay", function (value, element) {
		if($('#pre_pay').val().replace('.','').replace('.','').replace('.','').replace('.','').replace('.','').replace('đồng','').replace(' ','')==0&&$('#select_rate').val()=='')
			return false
		else
			return true
	}, 'Phải nhập số tiền trả trước hoặc chọn tỷ lệ trả trước');

	$.validator.addMethod("check_pre_pay_percent", function (value, element) {
		var price=$('#price').val().replace('.','').replace('.','').replace('.','').replace('.','').replace('.','').replace('đồng','').replace(' ','');
		var prepay=$('#pre_pay').val().replace('.','').replace('.','').replace('.','').replace('.','').replace('.','').replace('đồng','').replace(' ','');
		if((parseInt(prepay)/parseInt(price)+1<0.3))
			return false
		else
			return true

	}, 'Trả trước phải lớn lơn 30% giá trị sản phẩm');

	$.validator.addMethod("check_pre_pay_percent_70", function (value, element) {
		var price=$('#price').val().replace('.','').replace('.','').replace('.','').replace('.','').replace('.','').replace('đồng','').replace(' ','');
		var prepay=$('#pre_pay').val().replace('.','').replace('.','').replace('.','').replace('.','').replace('.','').replace('đồng','').replace(' ','');
		if((parseInt(prepay-1)/parseInt(price)>0.7))
			return false
		else
			return true

	}, 'Trả trước phải nhỏ hơn 70% giá trị sản phẩm');


	$.validator.addMethod("check_pre_pay_vs_price", function (value, element) {
		var price=$('#price').val().replace('.','').replace('.','').replace('.','').replace('.','').replace('.','').replace(' đồng','');
		var prepay=$('#pre_pay').val().replace('.','').replace('.','').replace('.','').replace('.','').replace('.','').replace(' đồng','');
		if(parseInt(prepay)>parseInt(price))
			return false
		else
			return true

	}, 'Trả trước phải nhỏ hơn giá trị sản phẩm');
	$.validator.addMethod("check_price_vs_buy", function (value, element) {
		var price=$('#price').val().replace(' đồng','').replace('.','').replace('.','').replace('.','').replace('.','').replace('.','');
		var prepay=$('#pre_pay').val().replace('.','').replace('.','').replace('.','').replace('.','').replace('.','').replace(' đồng','');
		var buytxt=$('#buytxt').val().replace(' đồng','').replace('.','').replace('.','').replace('.','').replace('.','').replace('.','');
		if(parseInt(buytxt)<parseInt(price-prepay))
			return false
		else
			return true

	}, 'Bạn không đủ sức mua ');
	$("#form_update_order").validate({
		ignore: "",
		rules:{
			name:{
				required:true,
				maxlength:255,
				minlength:3,
				normalizer: function( value ) {
					return $.trim( value );
				}
			},
			employee_id:{
				required:true,
				maxlength:255,
				remote: {
					url: "http://"+window.location.host+"/checkEmployee_id",
					type: "post",
					data: {
						employee_id: function() {
							return $( "#employee_id").val();
						},
						userinfo_id: function() {
							return $( "#userinfo_id").val();
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
				maxlength:255,
				normalizer: function( value ) {
					return $.trim( value );
				}
			},
			address2:{
				required:true,
				minlength:3,
				maxlength:255,
				normalizer: function( value ) {
					return $.trim( value );
				}
			},
			position:{
				required:true,
				maxlength:255,
				normalizer: function( value ) {
					return $.trim( value );
				}
			},
			sex:{
				required:true,
			},
			salary:{
				required:true,
			},
			department:{
				required:true,
				maxlength:255,
				normalizer: function( value ) {
					return $.trim( value );
				}
			},
			product: {
				required: true,
				maxlength:225,
				normalizer: function( value ) {
					return $.trim( value );
				}
			},
			code_product: {
				required: true,
				maxlength: 50,
				normalizer: function( value ) {
					return $.trim( value );
				}
			},
			price: {
				required: true,
				min_price:true,
				check_price_vs_buy:true,
			},
			pre_pay:{
				check_pre_pay:true,
				check_pre_pay_percent:true,
				check_pre_pay_vs_price:true,
				check_pre_pay_percent_70:true
			},
			lead_month: {
				required: true,
				number:true,
				min:1,
				max:25,
			},
			admarket: {
				required:true
			},
			adcity: {
				required:true
			},
			addis: {
				required:true
			},
			adstore: {
				required:true
			},
			identitycard:{
				required:true,
				number:true,
				remote: {
					url: "http://"+window.location.host+"/checkidentitycard",
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
			},
			number_account:{
				required:true,
			},
			exchange_status:{
				required:true,
			},
			bank_name:{
				maxlength:255,
				normalizer: function( value ) {
					return $.trim( value );
				}
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
				required:"Mã nhân viên không được để trống",
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
			},
			department:{
				required:"Phòng ban không được để trống",
				maxlength:"Phòng ban phải từ 1->255 ký tự",
			},
			product: {
				required: "Sản phẩm không được để trống",

				maxlength: "Tên sản phẩm phải từ 4->225 ký tự"
			},
			code_product: {
				required: "Mã sản phẩm không được để trống",

				maxlength: "Mã sản phẩm phải từ 3->50 ký tự",

			},
			price: {
				required: "Giá bán không được để trống",
			},
			pre_pay: {
				required: "Trả Trước không được để trống",
			},
			lead_month: {
				required: "Thời hạn không được để trống",
				number: "Thời hạn phải là số",
				min:"Thời hạn phải từ 1 -> 25",
				max:"Thời hạn phải từ 1 -> 25"
			},
			market: {
				required: "Sản phẩm không được để trống",
			},
			adcity: {
				required: "Thành phố không được để trống",
			},
			addis: {
				required: "Quận huyện không được để trống",
			},
			adstore: {
				required: "Cửa hàng không được để trống",
			},
			identitycard:{
				required:"Số CMT không được để trống",
				number:"Phải nhập số",
				remote:"Số chứng minh thư này đã tồn tại",
			},
			dateissue:{
				required:"Ngày cấp không được để trống",
				validDate:"Phải đúng định dạng ngày tháng",
			},
			issuedby:{
				required:'Nơi cấp không được để trống',
			},
			number_account:{
				required:"Số tài khoản không được để trống",
			},
			exchange_status:{
				required:"Không được để trống trường này",
			},
			salary_avg:{
				required:"Không được để trống trường này",
			},
			bank_name:{
				required:"Tên ngân hàng không đư	ợc để trống",
				maxlength:"Tên ngẫn hàng phải nhỏ hơn 255 ký tự",
			},
			salary_day:{
				required:"Không được để trống trường này",
				number:"phải nhập khiểu số",
				max:"Phải nhập từ 1->31",
				min:"Phải nhập từ 1->31",
			}
		},
		invalidHandler:function (event, validator) {
			select_tab_error();
		}
	});

function select_tab_error() {
	if($('#home').find('.error').text()!='')
	{
		$('li a[href$="#home"]').tab('show');
		return;
	}
	if($('#menu1').find('.error').text()!='')
	{
		$('li a[href$="#menu1"]').tab('show');
		return;
	}
	if($('#menu2').find('.error').text()!='')
	{
		$('li a[href$="#menu2"]').tab('show');
		return;
	}
}
});

