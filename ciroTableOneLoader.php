<?php
session_start();
error_reporting( 0 );
	$connect = mysqli_connect('localhost', 'pharmana_general', '123456pharmana', 'pharmana_Hareket_db');
	 if ( !$connect ) {
    die( 'Could not connect: ' . mysqli_error() );
	}
	 mysqli_set_charset($connect, "utf8"); /* Procedural approach */
	
 $dateYear = mysqli_real_escape_string($connect, date('Y'));
 $dateLastYear = mysqli_real_escape_string($connect, date("Y",strtotime("-1 year")));
 $pharmacy_id = mysqli_real_escape_string($connect, $_SESSION["pharmacy_id"]);
 $sql = "SELECT SUM(KDV_Haric_Ciro) AS Ciro ,UR.Ana_Kategori AS Ana_Kategori 
					FROM pharmana_Hareket_db.general_Table HAR, pharmana_urun_db.general_Table UR 
					Where HAR.EczaneID = '".$pharmacy_id."' AND HAR.Yil = '".$dateYear."' 	AND HAR.Barkod = UR.Barkod
					GROUP BY UR.Ana_Kategori";
 $resultTable = mysqli_query($connect, $sql);

  $sqlTwo = "SELECT SUM(KDV_Haric_Ciro) AS Ciro , UR.Ana_Kategori AS Ana_Kategori 
					FROM pharmana_Hareket_db.general_Table HAR, pharmana_urun_db.general_Table UR
					Where HAR.EczaneID = '".$pharmacy_id."' AND HAR.Yil = '".$dateLastYear."' 	AND HAR.Barkod = UR.Barkod
					GROUP BY UR.Ana_Kategori";
 $resultTableTwo = mysqli_query($connect, $sqlTwo);
 												 //Creating JSON
												 $resultSet = array();
												$resultSetTwo = array();
												$totalLastYear = 0;
												$totalThisYear = 0;
														while(($row = mysqli_fetch_assoc($resultTable))) {
													$resultSet[] = $row;	
													$totalThisYear += $row["Ciro"];													
												}
												while(($row = mysqli_fetch_assoc($resultTableTwo))) {
													$resultSetTwo[] = $row;
													$totalThisYear += $row["Ciro"];				
												}
												$variable = true;
												$i=1;
												//PART one of crossup (if 2017 exists but 2016 doesnt)
												$prefix = '';
												echo "[\n";
												foreach($resultSet as $tyc){
														foreach($resultSetTwo as $tylc){
														  if($tyc['Ana_Kategori'] === $tylc['Ana_Kategori']) {
															$perc = ($tyc["Ciro"] / $totalThisYear * 100);
															$Lastperc = ($tyc["Ciro"] / $totalLastYear * 100);
															echo $prefix . " {\n";
															echo '  "Sira": "' . $i . '",' . "\n";
															echo '  "Ana_Kategori": "' . $tyc["Ana_Kategori"] . '",' . "\n";
															echo '  "CiroThisYear": "' . $tyc["Ciro"] . '",' . "\n";
															echo '  "CiroLastYear": "' . $tylc["Ciro"] . '",' . "\n";
															echo '  "PercThisYear": "' . $perc . '",' . "\n";
															echo '  "PercLastYear": "' . $Lastperc. '"' . "\n";
															echo " }";
															$prefix = ",\n";
															$i++;
															$variable=false;
														  }
														}
														if ($variable==true)
														{
															$perc = ($tyc["Ciro"] / $totalThisYear * 100);												
															echo $prefix . " {\n";
															echo '  "Sira": "' . $i . '",' . "\n";
															echo '  "Ana_Kategori": "' . $tyc["Ana_Kategori"] . '",' . "\n";
															echo '  "CiroThisYear": "' . $tyc["Ciro"] . '",' . "\n";
															echo '  "CiroLastYear": "' . '0.00' . '",' . "\n";
															echo '  "PercThisYear": "' . $perc . '",' . "\n";
															echo '  "PercLastYear": "' . '0.00'. '"' . "\n";
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
															$perc = ($tyc["Ciro"] / $totalThisYear * 100);
															echo $prefix . " {\n";
															echo '  "Sira": "' . $i . '",' . "\n";
															echo '  "Ana_Kategori": "' . $tyc["Ana_Kategori"] . '",' . "\n";
															echo '  "CiroThisYear": "' . '0.00' . '",' . "\n";
															echo '  "CiroLastYear": "' . $tyc["Ciro"] . '",' . "\n";
															echo '  "PercThisYear": "' . '0.00' . '",' . "\n";
															echo '  "PercLastYear": "' . $perc. '"' . "\n";
															echo " }";		
															$prefix = ",\n";
															$i++;
														}
												}
												echo "\n]";
 
 
 mysqli_close( $connect );
?>