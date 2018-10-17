<?php
//home.php
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
	//Connect urun database
	$connectThree = mysqli_connect('localhost', 'pharmana_general', '123456pharmana', 'pharmana_urun_db');
		 if ( !$connectThree ) {
    die( 'Could not connect: ' . mysqli_error() );
	}
	//Datas Ciro
	mysqli_set_charset($connectTwo, "utf8"); /* Procedural approach */
	$pharmacy_id = mysqli_real_escape_string($connectTwo, $_SESSION["pharmacy_id"]);
	$dateMonth = mysqli_real_escape_string($connectTwo, date("n"));
	$dateYear = mysqli_real_escape_string($connectTwo, date('Y'));
	$dateLastYear = mysqli_real_escape_string($connectTwo, date("Y",strtotime("-1 year")));
	$dateLastTwoYear = mysqli_real_escape_string($connectTwo, date("Y",strtotime("-2 year")));
	$dateLastMonth = mysqli_real_escape_string($connectTwo, date("n",strtotime("-1 month")));
	$dateLastTwoMonth = mysqli_real_escape_string($connectTwo, date("n",strtotime("-2 month")));
	$sqlTwo = "SELECT SUM(KDV_Haric_Ciro) AS KDV 
	FROM general_Table 
	WHERE EczaneID = '".$pharmacy_id."' AND Donem = '".$dateMonth."' AND Yil = '".$dateYear."'		";
	$resultTwo = mysqli_query($connectTwo, $sqlTwo);
    $dataCiro = mysqli_fetch_assoc($resultTwo);	
	$sqlThree = "SELECT SUM(KDV_Haric_Ciro) AS KDV 
	FROM general_Table 
	WHERE EczaneID = '".$pharmacy_id."' AND Donem = '".$dateMonth."' AND Yil = '".$dateLastYear."'		";
	$resultThree = mysqli_query($connectTwo, $sqlThree);
    $dataCiroLastYear = mysqli_fetch_assoc($resultThree);	
	$percentage = ((($dataCiro["KDV"] - $dataCiroLastYear["KDV"])/($dataCiro["KDV"])) * 100);
	if($dataCiro["KDV"]==0)
	{
		$sqlTwo = "SELECT SUM(KDV_Haric_Ciro) AS KDV 
	FROM general_Table 
	WHERE EczaneID = '".$pharmacy_id."' AND Donem = '".$dateLastMonth."' AND Yil = '".$dateYear."'		";
	$resultTwo = mysqli_query($connectTwo, $sqlTwo);
    $dataCiro = mysqli_fetch_assoc($resultTwo);	
	$sqlThree = "SELECT SUM(KDV_Haric_Ciro) AS KDV 
	FROM general_Table 
	WHERE EczaneID = '".$pharmacy_id."' AND Donem = '".$dateLastMonth."' AND Yil = '".$dateLastYear."'		";
	$resultThree = mysqli_query($connectTwo, $sqlThree);
    $dataCiroLastYear = mysqli_fetch_assoc($resultThree);	
	$percentage = ((($dataCiro["KDV"] - $dataCiroLastYear["KDV"])/($dataCiro["KDV"])) * 100);
	}
	//Datas Stok
	$sqlFour = "SELECT SUM(Stok_Alis_Tutari) AS Stok 
	FROM general_Table 
	WHERE EczaneID = '".$pharmacy_id."' AND Donem = '".$dateMonth."' AND Yil = '".$dateYear."'		";
	$resultFour = mysqli_query($connectTwo, $sqlFour);
    $dataStok = mysqli_fetch_assoc($resultFour);	
	$sqlFive = "SELECT SUM(Stok_Alis_Tutari) AS Stok 
	FROM general_Table 
	WHERE EczaneID = '".$pharmacy_id."' AND Donem = '".$dateMonth."' AND Yil = '".$dateLastYear."'		";
	$resultFive = mysqli_query($connectTwo, $sqlFive);
    $dataStokLastYear = mysqli_fetch_assoc($resultFive);	
	$percentageStok = ((($dataStok["Stok"] - $dataStokLastYear["Stok"])/($dataStok["Stok"])) * 100);
		if($dataStok["Stok"]==0)
	{
		$sqlFour = "SELECT SUM(Stok_Alis_Tutari) AS Stok 
	FROM general_Table 
	WHERE EczaneID = '".$pharmacy_id."' AND Donem = '".$dateLastMonth."' AND Yil = '".$dateYear."'		";
	$resultFour = mysqli_query($connectTwo, $sqlFour);
    $dataStok = mysqli_fetch_assoc($resultFour);	
	$sqlFive = "SELECT SUM(Stok_Alis_Tutari) AS Stok 
	FROM general_Table 
	WHERE EczaneID = '".$pharmacy_id."' AND Donem = '".$dateLastMonth."' AND Yil = '".$dateLastYear."'		";
	$resultFive = mysqli_query($connectTwo, $sqlFive);
    $dataStokLastYear = mysqli_fetch_assoc($resultFive);	
	$percentageStok = ((($dataStok["Stok"] - $dataStokLastYear["Stok"])/($dataStok["Stok"])) * 100);
	}
   
	//Datas Kar
	$sqlKar = "SELECT SUM(Kar) AS Kar, SUM(KDV_Haric_Ciro) AS Ciro 
	FROM general_Table 
	WHERE EczaneID = '".$pharmacy_id."' AND Donem = '".$dateMonth."' AND Yil = '".$dateYear."'		";
	$resultKar = mysqli_query($connectTwo, $sqlKar);
    $dataKar = mysqli_fetch_assoc($resultKar);	
	$sqlFive = "SELECT SUM(Kar) AS Kar, SUM(KDV_Haric_Ciro) AS Ciro 
	FROM general_Table 
	WHERE EczaneID = '".$pharmacy_id."' AND Donem = '".$dateMonth."' AND Yil = '".$dateLastYear."'		";
	$resultFive = mysqli_query($connectTwo, $sqlFive);
    $dataKarLastYear = mysqli_fetch_assoc($resultFive);
    $kar_tutari	 = $dataKar["Kar"];
	$kar_tutari_lastYear	 = $dataKarLastYear["Kar"];
	$kar_marji = ($dataKar["Kar"] / $dataKar["Ciro"] * 100);
		if($dataKar["Kar"]==0)
	{
		$sqlKar = "SELECT SUM(Kar) AS Kar, SUM(KDV_Haric_Ciro) AS Ciro 
	FROM general_Table 
	WHERE EczaneID = '".$pharmacy_id."' AND Donem = '".$dateLastMonth."' AND Yil = '".$dateYear."'		";
	$resultKar = mysqli_query($connectTwo, $sqlKar);
    $dataKar = mysqli_fetch_assoc($resultKar);	
	$sqlFive = "SELECT SUM(Kar) AS Kar, SUM(KDV_Haric_Ciro) AS Ciro 
	FROM general_Table 
	WHERE EczaneID = '".$pharmacy_id."' AND Donem = '".$dateLastMonth."' AND Yil = '".$dateLastYear."'		";
	$resultFive = mysqli_query($connectTwo, $sqlFive);
    $dataKarLastYear = mysqli_fetch_assoc($resultFive);
    $kar_tutari	 = $dataKar["Kar"];
	$kar_tutari_lastYear	 = $dataKarLastYear["Kar"];
	$kar_marji = ($dataKar["Kar"] / $dataKar["Ciro"] * 100);
	}
	
	//Data SKU
	$sqlFive = "SELECT Barkod
	FROM general_Table 
	WHERE EczaneID = '".$pharmacy_id."' AND Donem = '".$dateMonth."' AND Yil = '".$dateYear."'		";
	$resultFive = mysqli_query($connectTwo, $sqlFive);
    $row_cnt = mysqli_num_rows($resultFive);
	$sqlSix = "SELECT DISTINCT(Barkod)
	FROM general_Table 
	WHERE EczaneID = '".$pharmacy_id."'	";
	$resultSix = mysqli_query($connectTwo, $sqlSix);
	$row_cnt_two = mysqli_num_rows($resultSix);
	$sqlSeven = "SELECT DISTINCT(Barkod)
	FROM general_Table 
		";
	$resultSeven = mysqli_query($connectThree, $sqlSeven);
	$row_cnt_three = mysqli_num_rows($resultSeven);
	$ratio = (($row_cnt_three / $row_cnt_two ) * 100);
	$sqlEight = "SELECT SUM(KDV_Haric_Ciro) AS KDV
	FROM general_Table 
	WHERE EczaneID = '".$pharmacy_id."'	";
	$resultEight = mysqli_query($connectTwo, $sqlEight);
	$sumCiro = mysqli_fetch_assoc($resultEight);	
	$sumCiroPerc =(($sumCiro["KDV"]*80)/100);
	$sqlNine = "SELECT * 
	FROM `general_Table` 
	WHERE EczaneID = '".$pharmacy_id."'
	ORDER BY `general_Table`.`KDV_Haric_Ciro` DESC	";
	$resultNine = mysqli_query($connectTwo, $sqlNine);
	$dummy = 0;
	$barcode_number=0;
	do
	{
		$row = mysqli_fetch_assoc( $resultNine );
		$dummy = $row["KDV_Haric_Ciro"] + $dummy;
		$barcode_number = $barcode_number +1;
	}while($dummy<$sumCiroPerc);
		mysqli_close( $connect );
		mysqli_close( $connectTwo );
		mysqli_close( $connectThree );
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
<title>Dashboard - pharmanalitik</title>
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
<link href="assets/font-awesome/css/font-awesome.min.css" rel=stylesheet type="text/css"/>
<link href="assets/dist/css/component_ui.min.css" rel=stylesheet type="text/css"/>
<link id=defaultTheme href="assets/dist/css/skins/skin-dark.min.css" rel=stylesheet type="text/css"/>
<link href="assets/dist/css/custom.css" rel=stylesheet type="text/css"/>
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
<a class=dropdown-toggle data-toggle=dropdown href="#">
<i class=material-icons>person_add</i>
</a>


