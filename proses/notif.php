<?php
include('../config/connect.php');
session_start();
if (!isset($_SESSION['ID'])){
  header("location: login.php");
}

$supirName= $_SESSION['name'];
$sql_elfke = mysqli_query($con, "SELECT * FROM `rsvpDriver` WHERE tgl_booking=CURRENT_DATE() AND Nama_Supir='$supirName'") or die(mysqli_error());
$rowelf = mysqli_fetch_assoc($sql_elfke);
$elfke = $rowelf["elf_ke"];

$sql="UPDATE `reservation` SET `status`='1' WHERE reservation.status=0 AND reservation.date_booking>=CURDATE() AND reservation.no_elf='$elfke'";	
$result=mysqli_query($con, $sql);

?>