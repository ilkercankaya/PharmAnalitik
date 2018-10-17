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
 $dateMonth = mysqli_real_escape_string($connect, $namehelper);
 $dateYear = mysqli_real_escape_string($connect, date('Y'));
 $dateLastYear = mysqli_real_escape_string($connect, date("Y",strtotime("-1 year")));
 $dateLastTwoYear = mysqli_real_escape_string($connect, date("Y",strtotime("-2 year")));
 $pharmacy_id = mysqli_real_escape_string($connect, $_SESSION["pharmacy_id"]);
 $dateLastMonth = mysqli_real_escape_string($connect, $namehelper -1);
 $dateLastTwoMonth = mysqli_real_escape_string($connect, $namehelper - 2);
 
if($namehelper==1){
	$sql = "SELECT SUM(HAR.Stok_Alis_Tutari) AS Donem_Sonu_Stok, SUM(HAR.KDV_Haric_Ciro) AS Ciro, SUM(HAR.Toplam_Alis_Tutar) AS Toplam_Alis_Tutar, SUM(HARTwo.Stok_Alis_Tutari) AS Donem_Bası_Stok , UR.Kategori AS Kategori 
 FROM pharmana_Hareket_db.general_Table HAR, pharmana_urun_db.general_Table UR , pharmana_Hareket_db.general_Table HARTwo
  WHERE HAR.EczaneID = '".$pharmacy_id."' AND HARTwo.EczaneID = '".$pharmacy_id."' AND UR.Ana_Kategori = '".$name."' AND HAR.Barkod = UR.Barkod AND HARTwo.Barkod = UR.Barkod AND HARTwo.Barkod = HAR.Barkod AND HAR.Donem = '1' AND HARTwo.Donem = '12' AND HAR.Yil ='".$dateYear."' AND HARTwo.Yil= '".$dateLastYear."'
  GROUP BY UR.Kategori 
 ORDER BY `Ciro` DESC  ";
 $result = mysqli_query($connect, $sql);
 $sqlTwo = "SELECT SUM(HAR.Stok_Alis_Tutari) AS Donem_Sonu_Stok, SUM(HAR.KDV_Haric_Ciro) AS Ciro, SUM(HAR.Toplam_Alis_Tutar) AS Toplam_Alis_Tutar, SUM(HARTwo.Stok_Alis_Tutari) AS Donem_Bası_Stok , UR.Kategori AS Kategori 
 FROM pharmana_Hareket_db.general_Table HAR, pharmana_urun_db.general_Table UR , pharmana_Hareket_db.general_Table HARTwo
  WHERE HAR.EczaneID = '".$pharmacy_id."' AND HARTwo.EczaneID = '".$pharmacy_id."' AND UR.Ana_Kategori = '".$name."' AND HAR.Barkod = UR.Barkod AND HARTwo.Barkod = UR.Barkod AND HARTwo.Barkod = HAR.Barkod AND HAR.Donem = '1' AND HARTwo.Donem = '12' AND HAR.Yil ='".$dateLastYear."' AND HARTwo.Yil= '".$dateLastTwoYear."'
  GROUP BY UR.Kategori 
 ORDER BY `Ciro` DESC  ";
 $resultTwo = mysqli_query($connect, $sqlTwo);
 $sqlCiro = "SELECT SUM(KDV_Haric_Ciro) AS KDV 
	FROM general_Table 
	WHERE EczaneID = '".$pharmacy_id."' AND Donem = '".$dateMonth."' AND Yil = '".$dateYear."'		";
	$resultCiro = mysqli_query($connect, $sqlCiro);
    $dataCiro = mysqli_fetch_assoc($resultCiro);	
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
															$kar_tutari = (	$tyc["Ciro"]-(($tyc["Donem_Bası_Stok"]+$tyc["Toplam_Alis_Tutar"])-$tyc["Donem_Sonu_Stok"]) );
															$kar_tutari_Last_year = (	$tylc["Ciro"]-(($tylc["Donem_Bası_Stok"]+$tylc["Toplam_Alis_Tutar"])-$tylc["Donem_Sonu_Stok"]) );
															$kar_marji = (($kar_tutari / $dataCiro["KDV"]) *100);
															$kar_marji_Last_year = (($kar_tutari_Last_year / $dataCiro["KDV"]) *100);
															echo $prefix . " {\n";
															echo '  "Sira": "' . $i . '",' . "\n";
															echo '  "Kategori": "' . $tyc["Kategori"] . '",' . "\n";
															echo '  "KarMarjiThisYear": "' . $kar_marji . '",' . "\n";
															echo '  "KarMarjiLastYear": "' . $kar_marji_Last_year. '"' . "\n";
															echo " }";
															$prefix = ",\n";
															$i++;
															$variable=false;
														  }
														}
														if ($variable==true)
														{
															$kar_tutari = (	$tyc["Ciro"]-(($tyc["Donem_Bası_Stok"]+$tyc["Toplam_Alis_Tutar"])-$tyc["Donem_Sonu_Stok"]) );
															$kar_marji = (($kar_tutari / $dataCiro["KDV"]) *100);															
															echo $prefix . " {\n";
															echo '  "Sira": "' . $i . '",' . "\n";
															echo '  "Kategori": "' . $tyc["Kategori"] . '",' . "\n";
															echo '  "KarMarjiThisYear": "' . $kar_marji . '",' . "\n";
															echo '  "KarMarjiLastYear": "' . '0'. '"' . "\n";
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
															$kar_tutari = (	$tyc["Ciro"]-(($tyc["Donem_Bası_Stok"]+$tyc["Toplam_Alis_Tutar"])-$tyc["Donem_Sonu_Stok"]) );															
															$kar_marji = (($kar_tutari / $dataCiro["KDV"]) *100);														
															echo $prefix . " {\n";
															echo '  "Sira": "' . $i . '",' . "\n";
															echo '  "Kategori": "' . $tyc["Kategori"] . '",' . "\n";
															echo '  "KarMarjiThisYear": "' . '0' . '",' . "\n";
															echo '  "KarMarjiLastYear": "' . $kar_marji . '"' . "\n";
															echo " }";
															$prefix = ",\n";
															$i++;
														}
												}
												echo "\n]";
}
else{
 $sql = "SELECT SUM(HAR.Stok_Alis_Tutari) AS Donem_Sonu_Stok, SUM(HAR.KDV_Haric_Ciro) AS Ciro, SUM(HAR.Toplam_Alis_Tutar) AS Toplam_Alis_Tutar, SUM(HARTwo.Stok_Alis_Tutari) AS Donem_Bası_Stok , UR.Kategori AS Kategori 
 FROM pharmana_Hareket_db.general_Table HAR, pharmana_urun_db.general_Table UR , pharmana_Hareket_db.general_Table HARTwo
  WHERE HAR.EczaneID = '".$pharmacy_id."' AND HARTwo.EczaneID = '".$pharmacy_id."' AND UR.Ana_Kategori = '".$name."' AND HAR.Barkod = UR.Barkod AND HARTwo.Barkod = UR.Barkod AND HARTwo.Barkod = HAR.Barkod AND HAR.Donem = '".$dateMonth."' AND HARTwo.Donem = '".$dateLastMonth."' AND HAR.Yil ='".$dateYear."' AND HARTwo.Yil= '".$dateYear."'
  GROUP BY UR.Kategori 
 ORDER BY `Ciro` DESC  ";
 $result = mysqli_query($connect, $sql);
 $sqlTwo = "SELECT SUM(HAR.Stok_Alis_Tutari) AS Donem_Sonu_Stok, SUM(HAR.KDV_Haric_Ciro) AS Ciro, SUM(HAR.Toplam_Alis_Tutar) AS Toplam_Alis_Tutar, SUM(HARTwo.Stok_Alis_Tutari) AS Donem_Bası_Stok , UR.Kategori AS Kategori 
 FROM pharmana_Hareket_db.general_Table HAR, pharmana_urun_db.general_Table UR , pharmana_Hareket_db.general_Table HARTwo
  WHERE HAR.EczaneID = '".$pharmacy_id."' AND HARTwo.EczaneID = '".$pharmacy_id."' AND UR.Ana_Kategori = '".$name."' AND HAR.Barkod = UR.Barkod  AND HARTwo.Barkod = UR.Barkod AND HARTwo.Barkod = HAR.Barkod AND HAR.Donem = '".$dateMonth."' AND HARTwo.Donem = '".$dateLastMonth."' AND HAR.Yil ='".$dateLastYear."' AND HARTwo.Yil= '".$dateLastYear."'
  GROUP BY UR.Kategori 
 ORDER BY `Ciro` DESC  ";
 $resultTwo = mysqli_query($connect, $sqlTwo);
 $sqlCiro = "SELECT SUM(KDV_Haric_Ciro) AS KDV 
	FROM general_Table 
	WHERE EczaneID = '".$pharmacy_id."' AND Donem = '".$dateMonth."' AND Yil = '".$dateYear."'		";
	$resultCiro = mysqli_query($connect, $sqlCiro);
    $dataCiro = mysqli_fetch_assoc($resultCiro);	
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
															$kar_tutari = (	$tyc["Ciro"]-(($tyc["Donem_Bası_Stok"]+$tyc["Toplam_Alis_Tutar"])-$tyc["Donem_Sonu_Stok"]) );
															$kar_tutari_Last_year = (	$tylc["Ciro"]-(($tylc["Donem_Bası_Stok"]+$tylc["Toplam_Alis_Tutar"])-$tylc["Donem_Sonu_Stok"]) );
															$kar_marji = (($kar_tutari / $dataCiro["KDV"]) *100);
															$kar_marji_Last_year = (($kar_tutari_Last_year / $dataCiro["KDV"]) *100);
															echo $prefix . " {\n";
															echo '  "Sira": "' . $i . '",' . "\n";
															echo '  "Kategori": "' . $tyc["Kategori"] . '",' . "\n";
															echo '  "KarMarjiThisYear": "' . $kar_marji . '",' . "\n";
															echo '  "KarMarjiLastYear": "' . $kar_marji_Last_year. '"' . "\n";
															echo " }";
															$prefix = ",\n";
															$i++;
															$variable=false;
														  }
														}
														if ($variable==true)
														{
															$kar_tutari = (	$tyc["Ciro"]-(($tyc["Donem_Bası_Stok"]+$tyc["Toplam_Alis_Tutar"])-$tyc["Donem_Sonu_Stok"]) );
															$kar_marji = (($kar_tutari / $dataCiro["KDV"]) *100);															
															echo $prefix . " {\n";
															echo '  "Sira": "' . $i . '",' . "\n";
															echo '  "Kategori": "' . $tyc["Kategori"] . '",' . "\n";
															echo '  "KarMarjiThisYear": "' . $kar_marji . '",' . "\n";
															echo '  "KarMarjiLastYear": "' . '0'. '"' . "\n";
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
															$kar_tutari = (	$tyc["Ciro"]-(($tyc["Donem_Bası_Stok"]+$tyc["Toplam_Alis_Tutar"])-$tyc["Donem_Sonu_Stok"]) );															
															$kar_marji = (($kar_tutari / $dataCiro["KDV"]) *100);														
															echo $prefix . " {\n";
															echo '  "Sira": "' . $i . '",' . "\n";
															echo '  "Kategori": "' . $tyc["Kategori"] . '",' . "\n";
															echo '  "KarMarjiThisYear": "' . '0' . '",' . "\n";
															echo '  "KarMarjiLastYear": "' . $kar_marji . '"' . "\n";
															echo " }";
															$prefix = ",\n";
															$i++;
														}
												}
												echo "\n]";
}
 mysqli_close( $connect );
?>