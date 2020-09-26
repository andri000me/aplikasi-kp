<?php 
    if (isset($_GET['warn'])) {
      if ($_GET['warn']=="success") {
        echo '<script type="text/javascript">window.onload=alert("Data Ditambahkan!");</script>';
      }elseif ($_GET['warn']=="delsuccess") {
        echo '<script type="text/javascript">window.onload=alert("Data Dihapus!");</script>';
      }elseif ($_GET['warn']=="updsuccess") {
        echo '<script type="text/javascript">window.onload=alert("Data Diubah!");</script>';
      }elseif ($_GET['warn']=="aslabfull") {
        echo '<script type="text/javascript">window.onload=alert("Gagal! Laboratorium sudah memiliki 2 asisten!");</script>';
      }
    }

    $userLevel = $this->session->userdata("level");
?>

<?php if ($userLevel == "admin") { ?> <!--BACA ROLE USER INI DULUUUU-->
<div class="container mt-2 d-flex flex-column p-3 bg-white text-black border rounded">

    <div class="container mt-3 border-btm">
      <div class="d-flex justify-content-beetwen row">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div><h3>Kelola <?php echo $namaLaboratorium->lab_name; ?></h3></div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6" style="text-align: right;">
            <?php if ($this->session->userdata('nama') == "admin") { ?>
                    <a href="<?= base_url('adminberanda'); ?>">Beranda</a> > 
                    <a href="<?= base_url('admin_kelolalab'); ?>">Kelola Laboratorium</a> >
                    <b>Info Laboratorium</b>
            <?php }else{ ?>
                    <a href="<?= base_url('adminberanda'); ?>">Beranda</a> >
                    <b>Kelola Laboratorium</b>    
            <?php } ?>
        </div>
      </div>
    </div>

      <div class="d-flex justify-content-end mt-2 mb-2">
        <div style="text-align: right;" class="col-sm-12 col-md-6 col-lg-6">
          <input type="text" name="" class="inputbox-3 p-1 form form-control" id="input" onkeyup="searchTable()" placeholder=" Cari...">
        </div>
      </div>

    <div class="container mt-2 row ml-2">

      <div class="col-sm-12 col-md-4 col-lg-4 bg-light" style="max-height: 370px;">

        <div class="mt-2">

            <span style="font-size: 14pt;"><b>Informasi Laboratorium</b></span>
            <hr>

            <span><b>Kapasitas  :</b> <?php echo $namaLaboratorium->capacity; ?>-PC</span><br>

            <span>
              <b>Siap Pakai:</b>
                <?php 
                $kapasitasLab         = $namaLaboratorium->capacity;
                $pcBermasalah         = $countTrouble;
                $perangkatBermasalah  = $countPC->sumPC;
                $siapPakai            = $kapasitasLab-$pcBermasalah;

                echo $siapPakai;
                ?>-PC
            </span><br>
            <span>
              <b>Jumlah Masalah:</b>
                <?php if ($perangkatBermasalah == 0) {
                  echo "---";
                }else{
                  echo $perangkatBermasalah; ?> perangkat
                <?php } ?> 
            </span>
            <hr>

            <span>
              <b>Koordinator:</b>
                <?php 
                if ($koordinatorLab == ' ') {
                  echo "----";
                }else{ 
                  echo $koordinatorLab; 
                } ?>              
            </span>
            <hr>

            <span class="d-flex">
              <b>Asisten Laboratorium</b>
              <?php if ($this->session->userdata("nama")=="admin") { ?>
                
              <?php }else{ ?> 
                  <a href="<?php echo base_url('admin_kelolapengguna');?>?labId=<?= $lab->lab_id; ?>">
                    <button type="submit" class="btn btn-primary btn-sm ml-1 mr-1">
                      <i class="fa fa-info"></i>
                    </button>
                  </a>        
              <?php } ?>                
            </span>

            <ul class="list-unstyled">
              <?php foreach ($aslabList as $key) : ?>
              <li><?php echo $key->name; ?></li>
              <?php endforeach; ?>
            </ul>
            <hr>

        </div>

      </div>

      <div class="col-sm-12 col-md-8 col-lg-8 p-3">
        <h3>Daftar Kerusakan Perangkat</h3>
        <div class="table table-responsive" style="width: 100%;">
          <table class="table table-sm table-bordered table-striped mt-2" id="sortTable" style="width: 100%;">

            <tr align="center">
              <th style="width: 30%;">Nama Perangkat</th>
              <th style="width: 26%;">Deskripsi Kerusakan</th>
              <th style="width: 24%;">PC-</th>
              <?php 
              
              if ($userLevel == "admin") {
                
              }else{ ?>
                <th style="width: 20%;">Aksi</th>
              <?php } ?>
            </tr>

            <?php $i=0; foreach ($troubleList as $val) : $i++; ?>
            <tr>
              <!--<td align="center" style="width: 5%;"><?php echo $i; ?></td>-->
              <td><?= $val->wares_name; ?></td>
              <td><?= $val->description; ?></td>
              <td align="center">PC-<?= $val->pc; ?></td>

              <?php if ($userLevel == "admin") {
                
              }else{ ?>
                <td class="d-flex justify-content-center" style="border: none;">

                  <div>
                    <a class="btn btn-primary btn-sm mr-2" href="<?= base_url('admin_kelolalab/lab_info');?>?name=<?= $val->wares_name; ?>&desc=<?= $val->description; ?>&pc=<?= $val->pc; ?>&id=<?= $val->lab_id; ?>&thingID=<?= $val->things_id; ?>" role="button">
                      <i class="fa fa-edit" style="font-size: 10pt;"></i>
                      <!--<button type="submit" class="btn btn-primary border btn-sm m-1">
                        <i class="fa fa-edit"></i>
                      </button>-->
                    </a>
                  </div>

                  <div>
                    <!--form delete-->
                    <form action="<?php echo base_url('admin_kelolalab/hapus_kerusakan')?>" method="post">
                      <div class="hide-form">
                        <input readonly type="text" class="btn btn-tersier" name="tId" value="<?= $val->things_id;?>">
                        <input readonly type="text" class="btn btn-tersier" name="labId" value="<?= $val->lab_id;?>">
                      </div>
                      <button type="submit" class="btn btn-danger border btn-sm del_alert">
                        <i class="fa fa-trash"></i>
                      </button>
                    </form>
                  </div>

                </td>
              <?php } ?>

            </tr>
            <?php endforeach; ?>

          </table>
        </div>       
      </div>

    </div>

</div>

<?php }elseif ($userLevel == "Koordinator Laboratorium") { ?><!--BACA ROLE USER INI DULUUUU-->

<div class="container mt-2 d-flex flex-column p-3 bg-white text-black border rounded">

    <div class="container mt-3 border-btm">
      <div class="d-flex justify-content-beetwen row">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div><h3>Kelola <?php echo $namaLaboratorium->lab_name; ?></h3></div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6" style="text-align: right;">
            <?php if ($this->session->userdata('nama') == "admin") { ?>
                    <a href="<?= base_url('adminberanda'); ?>">Beranda</a> > 
                    <a href="<?= base_url('admin_kelolalab'); ?>">Kelola Laboratorium</a> >
                    <b>Info Laboratorium</b>
            <?php }else{ ?>
                    <a href="<?= base_url('adminberanda'); ?>">Beranda</a> >
                    <b>Kelola Laboratorium</b>    
            <?php } ?>
        </div>
      </div>
    </div>

    <div class="ml-4 mt-2">
      <div class="d-flex justify-content-beetwen row">
        <!-- Button trigger modal -->
        <button class="btn btn-primary btn-sm" onclick="modal()" data-toggle="modal" data-target="#modalTambahPengguna"><b>+</b>Tambah Asisten</button>
        <button class="btn btn-primary btn-sm ml-2" onclick="modal()" data-toggle="modal" data-target="#modalKerusakan"><b>+</b>Tambah Kerusakan</button>
      </div>
    </div>

    <div class="container mt-2 row ml-2">

      <div class="col-sm-12 col-md-4 col-lg-4 bg-light" style="max-height: 370px;">

        <div class="mt-2">

            <span style="font-size: 14pt;"><b>Informasi Laboratorium</b></span>
            <hr>

            <span><b>Kapasitas  :</b> <?php echo $namaLaboratorium->capacity; ?>-PC</span><br>

            <span>
              <b>Siap Pakai:</b>
                <?php 
                $kapasitasLab         = $namaLaboratorium->capacity;
                $pcBermasalah         = $countTrouble;
                $perangkatBermasalah  = $countPC->sumPC;
                $siapPakai            = $kapasitasLab-$pcBermasalah;

                echo $siapPakai;
                ?>-PC
            </span><br>
            <span>
              <b>Bermasalah:</b>
                <?php if ($perangkatBermasalah == 0) {
                  echo "---";
                }else{
                  echo $perangkatBermasalah; ?> perangkat
                <?php } ?> 
            </span>
            <hr>

            <span>
              <b>Koordinator:</b><br>
                <?php 
                if ($koordinatorLab == ' ') {
                  echo "----";
                }else{ 
                  echo $koordinatorLab; 
                } ?>              
            </span>
            <hr>

            <span class="d-flex">
              <b>Asisten Laboratorium</b>
              <?php if ($this->session->userdata("nama")=="admin") { ?>
                
              <?php }else{ ?> 
                  <a href="<?php echo base_url('admin_kelolapengguna');?>?labId=<?= $lab->lab_id; ?>">
                    <button type="submit" class="btn btn-primary btn-sm ml-1 mr-1">
                      <i class="fa fa-edit"></i>
                    </button>
                  </a>        
              <?php } ?>                
            </span>

            <ul class="list-unstyled">
              <?php foreach ($aslabList as $key) : ?>
              <li><?php echo $key->name; ?></li>
              <?php endforeach; ?>
            </ul>
            <hr>

        </div>

      </div><br>

      <div class="col-sm-12 col-md-8 col-lg-8 mt-3">     
        <h3>Daftar Kerusakan Perangkat</h3>
          <div>
            <input type="text" name="" class="inputbox-3 p-1" id="input" onkeyup="searchTable()" placeholder=" Cari...">
          </div>        
        <div class="table table-responsive" style="width: 100%;">
          <table class="table table-sm table-bordered table-striped mt-2" id="sortTable" style="width: 100%;">

            <tr align="center">
              <th style="width: 30%;">Nama Perangkat</th>
              <th style="width: 26%;">Deskripsi Kerusakan</th>
              <th style="width: 24%;">PC-</th>
              <?php 
              
              if ($userLevel == "admin") {
                
              }else{ ?>
                <th style="width: 20%;">Aksi</th>
              <?php } ?>
            </tr>

            <?php $i=0; foreach ($troubleList as $val) : $i++; ?>
            <tr>
              <!--<td align="center" style="width: 5%;"><?php echo $i; ?></td>-->
              <td><?= $val->wares_name; ?></td>
              <td><?= $val->description; ?></td>
              <td align="center">PC-<?= $val->pc; ?></td>

              <?php if ($userLevel == "admin") {
                
              }else{ ?>
                <td class="d-flex justify-content-center" style="border: none;">

                  <div>
                    <a class="btn btn-primary btn-sm mr-2" href="<?= base_url('admin_kelolalab/lab_info');?>?name=<?= $val->wares_name; ?>&desc=<?= $val->description; ?>&pc=<?= $val->pc; ?>&id=<?= $val->lab_id; ?>&thingID=<?= $val->things_id; ?>" role="button">
                      <i class="fa fa-edit" style="font-size: 10pt;"></i>
                      <!--<button type="submit" class="btn btn-primary border btn-sm m-1">
                        <i class="fa fa-edit"></i>
                      </button>-->
                    </a>
                  </div>

                  <div>
                    <!--form delete-->
                    <form action="<?php echo base_url('admin_kelolalab/hapus_kerusakan')?>" method="post">
                      <div class="hide-form">
                        <input readonly type="text" class="btn btn-tersier" name="tId" value="<?= $val->things_id;?>">
                        <input readonly type="text" class="btn btn-tersier" name="labId" value="<?= $val->lab_id;?>">
                      </div>
                      <button type="submit" class="btn btn-danger border btn-sm del_alert">
                        <i class="fa fa-trash"></i>
                      </button>
                    </form>
                  </div>

                </td>
              <?php } ?>

            </tr>
            <?php endforeach; ?>

          </table>
        </div>       
      </div>

    </div>

</div>

<?php } ?>

