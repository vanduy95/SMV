$(document).ready(function(){
  $('#alert_info').hide();
  $('#select_city').on('change',function(){
    var val = $('option:selected',$('#select_city')).text();
    var market = $('option:selected',$('#select_market')).val();
    var url  = "http://"+document.location.host+"/ordersPostAjax";
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    if(market==""){
      $.ajax({
        type:"post",
        url:url,
        data:{
          city: val,
        },
        dataType: "html",
        success: function(res){
          $('#select_dis').empty();
          $('#select_dis').append('<option value="">'+'Chọn Quận Huyện'+'</option>');
          var data = JSON.parse(res);
          $.each(data, function(i, el) {
            $('#select_dis').append('<option value="'+el+'">'+el+'</option>');
            // tao quen het jquery roi`
          });        
        },
        error: function(data){
          console.log("Error_city:");
        },
      });//end ajax
    }
    else{
      $.ajax({
        type:"post",
        url:url,
        data:{
          city: val,
          market: market
        },
        dataType: "html",
        success: function(res){
          $('#select_dis').empty();
          $('#select_dis').append('<option value="">'+'Chọn Quận Huyện'+'</option>');
          var data = JSON.parse(res);
          $.each(data, function(i, el) {
            $('#select_dis').append('<option value="'+el+'">'+el+'</option>');
            // tao quen het jquery roi`
          });     
        },
        error: function(data){
          console.log("Error_city:");
        },
      });//end ajax
    }
  });
   //ajax district
   $('#select_dis').on('change',function(){
    var dis = $('option:selected',$('#select_dis')).text();
    var city = $('option:selected',$('#select_city')).text();
    var market = $('option:selected',$('#select_market')).val();
    var url  = "http://"+document.location.host+"/ordersPostAjax";
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    if(market==""){
      $.ajax({
        type:"post",
        url:url,
        data:{
          dis: dis,
          city: city,
        },
        dataType: "html",
        success: function(res){
          $('#select_market').empty();
          $('#select_market').append('<option value="">'+'Chọn Hệ Thống Bán Lẻ'+'</option>');
          var data = JSON.parse(res);
          $.each(data, function(i, el) {
            $('#select_market').append('<option value="'+el+'">'+el+'</option>');
            // tao quen het jquery roi`
          });  
          // console.log(res);
        },
        error: function(res){
          console.log("Error_dis:",res);
        },
      });//end ajax
    }
    else{
      var market = $('option:selected',$('#select_market')).text();
      var dis = $('option:selected',$('#select_dis')).val();
      var city = $('option:selected',$('#select_city')).val();
      var url  = "http://"+document.location.host+"/ordersPostAjax";
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type:"post",
        url:url,
        data:{
          market: market,
          dis: dis,
          city: city,
        },
        dataType: "json",
        success: function(res){
          $('#select_store').empty();
          $('#select_store').append('<option value="">'+'Chọn Cửa Hàng'+'</option>');
          $.each(res, function(i, el) {
            $('#select_store').append('<option value="'+el+'">'+el+'</option>');
            // tao quen het jquery roi`
          });  
        },
        error: function(res){
          console.log("Error_store:",res);
        },
      });
    }
  });
   //ajax name center or store
   $('#select_market').on('change',function(){
    var market = $('option:selected',$('#select_market')).text();
    var dis = $('option:selected',$('#select_dis')).val();
    var city = $('option:selected',$('#select_city')).val();
    var url  = "http://"+document.location.host+"/ordersPostAjax";
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    if(dis==""){
      $.ajax({
        type:"post",
        url:url,
        data:{
          market: market,
        },
        dataType: "json",
        success: function(res){
          $('#select_city').empty();
          $('#select_city').append('<option value="">'+'Chọn Thành Phố'+'</option>');
          $.each(res, function(i, el) {
            $('#select_city').append('<option value="'+el+'">'+el+'</option>');
            // tao quen het jquery roi`
          });  
        },
        error: function(res){
          console.log("Error_store:",res);
        },
      });//end ajax
    }
    else{
      $.ajax({
        type:"post",
        url:url,
        data:{
          market: market,
          dis: dis,
          city: city,
        },
        dataType: "json",
        success: function(res){
          $('#select_store').empty();
          $('#select_store').append('<option value="">'+'Chọn Cửa Hàng'+'</option>');
          $.each(res, function(i, el) {
            $('#select_store').append('<option value="'+el+'">'+el+'</option>');
            // tao quen het jquery roi`
          });  
        },
        error: function(res){
          console.log("Error_store:",res);
        },
      });//end ajax
    }
  });
 });
