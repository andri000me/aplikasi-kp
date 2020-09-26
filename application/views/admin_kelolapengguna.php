<?php 
    if (isset($_GET['warn'])) {
      if ($_GET['warn']=="success") {
        echo '<script type="text/javascript">window.onload=alert("Pengguna Ditambahkan!");</script>';
      }elseif ($_GET['warn']=="del_success") {
        echo '<script type="text/javascript">window.onload=alert("Pengguna Dihapus!");</script>';
      }elseif ($_GET['warn']=="updsuccess") {
        echo '<script type="text/javascript">window.onload=alert("Data Pengguna Diubah!");</script>';
      }elseif ($_GET['warn']=="updStatFailed") {
        echo '<script type="text/javascript">window.onload=alert("Aktivasi asisten gagal! Laboratorium memiliki 2 asisten aktif!");</script>';
      }elseif ($_GET['warn']=="updStatKoordiFailed") {
        echo '<script type="text/javascript">window.onload=alert("Aktivasi koordinator gagal! Laboratorium memiliki 1 Koordinator aktif!");</script>';
      }elseif ($_GET['warn']=="maxKoordi") {
        echo '<script type="text/javascript">window.onload=alert("Gagal! Laboratorium memiliki Koordinator aktif!");</script>';
      }elseif ($_GET['warn']=="maxAslab") {
        echo '<script type="text/javascript">window.onload=alert("Gagal! Laboratorium memiliki 2 Asisten aktif!");</script>';
      }
    }
?>

