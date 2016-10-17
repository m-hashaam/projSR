

$(document).ready(function(){
	$("#suggestion_table td:nth-child(5) input").click(function() {
		
		var id = $(this).parent().parent().find('td:nth-child(1)').html();
		//alert(id);
		$.blockUI( {message: '<h3> <img src="assets/loading.gif"/> Please Wait </h3>'});
		$.post( 
		'database/suggestion.php', 						
		{ func: "changeSuggestionRead"  ,id:id},
		function( data ){ 		
			//alert(data);
			location.reload();
		});
		
	});	
	
});