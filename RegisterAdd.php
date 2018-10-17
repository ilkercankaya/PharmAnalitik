<?php
//RegisterAdd.php
session_start();

if(isset($_SESSION["admin"]))
{
		error_reporting( 0 );
	$connect = mysqli_connect('localhost', 'pharmana_general', '123456pharmana', 'pharmana_user_db');
	if ( !$connect ) {
    die( 'Could not connect: ' . mysqli_error() );
	}
	 mysqli_set_charset($connect, "utf8"); /* Procedural approach */
	 $username = mysqli_real_escape_string($connect, $_POST["username"]);
	$password = md5(mysqli_real_escape_string($connect, $_POST["password"]));
	$sql = "SELECT * FROM general_Table WHERE username = '".$username."' ";
	 $result = mysqli_query($connect, $sql);
	 $num_row = mysqli_num_rows($result);
	 if($num_row < 1)
	{
  
 
$sqlAdd = "INSERT INTO `general_Table`(`username`, `Kullanici_Adi`, `Kullanici_Soyadi`, `Telefon`, `GSM`, `Mail`, `password`, `Gorevi`, `Eczane_Adi`, `EczaneID`) VALUES ('".$username."','-','-','-','-','-','".$password."','-','-','-')";
   mysqli_query($connect, $sqlAdd);
   while($connect->query("SELECT * FROM general_Table WHERE username = '".$username."' AND password = '".$password."'") != TRUE)
   {
sleep(1);
   }
 $sql = "SELECT * FROM general_Table WHERE username = '".$username."' AND password = '".$password."'";
 $result = mysqli_query($connect, $sql);
 $num_row = mysqli_num_rows($result);
 if($num_row > 0)
 {
  echo "success";
 
 }
	}
	mysqli_close( $connect );
}
?>