<div class="container mt-2">
  <div class="d-flex flex-column p-3 bg-white text-black border rounded">

<div class="container mt-3 border-btm">
  <div class="d-flex justify-content-beetwen row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div><h3>Edit Pengguna</h3></div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6" style="text-align: right;">
        <?php if ($this->session->userdata('nama') == "admin") { ?>
          <a href="<?= base_url('adminberanda'); ?>">Beranda</a> >
          <a href="<?= base_url('admin_kelolapengguna?labId='); ?>">Kelola Pengguna</a> > 
          <b>Edit Pengguna</b>
        <?php }else{ ?>
                <a href="<?= base_url('adminberanda'); ?>">Beranda</a> >
                <a href="<?= base_url('admin_kelolalab/lab_info'); ?>">Kelola Laboratorium</a> >
                <b>Edit Pengguna</b> 
        <?php } ?>
    </div>
  </div>
</div>

    <?php if ($this->session->userdata('nama') != "admin") { ?>
    <form action="<?php echo base_url('admin_kelolapengguna/modUser?labId='.$as->lab_id)?>" method="post">

    	<div class="mt-2 mb-2">
        <button class="btn btn-primary btn-sm mr-2" type="submit">Simpan</button>

        <a href="<?php echo base_url('admin_kelolapengguna?labId=').$as->lab_id ?>">
          <span class="btn btn-danger btn-sm">Batal</span>
        </a>
    	</div>

    	<div class="collapsible rounded">
        <small><b>Nama</b></small>
        <input type="text" name="nama" class="form-control form-control-sm" required value="<?= $as->name ?>"><br>

        <small class="hide-form">
          <select class="form-control form-control-sm" name="status" readonly>
            <option selected hidden><?php echo $as->level ?></option>
            <option>Koordinator Laboratorium</option>
            <option>Asisten Laboratorium</option>
          </select>
        </small>
        <small class="hide-form">
          <input type="text" name="lab" class="form-control form-control-sm form-block" required value="<?= $as->lab_id ?>" readonly>
        </small>
      </div>

    	<div class="content-edit">

    		<div class="mb-2 p-3">

    			<div class="d-flex flex-column">

    				<div class="p-2"><small><b>E-Mail</b><br></small>
              <input type="text" name="email" class="form-control form-control-sm form-block" required value="<?= $as->email ?>">
            </div>
    				<div class="p-2"><small><b>Kontak</b><br></small>
              <input type="text" name="kontak" class="form-control form-control-sm" required value="<?= $as->cp ?>">
            </div>
    				<div class="p-2"><small><b>Nama Pengguna</b><br></small>
              <input type="text" name="username" class="form-control form-control-sm" required value="<?= $as->username ?>">
              <div class="hide-form">
                <input type="text" name="u_id" class="form-control form-control-sm" required value="<?= $as->u_id ?>">
              </div>
            </div>
    				<div class="p-2"><small><b>Kata Sandi</b><br></small>
              <input type="text" name="password" class="form-control form-control-sm" required value="<?= $as->password ?>">
            </div>

    			</div>

    		</div>

      </div>

    </form>
  <?php }else{ ?>
    <form action="<?php echo base_url('admin_kelolapengguna/modUser?labId=')?>" method="post">

      <div class="mt-2 mb-2">
        <button class="btn btn-primary btn-sm mr-2" type="submit">Simpan</button>

        <a href="<?php echo base_url('admin_kelolapengguna?labId=')?>">
          <span class="btn btn-danger btn-sm">Batal</span>
        </a>
      </div>

      <div class="collapsible rounded">
        <input type="text" name="nama" class="form-control form-control-sm" required value="<?= $as->name ?>"><br>

        <small>
          <select class="form-control form-control-sm" name="status">
            <option selected hidden><?php echo $as->level ?></option>
            <option>Koordinator Laboratorium</option>
            <option>Asisten Laboratorium</option>
          </select>
        </small><br>

        <small>
          <select class="form-control form-control-sm" name="lab">
            <option selected value="<?php echo $as->lab_id; ?>"><?php echo $as->lab_name ?></option>
                <?php foreach ($optLab as $listLab) : ?>
                  <option value="<?php echo $listLab->lab_id; ?>"><?php  echo $listLab->lab_name; ?></option>
                  <!--PASS VALUE LAB ID KE MODEL??-->
                <?php endforeach; ?>
          </select>
        </small>
      </div>

      <div class="content-edit">

        <div class="mb-2 p-3">

          <div class="d-flex flex-column">

            <div class="p-2"><small><b>E-Mail</b><br></small>
              <input type="text" name="email" class="form-control form-control-sm form-block" required value="<?= $as->email ?>">
            </div>
            <div class="p-2"><small><b>Kontak</b><br></small>
              <input type="text" name="kontak" class="form-control form-control-sm" required value="<?= $as->cp ?>">
            </div>
            <div class="p-2"><small><b>Username</b><br></small>
              <input type="text" name="username" class="form-control form-control-sm" required value="<?= $as->username ?>">
              <div class="hide-form">
                <input type="text" name="u_id" class="form-control form-control-sm" required value="<?= $as->u_id ?>">
              </div>
            </div>
            <div class="p-2"><small><b>Password</b><br></small>
              <input type="text" name="password" class="form-control form-control-sm" required value="<?= $as->password ?>">
            </div>

          </div>

        </div>

      </div>

    </form>

 <?php } ?>

  </div>
</div>

</body>
</html>