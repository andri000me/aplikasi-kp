<?php 
    if (isset($_GET['warn'])) {
      if ($_GET['warn']=="success") {
        echo '<script type="text/javascript">window.onload=alert("Data Ditambahkan! Mohon menunggu validasi");</script>';
      }elseif ($_GET['warn']=="delsuccess") {
        echo '<script type="text/javascript">window.onload=alert("Data Dihapus!");</script>';
      }elseif ($_GET['warn']=="updsuccess") {
        echo '<script type="text/javascript">window.onload=alert("Data Diubah!");</script>';
      }
    }

$currentUser  = $this->session->userdata('level');

?>


<div class="container mt-2 mb-4">
    <div class="d-flex flex-column p-3 bg-white text-black border rounded">

          <div class="container mt-3 border-btm">
            <div class="d-flex justify-content-beetwen row">
              <div class="col-sm-12 col-md-6 col-lg-6">
                  <div><h3>Daftar Masalah <small>(<?= $a_ware->w_name; ?>)</small></h3></div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-6" style="text-align: right;">
                <?php if ($a_ware->w_kind == "Hardware") { //pisah nav link softawre hardware
                          if ($currentUser == "admin" || $currentUser == "Koordinator Laboratorium") { ?>
                              <a href="<?= base_url('adminberanda'); ?>">Beranda</a> > 
                              <a href="<?= base_url('kelolaperangkat'); ?>">Kelola Perangkat</a> >
                              <a href="<?= base_url('kelolaperangkat/hardware'); ?>">Kelola Perangkat Keras</a> >
                              <b>Daftar Masalah</b>
                      <?php }else{ ?>
                              <a href="<?= base_url('kelolaperangkat'); ?>">Kelola Perangkat</a> >
                              <a href="<?= base_url('kelolaperangkat/hardware'); ?>">Kelola Perangkat Keras</a> >
                              <b>Daftar Masalah</b>
                      <?php }
                    }elseif ($a_ware->w_kind == "Software") {
                          if ($currentUser == "admin" || $currentUser == "Koordinator Laboratorium") { ?>
                              <a href="<?= base_url('adminberanda'); ?>">Beranda</a> > 
                              <a href="<?= base_url('kelolaperangkat'); ?>">Kelola Perangkat</a> >
                              <a href="<?= base_url('kelolaperangkat/software'); ?>">Kelola Perangkat Lunak</a> >
                              <b>Daftar Masalah</b>
                      <?php }else{ ?>
                              <a href="<?= base_url('kelolaperangkat'); ?>">Kelola Perangkat</a> >
                              <a href="<?= base_url('kelolaperangkat/software'); ?>">Kelola Perangkat Lunak</a> >
                              <b>Daftar Masalah</b>
                      <?php }
                    }else{
                      echo "no navigation";
                    } ?>
              </div>
            </div>
          </div>

        	<div class="mt-2 mb-2">
            <div class="d-flex justify-content-beetwen row">
              <div class="col-7">
                  <button class="btn btn-primary btn-sm" onclick="modal()" data-toggle="modal" data-target="#myModal"><b>+</b>Tambah Data</button>
              </div>
              <div class="col-5" style="text-align: right;">
                  <div>
                    <input type="text" name="" class="inputbox-3 p-1" id="input" onkeyup="searchTable()" placeholder=" Cari...">
                  </div>
              </div>
            </div>
        	</div>

          <table id="sortTable" style="overflow: hidden; width: 100%">
            <tr><td>
              <?php 
                foreach ($all_ware as $val) { 
                  $d        = $val->upd_date;
                  $tanggal  = date("d-m-Y", strtotime($d));

                  $status   = ($val->status == 1)?site_url('kelolaperangkat/unapprove/?ts_id='.$val->ts_id.'&w_id='.$val->w_id.'&user='.$currentUser):site_url('kelolaperangkat/approved/?ts_id='.$val->ts_id.'&w_id='.$val->w_id.'&user='.$currentUser); //CEK PASS W_ID DAN USER
                ?>

                <?php if ($currentUser != "admin") { ?>

                <?php }else { ?>
                  <hr>
                  <div class="mb-1">
                      <small><b>Status:</b></small>
                      <a href="<?php echo $status; ?>" style="text-decoration: none; z-index: 1;" title="Tekan untuk mengubah status">
                        <span style="color: white;" class="badge <?= ($val->status == 1)?'badge-success':'badge-secondary'; ?>">
                          <?php echo ($val->status == 1)?'<b>Diteruskan</b>':'<b>Menunggu</b>'; ?>
                        </span>
                      </a>
                  </div>
                <?php } ?>

              <button class="collapsible rounded mb-1">
                    <small style="font-size: 12pt;">
                      <?php echo $this->bbcode->parse($val->title); ?><hr>
                      <?php echo $this->bbcode->parse($val->detail); ?>
                    </small>
              </button>

              <div class="content" style="width: 100%;">
                <?php if ($currentUser == "admin" || $currentUser == "Koordinator Laboratorium"): ?>
                    <table class="mt-2">
                      <tr>
                        <td>
                          <div class="d-flex row ml-1 p-2">
                            <a href="<?= base_url('kelolaperangkat/edit_ts_data');?>?id=<?= $val->ts_id;?>&wId=<?= $a_ware->w_id; ?>"> <!--LIHAT ID DISINI-->
                              <button type="submit" class="btn btn-sw btn-sm mr-2" style="width: 67.4px;">
                                <i class="fa fa-edit"></i>Edit
                              </button>
                            </a>
                            <!--form delete-->
                            <form action="<?php echo base_url('kelolaperangkat/delete_ts_data'); ?>?user=<?= $this->session->userdata("nama"); ?>" method="post">
                              <button type="submit" class="btn btn-danger btn-sm del_alert">
                                <i class="fa fa-trash"></i>
                              Hapus</button>
                              <div class="hide-form">
                                <input type="text" class="btn btn-tersier" name="id_ts" value="<?php echo $val->ts_id; ?>">
                                <input type="text" name="id_perangkat" value="<?php echo $val->w_id ?>">
                              </div>
                            </form>                          
                        </div>
                      </td>
                    </tr>
                  </table>
                <?php endif ?>

                <div class="d-flex flex-column p-2">
                  <div>
                    <b>Solusi</b><br>
                    <?php echo $this->bbcode->parse($val->solving); ?>
                    <hr>
                    <!--Modal preview gambar-->
                    <div id="modalImgPreview" class="modalImg">
                      <span class="closeImgPrev">&times;</span>
                      <img class="ImgContent" id="img01">
                    </div>
                  </div>
                </div>

                      <?php if (!empty($val->video)) { ?>
                      <div class="p-2"><small><b>Video</b><br></small>
                          <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="<?php echo $val->video ?>" allowfullscreen></iframe>
                          </div> <hr> <!--UKURAN VIDEO COBA LIA ULANG-->
                      </div>
                    <?php } ?>

                      <div class="p-2"><small><b>Dibuat oleh:</b><br></small>
                        <?php echo $val->name;?> (<?php echo $tanggal; ?>)
                      </div>

              </div>
            <?php } ?>
            </td></tr>
          </table>

    </div>
