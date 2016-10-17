
  $( function() {
    $.widget( "custom.iconselectmenu", $.ui.selectmenu, {
      _renderItem: function( ul, item ) {
        var li = $( "<li onclick='productSelected();'>" ),
          wrapper = $( "<div>", { text: item.label } );
 
        if ( item.disabled ) {
          li.addClass( "ui-state-disabled" );
        }
 
        $( "<span>", {
          style: item.element.attr( "data-style" ),
          "class": "ui-icon " + item.element.attr( "data-class" )
        })
          .appendTo( wrapper );
		  
		$( "<span>", {
          "class":  item.element.attr( "data-second-class" )
        })
          .appendTo( wrapper );
 
        return li.append( wrapper ).appendTo( ul );
      }
    });
 
    $( "#topSelectProduct" )
      .iconselectmenu()
      .iconselectmenu( "menuWidget")
        .addClass( "ui-menu-icons avatar" );
  } );
  
function productSelected(){
    var path = window.location.pathname;
    var page = path.split("/").pop();
    setTimeout(function(){ location.href="changeproduct.php?id="+$('#topSelectProduct').val()+"&page="+page; }, 200);
}

function openNotification(id){
     $.post( 
    		'database/notifications.php', 			
    		{ func: "read" ,id:id },		 
    		function( data ){ 
    		  location.href=data;
    		}
        );   
}
                        