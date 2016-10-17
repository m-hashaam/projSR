var dealid = 0;
function dealClicked(dd){
	$('#changeNameModal').modal('show');
	if(dd == 0){
		dealid = getUrlParameter('username');
	}
	else{
		dealid = dd;
	}
}

function changeStage(){
	var stage = $('#dstage').val();
	$.post( 
		'database/deals.php', 			
		{ func: "changestage" ,stage:stage,dealid:dealid },		 
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