</div>

  <!-- AddThings Modal -->
<form method="post" id="formUploadImg" action="<?php echo base_url('kelolaperangkat/add_ts_data'); ?>" enctype="multipart/form-data">
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data</h4>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <table style="width: 100%;">
              <tr>
                <td>
                  <small>Masalah</small><br>
                  <input type="text" name="masalah" class="form-control form-control-sm" required>
                </td>
              </tr>

              <tr>
                <td hidden>
                  <small>ID Perangkat</small><br>
                  <small>w_id</small>
                  <input type="text" name="id_perangkat" class="form-control form-control-sm" required value="<?= $a_ware->w_id; ?>" readonly>
                  <small>u_id</small>
                  <input type="text" name="id_user" class="form-control form-control-sm" required value="<?php echo $user_id->u_id; ?>" readonly>
                </td>
              </tr>

              <tr><td>
                <small>Deskripsi</small><br>
                <textarea name="deskripsi" class="form-control form-control-sm" rows="3" required></textarea></td>
              </tr>

              <tr><td>
                <small>Solusi</small><br>
                <textarea name="solusi" class="form-control form-control-sm" rows="5" id="txtsolusi"></textarea></td>
              </tr>

              <tr><td>
                <small>Upload Gambar</small><input type="file" name="gbr" class="btn btn-sm" id="fimg"></td>
              </tr>

              <tr><td>
                <small>Link Video</small><br>
                <input type="text" name="link_vid" class="form-control form-control-sm"></td>
              </tr>              

              <!--<tr class="hide-form"><td>
                <small>Upload Video</small><br>
                <input type="file" name="video" placeholder="" class="btn btn-sm" required></td>
              </tr>-->

        	</table>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" onclick="cltxt()">Batal</button>
          <input type="submit" name="simpan" class="btn btn-success btn-sm" value="Simpan">
          <!--<button type="submit" class="btn btn-success btn-sm">Simpan</button>-->
        </div>
        
      </div>
    </div>
  </div>

<script language="JavaScript" type="text/javascript">
//IMAGE PREVIEW
// Get the modal
var modal = document.getElementById("modalImgPreview");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("closeImgPrev")[0];

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("imgPreview");
var modalImg = document.getElementById("img01");
//var captionText = document.getElementById("caption");
if (img != null) {
img.onclick = function(){
  span.style.display = "block";
  modal.style.display = "block";
  modalImg.src = this.src;
  //captionText.innerHTML = this.alt;
};
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
};



  //USER DELETE CONFIRM
  $(document).ready(function(){
    $("button.del_alert").click(function(e){
      if(!confirm('Anda akan menghapus data')){
        e.preventDefault();
        return false;
      }return true;
    });
  });

  function cltxt(){
  	document.getElementById('myModal').style.display='none';
	$('button').click(function(){
		$('input[type="text"]').val(' ');
    $('textarea').val(' ');
	});
	}

    function searchTable() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("input");
      filter = input.value.toUpperCase();
      table = document.getElementById("sortTable");
      tr = table.getElementsByTagName("button");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("small")[0];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }       
      }
    }

  //expand|collapse data
  var coll = document.getElementsByClassName("collapsible");
  var i;
  for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
      this.classList.toggle("active");
      var content = this.nextElementSibling;
      if (content.style.maxHeight){
        content.style.maxHeight = null;
      } else {
        content.style.maxHeight = content.scrollHeight + "px";
      } 
    });
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