<ul class="dropdown-menu dropdown-messages" style=" z-index: 999;">
<li><a href="profile"><i class=ti-user></i>&nbsp; Profile</a></li>
<li><a href="logoutGeneral"><i class=ti-layout-sidebar-left></i>&nbsp; Logout</a></li>
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
<li  class="active"><a href=home class=material-ripple><i class=material-icons>home</i> Ana Göstergeler</a></li>
<li>
<li>
<a href="#" class=material-ripple><i class=material-icons>bubble_chart</i>Charts<span class="fa arrow"></span></a>
<ul class="nav nav-second-level">
<li > <a href="ciro"><i class="fa fa-try" aria-hidden="true"  href=ciro></i>Ciro</a>
</li>
<li> <a href="stok"><img src="img/storage-iconONE.jpg" style="width:20px;height:20px;">  Stok</a>
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
<h1> <?php print $data["Eczane_Adi"]; ?> Eczanesi Ticari Sonuç Göstergeleri.</small></h1>
 <small><?php print $data["Eczane_Adi"]; ?> eczanesi ile ilgili bilgiler.</small>
<ol class=breadcrumb>
<li><a href=home><i class=pe-7s-home></i> Home</a></li>
<li class=active>Ana Göstergeleri</li>
</ol>
</div>
</div>
</div>
<style>
.statistic-box .small {
    font-weight: 600;
    margin-bottom: 15px;
    position: inherit;
    z-index: 999;
}
.statistic-box .topAppear {
     position: inherit;
	z-index: 999;
}
</style>
<div class=row>
<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
<div class="statistic-box statistic-filled-3">
<?php if($dataCiro["KDV"]==0) { ?>
<div class=small style="color:FireBrick;"><?php print "Bulunduğumuz ".$dateMonth.". ayına ait bilgi yer almamaktadır. Aşağıdaki veriler ".$dateLastMonth.". aya ait Ciro verileridir."; ?> </div>
<?php } ?>
<?php if($dataCiro["KDV"]!=0) { ?>
<div class=small><?php print "Ciro";  ?> </div>
<?php } ?>
<div class=topAppear><h1><span class=count-number><?php print number_format($dataCiro["KDV"], 2); ?> </span>TL</h1></div>
<h5 style="margin-top:-10px; color:black;"><?php
echo(date("Y",strtotime("-1 year"))."ya göre:");
?>
</h5>
<?php if(($dataCiro["KDV"] - $dataCiroLastYear["KDV"])>0) { ?>
<div ><h3 style="margin-top:-8px; color:lime"><?php print "+".number_format(($dataCiro["KDV"] - $dataCiroLastYear["KDV"]), 2, ',', '.'); ?></h3> </div>
<div align="right" style="margin-top:-30px;" ><span class=slight ><i class="fa fa-play fa-rotate-270 text-warning"> </i><?php print round($percentage,2); ?></span> </div> 
<?php } ?>
<?php if(($dataCiro["KDV"] - $dataCiroLastYear["KDV"])<0) { ?>
<div ><h3 style="margin-top:-8px; color:FireBrick;"><?php print number_format(($dataCiro["KDV"] - $dataCiroLastYear["KDV"]), 2, ',', '.'); ?></h3> </div>
<div align="right" style="margin-top:-30px;" ><span class=slight ><i class="fa fa-play fa-rotate-90 text-warning"> </i><?php print round($percentage,2); ?></span> </div> 
<?php } ?> 
<div ><a href="ciro"> <i class="fa fa-try statistic_icon" style="z-index: 0; position: absolute;"></i></a></div>
</div>
</div>