<!-- AddAslab Modal -->
<form action="<?= base_url('admin_kelolapengguna/addUserbyKoordi')  ?>" method="post">
  <div class="modal" id="modalTambahPengguna">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Asisten Lab.</h4>
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

              <tr hidden>
                <td>
                  <small>Status</small><br>
                  <input type="text" name="status" value="Asisten Laboratorium" class="form-control form-control-sm" readonly>
                </td>
              </tr>              

              <tr>
                <td>
                  <small>Posisi</small><br>
                  <small>lab_id</small>
                  <input type="text" class="form-control form-control-sm" name="lab" value="<?php echo $lab->lab_id; ?>" readonly>
                  <small>lab_name</small>
                  <input type="text" class="form-control form-control-sm" name="labName" value="<?php echo $lab->lab_name; ?>" readonly>
                  <small>totalAslab (max. 2)</small>
                  <input type="text" class="form-control form-control-sm" name="maxAslab" value="<?php echo $maxAslab->maxAslab; ?>" readonly>
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
                  <small>Username</small><br>
                  <input type="text" name="username" placeholder="" class="form-control form-control-sm" required>
                </td>
              </tr>

              <tr>
                <td>
                  <small>Password</small><br>
                  <input type="text" name="password" placeholder="" class="form-control form-control-sm" required>
                </td>
              </tr>

              <tr><td></td></tr>
            </table>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" onclick="hideModalTambahPengguna()">Batal</button>
          <button type="submit" class="btn btn-success btn-sm">Simpan</button>
        </div>
        
      </div>
    </div>
  </div>
