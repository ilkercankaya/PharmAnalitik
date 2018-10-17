<?php
//editProfileAction.php
session_start();

if(isset($_SESSION["username"]))
{
	error_reporting( 0 );
 $connect = mysqli_connect('localhost', 'pharmana_general', '123456pharmana', 'pharmana_user_db');
 if ( !$connect ) {
    die( 'Could not connect: ' . mysqli_error() );
	}
 mysqli_set_charset($connect, "utf8"); /* Procedural approach */
 $username = mysqli_real_escape_string($connect, $_SESSION["username"]);
 $name = mysqli_real_escape_string($connect, $_POST["name"]);
 $surname = mysqli_real_escape_string($connect, $_POST["surname"]);
 $phone_number = mysqli_real_escape_string($connect, $_POST["phone_number"]);
 $GSM = mysqli_real_escape_string($connect, $_POST["GSM"]);
 $mail = mysqli_real_escape_string($connect, $_POST["mail"]);
 $work = mysqli_real_escape_string($connect, $_POST["work"]);
 $pharmacy_name = mysqli_real_escape_string($connect, $_POST["pharmacy_name"]);
 $pharmacy_id = mysqli_real_escape_string($connect, $_POST["pharmacy_id"]);
 $sql = "
 UPDATE general_Table
 SET Kullanici_Adi = '".$name."' , Kullanici_Soyadi = '".$surname."' , Telefon = '".$phone_number."', GSM = '".$GSM."' , Mail = '".$mail."', Gorevi = '".$work."' , Eczane_Adi = '".$pharmacy_name."', EczaneID = '".$pharmacy_id."'
 WHERE username = '".$username."' ";
 $result = mysqli_query($connect, $sql);
 if(mysqli_affected_rows($connect) > 0)
 {
	$_SESSION["pharmacy_id"] = $_POST["pharmacy_id"];
    echo "success";
 }
 	mysqli_close( $connect );
}
else
{
	header("location:home");
}
?>