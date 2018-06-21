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
        <h3 class="box-title">List Booking</h3>
      </div>
      <!-- Main row -->
      <!-- <div class="row"> -->
        <table id="example1" class="table table-hover">
          <thead>
            <tr class="danger">
              <th width="8%">No</th>
              <th>Username</th>
              <th>Keberangkatan</th>
              <th>Tujuan</th>
              <th>Elf ke</th>
              <th>Kursi ke</th>
              <th>Booking Time</th>
            </tr>
          </thead>
          <tbody>
            <?php
              if ($_SESSION['role']=='supir') {
                $supirName= $_SESSION['name'];
                $sql_elfke = mysqli_query($con, "SELECT * FROM `rsvpDriver` WHERE tgl_booking=CURRENT_DATE() AND Nama_Supir='$supirName'") or die(mysqli_error());
                $rowelf = mysqli_fetch_assoc($sql_elfke);
                $elfke = $rowelf["elf_ke"];

                $sql = mysqli_query($con, "SELECT * FROM `reservation` WHERE date(date_booking) = CURDATE() AND no_elf='$elfke'") or die(mysqli_error());
              }else{
                $sql = mysqli_query($con, "SELECT * FROM `reservation` WHERE date(date_booking) = CURDATE()") or die(mysqli_error());
              }
              $i=0;
              while($data=mysqli_fetch_array($sql)){
                $i++;
                $username = $data['username'];
                $Keberangkatan = $data['keberangkatan'];
                $tujuan = $data['tujuan'];
                $elf = $data['no_elf'];
                $kursi = $data['no_seat'];
                $booking_at = $data['date_booking'];
                echo '<tr class="info">';
                    echo '<td>'.$i.'</td>';
                    echo '<td>'.$username.'</td>';
                    echo '<td>'.$Keberangkatan.'</td>';
                    echo '<td>'.$tujuan.'</td>';
                    echo '<td>'.$elf.'</td>';
                    echo '<td>'.$kursi.'</td>';
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
