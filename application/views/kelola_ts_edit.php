<?php $currentUser  = $this->session->userdata('level'); ?>
<div class="container mt-2">
  <div class="d-flex flex-column p-3 bg-white text-black border rounded">

    <div class="container mt-3 border-btm">
      <div class="d-flex justify-content-beetwen row">
        <div class="col-sm-12 col-md-5 col-lg-5">
            <div><h3>Edit Daftar Masalah <small>(<?= $data_ts->w_name; ?>)</small></h3></div>
        </div>
        <div class="col-sm-12 col-md-7 col-lg-7" style="text-align: right;">
                    <?php if ($a_ware->w_kind == "Hardware") { //pisah nav link softawre hardware
                              if ($currentUser == "admin" || $currentUser == "Koordinator Laboratorium") { ?>
                                  <a href="<?= base_url('adminberanda'); ?>">Beranda</a> > 
                                  <a href="<?= base_url('kelolaperangkat'); ?>">Kelola Perangkat</a> >
                                  <a href="<?= base_url('kelolaperangkat/hardware'); ?>">Kelola Perangkat Keras</a> >
                                  <a href="<?= base_url('kelolaperangkat/ts_data');?>?id=<?= $data_ts->w_id; ?>&user=<?= $this->session->userdata('nama'); ?>">Daftar Masalah</a> >
                                  <b> Edit Daftar Masalah</b>
                          <?php }else{ ?>
                                  <a href="<?= base_url('kelolaperangkat'); ?>">Kelola Perangkat</a> >
                                  <a href="<?= base_url('kelolaperangkat/hardware'); ?>">Kelola Perangkat Keras</a> >
                                  <a href="<?= base_url('kelolaperangkat/ts_data');?>?id=<?= $data_ts->w_id; ?>&user=<?= $this->session->userdata('nama'); ?>">Daftar Masalah</a> >
                                  <a href="<?= base_url('kelolaperangkat/ts_data');?>?id=<?= $data_ts->w_id; ?>&user=<?= $this->session->userdata('nama'); ?>">Daftar Masalah</a> >
                                  <b> Edit Daftar Masalah</b>
                          <?php }
                        }elseif ($a_ware->w_kind == "Software") {
                              if ($currentUser == "admin" || $currentUser == "Koordinator Laboratorium") { ?>
                                  <a href="<?= base_url('adminberanda'); ?>">Beranda</a> > 
                                  <a href="<?= base_url('kelolaperangkat'); ?>">Kelola Perangkat</a> >
                                  <a href="<?= base_url('kelolaperangkat/software'); ?>">Kelola Perangkat Lunak</a> >
                                  <a href="<?= base_url('kelolaperangkat/ts_data');?>?id=<?= $data_ts->w_id; ?>&user=<?= $this->session->userdata('nama'); ?>">Daftar Masalah</a> >
                                  <b> Edit Daftar Masalah</b>
                          <?php }else{ ?>
                                  <a href="<?= base_url('kelolaperangkat'); ?>">Kelola Perangkat</a> >
                                  <a href="<?= base_url('kelolaperangkat/software'); ?>">Kelola Perangkat Lunak</a> >
                                  <a href="<?= base_url('kelolaperangkat/ts_data');?>?id=<?= $data_ts->w_id; ?>&user=<?= $this->session->userdata('nama'); ?>">Daftar Masalah</a> >
                                  <b> Edit Daftar Masalah</b>
                          <?php }
                        }else{
                          echo "no navigation";
                        } ?>
        </div>
      </div>
    </div>

    <form action="<?php echo base_url('kelolaperangkat/upd_ts_data')?>" method="post" id="formUploadImg"
enctype="multipart/form-data">
      <div class="mt-2 mb-2">
        <button class="btn btn-primary btn-sm mr-2" type="submit">Simpan</button>
        <!--<input type="button" class="btn btn-danger btn-sm" onclick="kembali()" value="Batal">-->
        <a href="<?= base_url('kelolaperangkat/ts_data');?>?id=<?= $data_ts->w_id; ?>&user=<?= $data_ts->username; ?>"><input type="button" class="btn btn-danger btn-sm" value="Batal"></a>
      </div>

      <div class="collapsible rounded">
        <input type="text" name="masalah" class="form-control form-control-sm" required value="<?= $data_ts->title; ?>"><br>
        <textarea class="form-control form-control-sm" rows="3" name="deskripsi"><?= $data_ts->detail; ?></textarea>
      </div>

      <div class="content-edit">

        <div class="mb-2 p-3">

          <div class="d-flex flex-column">

            <div class="p-2"><small><b>Solusi</b><br></small>
              <textarea name="solusi" class="form-control form-control-sm" rows="5" id="txtsolusi" required><?= $data_ts->solving; ?></textarea>
              <small>Upload Gambar</small><input type="file" name="gbr" class="btn btn-sm" id="fimg">
            </div>
            <?php if (!empty($data_ts->video)){ ?>
            <div class="p-2"><small><b>Video</b><br></small>
              <input type="text" name="link_vid" class="form-control form-control-sm mb-2" value="<?= $data_ts->video ?>">
                    <div class="embed-responsive embed-responsive-4by3" style="height: 400px;">
                      <iframe class="embed-responsive-item" src="<?php echo $data_ts->video ?>" allowfullscreen></iframe>
                    </div>
            </div>
          <?php }else{ ?>
            <div class="p-2"><small><b>Video</b><br></small>
              <input type="text" name="link_vid" class="form-control form-control-sm mb-2" value="<?= $data_ts->video ?>">
            </div>
          <?php } ?>
            <div class="p-2" hidden="hidden"><small><b>ID Troubleshooting</b><br></small>
              <input readonly type="text" name="id_troubleshooting" value="<?= $data_ts->ts_id; ?>">
            </div>
            <div class="p-2" hidden="hidden"><small><b>User</b><br></small>
              <input readonly type="text" name="id_user" value="<?= $this->session->userdata('nama'); ?>">
            </div>
            <div class="p-2" hidden="hidden"><small><b>Id Perangkat</b><br></small>
              <input readonly type="text" name="id_perangkat" value="<?= $data_ts->w_id; ?>">
            </div>

          </div>

        </div>

      </div>
    </form>
  </div>
</div>

<script type="text/javascript">
  function kembali(){
    window.history.back();
  }

    $("document").ready(function(){
        $("#fimg").change(function(){
        //console.log("proses upload");
        var form = $('#formUploadImg')[0];
        var data = new FormData(form);
          $.ajax({
          type: "POST",
          encytype: 'multipart/form-data',
          processData: false,
          contentType: false,
          cache: false,
          data: data,
          timeout: 5000,
          url: "<?=base_url('kelolaperangkat/imgUpload')?>"
        })
        .done(function(res){
          var url = "<?=base_url('assets/troubleshooting_images/')?>";
          var txtsolusi = $("textarea#txtsolusi").val();
          $("textarea#txtsolusi").val(txtsolusi + "[img]" + url + res + "[/img]");
          console.log(res);
          });
        });
    });

</script>

</body>
</html>