//null dashboard
$(document).ready(function(){
  var url  = "http://"+document.location.host+"/organizationPostCompany";
  $('#input_company').keyup(function(){
    $('#select_company').show();
    var name_cp =$('#input_company').val();
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
        // $.each(res,function(i,el){
        //   console.log(i+el);
        // });
        $('#select_company').find('option').remove();
        $.each(res, function(i,el) {
          $('#select_company').append('<option style="border:none" id="item_com" class="form-control" value="'+el.id+'">'+el.name+'</option>');
        });
        var val="";
        $('#select_company').find('option#item_com').click(function(){
         val = $(this).val();
         text = $(this).text();
         $('#input_company').val(text);
         $('#id_comp').val(val);
         $('#select_company').hide();
       }); 
      },
      error: function(res){
        console.log("Error");
      },
    });
    // end ajax
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
        // $.each(res,function(i,el){
        //   console.log(i+el);
        // });
        $('#select_company').find('option').remove();
        $.each(res, function(i,el) {
          $('#select_company').append('<option style="border:none" id="item_com" class="form-control" value="'+el.id+'">'+el.name+'</option>');
        });
        var val="";
        $('#select_company').find('option#item_com').click(function(){
         val = $(this).val();
         text = $(this).text();
         $('#input_company').val(text);
         $('#id_comp').val(val);
         $('#select_company').hide();
       }); 
      },
      error: function(res){
        console.log("Error");
      },
    });
  }
});
  $('#select_company').hide();
  var val="";
  $('#input_company').click(function(){
    $('#select_company').show();
  });
  $('#select_company').find('option#item_com').click(function(){
   val = $(this).val();
   text = $(this).text();
   $('#input_company').val(text);
   $('#id_comp').val(val);
   $('#select_company').hide();
 });
  // $('#input_company').keyup(function(){
  //   $('#select_company').show();
  // });
  $('#select_company').mouseleave(function(){
    $('#select_company').hide();
  });
});
// click send data
// $(document).ready(function(){
//   $.ajaxSetup({
//     headers: {
//       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
//   });
//   var url  = "http://"+document.location.host+"/userPostAjax";
  // $('#btn_click').click(function(){
  //  var id_comp = $('#id_comp').val();
  //  var cmt = $('#txt_cmt').val();
  //  var code = $('#txt_code').val();
  //  // if(id_comp!=""){
  //   $('#id_comp').val("");
  //   $('#input_company').val("");
  //   $('#txt_cmt').val("");
  //   $('#txt_code').val("");
  //   $('#error_com').html("");
  //   $('#error_cmt').html("");
  //   $('#error_code').html("");
  //   // if(cmt!="" || code!=""){
  //     $.ajax({
  //      type:"post",
  //      url: url,
  //      data:{
  //       id_com: id_comp,
  //       cmt: cmt,
  //       code: code,
  //     },
  //     dataType:"json",
  //     success: function(res){
  //      var url  = "http://"+document.location.host;
  //      if(!res.cmt){
  //       if(!res.data){
  //         if(res.nonotify=="nonotify"){
  //           $('#register_form').hide();
  //           $('#data_form').show();
  //           $('#next_register').show();
  //           $('#u_name').val(res[0].fullname);
  //           $('#id_user').val(res[0].id);
  //           $('#sum_buy').val((res[0].salary)*2.5);
  //           $('#buy_use').val(res[0].price);
  //           $('#rest').val((res[0].salary*2.5)-res[0].price);
  //           $('#id_user').val(res[0].id);
  //           $('#upload').attr('href',url+'/orders/upload/'+res[0].id);
  //         }
  //         if(res[0].notify=="notify"){
  //           $('#register_form').hide();
  //           $('#data_form').show();
  //           $('#dont_next').show();
  //           $('#u_name').val(res[0].fullname);
  //           $('#sum_buy').val((res[0].salary)*2.5);
  //           $('#buy_use').val(res[0].price);
  //           $('#rest').val((res[0].salary*2.5)-res[0].price);
  //           $('#notify').text('Sức mua hiện tại của bạn không đủ thực hiện giao dịch. Liên hệ với chúng tôi để được hỗ trợ.');
  //           $('#hotline').text('Hotline: ');
  //           $('#return_local').attr('href',url);
  //         }
  //         else{
  //           $('#register_form').hide();
  //           $('#data_form').show();
  //           $('#next_register').show();
  //           $('#u_name').val(res[0].fullname);
  //           $('#id_user').val(res[0].id);
  //           $('#sum_buy').val((numeral((res[0].salary)*2.5).format('0,0')).replace(',','.').replace(',','.').replace(',','.')+" đồng");
  //           $('#buy_use').val((res[0].price)==null?0+" đồng":(numeral(res[0].price).format('0,0')).replace(',','.').replace(',','.').replace(',','.')+" đồng");
  //           $('#rest').val(((res[0].price)==null?(numeral((res[0].salary)*2.5).format('0,0')).replace(',','.').replace(',','.').replace(',','.')+" đồng":(numeral((res[0].salary)*2.5-res[0].price).format('0,0')).replace(',','.').replace(',','.').replace(',','.')+" đồng"));
  //           $('#id_user').val(res[0].id);
  //           $('#upload').attr('href',url+'/orders/upload/'+res[0].id);
  //         }
  //       }
  //       else{
  //         swal({
  //           title: "Không tồn tại khách hàng ",
  //           text: "<p style='color: red;margin-bottom: 15px !important'>Bạn có thể nhập lại thông tin với đầy đủ  CMND và Mã số nhân viên để có kết quả chính xác hơn</p><div class='swal-center form-group'><div class='col-lg-5' style='border-top: 1px solid red'></div><span class='col-lg-2' style='color: red'>Hoặc</span><div class='col-lg-5' style='border-top: 1px solid red !important'></div><div style='clear: both'></div></div><div class='col-lg-12'><span style='color: black'>Bạn cập nhật thông tin đơn hàng ngay (Thông tin của bạn sẽ được xác thực trong vòng 15 phút)</span</div><div style='clear: both'></div>",
  //           html:true,
  //           type: "info",
  //           showCancelButton: true,
  //           cancelButtonText: "Nhập lại thông tin",
  //           cancelButtonClass:"btn btn-primary",
  //           closeOnConfirm: false,
  //           confirmButtonClass:"btn btn-primary",
  //           confirmButtonText:"Cập nhật thông tin và đơn hàng",
  //           showLoaderOnConfirm: true,
  //         },
  //         function(){
  //           setTimeout(function(){
  //             var url  = "http://"+document.location.host+"/orders/add";
  //             window.location.href=url;
  //           }, 1500);
  //         });
          // $('#alert_info').show();
          // $('#btn_retype').click(function(){
          //   $('#alert_info').hide();
          // }); 
          // $('#btn_new_reg').click(function(){
          //   window.location.href = "/orders/add";
          // });
        // }
      // }
    //   else{
    //     $('#error_cmt').html(res.cmt)
    //   }
    // },
    // error: function(res){
    //   (JSON.parse(res.responseText).id_com)==""?$('#error_com').html(""):$('#error_com').html((JSON.parse(res.responseText).id_com));
    //   (JSON.parse(res.responseText).cmt)==""?$('#error_cmt').html(""):$('#error_cmt').html((JSON.parse(res.responseText).cmt));
    //   (JSON.parse(res.responseText).code)==""?$('#error_code').html(""): $('#error_code').html((JSON.parse(res.responseText).code));    },
    // });
  //   }
  //   else{
  //     console.log("error");
  //     $('#error').show();
  //     $('#error').text('Phải nhập số CMND hoặc mã nhân viên');
  //   }
  // }
  // else{
  //   alert("Công ty không được bỏ trống");
  // }
// });
// });