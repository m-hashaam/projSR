var cat_edit;
var street_edit;
var state_edit;
var count = 0;

$(document).ready(function(){
	$("#main_table td:nth-child(8) input").click(function() {
		if($(this).val() == "Change"){
			$(this).val("Done");
			$(this).parent().parent().find('td:nth-child(6)').html("<select class=\"select_custom form-control\"><option value=\"Picked Up\">Picked Up</option><option value=\"Washing\">Washing</option><option value=\"Ready\">Ready</option><option value=\"Delivered\">Delivered</option></select>");
		}
		else{
			$(this).val("Change");
			var status = $(this).parent().parent().find('td:nth-child(6)').find('select option:selected').text();
			//alert(status);
			var id = $(this).parent().parent().find('td:nth-child(1)').html();
			//alert(id);
			$.post( 
			'database/main.php', 						
			{ func: "changeStatus" ,  state:status ,id:id},
			function( data ){ 									    
				location.reload();
			});
		}
	});	
	
	$("#suggestion_table td:nth-child(5) input").click(function() {
		
		var id = $(this).parent().parent().find('td:nth-child(1)').html();
		//alert(id);
		$.post( 
		'database/suggestion.php', 						
		{ func: "changeSuggestionRead"  ,id:id},
		function( data ){ 		
			//alert(data);
			location.reload();
		});
		
	});



	//for address table ------------------------------------------//////////////////////////////////
	
	
	//edit clicked
	$("#adress_table td:nth-child(5) input").click(function() {
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
			cat_edit = $(this).parent().parent().find('td:nth-child(1)').html();
			street_edit = $(this).parent().parent().find('td:nth-child(2)').html();
			state_edit = $(this).parent().parent().find('td:nth-child(3)').html();
			$(this).parent().parent().find('td:nth-child(1)').html("<select id=\"edit_cat\" class=\"select_custom form-control\"><option value=\"Home\">Home</option><option value=\"Office\">Office</option><option value=\"Others\">Others</option></select>");
			$(this).parent().parent().find('td:nth-child(2)').html("<input value = \""+street_edit+"\" class=\"form-control\" type=\"text\" id=\"edit_price\"  onkeyup=\"validateNumber()\" placeholder=\"Price\">");
			$(this).parent().parent().find('td:nth-child(3)').html("<input value = \""+state_edit+"\" class=\"form-control\" type=\"text\" id=\"edit_qty\"  onkeyup=\"validateNumber2()\" placeholder=\"Quantity Per Purchase\">");
			$(this).val("Done");
			$(this).parent().parent().find('td:nth-child(6)').find('input').val('Cancel');
			$(this).parent().parent().find('td:nth-child(6)').find('input').addClass('btn-danger').removeClass('btn-success');
			document.getElementById('edit_cat').value = cat_edit;
			
		}
		else if($(this).val() == "Done"){
			count = count - 1;
			var id = $(this).attr('id');
			var cat = $("#edit_cat").val();
			var street = $(this).parent().parent().find('td:nth-child(2)').find('input').val();
			var state = $(this).parent().parent().find('td:nth-child(3)').find('input').val();
			if(cat == ""){
				alert("Please Enter Category");
				return;
			}
			if(street == ""){
				alert("Please Enter Street");
				return;
			}
			if(state == ""){
				alert("Please Enter state");
				return;
			}
			$(this).val("Edit");
			$.blockUI( {message: '<h3> <img src="assets/loading.gif"/> Please Wait </h3>'});
			$.post( 
			'database/userdetails.php', 			
			{ func: "updateAddress" , id:id , state:state, street:street, cat:cat},		 
			function( data ){ 	
				//alert(data);
				location.reload();
		    });
		}
	});
	
	//remove clicked
	$("#adress_table td:nth-child(6) input").click(function() {
		if($(this).val()=="Remove"){
			var id = $(this).attr('id');
			$.blockUI( {message: '<h3> <img src="assets/loading.gif"/> Please Wait </h3>'});
			$.post( 
			'database/userdetails.php', 			
			{ func: "removeAddress" , id:id },		 
			function( data ){ 	
			//alert(data);
				location.reload();
			});
		}else if($(this).val() == "Cancel"){
			count = count - 1;
			$(this).parent().parent().find('td:nth-child(1)').html(cat_edit);
			$(this).parent().parent().find('td:nth-child(2)').html(street_edit);
			$(this).parent().parent().find('td:nth-child(3)').html(state_edit);
			$(this).parent().parent().find('td:nth-child(4)').find('input').val('Edit');
			$(this).parent().parent().find('td:nth-child(5)').find('input').val('Remove');
			$(this).parent().parent().find('td:nth-child(5)').find('input').addClass('btn-success').removeClass('btn-danger');
		}

	});
	$("#adress_table td:nth-child(7) input").click(function() {
		if($(this).val()=="Mark"){
			var id = $(this).attr('id');
			var name = "addrlatlong.php?addrid="+id;
			window.location = name;
		}

	});
	
});


