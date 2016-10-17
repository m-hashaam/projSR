$(document).ready(function(){
    
});




$("#sidebar-button").on("on","click",(function(e) {
        e.preventDefault();
        $("#rightsidebarwrapper").toggleClass("toggled");
}));

function sidebar(){
	$("#rightsidebarwrapper").toggleClass("toggled");
}
