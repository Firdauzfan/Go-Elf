<!DOCTYPE html>
<html>
<head>
<?php 
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
include('header.php'); 
include('config/connect.php');
// Start the session
session_start();
// Cek Login Apakah Sudah Login atau Belum
if (!isset($_SESSION['ID'])){
// Jika Tidak Arahkan Kembali ke Halaman Login
  header("location: login.php");
} 

?>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include('head.php') ?>
  <!-- Left side column. contains the logo and sidebar -->
  <?php include('sidebar.php') ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper table-responsive">
    <!-- Main content -->
    <section class="content" style="margin-left: 10px;margin-right: 10px;">
      <div class="box-header">
        <i class="fa fa-map-marker"></i>
        <h3 class="box-title">Tracking Elf</h3>
      </div>
      <!-- Main row -->
      <!-- <div class="row"> -->
  <!--</div> -->
      <!-- /.row (main row) -->
      <div class="embed-responsive embed-responsive-16by9" style="height: 1000px">
        <iframe class="embed-responsive-item" src="http://35.202.49.101:8080/dashboards/3b1d5d60-6ac2-11e8-ae79-6b7f9ada6497?publicId=65dcdc70-2809-11e8-8468-1bf2911c1791" allowfullscreen></iframe>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include('footer.php'); ?>
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<?php include('tracking.php'); ?>
<script src="assets/js/jquery.nicescroll.js"></script>
<script src="assets/js/scripts.js"></script>
</body>
</html>
