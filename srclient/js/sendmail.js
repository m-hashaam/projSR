
// upon pressing the delete button against an operator !
$(document).ready(function(){
	var mail = getUrlParameter("mail");
	if(mail!=null){
		document.getElementById("email").value=mail;
	}
	
});

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