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
 //Get data 
  $sql = "SELECT COUNT(DISTINCT(Barkod)) AS UrunSayısı
					FROM pharmana_urun_db.general_Table UR
					";
 $result = mysqli_query($connect, $sql);
  $row = mysqli_fetch_assoc( $result );
   $sqlTwo = "SELECT COUNT(DISTINCT(HAR.Barkod)) AS HareketliUrunSayısı
   FROM pharmana_Hareket_db.general_Table HAR,pharmana_urun_db.general_Table UR
					 WHERE HAR.EczaneID = '".$pharmacy_id."' AND HAR.Donem = '".$name."' AND Yil = '".$dateYear."' AND HAR.Barkod = UR.Barkod
					";
 $resultTwo = mysqli_query($connect, $sqlTwo);
 $rowTwo = mysqli_fetch_assoc( $resultTwo );
 $HareketsizUrunSayısı = $row["UrunSayısı"] - $rowTwo["HareketliUrunSayısı"];

 $sqlThree="SELECT  HAR.Stok_Alis_Tutari AS HareketsizUrunStogu
   FROM pharmana_Hareket_db.general_Table HAR
					 WHERE HAR.EczaneID = '".$pharmacy_id."' AND HAR.Donem = '".$name."' AND Yil = '".$dateYear."' AND Stok_Alis_Tutari > 0 AND KDV_Haric_Ciro =0";
$resultThree = mysqli_query($connect, $sqlThree);
$HareketsizUrunStogu = 0;
while( $rowThree = mysqli_fetch_assoc( $resultThree ))
{
	$HareketsizUrunStogu += $rowThree["HareketsizUrunStogu"];				 
}
	//Print data out 
$prefix = '';
echo "[\n";
  echo $prefix . " {\n";
  echo '  "UrunSayısı": "' . $row["UrunSayısı"] . '",' . "\n";
  echo '  "HareketliUrunSayısı": "' . $rowTwo["HareketliUrunSayısı"] . '",' . "\n";
  echo '  "HareketsizUrunSayısı": "' . $HareketsizUrunSayısı . '",' . "\n";
  echo '  "HareketsizUrunStogu": "' . $HareketsizUrunStogu. '"' . "\n";
  echo " }";
  $prefix = ",\n";
echo "\n]";

 
 mysqli_close( $connect );
?>