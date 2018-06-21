<?php
include('config/connect.php');
$Id_Pegawai= $_SESSION['id_peg'];

$sqlconf = mysqli_query($con, "SELECT * FROM config") or die(mysqli_error());
$sconf = mysqli_fetch_assoc($sqlconf);


$path=$sconf['path'];

$sql = mysqli_query($con, "SELECT * FROM users WHERE id_pegawai='$Id_Pegawai'") or die(mysqli_error());
$rowe = mysqli_fetch_assoc($sql);
$poto = $rowe['photo'];
$photo = $path."/".$poto;

?>

<link href="assets/css/navbar.css" rel="stylesheet">
<header class="main-header">
    <!-- Logo -->
    <a href="reservation.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>VIO</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Go-Elf VIO</span>
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
           <?php
          if ($_SESSION['role']=='supir') {
          ?>

          <?php
          $supirName= $_SESSION['name'];
          $sql_elfke = mysqli_query($con, "SELECT * FROM `rsvpDriver` WHERE tgl_booking=CURRENT_DATE() AND Nama_Supir='$supirName'") or die(mysqli_error());
          $rowelf = mysqli_fetch_assoc($sql_elfke);
          $elfke = $rowelf["elf_ke"];
          ?>

          <?php
          $sql_jml = mysqli_query($con, "SELECT COUNT(username) AS jml FROM `reservation` WHERE reservation.status=0 AND reservation.date_booking>=CURDATE() AND reservation.no_elf='$elfke' ") or die(mysqli_error());
          $row = mysqli_fetch_assoc($sql_jml);
          $jml = $row["jml"];
          ?>
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" onclick="myFunction()">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning" id="notification-count"><?php echo $jml; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <?php echo $jml; ?> notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                       <?php
                        $tgl_booking = date("Y-m-d");
                        $sql = mysqli_query($con, "SELECT * FROM `reservation` WHERE reservation.date_booking>=CURDATE() AND reservation.no_elf='$elfke' limit 10") or die(mysqli_error());
                        while($data=mysqli_fetch_array($sql)){
                          $username = $data['username'];
                          $no_seat = $data['no_seat'];
                          $keberangkatan = $data['keberangkatan'];
                          $tujuan = $data['tujuan'];
                          echo '
                          <li>
                          <a href="#">
                          <i class="fa fa-users text-aqua"></i> '.$username.' memesan kursi '.$no_seat.'
                          </a>
                          </li>';    
                        }
                      ?>
                </ul>
              </li>
              <li class="footer"><a href="list_booking.php">View all</a></li>
            </ul>
          </li>
          <?php
    }
    ?>

    <script>
    function myFunction() {
      $.ajax({
      url: "proses/notif.php",
      type: "POST",
      processData:false,
      success: function(data){
        $("#notification-count").remove();          
      },
      error: function(){}           
    });
    }
    </script>

          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $photo; ?>" class="user-image" alt="<?php echo $_SESSION['name']; ?>">
              <span class="hidden-xs"><?php echo $_SESSION['name']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo $photo; ?>" class="img-circle" alt="<?php echo $_SESSION['name']; ?>">

                <p>
                  <?php echo $_SESSION['name']; ?> 
                  <small>PT.Graha Sumber Prima Elektronik</small>
                  <!-- <small>Member since <?php echo $_SESSION['date']; ?></small> -->
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="profil.php" class="btn btn-default btn-flat">Profile</a>
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