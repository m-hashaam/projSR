var ins_edit;
var status_edit;
var pstatus_edit;
var starch_edit;
var packaging_edit;
var count = 0;
$(document).ready(function(){
	//edit clicked
	$("#orders_table td:nth-child(8) input").click(function() {
		var test = $(this).parent().parent().find('th:nth-child(1)').html();
		if(test != null){
			return;
		}
		else if($(this).val() == "Edit"){
			if(count == 1){
				alert("Please finish previous edit first");
				return;
			}
			count=count+1;
			var id = $(this).attr('id');
			
			starch_edit = $(this).parent().parent().find('td:nth-child(3)').html();
			packaging_edit = $(this).parent().parent().find('td:nth-child(4)').html();
			ins_edit = $(this).parent().parent().find('td:nth-child(5)').html();
			status_edit = $(this).parent().parent().find('td:nth-child(6)').html();
			$(this).parent().parent().find('td:nth-child(3)').html("<select id=\"edit_starch\" class=\"select_custom form-control\"><option value=\"None\">None</option><option value=\"Light\">Light</option><option value=\"Medium\">Medium</option><option value=\"Heavy\">Heavy</option></select>");
			$(this).parent().parent().find('td:nth-child(4)').html("<select id=\"edit_packaging\" class=\"select_custom form-control\"><option value=\"Fold\">Fold</option><option value=\"Hang\">Hang</option></select>");
			$(this).parent().parent().find('td:nth-child(5)').html("<input value = \""+ins_edit+"\" class=\"form-control\" type=\"text\" id=\"new_package\" placeholder=\"Instructions\">");
			$(this).parent().parent().find('td:nth-child(6)').html("<select id=\"edit_status\" class=\"select_custom form-control\"><option value=\"Order Placed\">Order Placed</option><option value=\"Picked Up\">Picked Up</option><option value=\"Washing\">Washing</option><option value=\"Ready\">Ready</option><option value=\"Delivered\">Delivered</option><option value=\"Canceled\">Canceled</option></select>");
			$(this).val("Done");
			document.getElementById('edit_status').value = status_edit;
			document.getElementById('edit_starch').value = starch_edit;
			document.getElementById('edit_packaging').value = packaging_edit;
			$(this).parent().parent().find('td:nth-child(9)').find('input').val('Cancel');
			$(this).parent().parent().find('td:nth-child(9)').find('input').addClass('btn-danger').removeClass('btn-success');
			
		}
		else if($(this).val() == "Done"){
			count = count - 1;
			var id = $(this).attr('id');
			var ins = $(this).parent().parent().find('td:nth-child(5)').find('input').val();
			var status = $(this).parent().parent().find('td:nth-child(6)').find('select option:selected').text();
			var starch = $(this).parent().parent().find('td:nth-child(3)').find('select option:selected').text();
			var packaging = $(this).parent().parent().find('td:nth-child(4)').find('select option:selected').text();
			$(this).val("Edit");
			$.blockUI( {message: '<h3> <img src="assets/loading.gif"/> Please Wait </h3>'});
			$.post( 
				'database/orders.php', 			
				{ func: "updateOrder" , id:id , ins:ins , status:status, starch:starch, packaging:packaging},		 
				function( data ){ 	
					alert(data);
					//location.reload();
		    });
		}
	});
	
	//remove clicked
	$("#orders_table td:nth-child(9) input").click(function() {
		if($(this).val()=="Remove"){
			var id = $(this).attr('id');
			var r = confirm("This will permanently remove order from database.!");
			if (r == true) {
				$.blockUI( {message: '<h3> <img src="assets/loading.gif"/> Please Wait </h3>'});
				$.post( 
				'database/orders.php', 			
				{ func: "removeOrder" , id:id },		 
				function( data ){ 	
					location.reload();
				});
			}
		}else if($(this).val() == "Cancel"){
			count = count - 1;
			$(this).parent().parent().find('td:nth-child(3)').html(starch_edit);
			$(this).parent().parent().find('td:nth-child(4)').html(packaging_edit);
			$(this).parent().parent().find('td:nth-child(5)').html(ins_edit);
			$(this).parent().parent().find('td:nth-child(6)').html(status_edit);
			$(this).parent().parent().find('td:nth-child(8)').find('input').val('Edit');
			$(this).parent().parent().find('td:nth-child(9)').find('input').val('Remove');
			$(this).parent().parent().find('td:nth-child(9)').find('input').addClass('btn-success').removeClass('btn-danger');
		}

	});
});
