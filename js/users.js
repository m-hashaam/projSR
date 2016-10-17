function saveChanges(){
    var fname = $('#fname').val();  
    var lname = $('#lname').val(); 
    var mobile = $('#mobile').val(); 
    var title = $('#title').val();
    var email = $('#email').val();
    var newpass = $('#newpassword').val();
    var conpass = $('#newconpassword').val();
    var type = $('#user_type').val();
    
    if(conpass == ""){
        toastr["error"]("Invalid confirm password.");
        return;
    }
    if(newpass == ""){
        toastr["error"]("Invalid new password.");
        return;
    }
    if(newpass != conpass){
        toastr["error"]("Passwords do not match");
        return;
    }
    if(newpass.length < 6){
        toastr["error"]("Password must be atleast 6 characters.");
        return;   
    }
    if(newpass.match(/[a-z]/) == null){
        toastr["error"]("Password must contain a lower case letter.");
        return;  
    }
    if(newpass.match(/[A-Z]/) == null){
        toastr["error"]("Password must contain an upper case letter.");
        return;  
    }
    if(newpass.match(/[\'^£$%&*()}{@#~!?><>,|=_+¬-]/) == null){
        toastr["error"]("Password must contain a special character.");
        return;  
    }
    if(newpass.match(/[0-9]/) == null){
        toastr["error"]("Password must contain a special character.");
        return;  
    }
    
    if(fname == ""){
        toastr["error"]("First Name cannot be empty");
        return;
    }
    if(lname == ""){
        toastr["error"]("Last Name cannot be empty");
        return;
    }
    if(email == ""){
        toastr["error"]("Email address cannot be empty");
        return;
    }
    	
    toastr["success"]("Adding User, Please wait ...");
	$.post( 
		'database/users.php', 			
		{ func: "add" , email:email, title:title , mobile:mobile, lname:lname,fname:fname,newpass:newpass,type:type },		 
		function( data ){ 
		  console.log(data);
			toastr["success"]("User Added.");
            location.reload();
		});
       
}

function deleteuser(userid){
    if(confirm("Are you sure you want to remove user")){
        toastr["success"]("Removing User, Please wait ...");
    	$.post( 
    		'database/users.php', 			
    		{ func: "remove" , userid,userid },		 
    		function( data ){ 
    		  console.log(data);
    			if(data == "success"){
    			     toastr["success"]("User Removed.");
                    $('table#firstTable tr#tr'+userid).remove();
    			}
                else{
                    toastr["error"](data);
                }
    		});
    }
}

function edituser(userid){
    location.href='useredit.php?userid='+userid;
}

