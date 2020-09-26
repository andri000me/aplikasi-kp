<?php $currentUser = $this->session->userdata("nama");?>

<div class="container-menu mt-4">
<?php if ($currentUser == "admin") { ?>

	<div class="row padding">
		<div class="col-sm-12 col-md-6 col-lg-4">
			<div class="card margin-btm">
						<a href="<?= base_url('kelolaperangkat')?>" class="btn btn-outline-success btn-block"><i class="fa fa-desktop"></i><br><hr>Kelola Perangkat</a>
			</div>
		</div>

		<div class="col-sm-12 col-md-6 col-lg-4">
			<div class="card margin-btm">
						<a href="<?php echo base_url('admin_kelolalab') ?>" class="btn btn-outline-info btn-block"><i class="fa fa-clipboard-list"></i><br><hr>Kelola Laboratorium</a>
			</div>
		</div>
		
		<div class="col-sm-12 col-md-6 col-lg-4">
			<div class="card margin-btm">
						<a href="<?php echo base_url();?>admin_kelolapengguna?labId=0" class="btn btn-outline-primary btn-block"><i class="fa fa-user"></i><br><hr>Kelola Pengguna</a>
			</div>
		</div>
	</div>

<?php }else{ ?>
	<div class="row padding">
		<div class="col-sm-12 col-md-6 col-lg-6">
			<div class="card margin-btm">
						<a href="<?= base_url('kelolaperangkat')?>" class="btn btn-outline-success btn-block"><i class="fa fa-desktop"></i><br><hr>Kelola Perangkat</a>
			</div>
		</div>

		<div class="col-sm-12 col-md-6 col-lg-6">
			<div class="card margin-btm">
						<a href="<?php echo base_url('admin_kelolalab/lab_info?id='.$lab->lab_id) ?>" class="btn btn-outline-info btn-block"><i class="fa fa-clipboard-list"></i><br><hr>Kelola Laboratorium</a>
			</div>
		</div>
	</div>
<?php } ?>
</div>
</body>
</html>