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
 //Get data 
  $sql = "SELECT SUM(KDV_Haric_Ciro) AS Ciro
   FROM pharmana_Hareket_db.general_Table HAR
					 WHERE HAR.EczaneID = '".$pharmacy_id."' AND HAR.Donem = '".$name."' AND Yil = '".$dateYear."'
					";
 $result = mysqli_query($connect, $sql);
   $sqlTwo = "SELECT SUM(KDV_Haric_Ciro) AS Ciro
   FROM pharmana_Hareket_db.general_Table HAR
					 WHERE HAR.EczaneID = '".$pharmacy_id."' AND HAR.Donem = '".$name."' AND Yil = '".$dateLastYear."'
					";
 $resultTwo = mysqli_query($connect, $sqlTwo);
$prefix = '';
echo "[\n";
while( $row = mysqli_fetch_assoc( $result )){
	$rowTwo = mysqli_fetch_assoc( $resultTwo );
  echo $prefix . " {\n";
  echo '  "TotCiroThisYear": "' . $row["Ciro"] . '",' . "\n";
  echo '  "TotCiroLastYear": "' . $rowTwo["Ciro"]. '"' . "\n";
  echo " }";
  $prefix = ",\n";
}
echo "\n]";

 
 mysqli_close( $connect );
?>