
      
	
$(document).ready(function(){
   $('.container-fluid').first().css("box-shadow","5px 5px 15px #888888");
    $('.container-fluid').first().css("padding-bottom","5px");
    $('.container-fluid').first().css("z-index","9999");
    $('.page-footer').first().css("position","fixed");
    $('.page-footer').first().css("bottom","0");
    $('.page-footer').first().css("left","0");
    $('.page-footer').first().css("width","100%");
    $('.ul-navigator-margin').css({"margin-bottom":"1%"});
    $('.dropdown.dropdown-user.open').first().css("z-index","99990");
    $( "#dateSelector" ).change(function() {
        var vall = $( "#dateSelector" ).val();
        location.href='rep_engagement.php?date='+vall;
        //console.log(vall);
    });
    
    
       var datee = getUrlParameter('date');
        var find = '%20';
        var re = new RegExp(find, 'g');
        
        datee = datee.replace(re, ' ');
    document.getElementById('dateSelector').value = datee;
});

function exportPNG(){
    html2canvas($(".classictable.dabba.table.table-striped"), {
            onrendered: function(canvas) {
                theCanvas = canvas;
                document.body.appendChild(canvas);

                // Convert and download as image 
                Canvas2Image.saveAsPNG(canvas); 
               console.log(canvas);
                // Clean up 
                //document.body.removeChild(canvas);
            }
        });
}

function exportModal(){
	$('#exportModal').modal('show');
}
      
function sendEmail(){
    	toastr["success"]("Email Sent");
        $('#exportModal').modal('hide');
}


