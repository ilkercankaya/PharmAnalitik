<?php
//edit.php
session_start();
if(isset($_SESSION["username"]))
{
	error_reporting( 0 );
	$connect = mysqli_connect('localhost', 'pharmana_general', '123456pharmana', 'pharmana_user_db');
	if ( !$connect ) {
    die( 'Could not connect: ' . mysqli_error() );
	}
	 mysqli_set_charset($connect, "utf8"); /* Procedural approach */
	$username = mysqli_real_escape_string($connect, $_SESSION["username"]);
	$sql = "SELECT * FROM general_Table WHERE username = '".$username."' ";
	$result = mysqli_query($connect, $sql);
	// All good?
	if ( !$result ) {
	  // Nope
	  $message  = 'Invalid query: ' . mysqli_error() . "\n";
	  $message .= 'Whole query: ' . $query;
	  die( $message );
	}

    $data = mysqli_fetch_assoc($result);
	mysqli_close( $connect );
}
else
{
	header("location:home");
}
?>




<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Edit Profile - pharmanalitik</title>
        <!-- FEVICON AND TOUCH ICON -->
        <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
        <link rel="apple-touch-icon" type="image/x-icon" href="assets/dist/img/ico/apple-touch-icon-57-precomposed.png">
        <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="assets/dist/img/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="assets/dist/img/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="assets/dist/img/ico/apple-touch-icon-144-precomposed.png">
        <!-- STATRT GLOBAL MANDATORY STYLE -->
        <link href="assets/dist/css/base.css" rel="stylesheet" type="text/css"/>
        <!-- START PAGE LABEL PLUGINS --> 
        <!-- START THEME LAYOUT STYLE -->
        <link href="assets/dist/css/component_ui.min.css" rel="stylesheet" type="text/css"/>
        <link id="defaultTheme" href="assets/dist/css/skins/skin-dark.min.css" rel="stylesheet" type="text/css"/>
	    <link href="assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="assets/dist/css/custom.css" rel="stylesheet" type="text/css"/>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div id="wrapper" class="wrapper animsition">
            <!-- Navigation -->
            <nav class="navbar navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand" href="home">
                        <img class="main-logo" src="assets/dist/img/light-logo.png" alt="">
                        <!--<span>AdminPage</span>-->
                    </a>
                </div>
                <div class="nav-container">
                    <!-- /.navbar-header -->
                    <ul class="nav navbar-nav hidden-xs">
                        <li><a id="fullscreen" href="#"><i class="material-icons">fullscreen</i> </a></li>
                        <!-- /.Full page search -->
                    </ul>
                    <ul class="nav navbar-top-links navbar-right">                    
                        <li class="dropdown">
                        </li><!-- /.Dropdown -->
                        <!-- /.Dropdown -->
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="material-icons">person_add</i>
                            </a>
                           <ul class="dropdown-menu dropdown-messages" style=" z-index: 999;">
                                <li class="active"><a href="profile"><i class="ti-user"></i>&nbsp; Profile</a></li>
                                <li><a href="logoutGeneral"><i class="ti-layout-sidebar-left"></i>&nbsp; Logout</a></li>
                            </ul><!-- /.dropdown-user -->
                        </li><!-- /.Dropdown -->
                        <li class="log_out">
                            <a href="logoutGeneral">
                                <i class="material-icons">power_settings_new</i>
                            </a>
                        </li><!-- /.Log out -->
                    </ul> <!-- /.navbar-top-links -->
                </div>
            </nav>
            <!-- /.Navigation -->
