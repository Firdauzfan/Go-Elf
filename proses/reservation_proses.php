<?php
include('../config/connect.php');
session_start();
if (!isset($_SESSION['ID'])){
  header("location: Login.php");
}

//$name = $_POST['name'];
$name = $_SESSION['name'];
$seat = $_POST['seat'];
$tujuan = $_POST['tujuan'];
$no_elf = $_POST['no_elf'];

$sql_cek = mysqli_query($con, "SELECT COUNT(username) AS jml FROM reservation WHERE username='$name' AND tujuan='$tujuan' AND DATE(NOW())=DATE(date_booking)") or die(mysqli_error());
$row = mysqli_fetch_assoc($sql_cek);
$jml = $row["jml"];

if($jml<1){
	$sql = mysqli_query($con, "INSERT INTO reservation (id, username, no_seat, no_elf, tujuan, date_booking) VALUES ('', '$name', '$seat', '$no_elf', '$tujuan', NOW())") or die(mysqli_error());	
}else{
	echo '<script language="javascript">';
	echo 'alert("Anda sudah booking")';
	echo '</script>';
}

?>