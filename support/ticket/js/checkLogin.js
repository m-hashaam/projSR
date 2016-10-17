$( document ).ready(function() {
    if(location.pathname == "/support/ticket/login.php"){
    	$.post( 
    		'http://portal.sweetreferrals.com/support/ticket/testing.php', 			
    		{ func: "getUserData"  },		 
    		function( data ){ 
    		  console.log(data);
              var obj = JSON.parse(data);
              
              $('#username').val(obj[0]);
              $('#passwd').val(obj[1]);
              $('input[class="btn"][type="submit"][value="Sign In"]').click();
    		
                //location.href='index.php';
    		});   
    }
});