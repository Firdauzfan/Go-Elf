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

<?php
if(isset($_POST['tSubmit'])){
 $Id_Pegawai= $_POST['id_pegawai'];
 $email= $_POST['email'];
 $Nama_Supir= $_POST['nama_supir'];
 $no_hp= $_POST['no_hp'];
 $tanggal= $_POST['tanggal'];
 $no_elf = $_POST['no_elf'];

 if (empty($_POST['tanggal']) || empty($_POST['no_elf'])) {
 	echo "<script>";
    echo "alert('tanggal dan no elf Harus Diisi')"; 
   	echo "</script>"; 
 }else{

 $sql_cek = mysqli_query($con, "SELECT COUNT(Nama_Supir) AS jml FROM rsvpDriver WHERE id_pegawai='$Id_Pegawai' AND tgl_booking='$tanggal' ") or die(mysqli_error());
 $row = mysqli_fetch_assoc($sql_cek);
 $jml = $row["jml"];

 $sql_cek2 = mysqli_query($con, "SELECT COUNT(Nama_Supir) AS jml FROM rsvpDriver WHERE elf_ke='$no_elf' AND tgl_booking='$tanggal' ") or die(mysqli_error());
 $row2 = mysqli_fetch_assoc($sql_cek2);
 $jml2 = $row2["jml"];

 if ($jml<1 && $jml2<1) {
 	$sql = mysqli_query($con, "INSERT INTO rsvpDriver (id,ID_Pegawai,Nama_Supir,no_hp,email,elf_ke,tgl_booking) VALUES ('', '$Id_Pegawai', '$Nama_Supir','$no_hp','$email','$no_elf','$tanggal')") or die(mysqli_error());

 	echo '<script language="javascript">document.location="myrsvpdriver.php";</script>';
 }
 else{
 	echo "<script>";
    echo "alert('Sudah Dibooking Oleh Supir Lain')"; 
   	echo "</script>"; 
 }
 }

}
?>

</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include('head.php') ?>
  <!-- Left side column. contains the logo and sidebar -->
  <?php include('sidebar.php') ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
        <section class="content">
          <!-- quick email widget -->
          <div class="box box-info" style="border-top-color: #ffffff;">
            <div class="box-header">
              <i class="fa fa-calendar"></i>
              <h3 class="box-title">Booking Elf</h3>
            </div>
            <div class="box-body">
              <form action="bookelf.php" method="post">
              	<input name="id_pegawai" type="text" id="id_pegawai" value="<?php echo $_SESSION['id_peg']; ?>" hidden />
              	<input name="email" type="text" id="email" value="<?php echo $_SESSION['email']; ?>" hidden />
              	<input name="nama_supir" type="text" id="nama_supir" value="<?php echo $_SESSION['name']; ?>" hidden />
              	<input name="no_hp" type="text" id="no_hp" value="<?php echo $_SESSION['no_hp']; ?>" hidden />
              	<div class="form-group">
	              <div class="input-group date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-format="yyyy-mm-dd">
	                    <input class="form-control" id="tanggal" name="tanggal" size="16" type="text">
	                          <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
	                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
	                      </div>
	            </div>
                <div class="form-group" style="width: 60%;">
                  <label>Elf ke-</label>
                  <select class="form-control" name="no_elf" id="no_elf">
                    <option style="text-align: center;">--- Pilih ---</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                  </select>
                </div>
                  <a type="button" class="pull-left btn btn-default" href="myrsvpdriver.php">My Reservation</a>
                  <input type="submit" name="tSubmit" id="tSubmit" value="Book "/>
	              <i class="fa fa-arrow-circle-right"></i>
              </form>
            </div>

          </div>
        </section>
</div>
<?php include('footer.php'); ?>
<div class="control-sidebar-bg"></div>
</div>

<?php include('tracking.php'); ?>
<script src="assets/js/jquery.nicescroll.js"></script>
<script src="assets/js/scripts.js"></script>
<link href="assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="assets/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="assets/js/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>
<script type="text/javascript">
  $('.form_date').datetimepicker({
  language: 'id',
  weekStart: 0,
  todayBtn:  1,
  autoclose: 1,
  todayHighlight: 1,
  startView: 2,
  minView: 2,
  forceParse: 0
  });
</script>


</body>
</html>