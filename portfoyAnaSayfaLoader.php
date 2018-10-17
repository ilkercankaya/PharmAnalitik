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
	

 $name = mysqli_real_escape_string($connect, $namehelper);
 $dateYear = mysqli_real_escape_string($connect, date('Y'));
 $dateLastYear = mysqli_real_escape_string($connect, date("Y",strtotime("-1 year")));
 $pharmacy_id = mysqli_real_escape_string($connect, $_SESSION["pharmacy_id"]);
 //Get Urun 
  $sql = "SELECT DISTINCT(Barkod), Urun_Adi
					FROM pharmana_urun_db.general_Table UR
					";
 $result = mysqli_query($connect, $sql);
 //initiliaze array
  $resultSet = array();
  $resultSetTwo = array();
  
  //Fill array
 while($row = mysqli_fetch_assoc( $result )){
 
  $Barkod = mysqli_real_escape_string($connect, $row["Barkod"]);
 //SQLEACHURUN
	$sqlTable = "
SELECT SUM(KDV_Haric_Ciro) AS Ciro,SUM(Bakiye) AS Bakiye, HAR.Yil AS Urun_Adi , HAR.EczaneID AS Barkod
                                        FROM pharmana_Hareket_db.general_Table HAR
                                        WHERE HAR.EczaneID = '".$pharmacy_id."' AND HAR.Donem = '".$name."' AND Yil = '".$dateYear."' AND HAR.Barkod ='".$Barkod."'
";
 $resultTable = mysqli_query($connect, $sqlTable);
 $rowTwo = mysqli_fetch_assoc($resultTable);
 $rowTwo ["Barkod"] = $row ["Barkod"];
 $rowTwo ["Urun_Adi"] = $row ["Urun_Adi"];
$resultSet[] = $rowTwo;		
}
	
 //Get Urun Last Year
  $sql = "SELECT DISTINCT(Barkod), Urun_Adi
					FROM pharmana_urun_db.general_Table UR
					";
 $result = mysqli_query($connect, $sql);
  //Fill array
 while($row = mysqli_fetch_assoc( $result )){
 
  $Barkod = mysqli_real_escape_string($connect, $row["Barkod"]);
 //SQLEACHURUN
	$sqlTable = "
SELECT SUM(KDV_Haric_Ciro) AS Ciro,SUM(Bakiye) AS Bakiye,  HAR.Yil AS Urun_Adi , HAR.EczaneID AS Barkod
                                        FROM pharmana_Hareket_db.general_Table HAR
                                        WHERE HAR.EczaneID = '".$pharmacy_id."' AND HAR.Donem = '".$name."' AND Yil = '".$dateLastYear."' AND HAR.Barkod ='".$Barkod."'
";
 $resultTable = mysqli_query($connect, $sqlTable);
 $rowTwo = mysqli_fetch_assoc($resultTable);
 $rowTwo ["Barkod"] = $row ["Barkod"];
 $rowTwo ["Urun_Adi"] = $row ["Urun_Adi"];
$resultSetTwo[] = $rowTwo;		
}	

function aasort (&$array, $key) {
    $sorter=array();
    $ret=array();
    reset($array);
    foreach ($array as $ii => $va) {
        $sorter[$ii]=$va[$key];
    }
    asort($sorter);
    foreach ($sorter as $ii => $va) {
        $ret[$ii]=$array[$ii];
    }
    $array=$ret;
}

aasort($resultSet,"Ciro");
$resultSet = array_reverse($resultSet);
$resultSet = array_slice($resultSet, 0, 100);
// calculate the sum; first transform the array in something with only integers, then sum that array
$sumOne = array_sum(array_map(function($var) {
  return $var['Ciro'];
}, $resultSet));

												$variable = true;
												$i=1;
												//PART one of crossup (if 2017 exists but 2016 doesnt)
												$prefix = '';
												echo "[\n";
												foreach($resultSet as $tyc){
														foreach($resultSetTwo as $tylc ){
														  if($tyc['Urun_Adi'] === $tylc['Urun_Adi'] && $i<101) {
															$perc = ( ($tyc["Ciro"] /  $sumOne) *100 );
															echo $prefix . " {\n";
															echo '  "Sira": "' . $i . '",' . "\n";
															echo '  "Urun_Adi": "' . $tyc["Urun_Adi"] . '",' . "\n";
															echo '  "CiroThisYear": "' . $tyc["Ciro"] . '",' . "\n";
															echo '  "CiroLastYear": "' . $tylc["Ciro"] . '",' . "\n";
															echo '  "Bakiye": "' . $tyc["Bakiye"].'%' . '",' . "\n";
															echo '  "BakiyeLastYear": "' . $tylc["Bakiye"].'%' . '",' . "\n";
															echo '  "perc": "' . $perc. '"' . "\n";
															echo " }";
															$prefix = ",\n";
															$i++;
															$variable=false;
														  }
														}
														if ($variable==true && $i<101)
														{
															$perc = ( ($tyc["Ciro"] /  $sumOne) *100 );												
															echo $prefix . " {\n";
															echo '  "Sira": "' . $i . '",' . "\n";
															echo '  "Urun_Adi": "' . $tyc["Urun_Adi"] . '",' . "\n";
															echo '  "CiroThisYear": "' . $tyc["Ciro"] . '",' . "\n";
															echo '  "CiroLastYear": "' . '0' . '",' . "\n";
															echo '  "Bakiye": "' . $tyc["Bakiye"].'%' . '",' . "\n";
															echo '  "BakiyeLastYear": "' . '0' . '",' . "\n";
															echo '  "perc": "' . $perc. '"' . "\n";
															echo " }";													
															$prefix = ",\n";
															$i++;
														}
												}
												//PART two of crossup (if 2016 exist but 2017 doesnt)
												$variable = true;
												foreach($resultSetTwo as $tyc){
														foreach($resultSet as $tylc){
														  if($tyc['Urun_Adi'] === $tylc['Urun_Adi'] && $i<101 ) {
																$variable=false;
														  }
														}
														if ($variable==true  && $i<101)
														{	
															echo $prefix . " {\n";
															echo '  "Sira": "' . $i . '",' . "\n";
															echo '  "Urun_Adi": "' . $tyc["Urun_Adi"] . '",' . "\n";
															echo '  "CiroThisYear": "' . '0' . '",' . "\n";
															echo '  "CiroLastYear": "' . $tyc["Ciro"] . '",' . "\n";
															echo '  "Bakiye": "' . '0' . '",' . "\n";
															echo '  "BakiyeLastYear": "' . $tyc["Bakiye"].'%' . '",' . "\n";
															echo '  "perc": "' . '0' . '"' . "\n";	
															echo " }";		
															$prefix = ",\n";
															$i++;
														}
												}
												echo "\n]";
 mysqli_close( $connect );
?>