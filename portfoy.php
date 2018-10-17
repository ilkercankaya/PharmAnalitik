<?php
//stok.php
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
//Button
 $sqlDataTable = "SELECT Ana_Kategori FROM `general_Table` Where EczaneID = '".$pharmacy_id."'  GROUP BY Ana_Kategori";
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
<title>Ürün Ana Sayfa - pharmanalitik</title>
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
<li > <a href="ciro">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ciro Ana sayfa</a></li>
<li > <a href="ciroAnalitik">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ciro Analiz</a> </li>
</ul>
</li>
<li > <a href=""><img src="img/storage-iconONE.jpg" style="width:20px;height:20px;">  Stok<span class="fa arrow"></span></a>
<ul class="nav nav-second-level">
<li > <a href="stok">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stok Ana sayfa</a> </li>
<li> <a href="stokAnalitik">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stok Analiz</a> </li>
</ul>
</li>
<li> <a href="kar"><img src="img/get-money.png" style="width:20px;height:20px;">  Kar<span class="fa arrow"></span></a>
<ul class="nav nav-second-level">
<li > <a href="kar">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kar Ana sayfa</a>  </li>
<li> <a href="karAnaliz">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kar Analiz</a></li>
</ul>
</li>
<li class="active"> <a href="portfoy"><img src="img/products.png" style="width:20px;height:20px;">  Ürün Portföyü<span class="fa arrow"></span></a>
<ul class="nav nav-second-level">
<li class="active"> <a href="portfoy">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ürün Ana sayfa</a>  </li>
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
<h1> <?php print $data["Eczane_Adi"]; ?> Eczanesi Ürün Sonuç Göstergeleri.</small></h1>
 <small><?php print $data["Eczane_Adi"]; ?> eczanesi ile ilgili ürün bilgileri.</small>
<ol class=breadcrumb>
<li><a href=home><i class=pe-7s-home></i> Home</a></li>
<li>Charts</li>
<li>Ürün</li>
<li class=active>Ürün Ana Sayfa</li>
</ol>
</div>

</div>


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
										 <div class="row" align="center">
	                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3" style ="margin: auto; margin-top:20px;" align="center">
                            <div class="statistic-box statistic-filled-1 ">
                                <h2 id="totalUrun"> </h2>
                                <div class="small">Stoklu Ürün Sayısı</div>
                            </div>
                        </div>
						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3" style ="margin: auto; margin-top:20px;" align="center">
                            <div class="statistic-box statistic-filled-2 ">
                                <h2 id="hareketli"> </h2>
                                <div class="small">Hareketli Ürün Sayısı</div>
                            </div>
                        </div>
						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3" style ="margin: auto; margin-top:20px;" align="center">
                            <div class="statistic-box statistic-filled-3 ">
                                <h2 id="hareketsiz"> </h2>
                                <div class="small">Hareketsiz Ürün Sayısı</div>
                            </div>
                        </div>
						                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3" style ="margin: auto; margin-top:20px;" align="center">
                            <div class="statistic-box statistic-filled-4 ">
                                 <h2 id="hareketsizStok"> </h2>
                                <div class="small">Hareketsiz Ürün Stoğu</div>
                            </div>
                        </div>
							</div>

         <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>TOP 100 Ürün Sıralaması</h4>
                                    </div>
                                </div>
	   
                 
						                                    <div class="table-responsive">
                                        <table id="dataTableQuat" class="table table-bordered table-striped table-hover">
                                            <thead>
											   <th colspan="1"></th>
											  <th colspan="1">Ürün Satişları </th>
											  <th colspan="2">Ciro </th>
											  <th colspan="2">Miktar </th>
                                                <tr>
                                                    <th><h4> Sıra </h4></th>
                                                    <th><h4>Marka </h4></th>
												    <th><h4><?php print date('Y');?> </h4></th>
                                                    <th><h4><?php print date('Y',strtotime("-1 year"));?> </h4></th>		
													<th><h4><?php print date('Y');?> </h4></th>
                                                    <th><h4><?php print date('Y',strtotime("-1 year"));?> </h4></th>			
													<th><h4><?php print "Ciro Payı";?> </h4></th>                                                  													
                                                </tr>
                                            </thead>
                                         <tbody>                                                                                         
                                         </tbody>
                                        </table>
                                    </div>
								
										 <div class="row" align="center">
	                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3" style ="margin: auto; margin-top:20px;" align="center">
                            <div class="statistic-box statistic-filled-1 outline">
                                <h2 id="ciroCurYear"> </h2>
                                <div class="small">TOP 100 ürün Ciro Payı</div>
                            </div>
                        </div>
						                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3" style ="margin: auto; margin-top:20px;" align="center">
                            <div class="statistic-box statistic-filled-3 outline">
                                 <h2 id="ciroLastYear"> </h2>
                                <div class="small">Geçen Yıl TOP 100 ürün Ciro Payı</div>
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


