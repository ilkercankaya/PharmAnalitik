<?php
//TableTwoLoader.php
session_start();
error_reporting( 0 );
	$connect = mysqli_connect('localhost', 'pharmana_general', '123456pharmana', 'pharmana_Hareket_db');
	 if ( !$connect ) {
    die( 'Could not connect: ' . mysqli_error() );
	}
	 mysqli_set_charset($connect, "utf8"); /* Procedural approach */
 $name = mysqli_real_escape_string($connect, $_POST["name"]);
 if ($_POST["nametwo"] == "Dönem: 1")
{
     $namehelper = 1;
}
else if ($_POST["nametwo"] == "Dönem: 2")
{
    $namehelper = 2;
}
else if ($_POST["nametwo"] == "Dönem: 3")
{
     $namehelper = 3;
}
else if ($_POST["nametwo"] == "Dönem: 4")
{
     $namehelper = 4;
}
else if ($_POST["nametwo"] == "Dönem: 5")
{
    $namehelper = 5;
}
else if ($_POST["nametwo"] == "Dönem: 6")
{
    $namehelper = 6;
}
else if ($_POST["nametwo"] == "Dönem: 7")
{
  $namehelper = 7;
}
else if ($_POST["nametwo"] == "Dönem: 8")
{
  $namehelper = 8;
}
else if ($_POST["nametwo"] == "Dönem: 9")
{
   $namehelper = 9;
}
else if ($_POST["nametwo"] == "Dönem: 10")
{
  $namehelper = 10;
}
else if ($_POST["nametwo"] == "Dönem: 11")
{
   $namehelper = 11;
}
else
$namehelper = 12;
 $nametwo = mysqli_real_escape_string($connect, $namehelper);
 $dateYear = mysqli_real_escape_string($connect, date('Y'));
 $dateLastYear = mysqli_real_escape_string($connect, date("Y",strtotime("-1 year")));
 $pharmacy_id = mysqli_real_escape_string($connect, $_SESSION["pharmacy_id"]);
 $sql = "SELECT SUM(KDV_Haric_Ciro) AS Ciro, SUM(Stok_Alis_Tutari) AS Stok, UR.Kategori AS Kategori 
 FROM pharmana_Hareket_db.general_Table HAR, pharmana_urun_db.general_Table UR
  WHERE HAR.EczaneID = '".$pharmacy_id."' AND UR.Ana_Kategori = '".$name."' AND HAR.Barkod = UR.Barkod AND HAR.Yil = '".$dateYear."'  AND HAR.Donem = '".$nametwo."' 
  GROUP BY UR.Kategori  ";
 $result = mysqli_query($connect, $sql);
 $sqlTwo = "SELECT SUM(KDV_Haric_Ciro) AS Ciro, SUM(Stok_Alis_Tutari) AS Stok, UR.Kategori AS Kategori 
 FROM pharmana_Hareket_db.general_Table HAR, pharmana_urun_db.general_Table UR
  WHERE HAR.EczaneID = '".$pharmacy_id."' AND UR.Ana_Kategori = '".$name."' AND HAR.Barkod = UR.Barkod AND HAR.Yil = '".$dateLastYear."'  AND HAR.Donem = '".$nametwo."' 
  GROUP BY UR.Kategori  ";
 $resultTwo = mysqli_query($connect, $sqlTwo);
												 //Creating JSON
												 $resultSet = array();
												$resultSetTwo = array();
														while(($row = mysqli_fetch_assoc($result))) {
													$resultSet[] = $row;												
												}
												while(($row = mysqli_fetch_assoc($resultTwo))) {
													$resultSetTwo[] = $row;
												}
												$variable = true;
												$i=1;
												//PART one of crossup (if 2017 exists but 2016 doesnt)
												$prefix = '';
												echo "[\n";
												foreach($resultSet as $tyc){
														foreach($resultSetTwo as $tylc){
														  if($tyc['Kategori'] === $tylc['Kategori']) {
															$Stok_Devir_Günü = ($tyc["Stok"] / ( $tyc["Ciro"] / 25));
															$Stok_Devir_Günü_LastYear = ($tylc["Stok"] / ( $tylc["Ciro"] / 25));
															echo $prefix . " {\n";
															echo '  "Sira": "' . $i . '",' . "\n";
															echo '  "Kategori": "' . $tyc["Kategori"] . '",' . "\n";
															echo '  "StokGunuThisYear": "' . $Stok_Devir_Günü . '",' . "\n";
															echo '  "StokGunuLastYear": "' . $Stok_Devir_Günü_LastYear. '"' . "\n";
															echo " }";
															$prefix = ",\n";
															$i++;
															$variable=false;
														  }
														}
														if ($variable==true)
														{
															$Stok_Devir_Günü = ($tyc["Stok"] / ( $tyc["Ciro"] / 25));															
															echo $prefix . " {\n";
															echo '  "Sira": "' . $i . '",' . "\n";
															echo '  "Kategori": "' . $tyc["Kategori"] . '",' . "\n";
															echo '  "StokGunuThisYear": "' . $Stok_Devir_Günü . '",' . "\n";
															echo '  "StokGunuLastYear": "' . '0'. '"' . "\n";
															echo " }";
															$prefix = ",\n";
															$i++;
														}
												}
												//PART two of crossup (if 2016 exist but 2017 doesnt)
												$variable = true;
												foreach($resultSetTwo as $tyc){
														foreach($resultSet as $tylc){
														  if($tyc['Kategori'] === $tylc['Kategori']) {
																$variable=false;
														  }
														}
														if ($variable==true)
														{
															$Stok_Devir_Günü = ($tyc["Stok"] / ( $tyc["Ciro"] / 25));															
															echo $prefix . " {\n";
															echo '  "Sira": "' . $i . '",' . "\n";
															echo '  "Kategori": "' . $tyc["Kategori"] . '",' . "\n";
															echo '  "StokGunuThisYear": "' . '0' . '",' . "\n";
															echo '  "StokGunuLastYear": "' . $Stok_Devir_Günü . '"' . "\n";
															echo " }";
															$prefix = ",\n";
															$i++;
														}
												}
												echo "\n]";
 mysqli_close( $connect );
?>