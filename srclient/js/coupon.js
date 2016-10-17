var code_edit;
var disc_edit;
var exp_edit;
var count = 0;
$(document).ready(function(){
	
	$('#date').datepicker();
	
	//edit clicked
	$("#package_table td:nth-child(5) input").click(function() {
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
			code_edit = $(this).parent().parent().find('td:nth-child(2)').html();
			disc_edit = $(this).parent().parent().find('td:nth-child(3)').html();
			exp_edit = $(this).parent().parent().find('td:nth-child(4)').html();
			$(this).parent().parent().find('td:nth-child(2)').html("<input value = \""+code_edit+"\" class=\"form-control\" type=\"text\" id=\"new_package\" placeholder=\"Coupon Code\">");
			$(this).parent().parent().find('td:nth-child(3)').html("<input value = \""+disc_edit+"\" class=\"form-control\" type=\"text\" id=\"new_price\"  onkeyup=\"validateNumber()\" placeholder=\"Discount\">");
			$(this).parent().parent().find('td:nth-child(4)').html("<div class=\"form-group\"><div class=\"input-append date input-group\" data-date=\"2012-18-10\" data-date-format=\"yyyy-mm-dd\"><input class=\"form-control\" name=\"date\" id=\"date\" value = \""+exp_edit+"\" onchange=\"dateChanged()\" type=\"text\" placeholder=\"Expiry Date\"/></div>");
			$(this).val("Done");
			$(this).parent().parent().find('td:nth-child(6)').find('input').val('Cancel');
			$(this).parent().parent().find('td:nth-child(6)').find('input').addClass('btn-danger').removeClass('btn-success');
			$('#date').datepicker();
		}
		else if($(this).val() == "Done"){
			count = count - 1;
			var id = $(this).parent().parent().find('td:nth-child(1)').html();
			var code = $(this).parent().parent().find('td:nth-child(2)').find('input').val();
			var disc = $(this).parent().parent().find('td:nth-child(3)').find('input').val();
			var exp = $(this).parent().parent().find('td:nth-child(4)').find('input').val();
			if(code == ""){
				alert("Please Enter Coupon Code");
				return;
			}
			if(disc == ""){
				alert("Please Enter Coupon Discount");
				return;
			}
			if(!isDate(exp)){
				alert("Invalid Date");
				return;
			}
			
			$(this).val("Edit");
			$.blockUI( {message: '<h3> <img src="assets/loading.gif"/> Please Wait </h3>'});
			$.post( 
			'database/coupon.php', 			
			{ func: "updateCoupon" , id:id , code:code, disc:disc, exp:exp},		 
			function( data ){ 	
				//alert(data);
				location.reload();
		    });
		}
	});
	
	
	//remove clicked
	$("#package_table td:nth-child(6) input").click(function() {
		if($(this).val()=="Remove"){
			var id = $(this).parent().parent().find('td:nth-child(1)').html();
			$.blockUI( {message: '<h3> <img src="assets/loading.gif"/> Please Wait </h3>'});
			$.post( 
			'database/coupon.php', 			
			{ func: "removeCoupon" , id:id },		 
			function( data ){ 	
				location.reload();
			});
		}else if($(this).val() == "Cancel"){
			count = count - 1;
			$(this).parent().parent().find('td:nth-child(2)').html(code_edit);
			$(this).parent().parent().find('td:nth-child(3)').html(disc_edit);
			$(this).parent().parent().find('td:nth-child(4)').html(exp_edit);
			$(this).parent().parent().find('td:nth-child(5)').find('input').val('Edit');
			$(this).parent().parent().find('td:nth-child(6)').find('input').val('Remove');
			$(this).parent().parent().find('td:nth-child(6)').find('input').addClass('btn-success').removeClass('btn-danger');
		}

	});
});


function isDate(str) {    
  var parms = str.split(/[\/]/);
  var yyyy = parseInt(parms[2],10);
  var mm   = parseInt(parms[0],10);
  var dd   = parseInt(parms[1],10);
  var date = new Date(yyyy,mm-1,dd,0,0,0,0);
  return mm === (date.getMonth()+1) && 
         dd === date.getDate() && 
       yyyy === date.getFullYear();
}

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
	button.value = "Add New Coupon";
}

function validateNumber(){
	var e = document.getElementById("new_price");
	var r = /([0-9]{2})([0-9]{2})/i,
        str = e.value.replace(/[^0-9]/ig, "");

    e.value = str.slice(0, 17);
}

function insertRow() {
	var button = document.getElementById("addBtn");
	var table = document.getElementById("package_table");

	if (button.value == "Add New Coupon"){
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
			
			cell0.innerHTML = "";
			cell1.innerHTML = "<input class=\"form-control\" type=\"text\" id=\"new_package\" placeholder=\"Coupon Code\">";
			cell2.innerHTML = "<input class=\"form-control\" type=\"text\" id=\"new_price\"  onkeyup=\"validateNumber()\" placeholder=\"Discount\">";
			cell3.innerHTML = "<div class=\"form-group\"><div class=\"input-append date input-group\" data-date=\"2012-18-10\" data-date-format=\"yyyy-mm-dd\"><input class=\"form-control\" name=\"date\" id=\"date\" type=\"text\" placeholder=\"Expiry Date\"/></div>";
			cell4.setAttribute("colspan", "2");
			cell4.setAttribute("align", "center");
			cell4.innerHTML = "<input value=\"Cancel\" class=\"btn btn-danger center\" type=\"button\" id=\"cancel\" onclick=\"cancelInsertRow()\" >";
			$('#date').datepicker();

	}else if (button.value == "Done"){
			
			var code = $("#new_package").val();
			var disc = $("#new_price").val();
			var exp = $("#date").val();
			if(code == ""){
				alert("Please Enter Coupon Code");
				return;
			}
			if(disc == ""){
				alert("Please Enter Coupon Discount");
				return;
			}
			if(!isDate(exp)){
				alert("Invalid Date");
				return;
			}
			$.blockUI( {message: '<h3> <img src="assets/loading.gif"/> Please Wait </h3>'});
			$.post( 
				'database/coupon.php', 			
				{ func: "addCoupon" ,  code:code, disc:disc, exp:exp},		 
				function( data ){ 	
					location.reload();
		    });

	}	// ending else if

}