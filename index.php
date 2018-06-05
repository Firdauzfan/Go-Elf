<?php
// Start the session
   session_start();
   if(!isset($_SESSION['Login'])) {	  
	   header('Location: login.php');   
   } else {
	   header('Location: reservation.php');   
   }
?>   
<html>
<head>
<title>Go-Elf GSPE</title>