function removeAdmin(id){
	if(confirm("Are you sure you want to remove this user")){
		//$.blockUI( {message: '<h3> <img src="assets/loading.gif"/> Please Wait </h3>'});
		$.post( 
			'database/adminuser.php', 			
			{ func: "removeAdmin" , id:id },		 
			function( data ){ 	
				//alert(data);
				location.reload();
		});
	}
}
