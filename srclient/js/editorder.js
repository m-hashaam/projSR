var pkg_edit;
var quantity_edit;
var desc_edit;
var count = 0;
$(document).ready(function(){
	//edit clicked
	// $("#package_table td:nth-child(5) input").click(function() {
		// var test = $(this).parent().parent().find('th:nth-child(1)').html();
		// if(test != null){
			// return;
		// }
		// else if($(this).val() == "Edit"){
			// if(count == 1){
				// alert("Please finish previous edit first");
				// return;
			// }
			// count=count+1;
			// pkg_edit = $(this).parent().parent().find('td:nth-child(1)').html();
			// quantity_edit = $(this).parent().parent().find('td:nth-child(3)').html();
			// $(this).parent().parent().find('td:nth-child(1)').html("<select class=\" form-control\" id=\"packageName_edit\"></select>");
			// $(this).parent().parent().find('td:nth-child(3)').html("<input value = \""+quantity_edit+"\" class=\"form-control\" type=\"text\" id=\"new_price\"  onkeyup=\"validateNumber()\" placeholder=\"Quantity\">");
			// $(this).val("Done");
			// $(this).parent().parent().find('td:nth-child(6)').find('input').val('Cancel');
			// $(this).parent().parent().find('td:nth-child(6)').find('input').addClass('btn-danger').removeClass('btn-success');
			// $.post( 
				// 'database/editorder.php', 			
				// { func: "getPackages"},		 
				// function( data ){ 	
					// document.getElementById('packageName_edit').innerHTML=data;
					// document.getElementById('packageName_edit').value = pkg_edit;
		    // });
			
		// }
		// else if($(this).val() == "Done"){
			// count = count - 1;
			// var pkg = $(this).parent().parent().find('td:nth-child(1)').find('select').val();
			// var quantity = $(this).parent().parent().find('td:nth-child(3)').find('input').val();
			// var orderid = getUrlParameter("orderid");
			// var orderlineid = $(this).attr('id');
			// if(pkg == ""){
				// alert("Please Enter Package Name");
				// return;
			// }
			// if(quantity == ""){
				// alert("Please Enter Quantity");
				// return;
			// }
			// if(quantity < 0){
				// alert("Quantity cannot be negative");
				// return;
			// }
			// $(this).val("Edit");
			// $.post( 
			// 'database/editorder.php', 			
			// { func: "updateOrder" , orderid:orderid, orderlineid:orderlineid, pkg:pkg, quantity:quantity},		 
			// function( data ){ 	
				// alert(data);
				// location.reload();
		    // });
		// }
	// });
	
	//remove clicked
	$("#package_table td:nth-child(5) input").click(function() {
		if($(this).val()=="Remove"){
			var orderid = getUrlParameter("orderid");
			var orderlineid = $(this).attr('id');
			$.blockUI( {message: '<h3> <img src="assets/loading.gif"/> Please Wait </h3>'});
			$.post( 
			'database/editorder.php', 			
			{ func: "removeOrderLine" , orderid:orderid, orderlineid:orderlineid },		 
			function( data ){ 	
				location.reload();
			});
	}
		// }else if($(this).val() == "Cancel"){
			// count = count - 1;
			// $(this).parent().parent().find('td:nth-child(1)').html(pkg_edit);
			// $(this).parent().parent().find('td:nth-child(3)').html(quantity_edit);
			// $(this).parent().parent().find('td:nth-child(5)').find('input').val('Edit');
			// $(this).parent().parent().find('td:nth-child(6)').find('input').val('Remove');
			// $(this).parent().parent().find('td:nth-child(6)').find('input').addClass('btn-success').removeClass('btn-danger');
		// }

	});
});


function cancelInsertRow() {
	var table = document.getElementById("package_table");
	var row_length = document.getElementById("package_table").rows.length;
	if (row_length == 1 || row_length == 2){
		row = table.deleteRow(1);
		count = 1;
	}else{
		row = table.deleteRow(2);
		count = 2;
	}
	var button = document.getElementById("addBtn");
	button.value = "Add";
}

function validateNumber(){
	var e = document.getElementById("new_price");
	var r = /([0-9]{2})([0-9]{2})/i,
        str = e.value.replace(/[^0-9]/ig, "");

    e.value = str.slice(0, 17);
}

function sendmail(){
	var orderid = getUrlParameter("orderid");
	$.blockUI( {message: '<h3> <img src="assets/loading.gif"/> Please Wait </h3>'});
	$.post( 
		'database/editorder.php', 			
		{ func: "sendmail", orderid:orderid},		 
		function( data ){ 	
			$.unblockUI();
			alert(data);
	});
}

function insertRow() {
	var button = document.getElementById("addBtn");
	var table = document.getElementById("package_table");

	if (button.value == "Add"){
			button.value = "Done";
			 var row_length = document.getElementById("package_table").rows.length;
			 var row ;
			 var count;
			if (row_length == 1 || row_length == 2){
				row = table.insertRow(1);
				count = 1;
			}else{
				row = table.insertRow(2);
				count = 2;
			}
			
			var cell0 = row.insertCell(0);
			var cell1 = row.insertCell(1);
			var cell2 = row.insertCell(2);
			var cell3 = row.insertCell(3);
			var cell4 = row.insertCell(4);
			
			cell0.innerHTML = "<select class=\" form-control\" id=\"packageName\"><option>Loading ...</option></select>";
			//cell2.innerHTML = "<input class=\"form-control\" type=\"text\" id=\"new_q\"  onkeyup=\"validateNumber()\" placeholder=\"Quantity\">";
			cell2.innerHTML = "1";
			cell1.innerHTML = "";
			cell3.innerHTML = "";
			//cell4.setAttribute("colspan", "2");
			cell4.setAttribute("align", "center");
			cell4.innerHTML = "<input value=\"Cancel\" class=\"btn btn-danger center\" type=\"button\" id=\"cancel\" onclick=\"cancelInsertRow()\" >";
			
			var orderid = getUrlParameter("orderid");
			$.post( 
				'database/editorder.php', 			
				{ func: "getPersonalizedPackages", orderid:orderid},		 
				function( data ){ 	
					document.getElementById('packageName').innerHTML=data;
		    });

	}else if (button.value == "Done"){
			
			var pkg = $("#packageName").val();
			
			//var quantity = $("#new_q").val();
			var quantity = 1;
			var id = getUrlParameter("orderid");
			if(pkg == ""){
				alert("Please Enter Package Name");
				return;
			}
			if(quantity == ""){
				alert("Please Enter quantity");
				return;
			}
			if(quantity < 0){
				alert("Quantity cannot be negative");
			}
			$.blockUI( {message: '<h3> <img src="assets/loading.gif"/> Please Wait </h3>'});
			$.post( 
				'database/editorder.php', 			
				{ func: "addOrderLine" ,  pkg:pkg, quantity:quantity, id:id},		 
				function( data ){ 	
					//alert(data);
					location.reload();
		    });

	}	// ending else if

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