</form>

  <!-- Wares problem Modal -->
<?php echo form_open_multipart('admin_kelolalab/addTrouble'); ?>
  <div class="modal" id="modalKerusakan">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Kerusakan</h4>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <table style="width: 100%;">
              <tr>
                <td>
                  <small>Nama Perangkat</small>
                  <input type="text" name="nama" placeholder="" class="form-control form-control-sm" required>
                </td>
              </tr>
              <tr>
                <td>
                  <small>Deskripsi</small>
                  <textarea name="deskripsi" class="form-control form-control-sm" rows="3" required></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <small>PC</small>
                  <input type="number" max="<?php echo $lab->capacity ?>" min="0" name="pc" placeholder="" class="form-control form-control-sm" required>
                </td>
              </tr>
              <tr class="hide-form">
                <td>
                  <input type="text" name="labId" placeholder="" class="form-control form-control-sm" value="<?php echo $lab->lab_id; ?>" readonly>                  
                </td>
              </tr>
          </table>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" onclick="hideModalKerusakan()">Batal</button>
          <button type="submit" class="btn btn-success btn-sm">Simpan</button>
        </div>
        
      </div>
    </div>
  </div>
<?php echo form_close(); ?>


  <!-- Edit wares problem Modal -->
<?php 
if (isset($_GET['name']) && isset($_GET['desc']) && isset($_GET['pc']) && isset($_GET['id']) && isset($_GET['thingID'])) {

echo form_open_multipart('admin_kelolalab/editTrouble'); ?>
  <div class="modal fade" id="modalEdit">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Daftar Kerusakan</h4>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <table style="width: 100%;">
              <tr>
                <td>
                  <small>Nama Perangkat</small>
                  <input type="text" name="nama" value="<?=$_GET['name'];?>" class="form-control form-control-sm" required>
                </td>
              </tr>
              <tr>
                <td>
                  <small>Deskripsi</small>
                  <textarea type="text" name="deskripsi" class="form-control form-control-sm" rows="3" required><?=$_GET['desc'];?></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <small>PC</small>
                  <input type="number" max="<?php echo $lab->capacity ?>" min="0" name="pc" value="<?=$_GET['pc'];?>" placeholder="" class="form-control form-control-sm" required>
                </td>
              </tr>
              <tr class="hide-form">
                <td>
                  <input type="text" name="labId" placeholder="" class="form-control form-control-sm" value="<?= $_GET['id']; ?>" readonly> 
                  <input type="text" name="tId" placeholder="" class="form-control form-control-sm" value="<?= $_GET['thingID']; ?>" readonly>                  
                </td>
              </tr>
          </table>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm">
            <a href="<?php echo base_url('admin_kelolalab/lab_info?id='.$lab->lab_id) ?>" style="text-decoration: none; color: white;">
              Batal
            </a>
          </button>
          <button type="submit" class="btn btn-success btn-sm">Simpan</button>
        </div>
        
      </div>
    </div>
  </div>
<?php echo form_close(); } ?>

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

  function hideModalKerusakan(){
    document.getElementById('modalKerusakan').style.display='none';
      $('button').click(function(){
        $('input[type="email"]').val(' ');
        $('input[type="text"]').val(' ');
        $('input[type="number"]').val(' ');
      });
  }

  function hideModalTambahPengguna(){
    document.getElementById('modalKerusakan').style.display='none';
      $('button').click(function(){
        $('input[type="email"]').val(' ');
        $('input[type="text"]').val(' ');
        $('input[type="number"]').val(' ');
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

    (function ($){
        $(window).on('load',function(){
            $('#modalEdit').modal('show');
        });
    })( jQuery );    

</script>


</body>
</html>