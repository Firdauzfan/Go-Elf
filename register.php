<?php
session_start();
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
// Start the session

?>   
<!DOCTYPE html>
<html>
<head>
<?php
date_default_timezone_set('Asia/Jakarta');
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Register</title>

<link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
include('config/connect.php');
if(isset($_POST['tSubmit'])){
 $Id_Pegawai= $_POST['id_pegawai'];
 $Name = $_POST['Name'];
 $Pass = $_POST['Pass'];
 $Dept = $_POST['dept'];
 $Jabatan = $_POST['jabatan'];
 $Email = $_POST['email'];
 $NoHP= $_POST['no_hp'];
	 //$dept_id =  $_POST['dept_id'];
	 $sql = mysqli_query($con, "INSERT INTO users (id_user,id_pegawai,username,department,jabatan,email,no_hp,password,created_at) VALUES ('', '$Id_Pegawai', '$Name','$Dept','$Jabatan','$Email','$NoHP','$Pass', NOW())") or die(mysqli_error());

 echo '<script language="javascript">document.location="login.php";</script>';
}
?>

<body>
	<br>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<img class="img-responsive" alt="GSPE" src="images/logo gspe.png">
				<div class="panel-heading"><b>Register</b></div>
				<div class="panel-body">
					<form role="form" name="Register" action="register.php" method="POST">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Id pegawai" name="id_pegawai" type="text" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Username" name="Name" type="text" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Department" name="dept" type="text" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Jabatan" name="jabatan" type="text" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" type="email" placeholder="Email" name="email" type="text" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="No HP" name="no_hp" type="text" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="Pass" type="password">
							</div>
							<br>
							<input type="Submit" class="btn btn-primary" name="tSubmit" value=" Register ">
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<!-- <script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script> -->
	<script>
		!function ($) {
			$(document).on("click","ul.nav li.parent > a > span.icon", function(){		  
				$(this).find('em:first').toggleClass("glyphicon-minus");	  
			}); 
			$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>

</html>