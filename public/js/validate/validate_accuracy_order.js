$(document).ready(function() {
  if ($('#exchange_status').val()==2) {
      $('#bank_name').attr('readonly','true');
      $('#salary_avg').attr('readonly','true');
      $('#salary_day').attr('readonly','true');
      $('#identitycard').attr('readonly','true');
      $('#phone1').attr('readonly','true');
      $('#number_account').attr('readonly','true');
      $('#issuedby').attr('readonly','true');
      $('#phone4').attr('readonly','true');
      $('#dateissue1').attr('readonly','true');
      $("#btn_accuracy").attr('formnovalidate', 'formnovalidate');
    }
  else
  {
      $("#btn_accuracy").removeAttr('formnovalidate')
  }

  $('#exchange_status').change(function(event) {
    if($(this).val()==2)
    {

      $('#bank_name').attr('readonly','true');
      $('#salary_avg').attr('readonly','true');
      $('#salary_day').attr('readonly','true');
      $('#identitycard').attr('readonly','true');
      $('#phone1').attr('readonly','true');
      $('#number_account').attr('readonly','true');
      $('#issuedby').attr('readonly','true');
      $('#phone4').attr('readonly','true');
      $('#dateissue1').attr('readonly','true');
      $("#btn_accuracy").attr('formnovalidate', 'formnovalidate'); 
      $('label.error').hide();
      $('.form-control').removeClass('error');
    }
    else
    {
      $('#bank_name').removeAttr('readonly');
      $('#salary_avg').removeAttr('readonly');
      $('#salary_day').removeAttr('readonly');
      $('#identitycard').removeAttr('readonly');
      $('#phone1').removeAttr('readonly');
      $('#number_account').removeAttr('readonly');
      $('#issuedby').removeAttr('readonly');
      $('#phone4').removeAttr('readonly');
      $('#dateissue1').removeAttr('readonly') ;
      $("#btn_accuracy").removeAttr('formnovalidate')
    }
  });

  jQuery.validator.addMethod("checkDate", function(value, element) {
    var today = Date.now();
    var birthday = value.split("/");
    var f = new Date(birthday[2], birthday[1] - 1, birthday[0]);
    return today > f;
  }, "Ngày phải nhỏ hơn ngày hiện tại");
  $.validator.addMethod("check_salary_avg",function(vl,el){
    var avg = $('#salary_avg').val().replace('.','').replace('.','').replace('.','').replace('.','').replace(' đồng','');
    if(parseInt(avg)<1) return false;
    else return true;
  },'Lương ba tháng phải lớn hơn 0');
  $("#form_accuracy_order").validate({
    ignore: "",
    rules:{
      time_work:{
        required:true,
      },
      phone4:{
       number:true,
       minlength:10,
       maxlength:12
     },
     phone:{
        required:true,
        number:true,
       minlength:10,
       maxlength:12
     },
     number_account:{
       required:true,
       number:true,
     },
     exchange_status:{
       required:true,
     },
     dateissue:{
        required:true,
        checkDate:true,
     },
     issuedby:{
      required:true,
     },
     salary_avg:{
       check_salary_avg:true,
     },
     bank_name:{
       maxlength:255,
     },
     salary_day:{
       number:true,
       max:31,
       min:1,
     },
     identitycard:{
      required:true,
     }
   },
   messages:{
    time_work:{
        required:"Trường không được để trống",
      },
     phone4:{
       number:"Số điện thoại phải là dạng số",
       minlength:"Đây không phải là số điện thoại",
       maxlength:"Đây không phải là số điện thoại"
     },
      phone:{
       required:"Số điện thoại không được để trống",
       number:"Số điện thoại phải là dạng số",
       minlength:"Đây không phải là số điện thoại",
       maxlength:"Đây không phải là số điện thoại"
     },
     number_account:{
       required:"Số tài khoản không được để trống",
       number:"Phải nhập kiểu số",
     },
     exchange_status:{
       required:"Không được để trống trường này",
     },
     salary_avg:{
       required:"Không được để trống trường này",
       number:"Phải nhập vào số"
     },
     bank_name:{
       required:"Tên ngân hàng không được để trống",
       maxlength:"Tên ngẫn hàng phải nhỏ hơn 255 ký tự",
     },
     salary_day:{
       required:"Không được để trống trường này",
       number:"phải nhập khiểu số",
       max:"Phải nhập từ 1->31",
       min:"Phải nhập từ 1->31",
     },
     dateissue:{
        required:"Ngày cấp không được để trống",
     },
     identitycard:{
      required:"Sô chứng minh nhân dân không được để trống",
     },
    issuedby:{
      required:"nơi cấp không được để trống",
     },
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

