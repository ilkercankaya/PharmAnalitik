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
		//Connect urun database
	$connectThree = mysqli_connect('localhost', 'pharmana_general', '123456pharmana', 'pharmana_urun_db');
		 if ( !$connectThree ) {
    die( 'Could not connect: ' . mysqli_error() );
	}
		//Datas Hareket DB
	$connectTwo = mysqli_connect('localhost', 'pharmana_general', '123456pharmana', 'pharmana_Hareket_db');
		 if ( !$connectTwo ) {
    die( 'Could not connect: ' . mysqli_error() );
	}

	//Datas Ciro
	mysqli_set_charset($connectTwo, "utf8"); /* Procedural approach */
	$pharmacy_id = mysqli_real_escape_string($connectThree, $_SESSION["pharmacy_id"]);
	$dateMonth = mysqli_real_escape_string($connectTwo, date("n"));
	$dateYear = mysqli_real_escape_string($connectTwo, date('Y'));
	$dateLastYear = mysqli_real_escape_string($connectTwo, date("Y",strtotime("-1 year")));
	 //Button
 $sqlDataTable = "SELECT Ana_Kategori FROM `general_Table` Where EczaneID = '".$pharmacy_id."'  GROUP BY Ana_Kategori";
$resultDataTableTwo = mysqli_query($connectThree, $sqlDataTable);
$pharmacy_id = mysqli_real_escape_string($connectTwo, $_SESSION["pharmacy_id"]);
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
<title>Kar Analiz - pharmanalitik</title>
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
<li> <a href=""><i class="fa fa-try" aria-hidden="true"  href=ciro></i>Ciro<span class="fa arrow"></span></a> 
<ul class="nav nav-second-level">
<li > <a href="ciro">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ciro Ana sayfa</a>
<li > <a href="ciroAnalitik">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ciro Analiz</a>
</ul>
</li>
<li> <a href=""><img src="img/storage-iconONE.jpg" style="width:20px;height:20px;">  Stok<span class="fa arrow"></span></a>
<ul class="nav nav-second-level">
<li> <a href="stok">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stok Ana sayfa</a>
<li> <a href="stokAnalitik">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stok Analiz</a>
</ul>
</li>
<li class="active"> <a href="kar"><img src="img/get-money.png" style="width:20px;height:20px;">  Kar<span class="fa arrow"></span></a>
<ul class="nav nav-second-level">
<li > <a href="kar">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kar Ana sayfa</a>  </li>
<li class="active"> <a href="karAnaliz">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kar Analiz</a></li>
</ul>
</li>
<li> <a href="portfoy"><img src="img/products.png" style="width:20px;height:20px;">  Ürün Portföyü<span class="fa arrow"></span></a>
<ul class="nav nav-second-level">
<li > <a href="portfoy">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ürün Ana sayfa</a>  </li>
<li> <a href="portfoyAnaliz">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ürün Analiz</a></li>
</ul>
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
<h1> <?php print $data["Eczane_Adi"]; ?> Eczanesi Kar Analiz Göstergeleri.</small></h1>
 <small><?php print $data["Eczane_Adi"]; ?> eczanesi ile kar analiz bilgileri.</small>
<ol class=breadcrumb>
<li><a href=home><i class=pe-7s-home></i> Home</a></li>
<li>Charts</li>
<li>Kar</li>
<li class=active>Kar Analiz</li>
</ol>
</div>

</div>


 <div class="row">
 <div class="modal"></div>

 <div class="panel panel-bd lobidrag">
<div class="btn-group m-b-5" style="margin-left:20px;margin-top:20px;">
	<button id="dropdown_Main_Button-two" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dönem: <?php print date("n",strtotime("-1 month"));?>&nbsp&nbsp<i class="fa fa-play fa-rotate-90"></i></button>
    <ul class="dropdown-menu" style=" z-index: 999;" >
	 <?php 											
	$number = 1;	
	$countToEcho = date("n");
	while ($number<date("n")+1){
	echo '<li><a class="dropdown-link-two">'.'Dönem: '.$number.'</a></li>';	
	 if ($number < $countToEcho)
	{
	echo ' <li class="divider"></li>';	
	}	
	$number++;													   
	}												
	?>		
	</ul>	
 </div>
 <div id="chartcontainer" >
   <div class="alert alert-info" id="curtainpie" style="width		: 15%; margin-left: 15px; ">Chart is loading...</span></div>
<div id="chart" style="	width		: 85%; 	height		:  85%; 	"></div>

