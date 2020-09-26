<?php 
    if (isset($_GET['warn'])) {
      if ($_GET['warn']=="success") {
        echo '<script type="text/javascript">window.onload=alert("Data perangkat ditambahkan!");</script>';
      }elseif ($_GET['warn']=="delsuccess") {
        echo '<script type="text/javascript">window.onload=alert("Data Dihapus!");</script>';
      }elseif ($_GET['warn']=="updsuccess") {
        echo '<script type="text/javascript">window.onload=alert("Data Diubah!");</script>';
      }
    }

$userLevel  = $this->session->userdata('level');

?>
<div class="container mt-2">
  <div class="d-flex flex-column p-3 bg-white text-black border rounded">

  <div class="container mt-3 border-btm">
    <div class="d-flex justify-content-beetwen row">
      <div class="col-sm-12 col-md-6 col-lg-6">
          <div><h3>Daftar Perangkat Keras</h3></div>
      </div>
      <div class="col-sm-12 col-md-6 col-lg-6" style="text-align: right;">
          <?php if ($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "Koordinator Laboratorium") { ?>
                  <a href="<?= base_url('adminberanda'); ?>">Beranda</a> > 
                  <a href="<?= base_url('kelolaperangkat'); ?>">Kelola Perangkat</a> >
                  <b>Kelola Perangkat Keras</b>
          <?php }else{ ?>
                  <a href="<?= base_url('kelolaperangkat'); ?>">Kelola Perangkat</a> >
                  <b>Kelola Perangkat Keras</b>           
          <?php } ?>
      </div>
    </div>
  </div>

  	<div class="mt-2 mb-2">
      <div class="d-flex justify-content-beetwen row">
        <div class="col-7">
          <?php if ($userLevel == "admin" || $userLevel == "Koordinator Laboratorium") { ?>
            <!-- Button trigger modal -->
            <button class="btn btn-primary btn-sm" onclick="modal()" data-toggle="modal" data-target="#myModal"><b>+</b>Tambah Perangkat Keras</button>
         <?php }else{ } ?>
        </div>
        <div class="col-5" style="text-align: right;">
            <div>
              <input type="text" name="" class="inputbox-3 p-1" id="input" onkeyup="searchTable()" placeholder=" Cari...">
            </div>
        </div>
      </div>
  	</div>

  	<div class="table">
  		<table class="table table-sm table-borderless table-striped mt-2" id="sortTable">
  			<tr>
          <thead style="text-align: center;">
            <th>Nama Perangkat</th>
            <th style="width: 10%;">Aksi</th>
          </thead>
        </tr>

  			<?php foreach ($listHw as $val) : ?>
  			<tr>

  				<td>
              <img src="<?= base_url('/assets/icon/');?><?=$val->w_icon?>" class="mr-3" style="max-width: 32px;"><?= $val->w_name ?>
          </td>

  				<td class="d-flex justify-content-center">
            <?php if ($this->session->userdata("level") == "admin" || $this->session->userdata("level") == "Koordinator Laboratorium") { ?>
    				<div>
    					<a href="<?= base_url('kelolaperangkat/page_editHw');?>?id=<?= $val->w_id; ?>">
    						<button type="submit" class="btn btn-primary border btn-sm m-1">
    							<i class="fa fa-edit"></i>
    						</button>
    					</a>
    				</div>
          <?php }else{ } ?>

    				<div>
    					<a href="<?php echo base_url('kelolaperangkat/ts_data');?>?id=<?= $val->w_id; ?>&user=<?= $this->session->userdata("nama"); ?>">
    						<button type="submit" class="btn btn-info btn-sm border m-1" title="Lihat Informasi" style="width: 33px;">
    							<i class="fa fa-info"></i>
    						</button>
    					</a>
    				</div>

            <?php if ($this->session->userdata("level") == "admin" || $this->session->userdata("level") == "Koordinator Laboratorium") { ?>
    				<div>
    					<!--form delete-->
    					<form action="<?php echo base_url('Kelolaperangkat/delHw')?>" method="post">
    						<div class="hide-form">
    							<input readonly type="text" class="btn btn-tersier" name="w_id" value="<?= $val->w_id;?>">
                  <input readonly type="text" class="btn btn-tersier" name="w_icon" value="<?= $val->w_icon;?>">
    						</div>
    						<button type="submit" class="btn btn-danger border btn-sm m-1 del_alert">
    							<i class="fa fa-trash"></i>
    						</button>
    					</form>
    				</div>
          <?php }else{ } ?>
          
  				</td>
  			</tr>
  		<?php endforeach; ?>
  		</table>
  	</div>

    
  </div>
</div>

  <!-- AddThings Modal -->
<?php echo form_open_multipart('Kelolaperangkat/addHw'); ?>
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Perangkat Keras</h4>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <table style="width: 100%;">
              <tr><td>
              	<small>Nama</small><br>
              	<input type="text" name="nama" placeholder="" class="form-control form-control-sm" required></td></tr>

              <tr class="hide-form"><td>
              	<small>Jenis Perangkat</small><br>
              	<input type="text" name="jenis_perangkat" class="form-control form-control-sm" required value="Hardware" readonly>
              </td></tr>

              <tr><td>
            	<small>Icon</small><br>
            	<input type="file" name="icon" class="btn btn-sm">
              </td></tr>
        	</table>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" onclick="cltxt()">Batal</button>
          <button type="submit" class="btn btn-success btn-sm">Simpan</button>
        </div>
        
      </div>
    </div>
  </div>
<?php echo form_close(); ?>

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

  function cltxt(){
  	document.getElementById('myModal').style.display='none';
	$('button').click(function(){
		$('input[type="text"]').val(' ');
	});
	}

    function searchTable() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("input");
      filter = input.value.toUpperCase();
      table = document.getElementById("sortTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
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

</script>


</body>
</html>