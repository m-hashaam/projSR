
// upon pressing the delete button against an operator !
$(document).ready(function(){
	
	$('input[class=flt]').addClass('form-control');
	
	var first = getUrlParameter("first");
	if(first != null){
		first = replaceAll("%20", " ",first);
		document.getElementById("flt1_appusers_table").value=first;
		 var e = jQuery.Event("keypress");
		 e.which = 13; //choose the one you want
		 e.keyCode = 13;
		 $("#flt1_appusers_table").trigger(e);
	}
});

function deacUser(e){
	$id = $(e).attr('id');
	$.blockUI( {message: '<h3> <img src="assets/loading.gif"/> Please Wait </h3>'});
	$.post( 
		'database/manageappusers.php', 			
		{ func: "block" , id:$id },		 
		function( data ){ 	
			location.reload();
	});
}

function actiUser(e){
	$id = $(e).attr('id');
	$.blockUI( {message: '<h3> <img src="assets/loading.gif"/> Please Wait </h3>'});
	$.post( 
		'database/manageappusers.php', 			
		{ func: "unblock" , id:$id },		 
		function( data ){ 	
			location.reload();
	});
}

function getUrlParameter(sParam)
{
	var sPageURL = window.location.search.substring(1);
	var sURLVariables = sPageURL.split('&');
	for (var i = 0; i < sURLVariables.length; i++)
		{
			var sParameterName = sURLVariables[i].split('=');
			if (sParameterName[0] == sParam)
			{
				return sParameterName[1];
			}
		}
}

function replaceAll(find, replace, str) {
  return str.replace(new RegExp(find, 'g'), replace);
}