<?php 

/**
 *
 */
class AdminBeranda extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		if($this->session->userdata('level') != "admin" && $this->session->userdata('level') != "Koordinator Laboratorium"){
			redirect(base_url("login?warn=loginFailed"));
		}
	}

	public function index(){
		$name			= $this->session->userdata("nama");
		$data['lab'] 	= $this->Db_labkom->showLab($name)->row();
		//$data['idLab'] 	= $this->Db_labkom->takeLabID($name);
		$this->load->view('header/header');
		$this->load->view('adminberanda', $data);
	}
}

 ?>