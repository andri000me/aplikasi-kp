<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Troubleshooting Perangkat Komputer | Kelola Laboratorium</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" type="text/javascript"></script>
  <script src="<?= base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>

  <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

</head>
<body>	

<?php 
    if (isset($_GET['warn'])) {
      if ($_GET['warn']=="success") {
        echo '<script type="text/javascript">window.onload=alert("Data Laboratorium Ditambahkan!");</script>';
      }elseif ($_GET['warn']=="delsuccess") {
        echo '<script type="text/javascript">window.onload=alert("Data Laboratorium Dihapus!");</script>';
      }elseif ($_GET['warn']=="updsuccess") {
        echo '<script type="text/javascript">window.onload=alert("Data Laboratorium Diubah!");</script>';
      }
    }

    $userLevel = $this->session->userdata("level");
 ?>

<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top shadow mb-4">
	<div class="container">
		<a href="<?php echo base_url(); ?>adminberanda" class="navbar-brand"><img src="<?php echo base_url();?>images/dlsubig.png" class="dlsu">
			<span>Troubleshooting<br><small>Perangkat Komputer</small></span>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
        <li class="nav-item"><hr></li>
        <li class="nav-item shadow p-2">
          <a href="#" class="nav-link disabled" style="color: green;">
            <b><i class="fa fa-user-circle"></i><?php echo $this->session->userdata("nama"); ?></b>
          </a>
        </li>
        <li class="nav-item shadow p-2">
          <a href=" <?= base_url('adminberanda'); ?> " class="nav-link"><i class="fa fa-home"></i> Beranda</a>
        </li>
        <li class="nav-item shadow p-2">
          <?php if ($userLevel == "admin"){ ?>
            <a href="<?php echo base_url('login/logout'); ?>" class="nav-link"><i class="fa fa-sign-out-alt"></i>Keluar</a>
          <?php }else{ ?>
            <a href="<?php echo base_url('login/logout_aslab'); ?>" class="nav-link"><i class="fa fa-sign-out-alt"></i>Keluar</a>
          <?php } ?>
        </li>

      </ul>
		</div>

	</div>
</nav>

<div class="container mt-2">
  <div class="d-flex flex-column p-3 bg-white text-black border rounded">

<div class="container mt-3 border-btm">
  <div class="d-flex justify-content-beetwen row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div><h3>Kelola Laboratorium</h3></div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6" style="text-align: right;">
        <?php if ($this->session->userdata('nama') == "admin") { ?>
                <a href="<?= base_url('adminberanda'); ?>">Beranda</a> > 
                <b>Kelola Laboratorium</b>
        <?php }else{ } ?>
    </div>
  </div>
</div>

  	<div class="mt-2 mb-2">
      <div class="d-flex justify-content-beetwen row">
        <div class="col-7">
            <!-- Button trigger modal -->
            <button class="btn btn-primary btn-sm" onclick="modal()" data-toggle="modal" data-target="#myModal"><b>+</b>Tambah Lab.</button>
        </div>
        <!--
        <div class="col-5" style="text-align: right;">
            <div>
              <input type="text" name="" class="inputbox-3 p-1" id="input" onkeyup="searchTable()" placeholder=" Cari...">
            </div>
        </div>-->
      </div>
  	</div>

  	<div class="table table-responsive">
  		<table class="table table-sm table-bordered table-striped mt-2" id="sortTable">
  			<tr>
  				<thead align="center">
  					<th>No.</th>
  					<th>Laboratorium</th>
  					<th>Kapasitas Lab.</th>
  					<th>Status Laboratorium</th>
  					<th>Aksi</th>
  				</thead>
  			</tr>
  			<?php $i=1; foreach ($lab as $val) :
         $status   = ($val->lab_status == 1)?site_url('admin_kelolalab/inactive/?lab_id='.$val->lab_id):site_url('admin_kelolalab/active/?lab_id='.$val->lab_id);
        ?>
  				<tr>
  					<td align="center"><?php echo $i++; ?></td>
  					<td><?php echo $val->lab_name; ?></td>
  					<td align="center"><?php echo $val->capacity; ?>-PC</td>
  					<td align="center">
                  <a href="<?php echo $status; ?>" style="text-decoration: none;">
                    <span class="badge p-2 <?= ($val->lab_status == 1)?'badge-success':'badge-danger'; ?>" style="width: 68px; max-width: 68px;">
                      <?php echo ($val->lab_status == 1)?'Aktif':'Nonaktif'; ?>
                    </span>
                  </a><br>              
            </td>
  					<td class="d-flex justify-content-center" style="border: none;">

	    				<div>
	    					<a href="<?= base_url('admin_kelolalab/edit_page');?>?idLab=<?= $val->lab_id; ?>">
	    						<button type="submit" class="btn btn-primary btn-sm border m-1">
	    							<i class="fa fa-edit"></i>
	    						</button>
	    					</a>
	    				</div>

	    				<div>
	    					<a href="<?= base_url('admin_kelolalab/lab_info?id=').$val->lab_id; ?>">
	    						<button type="submit" class="btn btn-info btn-sm border m-1" style="width: 33px;">
	    							<i class="fa fa-info"></i>
	    						</button>
	    					</a>
	    				</div>

	    				<div class="hide-form"> <!--NI FORM DELETE ADA HIDE-->
	    					<!--form delete-->
	    					<form action="<?php echo base_url('')?>" method="post">
	    						<div class="hide-form">
	    							<input type="text" class="btn btn-tersier" name="w_id" value="<?= $val->lab_id;  ?>">
	    						</div>
	    						<button type="submit" class="btn btn-danger border btn-sm m-1 del_alert">
	    							<i class="fa fa-trash"></i>
	    						</button>
	    					</form>
	    				</div>

  					</td>
  				</tr>
  			<?php endforeach; ?>
  		</table>
  	</div>

    
  </div>
</div>

  <!-- Modal -->
<?php echo form_open_multipart('admin_kelolalab/addLab'); ?>
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Laboratorium</h4>
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
              		<small>Kapasitas</small><br>
              		<input type="number" min="1" max="40" name="kapasitas" placeholder="" class="form-control form-control-sm" required>
              	</td>
              </tr>
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

  function hidemodal(){
    document.getElementById('myModal').style.display='none';
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

</script>


</body>
</html>