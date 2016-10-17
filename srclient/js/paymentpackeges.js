var pkg_edit;
var price_edit;
var desc_edit;
var qty_edit;
var count = 0;
$(document).ready(function(){
	//edit clicked
	$("#package_table td:nth-child(6) input").click(function() {
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
			var id = $(this).parent().parent().find('td:nth-child(1)').html();
			pkg_edit = $(this).parent().parent().find('td:nth-child(2)').html();
			price_edit = $(this).parent().parent().find('td:nth-child(3)').html();
			qty_edit = $(this).parent().parent().find('td:nth-child(4)').html();
			desc_edit = $(this).parent().parent().find('td:nth-child(5)').html();
			$(this).parent().parent().find('td:nth-child(2)').html("<input value = \""+pkg_edit+"\" class=\"form-control\" type=\"text\" id=\"new_package\" placeholder=\"Package Name\">");
			$(this).parent().parent().find('td:nth-child(3)').html("<input value = \""+price_edit+"\" class=\"form-control\" type=\"text\" id=\"new_price\"  onkeyup=\"validateNumber()\" placeholder=\"Price\">");
			$(this).parent().parent().find('td:nth-child(4)').html("<input value = \""+qty_edit+"\" class=\"form-control\" type=\"text\" id=\"new_qty\"  onkeyup=\"validateNumber2()\" placeholder=\"Quantity Per Purchase\">");
			$(this).parent().parent().find('td:nth-child(5)').html("<input value = \""+desc_edit+"\" class=\"form-control\" type=\"text\" id=\"new_desc\"  placeholder=\"Package Description\">");
			$(this).val("Done");
			$(this).parent().parent().find('td:nth-child(7)').find('input').val('Cancel');
			$(this).parent().parent().find('td:nth-child(7)').find('input').addClass('btn-danger').removeClass('btn-success');
			
		}
		else if($(this).val() == "Done"){
			count = count - 1;
			var id = $(this).parent().parent().find('td:nth-child(1)').html();
			var pkg = $(this).parent().parent().find('td:nth-child(2)').find('input').val();
			var price = $(this).parent().parent().find('td:nth-child(3)').find('input').val();
			var qty = $(this).parent().parent().find('td:nth-child(4)').find('input').val();
			var desc = $(this).parent().parent().find('td:nth-child(5)').find('input').val();
			if(pkg == ""){
				alert("Please Enter Package Name");
				return;
			}
			if(price == ""){
				alert("Please Enter Price");
				return;
			}
			if(desc == ""){
				alert("Please Enter Description");
				return;
			}
			if(qty == ""){
				alert("Please Enter Quantity");
				return;
			}
			$(this).val("Edit");
			$.blockUI( {message: '<h3> <img src="assets/loading.gif"/> Please Wait </h3>'});
			$.post( 
			'database/paymentpackage.php', 			
			{ func: "updatePackage" , id:id , pkg:pkg, price:price, desc:desc, qty:qty},		 
			function( data ){ 	
				location.reload();
		    });
		}
	});
	
	//remove clicked
	$("#package_table td:nth-child(7) input").click(function() {
		if($(this).val()=="Remove"){
			var id = $(this).parent().parent().find('td:nth-child(1)').html();
			if(id=="1"){
				alert("You cannot delete this package");
				return;
			}
			$.blockUI( {message: '<h3> <img src="assets/loading.gif"/> Please Wait </h3>'});
			$.post( 
			'database/paymentpackage.php', 			
			{ func: "removePackage" , id:id },		 
			function( data ){ 	
				location.reload();
			});
		}else if($(this).val() == "Cancel"){
			count = count - 1;
			$(this).parent().parent().find('td:nth-child(2)').html(pkg_edit);
			$(this).parent().parent().find('td:nth-child(3)').html(price_edit);
			$(this).parent().parent().find('td:nth-child(4)').html(qty_edit);
			$(this).parent().parent().find('td:nth-child(5)').html(desc_edit);
			$(this).parent().parent().find('td:nth-child(6)').find('input').val('Edit');
			$(this).parent().parent().find('td:nth-child(7)').find('input').val('Remove');
			$(this).parent().parent().find('td:nth-child(7)').find('input').addClass('btn-success').removeClass('btn-danger');
		}

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
	button.value = "Add New Package";
}

function validateNumber(){
	var e = document.getElementById("new_price");
	var r = /([0-9]{2})([0-9]{2})/i,
        str = e.value.replace(/[^0-9]/ig, "");

    e.value = str.slice(0, 17);
}

function validateNumber2(){
	var e = document.getElementById("new_qty");
	var r = /([0-9]{2})([0-9]{2})/i,
        str = e.value.replace(/[^0-9]/ig, "");

    e.value = str.slice(0, 17);
}

function insertRow() {
	var button = document.getElementById("addBtn");
	var table = document.getElementById("package_table");

	if (button.value == "Add New Package"){
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
			var cell5 = row.insertCell(5);
			
			cell0.innerHTML = "";
			cell1.innerHTML = "<input class=\"form-control\" type=\"text\" id=\"new_package\" placeholder=\"Package Name\">";
			cell2.innerHTML = "<input class=\"form-control\" type=\"text\" id=\"new_price\"  onkeyup=\"validateNumber()\" placeholder=\"Price\">";
			cell3.innerHTML = "<input class=\"form-control\" type=\"text\" id=\"new_qty\"  onkeyup=\"validateNumber2()\" placeholder=\"Quantity\">";
			cell4.innerHTML = "<input class=\"form-control\" type=\"text\" id=\"new_desc\"  placeholder=\"Package Description\">";
			cell5.setAttribute("colspan", "2");
			cell5.setAttribute("align", "center");
			cell5.innerHTML = "<input value=\"Cancel\" class=\"btn btn-danger center\" type=\"button\" id=\"cancel\" onclick=\"cancelInsertRow()\" >";
			

	}else if (button.value == "Done"){
			
			var pkg = $("#new_package").val();
			var price = $("#new_price").val();
			var desc = $("#new_desc").val();
			var qty = $("#new_qty").val();
			if(pkg == ""){
				alert("Please Enter Package Name");
				return;
			}
			if(price == ""){
				alert("Please Enter Price");
				return;
			}
			if(desc == ""){
				alert("Please Enter Description");
				return;
			}
			if(qty == ""){
				alert("Please Enter Quantity");
				return;
			}
			$.blockUI( {message: '<h3> <img src="assets/loading.gif"/> Please Wait </h3>'});
			$.post( 
				'database/paymentpackage.php', 			
				{ func: "addPackage" ,  pkg:pkg, price:price, desc:desc,qty:qty},		 
				function( data ){ 	
					location.reload();
		    });

	}	// ending else if

}