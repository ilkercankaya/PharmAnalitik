<?php
//editItemAction.php
session_start();
if(isset($_SESSION["admin"]))
{
	error_reporting( 0 );
 $connect = mysqli_connect('localhost', 'pharmana_general', '123456pharmana', 'pharmana_urun_db');
 if ( !$connect ) {
    die( 'Could not connect: ' . mysqli_error() );
	}
  mysqli_set_charset($connect, "utf8"); /* Procedural approach */
 $barcode = mysqli_real_escape_string($connect, $_SESSION["admin"]);
 
 $Urun_Adi = mysqli_real_escape_string($connect, $_POST["Urun_Adi"]);
 $Ana_Kategori = mysqli_real_escape_string($connect, $_POST["Ana_Kategori"]);
 $Kategori = mysqli_real_escape_string($connect, $_POST["Kategori"]);
 $Grup = mysqli_real_escape_string($connect, $_POST["Grup"]);
 $AltGrup = mysqli_real_escape_string($connect, $_POST["AltGrup"]);
 $Bolum = mysqli_real_escape_string($connect, $_POST["Bolum"]);
 $AltBolum = mysqli_real_escape_string($connect, $_POST["AltBolum"]);
 $Markasi = mysqli_real_escape_string($connect, $_POST["Markasi"]);
 $Ureticisi = mysqli_real_escape_string($connect, $_POST["Ureticisi"]);
 $Ithalatci = mysqli_real_escape_string($connect, $_POST["Ithalatci"]);
 $Ozel_Kodu = mysqli_real_escape_string($connect, $_POST["Ozel_Kodu"]);
 $I_Grubu = mysqli_real_escape_string($connect, $_POST["I_Grubu"]);
 $Reyonu = mysqli_real_escape_string($connect, $_POST["Reyonu"]);
 $Icerik = mysqli_real_escape_string($connect, $_POST["Icerik"]);
 $Icerik_Miktar = mysqli_real_escape_string($connect, $_POST["Icerik_Miktar"]);
 $Birim = mysqli_real_escape_string($connect, $_POST["Birim"]);
 $Paket_ici_Miktar = mysqli_real_escape_string($connect, $_POST["Paket_ici_Miktar"]);
 $Paket_ici_Birim = mysqli_real_escape_string($connect, $_POST["Paket_ici_Birim"]);
 $Paket_Barkod = mysqli_real_escape_string($connect, $_POST["Paket_Barkod"]);
 $Koli_ici_Miktar = mysqli_real_escape_string($connect, $_POST["Koli_ici_Miktar"]);
 $Koli_ici_Birim = mysqli_real_escape_string($connect, $_POST["Koli_ici_Birim"]);
 $Koli_Barkod = mysqli_real_escape_string($connect, $_POST["Koli_Barkod"]);
 $Genislik = mysqli_real_escape_string($connect, $_POST["Genislik"]);
 $Yukseklik = mysqli_real_escape_string($connect, $_POST["Yukseklik"]);
 $Derinlik = mysqli_real_escape_string($connect, $_POST["Derinlik"]);
 $On_Resim = mysqli_real_escape_string($connect, $_POST["On_Resim"]);
 $Sol_Resim = mysqli_real_escape_string($connect, $_POST["Sol_Resim"]);
 $Ust_Resim = mysqli_real_escape_string($connect, $_POST["Ust_Resim"]);
 $Sag_Resim = mysqli_real_escape_string($connect, $_POST["Sag_Resim"]);

  $sql = "
 UPDATE general_Table
 SET Urun_Adi = '".$Urun_Adi."' , Ana_Kategori = '".$Ana_Kategori."' , Kategori = '".$Kategori."', 
 Grup = '".$Grup."' , AltGrup = '".$AltGrup."', Bolum = '".$Bolum."' , AltBolum = '".$AltBolum."', Markasi = '".$Markasi."',
  Ureticisi = '".$Ureticisi."' , Ithalatci = '".$Ithalatci."' , Ozel_Kodu = '".$Ozel_Kodu."' , I_Grubu = '".$I_Grubu."' , Reyonu = '".$Reyonu."' ,Icerik_Miktar = '".$Icerik_Miktar."', Birim = '".$Birim."' , Paket_ici_Miktar = '".$Paket_ici_Miktar."', Paket_ici_Birim = '".$Paket_ici_Birim."',
   Icerik = '".$Icerik."' , AltGrup = '".$AltGrup."', Bolum = '".$Bolum."' , AltBolum = '".$AltBolum."', Markasi = '".$Markasi."',
    Paket_Barkod = '".$Paket_Barkod."' , Koli_ici_Miktar = '".$Koli_ici_Miktar."', Koli_ici_Birim = '".$Koli_ici_Birim."' , Koli_Barkod = '".$Koli_Barkod."', Genislik = '".$Genislik."',
	 Yukseklik = '".$Yukseklik."' , Derinlik = '".$Derinlik."', On_Resim = '".$On_Resim."' , Sol_Resim = '".$Sol_Resim."', Ust_Resim = '".$Ust_Resim."',
	  Sag_Resim = '".$Sag_Resim."'
 WHERE Barkod = '".$barcode."' 
 
 
 
 ";
 $result = mysqli_query($connect, $sql);
 if(mysqli_affected_rows($connect) > 0)
 {
    echo "success";
 }
 	 mysqli_close( $connect );
}
else
{
	header("location:home");
}
?>