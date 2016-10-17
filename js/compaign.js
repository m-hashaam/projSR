$(document).ready(function(){
    
    
      setTimeout(function(){ 
        $('.bootstrap-tagsinput').addClass('form-control');
        $('.bootstrap-tagsinput').addClass('input-lg');
        $('.form-group').css('position','relative');
        $('.nameDiv').css('width','90%');
    }, 300);
    
   var citynames = new Bloodhound({
      datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      prefetch: {
        url: 'database/citynames.php',
        filter: function(list) {
          return $.map(list, function(cityname) {
            return { name: cityname }; });
        }
      }
    });
    citynames.initialize();
    
    $('#cCity').tagsinput({
      typeaheadjs: {
        name: 'citynames',
        displayKey: 'name',
        valueKey: 'name',
        source: citynames.ttAdapter()
      }
    }); 
    
});

function validateNumber(){
	var e = document.getElementById("cQty");
	var r = /([0-9]{2})([0-9]{2})/i,
        str = e.value.replace(/[^0-9]/ig, "");

    e.value = str.slice(0, 17);
}


function saveandnext(){
    var quantity = $('#cQty').val();  
    var storage = $('#cStore').val(); 
    var fulfilment = $('#cFull').val(); 
    var kpi = $('#cKPI').val();
    var promo = $('#cPro').val();
     var city = $('#cCity').val();  
    	
    toastr["success"]("Adding Compaign Information, Please wait ...");
	$.post( 
		'database/compaign.php', 			
		{ func: "edit" , quantity:quantity, storage:storage , fulfilment:fulfilment, kpi:kpi,promo:promo, city:city },		 
		function( data ){ 
		  console.log(data);
			toastr["success"]("Compaign Information Added.");
            $("a[href='#tab_images']").click();
		});
    
}

function subimtprofile(){
    var quantity = $('#cQty').val();  
    var storage = $('#cStore').val(); 
    var fulfilment = $('#cFull').val(); 
    var kpi = $('#cKPI').val();
    var promo = $('#cPro').val();
     var city = $('#cCity').val();  
    	
    toastr["success"]("Adding Compaign Information, Please wait ...");
	$.post( 
		'database/compaign.php', 			
		{ func: "done" , quantity:quantity, storage:storage , fulfilment:fulfilment, kpi:kpi,promo:promo, city:city },		 
		function( data ){ 
		  console.log(data);
			toastr["success"]("Compaign Information Added.");
            location.href='index.php';
		});
       
}