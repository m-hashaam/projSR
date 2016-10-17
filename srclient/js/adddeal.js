var countStaff = 1;
var countProduct = 1;
var StaffOptions = "";
var ProductOptions = "";
function addOtherStaff(){
	countStaff++;
	if(countStaff >= 10){
		alert("You cannot assign more staff members to this deal");
		return;
	}
	$('#otherStaffMainDiv').append('<div id="otherstaffrow'+countStaff+'" class="row">'+
		'<div class="col-xs-6 col-sm-6 col-md-6" style="margin-bottom: 10px;">'+
		'	<div class="form-group">'+
		'	<label class="col-sm-2 control-label">Other Staff</label>'+
		'		<div class="col-sm-10">'+
		'		<select type="text" name="ostaff'+countStaff+'" class="form-control select2 input-sm">'+StaffOptions+
		'		</select>'+
		'	</div>'+
		'	</div>'+
		'</div>'+
		'<div id="otherstaffdiv'+countStaff+'" class="col-xs-6 col-sm-6 col-md-6" style="margin-bottom: 10px;">'+
		'	<img onclick="addOtherStaff()" style="cursor: pointer;" src="assets/plus.png" height="30" width="30">'+
		'	</div>'+
		'</div>');
	
	var previd = countStaff-1;
	var previd = "#otherstaffdiv"+previd;
	$(previd).html('<img onclick="removeStaff('+(countStaff-1)+')" style="cursor: pointer;" src="assets/cross.png" height="30" width="30">');
}

function removeStaff(id){
	$('#otherstaffrow'+id).remove();
}

function removeProduct(id){
	$('#productsrow'+id).remove();
	compute();
}

function validateNumber(e){
	//var e = document.getElementById("new_price");
	var str = e.value.replace(/[^\d.]/g, '');

    e.value = str.slice(0, 17);
	
	compute();
}

function validateNumber2(e){
	//var e = document.getElementById("new_price");
	var str = e.value.replace(/[^\d.]/g, '');

    var tval = str.slice(0, 17);
	if(tval > 100){
		tval = 100;
	}
	e.value = tval;
	
	compute();
}

function addOtherProduct(){
	countProduct++;
	if(countProduct >= 6){
		alert("You cannot add more products");
		return;
	}
	$('#productsMainDiv').append('<div id="productsrow'+countProduct+'" class="row">'+
		'	<div class="col-xs-6 col-sm-6 col-md-6" style="margin-bottom: 10px;">'+
		'		<div class="form-group">'+
		'		<label class="col-sm-2 control-label">Product</label>'+
		'			<div class="col-sm-10">'+
		'				<select type="text" name="product'+countProduct+'" class="form-control select2 input-sm">'+ProductOptions+
		'				</select>'+
		'			</div>'+
		'		</div>'+
		'	</div>'+
		'	<div class="col-xs-2 col-sm-2 col-md-2">'+
		'		<input onkeyup="validateNumber(this)" type="text" name="pprice'+countProduct+'" class="form-control input-sm" placeholder="Price" required>'+
		'	</div>'+
		'	<div class="col-xs-2 col-sm-2 col-md-2">'+
		'		<input onkeyup="validateNumber2(this)" type="text" name="pprob'+countProduct+'" class="form-control input-sm" placeholder="Probability (%)" required>'+
		'	</div>'+
		'	<div id="productsdiv'+countProduct+'" class="col-xs-2 col-sm-2 col-md-2">'+
		'		<img onclick="addOtherProduct()" style="cursor: pointer;" src="assets/plus.png" height="30" width="30">'+
		'	</div>'+
		'</div>');
	
	var previd = countProduct-1;
	var previd = "#productsdiv"+previd;
	$(previd).html('<img onclick="removeProduct('+(countProduct-1)+')" style="cursor: pointer;" src="assets/cross.png" height="30" width="30">');
	compute();
}

function compute(){
	var size = 0;
	var prob = 0;
	var forcast = 0;
	var counts = 0;
	for(var i = 0 ; i<8 ; i++){
		if($('input[name="pprice'+i+'"]').val() != null){
			counts++;
			var price = $('input[name="pprice'+i+'"]').val();
			price = parseFloat(price);
			size += price;
		}
		if($('input[name="pprob'+i+'"]').val() != null){
			var pro = $('input[name="pprob'+i+'"]').val();
			pro = parseFloat(pro);
			prob += pro;
		}
	}
	prob = prob / counts;
	var stage = "";
	if(isNaN(size)){
		size = "";
	}
	if(isNaN(prob)){
		prob = "";
	}
	else{
		if(prob == 0){
			stage = "Not Pursue";
		}
		else if(prob == 100){
			stage = "Client";
		}
		else if(prob >= 0.01 && prob <= 25){
			stage = "Lead";
		}
		else if(prob >=25.01 && prob <= 99.99){
			stage = "Prospect";
		}
		else if(prob > 100){
			prob = 100;
			stage = "Client";
		}
	}
	if(isNaN(forcast)){
		forcast = "";
	}
	$('input[name="estsize"]').val(size);
	$('input[name="prob"]').val(prob);
	forcast = size * (prob/100);
	$('input[name="wforcast"]').val(forcast);
	$('input[name="stage"]').val(stage);
	
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

var tempp = getUrlParameter('username');
if(tempp != null){
	$.post( 
		'database/deals.php', 			
		{ func: "getProductCount",did:tempp },		 
		function( data ){ 	
			countProduct = parseInt(data);
	});
	$.post( 
		'database/deals.php', 			
		{ func: "getOStaffCount",did:tempp },		 
		function( data ){ 	
			countStaff = parseInt(data);
	});
}
	
$.post( 
	'database/deals.php', 			
	{ func: "getProducts" },		 
	function( data ){ 	
		ProductOptions = data;
});

$.post( 
	'database/deals.php', 			
	{ func: "getStaff" },		 
	function( data ){ 	
		StaffOptions = data;
});

 $('#datepicker').datepicker({
  autoclose: true
});

 $('#datepicker2').datepicker({
  autoclose: true
});

 $('#datepicker3').datepicker({
  autoclose: true
});