<div class="container mt-2 mb-4">
  <div class="d-flex flex-column p-3 bg-white text-black border rounded">

    <div class="container mt-3 border-btm">
      <div class="d-flex justify-content-beetwen row">
        <div class="col-sm-12 col-md-6 col-lg-6">
          <?php 
          $user = $this->session->userdata("nama");
          if ($user == "admin") { ?>
            <h3>Daftar Pengguna</h3>
          <?php }else{ ?>
                  <h3>Asisten <?php echo $lab->lab_name; ?></h3>
          <?php } ?>        
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6" style="text-align: right;">
          <?php if ($this->session->userdata("nama") == "admin") { ?>
            <div>
              <a href="<?= base_url('adminberanda'); ?>">Beranda</a> > 
              <b>Kelola Pengguna</b>
            </div>
          <?php }else { ?>
            <div>
              <a href="<?= base_url('adminberanda'); ?>">Beranda</a> > 
              <a href="<?= base_url('admin_kelolalab/lab_info?id='.$lab->lab_id); ?>">Kelola Laboratorium</a> > 
              <b>Kelola Pengguna</b>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>

  	<div class="mt-2 mb-2">
      <div class="d-flex justify-content-beetwen row">
        <?php if ($this->session->userdata("nama")=="admin") { ?>
        <div class="col-md-6 col-lg-6 col-sm-12">
          <button class="btn btn-primary btn-sm" type="submit" onclick="showmodal()" data-toggle="modal" data-target="#myModal"><b>+</b>Tambah Pengguna</button>
        </div>          
        <div class="col-md-6 col-lg-6 col-sm-12 d-flex justify-content-end" style="text-align: right;">
          <div class="p-1">
            <pre style="font-family: calibri;">Filter: </pre>
          </div>
          <div>
            <select onchange="src(this.value)" class="form-control form-control-sm">

              <?php if ($filter == "KoordinatorLaboratorium" || $filter == "AsistenLaboratorium") { ?>
                <option selected hidden><?php echo $filter; ?></option>
              <?php }elseif(!empty($labName)) { ?>
                      <option selected hidden><?php echo $labName; ?></option>
              <?php }else{?>
                      <option selected hidden>Tampilkan Semua</option>
              <?php } ?>
              <option value="<?= base_url('admin_kelolapengguna?labId=');?>">Tampilkan Semua</option>         
              <option value="<?= base_url('admin_kelolapengguna/filter_user?filter=KoordinatorLaboratorium&labId=&labName=');?>">Koordinator Laboratorium</option>
              <option value="<?= base_url('admin_kelolapengguna/filter_user?filter=AsistenLaboratorium&labId=&labName=');?>">Asisten Laboratorium</option>

                    <?php foreach ($optLab as $listLab) : ?>
                      <option value="<?= base_url('admin_kelolapengguna/filter_userLab?filter='.$listLab->lab_id.'&labId='.'&labName='.$listLab->lab_name);?>"><?php  echo $listLab->lab_name; ?></option>
                      <!--PASS VALUE LAB ID KE MODEL??-->
                    <?php endforeach; ?>

            </select>
          </div>
        </div>
      <?php }else{

      } ?>
      </div>
  	</div>

    <?php foreach ($admin_kelolapengguna as $val) :
      $status   = ($val->u_status == 1)?site_url('admin_kelolapengguna/unapprove/?u_id='.$val->u_id.'&labId='.$val->lab_id.'&level='.$val->level):site_url('admin_kelolapengguna/approved/?u_id='.$val->u_id.'&labId='.$val->lab_id.'&level='.$val->level);
     ?>

  	<button class="collapsible rounded">
      <?php echo $val->name; ?><br>
      <small><?php echo $val->level; ?></small>
    </button>

    	<div class="content">

    		<div class="d-flex justify-content-between mb-2 p-3">

    			<div class="d-flex flex-column">
    				<div class="p-2 bd-highlight"><small><b>Nama</b><br></small>
              <?php echo $val->name ?>
            </div>
    				<div class="p-2 bd-highlight"><small><b>Posisi</b><br></small>
              <?php echo $val->lab_name ?>
            </div>
    				<div class="p-2 bd-highlight"><small><b>E-Mail</b><br></small>
              <?php echo $val->email ?>
            </div>
    				<div class="p-2 bd-highlight"><small><b>Kontak</b><br></small>
              <?php echo $val->cp ?>
            </div>
    				<div class="p-2 bd-highlight"><small><b>Username</b><br></small>
              <?php echo $val->username ?>
            </div>
    				<div class="p-2 bd-highlight"><small><b>Password</b><br></small>
              <?php echo $val->password ?></div>
    			</div>

    			<div class="mt-2">
                <?php if ($user != "admin") { ?>

                <?php }else { ?>
                  <a href="<?php echo $status; ?>" style="text-decoration: none; z-index: 1;">
                    <span class="btn btn-sm mb-1 <?= ($val->u_status == 1)?'btn-success':'btn-danger'; ?>" style="width: 68px; max-width: 68px;">
                      <?php echo ($val->u_status == 1)?'Aktif':'Nonaktif'; ?>
                    </span>
                  </a><br>
                <?php } ?>   

                <a href="<?php echo base_url('admin_kelolapengguna/edit_page');?>?id=<?= $val->u_id; ?>&labId=<?= $val->lab_id; ?>">
                  <button type="submit" class="btn btn-sw btn-sm mb-1" style="width: 67.4px;">
                    <i class="fa fa-edit"></i>Edit
                  </button>
                </a>
                
                <!--form delete pengguna-->
                <?php if ($user != "admin") { ?>
                  <!--<form action="<?php echo base_url('admin_kelolapengguna/delUser?labId='.$val->lab_id)?>" method="post">-->
                <?php }else{ ?>
                <form action="<?php echo base_url('admin_kelolapengguna/delUser?labId=')?>" method="post">
                  <div class="hide-form">
                    <input type="text" class="btn btn-tersier" name="u_id" value="<?php echo $val->u_id; ?>">
                  </div>
                  <button type="submit" class="btn btn-danger btn-sm del_alert">
                    <i class="fa fa-trash"></i>
                  Hapus</button>
                </form>
                <?php } ?>
    		</div>

    	</div>

    </div>
    
    <?php endforeach; ?>
  </div>
</div>

<!-- Modal Tambah Pengguna -->
<form action="<?= base_url('admin_kelolapengguna/addUserbyAdmin')  ?>" method="post">
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Pengguna</h4>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <table style="width: 100%;">
              <tr>
                <td>
                  <small>Nama</small><br>
                  <input type="text" name="nama" placeholder="" class="form-control form-control-sm" required>
                </td>
              </tr>

              <tr>
                <td>
                  <small>Status</small><br>
                  <select class="form-control form-control-sm" name="status">
                    <option selected hidden></option>
                    <option>Koordinator Laboratorium</option>
                    <option>Asisten Laboratorium</option>
                  </select>
                </td>
              </tr>              

              <tr>
                <td>
                  <small>Posisi</small><br>
                  <select class="form-control form-control-sm" name="lab">
                    <option selected hidden></option>
                    <?php foreach ($optLab as $listLab) : ?>
                      <option value="<?php echo $listLab->lab_id; ?>"><?php  echo $listLab->lab_name; ?></option>
                      <!--PASS VALUE LAB ID KE MODEL??-->
                    <?php endforeach; ?>
                  </select>
                </td>
              </tr>

              <tr>
                <td>
                  <small>Email</small><br>
                  <input type="email" name="email" class="form-control form-control-sm" required>
                </td>
              </tr>

              <tr>
                <td>
                  <small>Kontak</small><br>
                  <input type="text" name="kontak" placeholder="" class="form-control form-control-sm" required>
                </td>
              </tr>

              <tr>
                <td>
                  <small>Nama Pengguna</small><br>
                  <input type="text" name="username" placeholder="" class="form-control form-control-sm" required>
                </td>
              </tr>

              <tr>
                <td>
                  <small>Kata Sandi</small><br>
                  <input type="text" name="password" placeholder="" class="form-control form-control-sm" required>
                </td>
              </tr>

              <tr><td></td></tr>
            </table>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" onclick="hidemodal()">Batal</button>
          <button type="submit" class="btn btn-success btn-sm">Simpan</button>
        </div>
        
      </div>
    </div>
  </div>
</form>

<script type="text/javascript">
function src(src){
  window.location = src;
}

function showmodal(){

}
  function hidemodal(){
    document.getElementById('myModal').style.display='none';
      $('button').click(function(){
        $('input[type="email"]').val(' ');
        $('input[type="text"]').val(' ');
      });
  }

  function cltxt(){
    document.getElementById('myModal').style.display='none';
  $('button').click(function(){
    $('input[type="text"]').val(' ');
  });
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