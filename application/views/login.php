<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Troubleshooting Perangkat Komputer | Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" type="text/javascript"></script>
	<script src="<?= base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>

	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

</head>
<body>
	<?php
		if (isset($_GET['warn'])) {
			if ($_GET['warn']=="loginFailed") {
				echo '<script type="text/javascript">window.onload=alert("Username atau Password salah");</script>';
			}
		}
	?>

		<section class="row justify-content-center">
			<div class="formlogin">
				<h5 class="login_header">Troubleshooting <br>Perangkat Komputer</h5>
				<div align="center"><img src = "<?= base_url();?>images/dlsu.png" style="width: 110px; height: 110px;"></div>
				<h6 align="center" class="mt-1">Laboratorium Komputer</h6>
				<h6 align="center" >Fakultas Teknik</h6>
				<hr>
				 
				<form action="<?= base_url('login/aksi_login'); ?>" method="post">
					<!--<small>username</small>-->
					<div class="form-group">
						<input type="text" name="uname" class="form-control" placeholder="Nama Pengguna" required autofocus>
					</div>
					<!--<small>password</small>-->
					<div class="form-group">
						<input type="password" name="pass" placeholder="Kata Sandi" class="form-control" required>
					</div>
					<input type="submit" class="loginbtn" value="MASUK">
				</form>
			</div>
		</section>

</body>
</html>