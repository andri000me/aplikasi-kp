<?php 

/**
 *
 */
class Android_controller extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('Bbcode');
	}

	public function index(){
		$this->load->view('android_view/android_beranda');
	}

	public function login(){
		$this->load->view('android_view/android_login');
	}

	public function list_perangkat(){
		$ware_type 					= $_GET['w'];
		$data['daftar_perangkat'] 	= $this->Db_labkom->daftar_perangkat($ware_type)->result();
		$data['jenisPerangkat'] 	= $this->Db_labkom->daftar_perangkat($ware_type)->row();
		$this->load->view('android_view/android_daftarPerangkat', $data);
	}

	public function list_solusi(){
		$ware_id 				= $_GET['wId'];
		$data['daftar_solusi'] 	= $this->Db_labkom->daftar_solusi($ware_id)->result();
		$data['namaPerangkat'] 	= $this->Db_labkom->tableWare($ware_id)->row();
		$this->load->view('android_view/android_daftarSolusi', $data);
	}

	public function solusi(){
		$ts_id	= $_GET['tsId'];
		$data['solusi'] = $this->Db_labkom->solusi($ts_id)->row();
		$this->load->view('android_view/android_solusi', $data);
	}

	public function cari(){
		$val = $this->input->post('cariSolusi');
		if (!is_null($val)) {
			$data['searchResult']	 = $this->Db_labkom->cariSolusi($val)->result();
			$data['countResult']	 = $this->Db_labkom->countHasilSolusi($val);
			$this->load->view('android_view/android_hasilCari', $data);
		}else{
			redirect(base_url('android_controller'));
		}
	}


}

 ?>