

var count = 0;
$(document).ready(function(){
    //alert("i was here");
    $('.content.rounded-4').css('width','90%');
    $('.content.rounded-4').css('height','90%');
    $('.content.rounded-4').css('margin-top','10px');
    $('.content.rounded-4').css('overflow-y','scroll');
    $('body').css('width','100%');
    $('body').css('height','100%');
    $('body').css('top','0');
    $('body').css('bottom','0');
    $('body').css('left','0');
    $('body').css('right','0');
    $('body').css('position','absolute');
	
});

function gotostep2(){
	location.href='index.php?step=2';
}

function gotostep3(){
	location.href='index.php?step=3';
}

function gotostep4(){
	location.href='index.php?step=4';
}

function addtheproducts(event){
	var id = event.id;
	console.log(id);
	var url = "#product"+id+"url";
	var name = "#product"+id+"name";
	name = $(name).val();
	url = $(url).val();
	if(name == ""){
		toastr["error"]("Product name is required");
		return;
	}
	if(url == ""){
		toastr["error"]("Product URL is required");
		return;
	}
	toastr["success"]("Adding Product, Please wait ...");
	$.post( 
		'database/product.php', 			
		{ func: "add" , name:name, url:url},		 
		function( data ){ 	
			toastr["success"]("Product Added.");
			//alert(data);
            //console.log(data);
            $('#step3continue').removeAttr('disabled');
			$('#step3continue').click(gotostep4);
			gotostep4();
			//$('#parentdiv0').after(function() {
			//	  return '<div id="parentdiv0" class="row sheepItTemplate" idtemplate="sheepItForm_template">div class="col-md-1 row-align"><span id="0_count" class="row-count">1</span>	</div><div class="col-md-5" style="margin-left: -20px"><input id="product0name" class="form-control" placeholder="Add Product Name" name="product[0][name]" type="text" idtemplate="sheepItForm_%23index%23_name" nametemplate="product%5B%23index%23%5D%5Bname%5D"></div><div class="col-md-5"><input id="product0url" class="form-control" placeholder="Add Product URL" name="product[0][url]" type="text" idtemplate="sheepItForm_%23index%23_url" nametemplate="product%5B%23index%23%5D%5Burl%5D"></div><div class="col-md-1" style="margin-left: -10px"><div class="row"><div class="btn btn-sm" style="margin-top: -5px"><a id="0" class="add-product" onclick="addtheproducts(this)"> <h5><b><i class="fa fa-plus"></i> Add</b></h5></a></div></div></div></div>';
			//	});
		});
}

