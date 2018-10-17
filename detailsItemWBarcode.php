<?php
//detailsItemWBarcode.php
session_start();
if(isset($_SESSION["admin"]))
{
		error_reporting( 0 );
	$connect = mysqli_connect('localhost', 'pharmana_general', '123456pharmana', 'pharmana_urun_db');
	 if ( !$connect ) {
    die( 'Could not connect: ' . mysqli_error() );
	}
	 mysqli_set_charset($connect, "utf8"); /* Procedural approach */
	$barcode = mysqli_real_escape_string($connect, $_SESSION["admin"]);
	$sql = "SELECT * FROM general_Table WHERE Barkod = '".$barcode."' ";
	$result = mysqli_query($connect, $sql);
    $data = mysqli_fetch_assoc($result);
		 mysqli_close( $connect );
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
        <title>Item Detail - Pharmanalitik</title>

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

            <div class="container-center">
                <div class="panel panel-bd">
                    <div class="panel-heading">
                        <div class="view-header">
                            <div class="header-icon">
								<i class="pe-7s-notebook"></i>
                            </div>
                            <div class="header-title">
                                <h3>Details of item - Pharmanalitik</h3>
                                <small><strong>Information of the item from pharmanalitik.</strong></small>
                            </div>
                        </div>
                    </div>
                                <div class="card-content">
                                    <div class="card-content-member">
                                        <h4 class="m-t-0"><?php print $data["Barkod"];    ?></h4>
                                    </div>
                                    <div class="card-content-languages">
                                        <div class="card-content-languages-group">
                                            <div>
                                                <h4>Urun Adi:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <div class="fluency fluency-4"><?php print $data["Urun_Adi"];    ?></div>
                                                    </li>
                                                </ul>
                                            </div>
										</div>
										<div class="card-content-languages-group">
										    <div>
                                                <h4>Ana Kategori:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <div class="fluency fluency-4"><?php print $data["Ana_Kategori"];  ?></div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>	
										<div class="card-content-languages-group">
										    <div>
                                                <h4>Kategori:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <div class="fluency fluency-4"><?php print $data["Kategori"];    ?></div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>										
										<div class="card-content-languages-group">
										    <div>
                                                <h4>Grup:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <div class="fluency fluency-4"><?php print $data["Grup"]; ?></div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>		
										<div class="card-content-languages-group">
										    <div>
                                                <h4>AltGrup:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <div class="fluency fluency-4"><?php print $data["AltGrup"]; ?></div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>			
										<div class="card-content-languages-group">
										    <div>
                                                <h4>Bolum:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <div class="fluency fluency-4"><?php print $data["Bolum"]; ?></div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>													
										<div class="card-content-languages-group">
										    <div>
                                                <h4>AltBolum:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <div class="fluency fluency-4"><?php print $data["AltBolum"]; ?></div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>				
										<div class="card-content-languages-group">
										    <div>
                                                <h4>Markasi:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <div class="fluency fluency-4"><?php print $data["Markasi"]; ?></div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>		
										<div class="card-content-languages-group">
										    <div>
                                                <h4>Ureticisi:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <div class="fluency fluency-4"><?php print $data["Ureticisi"]; ?></div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
										<div class="card-content-languages-group">
										    <div>
                                                <h4>Ithalatci:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <div class="fluency fluency-4"><?php print $data["Ithalatci"]; ?></div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
										<div class="card-content-languages-group">
										    <div>
                                                <h4>Ozel Kodu:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <div class="fluency fluency-4"><?php print $data["Ozel_Kodu"]; ?></div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
										<div class="card-content-languages-group">
										    <div>
                                                <h4>I Grubu:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <div class="fluency fluency-4"><?php print $data["I_Grubu"]; ?></div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
										<div class="card-content-languages-group">
										    <div>
                                                <h4>Reyonu:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <div class="fluency fluency-4"><?php print $data["Reyonu"]; ?></div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
										<div class="card-content-languages-group">
										    <div>
                                                <h4>Icerik:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <div class="fluency fluency-4"><?php print $data["Icerik"]; ?></div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>										<div class="card-content-languages-group">
										    <div>
                                                <h4>Icerik Miktar:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <div class="fluency fluency-4"><?php print $data["Icerik_Miktar"]; ?></div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
										<div class="card-content-languages-group">
										    <div>
                                                <h4>Birim:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <div class="fluency fluency-4"><?php print $data["Birim"]; ?></div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
										<div class="card-content-languages-group">
										    <div>
                                                <h4>Paket ici Miktar:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <div class="fluency fluency-4"><?php print $data["Paket_ici_Miktar"]; ?></div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
										<div class="card-content-languages-group">
										    <div>
                                                <h4>Paket ici Birim:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <div class="fluency fluency-4"><?php print $data["Paket_ici_Birim"]; ?></div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
										<div class="card-content-languages-group">
										    <div>
                                                <h4>Paket Barkod:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <div class="fluency fluency-4"><?php print $data["Paket_Barkod"]; ?></div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
										<div class="card-content-languages-group">
										    <div>
                                                <h4>Koli ici Miktar:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <div class="fluency fluency-4"><?php print $data["Koli_ici_Miktar"]; ?></div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>	
										<div class="card-content-languages-group">
										    <div>
                                                <h4>Koli ici Birim:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <div class="fluency fluency-4"><?php print $data["Koli_ici_Birim"]; ?></div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>	
										<div class="card-content-languages-group">
										    <div>
                                                <h4>Koli Barkod:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <div class="fluency fluency-4"><?php print $data["Koli_Barkod"]; ?></div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>	
										<div class="card-content-languages-group">
										    <div>
                                                <h4>Genislik:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <div class="fluency fluency-4"><?php print $data["Genislik"]; ?></div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>	
										<div class="card-content-languages-group">
										    <div>
                                                <h4>Yukseklik:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <div class="fluency fluency-4"><?php print $data["Yukseklik"]; ?></div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>	
										<div class="card-content-languages-group">
										    <div>
                                                <h4>Derinlik:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <div class="fluency fluency-4"><?php print $data["Derinlik"]; ?></div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>	
										<div class="card-content-languages-group">
										    <div>
                                                <h4>On Resim:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <div class="fluency fluency-4"><?php print $data["On_Resim"]; ?></div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>	
										<div class="card-content-languages-group">
										    <div>
                                                <h4>Sol Resim:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <div class="fluency fluency-4"><?php print $data["Sol_Resim"]; ?></div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>	
										<div class="card-content-languages-group">
										    <div>
                                                <h4>Ust Resim:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <div class="fluency fluency-4"><?php print $data["Ust_Resim"]; ?></div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>	
										<div class="card-content-languages-group">
										    <div>
                                                <h4>Sag Resim:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <div class="fluency fluency-4"><?php print $data["Sag_Resim"]; ?></div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>			
										<div class="form-group">
										<p align="right">
											<input type="button" onclick="window.location='editItem'" class="btn btn-primary btn-md" value="Edit Item" />
										    <input type="button" onclick="window.location='BarcodeCheck'" class="btn btn-danger" value="Cancel" />	
										</p>
										
																			
													<div class="form-group">
													<style>
													#space { margin-top: 15px; }														
													a {
														color: SteelBlue;
															}
													</style>
													 <div class="card-content-member">	</div>	
													 <div id="space"></div>
													<a href="AdminRegisterPage">Click Here To Return To Register Page.</a>																								
										
												    <div class="card-content-member"></div>  
																							
																											</div>	
																							<p align="right">
											<input type="button" onclick="window.location='logoutAdmin'" class="btn btn-primary btn-sm" value="Logout" />
										</p>
										
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
   $('#cancel').click(function(){
 window.location = "BarcodeCheck";
		});
 
 
  $('#logout').click(function(){
	   window.location = "logoutAdmin";
   });
});
</script>