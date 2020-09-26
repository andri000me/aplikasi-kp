<?php 
    if (isset($_GET['warn'])) {
      if ($_GET['warn']=="success") {
        echo '<script type="text/javascript">window.onload=alert("Data Perangkat Ditambahkan!");</script>';
      }elseif ($_GET['warn']=="delsuccess") {
        echo '<script type="text/javascript">window.onload=alert("Data Perangkat Dihapus!");</script>';
      }elseif ($_GET['warn']=="updsuccess") {
        echo '<script type="text/javascript">window.onload=alert("Data Perangkat Diubah!");</script>';
      }
    }

 ?>

<div class="container mt-2">
  <div class="d-flex flex-column p-3 bg-white text-black border rounded">

<div class="container mt-3 border-btm">
  <div class="d-flex justify-content-beetwen row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div><h3>Edit Perangkat Keras</h3></div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6" style="text-align: right;">
        <?php if ($this->session->userdata('nama') == "admin") { ?>
                <a href="<?= base_url('adminberanda'); ?>">Beranda</a> > 
                <a href="<?= base_url('kelolaperangkat'); ?>">Kelola Perangkat</a> >
                <a href="<?= base_url('kelolaperangkat/hardware'); ?>">Kelola Perangkat Keras</a> >
                <b>Edit Perangkat Keras</b>
        <?php }else{ ?>
                <a href="<?= base_url('kelolaperangkat'); ?>">Kelola Perangkat</a> >
                <a href="<?= base_url('kelolaperangkat/hardware'); ?>">Kelola Perangkat Keras</a> >
                <b>Edit Perangkat Keras</b>           
        <?php } ?>
    </div>
  </div>
</div>
  
      <?php echo form_open_multipart('Kelolaperangkat/modHw'); ?>
        <div class="mt-2 mb-2">
          <button class="btn btn-primary btn-sm mr-2" type="submit">Simpan</button>
          <a href="<?php echo base_url('Kelolaperangkat/hardware')?>">
            <span class="btn btn-danger btn-sm">Batal</span>
          </a>
        </div>

        <div class="table mt-4">
          <table class="table table-sm table-borderless mt-2">
            <tr>
              <th class="w-10">Nama</th>
              <td><input type="text" name="editnama" value="<?= $as->w_name ?>" required class="inputbox-2"></td>
              <div class="hide-form">
                <input type="text" name="editperangkat" class="inputbox-2" required value="Hardware" readonly>
                <input type="text" name="idperangkat" class="inputbox-2" required value="<?php echo $as->w_id; ?>" readonly>
                <input type="text" name="icon" class="inputbox-2" required value="<?php echo $as->w_icon; ?>" readonly>
              </div>
            </tr>

            <tr>
              <th>Icon</th>
              <td>
                <input type="file" name="icon" class="btn btn-sm"><img src="<?php echo base_url('/assets/icon/').$as->w_icon; ?>" style="max-width: 32px;">
              </td>
            </tr>
          </table>
        </div>
      <?php echo form_close(); ?>
    
  </div>
</div>

<script language="JavaScript" type="text/javascript">

  //USER DELETE ALERT
  $(document).ready(function(){
    $("button.del_alert").click(function(e){
      if(!confirm('Anda akan menghapus data')){
        e.preventDefault();
        return false;
      }return true;
    });
  });

</script>


</body>
</html>