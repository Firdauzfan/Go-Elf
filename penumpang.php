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
  <header class="main-header">
    <!-- Logo -->
    <a href="http://gspe.co.id" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>GSPE</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Go-Elf GSPE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="images/logo gspe.png" class="user-image" alt="User Image">
              <span class="hidden-xs">Alexander Pierce</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="images/logo gspe.png" class="img-circle" alt="User Image">

                <p>
                  Ahmad Jourdan - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Logout</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <?php include('sidebar.php') ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper table-responsive">
    <!-- Main content -->
    <section class="content">
      <div class="box-header">
        <i class="fa fa-table"></i>
        <h3 class="box-title">Data Penumpang</h3>
      </div>
      <!-- Main row -->
      <!-- <div class="row"> -->
        <table id="example1" class="table table-hover">
          <thead>
            <tr class="danger">
              <th width="8%">No</th>
              <th>Username</th>
              <th>Email</th>
              <th>Created date</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $sql = mysqli_query($con, "SELECT * FROM users") or die(mysqli_error());
              $i=0;
              while($data=mysqli_fetch_array($sql)){
                $i++;
                $id = $data['id'];
                $username = $data['username'];
                $email = $data['email'];
                $created_at = $data['created_at'];
                $new_created_at = date("d-m-Y", strtotime($created_at));
                echo '<tr class="info">';
                    echo '<td>'.$i.'</td>';
                    echo '<td>'.$username.'</td>';
                    echo '<td>'.$email.'</td>';
                    echo '<td>'.$new_created_at.'</td>';
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
