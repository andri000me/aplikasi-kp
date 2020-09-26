<?php 

/**
 *
 */
class Admin_kelolalab extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login?warn=loginFailed"));
		}
	}

	public function index(){
		$data['lab'] = $this->Db_labkom->optionLab()->result();
		$this->load->view('admin_kelolalab', $data);
	}

	public function lab_info(){
		$lab = $_GET['id']; 
		$data['lab'] 				= $this->Db_labkom->showALab($lab)->row();
		$data['namaLaboratorium'] 	= $this->Db_labkom->Laboratorium($lab)->row();
		$data['aslabList'] 			= $this->Db_labkom->active_aslab($lab)->result(); //DONE
		$data['troubleList'] 		= $this->Db_labkom->showLab_Things($lab)->result(); //PANGGIL DAFTAR MASALAH
		$data['countTrouble']		= $this->Db_labkom->countTrouble($lab); //LIHAT CATATAN DI MODEL
		$data['koordinatorLab'] 	= $this->Db_labkom->koordiLabInfo($lab);
		$data['countPC']			= $this->Db_labkom->countPC($lab)->row();
		$data['maxAslab']			= $this->Db_labkom->maxAslab($lab)->row();
		$this->load->view('header/header');
		$this->load->view('labInfo', $data);
	}

	public function addLab(){
		$labName 	= $this->input->post('nama');
		$capacity	= $this->input->post('kapasitas');
		$this->Db_labkom->addLab($labName, $capacity);
	}

	public function editLab(){
		$labId 		= $_GET['labId'];
		$labName 	= $this->input->post('nama');
		$capacity	= $this->input->post('kapasitas');
		$this->Db_labkom->editLab($labName, $capacity, $labId);
	}

	public function active(){
		$get_lab 		= $_GET['lab_id'];		
		if ($get_lab) {
			$stat 	= 1;
			$update = $this->Db_labkom->updateLabStatus($get_lab, $stat);
		}
		redirect(base_url('admin_kelolalab'));
	}

	public function inactive(){
		$get_lab 		= $_GET['lab_id'];
		if ($get_lab) {
			$stat 	= 0;
			$update = $this->Db_labkom->updateLabStatus($get_lab, $stat);
		}
		redirect(base_url('admin_kelolalab'));
	}

	public function addTrouble(){
		$nameTrouble	= $this->input->post('nama');
		$desc			= $this->input->post('deskripsi');
		$pc 			= $this->input->post('pc');
		$labId 			= $this->input->post('labId');
		$this->Db_labkom->addTrouble($nameTrouble, $desc, $pc, $labId);
	}

	public function editTrouble(){
		$nameTrouble	= $this->input->post('nama');
		$desc			= $this->input->post('deskripsi');
		$pc 			= $this->input->post('pc');
		$labId 			= $this->input->post('labId');
		$id 			= $this->input->post('tId');
		$this->Db_labkom->editTrouble($nameTrouble, $desc, $pc, $labId, $id);
	}

	public function hapus_kerusakan(){
		$labId = $this->input->post('labId');
		$id = $this->input->post('tId');
		$this->Db_labkom->removeTrouble($id, $labId);
	}

	public function edit_page(){
		$labId = $_GET['idLab'];
		$data['lab_detail'] = $this->Db_labkom->admin_kelolalabEditPage($labId)->row();
		$this->load->view('header/header');
		$this->load->view('admin_kelolalab_edit', $data);
	}
}

 ?>