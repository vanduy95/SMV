$(document).ready(function() {
  var url  = "http://"+document.location.host;
  $("#date_issue_reg").kendoDatePicker({
    format: "dd/MM/yyyy"
  });
  var price = $('#price').val().replace(/[ đồng.]/g,'');
  var a = numeral(price).format('0,0');
  if(a!=""){
    $("#price").val(a.replace(/,/g,'.')+" đồng");
  }
  $('#price').change(function(){
    var price = $('#price').val().replace(/[ đồng.]/g,'');
    var a = numeral(price).format('0,0');
    if(a!=""){
      $("#price").val(a.replace(/,/g,'.')+" đồng");
    }
  });
  $('#btn_register').button().click(function(e){
    if($('#userifo_form').valid()){
      $('#loading').show();
      var company = $('#company').val();
      var name = $('#name_user').val();
      var salary = $('#salary_user').val();
      var phone = $('#phone_user').val();
      var add_u = $('#address_user').val();
      var number_i = $('#number_issue').val();
      var date_issue = $('#date_issue_reg').val();
      var addr_issue = $('#addr_issue').val();
      // console.log(company+name+salary+phone+add_u+number_i+date_issue+addr_issue);
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type: "post",
        url: url+"/orders/postAjaxNewUserOrder",
        data:{
          company: company,
          name: name,
          salary: salary,
          phone: phone,
          add_u: add_u,
          number_i: number_i,
          date_issue: date_issue,
          addr_issue: addr_issue,
          btn_register: "btn_register"
        },
        dataType: "json",
        success: function(res){
          if(res.user_id){
           $('#loading').hide();
           $('#fullname').val(res.fullname);
           $('#user_id').val(res.user_id);
           $('#register_user').remove();
           $('#success_register').show();
           $('body').scrollTop(0);
         }
       },error: function(res){
          // console.log(res);
        }
      });
    }
    e.stopImmediatePropagation();
  });
  $('#btn_new_orders').click(function(e){
    if($('#userifo_form').valid()){
     var company = $('#company').val();
     var name = $('#name_user').val();
     var salary = $('#salary_user').val();
     var phone = $('#phone_user').val();
     var add_u = $('#address_user').val();
     var number_i = $('#number_issue').val();
     var date_issue = $('#date_issue_reg').val();
     var addr_issue = $('#addr_issue').val();
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
     $.ajax({
      type: "post",
      url: url+"/orders/postAjaxNewUserOrder",
      data:{
        company: company,
        name: name,
        salary: salary,
        phone: phone,
        add_u: add_u,
        number_i: number_i,
        date_issue: date_issue,
        addr_issue: addr_issue,
        btn_order_new: "btn_order_new"
      },
      dataType: "json",
      success: function(res){
        if(res.user_id){
          $('#fullname').val(res.fullname);
          $('#user_id').val(res.user_id);
          $('#buytxt').val(res.buy);
          $('#register_user').remove();
          $('#success_register').remove();
          $('#create_order').show();
          $('body').scrollTop(0);
        }
      },error: function(res){
        // console.log(res);
      }
    });
   }
   e.stopImmediatePropagation();
 });
  $('#btn_suc_reg').click(function(){
    $('#success_register').remove();
    $('#create_order').show();
    $('body').scrollTop(0);
  });
  $('#btn_order_apply').click(function(e){
    if($('#orders_form').valid()){
      var user_id = $('#user_id').val();
      var name_product = $('#product').val();
      var code_product = $('#code_product').val();
      var color = $('#color').val();
      var price = $('#price').val().replace(/[ đồng,.]/g,'');
      var select_rate = $('#select_rate').val();
      var pre_pay = $('#pre_pay').val().replace(/[ đồng,.]/g,'');
      var lead_month = $('#lead_month').val();
      var select_market = $('#select_market').val();
      var select_city = $('#select_city').val();
      var select_dis = $('#select_dis').val();
      var select_store = $('#select_store').val();
      var name_sale = $('#name_sale').val();
      var phone_sale  = $('#phone_sale').val();      
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type: "post",
        url: url+"/orders/postAjaxNewUserOrder",
        data:{
          user_id: user_id,
          name_product: name_product,
          code_product: code_product,
          color: color,
          price: price,
          select_rate: select_rate,
          pre_pay: pre_pay,
          lead_time: lead_month,
          select_market: select_market,
          select_city: select_city,
          select_dis: select_dis,
          select_store: select_store,
          name_sale: name_sale!=''?name_sale:'',
          phone_sale: phone_sale!=''?phone_sale:'',
          btn_order_form: "btn_order_form"
        },
        dataType: "json",
        success: function(res){
          if(res.success){
            $('#create_order').remove();
            $('#success_order').show();
            $('body').scrollTop(0);
          }
        },error: function(res){
          console.log(res);
        }
      });
    }
    e.stopImmediatePropagation();
  });
  $('#btn_success_redirect').click(function(){
    window.location.href = url;
  });
  $('#btn_upload').click(function(e){
    var company = $('#company').val();
    var name = $('#name_user').val();
    var salary = $('#salary_user').val();
    var phone = $('#phone_user').val();
    var add_u = $('#address_user').val();
    var number_i = $('#number_issue').val();
    var date_issue = $('#date_issue').val();
    var addr_issue = $('#addr_issue').val();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: "post",
      url: url+"/postAjaxNewUserOrder",
      data:{
        company: company,
        name: name,
        salary: salary,
        phone: phone,
        add_u: add_u,
        number_i: number_i,
        date_issue: date_issue,
        addr_issue: addr_issue,
        btn_upload: "btn_upload"
      },
      dataType: "json",
      success: function(res){
      },error: function(res){
        // console.log(res);
      }
    });
    e.stopImmediatePropagation();
  });
  jQuery.validator.addMethod("checkdateissue", function(value, element) {
    var today = Date.now();
    var dateissue = value.split("/");
    var f = new Date(dateissue[2], dateissue[1] - 1, dateissue[0]);
    return today > f;
  }, "Ngày cấp phải nhỏ hơn ngày hiện tại");
  
  $('#date_issue_reg').change(function(){
    var now =  Date.parse(moment().format("DD-MM-YYYY"));
    var date = Date.parse($('#date_issue_reg').val());
    if(date > now){
      $('#error_date').html("Ngày cấp phải nhỏ hơn ngày hiện tại!!!");
    }
    else{
      $('#error_date').html('');
    }
  });
  $('#salary_user').change(function(){
    var salary_user = numeral($('#salary_user').val().replace(/[ đồng.,]/g,'')).format('0,0');
    if(salary_user){
      $('#salary_user').val(salary_user.replace(/,/g,'.')+" đồng");
    }
  });
  $.validator.addMethod("ChangePP", function (value, element) {
   if($('#buytxt').val().replace(/[ đồng.,]/g,'')>0)
    return true
  else
    return false

}, 'Giá phải lớn hơn 0');
  $.validator.addMethod("min_price", function (value, element) {
   if($('#price').val().replace(/[ đồng,.]/g,'')>0)
    return true
  else
    return false

}, 'Giá phải lớn hơn 0');
  $.validator.addMethod("min_salary_user", function (value, element) {
   if($('#salary_user').val().replace(/[ đồng,.]/g,'')>0)
    return true
  else
    return false

}, 'Lương của bạn phải lớn hơn 0');
  $.validator.addMethod("max_salary_user", function (value, element) {
   if($('#salary_user').val().replace(/[ đồng,.]/g,'')<100000000)
    return true
  else
    return false

}, 'Lương của bạn phải nhỏ hơn 100 triệu');
  $.validator.addMethod("check_pre_pay", function (value, element) {
   if($('#pre_pay').val()==''&&$('#select_rate').val()=='')
    return false
  else
    return true

}, 'phải chọn trả trước hoặc chọn tỷ lệ');

  $.validator.addMethod("check_pre_pay_percent", function (value, element) {
    var price=$('#price').val().replace(/[ đồng,.]/g,'');
    var prepay=$('#pre_pay').val().replace(/[ đồng,.]/g,'');
    if(prepay/price < 0.3)
      return false
    else
      return true
  }, 'Trả trước phải lớn lơn 30% giá trị sản phẩm');
    // $.validator.addMethod("check_price_vs_buy", function (value, element) {
    //   var price=$('#price').val().replace('.','').replace('.','').replace('.','').replace('.','').replace('.','').replace(' đồng','');
    //   var buytxt=$('#buytxt').val().replace('.','').replace('.','').replace('.','').replace('.','').replace('.','').replace(' đồng','');
    //   if(buytxt*2.5<price)
    //     return false
    //   else
    //     return true
    // }, 'Bạn không đủ sức mua ');
    $("#userifo_form").validate({
      rules: {
        company: {
          required: true,
        },
        name_user: {
          required: true,
          maxlength: 50
        },
        salary_user: {
          required: true,
          min_salary_user:true,
          max_salary_user:true,
          // check_price_vs_buy:true,
        },
        phone_user:{
          required: true,
          number: true,
          minlength: 10,
          maxlength: 11,
        },
        address_user: {
          required: true,
          minlength: 6,
          maxlength: 225,
        },
        number_issue: {
          required:true,
          number: true,
          minlength: 9,
          maxlength: 12,
          remote: {
            url: "http://"+window.location.host+"/checkidentitycard",
            type: "post",
            data: {
              identitycard: function() {
                return $( "#number_issue").val();
              },
            }
          },
        },
        date_issue: {
          required:true,
          checkdateissue:true
        },
        addr_issue: {
          required: true,
          minlength: 6,
          maxlength: 50,
        } 
      },
      messages: {
        company:{
          required:"Bạn chưa chọn công ty",
        },
        name_user:{
          required:"Bạn chưa nhập tên",
          maxlength:"Tên không được nhập quá 50 ký tự",
        },
        salary_user:{
          required:"Trường này không được để trống",
        },
        phone_user:{
          required:"Bạn chưa nhập số điện thoại",
          number:"Số điện thoại không được phép nhập chữ",
          minlength: "Sai định dạng số điện thoại",
          maxlength: "Sai định dạng số điện thoại",
        },
        address_user:{
          required:"Bạn chưa nhập địa chỉ",
          minlength:"Địa chỉ quá ngắn. Không hợp lệ",
          maxlength: "Địa chỉ quá dài. Không hợp lệ"
        },
        number_issue :{
          required:"Bạn chưa nhập số chứng minh nhân dân",
          number: "Số chứng minh nhân dân không chứa chữ",
          minlength:"Số chứng minh nhân dân không hợp lệ",
          maxlength:"Số chứng minh nhân dân không hợp lệ",
          remote:"Số chứng minh này đã tồn tại"

        },
        date_issue: {
          required: "Bạn chưa chọn ngày cấp",
        },
        addr_issue: {
          required: "Bạn chưa nhập nơi cấp CMND",
          minlength: "Địa chỉ quá ngắn không hợp lệ",
          maxlength: "Địa chỉ quá dài. Không hợp lệ",
        }
      }
    });



    $.validator.addMethod("check_pre_pay", function (value, element) {
      if($('#pre_pay').val()==''&&$('#select_rate').val()=='')
        return false
      else
        return true
    }, 'Bạn vui lòng chọn tỉ lệ hoặc điền số tiền trả trước');
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
      var price=$('#price').val().replace(/[ đồng,.]/g,'');
      var prepay=$('#pre_pay').val().replace(/[ đồng,.]/g,'');
      var buytxt=$('#buytxt').val().replace(/[ đồng,.]/g,'');
      if(parseInt(buytxt)<parseInt(price-prepay))
        return false
      else
        return true
    }, 'Bạn không đủ sức mua ');
    $("#orders_form").validate({
      rules: {
        product: {
          required: true,
        },
        code_product: {
          required: true,
          maxlength: 50,
          minlength: 3
        },
        color: {
          required: true,
        },
        price: {
          required: true,
          check_price_vs_buy:true,
          min_price:true,
        },
        pre_pay: {
          check_pre_pay:true,
          check_pre_pay_percent:true,
          check_pre_pay_vs_price:true,
          check_pre_pay_percent_70:true
        },
        lead_month: {
          required:true,
          number: true,
        },
        market: {
          required:true
        },
        select_city: {
          required: true,
        },
        select_dis:{
          required: true,
        },
        select_store:{
          required: true,
        },
      },
      messages: {
        product:{
          required:"Bạn chưa nhập tên sản phẩm",
        },
        code_product:{
          required:"Bạn chưa nhập tên",
          maxlength:"Tên không được nhập quá 50 ký tự",
          minlength: "Tên sản phẩm phải nhiều hơn 3 ký tự",
        },
        color:{
          required:"Bạn chưa nhập màu sản phẩm",
        },
        price:{
          required: "Bạn chưa nhập số tiền của mặt hàng",
        },
        lead_month: {
          required:"Bạn chưa chọn thời hạn đơn hàng",
          number: "Giá trị của lựa chọn là số",
        },
        market: {
          required: "Mời bạn chọn hệ thống bán lẻ",
        },
        select_city: {
          required: "Mời bạn chọn thành phố",
        },
        select_dis: {
          required: "Mời bạn chọn Quận Huyện",
        },
        select_store: {
          required: "Mời bạn chọn cửa hàng",
        }
      }
    });
  });