<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
<div class="statistic-box statistic-filled-1">
<?php if($dataStok["Stok"]==0) { ?>
<div class=small style="color:FireBrick;"><?php print "Bulunduğumuz ".$dateMonth.". ayına ait bilgi yer almamaktadır. Aşağıdaki veriler ".$dateLastMonth.". aya ait Stok verileridir."; ?> </div>
<?php } ?>
<?php if($dataStok["Stok"]!=0) { ?>
<div class=small><?php print "Stok";  ?> </div>
<?php } ?>
<div class="topAppear"><h1><span class=count-number><?php print number_format($dataStok["Stok"], 2); ?></span>TL</h1></div>
<h5 style="margin-top:-10px; color:black;"><?php
echo(date("Y",strtotime("-1 year"))."ya göre:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSDG:");
?>
</h5>
<?php if(($dataStok["Stok"] - $dataStokLastYear["Stok"])>0) { ?>
<div class="topAppear"><h3 style="margin-top:-8px; color:lime"><?php print number_format(($dataStok["Stok"] - $dataStokLastYear["Stok"]), 2, ',', '.'); ?></h3> </div>
<div class="topAppear" align="right" style="margin-top:-30px;" ><span class=slight ><i class="fa fa-play fa-rotate-270 text-warning"> </i><?php print round($percentageStok,2); ?></span> </div> 
<?php } ?>
<?php if(($dataStok["Stok"] - $dataStokLastYear["Stok"])<0) { ?>
<div class="topAppear"><h3 style="margin-top:-8px; color:FireBrick;"><?php print number_format(($dataStok["Stok"] - $dataStokLastYear["Stok"]), 2, ',', '.'); ?></h3> </div>
<div align="right" style="margin-top:-30px;" ><span class=slight ><i class="fa fa-play fa-rotate-90 text-warning"> </i><?php print round($percentageStok,2); ?></span> </div> 
<?php } ?> 
<i ><a href="stok"><i class="fa fa-database statistic_icon"> </i></a> </i>
</div>
</div>

