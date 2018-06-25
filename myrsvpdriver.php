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


if(!empty($_POST)){
   $ids=$_POST['id'];

   $sqldel = mysqli_query($con, "DELETE FROM `rsvpDriver` WHERE id='$ids'") or die(mysqli_error());
   echo "<script>alert('Cancel Booking Berhasil')</script>";

   echo '<script language="javascript">document.location="reservation.php";</script>';
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
        <h3 class="box-title">My Booking</h3>
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
              <th>Cancel Booking</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $user=$_SESSION['name'];
              $sql = mysqli_query($con, "SELECT * FROM `rsvpDriver` WHERE Nama_Supir='$user' order by tgl_booking DESC") or die(mysqli_error());
              $i=0;
              while($data=mysqli_fetch_array($sql)){
                $i++;
                $id=$data['id'];
                $username = $data['Nama_Supir'];
                $elf = $data['elf_ke'];
                $booking_at = $data['tgl_booking'];
                echo '<tr class="info">';
                    echo '<td>'.$i.'</td>';
                    echo '<td>'.$username.'</td>';
                    echo '<td>'.$elf.'</td>';
                    echo '<td>'.$booking_at.'</td>';
                    echo '<td>
                    <form class="form-horizontal" action="" method="post">
                    <input type="hidden" name="id" value="'.$id.'"/>
                    <div class="form-action">
                        <button type="submit" class="btn btn-danger">Cancel</button>
                    </div>
                    </form>
                    </td>';
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
