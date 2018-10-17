
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
$query = "
 SELECT SUM(Stok_Alis_Tutari) AS Stok , HAR.Donem AS Donem
					FROM pharmana_Hareket_db.general_Table HAR, pharmana_urun_db.general_Table UR
					WHERE HAR.EczaneID = '".$pharmacy_id."' AND  HAR.Yil = '".$dateYear."' AND HAR.Barkod = UR.Barkod
					 GROUP BY HAR.Donem
					 ";
$result = mysqli_query($link, $query );

$queryTwo = "
 SELECT SUM(Stok_Alis_Tutari) AS Stok , HAR.Donem AS Donem
					FROM pharmana_Hareket_db.general_Table HAR, pharmana_urun_db.general_Table UR
					WHERE HAR.EczaneID = '".$pharmacy_id."' AND  HAR.Yil = '".$dateLastYear."' AND HAR.Barkod = UR.Barkod
					 GROUP BY HAR.Donem";
$resultTwo = mysqli_query($link, $queryTwo );

// Print out rows
$prefix = '';
echo "[\n";
for( $i = 0; $i<12; $i++ ) {
$rowTwo = mysqli_fetch_assoc( $resultTwo );
 $row = mysqli_fetch_assoc( $result );
  echo $prefix . " {\n";
  switch ($i) { 
            case 0: 
                 echo '  "month": "Oca",' . "\n";
                break; 
            case 1: 
                 echo '  "month": "Şub",' . "\n";
                break;   
			case 2: 
                 echo '  "month": "Mar",' . "\n";
                break; 
            case 3: 
                 echo '  "month": "Nis",' . "\n";
                break; 
            case 4: 
                 echo '  "month": "May",' . "\n";
                break;   
			case 5: 
                 echo '  "month": "Haz",' . "\n";
                break; 
            case 6: 
                 echo '  "month": "Tem",' . "\n";
                break; 
            case 7: 
                 echo '  "month": "Ağus",' . "\n";
                break;   
			case 8: 
                 echo '  "month": "Eyl",' . "\n";
                break; 
            case 9: 
                 echo '  "month": "Eki",' . "\n";
                break; 
            case 10: 
                 echo '  "month": "Kas",' . "\n";
                break;   
			case 11: 
                 echo '  "month": "Ara",' . "\n";
                break; 				
        } 
  echo '  "stok": "' . $row["Stok"] . '",' . "\n";
  echo '  "stokLastYear": "' . $rowTwo["Stok"]. '"' . "\n";
  echo " }";
  $prefix = ",\n";
}
echo "\n]";

// Close the connection
mysqli_close( $link );
?>