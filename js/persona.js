$(document).ready(function(){
// Search Within Tiles ---------------------------------------------------------------------------------------------
    $(document).on('keyup', '#personaSearch-input', function() {
       var toSearch = $('#personaSearch-input').val();
       
        $('.mypersonatile').each(function( index ) {
            
                $( this ).addClass("hide");
            
          
          //console.log( index + ": " + $( this ).text() );
        });
        if(toSearch == ""){
             $('.mypersonatile').removeClass("hide");
            return;
        }
       $('.mypersonatile').each(function( index ) {
            if($( this ).find('p').text().toLowerCase().search(toSearch.toLowerCase()) >= 0){
                $( this ).removeClass("hide");
            }
            else{
                $( this ).addClass("hide");
            }
          
          //console.log( index + ": " + $( this ).text() );
        });
    });
});


var selectedPersonas = [];

function tileSelected(id){
    console.log("id is "+id);
    index = selectedPersonas.indexOf(id);
    if(index <= -1){
        console.log("id is "+id+" and index is not -1");
        selectedPersonas.push(id);
        $('#personatick-'+id).addClass("selected");
        $('#personatick-'+id).addClass("check");
        $('#personatick-'+id).removeClass("hide");
    }
    else{
        console.log("id is "+id+" and index is -1");
        selectedPersonas.splice(index, 1);
        $('#personatick-'+id).removeClass("selected");
        $('#personatick-'+id).removeClass("check");
        $('#personatick-'+id).addClass("hide");
    }
    if(selectedPersonas.length > 0){
        $('#addPersonas').removeAttr("disabled");
        $('span.count').removeAttr("hidden");
        $('span.selected-personas').removeAttr("hidden");
        $('span.count').html(selectedPersonas.length);
    }
    
    
}

function addpersonas(){
    toastr["success"]("Adding persona(s), Please wait ...");
    if(selectedPersonas.length <= 0){
        toastr["warning"]("Please select at least one persona to add.");
    }
    var jsonString = JSON.stringify(selectedPersonas);
    $.post( 
		'database/personas.php', 			
		{ func: "add" , data:jsonString},		 
		function( data ){ 	
			toastr["success"]("Persona(s) successfully added.");
            location.reload();
		});
}

function removepersona(id){
    
    toastr["success"]("Removing persona, Please wait ...");
    $('#persona-tile-'+id).find("div.spinner").removeClass("hide");
	$.post( 
		'database/personas.php',  			
		{ func: "remove" , id:id},		 
		function( data ){ 	
			toastr["success"]("Persona removed.");
            count = $('#added_personas_count').html();
            count--;
            $('#added_personas_count').html(count);
            $('#persona-tile-'+id).css("width","60%");
            $('#persona-tile-'+id).detach().appendTo('#sectionPersonas');
            $('#persona-tile-'+id).attr("onclick", "tileSelected("+id+");");
            $('#personatick-'+id).addClass("hide");
            $('#personatick-'+id).attr("src","../assets/pertick.png");
		});
    
}