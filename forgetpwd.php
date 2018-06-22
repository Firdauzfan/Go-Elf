<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Reset Password</title>

<link href="assets/css/bootstrap.min.css" rel="stylesheet">

</head>

<?php
include('config/connect.php');
///////////////////////////////////////////////////////////////////////
if (isset($_POST['act_resset']))  {
date_default_timezone_set("Asia/Jakarta");
$pass="1A2B4HTjsk5kwhadbwlff"; $panjang='8'; $len=strlen($pass); 
$start=$len-$panjang; $xx=rand('0',$start); 
$yy=str_shuffle($pass); 
$passwordbaru=substr($yy, $xx, $panjang);

$email = $_POST['email'];
$password = $passwordbaru;

// mencari alamat email si user
$hasil = mysqli_query($con, "SELECT * FROM users WHERE email ='$email'") or die(mysqli_error());
$data  = mysqli_fetch_array($hasil);
$cek = mysqli_num_rows($hasil);
$id_pegawai = $data['id_pegawai'];
$alamatEmail = $data['email'];
$nama = $data['usernama'];
$username =$data['username'];

if ($cek == 1) {

// title atau subject email
$title  = "Permintaan Password Baru";
// isi pesan email disertai password
$pesan  = "Kami telah meresset Ulang Kata sandi ".$nama." Dan anda dapat login kembali ke web kami \n\n 
DETAIL AKUN ANDA :\n Nama Penguna : ".$username." \n 
Kata sandi Anda yang baru adalah: ".$passwordbaru."\n\n 
\n\n PESAN NO-REPLY";
// header email berisi alamat pengirim
$header = "From: Go-Elf<no-reply@gspe-intercon.com>";

// mengirim email
$kirimEmail = mail($alamatEmail, $title, $pesan, $header);
// cek status pengiriman email
if ($kirimEmail) { 

    // update password baru ke database (jika pengiriman email sukses)
    $hasil = mysqli_query($con, "UPDATE users SET password='$password' WHERE id_pegawai = '$id_pegawai'") or die(mysqli_error());

    if ($hasil) 
	echo "<script>alert('Silahkan Cek Email Untuk Password Baru')</script>";
	echo '<script language="javascript">document.location="login.php";</script>';
}
	else {
echo "<script>alert('Pengiriman Password Baru Gagal')</script>";
}
}
else{

echo "<script>alert('Email Tidak Ditemukan')</script>";
}}

?>

<body>
<br>
<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<img class="img-responsive" alt="GSPE" src="images/logovio.png">
				<div class="panel-heading"><b>Reset Password</b></div>
				<div class="panel-body">
					<form action="forgetpwd.php" method="post">
						<fieldset>
							<div class="form-group">
								<label>Masukkan Email Anda</label>
							</div>
							<div class="form-group">
								<input class="form-control" name="email" type="email" placeholder="Masukkan Email" required oninvalid="this.setCustomValidity('Masukkan Email Dengan benar')">
							</div>
							<br>
							<input class="button" name="act_resset" type="submit" value="Reset">

						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div>


</body>
</html>
