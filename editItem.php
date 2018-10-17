<?php
//editItem.php
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
        <title>Edit Item - Pharmanalitik</title>

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
		<link href="assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
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
								<i class="pe-7s-note"></i>
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
									 <form method="post accept-charset="utf-8">
                                        <div class="card-content-languages-group">
                                            <div>
                                                <h4>Urun Adi:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
                                                                <div class="input-group">
																<input id="Urun_Adi" type="text" class="form-control" name="name" value="<?php print  $data["Urun_Adi"];?>" placeholder="<?php print  $data["Urun_Adi"];?>">
																</div>
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
                                                        <div class="input-group">
														<input id="Ana_Kategori" type="text" class="form-control" name="name" value="<?php print  $data["Ana_Kategori"];?>" placeholder="<?php print  $data["Ana_Kategori"];?>">
														</div>
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
                                                         <div class="input-group">
														<input id="Kategori" type="text" class="form-control" name="name" value="<?php print  $data["Kategori"];?>" placeholder="<?php print  $data["Kategori"];?>">
														</div>
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
                                                         <div class="input-group">
														<input id="Grup" type="text" class="form-control" name="name" value="<?php print  $data["Grup"];?>" placeholder="<?php print  $data["Grup"];?>">
														</div>
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
                                                        <div class="input-group">
														<input id="AltGrup" type="text" class="form-control" name="name" value="<?php print  $data["AltGrup"];?>" placeholder="<?php print  $data["AltGrup"];?>">
														</div>
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
                                                        <div class="input-group">
														<input id="Bolum" type="text" class="form-control" name="name" value="<?php print  $data["Bolum"];?>" placeholder="<?php print  $data["Bolum"];?>">
														</div>
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
                                                        <div class="input-group">
														<input id="AltBolum" type="text" class="form-control" name="name" value="<?php print  $data["AltBolum"];?>" placeholder="<?php print  $data["AltBolum"];?>">
														</div>
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
                                                         <div class="input-group">
														<input id="Markasi" type="text" class="form-control" name="name" value="<?php print  $data["Markasi"];?>" placeholder="<?php print  $data["Markasi"];?>">
														</div>
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
                                                        <div class="input-group">
														<input id="Ureticisi" type="text" class="form-control" name="name" value="<?php print  $data["Ureticisi"];?>" placeholder="<?php print  $data["Ureticisi"];?>">
														</div>
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
                                                       <div class="input-group">
														<input id="Ithalatci" type="text" class="form-control" name="name" value="<?php print  $data["Ithalatci"];?>" placeholder="<?php print  $data["Ithalatci"];?>">
														</div>
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
                                                         <div class="input-group">
														<input id="Ozel_Kodu" type="text" class="form-control" name="name" value="<?php print  $data["Ozel_Kodu"];?>" placeholder="<?php print  $data["Ozel_Kodu"];?>">
														</div>
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
                                                        <div class="input-group">
														<input id="I_Grubu" type="text" class="form-control" name="name" value="<?php print  $data["I_Grubu"];?>" placeholder="<?php print  $data["I_Grubu"];?>">
														</div>
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
                                                        <div class="input-group">
														<input id="Reyonu" type="text" class="form-control" name="name" value="<?php print  $data["Reyonu"];?>" placeholder="<?php print  $data["Reyonu"];?>">
														</div>
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
                                                        <div class="input-group">
														<input id="Icerik" type="text" class="form-control" name="name" value="<?php print  $data["Icerik"];?>" placeholder="<?php print  $data["Icerik"];?>">
														</div>
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
                                                        <div class="input-group">
														<input id="Icerik_Miktar" type="text" class="form-control" name="name" value="<?php print  $data["Icerik_Miktar"];?>" placeholder="<?php print  $data["Icerik_Miktar"];?>">
														</div>
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
                                                        <div class="input-group">
														<input id="Birim" type="text" class="form-control" name="name" value="<?php print  $data["Birim"];?>" placeholder="<?php print  $data["Birim"];?>">
														</div>
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
                                                        <div class="input-group">
														<input id="Paket_ici_Miktar" type="text" class="form-control" name="name" value="<?php print  $data["Paket_ici_Miktar"];?>" placeholder="<?php print  $data["Paket_ici_Miktar"];?>">
														</div>
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
                                                        <div class="input-group">
														<input id="Paket_ici_Birim" type="text" class="form-control" name="name" value="<?php print  $data["Paket_ici_Birim"];?>" placeholder="<?php print  $data["Paket_ici_Birim"];?>">
														</div>
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
                                                        <div class="input-group">
														<input id="Paket_Barkod" type="text" class="form-control" name="name" value="<?php print  $data["Paket_Barkod"];?>" placeholder="<?php print  $data["Paket_Barkod"];?>">
														</div>
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
                                                        <div class="input-group">
														<input id="Koli_ici_Miktar" type="text" class="form-control" name="name" value="<?php print  $data["Koli_ici_Miktar"];?>" placeholder="<?php print  $data["Koli_ici_Miktar"];?>">
														</div>
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
                                                        <div class="input-group">
														<input id="Koli_ici_Birim" type="text" class="form-control" name="name" value="<?php print  $data["Koli_ici_Birim"];?>" placeholder="<?php print  $data["Koli_ici_Birim"];?>">
														</div>
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
                                                        <div class="input-group">
														<input id="Koli_Barkod" type="text" class="form-control" name="name" value="<?php print  $data["Koli_Barkod"];?>" placeholder="<?php print  $data["Koli_Barkod"];?>">
														</div>
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
                                                        <div class="input-group">
														<input id="Genislik" type="text" class="form-control" name="name" value="<?php print  $data["Genislik"];?>" placeholder="<?php print  $data["Genislik"];?>">
														</div>
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
                                                        <div class="input-group">
														<input id="Yukseklik" type="text" class="form-control" name="name" value="<?php print  $data["Yukseklik"];?>" placeholder="<?php print  $data["Yukseklik"];?>">
														</div>
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
                                                        <div class="input-group">
														<input id="Derinlik" type="text" class="form-control" name="name" value="<?php print  $data["Derinlik"];?>" placeholder="<?php print  $data["Derinlik"];?>">
														</div>
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
                                                        <div class="input-group">
														<input id="On_Resim" type="text" class="form-control" name="name" value="<?php print  $data["On_Resim"];?>" placeholder="<?php print  $data["On_Resim"];?>">
														</div>
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
                                                       <div class="input-group">
														<input id="Sol_Resim" type="text" class="form-control" name="name" value="<?php print  $data["Sol_Resim"];?>" placeholder="<?php print  $data["Sol_Resim"];?>">
														</div>
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
                                                        <div class="input-group">
														<input id="Ust_Resim" type="text" class="form-control" name="name" value="<?php print  $data["Ust_Resim"];?>" placeholder="<?php print  $data["Ust_Resim"];?>">
														</div>
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
                                                        <div class="input-group">
														<input id="Sag_Resim" type="text" class="form-control" name="name" value="<?php print  $data["Sag_Resim"];?>" placeholder="<?php print  $data["Sag_Resim"];?>">
														</div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>			
										<div class="form-group">
										<p align="right">
										<input type="button" id="edit_item" name="edit_item" class="btn btn-primary btn-md" value="Edit Item" />
										<input type="button" onclick="window.location='detailsItemWBarcode'" class="btn btn-danger btn-md" value="Cancel" />
										</p>
										<div id="error"></div>
										
																			
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
									</form>										
                                    </div>                               
				     </div>
                </div>
             </div>


        <!-- /.content-wrapper -->
        <!-- jQuery -->
        <script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
        <!-- bootstrap js -->
        <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="assets/plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
    </body>
