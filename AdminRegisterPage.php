<?php
//AdminRegisterPage.php
session_start();
if(isset($_SESSION["admin"]))
{
}
else
{
	header("location:AdminLoginPage");
}
?>


<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>ADMIN REGISTER - Pharmanalitik</title>

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
        <link rel="apple-touch-icon" type="image/x-icon" href="assets/dist/img/ico/apple-touch-icon-57-precomposed.png">
        <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="assets/dist/img/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="assets/dist/img/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="assets/dist/img/ico/apple-touch-icon-144-precomposed.png">

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
        <!-- Bootstrap -->
        <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap rtl -->
        <!--<link href="assets/bootstrap-rtl/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>-->
        <!-- Pe-icon-7-stroke -->
        <link href="assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
        <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- Theme style -->
        <link href="assets/dist/css/component_ui.css" rel="stylesheet" type="text/css"/>
        <link href="assets/dist/css/skins/component_ui_black.css" rel="stylesheet" type="text/css"/>
        <!-- Theme style rtl -->
        <!--<link href="assets/dist/css/component_ui_rtl.css" rel="stylesheet" type="text/css"/>-->
        <!-- Custom css -->
        <link href="assets/dist/css/custom.css" rel="stylesheet" type="text/css"/>
		<link href="assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <!-- Content Wrapper -->
        <div class="login-wrapper">
            <div class="container-center">
                <div class="panel panel-bd">
                    <div class="panel-heading">
                        <div class="view-header">
                            <div class="header-icon">
								<i class="pe-7s-add-user"></i>
								<i class="pe-7s-delete-user"></i>
                            </div>
                            <div class="header-title">
                                <h3>Admin Register Page to Pharmanalitik</h3>
                                <small><strong>Please enter the information to register or delete a user from pharmanalitik.</strong></small>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form method="post" accept-charset="utf-8">
                            <div class="form-group">
                                <label class="control-label">Username For Adding/Deleting</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="username" type="text" class="form-control" name="username" placeholder="Username">
                                </div>                            
                            
							          <label class="control-label">		Repeat Username For Security</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="username2" type="text" class="form-control" name="username2" placeholder="Username">
                                </div>
							</div>
                            <div class="form-group">
                                <label class="control-label">Password FOR ONLY REGISTERING</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input id="password" type="password" class="form-control" name="password" placeholder="******">
                                </div>
                            
                                <label class="control-label">	 Repeat Password For Security FOR ONLY REGISTERING</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input id="password2" type="password" class="form-control" name="password2" placeholder="******">
                                </div>   
							</div>								
									<div class="form-group">
								<input type="button" name="add" id="add" class="btn btn-success" value="Register user" />
								<input type="button" name="delete" id="delete" class="btn btn-danger" value="Delete user" />
								<span class="help-block small">For deleting, no password is NEEDED (No matter if password box is filled or not)  - only the username is needed!</span>
									
									<style>
													#space { margin-top: 20px; }		
													</style>	
										<div id="space"></div>															
										<div id="error"></div>
										</div>	
													<div class="form-group">
													<style>
													a {
														color: SteelBlue;
															}
													</style>
													<a href="BarcodeCheck">Click Here To Edit Items With BARCODE.</a>																								
													</div>
													<style>
													#spaceTwo { margin-top: 40px; }		
													</style>	
								<div id="spaceTwo"></div>	
						<div align="right" > 	<input  type="button" name="logout" id="logout" class="btn btn-info btn-sm" value="Logout" /> </div>
                         </form>
				     </div>
                </div>
             </div>
        </div>

        <!-- /.content-wrapper -->
        <!-- jQuery -->
        <script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
		        <script src="assets/plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <!-- bootstrap js -->
        <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>


<script>
$(document).ready(function(){
 $('#add').click(function(){
  var username = $('#username').val();
  var password = $('#password').val();
  var username2 = $('#username2').val();
  var password2 = $('#password2').val();
  if(username == username2 && password==password2)
  {
	   if(username=="" || username2 =="" || password=="" || password2 =="")
	  {
		  $('#error').html("<span class='text-danger'>Please fill the username and password!</span>");
		   swal("Warning!", "Please fill the username and password!", "error");
	  }
	  else {
		   swal({
  title: "Are you sure?",
  text: "You are about to add a user to the database!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "green",
  confirmButtonText: "Yes, add it!",
  closeOnConfirm: false
},
function(){
   $.ajax({
    url:"RegisterAdd",
    method:"POST",
    data:{username:username, password:password},
    cache:false,
    beforeSend:function(){
     $('#add').val("Connecting...");
    },
    success:function(response)
    {
     if(response==="success")
     {
	  $('#add').val("Add user");
      swal("Added!", "The user has been added.", "success");
     }
     else
     {
      $('#add').val("Add user");
      swal("Failed!", "Username is already taken. Please try another username.", "error");
     }
    }
   });
   });
	  }
  }
  else if(username=="" || username2 =="" || password=="" || password2 =="")
	  {
		  $('#error').html("<span class='text-danger'>Please fill the username and password!</span>");
		 swal("Warning!", "Please fill the username and password!", "error");
		    $('html, body').animate({ scrollTop: $('#error').offset().top }, 'slow');
	  }
  else
  {
	  swal("Warning!", "Unmatching information in Username or Password!", "error");
		$('#error').html("<span class='text-danger'>Unmatching information in Username or Password!</span>");
		  $('html, body').animate({ scrollTop: $('#error').offset().top }, 'slow');
  }
 });
 

   $('#delete').click(function(){
  var username = $('#username').val();
  var password = $('#password').val();
  var username2 = $('#username2').val();
  var password2 = $('#password2').val();

  if(username == username2 )
  {
	   if(username=="" || username2 =="")
	  {
		  $('#error').html("<span class='text-danger'>Please fill the username!</span>");
		   swal("Warning!", "Please fill the username!", "error");
	  }
	  else {
		   swal({
  title: "Are you sure?",
  text: "You will not be able to recover the deleted user!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "green",
  confirmButtonText: "Yes, delete it!",
  closeOnConfirm: false
},
function(){
	   $.ajax({
    url:"RegisterDelete",
    method:"POST",
    data:{username:username},
    cache:false,
    beforeSend:function(){
     $('#delete').val("Connecting...");
    },
    success:function(data)
    {
	 var result = $.trim(data);
     if(result==="success")
     {
	  $('#delete').val("Delete user");
      swal("Deleted!", "The user has been deleted.", "success");
     }
     else
     {
      $('#delete').val("Delete user");
      swal("Failed!", "The user does not exist in the database.", "error");
     }
    }
   });
});
	  }
  }
  else if(username=="" || username2 =="")
	  {
		  $('#error').html("<span class='text-danger'>Please fill the username!</span>");
		   swal("Warning!", "Please fill the username!", "error");
		    $('html, body').animate({ scrollTop: $('#error').offset().top }, 'slow');
	  }
  else
  {
		$('#error').html("<span class='text-danger'>Unmatching information in Username!</span>");
		 swal("Warning!", "Unmatching information in Username!", "error");
		  $('html, body').animate({ scrollTop: $('#error').offset().top }, 'slow');
  }
 });
 
 
  $('#logout').click(function(){
	   window.location = "logoutAdmin";
   });
});
</script>