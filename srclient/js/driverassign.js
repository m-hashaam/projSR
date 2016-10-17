var count = 0;
$(document).ready(function(){
	
	var id = getUrlParameter("id");
	//alert("id is "+id);
	if(id != null){
		document.getElementById("flt0_orders_table").value=id;
		 var e = jQuery.Event("keypress");
		 e.which = 13; //choose the one you want
		 e.keyCode = 13;
		 $("#flt0_orders_table").trigger(e);
	}
	
	
	//edit clicked
	$("#orders_table td:nth-child(7) input").click(function() {
		if($(this).val() == "Assign"){
			if(count == 1){
				alert("Please finish previous edit first");
				return;
			}
			count=count+1;
			var id = $(this).attr('id');
			
			
			$(this).parent().parent().find('td:nth-child(6)').html("<select id=\"edit_status\" class=\"select_custom form-control\"><option value=\"Order Placed\">Loading ...</option></select>");
			$(this).val("Done");
			
			$.post( 
				'database/drivers.php', 			
				{ func: "checkAddress" , id:id },		 
				function( data ){ 	
					if(data == "success"){
						
					}
					else if(data == "fail"){
						if (confirm("You have not selected the required address on map yet. You will be redirected to another page now.") == true) {
							var name = "addrlatlong.php?id="+id;
							window.location = name;
						}
					}
				}
			);
			
			$.post( 
				'database/drivers.php', 			
				{ func: "getDrivers" },		 
				function( data ){ 	
					var result = JSON.parse(data);
					var cats="";
					for(var i=0 ; i<result[0].length ; i++){
						cats+="<option value = \""+result[0][i]+"\">"+result[1][i]+"</option>";
					}
					document.getElementById('edit_status').innerHTML = cats;
		    });
			
		}
		else if($(this).val() == "Done"){
			count = count - 1;
			var driver = $('#edit_status').val();
			var id = $(this).attr('id');
			
			$(this).val("Edit");
			$.blockUI( {message: '<h3> <img src="assets/loading.gif"/> Please Wait </h3>'});
			
			$.post( 
				'database/drivers.php', 			
				{ func: "assignDriver" , driver:driver, id:id},		 
				function( data ){ 	
					//alert(data);
					var name = "driverassign.php";
					window.location = name;
		    });
		}
	});
	
	$("#pending_table td:nth-child(6) input").click(function() {
		if($(this).val() == "Unassign"){
			var id = $(this).attr('id');
			//alert("id is "+id);
			$.blockUI( {message: '<h3> <img src="assets/loading.gif"/> Please Wait </h3>'});
			$.post( 
				'database/drivers.php', 			
				{ func: "UnassignDriver" , id:id},		 
				function( data ){ 	
					location.reload();
		    });
		}
	});
});


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