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
        <i class="fa fa-table"></i>
        <h3 class="box-title">List Booking Driver</h3>
      </div>
      <!-- Main row -->
      <!-- <div class="row"> -->
        <table id="example1" class="table table-hover">
          <thead>
            <tr class="danger">
              <th width="8%">No</th>
              <th>Username</th>
              <th>Elf ke</th>
              <th>Booking Time</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $sql = mysqli_query($con, "SELECT * FROM `rsvpDriver` WHERE date(tgl_booking) = CURDATE()") or die(mysqli_error());
              $i=0;
              while($data=mysqli_fetch_array($sql)){
                $i++;
                $username = $data['Nama_Supir'];
                $elf = $data['elf_ke'];
                $booking_at = $data['tgl_booking'];
                echo '<tr class="info">';
                    echo '<td>'.$i.'</td>';
                    echo '<td>'.$username.'</td>';
                    echo '<td>'.$elf.'</td>';
                    echo '<td>'.$booking_at.'</td>';
                echo '</tr>';     
              }
            ?>
          </tbody>
        </table>
  <!--</div> -->
      <!-- /.row (main row) -->
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
