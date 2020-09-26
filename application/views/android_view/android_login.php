
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Beranda</title>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" type="text/javascript"></script>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/style.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body>

	<?php
		if (isset($_GET['warn'])) {
			if ($_GET['warn']=="loginFailed") {
				echo '<script type="text/javascript">window.onload=alert("Username atau Password salah");</script>';
			}
		}
	?>

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div id="dismiss">
                <i class="fas fa-arrow-left"></i>
            </div>

            <div class="sidebar-header">
                <a href="<?php echo base_url(); ?>Android_controller" class="navbar-brand"><img src="<?php echo base_url();?>images/dlsubig.png" class="dlsu">
                    <span style="color: white;">Troubleshooting<br><small>Perangkat Komputer</small></span>
                </a>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="<?php echo base_url('Android_controller'); ?>">Beranda</a>
                </li>
                <li>
                    <a href="<?php echo base_url('Android_controller/list_perangkat?w=Hardware'); ?>">Perangkat Keras</a>
                </li>
                <li>
                    <a href="<?php echo base_url('Android_controller/list_perangkat?w=Software'); ?>">Perangkat Lunak</a>
                </li>
                <hr>
                <li class="active">
                    <a href="<?php echo base_url('Android_controller/login'); ?>">Login</a>
                </li>
            </ul>
        </nav>

        <!-- Konten  -->
        <div id="content">

                <div class="rounded d-flex justify-content-between" style="overflow: hidden; margin: 0px auto;">
                   
                    <div style="z-index: 299;" class="p-1">
                        <button type="button" id="sidebarCollapse" class="btn btn-default">
                            <i class="fas fa-bars" style="color: #7C7C7D;"></i>
                        </button>
                    </div>               

                </div>

				<section class=" row justify-content-center">
					<div class="formlogin-android">
						<h5 class="login_header">Troubleshooting <br>Perangkat Komputer</h5>
						<div align="center"><img src = "<?= base_url();?>images/dlsu-login.png" style="width: 110px; height: 110px;"></div>
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

        </div>
    </div>

    <div class="overlay"></div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <script type="text/javascript" src="<?= base_url(); ?>assets/js/android.js"></script>

</body>

</html>