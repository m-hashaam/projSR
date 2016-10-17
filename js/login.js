


$(document).ready(function(){
	
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

function validateNumber(e){
	var r = /([0-9]{2})([0-9]{2})/i,
        str = e.value.replace(/[^0-9]/ig, "");

    e.value = str.slice(0, 17);
}

function resetpass(){
	var val = $('#emailreset').val();
    if(val == ""){
        toastr["warning"]("Email address cannot be empty");
		return;
    }
	toastr["success"]("Checking email, Please wait ...");
    $.post( 
		'database/login.php', 			
		{ func: "reset" , email:val},		 
		function( data ){ 	
			toastr["success"](data);
            $('#resetpassModal').modal('hide');
            //alert(data);
            //location.reload();
		});
}

function forgotPassowrd(){
	$('#resetpasserror').css('visibility','collapse');
	$('#resetpassModal').modal('show');
}
