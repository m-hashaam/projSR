$(document).ready(function(){
    document.getElementById("lhc_faq_embed_container").addEventListener("load", function(event) {
          $('#lhcfaq_iframe_embed').load(function(){
                $elem = $('#lhcfaq_iframe_embed').contents().find('input').first();
                $elem.prop('disabled', true);
                
                $.post( 
            		'database/account.php', 			
            		{ func: "getUserName"  },		 
            		function( data ){ 
            		  $elem.val(data);
            		}
                );   
            });
    }, true);
     
});

function changeHelpUsername(){
    
  setTimeout(function(){
    $('#lhc_status_container').css('bottom','23px');
    $('#online-icon').click(function() {
      setTimeout(function(){ 
                             $.post( 
                        		'database/account.php', 			
                        		{ func: "getUserName"  },		 
                        		function( data ){ 
                        		  $('#lhc_iframe').contents().find("input[name='Email']").first().val(data);
                                  $('#lhc_iframe').contents().find("input[name='Username']").first().val(data);
                                  $('#lhc_iframe').contents().find("input[name='Username']").first().attr("value",data);
                                  $('#lhc_iframe').contents().find("input[name='Email']").first().attr("value",data);
                        		}
                            );
                             $('#lhc_container').css('bottom','23px');   
                             $('#lhc_iframe').contents().find("input[name='Email']").first().prop('readonly', true);
                             $('#lhc_iframe').contents().find("input[name='Username']").first().prop('readonly', true);
                             $('#lhc_header').append("<a href='faq.php' style='float:left; margin-left:38%; margin-top:1%;'>FAQ</a>"); }, 1000);
    }); }, 1500);
  setTimeout(function(){
    
    $('#offline-icon').click(function() {
      setTimeout(function(){ 
                              $.post( 
                        		'database/account.php', 			
                        		{ func: "getUserName"  },		 
                        		function( data ){ 
                        		  $('#lhc_iframe').contents().find("input[name='Email']").first().val(data);
                                  $('#lhc_iframe').contents().find("input[name='Username']").first().val(data);
                                  $('#lhc_iframe').contents().find("input[name='Username']").first().attr("value",data);
                                  $('#lhc_iframe').contents().find("input[name='Email']").first().attr("value",data);
                        		}
                            );  
                             $('#lhc_container').css('bottom','23px'); 
                             $('#lhc_iframe').contents().find("input[name='Email']").first().prop('readonly', true);
                             $('#lhc_iframe').contents().find("input[name='Username']").first().prop('readonly', true);
                             $('#lhc_header').append("<a href='faq.php' style='float:left; margin-left:38%; margin-top:1%;'>FAQ</a>"); }, 1000);
    }); }, 1500);
}