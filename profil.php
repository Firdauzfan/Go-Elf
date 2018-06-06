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
 $fileName   = $_FILES['upload']['name'];  
 $fileSize   = $_FILES['upload']['size'];
 $tmpName    = $_FILES['upload']['tmp_name'];
 $fileType   = $_FILES['upload']['type'];  

 if ($fileName == '' || $fileSize == 0){ 
   $updateSQL = mysqli_query($con, "UPDATE users SET username='$Name',department='$Dept',jabatan='$Jabatan',email='$Email',no_hp='$NoHP' WHERE id_pegawai='$Id_Pegawai'") or die(mysqli_error());
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
  $uploadfile = "/poto/".$nama_poto;
  $tempatfile = "../GO-Elf/".$uploadfile;    
  
  //nama file yang disimpan di database
  $photo    = $uploadfile;
  $typefile   = substr($fileType,0,5);
  
  $upload = move_uploaded_file($tmpName, $tempatfile);

  if (!$upload){
    $pesan = " Upload file gagal";
  }elseif($fileSize > 200000){
     $pesan = "Ukuran file Photo maksimal 200 kb";
  }else{
    $updateSQL = mysqli_query($con, "UPDATE users SET username='$Name',department='$Dept',jabatan='$Jabatan',email='$Email',no_hp='$NoHP', photo='$uploadfile' WHERE id_pegawai='$Id_Pegawai'") or die(mysqli_error());  
    echo "<script>";
    echo "alert('Data Berhasil Disimpan')"; 
    echo "</script>";
  }

}
}

?>

<?php
$Id_Pegawai= $_SESSION['id_peg'];

$path="http://localhost/Go-Elf";

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
        <i class="fa fa-table"></i>
        <h3 class="box-title">Data Profil <?php echo $_SESSION['name']; ?></h3>
      </div>
      <!-- Main row -->
      <!-- <div class="row"> -->

<form action="profil.php" method="post" name="profil" id="profil" enctype="multipart/form-data">
<fieldset>
    <table border="1" cellpadding="5" cellspacing="10" align="center" style="margin-left: 10px">
      <tr>
       <td><table border="0" cellpadding="2" cellspacing="1">
      <tr>
        <div class="form-group">
        <td width="100">Nomor ID</td>
        <td width="10">:</td>
        <td><label><span id="sprytextfield1">
          <input name="id_pegawai" type="text" id="id_pegawai" value="<?php echo $_SESSION['id_peg']; ?>" size="15" readonly />
        </span> </label></td>
       <!--  <td rowspan="9" align="left" valign="top">
        <img  name="img" id="img" class ="classfancy" src="<?php echo $photo; ?>" href = "<?php echo $photo; ?>" title="<?php echo $_SESSION['name']; ?>" width="137" height="160" border="1" style="border-color:#FC9" /></td> -->
        </div>
      </tr>
      <tr>
        <div class="form-group">
        <td><label>Nama</label></td>
        <td align="left">:</td>
        <td><span id="sprytextfield2">
          <input name="Name" type="text" id="Name" value="<?php echo $_SESSION['name']; ?>" size="30" readonly />         
        </span></td>
        </div>
      </tr>
      <tr>
        <div class="form-group">
        <td>Department</td>
        <td align="left">:</td>
        <td><span id="sprytextfield6">
          <input name="dept" type="text" id="dept" size="30" value="<?php echo $rowe['department']; ?>"/>         
        </span></td>
        </div>
      </tr>
      <tr>
        <div class="form-group">
        <td>Jabatan</td>
        <td align="left">:</td>
        <td><span id="sprytextfield5">
          <input name="jabatan" type="text" id="jabatan" value="<?php echo $rowe['jabatan']; ?>" size="30" />         
        </span></td>
        </div>
      </tr>
      <tr>
        <div class="form-group">
        <td>Email</td>
        <td align="left">:</td>
        <td><span id="sprytextfield3">
          <input name="email" type="text" id="email" value="<?php echo strtolower($rowe['email']); ?>" size="30" />          
          <!-- <span class="textfieldRequiredMsg"></span><span class="textfieldInvalidFormatMsg">Invalid format.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span> --></span></td>
        </div>
      </tr>
      <tr>
        <div class="form-group">
        <td>Mobile </td>
        <td align="left">:</td>
        <td><span id="sprytextfield4">
          <input name="no_hp" type="text" id="no_hp" value="<?php echo $rowe['no_hp']; ?>" size="30" />          
          <!-- <span class="textfieldInvalidFormatMsg">Invalid format.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span>  --></span></td>
          </div>
      </tr>
      <tr>
        <td>Photo</td>
        <td align="left">:</td>
        <td nowrap="nowrap"><input type="file" name="upload" id="upload" onChange="poto()"/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>File photo maksimal 200 kb.</td>
        <td align="right"><input type="submit" name="tSubmit" name="tSubmit" value="Update Account" /></td>
      </tr>      
    </table></td>
  </tr>
</table>
</fieldset>
</form>
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
