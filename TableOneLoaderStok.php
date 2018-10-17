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
 //SQLONE
	$sqlTable = "SET @toplamStok = (select SUM(Stok)
FROM (
SELECT SUM(KDV_Haric_Ciro) AS Ciro,SUM(Stok_Alis_Tutari) AS Stok, UR.Ana_Kategori AS Ana_Kategori
                                        FROM pharmana_Hareket_db.general_Table HAR, pharmana_urun_db.general_Table UR
                                        WHERE HAR.EczaneID = '".$pharmacy_id."' AND HAR.Donem = '".$name."' AND HAR.Barkod = UR.Barkod AND Yil = '".$dateYear."' 
										GROUP BY Ana_Kategori
                                        ORDER BY `Stok` DESC
) as t );";

$sqlTable .= "SELECT SUM(KDV_Haric_Ciro) AS Ciro, SUM(Stok_Alis_Tutari) AS Stok , UR.Ana_Kategori AS Ana_Kategori , (SUM(Stok_Alis_Tutari) * 100.0) / @toplamStok AS Yuzde
                                         FROM pharmana_Hareket_db.general_Table HAR, pharmana_urun_db.general_Table UR
										  Where HAR.EczaneID = '".$pharmacy_id."' AND HAR.Donem = '".$name."' AND HAR.Barkod = UR.Barkod AND Yil = '".$dateYear."' 
										 GROUP BY UR.Ana_Kategori
                                        ORDER BY `Stok` DESC
										";
	$c=0;
	if (mysqli_multi_query($connect, $sqlTable)) {
    do {
        /* store first result set */
        if ($resultTable = mysqli_store_result($connect)) {
               if($c>0)
				   break;
            
            mysqli_free_result($resultTable);
        }
        /* print divider */
        if (mysqli_more_results($connect)) {
           
        }
		$c++;
    } while (mysqli_next_result($connect));
}
//SQLTWO
//SQLTWO
 $sqlTableTwo = "SET @toplamStok = (select SUM(Stok)
FROM (
SELECT SUM(KDV_Haric_Ciro) AS Ciro,SUM(Stok_Alis_Tutari) AS Stok, UR.Ana_Kategori AS Ana_Kategori
                                       FROM pharmana_Hareket_db.general_Table HAR, pharmana_urun_db.general_Table UR
                                        WHERE HAR.EczaneID = '".$pharmacy_id."' AND HAR.Donem = '".$name."' AND HAR.Barkod = UR.Barkod AND Yil = '".$dateLastYear."' 
										GROUP BY Ana_Kategori
                                        ORDER BY `Stok` DESC
) as t );";

$sqlTableTwo .= "
SELECT SUM(KDV_Haric_Ciro) AS Ciro, SUM(Stok_Alis_Tutari) AS Stok , UR.Ana_Kategori AS Ana_Kategori , (SUM(Stok_Alis_Tutari) * 100.0) / @toplamStok AS Yuzde
                                         FROM pharmana_Hareket_db.general_Table HAR, pharmana_urun_db.general_Table UR
										  Where HAR.EczaneID = '".$pharmacy_id."' AND HAR.Donem = '".$name."' AND HAR.Barkod = UR.Barkod AND Yil = '".$dateLastYear."' 
										 GROUP BY UR.Ana_Kategori
                                        ORDER BY `Stok` DESC
 ";
	$c=0;
	if (mysqli_multi_query($connect, $sqlTableTwo)) {
    do {
        /* store first result set */
        if ($resultTableTwo = mysqli_store_result($connect)) {
               if($c>0)
				   break;
            
            mysqli_free_result($resultTableTwo);
        }
        /* print divider */
        if (mysqli_more_results($connect)) {
           
        }
		$c++;
    } while (mysqli_next_result($connect));
}
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
														  if($tyc['Ana_Kategori'] === $tylc['Ana_Kategori']) {
															$Stok_Devir_Günü = ($tyc["Stok"] / ( $tyc["Ciro"] / 25));
															$Stok_Devir_Günü_LastYear = ($tylc["Stok"] / ( $tylc["Ciro"] / 25));
															echo $prefix . " {\n";
															echo '  "Sira": "' . $i . '",' . "\n";
															echo '  "Ana_Kategori": "' . $tyc["Ana_Kategori"] . '",' . "\n";
															echo '  "StokThisYear": "' . $tyc["Stok"] . '",' . "\n";
															echo '  "StokLastYear": "' . $tylc["Stok"] . '",' . "\n";
															echo '  "PercThisYear": "' . $tyc["Yuzde"].'%' . '",' . "\n";
															echo '  "PercLastYear": "' . $tylc["Yuzde"].'%' . '",' . "\n";
															echo '  "StokGunuThisYear": "' . $Stok_Devir_Günü . '",' . "\n";
															echo '  "StokGunuLastYear": "' . $Stok_Devir_Günü_LastYear. '"' . "\n";
															echo " }";
															$prefix = ",\n";
															$i++;
															$variable=false;
														  }
														}
														if ($variable==true)
														{
															$Stok_Devir_Günü = ($tyc["Stok"] / ( $tyc["Ciro"] / 25));															
															echo $prefix . " {\n";
															echo '  "Sira": "' . $i . '",' . "\n";
															echo '  "Ana_Kategori": "' . $tyc["Ana_Kategori"] . '",' . "\n";
															echo '  "StokThisYear": "' . $tyc["Stok"] . '",' . "\n";
															echo '  "StokLastYear": "' . '0' . '",' . "\n";
															echo '  "PercThisYear": "' . $tyc["Yuzde"].'%' . '",' . "\n";
															echo '  "PercLastYear": "' . '0' . '",' . "\n";
															echo '  "StokGunuThisYear": "' . $Stok_Devir_Günü . '",' . "\n";
															echo '  "StokGunuLastYear": "' . '0'. '"' . "\n";
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
															$Stok_Devir_Günü_LastYear = ($tyc["Stok"] / ( $tyc["Ciro"] / 25));
															echo $prefix . " {\n";
															echo '  "Sira": "' . $i . '",' . "\n";
															echo '  "Ana_Kategori": "' . $tyc["Ana_Kategori"] . '",' . "\n";
															echo '  "StokThisYear": "' . '0' . '",' . "\n";
															echo '  "StokLastYear": "' . $tyc["Stok"] . '",' . "\n";
															echo '  "PercThisYear": "' . '0' . '",' . "\n";
															echo '  "PercLastYear": "' . $tyc["Yuzde"].'%' . '",' . "\n";
															echo '  "StokGunuThisYear": "' . '0' . '",' . "\n";
															echo '  "StokGunuLastYear": "' . $Stok_Devir_Günü_LastYear. '"' . "\n";
															echo " }";		
															$prefix = ",\n";
															$i++;
														}
												}
												echo "\n]";
 mysqli_close( $connect );
?>