</html>


<script>
$(document).ready(function(){
	document.getElementById('Urun_Adi').onkeypress = function(e){if (!e) e = window.event;   var keyCode = e.keyCode || e.which;    if (keyCode == '13'){ $('#edit_item').click();      return false;    }}
	document.getElementById('Ana_Kategori').onkeypress = function(e){if (!e) e = window.event;   var keyCode = e.keyCode || e.which;    if (keyCode == '13'){ $('#edit_item').click();      return false;    }}
	document.getElementById('Kategori').onkeypress = function(e){if (!e) e = window.event;   var keyCode = e.keyCode || e.which;    if (keyCode == '13'){ $('#edit_item').click();      return false;    }}
	document.getElementById('Grup').onkeypress = function(e){if (!e) e = window.event;   var keyCode = e.keyCode || e.which;    if (keyCode == '13'){ $('#edit_item').click();      return false;    }}
	document.getElementById('AltGrup').onkeypress = function(e){if (!e) e = window.event;   var keyCode = e.keyCode || e.which;    if (keyCode == '13'){ $('#edit_item').click();      return false;    }}
	document.getElementById('Bolum').onkeypress = function(e){if (!e) e = window.event;   var keyCode = e.keyCode || e.which;    if (keyCode == '13'){ $('#edit_item').click();      return false;    }}
	document.getElementById('AltBolum').onkeypress = function(e){if (!e) e = window.event;   var keyCode = e.keyCode || e.which;    if (keyCode == '13'){ $('#edit_item').click();      return false;    }}
	document.getElementById('Markasi').onkeypress = function(e){if (!e) e = window.event;   var keyCode = e.keyCode || e.which;    if (keyCode == '13'){ $('#edit_item').click();      return false;    }}
	document.getElementById('Ureticisi').onkeypress = function(e){if (!e) e = window.event;   var keyCode = e.keyCode || e.which;    if (keyCode == '13'){ $('#edit_item').click();      return false;    }}
	document.getElementById('Ithalatci').onkeypress = function(e){if (!e) e = window.event;   var keyCode = e.keyCode || e.which;    if (keyCode == '13'){ $('#edit_item').click();      return false;    }}
	document.getElementById('Ozel_Kodu').onkeypress = function(e){if (!e) e = window.event;   var keyCode = e.keyCode || e.which;    if (keyCode == '13'){ $('#edit_item').click();      return false;    }}
	document.getElementById('I_Grubu').onkeypress = function(e){if (!e) e = window.event;   var keyCode = e.keyCode || e.which;    if (keyCode == '13'){ $('#edit_item').click();      return false;    }}
	document.getElementById('Reyonu').onkeypress = function(e){if (!e) e = window.event;   var keyCode = e.keyCode || e.which;    if (keyCode == '13'){ $('#edit_item').click();      return false;    }}
	document.getElementById('Icerik').onkeypress = function(e){if (!e) e = window.event;   var keyCode = e.keyCode || e.which;    if (keyCode == '13'){ $('#edit_item').click();      return false;    }}
	document.getElementById('Icerik_Miktar').onkeypress = function(e){if (!e) e = window.event;   var keyCode = e.keyCode || e.which;    if (keyCode == '13'){ $('#edit_item').click();      return false;    }}
	document.getElementById('Birim').onkeypress = function(e){if (!e) e = window.event;   var keyCode = e.keyCode || e.which;    if (keyCode == '13'){ $('#edit_item').click();      return false;    }}
	document.getElementById('Paket_ici_Miktar').onkeypress = function(e){if (!e) e = window.event;   var keyCode = e.keyCode || e.which;    if (keyCode == '13'){ $('#edit_item').click();      return false;    }}
	document.getElementById('Paket_ici_Birim').onkeypress = function(e){if (!e) e = window.event;   var keyCode = e.keyCode || e.which;    if (keyCode == '13'){ $('#edit_item').click();      return false;    }}
	document.getElementById('Paket_Barkod').onkeypress = function(e){if (!e) e = window.event;   var keyCode = e.keyCode || e.which;    if (keyCode == '13'){ $('#edit_item').click();      return false;    }}
	document.getElementById('Koli_ici_Miktar').onkeypress = function(e){if (!e) e = window.event;   var keyCode = e.keyCode || e.which;    if (keyCode == '13'){ $('#edit_item').click();      return false;    }}
	document.getElementById('Koli_ici_Birim').onkeypress = function(e){if (!e) e = window.event;   var keyCode = e.keyCode || e.which;    if (keyCode == '13'){ $('#edit_item').click();      return false;    }}
	document.getElementById('Koli_Barkod').onkeypress = function(e){if (!e) e = window.event;   var keyCode = e.keyCode || e.which;    if (keyCode == '13'){ $('#edit_item').click();      return false;    }}
	document.getElementById('Genislik').onkeypress = function(e){if (!e) e = window.event;   var keyCode = e.keyCode || e.which;    if (keyCode == '13'){ $('#edit_item').click();      return false;    }}
	document.getElementById('Yukseklik').onkeypress = function(e){if (!e) e = window.event;   var keyCode = e.keyCode || e.which;    if (keyCode == '13'){ $('#edit_item').click();      return false;    }}
	document.getElementById('Derinlik').onkeypress = function(e){if (!e) e = window.event;   var keyCode = e.keyCode || e.which;    if (keyCode == '13'){ $('#edit_item').click();      return false;    }}
	document.getElementById('On_Resim').onkeypress = function(e){if (!e) e = window.event;   var keyCode = e.keyCode || e.which;    if (keyCode == '13'){ $('#edit_item').click();      return false;    }}
	document.getElementById('Sol_Resim').onkeypress = function(e){if (!e) e = window.event;   var keyCode = e.keyCode || e.which;    if (keyCode == '13'){ $('#edit_item').click();      return false;    }}
	document.getElementById('Ust_Resim').onkeypress = function(e){if (!e) e = window.event;   var keyCode = e.keyCode || e.which;    if (keyCode == '13'){ $('#edit_item').click();      return false;    }}
	document.getElementById('Sag_Resim').onkeypress = function(e){if (!e) e = window.event;   var keyCode = e.keyCode || e.which;    if (keyCode == '13'){ $('#edit_item').click();      return false;    } }
	
	$('#edit_item').click(function(){
var Urun_Adi = $('#Urun_Adi').val();
var Ana_Kategori = $('#Ana_Kategori').val();
var Kategori = $('#Kategori').val();
var Grup = $('#Grup').val();
var AltGrup = $('#AltGrup').val();
var Bolum = $('#Bolum').val();
var AltBolum = $('#AltBolum').val();
var Markasi = $('#Markasi').val();
var Ureticisi = $('#Ureticisi').val();
var Ithalatci = $('#Ithalatci').val();
var Ozel_Kodu = $('#Ozel_Kodu').val();
var I_Grubu = $('#I_Grubu').val();
var Reyonu = $('#Reyonu').val();
var Icerik = $('#Icerik').val();
var Icerik_Miktar = $('#Icerik_Miktar').val();
var Birim = $('#Birim').val();
var Paket_ici_Miktar = $('#Paket_ici_Miktar').val();
var Paket_ici_Birim = $('#Paket_ici_Birim').val();
var Paket_Barkod = $('#Paket_Barkod').val();
var Koli_ici_Miktar = $('#Koli_ici_Miktar').val();
var Koli_ici_Birim = $('#Koli_ici_Birim').val();
var Koli_Barkod = $('#Koli_Barkod').val();
var Genislik = $('#Genislik').val();
var Yukseklik = $('#Yukseklik').val();
var Derinlik = $('#Derinlik').val();
var On_Resim = $('#On_Resim').val();
var Sol_Resim = $('#Sol_Resim').val();
var Ust_Resim = $('#Ust_Resim').val();
var Sag_Resim = $('#Sag_Resim').val();

if($.trim(Urun_Adi).length > 0 &&
$.trim(Ana_Kategori).length > 0 &&
$.trim(Kategori).length > 0 &&
$.trim(Grup).length > 0 &&
$.trim(AltGrup).length > 0 &&
$.trim(Bolum).length > 0 &&
$.trim(AltBolum).length > 0 &&
$.trim(Markasi).length > 0 &&
$.trim(Ureticisi).length > 0 &&
$.trim(Ithalatci).length > 0 &&
$.trim(Ozel_Kodu).length > 0 &&
$.trim(I_Grubu).length > 0 &&
$.trim(Reyonu).length > 0 &&
$.trim(Icerik).length > 0 &&
$.trim(Icerik_Miktar).length > 0 &&
$.trim(Birim).length > 0 &&
$.trim(Paket_ici_Miktar).length > 0 &&
$.trim(Paket_ici_Birim).length > 0 &&
$.trim(Paket_Barkod).length > 0 &&
$.trim(Koli_ici_Miktar).length > 0 &&
$.trim(Koli_ici_Birim).length > 0 &&
$.trim(Koli_Barkod).length > 0 &&
$.trim(Genislik).length > 0 &&
$.trim(Yukseklik).length > 0 &&
$.trim(Derinlik).length > 0 &&
$.trim(On_Resim).length > 0 &&
$.trim(Sol_Resim).length > 0 &&
$.trim(Ust_Resim).length > 0 &&
$.trim(Sag_Resim).length > 0 
)
{
		  swal({
  title: "Are you sure?",
  text: "The item will be updated!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "green",
  confirmButtonText: "Yes, Update it!",
  closeOnConfirm: false
},
function(){
   $.ajax({
    url:"editItemAction",
    method:"POST",
    data:{Urun_Adi:Urun_Adi, Ana_Kategori:Ana_Kategori, Kategori:Kategori, Grup:Grup, AltGrup:AltGrup, Bolum:Bolum, AltBolum:AltBolum, Markasi:Markasi, 
	Ureticisi:Ureticisi, Ithalatci:Ithalatci, Ozel_Kodu:Ozel_Kodu, I_Grubu:I_Grubu, Reyonu:Reyonu, Icerik:Icerik, Icerik_Miktar:Icerik_Miktar, Birim:Birim, 
	Paket_ici_Miktar:Paket_ici_Miktar,Paket_ici_Birim:Paket_ici_Birim, Paket_Barkod:Paket_Barkod, Koli_ici_Miktar:Koli_ici_Miktar, Koli_ici_Birim:Koli_ici_Birim, Koli_Barkod:Koli_Barkod, Genislik:Genislik,
	Yukseklik:Yukseklik, Derinlik:Derinlik, On_Resim:On_Resim, Sol_Resim:Sol_Resim, Ust_Resim:Ust_Resim, Sag_Resim:Sag_Resim},
    cache:false,
    beforeSend:function(){
     $('#edit_item').val("Connecting...");
    },
    success:function(response)
    {
     if(response==="success")
     {
		window.location = "detailsItemWBarcode";
     }
     else
     {
		  swal("Failed!", "Please enter different values than previous values.", "error");
      $('#error').html("<span class='text-danger'>Please enter different values than previous values!</span>");
	  $('#edit_item').val("Edit item");
	  $('html, body').animate({ scrollTop: $('#error').offset().top }, 'slow');
     }
    }
   });
	     });
  }
  else
  {
	  $('#error').html("<span class='text-danger'>Please fill in all the blanks!</span>");
	 swal("Warning!", "Please fill in all the blanks!", "error");
 }
	});
});
</script>