<?php
session_start();
if(isset($_SESSION["username"]))
{		
	error_reporting( 0 );
	//Connect user database
	$connect = mysqli_connect('localhost', 'pharmana_general', '123456pharmana', 'pharmana_user_db');
		 if ( !$connect ) {
    die( 'Could not connect: ' . mysqli_error() );
	}
	 mysqli_set_charset($connect, "utf8"); /* Procedural approach */
	$username = mysqli_real_escape_string($connect, $_SESSION["username"]);
	//Eczane İsmi
	$sql = "SELECT Eczane_Adi FROM general_Table WHERE username = '".$username."' ";
	$result = mysqli_query($connect, $sql);
    $data = mysqli_fetch_assoc($result);	
		//Datas Hareket DB
	$connectTwo = mysqli_connect('localhost', 'pharmana_general', '123456pharmana', 'pharmana_Hareket_db');
		 if ( !$connectTwo ) {
    die( 'Could not connect: ' . mysqli_error() );
	}

	//Datas Ciro
	mysqli_set_charset($connectTwo, "utf8"); /* Procedural approach */
	$pharmacy_id = mysqli_real_escape_string($connectTwo, $_SESSION["pharmacy_id"]);
	$dateMonth = mysqli_real_escape_string($connectTwo, date("n"));
	$dateYear = mysqli_real_escape_string($connectTwo, date('Y'));
	$dateLastYear = mysqli_real_escape_string($connectTwo, date("Y",strtotime("-1 year")));
 //Table 2
 $sqlDataTable = "SELECT UR.Ana_Kategori AS Ana_Kategori
FROM pharmana_urun_db.general_Table UR
 GROUP BY UR.Ana_Kategori";
$resultDataTableTwo = mysqli_query($connectTwo, $sqlDataTable);
		mysqli_close( $connect );
		mysqli_close( $connectTwo );
	}
else
	 header("location:loginpage");
?>

<html lang=en>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name=viewport content="width=device-width, initial-scale=1">
<meta name=description content="">
<meta name=author content="">
<title>Kar - pharmanalitik</title>
<!-- FEVICON AND TOUCH ICON -->
						<link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
						<link rel="apple-touch-icon" type="image/x-icon" href="assets/dist/img/ico/apple-touch-icon-57-precomposed.png">
						<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="assets/dist/img/ico/apple-touch-icon-72-precomposed.png">
						<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="assets/dist/img/ico/apple-touch-icon-114-precomposed.png">
						<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="assets/dist/img/ico/apple-touch-icon-144-precomposed.png">
<link href="assets/dist/css/base.css" rel=stylesheet type="text/css"/>
<link href="assets/plugins/emojionearea/emojionearea.min.css" rel=stylesheet type="text/css"/>
<link href="assets/plugins/monthly/monthly.min.css" rel=stylesheet type="text/css"/>
<link href="assets/plugins/amcharts/export.css" rel=stylesheet type="text/css"/>
<link href="assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/datatables/dataTables.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/font-awesome/css/font-awesome.min.css" rel=stylesheet type="text/css"/>
<link href="assets/dist/css/component_ui.min.css" rel=stylesheet type="text/css"/>
<link id=defaultTheme href="assets/dist/css/skins/skin-dark.min.css" rel=stylesheet type="text/css"/>
<link href="assets/dist/css/custom.css" rel=stylesheet type="text/css"/>
<script src="assets/plugins/jQuery/jquery-1.12.4.min.js"></script>
<!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
		