<div class=sidebar role=navigation>
<div class="sidebar-nav navbar-collapse" >
<ul class=nav id=side-menu>
<li class="nav-heading" > <span>Navigation&nbsp;&nbsp;&nbsp;&nbsp;</span></li>
<li class="active" ><a href=home class=material-ripple><i class=material-icons>home</i> Ana Göstergeler</a></li>
<li>
<li >
<a href="#" class=material-ripple><i class=material-icons>bubble_chart</i>Charts<span class="fa arrow"></span></a>
<ul class="nav nav-second-level">
<li > <a href="ciro"><i class="fa fa-try" aria-hidden="true"  href=ciro></i>Ciro</a>
</li>
<li > <a href="stok"><img src="img/storage-iconONE.jpg" style="width:20px;height:20px;">  Stok</a>
</li>
<li> <a href="kar"><img src="img/get-money.png" style="width:20px;height:20px;">  Kar</a>
</li>
<li> <a href="portfoy"><img src="img/products.png" style="width:20px;height:20px;">  Ürün Portföyü</a>
</li>
</ul>
</div>
</div>
            <!-- /.Left Sidebar-->
            <div class="side-bar right-bar">
                <div class="">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs right-sidebar-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="material-icons">home</i></a></li>
                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="material-icons">person_add</i></a></li>
                        <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab"><i class="material-icons">chat</i></a></li>
                    </ul>

                </div>
            </div>
            <!-- /.Right Sidebar -->
            <!-- /.Navbar  Static Side -->
            <div class="control-sidebar-bg"></div>
            <!-- Page Content -->
            <div id="page-wrapper">
                <!-- main content -->
                <div class="content">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="header-icon"><i class="pe-7s-user"></i></div>
                        <div class="header-title">
                            <h1>Profile of User</h1>
                            <small>User's data with editing option</small>
                            <ol class="breadcrumb">
                                <li><a href="home"><i class="pe-7s-home"></i>Home</a></li>
                                <li ><a href="profile">Profile</a></li>
								 <li class="active">Edit Profile</li>
                            </ol>
                        </div>
                    </div> <!-- /. Content Header (Page header) -->
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-header-menu">
                                        <i class="fa fa-bars"></i>
                                    </div>
                                </div>
                                <div class="card-content">
								 <form method="post" accept-charset="utf-8">
                                    <div class="card-content-member">
                                                                        <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Edit Profile</h4>
                                    </div>
                                </div>
                                    </div>
                                    <div class="card-content-languages">
                                        <div class="card-content-languages-group">
                                            <div>
                                                <h4>User ID:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <div class="fluency fluency-4"><?php print $data["User_ID"];    ?></div>
                                                    </li>
                                                </ul>
                                            </div>
											 </div>
										<div class="card-content-languages-group">
										    <div>
                                                <h4>Name:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
                                                                <div class="input-group">
																<input id="name" type="text" class="form-control" name="name" value="<?php print  $data["Kullanici_Adi"];?>" placeholder="<?php print  $data["Kullanici_Adi"];?>">
																</div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>		
											<div class="card-content-languages-group">
										    <div>
                                                <h4>Surname:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
                                                                <div class="input-group">
																<input id="surname" type="text" class="form-control" name="surname"  value="<?php print $data["Kullanici_Soyadi"]; ?>"  placeholder="<?php print $data["Kullanici_Soyadi"]; ?>">
																</div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>												
										<div class="card-content-languages-group">
										    <div>
                                                <h4>Phone Number:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
													<div class="input-group">
													<input id="phone_number" type="text" class="form-control" name="phone_number" value="<?php print $data["Telefon"]; ?>" placeholder="<?php print $data["Telefon"]; ?>"  >
													</div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>		
										<div class="card-content-languages-group">
										    <div>
                                                <h4>GSM:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
													<div class="input-group">
													<input id="GSM" type="text" class="form-control" name="GSM" value="<?php print $data["GSM"]; ?>" placeholder="<?php print $data["GSM"]; ?>">
													</div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>			
										<div class="card-content-languages-group">
										    <div>
                                                <h4>Mail:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
													    <div class="input-group">
												     	<input id="mail" type="text" class="form-control" name="mail"  value="<?php print $data["Mail"]; ?>" placeholder="<?php print $data["Mail"]; ?>">
													    </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>													
										<div class="card-content-languages-group">
										    <div>
                                                <h4>Work:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
													    <div class="input-group">
												     	<input id="work" type="text" class="form-control" name="work" value="<?php print $data["Gorevi"]; ?>"  placeholder="<?php print $data["Gorevi"]; ?>">
													    </div>                                                       
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>				
										<div class="card-content-languages-group">
										    <div>
                                                <h4>Pharmacy Name:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
													    <div class="input-group">
												     	<input id="pharmacy_name" value="<?php print $data["Eczane_Adi"]; ?>" type="text" class="form-control" name="pharmacy_name" placeholder="<?php print $data["Eczane_Adi"]; ?>">
													    </div>     
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>		
										<div class="card-content-languages-group">
										    <div>
                                                <h4>Pharmacy ID:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
													    <div class="input-group">
												     	<input id="pharmacy_id" value="<?php print $data["EczaneID"]; ?>" type="text" class="form-control" name="pharmacy_id" placeholder="<?php print $data["EczaneID"]; ?>">
													    </div>     
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
										<div class="form-group">
										<div id="error"></div>
										<div id="space"></div>
										<style>
													#space { margin-top: 15px; }														
													a {
														color: SteelBlue;
															}
													</style>
													
										<p align="right">
								    <input type="button"  class="btn btn-info" id="update_profile" name="update_profile"  value="Update Profile" />
								     <input type="button" onclick="window.location='profile'" class="btn btn-danger" value="Cancel" />								
								    </p>
									</div>  										
                                    </div>
								</form>						
                                </div>
                            </div>
       
                        </div>
                                 
                    </div> 
                </div> <!-- /.main content -->
            </div><!-- /#page-wrapper -->
        </div><!-- /#wrapper -->
        <!-- START CORE PLUGINS -->
        <script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/plugins/metisMenu/metisMenu.min.js" type="text/javascript"></script>
        <script src="assets/plugins/lobipanel/lobipanel.min.js" type="text/javascript"></script>
        <script src="assets/plugins/animsition/js/animsition.min.js" type="text/javascript"></script>
        <script src="assets/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
		<script src="assets/plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
 
        <!-- STRAT PAGE LABEL PLUGINS -->
        <!-- START THEME LABEL SCRIPT -->
        <script src="assets/dist/js/app.min.js" type="text/javascript"></script>
        <script src="assets/dist/js/jQuery.style.switcher.min.js" type="text/javascript"></script>
    </body>