<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
<div class="statistic-box statistic-filled-2">
<?php if($kar_tutari==0) { ?>
<div class=small style="color:FireBrick;"><?php print print "Bulunduğumuz ".$dateMonth.". ayına ait bilgi yer almamaktadır. Aşağıdaki veriler ".$dateLastMonth.". aya ait Kar verileridir."; ?> </div>
<?php } ?>
<?php if($kar_tutari!=0) { ?>
<div class=small><?php print "Kar";  ?> </div>
<?php } ?>
<div class="topAppear"><h1><span class=count-number><?php print number_format($kar_tutari,2); ?></span>TL</h1></div>
<h5 style="margin-top:-10px; color:black;"><?php
echo(date("Y",strtotime("-1 year"))."ya göre:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspKar Marjı:");
?>
</h5>
<?php if(($kar_tutari - $kar_tutari_lastYear)>0) { ?>
<div ><h3 style="margin-top:-8px; color:lime"><?php print number_format(($kar_tutari - $kar_tutari_lastYear), 2, ',', '.'); ?></h3> </div>
<div align="right" style="margin-top:-30px;" ><span class=slight ><i class="fa fa-play fa-rotate-270 text-warning"> </i><?php print round($kar_marji,2); ?></span> </div> 
<?php } ?>
<?php if(($kar_tutari - $kar_tutari_lastYear)<0) { ?>
<div ><h3 style="margin-top:-8px; color:FireBrick;"><?php print number_format(($kar_tutari - $kar_tutari_lastYear), 2, ',', '.'); ?></h3> </div>
<div align="right" style="margin-top:-30px;" ><span class=slight ><i class="fa fa-play fa-rotate-90 text-warning"> </i><?php print round($kar_marji,2); ?></span> </div> 
<?php } ?> 
<i class="statistic_icon"><a href="kar"><img src="img/get-money.png" style="width:60px;height:60px;"> </a></i>	
</div>
</div>
<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
<div class="statistic-box statistic-filled-4">
<div class=small>SKU</div>
<div class="topAppear"><h1><span class=count-number><?php print number_format($row_cnt); ?></span>TL</h1></div>
<h5 style="margin-top:-10px; color:black;"><?php
echo("%80 Ciro:"."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspOran:");
?>
</h5>
<div ><h3 style="margin-top:-8px;"><?php print number_format($barcode_number);  ?> </h3> </div>
<div align="right" style="margin-top:-30px;"><span class=slight ><?php print "%".round($ratio,2); ?></span> </div>  
<i class="statistic_icon"><a href="portfoy"><img src="img/products.png" style="width:60px;height:60px;"></a> </i>
</div>
</div>
</div>

