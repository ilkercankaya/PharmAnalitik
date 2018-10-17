<?php
//login.php
session_start();
if(isset($_POST["username"]) && isset($_POST["password"]))
{
	error_reporting( 0 );
	$connect = mysqli_connect('localhost', 'pharmana_general', '123456pharmana', 'pharmana_user_db');
	if ( !$connect ) {
    die( 'Could not connect: ' . mysqli_error() );
	}
	 mysqli_set_charset($connect, "utf8"); /* Procedural approach */
 $username = mysqli_real_escape_string($connect, $_POST["username"]);
 $password = md5(mysqli_real_escape_string($connect, $_POST["password"]));
 $sql = "SELECT * FROM general_Table WHERE username = '".$username."' AND password = '".$password."'";
 $result = mysqli_query($connect, $sql);
 $num_row = mysqli_num_rows($result);
 if($num_row > 0)
 {
  $data = mysqli_fetch_array($result);
  $_SESSION["username"] = $data["username"];
  $_SESSION["pharmacy_id"] = $data["EczaneID"];
  echo $data["username"];
 }
  mysqli_close( $connect );
}
?>