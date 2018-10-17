<?php
//TableTwoLoader.php
session_start();
error_reporting( 0 );
	$connect = mysqli_connect('localhost', 'pharmana_general', '123456pharmana', 'pharmana_Hareket_db');
	 if ( !$connect ) {
    die( 'Could not connect: ' . mysqli_error() );
	}
	 mysqli_set_charset($connect, "utf8"); /* Procedural approach */
 $name = mysqli_real_escape_string($connect, $_POST["name"]);
 $dateYear = mysqli_real_escape_string($connect, date('Y'));
 $dateLastYear = mysqli_real_escape_string($connect, date("Y",strtotime("-1 year")));
 $pharmacy_id = mysqli_real_escape_string($connect, $_SESSION["pharmacy_id"]);
 $sql = "SELECT SUM(KDV_Haric_Ciro) AS Ciro, UR.Kategori AS Kategori 
 FROM pharmana_Hareket_db.general_Table HAR, pharmana_urun_db.general_Table UR
 WHERE HAR.EczaneID = '".$pharmacy_id."'  AND UR.Ana_Kategori = '".$name."' AND HAR.Yil = '".$dateYear."' AND HAR.Barkod = UR.Barkod
 GROUP BY UR.Kategori  
 ";
 $result = mysqli_query($connect, $sql);
 $sqlTwo = "SELECT SUM(KDV_Haric_Ciro) AS Ciro, UR.Kategori AS Kategori 
 FROM pharmana_Hareket_db.general_Table HAR, pharmana_urun_db.general_Table UR 
  WHERE HAR.EczaneID = '".$pharmacy_id."'  AND UR.Ana_Kategori = '".$name."' AND HAR.Yil = '".$dateLastYear."' AND HAR.Barkod = UR.Barkod
 GROUP BY UR.Kategori ";
 $resultTwo = mysqli_query($connect, $sqlTwo);
												 //Creating JSON
												 $resultSet = array();
												$resultSetTwo = array();
														while(($row = mysqli_fetch_assoc($result))) {
													$resultSet[] = $row;												
												}
												while(($row = mysqli_fetch_assoc($resultTwo))) {
													$resultSetTwo[] = $row;
												}
												$variable = true;
												$i=1;
												//PART one of crossup (if 2017 exists but 2016 doesnt)
												$prefix = '';
												echo "[\n";
												foreach($resultSet as $tyc){
														foreach($resultSetTwo as $tylc){
														  if($tyc['Kategori'] === $tylc['Kategori']) {
															echo $prefix . " {\n";
															echo '  "Sira": "' . $i . '",' . "\n";
															echo '  "Kategori": "' . $tyc["Kategori"] . '",' . "\n";
															echo '  "CiroThisYear": "' . $tyc["Ciro"] . '",' . "\n";
															echo '  "CiroLastYear": "' . $tylc["Ciro"]. '"' . "\n";
															echo " }";
															$prefix = ",\n";
															$i++;
															$variable=false;
														  }
														}
														if ($variable==true)
														{
															echo $prefix . " {\n";
															echo '  "Sira": "' . $i . '",' . "\n";
															echo '  "Kategori": "' . $tyc["Kategori"] . '",' . "\n";
															echo '  "CiroThisYear": "' . $tyc["Ciro"] . '",' . "\n";
															echo '  "CiroLastYear": "' . '0.00'. '"' . "\n";
															echo " }";
															$prefix = ",\n";
															$i++;
														}
												}
												//PART two of crossup (if 2016 exist but 2017 doesnt)
												$variable = true;
												foreach($resultSetTwo as $tyc){
														foreach($resultSet as $tylc){
														  if($tyc['Kategori'] === $tylc['Kategori']) {
																$variable=false;
														  }
														}
														if ($variable==true)
														{
															echo $prefix . " {\n";
															echo '  "Sira": "' . $i . '",' . "\n";
															echo '  "Kategori": "' . $tyc["Kategori"] . '",' . "\n";
															echo '  "CiroThisYear": "' . '0.00' . '",' . "\n";
															echo '  "CiroLastYear": "' . $tyc["Ciro"] . '"' . "\n";
															echo " }";
															$prefix = ",\n";
															$i++;
														}
												}
												echo "\n]";
 mysqli_close( $connect );
?>