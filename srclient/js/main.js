

$(document).ready(function(){
	$("#main_table td:nth-child(9) input").click(function() {
		if($(this).val() == "Change"){
			$(this).val("Done");
			$(this).parent().parent().find('td:nth-child(6)').html("<select class=\"select_custom form-control\"><option value=\"Picked Up\">Picked Up</option><option value=\"Washing\">Washing</option><option value=\"Ready\">Ready</option><option value=\"Delivered\">Delivered</option></select>");
		}
		else{
			$(this).val("Change");
			var status = $(this).parent().parent().find('td:nth-child(6)').find('select option:selected').text();
			//alert(status);
			var id = $(this).attr('id');
			//alert(id);
			$.blockUI( {message: '<h3> <img src="assets/loading.gif"/> Please Wait </h3>'});
			$.post( 
			'database/main.php', 						
			{ func: "changeStatus" ,  state:status ,id:id},
			function( data ){ 									    
				//alert(data);
				location.reload();
			});
		}
	});	
	
});