</html>


<script>
$(document).ready(function(){
document.getElementById('name').onkeypress = function(e){
    if (!e) e = window.event;
    var keyCode = e.keyCode || e.which;
    if (keyCode == '13'){
 $('#update_profile').click();
      return false;
    }
  }
  document.getElementById('surname').onkeypress = function(e){
    if (!e) e = window.event;
    var keyCode = e.keyCode || e.which;
    if (keyCode == '13'){
 $('#update_profile').click();
      return false;
    }
  }
  document.getElementById('phone_number').onkeypress = function(e){
    if (!e) e = window.event;
    var keyCode = e.keyCode || e.which;
    if (keyCode == '13'){
 $('#update_profile').click();
      return false;
    }
  }
  document.getElementById('GSM').onkeypress = function(e){
    if (!e) e = window.event;
    var keyCode = e.keyCode || e.which;
    if (keyCode == '13'){
 $('#update_profile').click();
      return false;
    }
  }
  document.getElementById('mail').onkeypress = function(e){
    if (!e) e = window.event;
    var keyCode = e.keyCode || e.which;
    if (keyCode == '13'){
 $('#update_profile').click();
      return false;
    }
  }
  document.getElementById('work').onkeypress = function(e){
    if (!e) e = window.event;
    var keyCode = e.keyCode || e.which;
    if (keyCode == '13'){
 $('#update_profile').click();
      return false;
    }
  }
  document.getElementById('pharmacy_name').onkeypress = function(e){
    if (!e) e = window.event;
    var keyCode = e.keyCode || e.which;
    if (keyCode == '13'){
 $('#update_profile').click();
      return false;
    }
  }
  document.getElementById('pharmacy_id').onkeypress = function(e){
    if (!e) e = window.event;
    var keyCode = e.keyCode || e.which;
    if (keyCode == '13'){
 $('#update_profile').click();
      return false;
    }
  }
 $('#update_profile').click(function(){
  var name = $('#name').val();
  var surname = $('#surname').val();
  var phone_number = $('#phone_number').val();
  var GSM = $('#GSM').val();
  var mail = $('#mail').val();
  var work = $('#work').val();
  var pharmacy_name = $('#pharmacy_name').val();
  var pharmacy_id = $('#pharmacy_id').val(); 
  if($.trim(name).length > 0 && $.trim(surname).length > 0 && $.trim(phone_number).length > 0 && $.trim(GSM).length > 0 && $.trim(mail).length > 0 && $.trim(work).length > 0 && $.trim(pharmacy_name).length > 0 && $.trim(pharmacy_id).length > 0)
  {
	  swal({
  title: "Are you sure?",
  text: "Your profile will be updated!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "green",
  confirmButtonText: "Yes, Update it!",
  closeOnConfirm: false
},
function(){
   $.ajax({
    url:"editProfileAction",
    method:"POST",
	data:{name:name, surname:surname, phone_number:phone_number, GSM:GSM, mail:mail, work:work, pharmacy_name:pharmacy_name, pharmacy_id:pharmacy_id},
    cache:false,
    beforeSend:function(){
     $('#update_profile').val("Connecting...");
    },
    success:function(response)
    {
     if(response==="success")
     {
	  		 window.location = "profile";
     }
     else
     {
      $('#update_profile').val("Update Profile");
	   swal("Failed!", "Please enter different values than previous values.", "error");
      $('#error').html("<span class='text-danger'>Please enter different values than previous values!</span>");
	   $('html, body').animate({ scrollTop: $('#error').offset().top }, 'slow');
     }
    }
   });
    });
   }
  else
  {
	$('#update_profile').val("Update Profile");
	swal("Warning!", "Please fill in all the blanks!", "error");
    $('#error').html("<span class='text-danger'>Please fill in all the blanks!</span>");
			    $('html, body').animate({ scrollTop: $('#error').offset().top }, 'slow');
  }
  });
});
</script>