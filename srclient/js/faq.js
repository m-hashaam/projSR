var question_edit;
var answer_edit;
var count = 0;
$(document).ready(function(){
	//edit clicked
	$("#package_table td:nth-child(3) input").click(function() {
		var test = $(this).parent().parent().find('th:nth-child(1)').html();
		if(test != null){
			return;
		}
		else if($(this).val() == "Edit"){
			if(count == 1){
				alert("Please finish previous edit first");
				return;
			}
			count=count+1;
			var id = $(this).attr("id");
			question_edit = $(this).parent().parent().find('td:nth-child(1)').html();
			answer_edit = $(this).parent().parent().find('td:nth-child(2)').html();
			$(this).parent().parent().find('td:nth-child(1)').html("<input value = \""+question_edit+"\" class=\"form-control\" type=\"text\" id=\"new_question\" placeholder=\"Question\">");
			$(this).parent().parent().find('td:nth-child(2)').html("<input value = \""+answer_edit+"\" class=\"form-control\" type=\"text\" id=\"new_answer\"  placeholder=\"Answer\">");
			$(this).val("Done");
			$(this).parent().parent().find('td:nth-child(4)').find('input').val('Cancel');
			$(this).parent().parent().find('td:nth-child(4)').find('input').addClass('btn-danger').removeClass('btn-success');
			
		}
		else if($(this).val() == "Done"){
			count = count - 1;
			var id = $(this).attr("id");
			var question = $(this).parent().parent().find('td:nth-child(1)').find('input').val();
			var answer = $(this).parent().parent().find('td:nth-child(2)').find('input').val();
			if(question == ""){
				alert("Please Enter Question");
				return;
			}
			if(answer == ""){
				alert("Please Enter Answer");
				return;
			}
			$(this).val("Edit");
			$.post( 
			'database/faq.php', 			
			{ func: "updateFAQ" , id:id , question:question, answer:answer},		 
			function( data ){ 	
				location.reload();
		    });
		}
	});
	
	//remove clicked
	$("#package_table td:nth-child(4) input").click(function() {
		if($(this).val()=="Remove"){
			var id = $(this).attr("id");
			$.post( 
				'database/faq.php', 			
				{ func: "removeFAQ" , id:id },		 
				function( data ){ 	
					location.reload();
			});
		}else if($(this).val() == "Cancel"){
			count = count - 1;
			$(this).parent().parent().find('td:nth-child(1)').html(question_edit);
			$(this).parent().parent().find('td:nth-child(2)').html(answer_edit);
			$(this).parent().parent().find('td:nth-child(3)').find('input').val('Edit');
			$(this).parent().parent().find('td:nth-child(4)').find('input').val('Remove');
			$(this).parent().parent().find('td:nth-child(4)').find('input').addClass('btn-success').removeClass('btn-danger');
		}

	});
});
