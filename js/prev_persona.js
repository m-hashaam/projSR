$(document).ready(function(){
// Search Within Tiles ---------------------------------------------------------------------------------------------
    $(document).on('keyup', '#personaSearch-input', function() {
        var personaSearchStatus = $('#personaSearch-status');
        var matches = '';
        $('#empty-suggested-persona').hide();
        $('#empty-demographic-persona').hide();
        $('#empty-product-persona').hide();
    	$('#no-suggested-persona').hide();
        $('#no-searched-result').hide();
        $('#request_add_persona_popup').addClass('hide');
        $('.suggested-personas').find('.filtered').removeClass('filtered');
        $('.demographic-personas').find('.filtered').removeClass('filtered');
        $('.category-personas').find('.filtered').removeClass('filtered');

        countPersonas = 0;

        var valThis = $(this).val().toLowerCase();
        if (valThis == "") {
            personaSearchStatus.hide();
            $('#all').slideUp("slow");
            $('#tab_add_personas .tiles > .tile').show();
            suggestedPersonaCount.text($('.suggested-personas').find('.tile').length);
            demographicPersonaCount.text($('.demographic-personas').find('.tile').length);
            productPersonaCount.text($('.category-personas').find('.tile').length);
            $('a[href="#productPersonaTab"]').click();
            checkPersonaStatus();
        } else {

            $('#all').slideDown("slow");

            personaSearchStatus.show();
            $('#tab_add_personas .tiles > .tile').each(function() {
                var text = $(this).text().toLowerCase();
                if (text.indexOf(valThis) >= 0) {
                    $(this).show();
                    $(this).addClass('filtered');
                    if ($(this).hasClass('suggested') && !($(this).hasClass('searchedResults'))) {
                        countSuggested += 1;
                    } else if ($(this).hasClass('demographic') && !($(this).hasClass('searchedResults'))) {
                        countDemographic += 1;
                    } else if ($(this).hasClass('product') && !($(this).hasClass('searchedResults'))) {
                        countProduct += 1;
                    }
                    countPersonas = countSuggested + countDemographic + countProduct;
                    
                    matches = countPersonas + ' matches found.'

                } else {
                    matches = countPersonas + ' matches found.';
                    $(this).hide();
                }
                if (countPersonas == 1)
                    matches = countPersonas + ' match found.';
                else
                    matches = countPersonas + ' matches found.';
            });

            suggestedPersonaCount.text(countSuggested/2);
            demographicPersonaCount.text(countDemographic/2);
            productPersonaCount.text(countProduct/2);
            searchedPersonaCount.text(countPersonas);
            personaSearchStatus.text(matches);

            if (countSuggested == 0) {
                $('#request_add_persona_popup').addClass('hide');
                $('#no-suggested-more-persona').hide();
    			$('#no-suggested-persona').hide();
                $('#empty-suggested-persona').show();
            }

            if (countDemographic == 0) {
                $('#request_add_persona_popup').addClass('hide');
                $('#empty-demographic-persona').show();
                $('#no-demographic-persona').hide();
            }

            if (countProduct == 0){
                $('#request_add_persona_popup').addClass('hide');
                $('#empty-product-persona').show();
                $('#no-product-persona').hide();
            }

            if (countSuggested == 0 && countDemographic == 0 && countProduct == 0) {
                $('#request_add_persona_popup').removeClass('hide');
                $('#requested').trigger('click');
                $('#no-searched-result').show();
            }

            if (countSuggested > 0 || countDemographic > 0 || countProduct > 0)
                $('#all').trigger('click');

            countSuggested = 0;
            countDemographic = 0;
            countProduct = 0;
        }
    });
});


var selectedPersonas = [];

function tileSelected(id){
    console.log("id is "+id);
    index = selectedPersonas.indexOf(id);
    if(index <= -1){
        console.log("id is "+id+" and index is not -1");
        selectedPersonas.push(id);
        $('#persona-tile-'+id).addClass("selected");
        $('#persona-tile-'+id).find(".cross-tiles").addClass("check");
        $('#persona-tile-'+id).find(".cross-tiles").removeClass("hide");
    }
    else{
        console.log("id is "+id+" and index is -1");
        selectedPersonas.splice(index, 1);
        $('#persona-tile-'+id).removeClass("selected");
        $('#persona-tile-'+id).find(".cross-tiles").removeClass("check");
        $('#persona-tile-'+id).find(".cross-tiles").addClass("hide");
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
            $('#persona-tile-'+id).detach().appendTo('#sectionPersonas');
            $('#persona-tile-'+id).attr("onclick", "tileSelected("+id+");");
            $('#persona-tile-'+id).find(".cross-tiles").removeClass("remove");
		});
    
}