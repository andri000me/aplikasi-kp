<div class="container" style="overflow: hidden;">

<div class="container border-btm">
  <div class="d-flex justify-content-end row">
  		<div class="col-sm-12 col-md-6 col-lg-6">
  			<h3 class="ml-2">Kelola Perangkat</h3>
		</div>
  		<div class="col-sm-12 col-md-6 col-lg-6" style="text-align: right;">
  			<?php 
  			$session = $this->session->userdata('level');
  			if ($session == "admin" || $session == "Koordinator Laboratorium") { ?>
  				<div><a href="<?= base_url('adminberanda'); ?>">Beranda</a> > <b>Kelola Perangkat</b></div>
  			<?php }else{  } ?>
		</div>
  </div>
</div>

	<div class="container-menu mt-4">
	<div class="row padding justify-content-center">
		<div class="col-sm-12 col-md-6 col-lg-6">
			<div class="card margin-btm">
						<a href="<?php echo base_url('Kelolaperangkat/hardware') ?>" class="btn btn-success"><i class="fa fa-desktop"></i><br><hr>Perangkat Keras</a>
			</div>
		</div>

		<div class="col-sm-12 col-md-6 col-lg-6">
			<div class="card margin-btm">
						<a href="<?php echo base_url('Kelolaperangkat/software') ?>" class="btn-sw"><i class="far fa-window-restore"></i><br><hr>Perangkat Lunak</a>
			</div>
		</div>
	</div>
	</div>

</div>

</body>
</html>