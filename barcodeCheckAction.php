<?php
//BarcodeCheckAction.php
session_start();
if(isset($_SESSION["admin"]))
{
	error_reporting( 0 );
	$connect = mysqli_connect('localhost', 'pharmana_general', '123456pharmana', 'pharmana_urun_db');
	if ( !$connect ) {
    die( 'Could not connect: ' . mysqli_error() );
	}
	 mysqli_set_charset($connect, "utf8"); /* Procedural approach */
	 $barcode = mysqli_real_escape_string($connect, $_POST["barcode"]);
	 $sql = "SELECT * FROM general_Table WHERE Barkod = '".$barcode."' ";
 $result = mysqli_query($connect, $sql);
  $data = mysqli_fetch_assoc($result);
 $num_row = mysqli_num_rows($result);
 if($num_row <1)
	{
		echo "fail";
	}
	else
	{
		$_SESSION["admin"] = $data["Barkod"];
		echo "success";
	}
	mysqli_close( $connect );
}
else
{
	header("location:AdminLoginPage");
}
?>