<script>

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
$body = $("body");
var topHundred;
$(document).on({
    ajaxStart: function() { $body.addClass("loading");    },
     ajaxStop: function() { $body.removeClass("loading"); }    
});
$(document).ready(function() { 
 $('html').animate({scrollTop:0}, 1);
    $('body').animate({scrollTop:0}, 1);
$("#dataTableQuat").append('<tfoot><th></th> <th></th> <th></th> <th></th> <th></th> <th></th></tfoot>');
var dt = $('#dataTableQuat').DataTable({
    processing: true,
    'language':{ 
       "loadingRecords": "&nbsp;",
       "processing": "Loading..."
    },
	"footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };			
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
               numberFormat(pageTotal,2) +' ('+ numberFormat(total,2) +' total)'
            );
			$( api.column( 1 ).footer() ).html(
                'TOPLAM'			
            );
			$( api.column( 0 ).footer() ).html(
                '#'		
            );
			   // Total over all pages
            total = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 5 ).footer() ).html(
               numberFormat( pageTotal,2) +' ('+ numberFormat(total,2) +' total)'
            );
			 // Total over all pages
            total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
               numberFormat( pageTotal,2) +' ('+ numberFormat(total,2) +' total)'
            );
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
			topHundred = total;
        }
  });
 //DEFAULT UP BOXES
 var button_text = $('#dropdown_Main_Button-two').text();	
	button_text = button_text.substring(0, button_text.length - 2);	
 $.ajax({
    url:"portfoyBoxesLoader",
    method:"POST",
    data:{name:button_text},
    cache:false,
    success:function(data)
    {
     if(data)
     {
		 var jsonData = JSON.parse(data);	
		 document.getElementById("totalUrun").innerHTML = numberFormat(jsonData[0].UrunSayısı,2)+ " Çeşit";
		 document.getElementById("hareketli").innerHTML = numberFormat(jsonData[0].HareketliUrunSayısı,2)+ " Çeşit";
		 document.getElementById("hareketsiz").innerHTML = numberFormat(jsonData[0].HareketsizUrunSayısı,2)+ " Çeşit";
		 document.getElementById("hareketsizStok").innerHTML = numberFormat(jsonData[0].HareketsizUrunStogu,2)+ " TL";
     }
     else
     {
      swal("Failed!", "There is an issue with the database. Information failed to load!", "error");
     }
    }
   });
 //DEFAULT TABLE ONE 
	      $.ajax({
    url:"portfoyAnaSayfaLoader",
    method:"POST",
    data:{name:button_text},
    cache:false,
    success:function(data)
    {
     if(data)
     {
		 var jsonData = JSON.parse(data);
for (var i = 0; i < jsonData.length; i++) {
	
    dt.row.add( [
            jsonData[i].Sira,
			jsonData[i].Urun_Adi,
			numberFormat(jsonData[i].CiroThisYear,2),
			numberFormat(jsonData[i].CiroLastYear,2),
			numberFormat(jsonData[i].Bakiye,2),
			numberFormat(jsonData[i].BakiyeLastYear,2),
			numberFormat(jsonData[i].perc,2) ]
         ).draw( false );

}
		 if(jsonData.length==0)
	  dt.clear().draw();
     }
     else
     {
      swal("Failed!", "There is an issue with the database. Information failed to load!", "error");
     }
    }
   }).then(function(result1) {
    // make 2nd ajax call when the first has completed
    return $.ajax({
    url:"portfoyPercHundred",
    method:"POST",
    data:{name:button_text},
    cache:false,
    success:function(data)
    {
     if(data)
     {
		 var jsonData = JSON.parse(data);	
		 var ciroCurYear =  (topHundred/ jsonData[0].TotCiroThisYear)*100;
		 var ciroLastYear =  (topHundred/ jsonData[0].TotCiroLastYear)*100;
		 document.getElementById("ciroCurYear").innerHTML = "%"+numberFormat(ciroCurYear,2);
		 document.getElementById("ciroLastYear").innerHTML = "%"+numberFormat(ciroLastYear,2);
     }
     else
     {
      swal("Failed!", "There is an issue with the database. Information failed to load!", "error");
     }
    }
   });
}).then(function(result2) {
    // success of both ajax calls here
}, function(err) {
     swal("Failed!", "There is an issue with the database. Information failed to load!", "error");  
});


  
 $(document).on('click','.dropdown-link-two',function(event){
	"use strict"; // Start of use strict
  event.preventDefault();
  var $this = $(this);
  var name = $this.text();
  document.getElementById("dropdown_Main_Button-two").innerHTML = name +'&nbsp&nbsp<i class="fa fa-play fa-rotate-270"></i>'; 

  dt.clear();
  //AJAX
 //DEFAULT UP BOXES
 var button_text = $('#dropdown_Main_Button-two').text();	
	button_text = button_text.substring(0, button_text.length - 2);	
 $.ajax({
    url:"portfoyBoxesLoader",
    method:"POST",
    data:{name:button_text},
    cache:false,
    success:function(data)
    {
     if(data)
     {
		 var jsonData = JSON.parse(data);	
		 document.getElementById("totalUrun").innerHTML = numberFormat(jsonData[0].UrunSayısı,2)+ " Çeşit";
		 document.getElementById("hareketli").innerHTML = numberFormat(jsonData[0].HareketliUrunSayısı,2)+ " Çeşit";
		 document.getElementById("hareketsiz").innerHTML = numberFormat(jsonData[0].HareketsizUrunSayısı,2)+ " Çeşit";
		 document.getElementById("hareketsizStok").innerHTML = numberFormat(jsonData[0].HareketsizUrunStogu,2)+ " TL";
     }
     else
     {
      swal("Failed!", "There is an issue with the database. Information failed to load!", "error");
     }
    }
   });
 //DEFAULT TABLE ONE 
	      $.ajax({
    url:"portfoyAnaSayfaLoader",
    method:"POST",
    data:{name:button_text},
    cache:false,
    success:function(data)
    {
     if(data)
     {
		 var jsonData = JSON.parse(data);
for (var i = 0; i < jsonData.length; i++) {
	
    dt.row.add( [
            jsonData[i].Sira,
			jsonData[i].Urun_Adi,
			numberFormat(jsonData[i].CiroThisYear,2),
			numberFormat(jsonData[i].CiroLastYear,2),
			numberFormat(jsonData[i].Bakiye,2),
			numberFormat(jsonData[i].BakiyeLastYear,2),
			numberFormat(jsonData[i].perc,2) ]
         ).draw( false );

}
		 if(jsonData.length==0)
	  dt.clear().draw();
     }
     else
     {
      swal("Failed!", "There is an issue with the database. Information failed to load!", "error");
     }
    }
   }).then(function(result1) {
    // make 2nd ajax call when the first has completed
    return $.ajax({
    url:"portfoyPercHundred",
    method:"POST",
    data:{name:button_text},
    cache:false,
    success:function(data)
    {
     if(data)
     {
		 var jsonData = JSON.parse(data);	
		 var ciroCurYear =  (topHundred/ jsonData[0].TotCiroThisYear)*100;
		 var ciroLastYear =  (topHundred/ jsonData[0].TotCiroLastYear)*100;
		 document.getElementById("ciroCurYear").innerHTML = "%"+numberFormat(ciroCurYear,2);
		 document.getElementById("ciroLastYear").innerHTML = "%"+numberFormat(ciroLastYear,2);
     }
     else
     {
      swal("Failed!", "There is an issue with the database. Information failed to load!", "error");
     }
    }
   });
}).then(function(result2) {
    // success of both ajax calls here
}, function(err) {
     swal("Failed!", "There is an issue with the database. Information failed to load!", "error");  
});



  
   } );

} );
</script>