function cancelInsertRow() {
	var table = document.getElementById("adress_table");
	var row_length = document.getElementById("adress_table").rows.length;

		row = table.deleteRow(1);
		count = 1;
	
	var button = document.getElementById("addBtn");
	button.value = "Add Address";
}


function insertRow() {
	var button = document.getElementById("addBtn");
	var table = document.getElementById("adress_table");

	if (button.value == "Add Address"){
			button.value = "Done";
			 var row_length = document.getElementById("adress_table").rows.length;
			 var row ;
			 var count;
			
				row = table.insertRow(1);
				count = 1;
			
			

			var cell0 = row.insertCell(0);
			var cell1 = row.insertCell(1);
			var cell2 = row.insertCell(2);
			var cell3 = row.insertCell(3);
			var cell4 = row.insertCell(3);
			var cell5 = row.insertCell(3);
			
			
			cell0.innerHTML = "<select id=\"new_cat\" class=\"select_custom form-control\"><option value=\"Home\">Home</option><option value=\"Office\">Office</option><option value=\"Others\">Others</option></select>";
			cell1.innerHTML = "<input class=\"form-control\" type=\"text\" id=\"new_street\" placeholder=\"Street Name\">";
			cell2.innerHTML = "<input class=\"form-control\" type=\"text\" id=\"new_state\"  placeholder=\"State\">";
			cell4.setAttribute("colspan", "2");
			cell4.setAttribute("align", "center");
			cell4.innerHTML = "<input value=\"Cancel\" class=\"btn btn-danger center\" type=\"button\" id=\"cancel\" onclick=\"cancelInsertRow()\" >";
			

	}else if (button.value == "Done"){
			
			var cat = $("#new_cat").val();
			var state = $("#new_state").val();
			var street = $("#new_street").val();
			var id = getUrlParameter("id");
			if(id == null){
				alert("No User Selected");
				return;
			}
			if(cat == ""){
				alert("Please Enter Category");
				return;
			}
			if(street == ""){
				alert("Please Enter Street");
				return;
			}
			if(state == ""){
				alert("Please Enter State");
				return;
			}
			
			$.blockUI( {message: '<h3> <img src="assets/loading.gif"/> Please Wait </h3>'});
			$.post( 
				'database/userdetails.php', 			
				{ func: "addAddress" ,  cat:cat, state:state, street:street, id:id},		 
				function( data ){ 	
				//alert(data);
					location.reload();
		    });

	}	
}

function getUrlParameter(sParam)
{
	var sPageURL = window.location.search.substring(1);
	var sURLVariables = sPageURL.split('&');
	for (var i = 0; i < sURLVariables.length; i++)
		{
			var sParameterName = sURLVariables[i].split('=');
			if (sParameterName[0] == sParam)
			{
				return sParameterName[1];
			}
		}
}