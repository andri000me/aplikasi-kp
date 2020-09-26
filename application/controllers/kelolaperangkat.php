<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * 
 */
class Kelolaperangkat extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('status') != "login") {
			redirect(base_url("login?warn=loginFailed"));
		}

        $this->load->helper('form'); 
        $this->load->library('form_validation'); 

		$this->load->helper("file");

		$this->load->model('Db_labkom');
	}

	public function index(){
		$this->load->view('header/header');
		$this->load->view('kelolaperangkat');
	}

	//HARDWARE
	public function hardware(){
		$data['listHw'] = $this->Db_labkom->showHw()->result();
		$this->load->view('header/header');
		$this->load->view('kelolahardware', $data);
	}

	public function addHw(){
		$nama	= $this->input->post('nama');
		$jp  	= $this->input->post('jenis_perangkat');
		$icon 	= $_FILES['icon'];
			if ($icon='') {
			}else{
				$config['upload_path']		= './assets/icon';
				$config['allowed_types']	= 'jpg|png|jpeg';

				$this->load->library('upload',$config);
				if (!$this->upload->do_upload('icon')) {
					echo "Upload Gagal!"; die();
				}else{
					$icon = $this->upload->data('file_name');
				}
			}
		$this->Db_labkom->newHw($nama,$jp,$icon);
	}

	public function delHw(){
		$id 	= $this->input->post('w_id');
		$icon	= $this->input->post('w_icon');
		$url 	= "assets/icon/".$icon;

		$this->Db_labkom->deleteHw($id,$url);
	}

	public function modHw(){
		$id 	= $this->input->post('idperangkat');
		$nama 	= $this->input->post('editnama');
		$jp 	= $this->input->post('editperangkat');
		$gambar = $this->input->post('icon');
		$url 	= "assets/icon/".$gambar;
		$icon 	= $_FILES['icon'];
			if ($icon='') {
			}else{
				$config['upload_path']		= './assets/icon';
				$config['allowed_types']	= 'jpg|png|jpeg;';

				$this->load->library('upload',$config);
				if (!$this->upload->do_upload('icon')) {
					$this->Db_labkom->updateHw($id,$nama,$jp);
					die();
				}else{
					$icon = $this->upload->data('file_name');
					$this->Db_labkom->updateHw($id,$nama,$jp,$icon,$url);
				}
			}
	}

	public function page_editHw(){
		$get_id = $_GET['id'];
		$id['as'] = $this->Db_labkom->take_Hwid($get_id)->row();
		$this->load->view('header/header');
		$this->load->view('kelolahardware_edit', $id);
	}


	//SOFTWARE
	public function software(){
		$data['listSw'] = $this->Db_labkom->showSw()->result();
		$this->load->view('header/header');
		$this->load->view('kelolasoftware', $data);
	}

	public function addSw(){
		$nama 	= $this->input->post('nama');
		$jp 	= $this->input->post('jenis_perangkat');
		$icon 	= $_FILES['icon'];
			if ($icon='') {
			}else{
				$config['upload_path']		= './assets/icon';
				$config['allowed_types']	= 'jpg|png|jpeg;';

				$this->load->library('upload',$config);
				if (!$this->upload->do_upload('icon')) {
					echo "Upload Gagal!"; die();
				}else{
					$icon = $this->upload->data('file_name');
				}
			}

		$this->Db_labkom->newSw($nama,$jp,$icon);
	}

	public function delSw(){
		$id 	= $this->input->post('w_id');
		$icon	= $this->input->post('w_icon');
		$url 	= "assets/icon/".$icon;

		$this->Db_labkom->deleteSw($id,$url);
	}

	public function modSw(){
		$id 	= $this->input->post('idperangkat');
		$nama 	= $this->input->post('editnama');
		$jp 	= $this->input->post('editperangkat');
		$gambar = $this->input->post('icon');
		$url 	= "assets/icon/".$gambar;
		$icon 	= $_FILES['icon'];
			if ($icon='') {
			}else{
				$config['upload_path']		= './assets/icon';
				$config['allowed_types']	= 'jpg|png|jpeg;';

				$this->load->library('upload',$config);
				if (!$this->upload->do_upload('icon')) {
					$this->Db_labkom->updateSw($id,$nama,$jp);
					die();
				}else{
					$icon = $this->upload->data('file_name');
					$this->Db_labkom->updateSw($id,$nama,$jp,$icon,$url);
				}
			}
	}

	public function page_editSw(){
		$get_id = $_GET['id'];
		$id['as'] = $this->Db_labkom->take_Swid($get_id)->row();
		$this->load->view('header/header');
		$this->load->view('kelolasoftware_edit', $id);
	}


	//TROUBLESHOOTING PERANGKAT
	public function ts_data(){
		$this->load->library('Bbcode');

		$id_perangkat 	= $this->input->post('id_perangkat');
		$get_id 		= $_GET['id'];
		$get_user 		= $_GET['user'];

		date_default_timezone_set("Singapore");
		$date = date("Y-m-d");

		$id['all_ware'] = $this->Db_labkom->take_ware_ts($get_id, $get_user)->result(); //take all record in the table
		$id['a_ware']	= $this->Db_labkom->take_a_ware($get_id)->row(); // take a record
		$id['user_id']	= $this->Db_labkom->selectUser($get_user)->row();
		$this->load->view('header/header');
		$this->load->view('kelola_ts', $id);		
	}

	public function imgUpload(){
		$icon 	= $_FILES['gbr'];
			if ($icon='') {
				$icon = 'blank.jpg';
			}else{
				$config['upload_path']		= './assets/troubleshooting_images/';
				$config['allowed_types']	= 'jpg|png|jpeg;';

				$this->load->library('upload',$config);
				if ($this->upload->do_upload('gbr')) {
					$icon = $this->upload->data('file_name');
				}else{

					$icon = "sukses.jpg";
				}
			}
		echo $icon;
	}

	public function approved(){
		$get_tsId		= $_GET['ts_id'];
		$get_wId 		= $_GET['w_id'];
		$get_user 		= $_GET['user'];		
		if ($get_tsId) {
			$stat 	= 1;
			$update = $this->Db_labkom->updateStat2($stat, $get_tsId);
		}
		redirect(base_url('kelolaperangkat/ts_data?id='.$get_wId.'&user='.$get_user));
	}

	public function unapprove(){
		$get_tsId		= $_GET['ts_id'];
		$get_wId 		= $_GET['w_id'];
		$get_user 		= $_GET['user'];
		if ($get_tsId) {
			$stat 	= 0;
			$update = $this->Db_labkom->updateStat2($stat, $get_tsId);
		}
		redirect(base_url('kelolaperangkat/ts_data?id='.$get_wId.'&user='.$get_user));
	}

	public function edit_ts_data(){
		$get_id			= $_GET['id'];
		$w_id			= $_GET['wId'];
		$id['data_ts'] 	= $this->Db_labkom->take_dataTs($get_id)->row();
		$id['a_ware']	= $this->Db_labkom->take_a_ware($w_id)->row(); // take a record
		$this->load->view('header/header');
		$this->load->view('kelola_ts_edit', $id);
	}

	public function add_ts_data(){
		$masalah 		= $this->input->post('masalah');
		$id_perangkat 	= $this->input->post('id_perangkat');
		$id_user		= $this->input->post('id_user');
		$deskripsi		= $this->input->post('deskripsi');
		$solusi			= $this->input->post('solusi');
		$linkVid		= $this->input->post('link_vid');
		date_default_timezone_set("Singapore");
		$date			= date("Y-m-d");

		if (!empty($linkVid)) {
			$youTube = "https://www.youtube.com/embed/";
			$key = $youTube.$linkVid;
			$this->Db_labkom->new_ts_data($masalah,$id_perangkat,$id_user,$deskripsi,$solusi,$key,$date);
		}else{
			$this->Db_labkom->new_ts_data($masalah,$id_perangkat,$id_user,$deskripsi,$solusi,$linkVid,$date);
		}

	}

	public function upd_ts_data(){
		$masalah 		= $this->input->post('masalah');
		$id_ts 			= $this->input->post('id_troubleshooting');
		$id_user		= $this->input->post('id_user');
		$id_perangkat	= $this->input->post('id_perangkat');
		$deskripsi		= $this->input->post('deskripsi');
		$solusi			= $this->input->post('solusi');
		$linkVid		= $this->input->post('link_vid');
		date_default_timezone_set("Singapore");
		$date			= date("Y-m-d");

		$this->Db_labkom->update_ts_data($masalah,$id_ts,$id_user,$id_perangkat,$deskripsi,$solusi,$linkVid,$date);
	}

	public function delete_ts_data(){
		$get_user 	= $_GET['user'];
		$id_ware 	= $this->input->post('id_perangkat');
		$ts_id 		= $this->input->post('id_ts');
		$this->Db_labkom->remove_ts_data($ts_id, $id_ware, $get_user);
	}

}

 ?>