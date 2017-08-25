$(document).ready(function(){
	function round_d(e){
		var r = 1000000;
		return Math.floor(e/r)*r;
	}
	$('#b2').hide();
	$('#b3').hide();
	$('#b4').hide();
	$('#step-click-1').attr('style','background: #170e66 !important');
	$('#data-step-xs-2').hide();
	$('#data-step-xs-3').hide();
	$('#data-step-xs-4').hide();
	$('#data-company').hide();
	$('#hoverb1').click(function(){
		$('#b2').hide();
		$('#b3').hide();
		$('#b4').hide();
		$('#b1').append("<style>.arrow_box:after{left:10%}</style>");
		$('#b1').show("slow");
	});
	$('#hoverb2').click(function(){
		$('#b1').hide();
		$('#b3').hide();
		$('#b4').hide();
		$('#b1').append("<style>.arrow_box:after{left:35%}</style>");
		$('#b2').show("slow");
	});
	$('#hoverb3').click(function(){
		$('#b1').hide();
		$('#b2').hide();
		$('#b4').hide();
		$('#b1').append("<style>.arrow_box:after{left:60%}</style>");
		$('#b3').show("slow");
	});
	$('#hoverb4').click(function(){
		$('#b1').hide();
		$('#b3').hide();
		$('#b2').hide();
		$('#b1').append("<style>.arrow_box:after{left:80%}</style>");
		$('#b4').show("slow");
	});
	$('#step-click-1').click(function(){
		$('#data-step-xs-3').hide();
		$('#step-click-3').attr('style','background: rgba(34,82,168,0.9) !important');
		$('#data-step-xs-2').hide();
		$('#step-click-2').attr('style','background: rgba(34,82,168,0.9) !important');
		$('#data-step-xs-4').hide();
		$('#step-click-4').attr('style','background: rgba(34,82,168,0.9) !important');
		$('#step-click-1').attr('style','background: #170e66');
		$('#data-step-xs-1').show();
	});
	$('#step-click-2').click(function(){
		$('#data-step-xs-1').hide();
		$('#step-click-1').attr('style','background: rgba(34,82,168,0.9) !important');
		$('#data-step-xs-3').hide();
		$('#step-click-3').attr('style','background: rgba(34,82,168,0.9) !important');
		$('#data-step-xs-4').hide();
		$('#step-click-4').attr('style','background: rgba(34,82,168,0.9) !important');
		$('#step-click-2').attr('style','background: #170e66');
		$('#data-step-xs-2').show();
	});
	$('#step-click-3').click(function(){
		$('#data-step-xs-1').hide();
		$('#step-click-1').attr('style','background: rgba(34,82,168,0.9) !important');
		$('#data-step-xs-2').hide();
		$('#step-click-2').attr('style','background: rgba(34,82,168,0.9) !important');
		$('#data-step-xs-4').hide();
		$('#step-click-4').attr('style','background: rgba(34,82,168,0.9) !important');
		$('#step-click-3').attr('style','background: #170e66');
		$('#data-step-xs-3').show();
	});
	$('#step-click-4').click(function(){
		$('#data-step-xs-1').hide();
		$('#step-click-1').attr('style','background: rgba(34,82,168,0.9) !important');
		$('#data-step-xs-2').hide();
		$('#step-click-2').attr('style','background: rgba(34,82,168,0.9) !important');
		$('#data-step-xs-3').hide();
		$('#step-click-3').attr('style','background: rgba(34,82,168,0.9) !important');
		$('#step-click-4').attr('style','background: #170e66');
		$('#data-step-xs-4').show();
	});
	$('#text-input').click(function(){
		$('#data-company').show("slow");
	});
	$('#data-company').mouseleave(function(){
		$('#data-company').hide("slow");
	});
	$('#data-company').find('option').click(function(){
		$('#text-input').val($(this).text());
		$('#id_company').val($(this).val());
		$('#data-company').hide("slow");
	});
	$('#form-input-u').focusin(function(){
		$('#form-label-u').text('Nhập vào tài khoản');
	});
	$('#form-input-u').focusout(function(){
		$('#form-label-u').text('Tên đăng nhập');
	});
	$('#form-input-p').focusin(function(){
		$('#form-label-p').text('Nhập vào mật khẩu');
	});
	$('#form-input-p').focusout(function(){
		$('#form-label-p').text('Mật khẩu');
	});
	$('#text-input').keyup(function(){
		var url  = "http://"+document.location.host+"/organizationPostCompany";
		var name_cp =$('#text-input').val();
		if(name_cp!=""){
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				method:"post",
				url:url,
				data:{
					name: name_cp,
				},
				dataType: "json",
				success: function(res){
					$('#data-company').find('option').remove();
					$.each(res, function(i,el) {
						$('#data-company').append('<option value="'+el.id+'">'+el.name+'</option>');
					});
					var val="";
					$('#data-company').find('option').click(function(){
						val = $(this).val();
						text = $(this).text();
						$('#text-input').val(text);
						$('#id_company').val(val);
						$('#data-company').hide();
					}); 
				},
				error: function(res){
					console.log("Error");
				},
			});
		}
		else{
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				method:"post",
				url:url,
				data:{
					name: "all",
				},
				dataType: "json",
				success: function(res){
					$('#data-company').find('option').remove();
					$.each(res, function(i,el) {
						$('#data-company').append('<option  value="'+el.id+'">'+el.name+'</option>');
					});
					var val="";
					$('#data-company').find('option').click(function(){
						val = $(this).val();
						text = $(this).text();
						$('#text-input').val(text);
						$('#id_company').val(val);
						$('#data-company').hide();
					}); 
				},
				error: function(res){
					console.log("Error");
				},
			});
		}
	});
	$('#submit_search').click(function(){
		$('#loading').show();
		var id_comp = $('#id_company').val();
		var cmt = $('#txt_cmt').val();
		var code = $('#txt_code').val();
		var url  = "http://"+document.location.host;
		$('select#id_company').val("").change();
		$('#text-input').val("");
		$('#txt_cmt').val("");
		$('#txt_code').val("");
		$('#error_com').html("");
		$('#error_cmt').html("");
		$('#error_code').html("");
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			type:"POST",
			url: url+"/userPostAjax",
			data:{
				id_com: id_comp,
				cmt: cmt,
				code: code,
			},
			dataType:"json",
			success: function(res){
				$('#loading').hide();
				var url  = "http://"+document.location.host;
				if(res.error_all){
					$('#error_com').html("Bạn phải chọn công ty");
					$('#error_cmt').html("Nhập số chứng minh nhân dân hoặc mã nhân viên");
					$('#error_code').html("Nhập mã nhân viên hoặc số chứng minh nhân dân");
				}
				else if(res.error_code){
					$('#error_com').html("Bạn phải chọn công ty");
					$('#error_code').html("Nhập mã số nhân viên");
				}
				else if(res.error_cmt){
					$('#error_com').html("Bạn phải chọn công ty");
					$('#error_cmt').html("Nhập số chứng minh nhân dân");
				}
				else if(res.error_com){
					$('#error_com').html("Bạn phải chọn công ty");
				}
				else if(res.error_cmt_code){
					$('#error_cmt').html("Nhập số chứng minh nhân dân hoặc mã nhân viên");
					$('#error_code').html("Nhập mã nhân viên hoặc số chứng minh nhân dân");
				}
				if(!res.error_all && !res.error_code && !res.error_cmt){
					if(!res.cmt){
						if(!res.data){
							if(res.nonotify=="nonotify"){
								$('#register_form').hide();
								$('#data_form').show();
								$('#next_register').show();
								$('#u_name').val(res[0].fullname);
								$('#id_user').val(res[0].id);
								$('#sum_buy').val(round_d((res[0].salary)*2.5));
								$('#buy_use').val(round_d(res[0].price));
								$('#rest').val(round_d((res[0].salary*2.5)-res[0].price));
								$('#id_user').val(res[0].id);
								$('#upload').attr('href',url+'/orders/upload/'+res[0].id);
							}
							if(res[0].notify=="notify"){
								$('#register_form').hide();
								$('#next_register').hide();
								$('#data_form').show();
								$('#dont_next').show();
								$('#u_name').val(res[0].fullname);
								$('#sum_buy').val((numeral(round_d(res[0].salary*2.5)).format('0,0').replace(/,/g,'.')+" đồng"));
								$('#buy_use').val(numeral(round_d(res[0].price)).format('0,0').replace(/,/g,'.')+" đồng");
								$('#rest').val((numeral(round_d((res[0].salary*2.5)-res[0].price)).format('0,0').replace(/,/g,'.'))+" đồng");
								$('#notify').text('Sức mua hiện tại của bạn không đủ thực hiện giao dịch. Liên hệ với chúng tôi để được hỗ trợ.');
								$('#hotline').text('Hotline: ');
								$('#return_local').attr('href',url);
							}
							else{
								$('#register_form').hide();
								$('#data_form').show();
								$('#next_register').show();
								$('#u_name').val(res[0].fullname);
								$('#id_user').val(res[0].id);
								$('#sum_buy').val((numeral(round_d((res[0].salary)*2.5)).format('0,0')).replace(',','.').replace(',','.').replace(',','.')+" đồng");
								$('#buy_use').val((res[0].price)==null?0+" đồng":(numeral(round_d(res[0].price)).format('0,0')).replace(',','.').replace(',','.').replace(',','.')+" đồng");
								$('#rest').val(((res[0].price)==null?(numeral(round_d((res[0].salary)*2.5)).format('0,0')).replace(',','.').replace(',','.').replace(',','.')+" đồng":(numeral((res[0].salary)*2.5-res[0].price).format('0,0')).replace(',','.').replace(',','.').replace(',','.')+" đồng"));
								$('#id_user').val(res[0].id);
								$('#upload').attr('href',url+'/orders/upload/'+res[0].id);
							}
						}
						else{
							// $('.sweet-alert button.cancel').val('Nhập lại thông tin');
							// $('.sa-confirm-button-container button.confirm').val('Cập nhật thông tin và đơn hàng');
							// swal({
							// 	title: "Không tồn tại khách hàng",
							// 	text: "<p style='color: red;margin-bottom: 15px !important'>Bạn có thể nhập lại thông tin với đầy đủ  CMND và Mã số nhân viên để có kết quả chính xác hơn</p><div class='swal-center form-group'><div class='col-lg-5' style='border-top: 1px solid red'></div><span class='col-lg-2' style='color: red'>Hoặc</span><div class='col-lg-5' style='border-top: 1px solid red !important'></div><div style='clear: both'></div></div><div class='col-lg-12'><span style='color: black'>Bạn cập nhật thông tin đơn hàng ngay (Thông tin của bạn sẽ được xác thực trong vòng 15 phút)</span</div><div style='clear: both'></div>",
							// 	html:true,
							// 	type: "info",
							// 	showCancelButton: true,
							// 	cancelButtonText: "Nhập lại thông tin",
							// 	cancelButtonClass:"btn btn-primary",
							// 	closeOnConfirm: false,
							// 	confirmButtonClass:"btn btn-primary",
							// 	confirmButtonText:"Cập nhật thông tin và đơn hàng",
							// 	showLoaderOnConfirm: true,
							// },
							// function(){
							// 	setTimeout(function(){
							// 		var url  = "http://"+document.location.host+"/orders/add";
							// 		window.location.href=url;
							// 	}, 1500);
							// });
							$('#alert_info').show();
							$('#btn_retype').click(function(){
								$('#alert_info').hide();
							}); 
							$('#btn_new_reg').click(function(){
								window.location.href = "/orders/add";
							});
						}
					}
					else{
						$('#error_cmt').html(res.cmt)
					}
				}
			},
			error: function(res){
				console.log(res.responseText);
				// (JSON.parse(res.responseText).id_com)==""?$('#error_com').html(""):$('#error_com').html((JSON.parse(res.responseText).id_com));
				// (JSON.parse(res.responseText).cmt)==""?$('#error_cmt').html(""):$('#error_cmt').html((JSON.parse(res.responseText).cmt));
				// (JSON.parse(res.responseText).code)==""?$('#error_code').html(""): $('#error_code').html((JSON.parse(res.responseText).code));    
			},
		});
});
$('#btn_search_xs').click(function(){
	var id_comp = $('#selectpicker_xs').val();
	var cmt = $('#number_iden').val();
	var code = $('#code_employ').val();
	var url  = "http://"+document.location.host;
	$('#selectpicker_xs').val("");
	$('span.filter-option').text("Chọn công ty");
	$('#number_iden').val("");
	$('#code_employ').val("");
	$('#txt_code').val("");
	$('#error_com_xs').html("");
	$('#error_cmt_xs').html("");
	$('#error_code_xs').html("");
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.ajax({
		type:"POST",
		url: url+"/userPostAjax",
		data:{
			id_com: id_comp,
			cmt: cmt,
			code: code,
		},
		dataType:"json",
		success: function(res){
			var url  = "http://"+document.location.host;
			if(res.error_all){
				$('#error_com_xs').html("Bạn phải chọn công ty");
				$('#error_cmt_xs').html("Nhập số chứng minh nhân dân hoặc mã nhân viên");
				$('#error_code_xs').html("Nhập mã nhân viên hoặc số chứng minh nhân dân");
			}
			else if(res.error_code){
				$('#error_com_xs').html("Bạn phải chọn công ty");
				$('#error_code_xs').html("Nhập mã số nhân viên");
			}
			else if(res.error_cmt){
				$('#error_com_xs').html("Bạn phải chọn công ty");
				$('#error_cmt_xs').html("Nhập số chứng minh nhân dân");
			}
			else if(res.error_com){
				$('#error_com_xs').html("Bạn phải chọn công ty");
			}
			else if(res.error_cmt_code){
				$('#error_cmt_xs').html("Nhập số chứng minh nhân dân hoặc mã nhân viên");
				$('#error_code_xs').html("Nhập mã nhân viên hoặc số chứng minh nhân dân");
			}
			else if(!res.error_all && !res.error_code && !res.error_cmt){
				if(!res.cmt){
					if(!res.data){
						if(res.nonotify=="nonotify"){
							$('#register_form_xs').hide();
							$('#data_form_xs').show();
							// $('#next_register').show();
							$('#u_name_xs').val(res[0].fullname);
							$('#sum_buy_xs').val(round_d((res[0].salary)*2.5));
							$('#buy_use_xs').val(round_d(res[0].price));
							$('#rest_xs').val(round_d((res[0].salary*2.5)-res[0].price));
							$('#id_user_xs').val(res[0].id);
							$('#btn_upload_xs').attr('href',url+'/orders/upload/'+res[0].id);
						}
						if(res[0].notify=="notify"){
							$('#register_form').hide();
							$('#next_register').hide();
							$('#data_form').show();
							$('#dont_next').show();
							$('#u_name').val(res[0].fullname);
							$('#sum_buy').val((numeral(round_d(res[0].salary*2.5)).format('0,0').replace(/,/g,'.')+" đồng"));
							$('#buy_use').val(numeral(round_d(res[0].price)).format('0,0').replace(/,/g,'.')+" đồng");
							$('#rest').val((numeral(round_d((res[0].salary*2.5)-res[0].price)).format('0,0').replace(/,/g,'.'))+" đồng");
							$('#notify').text('Sức mua hiện tại của bạn không đủ thực hiện giao dịch. Liên hệ với chúng tôi để được hỗ trợ.');
							$('#hotline').text('Hotline: ');
							$('#return_local').attr('href',url);
						}
						else{
							$('#register_form_xs').hide();
							$('#data_form_xs').show();
							$('#next_register').show();
							$('#u_name_xs').val(res[0].fullname);
							$('#sum_buy_xs').val((numeral(round_d((res[0].salary)*2.5)).format('0,0')).replace(',','.').replace(',','.').replace(',','.')+" đồng");
							$('#buy_use_xs').val((res[0].price)==null?0+" đồng":(numeral(round_d(res[0].price)).format('0,0')).replace(',','.').replace(',','.').replace(',','.')+" đồng");
							$('#rest_xs').val(((res[0].price)==null?(numeral(round_d((res[0].salary)*2.5)).format('0,0')).replace(',','.').replace(',','.').replace(',','.')+" đồng":(numeral(round_d((res[0].salary)*2.5-res[0].price)).format('0,0')).replace(',','.').replace(',','.').replace(',','.')+" đồng"));
							$('#id_user_xs').val(res[0].id);
							$('#btn_upload_xs').attr('href',url+'/orders/upload/'+res[0].id);
						}
					}
					else{
						$('#alert_info_xs').show();
						$('#btn_retype_xs').click(function(){
							$('#alert_info_xs').hide();
						}); 
						$('#btn_new_reg_xs').click(function(){
							window.location.href = "/orders/add";
						});
					}
				}
				else{
					$('#error_cmt').html(res.cmt)
				}
			}
			// if(res.error_all){
			// 	$('#error_cmt_xs').html("Nhập số chứng minh nhân dân hoặc mã nhân viên");
			// 	$('#error_code_xs').html("Nhập mã nhân viên hoặc số chứng minh nhân dân");
			// }
		},
		error: function(res){
			(JSON.parse(res.responseText).id_com)==""?$('#error_com').html(""):$('#error_com').html((JSON.parse(res.responseText).id_com));
			(JSON.parse(res.responseText).cmt)==""?$('#error_cmt').html(""):$('#error_cmt').html((JSON.parse(res.responseText).cmt));
			(JSON.parse(res.responseText).code)==""?$('#error_code').html(""): $('#error_code').html((JSON.parse(res.responseText).code));    
		},
	});
});
});