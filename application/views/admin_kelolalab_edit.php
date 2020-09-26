<div class="container mt-2">
  <div class="d-flex flex-column p-3 bg-white text-black border rounded">

<div class="container mt-3 border-btm">
  <div class="d-flex justify-content-beetwen row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div><h3>Edit Informasi Laboratorium</h3></div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6" style="text-align: right;">
        <?php if ($this->session->userdata('nama') == "admin") { ?>
          <a href="<?= base_url('adminberanda'); ?>">Beranda</a> >
          <a href="<?= base_url('admin_kelolalab'); ?>">Kelola Laboratorium</a> > 
          <b>Edit Informasi Laboratorium</b>
        <?php }else{ ?>
        <?php } ?>
    </div>
  </div>
</div>

	<form action="<?php echo base_url('admin_kelolalab/editLab?labId='.$lab_detail->lab_id)?>" method="post">
    	<div class="mt-2 mb-2">
	        <button class="btn btn-primary btn-sm mr-2" type="submit">Simpan</button>
	        <a href="<?php echo base_url('admin_kelolalab') ?>">
	          <span class="btn btn-danger btn-sm">Batal</span>
	        </a>
    	</div>

    	<div>
    		<small>Nama Laboratorium</small>
			<input type="text" name="nama" placeholder="" class="form-control form-control-sm mb-2" value="<?php echo $lab_detail->lab_name; ?>" required>
			<small>Kapasitas</small>
			<input type="number" min="1" max="40" name="kapasitas" class="form-control form-control-sm mb-2" value="<?php echo $lab_detail->capacity; ?>" required>
		</div>
	</form>

  </div>
</div>

</body>
</html>