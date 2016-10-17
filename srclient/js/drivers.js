$(document).ready(function(){
	//remove clicked
	$("#adminuser_table td:nth-child(3) input").click(function() {
		if($(this).val()=="Remove"){
			var username = $(this).parent().parent().find('td:nth-child(2)').find('a').html();
			$.blockUI( {message: '<h3> <img src="assets/loading.gif"/> Please Wait </h3>'});
			$.post( 
				'database/drivers.php', 			
				{ func: "removeDriver" , username:username },		 
				function( data ){ 	
					//alert(data);
					location.reload();
			});
		}
	});
});
