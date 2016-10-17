function saveChanges(){
    var fname = $('#fname').val();  
    var lname = $('#lname').val(); 
    var mobile = $('#mobile').val(); 
    var title = $('#title').val();
    var email = $('#email').val();
    
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
    	
    toastr["success"]("Adding Information, Please wait ...");
	$.post( 
		'database/account.php', 			
		{ func: "edit" , email:email, title:title , mobile:mobile, lname:lname,fname:fname },		 
		function( data ){ 
		  console.log(data);
			toastr["success"]("Account Information Added.");
            //location.href='index.php';
		});
       
}


function changePassword(){
    var cpass = $('#current_password').val();  
    var conpass = $('#confirmPassword').val(); 
    var newpass = $('#newPassword').val(); 
    
    if(cpass == ""){
        toastr["error"]("Invlalid current password.");
        return;
    }
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
    	
    toastr["success"]("Changing password, Please wait ...");
	$.post( 
		'database/account.php', 			
		{ func: "changePass" , newpass:newpass,cpass:cpass },		 
		function( data ){ 
		  console.log(data);
			if(data == "success"){
			  toastr["success"]("Password successfully changed");
			}
            else{
                toastr["error"](data);
            }
           
            //location.href='index.php';
		});
       
}