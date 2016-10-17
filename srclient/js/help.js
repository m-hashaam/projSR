

$(document).ready(function(){
	typeselected();
	
});

function typeselected(){
	var id = $('#type option:selected').text();
	 $.blockUI( {message: '<h3> <img src="assets/loading.gif"/> Please Wait </h3>'});
	 $.post( 
		'database/help.php', 			
		{ func: "get" , type:id },		 
		function( data ){ 	
			$(".froala-view").html(data);
			$.unblockUI();
	});
}

