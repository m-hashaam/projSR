var availableOptions = [];

$(document).ready(function(){
	$('#username' ).autocomplete({source: availableOptions});
	$('#date').datepicker();
	$("#addrid").attr('disabled', 'disabled');
	$("#address").attr('disabled', 'disabled');
	//$("#paymethod").attr('disabled', 'disabled');
	$('#username').bind("blur", function() {
		var userid = $(this).val();
		$.post( 
				'database/addorder.php', 			
				{ func: "getAddress" , userid:userid },		 
				function( data ){ 	
					var result = JSON.parse(data);
					var addressid="";
					var address="";
					for(var i=0 ; i<result[0].length ; i++){
						addressid+="<option value = \""+result[0][i]+"\">"+result[0][i]+"</option>";
						address+="<option value = \""+result[1][0]+"\">"+result[1][0]+"</option>";
					}
					document.getElementById('addrid').innerHTML = addressid;
					$("#addrid").removeAttr('disabled');
					document.getElementById('address').innerHTML = address;
					
					
			});
			
			// $.post( 
				// 'database/addorder.php', 			
				// { func: "getPayMethods" , userid:userid },		 
				// function( data ){ 	
					// var result = JSON.parse(data);
					// var pm = "";
					// for(var i=0 ; i<result.length ; i++){
						// pm+="<option value = \""+result[i]+"\">"+result[i]+"</option>";
					// }
					// if(result.length == 0){
						// pm+="<option value = \"None\">None</option>";
					// }
					// document.getElementById('paymethod').innerHTML = pm;
					// $("#paymethod").removeAttr('disabled');
			// });
	});
});

function addridselected(){
	var id = $('#addrid option:selected').text();
	$.post( 
		'database/addorder.php', 			
		{ func: "getAddressfromid" , id:id },		 
		function( data ){ 	
		
				document.getElementById('address').innerHTML = "<option value = \""+data+"\">"+data+"</option>";
	});
}


function cancel(){
	var name = "orders.php";
	window.location = name;
}


