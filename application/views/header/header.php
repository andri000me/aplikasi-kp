<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Troubleshooting Perangkat Komputer</title>

	  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/style.css">
	  <script src="<?php echo base_url('assets/js/jquery-3.4.1.min.js'); ?>"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" type="text/javascript"></script>
	  <script src="<?= base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>

	  <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
</head>

<body>	
<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top shadow mb-4">
	<div class="container">
		<a href="<?php echo base_url(); ?>adminberanda" class="navbar-brand">
			<img src="<?php echo base_url();?>images/dlsu.png" class="dlsu">
			<span style="font-family: Roboto;">Troubleshooting<br>
				<small style="font-family: Roboto;">Perangkat Komputer</small>
			</span>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item"><hr></li>
				<li class="nav-item shadow p-2">
					<a href="#" class="nav-link disabled" style="color: green;">
						<i class="fa fa-user-circle"></i><b> <?php echo $this->session->userdata("nama"); ?></b>
					</a>
				</li>
				<li class="nav-item shadow p-2">
					<?php
						$userLevel = $this->session->userdata("level");
					if ($userLevel == "admin" || $userLevel == "Koordinator Laboratorium") { ?>
						<a href=" <?= base_url('adminberanda'); ?> " class="nav-link"><i class="fa fa-home"></i>Beranda</a>
					<?php }else{ ?>
							<a href=" <?= base_url('kelolaperangkat'); ?> " class="nav-link"><i class="fa fa-home"></i>Beranda</a>
					<?php } ?>	
				</li>
				<li class="nav-item shadow p-2">
					<?php if ($userLevel == "admin"){ ?>
						<a href="<?php echo base_url('login/logout'); ?>" class="nav-link"><i class="fa fa-sign-out-alt"></i>Keluar</a>
					<?php }else{ ?>
						<a href="<?php echo base_url('login/logout_aslab'); ?>" class="nav-link"><i class="fa fa-sign-out-alt"></i>Keluar</a>
					<?php } ?>
				</li>
			</ul>
		</div>

	</div>
</nav>