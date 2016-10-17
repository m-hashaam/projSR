//Great! We\'ll review your company information and make sure it\'s not missing anything for making it active on platform.

var to=false;

$(document).ready(function(){
    
    var p = $("#uploadPreview");

  // prepare instant preview
  $("#inputImage").change(function(){
    // fadeOut or hide preview
    p.fadeOut();

    // prepare HTML5 FileReader
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("inputImage").files[0]);

    oFReader.onload = function (oFREvent) {
         p.attr('src', oFREvent.target.result).fadeIn();
    };
  });

  // implement imgAreaSelect plug in (http://odyniec.net/projects/imgareaselect/)
  $('img#uploadPreview').imgAreaSelect({
    // set crop ratio (optional)
    //aspectRatio: '1:1',
    onSelectEnd: setInfo
  });
  
  
	

  
    
    
});

function saveAll(){
    var video = $('#cVideo').val();
    var awards = $('#cAwards').val();
    var mission = $('#cMission').val();
    var zip = $('#cZip').val();
    var state = $('#cState').val();
    var city = $('#cCity').val();
    var home = $('#cHome').val();
    var street = $('#cStreet').val();
    var tw = $('#cTw').val();
    var fb = $('#cFb').val();
    var li = $('#cLi').val();
    var web = $('#cWeb').val();
    
     toastr["success"]("Adding Company Information, Please wait ...");
	$.post( 
		'database/company.php', 			
		{ func: "edit" , video:video, awards:awards , mission:mission, zip:zip,state:state,
                         city:city, home:home , street:street, tw:tw,fb:fb, li:li, web:web},		 
		function( data ){ 
		  console.log(data);
			toastr["success"]("Company Information Added.");
            //location.href='index.php';
		});
}

function setInfo(i, e) {
  $('#x').val(e.x1);
  $('#y').val(e.y1);
  $('#w').val(e.width);
  $('#h').val(e.height);
}

function saveAll2(){
    var video = $('#cVideo').val();
    var awards = $('#cAwards').val();
    var mission = $('#cMission').val();
    var zip = $('#cZip').val();
    var state = $('#cState').val();
    var city = $('#cCity').val();
    var home = $('#cHome').val();
    var street = $('#cStreet').val();
    var tw = $('#cTw').val();
    var fb = $('#cFb').val();
    var li = $('#cLi').val();
    var web = $('#cWeb').val();
    
     toastr["success"]("Adding Company Information, Please wait ...");
	$.post( 
		'database/company.php', 			
		{ func: "edit" , video:video, awards:awards , mission:mission, zip:zip,state:state,
                         city:city, home:home , street:street, tw:tw,fb:fb, li:li, web:web},		 
		function( data ){ 
		  console.log(data);
			toastr["success"]("Company Information Added.");
            $("a[href='http://portal.sweetreferrals.com/company.php#details']").click();
		});
}

function saveAll3(){
    var video = $('#cVideo').val();
    var awards = $('#cAwards').val();
    var mission = $('#cMission').val();
    var zip = $('#cZip').val();
    var state = $('#cState').val();
    var city = $('#cCity').val();
    var home = $('#cHome').val();
    var street = $('#cStreet').val();
    var tw = $('#cTw').val();
    var fb = $('#cFb').val();
    var li = $('#cLi').val();
    var web = $('#cWeb').val();
    
     toastr["success"]("Adding Company Information, Please wait ...");
	$.post( 
		'database/company.php', 			
		{ func: "edit" , video:video, awards:awards , mission:mission, zip:zip,state:state,
                         city:city, home:home , street:street, tw:tw,fb:fb, li:li, web:web},		 
		function( data ){ 
		  console.log(data);
			toastr["success"]("Company Information Added.");
            $("a[href='http://portal.sweetreferrals.com/company.php#media']").click();
		});
}

function saveAllAll(){
    var video = $('#cVideo').val();
    var awards = $('#cAwards').val();
    var mission = $('#cMission').val();
    var zip = $('#cZip').val();
    var state = $('#cState').val();
    var city = $('#cCity').val();
    var home = $('#cHome').val();
    var street = $('#cStreet').val();
    var tw = $('#cTw').val();
    var fb = $('#cFb').val();
    var li = $('#cLi').val();
    var web = $('#cWeb').val();
    
     toastr["success"]("Adding Company Information, Please wait ...");
	$.post( 
		'database/company.php', 			
		{ func: "edit" , video:video, awards:awards , mission:mission, zip:zip,state:state,
                         city:city, home:home , street:street, tw:tw,fb:fb, li:li, web:web},		 
		function( data ){ 
		  toastr["success"]("Company Information Added.");
          $('#submitid').click();
		});
}