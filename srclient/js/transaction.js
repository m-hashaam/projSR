

$(document).ready(function(){
	
	$('input[class=flt]').addClass('form-control');
	$('select[class=flt]').addClass('form-control');
	
	
	$("#transaction_table td:nth-child(9) input").click(function() {
		if($(this).val() == "Change"){
			$(this).val("Done");
			$(this).parent().parent().find('td:nth-child(7)').html("<select class=\"select_custom form-control\"><option value=\"Paid\">Paid</option><option value=\"Unpaid\">Unpaid</option></select>");
		}
		else{
			$(this).val("Change");
			var status = $(this).parent().parent().find('td:nth-child(7)').find('select option:selected').text();
			//alert(status);
			var id = $(this).attr('id');
			//alert(id);
			$.blockUI( {message: '<h3> <img src="assets/loading.gif"/> Please Wait </h3>'});
			$.post( 
				'database/transaction.php', 						
				{ func: "changeStatus" ,  state:status ,id:id},
				function( data ){ 									    
					//alert(data);
					location.reload();
			});
		}
	});

	$("#transaction_table td:nth-child(10) input").click(function() {
			var id = $(this).attr('id');
			//alert(id);
			$.blockUI( {message: '<h3> <img src="assets/loading.gif"/> Sending Mail </h3>'});
			$.post( 
				'database/transaction.php', 						
				{ func: "sendMail" , id:id},
				function( data ){ 
					//alert(data);
					$.unblockUI();				
					$.blockUI( {timeout: 1000, message: '<h3> <img src="assets/tick.png"/> Reminder Sent</h3>'});
			});
		});	
	
});