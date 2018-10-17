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
$query = "
 SELECT SUM(Kar) AS Kar , UR.Ana_Kategori AS Ana_Kategori
					FROM pharmana_Hareket_db.general_Table HAR, pharmana_urun_db.general_Table UR
					WHERE HAR.EczaneID = '".$pharmacy_id."' AND  HAR.Yil = '".$dateYear."' AND HAR.Barkod = UR.Barkod
					 GROUP BY UR.Ana_Kategori";
$result = mysqli_query($link, $query );


// Print out rows
$prefix = '';
echo "[\n";
while( $row = mysqli_fetch_assoc( $result )){
  echo $prefix . " {\n";
  echo '  "Kategori": "' . $row["Ana_Kategori"] . '",' . "\n";
  echo '  "Kar": "' . $row["Kar"]. '"' . "\n";
  echo " }";
  $prefix = ",\n";
}
echo "\n]";

// Close the connection
mysqli_close( $link );
?>