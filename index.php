<?php
session_start();


include "fungsi/koneksi.php";
include "fungsi/ceklogin.php";


//cek agar stelah logout dan ada back dari browser,tdk bisa akses input data

$err="";

//disini waktu proses pencet tombol login
if(isset($_POST['login'])){
	$username = $_POST['username'];
	$password = md5($_POST['password']);
//	$password = $_POST['password'];
	$level = $_POST['level'];
	$jabatan = $_POST['jabatan'];

	$query = "SELECT * FROM user WHERE username='$username' && password='$password'";
	$hasil = mysqli_query($koneksi, $query);
	
	if (!$hasil) {
		echo "ada error";
	} 

	if (mysqli_num_rows($hasil) == 0) {
		$err="
		<div class='row' style='margin-top: 15px';>
		<div class='col-md-12'>
		<div class='box box-solid bg-red'>
		<div class='box-header'>
		<h3 class='box-title'>Login Gagal!</h3>
		</div>
		<div class='box-body'>
		<p>Username atau password yang anda masukan salah.</p>
		</div>
		</div>
		</div>
		</div>
		</div>";
	} else {
		$row = mysqli_fetch_array($hasil);
		$_SESSION['username'] = $row['username'];
		$_SESSION['id_user'] = $row['id_user'];
		$_SESSION['jabatan'] = $row['jabatan'];
		$_SESSION['level'] = $row['level'];

		if($row['level'] == "instansi" && $level == "instansi"  ) {
			$_SESSION['login'] = true;
			header("location:instansi/index.php");
		} else if ($row['level'] == "bendahara" && $level == "bendahara" ) {
			$_SESSION['login'] = true;
			header("location:bendahara/index.php");
			
		} else if ($row['level'] == "it" && $level == "it") {
			$_SESSION['login'] = true;
			header("location:it/index.php");

		} else {
			$err="
			<div class='row' style='margin-top: 15px';>
			<div class='col-md-12'>
			<div class='box box-solid bg-red'>
			<div class='box-header'>
			<h3 class='box-title'>Login Gagal!</h3>
			</div>
			<div class='box-body'>
			<p>Anda salah memilih level login.</p>
			</div>
			</div>
			</div>
			</div>
			</div>";
		}
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Sistem Informasi Kelola Barang</title>
	<!-- Icon  -->
	<link rel="shortcut icon" type="image/icon" href="iconjy.jpg">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/bootstrap/css/custom.css" rel="stylesheet">
	<link href="assets/dist/css/AdminLTE.min.css" rel="stylesheet" >
	<link href="assets/plugins/iCheck/square/blue.css" rel="stylesheet">
	<link href="assets/fa/css/font-awesome.min.css" rel="stylesheet">


</head>
<body class="hold-transition login-page">
	<div class="login-box" >
		<div class="login-logo">        
		</div><!-- /.login-logo -->
		<div class="login-box-body" style="border-radius: 20px">
<!--			<h3 class="text-center">SiKerang</h3>-->
			<img src="gambar/SiKerang-Icon.png" style="width: 300px; height: 150px;">
			<form method="post">
				<div class="form-group">           	
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user" style="color: orange"></i></span>
						<input type="text" class="form-control" placeholder="Username" name="username" required  />	            
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-unlock" style="color: #0f74a8"></i></span>
						<input  type="password" class="form-control" placeholder="Password" name="password"  required>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group col-md-7">          	
						<span class="input-group-addon"><i class="fa fa-shield"></i></span>
						<select class="form-control" name="level" required>            	
							<option value>[Pilih Level]</option>
							<option value="instansi">Instansi</option>
							<option value="bendahara">Bendahara</option>
							<option value="it" class="hidden">IT</option>

						</select>
					</div>            
				</div>
				<div class="row" style="border-radius: 25px;">
					<div class="col-xs-12" style="border-radius: 25px;">
						<input type="submit" class="btn btn-adn btn-block btn-flat pull-right" value="Login" name="login"/>

					</div><!-- /.col -->
				</div>
			</form>


		</div>
		<?= $err; ?>
      <!-- /.login-box-body
      <div class="row" style="margin-top: 15px;">
	       <div class="col-md-12">
	        	<div class="box box-solid bg-red">
	        		<div class="box-header">
	        			<h3 class="box-title">Gagal Login</h3>
	        		</div>
	        		<div class="box-body">
	        			<p>Username atau password salah</p>
	        		</div>
	        	</div>
	        </div>
        </div>
    </div>
-->     
<!-- /.login-box -->

<script src="assets/plugins/jQuery/jquery.min.js" type="text/javascript"></script>
<script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>
