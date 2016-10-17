var pid = 0;

$(document).ready(function(){
	$('li.media').mouseover(function() {
	  $(this).find('.media-heading-sub').removeAttr('hidden');
	});
	$( "li.media" ).mouseout(function() {
		$(this).find('.media-heading-sub').attr('hidden','hidden');
	});
});

function opensidebar(){
	$('.page-quick-sidebar-wrapper').css('left','0px')
}

function closesidebar(){
	$('.page-quick-sidebar-wrapper').css('left','-320px')
}
function addnewproduct(){
    var val = $('#product_name_field_sidebar').val();
    var url = "";
    toastr["success"]("Adding Product, Please wait ...");
	$.post( 
		'database/product.php', 			
		{ func: "add" , name:val, url:url},		 
		function( data ){ 	
			toastr["success"]("Product Added.");
            location.reload();
			//$('#parentdiv0').after(function() {
			//	  return '<div id="parentdiv0" class="row sheepItTemplate" idtemplate="sheepItForm_template">div class="col-md-1 row-align"><span id="0_count" class="row-count">1</span>	</div><div class="col-md-5" style="margin-left: -20px"><input id="product0name" class="form-control" placeholder="Add Product Name" name="product[0][name]" type="text" idtemplate="sheepItForm_%23index%23_name" nametemplate="product%5B%23index%23%5D%5Bname%5D"></div><div class="col-md-5"><input id="product0url" class="form-control" placeholder="Add Product URL" name="product[0][url]" type="text" idtemplate="sheepItForm_%23index%23_url" nametemplate="product%5B%23index%23%5D%5Burl%5D"></div><div class="col-md-1" style="margin-left: -10px"><div class="row"><div class="btn btn-sm" style="margin-top: -5px"><a id="0" class="add-product" onclick="addtheproducts(this)"> <h5><b><i class="fa fa-plus"></i> Add</b></h5></a></div></div></div></div>';
			//	});
		});
}

function clonecalled(pd){
    pid = pd;
    console.log(pid);
}

function cloneproduct(){
    
    var val = $('#cloneName').val();
    var url = "";
    toastr["success"]("Cloning Product, Please wait ...");
	$.post( 
		'database/product.php', 			
		{ func: "addClone" , name:val, pid:pid},		 
		function( data ){ 	
			toastr["success"]("Product Added.");
            location.reload();
			//$('#parentdiv0').after(function() {
			//	  return '<div id="parentdiv0" class="row sheepItTemplate" idtemplate="sheepItForm_template">div class="col-md-1 row-align"><span id="0_count" class="row-count">1</span>	</div><div class="col-md-5" style="margin-left: -20px"><input id="product0name" class="form-control" placeholder="Add Product Name" name="product[0][name]" type="text" idtemplate="sheepItForm_%23index%23_name" nametemplate="product%5B%23index%23%5D%5Bname%5D"></div><div class="col-md-5"><input id="product0url" class="form-control" placeholder="Add Product URL" name="product[0][url]" type="text" idtemplate="sheepItForm_%23index%23_url" nametemplate="product%5B%23index%23%5D%5Burl%5D"></div><div class="col-md-1" style="margin-left: -10px"><div class="row"><div class="btn btn-sm" style="margin-top: -5px"><a id="0" class="add-product" onclick="addtheproducts(this)"> <h5><b><i class="fa fa-plus"></i> Add</b></h5></a></div></div></div></div>';
			//	});
		});
}

function makeitlive(){
      toastr["success"]("Sending request, Please wait ...");
	$.post( 
		'database/product.php', 			
		{ func: "makeitlive" },		 
		function( data ){ 	
		  console.log("data by makeit live is "+data);
			toastr["success"]("Request sent.");
            toastr["success"]("Your product will be reviewed in 2 working days.");
		});
}

