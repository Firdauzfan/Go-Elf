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
 $Name = $_POST['Name'];
 $Dept = $_POST['dept'];
 $Jabatan = $_POST['jabatan'];
 $Email = $_POST['email'];
 $NoHP= $_POST['no_hp'];
 $Pass= $_POST['Pass'];
 $fileName   = $_FILES['upload']['name'];  
 $fileSize   = $_FILES['upload']['size'];
 $tmpName    = $_FILES['upload']['tmp_name'];
 $fileType   = $_FILES['upload']['type'];  

 if ($fileName == '' || $fileSize == 0){ 
   $updateSQL = mysqli_query($con, "UPDATE users SET username='$Name',department='$Dept',jabatan='$Jabatan',email='$Email',no_hp='$NoHP',password='$Pass' WHERE id_pegawai='$Id_Pegawai'") or die(mysqli_error());
    echo "<script>";
    echo "alert('Data Berhasil Disimpan')"; 
    echo "</script>"; 
 }else{   
  //penamaan photo
  $tglupload  = gmdate('ymdHis',time()+60*60*7);
  $fileName = explode(" ", $fileName);
  $fileName   = implode("", $fileName);
  //hitung jumlah karakter nama file
  $lenname  = strlen($fileName);
  //pemotongan nama file
  if ($lenname > 20){
    $maxname  = 20;
    $resname  = $lenname - $maxname;
    $cutname  = substr($fileName,$resname,$maxname);
    $fileName   = $cutname;
  }
    //edit nama user yang diinput
  $ex_nama  = explode(" ", $Name);
  $im_nama  = implode("", $ex_nama);  
  
  //Folder tujuan penyimpanan file  
  $nama_poto  = $im_nama."_".$Id_Pegawai."_".$tglupload."_".$fileName;
  $uploadfile = "poto/".$nama_poto;
  $tempatfile = $uploadfile;    
  
  //nama file yang disimpan di database
  $photo    = $uploadfile;
  $typefile   = substr($fileType,0,5);
  
  $upload = move_uploaded_file($tmpName, $tempatfile);

  if (!$upload){
    $pesan = " Upload file gagal";
  }elseif($fileSize > 200000){
     $pesan = "Ukuran file Photo maksimal 200 kb";
  }else{
    $updateSQL = mysqli_query($con, "UPDATE users SET username='$Name',department='$Dept',jabatan='$Jabatan',email='$Email',no_hp='$NoHP',password='$Pass', photo='$uploadfile' WHERE id_pegawai='$Id_Pegawai'") or die(mysqli_error());  
    echo "<script>";
    echo "alert('Data Berhasil Disimpan')"; 
    echo "</script>";
  }

}
}

?>

<?php
$Id_Pegawai= $_SESSION['id_peg'];

$sqlconf = mysqli_query($con, "SELECT * FROM config") or die(mysqli_error());
$sconf = mysqli_fetch_assoc($sqlconf);


$path=$sconf['path'];

$sql = mysqli_query($con, "SELECT * FROM users WHERE id_pegawai='$Id_Pegawai'") or die(mysqli_error());
$rowe = mysqli_fetch_assoc($sql);
$poto = $rowe['photo'];
$photo = $path."/".$poto;

?>

<script type="text/javascript">
function poto(){
  document.getElementById("img").src = document.getElementById("upload").value;
}
</script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include('head.php') ?>
  <!-- Left side column. contains the logo and sidebar -->
  <?php include('sidebar.php') ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper table-responsive">
    <!-- Main content -->
     <section class="content">
       <div class="box-header">
       <div class="box box-primary">
            <div class="box-header with-border">
                      <i class="fa fa-table"></i>
        <h3 class="box-title">Data Profil <?php echo $rowe['username']; ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="profil.php" method="post" name="profil" id="profil" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <img  name="img" id="img" class ="classfancy" src="<?php echo $photo; ?>" href = "<?php echo $photo; ?>" title="<?php echo $_SESSION['name']; ?>" width="150" height="200" border="1" align="center" style="border-color:#FC9" />
                </div>

                <div class="form-group">
                  <label for="NoID">Nomor ID</label>
                  <input name="id_pegawai" class="form-control" type="text" id="id_pegawai" value="<?php echo $_SESSION['id_peg']; ?>" size="15" readonly />
                </div>

               <div class="form-group">
                  <label for="Nama">Nama</label>
                  <input name="Name" class="form-control" type="text" id="Name" value="<?php echo $rowe['username']; ?>" size="30" />    
                </div>

                <div class="form-group">
                  <label for="Password">Password</label>
                   <input name="Pass" class="form-control" type="password" id="Pass" value="<?php echo $rowe['password']; ?>" size="30"/>   
                </div>

                <div class="form-group">
                  <label for="Department">Department</label>
                  <input name="dept" class="form-control" type="text" id="dept" size="30" value="<?php echo $rowe['department']; ?>"/>  
                </div>

                <div class="form-group">
                  <label for="Jabatan">Jabatan</label>
                  <input name="jabatan" class="form-control" type="text" id="jabatan" value="<?php echo $rowe['jabatan']; ?>" size="30" />  
                </div>

                <div class="form-group">
                  <label for="Email">Email</label>
                  <input name="email" class="form-control" type="text" id="email" value="<?php echo strtolower($rowe['email']); ?>" size="30" />  
                </div>

                <div class="form-group">
                  <label for="Mobile">Mobile</label>
                  <input name="no_hp" class="form-control" type="text" id="no_hp" value="<?php echo $rowe['no_hp']; ?>" size="30" />  
                </div>

                <div class="form-group">
                  <label for="Photo">Photo</label>
                  <input type="file" name="upload" id="upload" onChange="poto()"/>

                  <p class="help-block">File photo maksimal 200 kb.</p>
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <input type="submit" class="btn btn-primary" name="tSubmit" name="tSubmit" value="Update Account" />
              </div>
            </form>
          </div>


      </div>
      <!-- Main row -->
      <!-- <div class="row"> -->

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
