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
 $dateYear = mysqli_real_escape_string($connect, date('Y'));
 $dateLastYear = mysqli_real_escape_string($connect, date("Y",strtotime("-1 year")));
 $pharmacy_id = mysqli_real_escape_string($connect, $_SESSION["pharmacy_id"]);
 $resultSet = array();
 $resultSetTwo = array();
 $sql = "SELECT UR.Barkod AS Barkod, UR.Urun_Adi AS Urun_Adi, UR.Ana_Kategori AS Kar, UR.Kategori AS KarMarji 
					FROM pharmana_urun_db.general_Table UR
					Where UR.Markasi= '".$nametwo."' 
					";
 $resultTable = mysqli_query($connect, $sql);

   while( $row = mysqli_fetch_assoc( $resultTable )){	//This years calculations		
	$Barkod_item = mysqli_real_escape_string($connect, $row["Barkod"] );
    $sqlHelper = "SELECT HAR.Bakiye AS Bakiye, HAR.Kar AS Kar , HAR.KDV_Haric_Ciro AS Ciro
					FROM pharmana_Hareket_db.general_Table HAR
					Where HAR.Barkod = '".$Barkod_item."'  AND HAR.EczaneID = '".$pharmacy_id."' AND HAR.Yil = '".$dateYear."' AND HAR.Donem = '".$name."'
					";
	$resultTableHelper = mysqli_query($connect, $sqlHelper);
	$fetched_helper = mysqli_fetch_assoc($resultTableHelper);
	$KarMarji = ($fetched_helper["Kar"] /  $fetched_helper["Ciro"] * 100);
					$row["Kar"]=$fetched_helper["Kar"];		
					$row["KarMarji"]=$KarMarji;			
	$resultSet[] = $row;					
  }	
  
  $sqlTwo = "SELECT UR.Barkod AS Barkod, UR.Urun_Adi AS Urun_Adi, UR.Ana_Kategori AS Kar, UR.Kategori AS KarMarji
					FROM pharmana_urun_db.general_Table UR
					Where UR.Markasi= '".$nametwo."' 
					";
 $resultTableTwo = mysqli_query($connect, $sqlTwo);

   while( $rowTwo = mysqli_fetch_assoc( $resultTableTwo )){	//Last years calculations		
 $Barkod_item = mysqli_real_escape_string($connect, $rowTwo["Barkod"] );
    $sqlHelper = "SELECT HAR.Bakiye AS Bakiye, HAR.Kar AS Kar , HAR.KDV_Haric_Ciro AS Ciro
					FROM pharmana_Hareket_db.general_Table HAR
					Where HAR.Barkod = '".$Barkod_item."'  AND HAR.EczaneID = '".$pharmacy_id."' AND HAR.Yil = '".$dateLastYear."' AND HAR.Donem = '".$name."'
					";
	$resultTableHelper = mysqli_query($connect, $sqlHelper);
	$fetched_helper = mysqli_fetch_assoc($resultTableHelper);
	$KarMarji = ($fetched_helper["Kar"] /  $fetched_helper["Ciro"] * 100);
					$rowTwo["Kar"]=$fetched_helper["Kar"];					
					$rowTwo["KarMarji"]=$KarMarji;
	$resultSetTwo[] = $rowTwo;							
   
  }	
 //CROSSUP
 												$variable = true;
												$i=1;
												//PART one of crossup (if 2017 exists but 2016 doesnt)
												$prefix = '';
												echo "[\n";
												foreach($resultSet as $tyc){
														foreach($resultSetTwo as $tylc){
														  if($tyc['Urun_Adi'] === $tylc['Urun_Adi']) {
															  if($tyc["Kar"]=="")
																  $tyc["Kar"] ="0.00";
															   if($tylc["Kar"]=="")
																  $tylc["Kar"] ="0.00";	
															   if($tyc["KarMarji"]=="")
																  $tyc["KarMarji"] ="0.00";	
															   if($tylc["KarMarji"]=="")
																  $tylc["KarMarji"] ="0.00";																  
															echo $prefix . " {\n";
															echo '  "Sira": "' . $i . '",' . "\n";
															echo '  "Urun_Adi": "' . $tyc["Urun_Adi"] . '",' . "\n";
															echo '  "Kar": "' .number_format( $tyc["Kar"],2) . '",' . "\n";
															echo '  "KarLastYear": "' . number_format($tylc["Kar"],2) . '",' . "\n";
															echo '  "KarMarji": "' .number_format( $tyc["KarMarji"],2) . '",' . "\n";
															echo '  "KarMarjiLastYear": "' . number_format($tylc["KarMarji"],2). '"' . "\n";
															echo " }";
															$prefix = ",\n";
															$i++;
															$variable=false;
														  }
														}
														if ($variable==true)
														{					
																	if($tyc["Kar"]=="")
																  $tyc["Kar"] ="0.00";			
															   if($tyc["KarMarji"]=="")
																  $tyc["KarMarji"] ="0.00";	
															echo $prefix . " {\n";
															echo '  "Sira": "' . $i . '",' . "\n";
															echo '  "Urun_Adi": "' . $tyc["Urun_Adi"] . '",' . "\n";
															echo '  "Kar": "' . number_format($tyc["Kar"],2) . '",' . "\n";
															echo '  "KarLastYear": "' .  '0.00' . '",' . "\n";
															echo '  "KarMarji": "' . number_format($tyc["KarMarji"],2) . '",' . "\n";
															echo '  "KarMarjiLastYear": "' . '0.00' . '"' . "\n";	
															echo " }";																
															$prefix = ",\n";
															$i++;
														}
												}
												//PART two of crossup (if 2016 exist but 2017 doesnt)
												$variable = true;
												foreach($resultSetTwo as $tyc){
														foreach($resultSet as $tylc){
														  if($tyc['Urun_Adi'] === $tylc['Urun_Adi']) {
																$variable=false;
														  }
														}
														if ($variable==true)
														{
															if($tyc["Kar"]=="")
																  $tyc["Kar"] ="0.00";	
															   if($tyc["KarMarji"]=="")
																  $tyc["KarMarji"] ="0.00";																  
															echo $prefix . " {\n";
															echo '  "Sira": "' . $i . '",' . "\n";
															echo '  "Urun_Adi": "' . $tyc["Urun_Adi"] . '",' . "\n";
															echo '  "Kar": "' . '0.00' . '",' . "\n";
															echo '  "KarLastYear": "' . number_format( $tyc["Kar"],2) . '",' . "\n";
															echo '  "KarMarji": "' . '0.00' . '",' . "\n";
															echo '  "KarMarjiLastYear": "' . number_format($tyc["KarMarji"],2). '"' . "\n";	
															echo " }";																												
															$prefix = ",\n";
															$i++;
														}
												}
												echo "\n]";
 
 mysqli_close( $connect );
?>