<div class=row>
<div class="col-xs-12 col-sm-8 col-md-6 col-lg-10">
<div class="panel panel-bd lobidisable">
<div class=panel-heading> 
<div class=panel-title>
<i >Ciro Gelişimi (TL)</i>
</div>
</div>
<div class=panel-body>
<div id="chartcontainer" >
<div id="chart" style="	width		: 100%; 	height		:  65%; 		font-size	: 11px;	"></div>
</div>

</div>
</div>
</div>
</div>

</div>
</div>
</div>
<script src="assets/plugins/jQuery/jquery-1.12.4.min.js"></script>
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
<script src="assets/plugins/monthly/monthly.min.js"></script>
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

<script>
var dataTest;
 $.ajax({
    url:"loadSeriel",
    method:"POST",
    data:{},
    cache:false,
    success:function(data)
    {
     if(data)
     {
		 var jsonData = JSON.parse(data);
		dataTest = jsonData;
var pie_chart = AmCharts.makeChart("chart",{
  "type"    : "serial",
  "hideCredits":true,
  "theme": "light",
  "categoryField": "month",
	"startDuration": 0,
	"categoryAxis": {
		"gridPosition": "start",
		"autoGridCount": false,
		"gridCount": 12
	},
	"fontSize":9,
	"responsive": {
    "enabled": true
  },
  "legend": {
	   "useGraphSettings": true,
    "position": "top"
  },
	"trendLines": [],
	"graphs": [
		
		{
			"balloonText": "Gecen Sene Ciro :[[value]]",
			"fillAlphas": 0.8,
			"id": "AmGraph-2",
			"lineAlpha": 0.2,
			"title": "Geçen Sene Ciro",
			"type": "column",
			"valueField": "ciroLastYear"
		},{
			"balloonText": "Ciro:[[value]]",
			"fillAlphas": 0.8,
			"id": "AmGraph-1",
			"lineAlpha": 0.2,
			"title": "Ciro",
			"type": "column",
			"valueField": "ciro"
		}
	],
	"guides": [],
	"valueAxes": [
		{
			"id": "ValueAxis-1",
			"position": "top",
			"axisAlpha": 0
		}
	],
	"allLabels": [],
	"balloon": {},
	"titles": [],
    "export": {
    	"enabled": true
     },
"dataProvider": dataTest 
});
}
    
     else
     {
      swal("Failed!", "There is an issue with the database. Information failed to load!", "error");
     }
    }
   });
</script>