</div>

  
	   
                 
						                                    <div class="table-responsive">
                                        <table id="dataTableOne" class="table table-bordered table-striped table-hover">
                                            <thead>
														<th colspan="1"></th>
														<th colspan="3">Kar Tutarı</th>
														<th colspan="3">Kar Marjı</th>
                                                <tr>
                                                    <th><h4> Sıra </h4></th>
                                                    <th><h4>Marka </h4></th>
													<th><h4><?php print date('Y');?> </h4></th>
                                                    <th><h4><?php print date('Y',strtotime("-1 year"));?> </h4></th>			
												    <th><h4><?php print date('Y');?> </h4></th>
                                                    <th><h4><?php print date('Y',strtotime("-1 year"));?> </h4></th>													
                                                </tr>
                                            </thead>
                                         <tbody>                                                                                         
                                         </tbody>
                                        </table>
                                    </div>
				
	
                   
						                                    <div class="table-responsive"	style="margin-top: 15px; ">
                                        <table id="dataTableTwo" class="table table-bordered table-striped table-hover">
                                            <thead>
											            <th colspan="1"></th>
														<th colspan="3">Ürün Kar Tutarları</th>
														<th colspan="3">Kar Marjı</th>
                                                <tr>
                                                    <th><h4> Sıra </h4></th>
                                                    <th><h4>Ürün adı </h4></th>
												    <th><h4><?php print date('Y');?> </h4></th>
                                                    <th><h4><?php print date('Y',strtotime("-1 year"));?> </h4></th>	
													<th><h4><?php print date('Y');?> </h4></th>
                                                    <th><h4><?php print date('Y',strtotime("-1 year"));?> </h4></th>	
													
                                                </tr>
                                            </thead>
                                         <tbody>                                                                                         
                                         </tbody>
                                        </table>
                                    </div>
					
		
		    </div>
</div>
</div>
	</div>
	 	<style>
	.modal {
    display:    none;
    position:   relative;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .8 ) 
                url('http://i.stack.imgur.com/FhHRx.gif') 
                50% 50% 
                no-repeat;
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
</html>

<script>
$body = $("body");

