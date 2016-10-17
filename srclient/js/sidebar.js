$(document).ready(function(){




$("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
	
	
	$('#menu-toggle').hover(
         function () {
			$('#menu-toggle').velocity({scale:1.5});
         }, 
         function () {
           $('#menu-toggle').velocity({scale:1});
         }
     );
	 
	 $("#menu-toggle").velocity({rotateZ:'180deg'},{duration: 700, queue: false});
	 
	 $( "#menu-toggle" ).click(function() {
		if(up == true){
			 $("#menu-toggle").velocity({rotateZ:'0deg'},{duration: 700, queue: false});
			 up=false;
		}
		else if(up == false){
			 $("#menu-toggle").velocity({rotateZ:'180deg'},{duration: 700, queue: false});
			 up=true;
		}
	});
	
	var up=true;
	
});