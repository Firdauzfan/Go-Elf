<?php
include('../config/connect.php');
session_start();
if (!isset($_SESSION['ID'])){
  header("location: login.php");
}

$tujuan = $_POST['tujuan'];
$no_elf = $_POST['no_elf'];

$list_seat = mysqli_query($con, "SELECT no_seat FROM reservation WHERE no_elf='$no_elf' AND tujuan='$tujuan' AND DATE(NOW())=DATE(date_booking)") or die(mysqli_error());
$result = array();
while ($row=mysqli_fetch_array($list_seat)) {
	$result[] = $row["no_seat"];
}
echo json_encode($result)
?>