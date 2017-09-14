$(document).ready(function(){
	var url  ="/admin/ajax/postretailOrders";
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$('#admarket').change(function() {
		$('#addis').empty();
		$('#adstore').empty();
		$('#admarket').find("option").removeAttr('selected');
		var market = $('#admarket').val();
		$.ajax({
			type:"post",
			url:url,
			data:{
				market: market,
			},
			dataType: "json",
			success: function(res){
				console.log(res);
				$('#adcity').empty();
				$('#adcity').append('<option value="">'+'Chọn List'+'</option>');
				// var data = JSON.parse(res);	
				$.each(res, function(i,el) {
					$('#adcity').append('<option value="'+el+'">'+el+'</option>');
				}); 
			},error: function(data){
				console.log("Error_city:");
			}
		});
	});
	$('#adcity').change(function() {
		// $('#adcity').find("option").removeAttr('selected');
		var city = $('#adcity').val();
		var market = $('#admarket').val();
		$.ajax({
			type:"post",
			url:url,
			data:{
				city: city,
				market: market,
			},
			dataType: "json",
			success: function(res){
				$('#addis').empty();
				$('#addis').append('<option value="">'+'Chọn List'+'</option>');
				// var data = JSON.parse(res);	
				$.each(res, function(i,el) {
					$('#addis').append('<option value="'+el+'">'+el+'</option>');
				}); 
			},error: function(data){
				console.log("Error_city:");
			}
		});
	});

	$('#addis').change(function() {
		// $('#adcity').find("option").removeAttr('selected');
		var city = $('#adcity').val();
		var dis = $('#addis').val();
		var market = $('#admarket').val();
		$.ajax({
			type:"post",
			url:url,
			data:{
				dis:dis,
				city: city,
				market: market,
			},
			dataType: "json",
			success: function(res){
				$('#adstore').empty();
				$('#adstore').append('<option value="">'+'Chọn List'+'</option>');
				// var data = JSON.parse(res);	
				$.each(res, function(i,el) {
					$('#adstore').append('<option value="'+el+'">'+el+'</option>');
				}); 
			},error: function(data){
				console.log("Error_city:");
			}
		});
	});
});