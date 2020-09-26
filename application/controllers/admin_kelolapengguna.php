<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Admin_kelolapengguna extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('level') != "admin" && $this->session->userdata('level') != "Koordinator Laboratorium"){
			redirect(base_url("login?warn=loginFailed"));
		}
	}

	public function index(){
		$get_labId						= $_GET['labId'];
		$data['lab']					= $this->Db_labkom->showALab($get_labId)->row();
		$data['optLab']					= $this->Db_labkom->optionLab()->result();
		$data['admin_kelolapengguna'] 	= $this->Db_labkom->showUser($get_labId)->result();
		$data['maxAslabInAdmin'] 		= $this->Db_labkom->maxAslabInAdmin()->row(); //CEKLAGI
		$this->load->view('header/header');
		$this->load->view('admin_kelolapengguna', $data);
	}

	public function addUserbyAdmin(){
		$nama 		= $this->input->post('nama');
		$aslab 		= $this->input->post('lab');
		$status		= $this->input->post('status');
		$email 		= $this->input->post('email');
		//$level 	= $this->input->post('level');
		$kontak 	= $this->input->post('kontak');
		$username 	= $this->input->post('username');
		$password 	= $this->input->post('password');
		$this->Db_labkom->newUserbyAdmin($nama,$aslab,$status,$email,$kontak,$username,$password);
	}

	public function addUserbyKoordi(){
		$nama 		= $this->input->post('nama');
		$aslab 		= $this->input->post('lab');
		$status		= $this->input->post('status');
		$email 		= $this->input->post('email');
		//$level 		= $this->input->post('level');
		$kontak 	= $this->input->post('kontak');
		$username 	= $this->input->post('username');
		$password 	= $this->input->post('password');
		$maxAslab	= $this->input->post('maxAslab');
		$labId 		= $this->input->post('lab');
		$this->Db_labkom->newUserbyKoordi($nama,$aslab,$status,$email,$kontak,$username,$password,$maxAslab,$labId);
	}

	public function delUser(){
		//$labId = $this->input->post('labId');
		$labId = $_GET['labId'];
		$u_id = $this->input->post('u_id');
		$this->Db_labkom->deleteUser($u_id,$labId);
	}

	public function edit_page(){
		$labId 				= $_GET['labId'];
		$get_id 			= $_GET['id'];
		$id['optLab']		= $this->Db_labkom->optionLab()->result();
		$id['as'] 			= $this->Db_labkom->take_id($get_id, $labId)->row();		
		$this->load->view('header/header');
		$this->load->view('admin_kelolapengguna_edit', $id);
	}

	public function modUser(){
		$labId 			= $_GET['labId'];
		$nama 			= $this->input->post('nama');
		$aslab			= $this->input->post('lab');
		$status			= $this->input->post('status');
		$email 			= $this->input->post('email');
		//$level 			= $this->input->post('level');
		$kontak 		= $this->input->post('kontak');
		$username 		= $this->input->post('username');
		$u_id 			= $this->input->post('u_id');
		$password 		= $this->input->post('password');
		$this->Db_labkom->editUser($nama,$aslab,$status,$email,$kontak,$username,$u_id,$password, $labId);
	}

	public function approved(){
		$get_user 		= $_GET['u_id'];
		$labId 			= $_GET['labId'];
		$u_level		= $_GET['level'];		
		if ($get_user) {
			$stat 	= 1;
			$update = $this->Db_labkom->updateUserStatusActive($get_user, $stat, $labId, $u_level);
			//redirect(base_url('admin_kelolapengguna?labId=0&user='.$get_user.'-active'));
		}
	}

	public function unapprove(){
		$get_user 		= $_GET['u_id'];
		$labId 			= $_GET['labId'];
		$u_level		= $_GET['level'];
		if ($get_user) {
			$stat 	= 0;
			$update = $this->Db_labkom->updateUserStatusFailed($get_user, $stat, $labId, $u_level);
			redirect(base_url('admin_kelolapengguna?labId=0&user='.$get_user.'-nonactive'));
		}
	}

	public function filter_user(){
		$labId 							= $_GET['labId'];
		$data['optLab']					= $this->Db_labkom->optionLab()->result();

		$filter							= $_GET['filter'];
		$data['filter'] 				= $_GET['filter'];

		$data['admin_kelolapengguna'] 	= $this->Db_labkom->filterUser($filter)->result();
		$data['maxAslabInAdmin'] 		= $this->Db_labkom->maxAslabInAdmin()->row(); //CEKLAGI
		//$data['countAslab'] 			= $this->Db_labkom->countAslab($labId)->row();
		$this->load->view('header/header');
		$this->load->view('admin_kelolapengguna', $data);
	}

	public function filter_userLab(){
		$labId 							= $_GET['labId'];

		$labName 						= $_GET['labName'];
		$data['labName'] 				= $_GET['labName'];

		$data['optLab']					= $this->Db_labkom->optionLab()->result();	

		$filter							= $_GET['filter'];
		$data['filter'] 				= $_GET['filter'];
		
		$data['admin_kelolapengguna'] 	= $this->Db_labkom->filterUserLab($filter)->result();
		$data['maxAslabInAdmin'] 		= $this->Db_labkom->maxAslabInAdmin()->row(); //CEKLAGI
		//$data['countAslab'] 			= $this->Db_labkom->countAslab($labId)->row();
		$this->load->view('header/header');
		$this->load->view('admin_kelolapengguna', $data);
	}

}

 ?>