$(document).on({
    ajaxStart: function() { $body.addClass("loading");    },
     ajaxStop: function() { $body.removeClass("loading"); }    
});
function numberFormat(number, decimals, dec_point, thousands_sep)
{
    // http://kevin.vanzonneveld.net/techblog/article/javascript_equivalent_for_phps_number_format/
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec)
        {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3)
    {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec)
    {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

function ajaxCallTableOne(name,nametwo,namethree)
{
	swal({
  title: "Do you want to show information about "+ namethree+" to the table below?",
  text: "Submit to run through database",
  type: "info",
  showCancelButton: true,
  closeOnConfirm: false,
  showLoaderOnConfirm: true
}, function () {
  setTimeout(function () {
	  	$.ajax({
    url:"karAnalitikDrillTableOne",
    method:"POST",
    data:{name:name,nametwo:nametwo,namethree:namethree},
    cache:false,
	async: false,
    success:function(data)
    {
		
     if(data)
     {		
		 var jsonDataTable= JSON.parse(data);

		 for (var i = 0; i < jsonDataTable.length; i++) {
		 tableOne.row.add( [
            jsonDataTable[i].Sira,
			jsonDataTable[i].Markasi,
			numberFormat(jsonDataTable[i].KarThisYear,2),
			numberFormat(jsonDataTable[i].KarLastYear,2),
			numberFormat(jsonDataTable[i].KarMarjiThisYear,2)+ ' %',
			numberFormat(jsonDataTable[i].KarMarjiLastYear,2)+ ' %' ]
         ).draw( false );
     }
	 }
  
     else
     {
      swal("Failed!", "There is an issue with the database. Information failed to load!", "error");
     }
	 		 if(jsonDataTable.length==0)
	  tableOne.clear().draw();
    }
   });
    swal("Table loading finished!","", "success");
  }, 1000);
});


}
	


$('body').delegate('#dataTableOne tbody tr', 'click', function () {
    var data = tableOne.row( this ).data();
      var nametwo = data[1];
	   var name = $('#dropdown_Main_Button-two').text();
 name = name.substring(0, name.length - 2);	 
   tableTwo.clear().draw();
   	swal({
  title: "Do you want to show information about "+ data[1]+" to the table below?",
  text: "Submit to run through database",
  type: "info",
  showCancelButton: true,
  closeOnConfirm: false,
  showLoaderOnConfirm: true
}, function () {
  setTimeout(function () {
	$.ajax({
    url:"karAnalitikDrillTableTwo",
    method:"POST",
    data:{name:name,nametwo:nametwo},
    cache:false,
	async: false,
    success:function(data)
    {
		
     if(data)
     {		
		 var jsonDataTable= JSON.parse(data);
		 for (var i = 0; i < jsonDataTable.length; i++) {
		 tableTwo.row.add( [
            jsonDataTable[i].Sira,
			jsonDataTable[i].Urun_Adi,
			numberFormat(jsonDataTable[i].Kar_Tutari,2),
			numberFormat(jsonDataTable[i].Kar_Tutari_Last_Year,2),
			numberFormat(jsonDataTable[i].Kar_Marji,2)+ ' %',
			numberFormat(jsonDataTable[i].Kar_Marji_Last_Year,2)+ ' %' 		]
         ).draw( false );
     }
	 }
  
     else
     {
      swal("Failed!", "There is an issue with the database. Information failed to load!", "error");
     }
	 		 if(jsonDataTable.length==0)
	  tableTwo.clear().draw();
    }
   });
    swal("Table loading finished!","", "success");
  }, 1000);
});

	   
});

	
//CHART
AmCharts.addInitHandler(function(chart) {
  
  // check if data is mepty
  if (chart.dataProvider === undefined || chart.dataProvider.length === 0) {
    // add some bogus data
    var dp = {};
    dp[chart.titleField] = "";
    dp[chart.valueField] = 1;
    chart.dataProvider.push(dp)
    
    var dp = {};
    dp[chart.titleField] = "";
    dp[chart.valueField] = 1;
    chart.dataProvider.push(dp)
    
    var dp = {};
    dp[chart.titleField] = "";
    dp[chart.valueField] = 1;
    chart.dataProvider.push(dp)
    
    // disable slice labels
    chart.labelsEnabled = false;
    
    // add label to let users know the chart is empty
    chart.addLabel("50%", "50%", "The chart contains no data", "middle", 15);
    
    // dim the whole chart
    chart.alpha = 0.3;
  }
  
}, ["pie"]);

var chart ;
var jsonData;
var tableOne;
 var tableTwo;
$(document).ready(function() { 

tableOne = $('#dataTableOne').DataTable();
$("#dataTableTwo").append('<tfoot><th></th><th></th><th></th><th></th></tfoot>');
tableTwo = $('#dataTableTwo').DataTable({
  "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 2, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 2 ).footer() ).html(
                numberFormat( pageTotal,2) +' ('+ numberFormat(total,2) +' total)'
            );
			
			total = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 3 ).footer() ).html(
                 numberFormat( pageTotal,2) +' ('+ numberFormat(total,2) +' total)'
            );
			$( api.column( 1 ).footer() ).html(
                'TOPLAM'			
            );
			$( api.column( 0 ).footer() ).html(
                '#'
				
            );
        }
    } );
	 tableOne.on( 'order.dt search.dt', function () {
        tableOne.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
	tableTwo.on( 'order.dt search.dt', function () {
        tableTwo.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
 var name = $('#dropdown_Main_Button-two').text();
 name = name.substring(0, name.length - 2);	 
		   $.ajax({
    url:"karAnalitikDrillDownPieLoader",
    method:"POST",
    data:{name:name},
    cache:false,
	async: false,
    success:function(data)
    {
     if(data)
     {		
		  jsonData= JSON.parse(data);
		  
     }
     else
     {
      swal("Failed!", "There is an issue with the database. Information failed to load!", "error");
     }
    }
   });
   //İnitial chart
   var chart  = AmCharts.makeChart("chart",{
 "type": "pie",
  "hideCredits":true,
  "dataProvider": jsonData,
  "valueField": "value",
  "titleField": "title",
  "labelText": "[[title]]: [[value]]",
  "pullOutOnlyOne": true,
  "titles": [{
    "text": "Ana Kategori"
  }],
  "allLabels": [],
  	"listeners": [{
    "event": "rendered",
    "method": function(e) {
      var curtain = document.getElementById("curtainpie");
      curtain.parentNode.removeChild(curtain);
    }
  }],  "legend": {
	   "useGraphSettings": true,
    "position": "bottom"
  }
},2000);

// initialize step array
chart.drillLevels = [{
  "title": "Ana Kategori",
  "data": jsonData
}];
// add slice click handler
chart.addListener("clickSlice", function (event) {
  
  // get chart object
  var chart = event.chart;
  
  // check if drill-down data is avaliable
  if (event.dataItem.dataContext.data !== undefined) {
    // save for back button
    chart.drillLevels.push(event.dataItem.dataContext);
    
    // replace data
    chart.dataProvider = event.dataItem.dataContext.data;
    
    // replace title
    chart.titles[0].text = event.dataItem.dataContext.title;
    function drillUp() {
  
  // get level
  chart.drillLevels.pop();
  var level = chart.drillLevels[chart.drillLevels.length - 1];
  
  // replace data
  chart.dataProvider = level.data;

  // replace title
  chart.titles[0].text = level.title;
  
  // remove labels
  if (chart.drillLevels.length === 1)
    chart.clearLabels();
  
  // take in data and animate
  chart.validateData();
  chart.animateAgain();
}
    // add back link
    // let's add a label to go back to yearly data
    event.chart.addLabel(
      0, 25, 
      "< Go back",
      undefined, 
      undefined, 
      undefined, 
      undefined, 
      undefined, 
      undefined, 
      'javascript:drillUp();');
    
    // take in data and animate
    chart.validateData();
    chart.animateAgain();
  }
  else{//No-drill -> Alt-Kategori
      //Table One call
	   tableOne.clear().draw();
	    tableTwo.clear().draw();
	 var name = $('#dropdown_Main_Button-two').text();
     name = name.substring(0, name.length - 2);	 
	var nametwo = event.dataItem.dataContext.title;
	 var level = chart.drillLevels[chart.drillLevels.length - 1];
	ajaxCallTableOne(name,level.title,nametwo);
	
  }
});
drillUp = function()  {
  
  // get level
  chart.drillLevels.pop();
  var level = chart.drillLevels[chart.drillLevels.length - 1];
  
  // replace data
  chart.dataProvider = level.data;

  // replace title
  chart.titles[0].text = level.title;
  
  // remove labels
  if (chart.drillLevels.length === 1)
    chart.clearLabels();
  
  // take in data and animate
  chart.validateData();
  chart.animateAgain();
}

 $(document).on('click','.dropdown-link-two',function(event){
	"use strict"; // Start of use strict
  event.preventDefault();
  var $this = $(this);
  var name = $this.text();
  document.getElementById("dropdown_Main_Button-two").innerHTML = name +'&nbsp&nbsp<i class="fa fa-play fa-rotate-360"></i>'; 
chart.clear();
  $.ajax({
    url:"karAnalitikDrillDownPieLoader",
    method:"POST",
    data:{name:name},
    cache:false,
	async: false,
    success:function(data)
    {
     if(data)
     {		 
		  jsonData= JSON.parse(data);
		  var div = document.createElement("div");
		  div.id="curtainpie";
		 div.className ="alert alert-info";
		    div.style.width="15%";
			div.style.marginLeft="15px";
		  div.innerHTML = "Chart is loading...";
		 document.getElementById("chartcontainer").insertBefore(div,document.getElementById("chartcontainer").childNodes[0]);
     }
     else
     {
      swal("Failed!", "There is an issue with the database. Information failed to load!", "error");
     }
    }
   });
 chart  = AmCharts.makeChart("chart",{
 "type": "pie",
  "hideCredits":true,
  "dataProvider": jsonData,
  "valueField": "value",
  "titleField": "title",
  "labelText": "[[title]]: [[value]]",
  "pullOutOnlyOne": true,
  "titles": [{
    "text": "Ana Kategori"
  }],
  "allLabels": [],
  	"listeners": [{
    "event": "rendered",
    "method": function(e) {
      var curtain = document.getElementById("curtainpie");
      curtain.parentElement.removeChild(curtain);
    }
  }],  "legend": {
	   "useGraphSettings": true,
    "position": "bottom"
  }
},2000);

// initialize step array
chart.drillLevels = [{
  "title": "Ana Kategori",
  "data": jsonData
}];
// add slice click handler
chart.addListener("clickSlice", function (event) {
  
  // get chart object
  var chart = event.chart;
  
  // check if drill-down data is avaliable
  if (event.dataItem.dataContext.data !== undefined) {
    
    // save for back button
    chart.drillLevels.push(event.dataItem.dataContext);
    
    // replace data
    chart.dataProvider = event.dataItem.dataContext.data;
    
    // replace title
    chart.titles[0].text = event.dataItem.dataContext.title;
    function drillUp() {
  
  // get level
  chart.drillLevels.pop();
  var level = chart.drillLevels[chart.drillLevels.length - 1];
  
  // replace data
  chart.dataProvider = level.data;

  // replace title
  chart.titles[0].text = level.title;
  
  // remove labels
  if (chart.drillLevels.length === 1)
    chart.clearLabels();
  
  // take in data and animate
  chart.validateData();
  chart.animateAgain();
}
    // add back link
    // let's add a label to go back to yearly data
    event.chart.addLabel(
      0, 25, 
      "< Go back",
      undefined, 
      undefined, 
      undefined, 
      undefined, 
      undefined, 
      undefined, 
      'javascript:drillUp();');
    
    // take in data and animate
    chart.validateData();
    chart.animateAgain();
  }
    else{//No-drill -> Alt-Kategori
      //Table One call
	   tableOne.clear().draw();
	   tableTwo.clear().draw();
	 var name = $('#dropdown_Main_Button-two').text();
     name = name.substring(0, name.length - 2);	 
	var nametwo = event.dataItem.dataContext.title;
	 var level = chart.drillLevels[chart.drillLevels.length - 1];
	ajaxCallTableOne(name,level.title,nametwo);
	
  }
});
   
 
 
});  
   } );
   
  
</script>