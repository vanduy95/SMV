@extends('layouts.master')
@section('content')
<script>
	function myFun(){
		var x = $("#btnUpload").val().split("\\");
		$("#btnFile").val(x[2]);
	}
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
});
		$('#select_company').hide();
		var val="";
		$('#input_company').click(function(){
			$('#input_company').val("");
			$('#id_comp').val("");
			$('#select_company').show("slow");
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
</script>
<style type="text/css">
	.select_company option:hover{
		background: rgba(29, 33, 41,0.3);
		cursor: pointer;
		border-radius: 0;
	}
	.select_company option{
		font-size: 15px;
		color: black !important;
		border:0;
	}
	.select_company{
		background: white;
		overflow-y: scroll;
		height: 150px;
		border: 1px solid #bccccd;
		text-align: left;
		padding:0;
		z-index: 99999999;
	}
	.div-center{
		display: flex;
		align-items: center;
		justify-content: center;
	}
	th{
		text-align: center !important;
		vertical-align: middle !important;
	}
	.clear{
		clear: both;
	}
</style>
<section class="content-header">
	<h1>
		Thêm danh sách hệ thống cửa hàng  
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Store</li>
	</ol>
</section>
<section class="content">
	<div class="box-header col-lg-12 div-center">
		<div class=" col-lg-8">
			{!!Form::open(array('class'=>'form-validate  form-group text-center form-horizontal','id'=>'store_form','style'=>'background: rgba(236, 236, 236, 1); border: 2px solid white; display:  block','url'=>'admin/store/excel','enctype'=>'multipart/form-data'))!!}
			<div class="col-lg-12 form-group" style="margin-top: 15px;">
				<b class="" style="font-size: 20px;font-family: Arial;">Thêm danh sách cửa hàng</b>
			</div>
			<div class="form-group">
				<div class="col-lg-5 div-center">
					<label>Tải lên danh sách:</label>
				</div>
				<div class="col-lg-6">
					<div class="input-group">
						<label class="input-group-btn">
							<span class="btn btn-primary">
								Browse&hellip; <input id="btnUpload" name="upExcel" onchange="myFun();" type="file" accept="" style="display: none;" multiple>
							</span>
						</label>
						<input id="btnFile" type="text" class="form-control" readonly>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-12 div-center">
					{!! Form::submit('Tải lên', ['class'=>'btn btn-primary col-lg-3']) !!}
				</div>
			</div>
			<div class="clear"></div>
			{!!Form::close() !!}
		</div>
	</section>
	@stop