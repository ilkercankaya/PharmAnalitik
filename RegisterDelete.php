<?php
//RegisterDelete.php
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
  
  $sql = "DELETE FROM general_Table	WHERE username = '".$username."' ";
  $result = mysqli_query($connect, $sql);
 if (mysqli_affected_rows($connect) < 1)
 {
	 $data["username"] = "fail";
  echo $data["username"];
 }
 else
 {
	 	 $data["username"] = "success";
  echo $data["username"];
 }
  mysqli_close( $connect );
	}
?>