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
 $name = mysqli_real_escape_string($connect, $namehelper);
 $dateYear = mysqli_real_escape_string($connect, date('Y'));
 $dateLastYear = mysqli_real_escape_string($connect, date("Y",strtotime("-1 year")));
 $pharmacy_id = mysqli_real_escape_string($connect, $_SESSION["pharmacy_id"]);
 $sql = "SELECT SUM(KDV_Haric_ciro) AS Ciro , UR.Ana_Kategori AS Ana_Kategori
					FROM pharmana_Hareket_db.general_Table HAR, pharmana_urun_db.general_Table UR
					Where HAR.EczaneID = '".$pharmacy_id."' AND HAR.Yil = '".$dateYear."'AND HAR.Donem = '".$name."'	AND  HAR.Barkod = UR.Barkod			
					GROUP BY UR.Ana_Kategori";
 $result = mysqli_query($connect, $sql);
// Print out rows
$prefix = '';
echo "[\n";
while( $row = mysqli_fetch_assoc( $result )){
  echo $prefix . " {\n";
  echo '  "title": "' . $row["Ana_Kategori"] . '",' . "\n";
  echo '  "value": "' . $row["Ciro"] . '",' . "\n";
  echo '  "url": "' . "#" . '",' . "\n";
  echo '  "description": "' . "click to drill-down" . '",' . "\n";
  echo '  "data": ';
  //İnner data   echo '  "value": "' . $row["Stok"]. '"' . "\n";
  $Anakategori = mysqli_real_escape_string($connect, $row["Ana_Kategori"]);
  $sqlTwo = "SELECT SUM(KDV_Haric_ciro) AS Ciro , UR.Kategori AS Kategori
					FROM pharmana_Hareket_db.general_Table HAR, pharmana_urun_db.general_Table UR
					Where HAR.EczaneID = '".$pharmacy_id."' AND HAR.Yil = '".$dateYear."'AND HAR.Donem = '".$name."'AND UR.Ana_Kategori= '".$Anakategori."' AND HAR.Barkod = UR.Barkod
					GROUP BY UR.Kategori  ";
					$resultTwo = mysqli_query($connect, $sqlTwo);
					  $prefixTwo = '';
					  echo "[\n";
  while( $rowTwo = mysqli_fetch_assoc( $resultTwo )){			
  echo $prefixTwo . " {\n";
  echo '  "title": "' . $rowTwo["Kategori"] . '",' . "\n";
  echo '  "value": "' . $rowTwo["Ciro"]. '"' . "\n";
  echo " }";
  $prefixTwo = ",\n";
  }	
echo "\n]"; 
 //END 
  echo " }";
  $prefix = ",\n";
}
echo "\n]";
 mysqli_close( $connect );
?>