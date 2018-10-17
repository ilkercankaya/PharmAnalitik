<?php
//BarcodeCheck.php
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
        <title>BARCODE CHECK - Pharmanalitik</title>

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
    </head>
    <body>
        <!-- Content Wrapper -->
        <div class="login-wrapper">
            <div class="container-center">
                <div class="panel panel-bd">
                    <div class="panel-heading">
                        <div class="view-header">
                            <div class="header-icon">
								<i class="pe-7s-pen"></i>
                            </div>
                            <div class="header-title">
                                <h3>Edit items with their unique barcode - Pharmanalitik</h3>
                                <small><strong>Please enter the barcode to edit information of an item from pharmanalitik.</strong></small>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form method="post" accept-charset="utf-8">
                            <div class="form-group">
                                <label class="control-label">Enter Barcode:</label>
                                <div class="input-group">
                                    <input id="barcode" type="text" class="form-control" name="barcode" placeholder="Barcode">
								</div>
						    </div>  
								<div class="form-group">
									<input type="button" name="enter" id="enter" class="btn btn-success btn-sm" value="Enter" />
									<input type="button" name="cancel" id="cancel" class="btn btn-danger btn-sm" value="Cancel" />
                                </div>                            
                            

													<style>
													#space { margin-top: 20px; }		
													</style>	
										<div id="error"></div>
										<div id="space"></div>
													<div class="form-group">
													<style>
													a {
														color: SteelBlue;
															}
													</style>
													<a href="AdminRegisterPage">Click Here To Return To Register Page.</a>																								
													</div>										

						<div align="right" > 	<input  type="button" name="logout" id="logout" class="btn btn-info btn-sm" value="Logout" /> </div>							
                         </form>
						 </div>	
				     </div>
                </div>
             </div>
        </div>

        <!-- /.content-wrapper -->
        <!-- jQuery -->
        <script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
        <!-- bootstrap js -->
        <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>


<script>
$(document).ready(function(){
document.getElementById('barcode').onkeypress = function(e){
    if (!e) e = window.event;
    var keyCode = e.keyCode || e.which;
    if (keyCode == '13'){
 $('#enter').click();
      return false;
    }
  }
 $('#enter').click(function(){
  var barcode = $('#barcode').val();
if(barcode!="")
{
   $.ajax({
    url:"barcodeCheckAction",
    method:"POST",
    data:{barcode:barcode},
    cache:false,
    beforeSend:function(){
     $('#enter').val("Connecting...");
    },
    success:function(response)
    {
     if(response==="success")
     {
		window.location = "detailsItemWBarcode";
     }
     else
     {
      $('#error').html("<span class='text-danger'>Barcode doesnt exist. Please try again!</span>");
	  $('#enter').val("Enter");
     }
    }
   });
	  
  }
  else
  {
	  $('#error').html("<span class='text-danger'>Please enter a barcode number!</span>");
 }
	});
 

   $('#cancel').click(function(){
 window.location = "AdminRegisterPage";
		});
 
 
  $('#logout').click(function(){
	   window.location = "logoutAdmin";
   });
});
</script>