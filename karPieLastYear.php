<?php
// we need this so that PHP does not complain about deprectaed functions
error_reporting( 0 );
session_start();
// Connect to MySQL
$link = mysqli_connect( 'localhost', 'pharmana_general', '123456pharmana', 'pharmana_Hareket_db' );
if ( !$link ) {
  die( 'Could not connect: ' . mysqli_error() );
}
 mysqli_set_charset($link, "utf8"); /* Procedural approach */
// Select the data base
$db = mysqli_select_db($link,'pharmana_Hareket_db' );
if ( !$db ) {
  die ( 'Error selecting database \'pharmana_Hareket_db\' : ' . mysqli_error() );
}

// Fetch the data
$pharmacy_id = mysqli_real_escape_string($link, $_SESSION["pharmacy_id"]);
$dateYear = mysqli_real_escape_string($link, date('Y'));
$dateLastYear = mysqli_real_escape_string($link, date("Y",strtotime("-1 year")));
$dateLastTwoYear = mysqli_real_escape_string($link, date("Y",strtotime("-2 year")));


 $sqlDataTable = " SELECT SUM(KDV_Haric_Ciro) AS Ciro , UR.Ana_Kategori AS Ana_Kategori
					FROM pharmana_Hareket_db.general_Table HAR, pharmana_urun_db.general_Table UR 
					Where HAR.EczaneID = '".$pharmacy_id."' AND HAR.Yil = '".$dateYear."' AND HAR.Barkod = UR.Barkod
						GROUP BY UR.Ana_Kategori";
$resultDataTableTwo = mysqli_query($link, $sqlDataTable);


$prefix = '';
echo "[\n";

while( $rowTwo = mysqli_fetch_assoc( $resultDataTableTwo )){
	$AnaKategori = mysqli_real_escape_string($link, $rowTwo["Ana_Kategori"]);
	$kar_tutari = 0;
for( $i = 1; $i<13; $i++ ) {		
	//This years Kar Tutarı
		if($i!=1){//if month is not ocak
		$ihelper = $i - 1;
	$sqlSearch = "SELECT G.Stok_Alis_Tutari AS Donem_Sonu_Stok, G.KDV_Haric_Ciro AS Ciro, G.Toplam_Alis_Tutar, G2.Stok_Alis_Tutari AS Donem_Bası_Stok
	FROM pharmana_Hareket_db.general_Table G , pharmana_Hareket_db.general_Table G2 , pharmana_urun_db.general_Table UR
	WHERE G.EczaneID = '".$pharmacy_id."' AND G2.EczaneID = '".$pharmacy_id."' AND G.Barkod = G2.Barkod AND G.Donem = '".$i."' AND G2.Donem = '".$ihelper."' AND G.Yil ='".$dateLastYear."' AND G2.Yil= '".$dateLastYear."' AND  UR.Ana_Kategori = '".$AnaKategori."' AND G.Barkod = UR.Barkod AND G2.Barkod = UR.Barkod
	ORDER BY Ciro	";
	$resultSearch = mysqli_query($link, $sqlSearch);

	while($row = mysqli_fetch_assoc($resultSearch)){
		$kar_tutari = $kar_tutari + (	$row["Ciro"]-(($row["Donem_Bası_Stok"]+$row["Toplam_Alis_Tutar"])-$row["Donem_Sonu_Stok"]) );
		}
		
	}		
	else {//if month is ocak	
	  $sqlSearch = "SELECT G.Stok_Alis_Tutari AS Donem_Sonu_Stok, G.KDV_Haric_Ciro AS Ciro, G.Toplam_Alis_Tutar, G2.Stok_Alis_Tutari AS Donem_Bası_Stok
	FROM pharmana_Hareket_db.general_Table G , pharmana_Hareket_db.general_Table G2 , pharmana_urun_db.general_Table UR
	WHERE G.EczaneID = '".$pharmacy_id."' AND G2.EczaneID = '".$pharmacy_id."' AND G.Barkod = G2.Barkod AND G.Donem = '1' AND G2.Donem = '12' AND G.Yil ='".$dateLastYear."' AND G2.Yil= '".$dateLastTwoYear."' AND  UR.Ana_Kategori = '".$AnaKategori."' AND G.Barkod = UR.Barkod AND G2.Barkod = UR.Barkod
	ORDER BY Ciro	";
	$resultSearch = mysqli_query($link, $sqlSearch);
	while($row = mysqli_fetch_assoc($resultSearch)){
		$kar_tutari = $kar_tutari + (	$row["Ciro"]-(($row["Donem_Bası_Stok"]+$row["Toplam_Alis_Tutar"])-$row["Donem_Sonu_Stok"]) );
		}
		}
}
  echo $prefix . " {\n";
  echo '  "Kategori": "' .$rowTwo["Ana_Kategori"] . '",' . "\n";
  echo '  "Kar": "' . $kar_tutari. '"' . "\n";
  echo " }";
  $prefix = ",\n";

}

echo "\n]";



// Close the connection
mysqli_close( $link );
?>