</head>
<body>
<div id=wrapper class="wrapper animsition">
<nav class="navbar navbar-fixed-top" role=navigation>
<div class=navbar-header>
<button type=button class=navbar-toggle data-toggle=collapse data-target=.navbar-collapse>
<span class=sr-only>Toggle navigation</span>
<i class=material-icons>apps</i>
</button>
<a class=navbar-brand href=home>
<img class=main-logo src="assets/dist/img/light-logo.png" alt="">
</a>
</div>
<div class=nav-container>
<ul class="nav navbar-nav hidden-xs">
<li><a id=fullscreen href="#"><i class=material-icons>fullscreen</i> </a></li>
</ul>
<ul class="nav navbar-top-links navbar-right">
<li class="dropdown">
<a class="dropdown-toggle" data-toggle="dropdown" href="#">
<i class="material-icons">person_add</i>
</a>
<ul class="dropdown-menu dropdown-messages" style=" z-index: 999;">
<li><a href="profile"><i class="ti-user"></i>&nbsp; Profile</a></li>
<li><a href="logoutGeneral"><i class="ti-layout-sidebar-left"></i>&nbsp; Logout</a></li>
</ul>
</li>
<li class=log_out>
<a href=logoutGeneral>
<i class=material-icons>power_settings_new</i>
</a>
</li>
</ul>
</div>
</nav>
<div class=sidebar role=navigation>
<div class="sidebar-nav navbar-collapse" >
<ul class=nav id=side-menu>
<li class="nav-heading" > <span>Navigation&nbsp;&nbsp;&nbsp;&nbsp;</span></li>
<li ><a href=home class=material-ripple><i class=material-icons>home</i> Ana Göstergeler</a></li>
<li>
<li class="active">
<a href="#" class=material-ripple><i class=material-icons>bubble_chart</i>Charts<span class="fa arrow"></span></a>
<ul class="nav nav-second-level">
<li  class="active"> <a href="ciro"><i class="fa fa-try" aria-hidden="true"  href=ciro></i>Ciro</a>
</li>
<li  > <a href="stok"><img src="img/storage-iconONE.jpg" style="width:20px;height:20px;">  Stok</a>
</li>
<li> <a href="kar"><img src="img/get-money.png" style="width:20px;height:20px;">  Kar</a>
</li>
<li> <a href="portfoy"><img src="img/products.png" style="width:20px;height:20px;">  Ürün Portföyü</a>
</li>
</ul>
</div>
</div>
<div class=control-sidebar-bg></div>
<div id=page-wrapper>
<div class=content>
<div class=content-header>
<div class=header-icon>
<a><img src="img/Eczane_Logo_Seffaf.png" style="width:55px;height:55px;">  </a>
</div>
<div class=header-title>
<h1> <?php print $data["Eczane_Adi"]; ?> Eczanesi Stok Sonuç Göstergeleri.</small></h1>
 <small><?php print $data["Eczane_Adi"]; ?> eczanesi ile ilgili stok bilgileri.</small>
<ol class=breadcrumb>
<li><a href=home><i class=pe-7s-home></i> Home</a></li>
<li>Charts</li>
<li>Ciro</li>
<li class=active>Ciro Ana Sayfa</li>
</ol>
</div>

</div>

   <div class="row">
  <div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<div class="panel panel-bd lobidrag">
<div class=panel-heading> 
<i >COMING SOON!</i>
</div>
</div>
</div>
</div>
</div>
</div>
						  
						  

	</div>
	</div>

		<style>
		.modal {
}

/* When the body has the loading class, we turn
   the scrollbar off with overflow:hidden */
body.loading {
    overflow: hidden;   
}

/* Anytime the body has the loading class, our
   modal element will be visible */
body.loading .modal {
    display: block;
}


#legenddiv {
    height: 100px !important; /* force that height */
    overflow: auto;
    position: relative;
}
#charts {
  width: 500px;
  height: 500px;
  position: relative;
  margin: 0 auto;
  font-size: 8px;
}

.chartdiv {
    width       : 500px;
    height      : 500px;
  position: absolute;
  top: 0;
  left: 0;
}   
</style>
	
	    </body>
</html>


        <!-- STRAT PAGE LABEL PLUGINS -->
<script src="assets/plugins/datatables/dataTables.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/plugins/metisMenu/metisMenu.min.js"></script>
<script src="assets/plugins/lobipanel/lobipanel.min.js"></script>
<script src="assets/plugins/animsition/js/animsition.min.js"></script>
<script src="assets/plugins/fastclick/fastclick.min.js"></script>
<script src="assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="assets/plugins/sparkline/sparkline.min.js"></script>
<script src="assets/plugins/counterup/jquery.counterup.min.js"></script>
<script src="assets/plugins/counterup/waypoints.js"></script>
<script src="assets/plugins/emojionearea/emojionearea.min.js"></script>
<script src="assets/plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
<script src="assets/plugins/monthly/monthly.min.js"></script>
<script src="assets/plugins/datatables/dataTables.min.js" type="text/javascript"></script>
<script src="assets/plugins/amcharts/amcharts.js"></script>
<script src="assets/plugins/amcharts/ammap.js"></script>
<script src="assets/plugins/amcharts/worldLow.js"></script>
<script src="assets/plugins/amcharts/serial.js"></script>
<script src="assets/plugins/amcharts/export.min.js"></script>
<script src="assets/plugins/amcharts/dark.js"></script>

<script src="assets/plugins/amcharts/pie.js"></script>
<script src="assets/dist/js/app.min.js"></script>
<script src="assets/dist/js/page/dashboard_dark.js"></script>
<script src="assets/dist/js/jQuery.style.switcher.min.js"></script>
<script src="http://www.amcharts.com/lib/3/plugins/dataloader/dataloader.min.js" type="text/javascript"></script>
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>							
</body>
</html>
