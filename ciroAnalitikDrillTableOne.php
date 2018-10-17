<?php
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
$name = mysqli_real_escape_string($connect, $namehelper );
 $nametwo = mysqli_real_escape_string($connect, $_POST["nametwo"] );
  $namethree = mysqli_real_escape_string($connect, $_POST["namethree"] );
 $dateYear = mysqli_real_escape_string($connect, date('Y'));
 $dateLastYear = mysqli_real_escape_string($connect, date("Y",strtotime("-1 year")));
 $pharmacy_id = mysqli_real_escape_string($connect, $_SESSION["pharmacy_id"]);
 $sql = "SELECT UR.Markasi AS Markasi, SUM(KDV_Haric_Ciro) AS Ciro 
					FROM pharmana_Hareket_db.general_Table HAR, pharmana_urun_db.general_Table UR
					Where HAR.EczaneID = '".$pharmacy_id."' AND HAR.Yil = '".$dateYear."' AND UR.Ana_Kategori = '".$nametwo."'	AND UR.Kategori = '".$namethree."' AND HAR.Donem = '".$name."' AND  HAR.Barkod = UR.Barkod			
					GROUP BY UR.Markasi
					ORDER BY `Ciro` DESC";
 $resultTable = mysqli_query($connect, $sql);

  $sqlTwo = "SELECT UR.Markasi AS Markasi, SUM(KDV_Haric_Ciro) AS Ciro
					FROM pharmana_Hareket_db.general_Table HAR, pharmana_urun_db.general_Table UR
					Where HAR.EczaneID = '".$pharmacy_id."' AND HAR.Yil = '".$dateLastYear."' AND UR.Ana_Kategori = '".$nametwo."' 	AND UR.Kategori = '".$namethree."'	AND HAR.Donem = '".$name."' AND  HAR.Barkod = UR.Barkod			
					GROUP BY UR.Markasi
					ORDER BY `Ciro` DESC
					";
 $resultTableTwo = mysqli_query($connect, $sqlTwo);
 												 //Creating JSON
												 $resultSet = array();
												$resultSetTwo = array();
														while(($row = mysqli_fetch_assoc($resultTable))) {
													$resultSet[] = $row;												
												}
												while(($row = mysqli_fetch_assoc($resultTableTwo))) {
													$resultSetTwo[] = $row;
												}
												$variable = true;
												$i=1;
												//PART one of crossup (if 2017 exists but 2016 doesnt)
												$prefix = '';
												echo "[\n";
												foreach($resultSet as $tyc){
														foreach($resultSetTwo as $tylc){
														  if($tyc['Markasi'] === $tylc['Markasi']) {
															  if($tyc["Ciro"]=="")
																  $tyc["Ciro"] ="0.00";
															  if($tylc["Ciro"]=="")
																$tylc["Ciro"]= "0.00";
															echo $prefix . " {\n";
															echo '  "Sıra": "' . $i . '",' . "\n";
															echo '  "Marka": "' . $tyc["Markasi"] . '",' . "\n";
															echo '  "2017": "' .  number_format($tyc["Ciro"],2) . '",' . "\n";
															echo '  "2016": "' .  number_format($tylc["Ciro"],2) . '"' . "\n";
															echo " }";
															$prefix = ",\n";
															$i++;
															$variable=false;
														  }
														}
														if ($variable==true)
														{			
																if($tyc["Ciro"]=="")
																  $tyc["Ciro"] ="0.00";													
															echo $prefix . " {\n";
															echo '  "Sıra": "' . $i . '",' . "\n";
															echo '  "Marka": "' . $tyc["Markasi"] . '",' . "\n";
															echo '  "2017": "' .  number_format($tyc["Ciro"],2) . '",' . "\n";
															echo '  "2016": "' . '0.00'. '"' . "\n";	
															echo " }";													
															$prefix = ",\n";
															$i++;
														}
												}
												//PART two of crossup (if 2016 exist but 2017 doesnt)
												$variable = true;
												foreach($resultSetTwo as $tyc){
														foreach($resultSet as $tylc){
														  if($tyc['Markasi'] === $tylc['Markasi']) {
																$variable=false;
														  }
														}
														if ($variable==true)
														{
															 if($tyc["Ciro"]=="")
																  $tyc["Ciro"] ="0.00";
															echo $prefix . " {\n";
															echo '  "Sıra": "' . $i . '",' . "\n";
															echo '  "Marka": "' . $tyc["Markasi"] . '",' . "\n";
															echo '  "2017": "' . '0.00' . '",' . "\n";
															echo '  "2016": "' .  number_format($tyc["Ciro"],2)  .'"' . "\n";
															echo " }";		
															$prefix = ",\n";
															$i++;
														}
												}
												echo "\n]";
 
 
 mysqli_close( $connect );
?>