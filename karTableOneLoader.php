<?php
//TableTwoLoader.php
session_start();
error_reporting( 0 );
	$connect = mysqli_connect('localhost', 'pharmana_general', '123456pharmana', 'pharmana_Hareket_db');
	 if ( !$connect ) {
    die( 'Could not connect: ' . mysqli_error() );
	}
	 mysqli_set_charset($connect, "utf8"); /* Procedural approach */

	if ($_POST["name"] == "Dönem: 1")
{
     $namehelper = 1;
}
else if ($_POST["name"] == "Dönem: 2")
{
    $namehelper = 2;
}
else if ($_POST["name"] == "Dönem: 3")
{
     $namehelper = 3;
}
else if ($_POST["name"] == "Dönem: 4")
{
     $namehelper = 4;
}
else if ($_POST["name"] == "Dönem: 5")
{
    $namehelper = 5;
}
else if ($_POST["name"] == "Dönem: 6")
{
    $namehelper = 6;
}
else if ($_POST["name"] == "Dönem: 7")
{
  $namehelper = 7;
}
else if ($_POST["name"] == "Dönem: 8")
{
  $namehelper = 8;
}
else if ($_POST["name"] == "Dönem: 9")
{
   $namehelper = 9;
}
else if ($_POST["name"] == "Dönem: 10")
{
  $namehelper = 10;
}
else if ($_POST["name"] == "Dönem: 11")
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
 //SQL'S
 if($namehelper==1)
 {
	 $sql = "SELECT SUM(HAR.Stok_Alis_Tutari) AS Donem_Sonu_Stok, SUM(HAR.KDV_Haric_Ciro) AS Ciro, SUM(HAR.Toplam_Alis_Tutar) AS Toplam_Alis_Tutar, SUM(HARTwo.Stok_Alis_Tutari) AS Donem_Bası_Stok , UR.Ana_Kategori AS Ana_Kategori 
 FROM pharmana_Hareket_db.general_Table HAR, pharmana_urun_db.general_Table UR , pharmana_Hareket_db.general_Table HARTwo
  WHERE HAR.EczaneID = '".$pharmacy_id."' AND HARTwo.EczaneID = '".$pharmacy_id."' AND HAR.Barkod = UR.Barkod AND HARTwo.Barkod = UR.Barkod AND HARTwo.Barkod = HAR.Barkod AND HAR.Donem = '1' AND HARTwo.Donem = '12' AND HAR.Yil ='".$dateYear."' AND HARTwo.Yil= '".$dateLastYear."'
  GROUP BY UR.Ana_Kategori 
ORDER BY `Ciro` DESC   ";
 $result = mysqli_query($connect, $sql);
 $sqlTwo = "SELECT SUM(HAR.Stok_Alis_Tutari) AS Donem_Sonu_Stok, SUM(HAR.KDV_Haric_Ciro) AS Ciro, SUM(HAR.Toplam_Alis_Tutar) AS Toplam_Alis_Tutar, SUM(HARTwo.Stok_Alis_Tutari) AS Donem_Bası_Stok , UR.Ana_Kategori AS Ana_Kategori 
 FROM pharmana_Hareket_db.general_Table HAR, pharmana_urun_db.general_Table UR , pharmana_Hareket_db.general_Table HARTwo
  WHERE HAR.EczaneID = '".$pharmacy_id."' AND HARTwo.EczaneID = '".$pharmacy_id."' AND HAR.Barkod = UR.Barkod  AND HARTwo.Barkod = UR.Barkod AND HARTwo.Barkod = HAR.Barkod AND HAR.Donem = '1' AND HARTwo.Donem = '12' AND HAR.Yil ='".$dateLastYear."' AND HARTwo.Yil= '".$dateLastTwoYear."'
  GROUP BY UR.Ana_Kategori
ORDER BY `Ciro` DESC   ";
 $resultTwo = mysqli_query($connect, $sqlTwo);
 $sqlCiro = "SELECT SUM(KDV_Haric_Ciro) AS KDV 
	FROM general_Table 
	WHERE EczaneID = '".$pharmacy_id."' AND Donem = '1' AND Yil = '".$dateYear."'		";
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
													//total kar_tutari this year
													$kar_tutari_total_ThisY = 0;
													foreach($resultSet as $this_year){
														$kar_tutari_total_ThisY  += (	$this_year["Ciro"]-(($this_year["Donem_Bası_Stok"]+$this_year["Toplam_Alis_Tutar"])-$this_year["Donem_Sonu_Stok"]) );
														}
													//total kar_tutari last year
													$kar_tutari_total_LastY = 0;
													foreach($resultSetTwo as $last_year){
														$kar_tutari_total_LastY  += (	$last_year["Ciro"]-(($last_year["Donem_Bası_Stok"]+$last_year["Toplam_Alis_Tutar"])-$last_year["Donem_Sonu_Stok"]) );
														}
												$variable = true;
												$i=1;
												//PART one of crossup (if 2017 exists but 2016 doesnt)
												$prefix = '';
												echo "[\n";
												foreach($resultSet as $tyc){
														foreach($resultSetTwo as $tylc){
														  if($tyc['Ana_Kategori'] === $tylc['Ana_Kategori']) {
															$kar_tutari = (	$tyc["Ciro"]-(($tyc["Donem_Bası_Stok"]+$tyc["Toplam_Alis_Tutar"])-$tyc["Donem_Sonu_Stok"]) );
															$kar_tutari_Last_year = (	$tylc["Ciro"]-(($tylc["Donem_Bası_Stok"]+$tylc["Toplam_Alis_Tutar"])-$tylc["Donem_Sonu_Stok"]) );
															$kar_marji = (($kar_tutari / $dataCiro["KDV"]) *100);
															$kar_marji_Last_year = (($kar_tutari_Last_year / $dataCiro["KDV"]) *100);
															echo $prefix . " {\n";
															echo '  "Sira": "' . $i . '",' . "\n";
															echo '  "Ana_Kategori": "' . $tyc["Ana_Kategori"] . '",' . "\n";
															echo '  "KarThisYear": "' . $kar_tutari . '",' . "\n";
															echo '  "KarLastYear": "' . $kar_tutari_Last_year . '",' . "\n";
															echo '  "PercThisYear": "' .  (($kar_tutari / $kar_tutari_total_ThisY) *100) . '",' . "\n";
															echo '  "PercLastYear": "' . (($kar_tutari_Last_year / $kar_tutari_total_LastY) *100)  . '",' . "\n";
															echo '  "KarMarji": "' . $kar_marji . '",' . "\n";
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
															echo '  "Ana_Kategori": "' . $tyc["Ana_Kategori"] . '",' . "\n";
															echo '  "KarThisYear": "' . $kar_tutari . '",' . "\n";
															echo '  "KarLastYear": "' . '0' . '",' . "\n";
															echo '  "PercThisYear": "' . (($kar_tutari / $kar_tutari_total_ThisY) *100). '",' . "\n";
															echo '  "PercLastYear": "' . '0' . '",' . "\n";
															echo '  "KarMarji": "' . $kar_marji . '",' . "\n";
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
														  if($tyc['Ana_Kategori'] === $tylc['Ana_Kategori']) {
																$variable=false;
														  }
														}
														if ($variable==true)
														{
															$kar_tutari = (	$tyc["Ciro"]-(($tyc["Donem_Bası_Stok"]+$tyc["Toplam_Alis_Tutar"])-$tyc["Donem_Sonu_Stok"]) );															
															$kar_marji = (($kar_tutari / $dataCiro["KDV"]) *100);			
															echo $prefix . " {\n";
															echo '  "Sira": "' . $i . '",' . "\n";
															echo '  "Ana_Kategori": "' . $tyc["Ana_Kategori"] . '",' . "\n";
															echo '  "KarThisYear": "' . '0' . '",' . "\n";
															echo '  "KarLastYear": "' . $kar_tutari . '",' . "\n";
															echo '  "PercThisYear": "' . '0' . '",' . "\n";
															echo '  "PercLastYear": "' . (($kar_tutari / $kar_tutari_total_LastY) *100) . '",' . "\n";
															echo '  "KarMarji": "' . '0' . '",' . "\n";
															echo '  "KarMarjiLastYear": "' . $kar_marji. '"' . "\n";
															echo " }";		
															$prefix = ",\n";
															$i++;
														}
												}
												echo "\n]";
 }
 else{
 $sql = "SELECT SUM(HAR.Stok_Alis_Tutari) AS Donem_Sonu_Stok, SUM(HAR.KDV_Haric_Ciro) AS Ciro, SUM(HAR.Toplam_Alis_Tutar) AS Toplam_Alis_Tutar, SUM(HARTwo.Stok_Alis_Tutari) AS Donem_Bası_Stok , UR.Ana_Kategori AS Ana_Kategori 
 FROM pharmana_Hareket_db.general_Table HAR, pharmana_urun_db.general_Table UR , pharmana_Hareket_db.general_Table HARTwo
  WHERE HAR.EczaneID = '".$pharmacy_id."' AND HARTwo.EczaneID = '".$pharmacy_id."' AND HAR.Barkod = UR.Barkod AND HARTwo.Barkod = UR.Barkod AND HARTwo.Barkod = HAR.Barkod AND HAR.Donem = '".$dateMonth."' AND HARTwo.Donem = '".$dateLastMonth."' AND HAR.Yil ='".$dateYear."' AND HARTwo.Yil= '".$dateYear."'
  GROUP BY UR.Ana_Kategori 
ORDER BY `Ciro` DESC   ";
 $result = mysqli_query($connect, $sql);
 $sqlTwo = "SELECT SUM(HAR.Stok_Alis_Tutari) AS Donem_Sonu_Stok, SUM(HAR.KDV_Haric_Ciro) AS Ciro, SUM(HAR.Toplam_Alis_Tutar) AS Toplam_Alis_Tutar, SUM(HARTwo.Stok_Alis_Tutari) AS Donem_Bası_Stok , UR.Ana_Kategori AS Ana_Kategori 
 FROM pharmana_Hareket_db.general_Table HAR, pharmana_urun_db.general_Table UR , pharmana_Hareket_db.general_Table HARTwo
  WHERE HAR.EczaneID = '".$pharmacy_id."' AND HARTwo.EczaneID = '".$pharmacy_id."' AND HAR.Barkod = UR.Barkod  AND HARTwo.Barkod = UR.Barkod AND HARTwo.Barkod = HAR.Barkod AND HAR.Donem = '".$dateMonth."' AND HARTwo.Donem = '".$dateLastMonth."' AND HAR.Yil ='".$dateLastYear."' AND HARTwo.Yil= '".$dateLastYear."'
  GROUP BY UR.Ana_Kategori
ORDER BY `Ciro` DESC   ";
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
													//total kar_tutari this year
													$kar_tutari_total_ThisY = 0;
													foreach($resultSet as $this_year){
														$kar_tutari_total_ThisY  += (	$this_year["Ciro"]-(($this_year["Donem_Bası_Stok"]+$this_year["Toplam_Alis_Tutar"])-$this_year["Donem_Sonu_Stok"]) );
														}
													//total kar_tutari last year
													$kar_tutari_total_LastY = 0;
													foreach($resultSetTwo as $last_year){
														$kar_tutari_total_LastY  += (	$last_year["Ciro"]-(($last_year["Donem_Bası_Stok"]+$last_year["Toplam_Alis_Tutar"])-$last_year["Donem_Sonu_Stok"]) );
														}
												$variable = true;
												$i=1;
												//PART one of crossup (if 2017 exists but 2016 doesnt)
												$prefix = '';
												echo "[\n";
												foreach($resultSet as $tyc){
														foreach($resultSetTwo as $tylc){
														  if($tyc['Ana_Kategori'] === $tylc['Ana_Kategori']) {
															$kar_tutari = (	$tyc["Ciro"]-(($tyc["Donem_Bası_Stok"]+$tyc["Toplam_Alis_Tutar"])-$tyc["Donem_Sonu_Stok"]) );
															$kar_tutari_Last_year = (	$tylc["Ciro"]-(($tylc["Donem_Bası_Stok"]+$tylc["Toplam_Alis_Tutar"])-$tylc["Donem_Sonu_Stok"]) );
															$kar_marji = (($kar_tutari / $dataCiro["KDV"]) *100);
															$kar_marji_Last_year = (($kar_tutari_Last_year / $dataCiro["KDV"]) *100);
															echo $prefix . " {\n";
															echo '  "Sira": "' . $i . '",' . "\n";
															echo '  "Ana_Kategori": "' . $tyc["Ana_Kategori"] . '",' . "\n";
															echo '  "KarThisYear": "' . $kar_tutari . '",' . "\n";
															echo '  "KarLastYear": "' . $kar_tutari_Last_year . '",' . "\n";
															echo '  "PercThisYear": "' .  (($kar_tutari / $kar_tutari_total_ThisY) *100) . '",' . "\n";
															echo '  "PercLastYear": "' . (($kar_tutari_Last_year / $kar_tutari_total_LastY) *100)  . '",' . "\n";
															echo '  "KarMarji": "' . $kar_marji . '",' . "\n";
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
															echo '  "Ana_Kategori": "' . $tyc["Ana_Kategori"] . '",' . "\n";
															echo '  "KarThisYear": "' . $kar_tutari . '",' . "\n";
															echo '  "KarLastYear": "' . '0' . '",' . "\n";
															echo '  "PercThisYear": "' . (($kar_tutari / $kar_tutari_total_ThisY) *100). '",' . "\n";
															echo '  "PercLastYear": "' . '0' . '",' . "\n";
															echo '  "KarMarji": "' . $kar_marji . '",' . "\n";
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
														  if($tyc['Ana_Kategori'] === $tylc['Ana_Kategori']) {
																$variable=false;
														  }
														}
														if ($variable==true)
														{
															$kar_tutari = (	$tyc["Ciro"]-(($tyc["Donem_Bası_Stok"]+$tyc["Toplam_Alis_Tutar"])-$tyc["Donem_Sonu_Stok"]) );															
															$kar_marji = (($kar_tutari / $dataCiro["KDV"]) *100);			
															echo $prefix . " {\n";
															echo '  "Sira": "' . $i . '",' . "\n";
															echo '  "Ana_Kategori": "' . $tyc["Ana_Kategori"] . '",' . "\n";
															echo '  "KarThisYear": "' . '0' . '",' . "\n";
															echo '  "KarLastYear": "' . $kar_tutari . '",' . "\n";
															echo '  "PercThisYear": "' . '0' . '",' . "\n";
															echo '  "PercLastYear": "' . (($kar_tutari / $kar_tutari_total_LastY) *100) . '",' . "\n";
															echo '  "KarMarji": "' . '0' . '",' . "\n";
															echo '  "KarMarjiLastYear": "' . $kar_marji. '"' . "\n";
															echo " }";		
															$prefix = ",\n";
															$i++;
														}
												}
												echo "\n]";
 }
 mysqli_close( $connect );
?>